<?php

namespace App\Providers;

use App\Admin;
use App\Permission;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        foreach ($this->getPermissions() as $permission)
        {
            $permissions=$permission->roles;

            $gate->define($permission->name,function (Admin $user) use ($permissions){

                return $user->hasRole($permissions);
            } );
        }

        //
    }
    protected function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
