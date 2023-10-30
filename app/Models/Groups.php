<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Groups extends Model
{
    use HasFactory;
    protected $table = 'groups';

    function getAll()
    {
        $groups = DB::table($this->table)
        ->orderBy('id', 'ASC')
        ->get();
        return $groups;
    }
}
