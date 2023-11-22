<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Models\Modules;
use App\Models\Group;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

//Policy
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use App\Policies\GroupPolicy;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // khai báo Policy
        Post::class => PostPolicy::class,
        User::class => UserPolicy::class,
        Group::class => GroupPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        /**
         * users.view
            1. Lấy Danh sách module
        */
        $moduleList = Modules::all();
        if($moduleList->count() > 0){
            foreach ($moduleList as $module) {
                Gate::define($module->name, function (User $user) use ($module) {
                    $roleJson = $user->group->permissions;
                    if(!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr, $module->name);
                        return $check;
                    }
                    return false;
                });
                Gate::define($module->name.'.edit', function (User $user) use ($module) {
                    $roleJson = $user->group->permissions;
                    if(!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr, $module->name, 'edit');
                        return $check;
                    }
                    return false;
                });
                Gate::define($module->name.'.delete', function (User $user) use ($module) {
                    $roleJson = $user->group->permissions;
                    if(!empty($roleJson)) {
                        $roleArr = json_decode($roleJson, true);
                        $check = isRole($roleArr, $module->name, 'delete');
                        return $check;
                    }
                    return false;
                });
            }
        }
    }
}
