<?php

namespace AscendDigital\StorageManager;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class StorageManagerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('storage-manager')
            ->hasConfigFile()
            ->hasRoute('api')
            ->hasMigration('create_file_uploads_table');
    }
}
