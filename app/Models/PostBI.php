<?php

namespace App\Models;

use App\Models\CommentBI;
use App\Models\User;
use App\Models\LikeBI;
use App\Models\Team;
use App\Models\Component;

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

    public function components(){
        return $this->hasMany(Component::class);
    }
}
