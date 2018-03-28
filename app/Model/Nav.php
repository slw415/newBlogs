<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    protected $guarded=[];

    public function tree()
    {
        $navs=$this::get()->toArray();
        return $this->getTree($navs);
    }
    public function getTree($data,$pid=0)
    {
         $arr=[];
         foreach ($data as $key => $v)
         {

             if($v['pid']==$pid)
             {
                 $arr[$v['id']]['con']=$v;
                 $arr[$v['id']]['son']=$this->getTree($data,$v['id']);
             }
         }
         return $arr;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * 获取对应的文章
     */
    public function articles()
    {
        return $this->hasMany(Article::class,'cid','id');
    }
}

