<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * dùng Faker : https://github.com/fzaninotto/Faker
     */
    public function run(): void
    {
        //
        $faker = Factory::create();
        $count = DB::table('posts')->count();
        if ($count<3){
            for ($i = 0; $i < 5; $i++) {
                DB::table('posts')->insert([
                    'title' => $faker->sentence(),
                    'user_id' => 100,
                    'content'=> $faker->paragraph(),
                    'status' => 1,
                    'published_at' => $faker->dateTime(),
                    'created_at' => $faker->dateTime(),
                    'updated_at' => $faker->dateTime()
                ]);
            }
        }

    }
}
