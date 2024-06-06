<?php

namespace App\Models;

use App\Models\PostBI;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentBI extends Model
{
    use HasFactory;

    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function postBI(){
        return $this->belongsTo(PostBI::class);
    }
}
