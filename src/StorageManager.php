<?php

namespace AscendDigital\StorageManager;

use AscendDigital\StorageManager\Models\FileUpload;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StorageManager implements Contracts\StorageManager
{
    /**
     * {@inheritdoc}
     */
    public function uploadFile($file, string $tag = null): ?FileUpload
    {
        try {
            if (app()->runningUnitTests() || app()->runningInConsole()) {
                $tag = 'tests/'.$tag;
            }

            return FileUpload::create([
                'original_file_name' => $file->getClientOriginalName(),
                'key' => $key = $file->store(
                    ($tag ? $tag : 'other'),
                    env('STORAGE_MANAGER_DISK', 's3')
                ),
                'url' => Storage::disk(env('STORAGE_MANAGER_DISK', 's3'))->url($key),
                'extension' => $file->clientExtension(),
                'mime_type' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function deleteFile(string $key): bool
    {
        if (Storage::disk(env('STORAGE_MANAGER_DISK', 's3'))->delete($key)
            && FileUpload::where('key', $key)->delete()
        ) {
            return true;
        }

        return false;
    }
}
