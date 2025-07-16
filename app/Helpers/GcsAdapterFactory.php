<?php

namespace App\Helpers;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Filesystem\FilesystemAdapter;
use League\Flysystem\Filesystem;
use League\Flysystem\GoogleCloudStorage\GoogleCloudStorageAdapter;

class GcsAdapterFactory
{
    public function __invoke(array $config): FilesystemAdapter
    {
        $projectId  = env('GOOGLE_CLOUD_PROJECT_ID');
        $bucketName = env('GOOGLE_CLOUD_STORAGE_BUCKET');

        $client = new StorageClient([
            'projectId' => $projectId,
            'keyFilePath' => storage_path('app/google-cloud.json'),
        ]);

        $bucket = $client->bucket($bucketName);

        $adapter = new GoogleCloudStorageAdapter($bucket);

        return new FilesystemAdapter(
            new Filesystem($adapter),
            $adapter,
            ['visibility' => 'public']
        );
    }
}
