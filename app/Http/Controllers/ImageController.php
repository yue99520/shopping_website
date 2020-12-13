<?php

namespace App\Http\Controllers;

use App\Http\Requests\image\UploadImageRequest;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(UploadImageRequest $request)
    {
        $image = $request->file('image');
        $path = '/uploaded';
        $fileSystem = Storage::disk('public');
        $fileSystem->makeDirectory('/uploaded');

        if ($fileSystem->put($path, $image)) {
            return response()->json([
                'url' => $path . '/' . $image->hashName()
            ]);
        }

        return response()->json([
            'msg' => 'Image upload fail.',
        ]);
    }
}
