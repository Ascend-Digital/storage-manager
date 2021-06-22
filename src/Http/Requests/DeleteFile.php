<?php

declare(strict_types=1);

namespace AscendDigital\StorageManager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use AscendDigital\StorageManager\Rules\DoesFileExist;

class DeleteFile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'key' => [
                'required',
                new DoesFileExist
            ]
        ];
    }
}
