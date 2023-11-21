<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Upload Image
     * 
     * @param  mixed $request
     * @return void
     */
    public function uploadImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $image_path = $request->file('image')->store('images');

        return response()->json([
            'status_code' => 200,
            'message' => 'Image uploaded successfully',
            'image_path' => $image_path,
        ]);
    }

    /**
     * Get Accessible Image URL
     * 
     * @param  mixed $image_path
     * @return String $image_url
     */
     public function getAccessibleImageURL($image_path)
     {
        // create accessibe image with uri
        $image_url = asset('storage/' . $image_path);
        
 
         return $image_url;
     }

}
