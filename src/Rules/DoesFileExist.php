<?php

declare(strict_types=1);

namespace AscendDigital\StorageManager\Rules;

use Illuminate\Contracts\Validation\Rule;

use Illuminate\Support\Facades\Storage;

/**
 * @since 1.0.0
 */
class DoesFileExist implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Storage::disk(env('STORAGE_MANAGER_DISK', 's3'))->exists($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "File not found!";
    }
}
