<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Users;

class Phone extends Model
{
    use HasFactory;

    protected $table = 'phone';
    // https://laravel.com/docs/10.x/eloquent-relationships

    function user(){
        // liên kết ngược : từ sdt tìm tới user
        return  $this->belongsTo(
            Users::class,
            'user_id',
            'id'
        );
    }
}
