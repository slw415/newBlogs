<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function permissions()
        {

            return $this->belongsToMany(Permission::class);

        }
        //给用户分配权限

    public function givePermission(Permission $permission)
        {

        return $this->permissions()->save($permission);

        }
}
