<?php

namespace AscendDigital\StorageManager;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AscendDigital\StorageManager\StorageManager
 */
class StorageManagerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \AscendDigital\StorageManager\StorageManager::class;
    }
}
