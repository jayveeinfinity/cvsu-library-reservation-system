<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function UploadCover(Request $request) {
        $file = $request->hasFile('cover');
    }

    public function UploadImageToGallery(Request $request) {
        $base64Image = $request->image;

        // Decode the base64 string
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

        // Generate a unique filename with the correct extension
        $extension = $this->getImageExtension($base64Image);
        $fileName = Str::random(10) . '.' . $extension;
        
        // Save the image to the public disk
        Storage::disk('image_facilities')->put($fileName, $imageData);

        $image = Image::create([
            'filename' => $fileName,
            'learning_space_id' => $request->learning_space_id
        ]);

        return response()->json(['path' => Storage::url($fileName)]);
    }

    /**
     * Get the image extension from the Base64 string.
     *
     * @param  string  $base64Image
     * @return string
     */
    private function getImageExtension($base64Image)
    {
        if (str_contains($base64Image, 'data:image/jpeg')) {
            return 'jpg';
        } elseif (str_contains($base64Image, 'data:image/png')) {
            return 'png';
        } elseif (str_contains($base64Image, 'data:image/gif')) {
            return 'gif';
        }
        // Add other extensions as needed
        return 'jpg'; // Default to jpg
    }

    public function destroy(Request $request) {
        $id = $request->id;
        $image = Image::find($id);

        if($image) {
            $image->delete();

            return response()->json([
                'icon' => 'success',
                'title' => 'Deleted!',
                'message' => 'Successfully delete the image!'
            ]);
        }

        return response()->json([
            'icon' => 'error',
            'title' => 'Oopsss!',
            'message' => 'An error has occured!'
        ]);
    }
}