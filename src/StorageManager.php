<?php

namespace AscendDigital\StorageManager;

use AscendDigital\StorageManager\Models\FileUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StorageManager implements Contracts\StorageManager
{
    /**
     * With the given location, creates a FileUpload from it.
     *
     * Only supports local locations for now.
     *
     * Example Usage:
     *
     * StorageManager::uploadFileFromLocation(
     *  storage_path('app/public/files/measuring-shutters/Back_of_Bay_Measure_Guide.pdf'),
     *  'public/files/measuring-shutters'
     * );
     *
     * Which gives you a FileUpload object with the following url:
     * /storage/files/measuring-shutters/jZXfVAPA6Z8eEqVYF9Kt7AxOiCaLPv5WSz4EfN4f.pdf
     *
     * You may choose to provide a filepath from tmp directory to be placed into the project
     *
     * @param  string  $location
     * @param  string|null  $tag
     *
     * @return FileUpload|null
     */
    public function uploadFileFromLocation(string $location, string $tag = null): ?FileUpload
    {
        $file = new UploadedFile($location, basename($location));

        return $this->uploadFile($file, $tag);
    }

    /**
     * {@inheritdoc}
     */
    public function uploadFile($file, string $tag = null): ?FileUpload
    {
        try {
            if (app()->runningUnitTests()) {
                $tag = 'tests/'.$tag;
            }

            return FileUpload::create([
                'original_file_name' => $file->getClientOriginalName(),
                'key' => $key = $file->store(
                    ($tag ? $tag : 'other'),
                    config('storage-manager.disk')
                ),
                'url' => Storage::disk(config('storage-manager.disk'))->url($key),
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
        if (Storage::disk(config('storage-manager.disk'))->delete($key)
            && FileUpload::where('key', $key)->delete()
        ) {
            return true;
        }

        return false;
    }
}
