<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body', 'user_id', 'article_id'];

    // 关联到article
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    // 关联到user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
