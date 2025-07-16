<?php

namespace App\Helpers;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\UploadedFile;

class GcsUploader
{
    public static function upload(UploadedFile $file, string $folder = 'uploads'): string
    {
        $projectId = env('GOOGLE_CLOUD_PROJECT_ID');
        $bucketName = env('GOOGLE_CLOUD_STORAGE_BUCKET');

        $client = new StorageClient([
            'projectId' => $projectId,
            'keyFilePath' => storage_path('app/google-cloud.json'),
        ]);

        $bucket = $client->bucket($bucketName);

        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $objectName = $folder . '/' . $filename;

        $stream = fopen($file->getRealPath(), 'r');

        $bucket->upload($stream, [
            'name' => $objectName,
            'predefinedAcl' => 'publicRead', // Optional for public access
        ]);

        return "https://storage.googleapis.com/{$bucketName}/{$objectName}";
    }
}
