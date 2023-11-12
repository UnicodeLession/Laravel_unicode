<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
// do khi chạy câu lệnh trong terminal với seed thì chỉ chạy ở file này
// nên bất cứ class nào được use ở các seeder khác cũng phải use ở đây

//cách 1: `php artisan db:seed --class=UsersSeeder`
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cách 2: gọi câu lệnh tổng hợp `php artisan db:seed`
        $this->call(UsersSeeder::class);
        $this->call(GroupsSeeder::class);
    }
}
