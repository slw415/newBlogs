<?php

namespace App;

use App\Model\Comment;
use App\Model\Message;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','ip','imgfile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    // 关联到comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    // 关联到message
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
