<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    public const SEX_MALE = "male";
    public const SEX_FEMALE = "female";

    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'sex', 'mood', 'email_notifications', 'push_notifications'
    ];

    public function getSex()
    {
        return $this->sex == self::SEX_MALE ? "Мужчина" : "Женщина";
    }
}
