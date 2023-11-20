<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;
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
        $faker = Factory::create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $groupId = DB::table('groups')->insertGetId(
            [
                'name'=>'Administrator',
                'user_id'=>0,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]
        );
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        if ($groupId>0){
            $userId = DB::table('users')->insertGetId([
                'name'=>'Nguyễn Minh Hiếu',
                'username'=>'hieunm3103',
                'email'=>'hieunm3103@gmail.com',
                'password'=>Hash::make('111111'),
                'group_id'=>$groupId,
                'user_id'=>0,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]);
            if ($userId>0){
                for ($i = 0; $i < 5; $i++) {
                    DB::table('posts')->insertGetId([
                        'title' => $faker->sentence(),
                        'content'=> $faker->paragraph(),
                        'user_id' => $userId,
                        'created_at' => $faker->dateTime(),
                        'updated_at' => $faker->dateTime()
                    ]);
                }
            }
        }
    }
}
