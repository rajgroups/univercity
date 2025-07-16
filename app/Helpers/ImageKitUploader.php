<?php

namespace App\Helpers;

use ImageKit\ImageKit;
use Illuminate\Http\UploadedFile;

class ImageKitHelper
{
    protected static function client(): ImageKit
    {
        return new ImageKit(
            env('IMAGEKIT_PUBLIC_KEY'),
            env('IMAGEKIT_PRIVATE_KEY'),
            env('IMAGEKIT_URL_ENDPOINT')
        );
    }

    public static function uploadFile(UploadedFile $file, string $folder = 'uploads'): ?array
    {
        $client = self::client();

        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        $upload = $client->upload([
            'file' => fopen($file->getRealPath(), 'r'),
            'fileName' => $filename,
            'folder' => '/' . $folder,
        ]);

        if (!empty($upload->result->url)) {
            return [
                'url' => $upload->result->url,
                'fileId' => $upload->result->fileId,
            ];
        }

        return null;
    }

    public static function deleteFile(string $fileId): bool
    {
        $client = self::client();

        $response = $client->deleteFile($fileId);
        return $response->httpStatusCode === 204;
    }

    public static function replaceFile(UploadedFile $newFile, ?string $oldFileId = null, string $folder = 'uploads'): ?array
    {
        if ($oldFileId) {
            self::deleteFile($oldFileId);
        }

        return self::uploadFile($newFile, $folder);
    }
}
