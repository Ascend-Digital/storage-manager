<?php

namespace AscendDigital\StorageManager\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

/**
 * @since 1.0.0
 */
trait Requests {

    /**
     * Resolve the User Agent.
     *
     * @return string
     */
    public static function getUserAgent(): ?string
    {
        return Request::header('User-Agent');
    }

    /**
     * Resolve the User Agent.
     *
     * @return string
     */
    public static function getIpAddress(): string
    {
        return Request::ip();
    }

    /**
     * Resolve the URL.
     *
     * @return string
     */
    public static function getUrl(): string
    {
        if (App::runningInConsole()) {
            return 'Command Line Interface';
        }

        return Request::fullUrl();
    }

}
