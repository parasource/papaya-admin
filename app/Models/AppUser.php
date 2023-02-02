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
        'name', 'email', 'sex', 'mood', 'email_notifications', 'push_notifications', 'apns_token'
    ];

    public function getSex()
    {
        return $this->sex == self::SEX_MALE ? "Мужчина" : "Женщина";
    }

    public function wardrobe()
    {
        return $this->belongsToMany(WardrobeItem::class, 'users_wardrobe', 'user_id', 'wardrobe_item_id');
    }

    public function liked_looks()
    {
        return $this->belongsToMany(Look::class, 'liked_looks', 'user_id', 'look_id');
    }

    public function disliked_looks()
    {
        return $this->belongsToMany(Look::class, 'disliked_looks', 'user_id', 'look_id');
    }
}
