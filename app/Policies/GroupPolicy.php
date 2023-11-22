<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GroupPolicy
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
    public function view(User $user, Group $group): bool
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
            $check = isRole($roleArr, 'groups', 'add');
            return $check;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Group $group)
    {
        // Chỉ có người đăng và các thành viên của group Admin mới có quyền sửa
        $adminGroupId = $group->where('name', 'Administrator')->first()->id;
        return ($user->id === $group->user_id || $user->group_id === $adminGroupId);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Group $group): bool
    {
        // Chỉ có người đăng mới có quyền xoá
        return ($user->id === $group->user_id );
    }
    public function permission(User $user, Group $group){
        return ($user->id === $group->user_id || $group->user_id === $user->user_id);
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Group $group): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Group $group): bool
    {
        //
    }
}
