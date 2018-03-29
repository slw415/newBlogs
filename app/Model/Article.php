<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded=[];

// 关联到User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function nav()
    {
        return $this->belongsTo(Nav::class,'cid','id');
    }
    // 关联到comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
