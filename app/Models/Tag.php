<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'name', 'slug', 'created_at', 'deleted_at', 'updated_at'
    ];

    public function looks()
    {
        return $this->belongsToMany(Look::class, 'look_tags', 'tag_id', 'look_id');
    }
}
