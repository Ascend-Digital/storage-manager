<?php

namespace AscendDigital\StorageManager\Traits;

use Exception;
use Illuminate\Support\Facades\Config;

/**
 * Automate the assignment of a uuid as the primary key
 * for a given record persisted to the database
 *
 * @since 1.0.0
 */
trait AutomateTracking
{
    /**
     * Hook onto the boot method
     *
     * @return void
     */
    protected static function bootAutomateTracking()
    {
        if (! Config::get('storage-manager.tracking')) {
            return;
        }
        /**
         * When creating a new entry for a model automatically
         * generate fill in tracking details
         */
        static::creating(function ($model) {
            try {
                $model->user_id = auth()->user() ? auth()->user()->id : null;
                $model->ip_address = Requests::getIpAddress();
                $model->user_agent = Requests::getUserAgent();
            } catch (Exception $e) {
                //
            }
        });
    }
}
