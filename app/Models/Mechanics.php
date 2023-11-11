<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Cars;
use App\Models\Owners;
class Mechanics extends Model
{
    use HasFactory;
    protected $table = 'mechanics';

    function carOwner()
    {
        // Quan hệ Has One Through là quan hệ 1-1 nhưng sẽ liên kết thông qua Model khác
        return $this->hasOneThrough(
            Owners::class, //Model muốn liên kết tới
            Cars::class, //Model trung gian
            'mechanic_id', // khóa ngoại của table trung gian
            'car_id', // Khóa ngoại của table muốn liên kết với
            'id', // khóa chính table hiện tại
            'id' // khóa chính table trung gian
        );
    }
}
