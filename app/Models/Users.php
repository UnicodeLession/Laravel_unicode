<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;
    protected $table ='users';
    function getAllUsers()
    {
        $users =  DB::select('SELECT * FROM users ORDER BY create_at DESC ');
        return $users;
    }

    function addUser($data)
    {
        $data = $data;
        DB::insert('INSERT INTO users (name, email, create_at) values (?, ?, ?)', $data);
    }
}
