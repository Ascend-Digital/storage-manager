<?php

declare(strict_types=1);

namespace AscendDigital\StorageManager\Contracts;

use AscendDigital\StorageManager\Models\FileUpload;

interface StorageManager
{

    /**
     * Uploads a file
     *
     * @param  mixed  $file  The file which will be uploaded
     * @param  string|null  $tag  A tag to organise the upload
     *
     * @return FileUpload|null If upload has failed, a null is returned
     */
    public function uploadFile(mixed $file, string $tag = null): ?FileUpload;

    /**
     * Deletes a file
     *
     * @param  string  $key  aws s3 key
     *
     * @return bool        true if successful deletion
     */
    public static function deleteFile(string $key): bool;

}
