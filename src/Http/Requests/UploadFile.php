<?php

declare(strict_types=1);

namespace AscendDigital\StorageManager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;

class UploadFile extends FormRequest
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
        $maxFileSize = Config::get('storageManager.max_file_size');

        return [
            'file' => 'required|file|max:' . $maxFileSize,
            'tag' => 'nullable|min:3|max:50',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'file.required' => 'A file is required',
            'file.file' => 'The uploaded item is not a valid file',
            'file.max' => 'Maximum file upload size exceeded',
        ];
    }
}
