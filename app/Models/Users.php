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
        $users =  DB::select('SELECT * FROM '.$this->table.' ORDER BY create_at DESC ');
        return $users;
    }

    function addUser($data)
    {
        DB::insert('INSERT INTO '.$this->table.' (name, email, create_at) values (?, ?, ?)', $data);
    }

    function getDetail($id)
    {
        return DB::select('SELECT * FROM '.$this->table.' where id = ?', [$id]);
    }

    function updateUser($data,$id)
    {
        $data = array_merge($data,[$id]);
        return DB::update('UPDATE '.$this->table.' SET name =?, email=?, update_at=? where id = ?', $data);
    }
}
