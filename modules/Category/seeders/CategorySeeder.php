<?php

namespace Modules\Category\seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $count = DB::table('categories')->count();
        if ($count<3){
            for ($i = 0; $i < 20; $i++) {
                $name = $faker->name();
                DB::table('categories')->insert([
                    'name' => $name,
                    'slug'=> slug($name),
                    'parent_id' => 2,
                    'created_at' => $faker->dateTime(),
                    'updated_at' => $faker->dateTime()
                ]);
            }
        }
    }
}
