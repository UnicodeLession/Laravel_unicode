<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Xác định xem người dùng có thể xem bất kỳ mô hình nào không.
     * tức là cả view, add, edit, delete
     * nếu dưới return false thì tất cả sẽ k đc phép truy cập
     */
    public function viewAny(User $user): bool
    {
        $roleJson = $user->group->permissions;
        // cho ai có khả năng xem
        if(!empty($roleJson)) {
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'posts');
            return $check;
        }
        return false;
    }

    /**
     * Xác định xem người dùng có thể xem mô hình hay không.
     */
    public function view(User $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $roleJson = $user->group->permissions;
        // cho ai có khả năng thêm
        if(!empty($roleJson)) {
            $roleArr = json_decode($roleJson, true);
            $check = isRole($roleArr, 'posts', 'add');
            return $check;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.\
     * ai là người đăng bài mới được sửa
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        //
    }
}
