<?php

namespace App\Models;

use App\Models\PostBI;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeBI extends Model
{
    use HasFactory;

    public function postBI(){
        return $this->belongsTo(PostBI::class);
    }
}
