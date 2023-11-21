<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
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
            $check = isRole($roleArr, 'users', 'add');
            return $check;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        $userId = Auth::user()->id;
        return ($userId === $model->id || $userId ===  $model->user_id);
        // $user = Auth::user();
        /**
         * Có 2 trường hợp ra true:
         1. chính thằng đang đăng nhập
         2. thằng đang đăng nhập tạo ra user đó (đang đăng nhập có id = user_id của đứa muốn sửa)
        */

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->id ===  $model->user_id; //1 cái là user đăng nhập | 1 cái là tài nguyên?
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        //
    }
}
