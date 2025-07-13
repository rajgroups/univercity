<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class FileHelper
{
    /**
     * Upload file to specified disk and path
     */
    public static function uploadFile(UploadedFile $file, string $folder = '', string $disk = 'public'): string
    {
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($folder, $filename, $disk);
        return $path;
    }

    /**
     * Get full URL of file from disk
     */
    public static function getUrl(string $path, string $disk = 'public'): string
    {
        return Storage::disk($disk)->url($path);
    }

    /**
     * Delete file from disk
     */
    public static function deleteFile(string $path, string $disk = 'public'): bool
    {
        if (Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->delete($path);
        }
        return false;
    }
}
