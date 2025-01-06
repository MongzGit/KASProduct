<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\User;
use App\Models\Likes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostBI extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function commentBIs(){
        return $this->hasMany(CommentBI::class);
    }
    public function likeBIs(){
        return $this->hasMany(LikeBI::class);
    }

    public function teams(){
        return $this->hasMany(Team::class);
    }
}
