<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $table = 'topics';

    protected $fillable = [
        'name', 'slug', 'desc', 'created_at', 'updated_at', 'deleted_at'
    ];

    public $timestamps = true;


    public function users() {
        return $this->belongsToMany(User::class, 'watched_topics', 'topic_id', 'user_id');
    }

    public function looks() {
        return $this->belongsToMany(Look::class, 'topic_looks', 'topic_id', 'look_id');
    }
}
