<?php

namespace App\Services;

use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Image;
use GuzzleHttp\Client;

class GoogleVisionService
{
    protected $client;
    protected $httpClient;

    public function __construct()
    {
        $credentialsPath = env('GOOGLE_APPLICATION_CREDENTIALS');

        // Validate if file exists
        if (!file_exists($credentialsPath)) {
            throw new \Exception("Google credentials file not found at: $credentialsPath");
        }

        // Set the credentials environment variable for Google API
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $credentialsPath);

        $this->client = new ImageAnnotatorClient();
        $this->httpClient = new Client(); // Guzzle HTTP client
    }

    public function reverseImageSearch($imagePath)
    {
        try {
            // Open the image file
            $imageData = file_get_contents($imagePath);

            // Create an image object for Google Vision API
            $image = (new Image())->setContent($imageData);

            // Set the feature for Web Detection
            $features = [new Feature(['type' => Feature\Type::WEB_DETECTION])];

            // Perform the web detection
            $response = $this->client->annotateImage($image, $features);
            $webDetection = $response->getWebDetection();

            $results = [];

            // Extract image URLs for full, partial, and visually similar matches
            foreach ($webDetection->getFullMatchingImages() as $image) {
                $results[] = [
                    'image_url' => $image->getUrl(),
                    'page_url' => null,
                ];
            }

            foreach ($webDetection->getPartialMatchingImages() as $image) {
                $results[] = [
                    'image_url' => $image->getUrl(),
                    'page_url' => null,
                ];
            }

            // Adding visually similar image results
            foreach ($webDetection->getVisuallySimilarImages() as $image) {
                $results[] = [
                    'image_url' => $image->getUrl(),
                    'page_url' => null,
                ];
            }

            foreach ($webDetection->getPagesWithMatchingImages() as $page) {
                $pageUrl = $page->getUrl();

                // Fetch the page image (fall back if no image found)
                $imageFromPage = $this->getImageFromPage($pageUrl);
                if (!$imageFromPage) {
                    $imageFromPage = 'https://via.placeholder.com/150'; // Default thumbnail
                }

                $results[] = [
                    'image_url' => $imageFromPage, // Image from the page or thumbnail
                    'page_url' => $pageUrl,        // Page URL
                ];
            }

            return [
                'status' => 'success',
                'data' => $results,
            ];

        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }

    private function getImageFromPage($pageUrl)
    {
        // If the page URL is from Instagram's lookaside service (profile picture or post)
        if (preg_match('/lookaside\.instagram\.com/', $pageUrl)) {
            // Follow the redirect to get the real image URL
            $finalUrl = $this->followRedirect($pageUrl);

            if ($finalUrl) {
                return $finalUrl; // Return the real image URL from the redirect
            }
        }

        // If the URL is not from lookaside, check if it's an Instagram post URL
        if (preg_match('/instagram\.com\/p\//', $pageUrl)) {
            return $this->getInstagramPostImage($pageUrl);
        }

        // Default fallback to profile image
        return $this->getInstagramProfileImage($pageUrl);
    }

    private function getInstagramPostImage($postUrl)
    {
        // Fetch the page's HTML content
        $htmlContent = $this->fetchHtmlContent($postUrl);

        if (!$htmlContent) {
            return 'https://via.placeholder.com/150'; // Return a placeholder if unable to fetch content
        }

        // Search for the OG image tag for the post
        preg_match('/<meta property="og:image" content="([^"]+)"/i', $htmlContent, $matches);

        // Return the image URL from the OG image tag or a placeholder if not found
        return $matches[1] ?? 'https://via.placeholder.com/150';
    }



    private function getInstagramProfileImage($profileUrl)
    {
        // Try to fetch the page's HTML content
        $htmlContent = $this->fetchHtmlContent($profileUrl);

        if (!$htmlContent) {
            return 'https://via.placeholder.com/150'; // Default placeholder if no content found
        }

        // Search for the og:image meta tag in the HTML content
        preg_match('/<meta property="og:image" content="([^"]+)"/i', $htmlContent, $matches);

        // If a profile image is found, return it
        return $matches[1] ?? 'https://via.placeholder.com/150'; // Return a placeholder if not found
    }

    private function getInstagramThumbnail($url)
    {
        // Check if the URL is a lookaside URL
        if (preg_match('/lookaside\.instagram\.com/', $url)) {
            // Follow the redirect and fetch the real content
            $finalUrl = $this->followRedirect($url);

            if ($finalUrl) {
                // Once we have the redirected URL, try to extract the actual media
                return $this->extractMediaFromPage($finalUrl);
            }
        }

        // Default handling for non-lookaside URLs
        return $this->fetchInstagramMediaFromMeta($url);
    }

    private function fetchInstagramMediaFromMeta($url)
    {
        $htmlContent = $this->fetchHtmlContent($url);

        if (!$htmlContent) {
            return null; // Return null if unable to fetch the page
        }

        // Search for OG image and video tags (Instagram might have a video thumbnail instead of an image)
        preg_match('/<meta property="og:image" content="([^"]+)"/i', $htmlContent, $imageMatches);
        preg_match('/<meta property="og:video" content="([^"]+)"/i', $htmlContent, $videoMatches);

        // If no image or video is found, fallback to a placeholder image
        return $imageMatches[1] ?? $videoMatches[1] ?? 'https://via.placeholder.com/150';
    }


    private function extractMediaFromPage($url)
    {
        // Fetch HTML content from the final redirected Instagram URL
        $htmlContent = $this->fetchHtmlContent($url);

        if (!$htmlContent) {
            return 'https://via.placeholder.com/150'; // Return a placeholder if unable to extract media
        }

        // Search for the OG image or video URL
        preg_match('/<meta property="og:image" content="([^"]+)"/i', $htmlContent, $matches);

        return $matches[1] ?? 'https://via.placeholder.com/150'; // Default to placeholder if not found
    }

    private function fetchHtmlContent($url)
    {
        try {
            // Use Guzzle HTTP client to fetch the HTML content of the URL
            $response = $this->httpClient->get($url);
            return (string) $response->getBody();
        } catch (\Exception $e) {
            return null; // Return null if unable to fetch the page
        }
    }

    private function followRedirect($url)
    {
        try {
            // Perform a GET request to follow the redirect
            $response = $this->httpClient->get($url, ['allow_redirects' => true]);

            // Retrieve the final URL from the 'Location' header
            $redirectHistory = $response->getHeader('Location');

            // Return the last URL in the redirect history (final destination)
            return end($redirectHistory);
        } catch (\Exception $e) {
            return null; // Return null if unable to follow redirects
        }
    }


}
