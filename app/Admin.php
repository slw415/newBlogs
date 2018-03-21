<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password','mobile','birthday','imgfile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    //判断用户是否具某个角色
    public function hasRole($role)
    {
        if(is_string($role))
        {
            return $this->roles->contains('name',$role);
        }
            return !! $role->intersect($this->roles)->count();

    }
    //头像存储
    public function saveFile($file)
    {
        //图片规定后缀
        $fileTypes = ["png", "jpg", "gif","jpeg"];
        // 获取图片后缀
        $extension = $file->extension();
        //是否是要求的图片
        $isInFileType = in_array($extension,$fileTypes);
        if ($isInFileType)
        {
            //新的文件名（保证不重叠）
            $newName=date('YmdHis').mt_rand(100,900).'.'.$extension;
            //存储到photo目录
            $store_result = $file->storeAs('', $newName, ['disk'=>'photo']);
            return $newName;
        }else{
            return back()->withErrors( '图片格式不符合要求，请重新添加');
        }

    }
}
