<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Groups extends Model
{
    use HasFactory;
    protected $table = 'groups';

    public function users()
    {
        // quan hệ one to many | 1 group có nhiều users | từ group truy vấn đến users
        return $this->hasMany(
            Users::class,
            'group_id',
            'id'
        );
    }
    function getAll()
    {
        $groups = DB::table($this->table)
        ->orderBy('id', 'ASC')
        ->get();
        return $groups;
    }

}
