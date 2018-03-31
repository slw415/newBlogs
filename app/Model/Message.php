<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['body', 'user_id', 'pid'];
    // 关联到user
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
