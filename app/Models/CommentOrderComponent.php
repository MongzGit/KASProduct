<?php

namespace App\Models;

use App\Models\CommentOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentOrderComponent extends Model
{
    use HasFactory;

    public function commentOrder(){
        return $this->belongsTo(CommentOrder::class);
    }
}
