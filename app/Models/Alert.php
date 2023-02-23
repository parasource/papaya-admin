<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    public const TYPE_INFO = 'info';
    public const TYPE_SUCCESS = 'success';
    public const TYPE_WARNING = 'warning';
    public const TYPE_ERROR = 'error';
    public $timestamps = true;
    protected $table = 'alerts';
    protected $fillable = [
        'type', 'title', 'text'
    ];

    public function getType()
    {
        return self::typesList()[$this->type];
    }

    public static function typesList()
    {
        return [
            self::TYPE_INFO => 'Info',
            self::TYPE_SUCCESS => 'Success',
            self::TYPE_WARNING => 'Warning',
            self::TYPE_ERROR => 'Error',
        ];
    }
}
