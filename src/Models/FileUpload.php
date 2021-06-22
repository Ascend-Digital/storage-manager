<?php

declare(strict_types=1);

namespace AscendDigital\StorageManager\Models;

use App\Models\User;
use AscendDigital\StorageManager\Traits\AutomateTracking;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    use AutomateTracking;

    /**
     * The table this model utilises
     */
    protected $table = 'file_uploads';

    /**
     * Mass assignable fields
     *
     * @var array
     */
    protected $fillable
        = [
            'original_file_name',
            'key',
            'url',
            'extension',
            'mime_type',
            'size',
            'ip_address',
            'user_agent',
        ];

    /**
     * A user will create a file upload
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
