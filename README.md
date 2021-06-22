#  Ascend Digital - Storage Manager

---

Used for managing files on S3 or any driver you configure, via the storage manager facade you can easily upload and delete files as necessary.

## Installation

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="AscendDigital\StorageManager\StorageManagerServiceProvider" --tag="storage-manager-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="AscendDigital\StorageManager\StorageManagerServiceProvider" --tag="storage-manager-config"
```

## Usage

**Upload file**

	$file = StorageManager::uploadFile($file, $tag);

$tag is the directory you want to place it in, can be something like "users/avatars".

FileUpload model is returned if successful, else null is returned.

**Delete File**

    StorageManager::deleteFile($key)
Deletes the file from the database and from S3

**Key**

The key is stored within the database, simply grab the one you want and use as such.

An example of a key: *directory/sub_directory/image.jpg*

**Extending FileUpload Model**

Create a FileUpload model within your Models folder and simply extend the package's model. You may now extend Its functionality.

     <?php
        
        namespace App\Models;
        use AscendDigital\StorageManager\Models\FileUpload as AscendFileUpload;
        
        class FileUpload extends AscendFileUpload
        {
            //
        }

**Routes**

Utilise the following routes to upload and delete files from S3:


| Method | URI | Name |
|--------|-----|------|
| POST | api/utilities/file-upload | api.utilities.file-upload.store |
| DELETE | api/utilities/file-upload | api.utilities.file-upload.destroy |


- store takes a file and tag(nullable) to have it uploaded and returned a JSON response.
- destroy takes a key to delete a file and returns a JSON response
