<?php

namespace App\Models;

use App\Models\PostBI;
use App\Models\User;
use App\Models\Player;
use App\Models\Game;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function postBI(){
        return $this->belongsTo(PostBI::class);
    }

    public function players(){
        return $this->hasMany(Player::class);
    }

    public function games(){
        return $this->hasMany(Game::class);
    }

}