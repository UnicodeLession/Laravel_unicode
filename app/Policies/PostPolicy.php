<?php

namespace App\Policies;

use App\Models\User;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    function add(){
        return false; // khi chỉnh true thì bên lists posts sẽ hiện lên thẻ a
    }
}
