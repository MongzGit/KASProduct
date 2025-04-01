<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostBI;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier(){
        return $this->getKey();
    }
    public function getJWTCustomClaims(){
        return [];
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function postBIs(){
        return $this->hasMany(PostBI::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function commentOrders(){
        return $this->hasMany(CommentOrder::class);
    }    

    public function teams(){
        return $this->hasMany(Team::class);
    } 

    public function players(){
        return $this->hasMany(Player::class);
    }

    public function sendPasswordResetNotification($token){

        $url = 'https://kasproducts.shop/api/reset_password?token=' . $token;//. '&email=' . urlencode($this->email);

        $this->notify(new ResetPasswordNotification($url));
    }

}
