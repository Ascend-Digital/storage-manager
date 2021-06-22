<?php

namespace AscendDigital\StorageManager\Database\Factories;

use AscendDigital\StorageManager\Models\FileUpload;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class FileUploadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FileUpload::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'original_file_name' => $this->faker->word().'.'.($extension
                    = $this->faker->fileExtension()),
            'key'                => $this->faker->uuid(),
            'url'                => $this->faker->filePath(),
            'extension'          => $extension,
            'mime_type'          => $this->faker->mimeType(),
            'size'               => $this->faker->numberBetween(1, 5000),
            'user_id'            => $this->faker->boolean() ? User::factory() : null,
            'user_agent'         => $this->faker->userAgent(),
        ];
    }
}