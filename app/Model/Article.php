<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded=[];


    public function nav()
    {
        return $this->belongsTo(Nav::class,'cid','id');
    }
}
