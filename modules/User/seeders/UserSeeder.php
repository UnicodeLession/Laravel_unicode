<?php

namespace Modules\User\seeders;

use Illuminate\Database\Seeder;
use Modules\User\src\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $count = DB::table('users')->count();
        if ($count<3){
            for ($i = 0; $i < 20; $i++) {
                DB::table('users')->insert([
                    'name' => $faker->name(),
                    'email'=> $faker->safeEmail(),
                    'group_id' => 2,
                    'password' =>Hash::make('11111'),
                    'created_at' => $faker->dateTime(),
                    'updated_at' => $faker->dateTime()
                ]);
            }
        }
    }
}
