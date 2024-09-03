<?php

namespace App\Service;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    public function upload(UploadedFile $file, $directory = 'images')
    {
        $filename = now()->format('Ymd') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($directory), $filename);
        return $directory . '/' . $filename;
    }
}
