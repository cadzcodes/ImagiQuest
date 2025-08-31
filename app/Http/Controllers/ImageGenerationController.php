<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class ImageGenerationController extends Controller
{
    /**
     * Show the form to input the description for image generation.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('image-generation');
    }

    public function showDashboard()
    {
        return view('dashboard');
    }


    /**
     * Handle the form submission and generate the image.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function generateImage(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:255',
        ]);

        $prompt = $request->input('prompt');
        $url = 'https://api-inference.huggingface.co/models/stabilityai/stable-diffusion-xl-base-1.0';
        $apiKey = env('HUGGINGFACE_API_KEY');

        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => ['inputs' => $prompt],
                'verify' => false,
            ]);

            if (str_starts_with($response->getHeaderLine('Content-Type'), 'image/')) {
                $imageData = $response->getBody()->getContents();

                // Generate a unique filename based on the current timestamp
                $filename = 'generated_image_' . time() . '.png';

                // Save the image using Storage facade
                Storage::disk('public')->put('generated_images/' . $filename, $imageData);
                $imageUrl = asset('storage/generated_images/' . $filename);


                // Get the public URL to the image
                $imageUrl = Storage::url('generated_images/' . $filename);
                $fileSize = round(Storage::size('public/generated_images/' . $filename) / 1024, 2); // KB
                $imageDetails = getimagesize(storage_path('app/public/generated_images/' . $filename));
                $resolution = $imageDetails[0] . 'x' . $imageDetails[1];

                return view('image-generation', compact('imageUrl', 'prompt', 'fileSize', 'resolution'));
            }

            $body = json_decode($response->getBody(), true);
            if (isset($body['error'])) {
                return back()->with('error', 'API Error: ' . $body['error']);
            }

            return back()->with('error', 'Unexpected response format.');
        } catch (\Exception $e) {
            \Log::error('Error generating image', ['message' => $e->getMessage()]);
            return back()->with('error', 'Error generating image: ' . $e->getMessage());
        }
    }



    public function saveImage(Request $request)
    {
        $request->validate([
            'image_url' => 'required|string',
            'prompt' => 'required|string',
        ]);

        // Save the image details to the gallery
        auth()->user()->gallery()->create([
            'image_url' => $request->input('image_url'),
            'prompt' => $request->input('prompt'),
        ]);

        // Optionally, redirect the user back to the image generation page with a success message
        return redirect()->route('image.generation')->with('success', 'Hooray! Your image has been successfully added to your gallery. You can now view or generate another one!');
    }


    public function showGallery()
    {
        $images = auth()->user()->gallery()->get(); // Fetch all images for the logged-in user
        return view('user-gallery', compact('images'));
    }

    public function deleteImage($imageId)
    {
        // Find the image by its ID for the authenticated user
        $image = auth()->user()->gallery()->find($imageId);

        if (!$image) {
            return back()->with('error', 'Image not found.');
        }

        // Delete the image file from storage
        if (Storage::disk('public')->exists($image->image_url)) {
            Storage::disk('public')->delete($image->image_url);
        }

        // Delete the image entry from the database
        $image->delete();

        return back()->with('success', 'Image successfully deleted.');
    }

}
