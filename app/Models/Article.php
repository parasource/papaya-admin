<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public const SEX_MALE = 'male';
    public const SEX_FEMALE = 'female';

    protected $table = 'articles';

    protected $fillable = [
        'title', 'slug', 'text', 'cover', 'sex'
    ];

    public static function sexList()
    {
        return [
            self::SEX_MALE => 'Муж.',
            self::SEX_FEMALE => 'Жен.'
        ];
    }

    public function getSex()
    {
        return self::sexList()[$this->sex];
    }
}
