<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Look extends Model
{
    use HasFactory;

    protected $table = "looks";

    protected $fillable = [
        'name', 'slug', 'image', 'desc', 'created_at', 'updated_at', 'deleted_at'
    ];

    public $timestamps = true;


    public function topics() {
        return $this->belongsToMany(Look::class, 'topic_looks', 'look_id', 'topic_id');
    }
}
