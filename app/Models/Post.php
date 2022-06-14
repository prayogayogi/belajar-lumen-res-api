<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'name', "user_id", 'deskripsi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
