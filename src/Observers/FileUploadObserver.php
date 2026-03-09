<?php

declare(strict_types=1);

namespace AscendDigital\StorageManager\Observers;

use AscendDigital\StorageManager\Models\FileUpload;
use Illuminate\Support\Facades\Storage;

class FileUploadObserver
{
    /**
     * Handle the User "deleted" event for the file upload.
     *
     * @param FileUpload $file
     *
     * @return void
     */
    public function deleted(FileUpload $file)
    {
        Storage::disk(config('storage-manager.disk'))->delete($file->key);
    }
}
