<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;
    protected $table ='users';

    function phone()
    {
        // set up relationship 1-1 và từ user truy tìm đến phone
        return $this->hasOne(
            Phone::class, // tham số đầu tiên là bảng có relationship
            'user_id', // này của table phone
            'id' // này là của table users
        );
    }

    function group()
    {
        // truy vấn ngược từ user ra group với relationship 1 group-many users
        return $this->belongsTo(
            Groups::class,
            'group_id',
            'id'
        );

    }
    function updateGroupId()
    {
        $check = DB::table($this->table)
            ->whereNull('group_id')->get();
        if(!empty($check)){
            DB::table($this->table)->whereNull('group_id')->update(['group_id'=>1]);
        };
    }

    function getAllUsers($filter, $keywords, $sortArr = null)
    {
//        $users =  DB::select('SELECT * FROM '.$this->table.' ORDER BY create_at DESC ');
        $users = DB::table($this->table)
            ->select('users.*', 'groups.name as group_name')
            ->leftJoin('groups', 'users.group_id', '=', 'groups.id');
        $orderBy = 'users.create_at';
        $orderType = 'desc';
        if(!empty($sortArr) && is_array($sortArr)){
            if(!empty($sortArr['sortBy'] && !empty($sortArr['sortType']))){
                $orderBy = $sortArr['sortBy'];
                $orderType = $sortArr['sortType'];
            }
        }
        $users = $users->orderBy($orderBy, $orderType);
        if (!empty($filter)){
            $users = $users->where($filter);
        }

        if (!empty($keywords)){
            $users = $users->where(function ($query) use ($keywords){
                $query->orWhere('users.name', 'like', '%'.$keywords.'%');
                $query->orWhere('email', 'like', '%'.$keywords.'%');
            });
        }
        $users = $users->get();

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
    function deleteUser($id)
    {
        return DB::delete("DELETE FROM $this->table WHERE id=?", [$id]);
    }

    function statementUser($sql)
    {
        // thực thi tất cả câu lệnh sql nào
        return DB::statement($sql);
    }
    // start Query Builder
    function learnQueryBuilder()
    {
        // lấy all bản ghi của table
        $list = DB::table($this->table)
            ->select('name as hovaten','email', 'id')
            ->where([['id', '>=', '2'], ['id', '<', '7']]) // lấy 2<= id < 7
            ->orWhere('id', 7) // lấy thêm id=7
            ->get(); // dd($list[0]->email);
        // lấy 1 bản ghi đầu tiên( lấy thông tin trực tiếp )
        $detail = DB::table($this->table)
            ->first(); // dd($detail->email);
        $list = DB::table($this->table)
            ->join('groups', 'users.group_id', '=', 'groups.id')
            ->select('users.*', 'groups.name as group_name')
            ->get();
    }
}
