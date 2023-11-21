<?php

namespace App\Providers;

use App\Models\Posts;
use App\Models\User;
use App\Models\Modules;
use App\Models\Groups;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

//Policy
use App\Policies\PostPolicy;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
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
            2.
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
            }
        }
    }
}
