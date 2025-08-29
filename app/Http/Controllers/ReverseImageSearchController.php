<?php

namespace App\Http\Controllers;

use App\Services\GoogleVisionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReverseImageSearchController extends Controller
{
    protected $googleVisionService;

    public function __construct(GoogleVisionService $googleVisionService)
    {
        $this->googleVisionService = $googleVisionService;
    }

    public function showForm()
    {
        return view('reverse_image_form');
    }

    public function reverseSearch(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Limit size to 5MB for performance
        ]);

        // Store the uploaded image
        $path = $request->file('image')->store('images');

        // Get the reverse image search results
        $imagePath = storage_path('app/' . $path);
        $results = $this->googleVisionService->reverseImageSearch($imagePath);

        // Delete the uploaded image after processing
        Storage::delete($path);

        return view('reverse_image_results', compact('results'));
    }
}
