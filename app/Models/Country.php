<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Posts;
use App\Models\User;

class Country extends Model
{
    use HasFactory;
    protected $table = 'country';

    function posts()
    {
        // từ country tìm ra posts
        return $this->hasManyThrough(
            Posts::class, // model muốn liên kết
            User::class, //model trung gian
            'country_id', // khóa ngoại của model muốn liên kết
            'user_id',
            'id',
            'id'
        );
    }
}
