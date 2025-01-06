<?php

namespace App\Models;

use App\Models\Team;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Player extends Model
{
    use HasFactory;

    public function team(){
        return $this->belongsTo(Team::class);
    }
}
