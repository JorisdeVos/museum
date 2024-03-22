<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Painting;
use Illuminate\Support\Facades\Storage;

class PaintingController extends Controller
{
    public function showCanvas()
    {
        return view('canvas');
    }

    public function submitPainting(Request $request)
    {
        try {
            // Validate the request if needed
            $request->validate([
                'image' => 'required|string' // Ensure that 'image' is present and is a string
            ]);

            // Decode the base64 image data
            $imageData = $request->input('image');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $imageData = base64_decode($imageData);

            // Generate a unique filename
            $filename = 'painting_' . time() . '.png';

            // Store the image in the storage directory
            Storage::disk('public')->put($filename, $imageData);

            // Create a new Painting record
            Painting::create([
                'user_id' => auth()->id(),
                'image' => $filename,
            ]);

            return redirect('/')->with('success', 'Painting submitted successfully!');
        } catch (\Exception $e) {
            // Log the exception
            \Log::error('Error submitting painting: ' . $e->getMessage());
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to submit painting. Please try again.');
        }
    }
}
