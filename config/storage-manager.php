<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | FileUpload Implementation
    |--------------------------------------------------------------------------
    |
    | Define the FileUpload implementation.
    |
    */

    'implementation' => AscendDigital\StorageManager\Models\FileUpload::class,

    /*
    |--------------------------------------------------------------------------
    | Tracking user details
    |--------------------------------------------------------------------------
    |
    | Define if the package should track the user personal details such as ip address
    |
    */

    'tracking' => true,

    /*
    |--------------------------------------------------------------------------
    | Max File Size
    |--------------------------------------------------------------------------
    |
    | Define the maximum file upload size
    |
    */

    'max_file_size' => '8192',


    /*
    |--------------------------------------------------------------------------
    | User default Guards
    |--------------------------------------------------------------------------
    |
    | Define which authentication guards the User resolver
    | should use.
    |
    */

    'user' => [
        'prefix' => 'user',
        'guards' => [
            'web',
            'api',
        ],
    ],

];
