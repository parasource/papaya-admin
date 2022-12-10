<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_MODERATOR = 'moderator';

    protected $table = "staff";

    protected $fillable = [
        'name', 'email', 'password', 'role', 'banned'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function rolesList() {
        return [
            self::ROLE_ADMIN => 'Админ',
            self::ROLE_MODERATOR => 'Модератор'
        ];
    }

    public function getRole() {
        return self::rolesList()[$this->role];
    }

    public function isAdmin() {
        return $this->role == self::ROLE_ADMIN;
    }

    public function isModerator() {
        return $this->role == self::ROLE_MODERATOR;
    }

    public function ban() {
        $this->update([
            'banned' => true
        ]);
    }
}
