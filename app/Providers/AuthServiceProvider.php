<?php

namespace App\Providers;

use App\Models\Posts;
use App\Models\User;
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
        // Cách 1: định nghĩa Gate
//        Gate::define('posts.add', function (User $user, Posts $posts) {
//            dd($posts);
//            // xử lý logic để xem người đấy có quyền sửa gì k?
//            // $user là thông tin user đang login
//            return true;
//        });
        //Cách 2: dùng callback tương tự: Policy <=> Controller; AuthServiceProvider<=>route
        Gate::define('posts.add', [PostPolicy::class, 'add']);

        Gate::define('posts.update', function (User $user, Posts $post) {
            // xử lý logic để xem người đấy có quyền sửa gì k?
            // $user là thông tin user đang login
            // khi người dùng trùng với id người viết bài thì mới return true và sẽ được phép update
            return $user->id === $post->user_id;
        });
    }
}
