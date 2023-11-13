<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function randomName() {
        $firstname = array(
            'Johnathon',
            'Anthony',
            'Erasmo',
            'Raleigh',
            'Nancie',
            'Tama',
            'Camellia',
            'Augustine',
            'Christeen',
            'Luz',
            'Diego',
            'Lyndia',
            'Thomas',
            'Georgianna',
            'Leigha',
            'Alejandro',
            'Marquis',
            'Joan',
            'Stephania',
            'Elroy',
            'Zonia',
            'Buffy',
            'Sharie',
            'Blythe',
            'Gaylene',
            'Elida',
            'Randy',
            'Margarete',
            'Margarett',
            'Dion',
            'Tomi',
            'Arden',
            'Clora',
            'Laine',
            'Becki',
            'Margherita',
            'Bong',
            'Jeanice',
            'Qiana',
            'Lawanda',
            'Rebecka',
            'Maribel',
            'Tami',
            'Yuri',
            'Michele',
            'Rubi',
            'Larisa',
            'Lloyd',
            'Tyisha',
            'Samatha',
        );

        $lastname = array(
            'Mischke',
            'Serna',
            'Pingree',
            'Mcnaught',
            'Pepper',
            'Schildgen',
            'Mongold',
            'Wrona',
            'Geddes',
            'Lanz',
            'Fetzer',
            'Schroeder',
            'Block',
            'Mayoral',
            'Fleishman',
            'Roberie',
            'Latson',
            'Lupo',
            'Motsinger',
            'Drews',
            'Coby',
            'Redner',
            'Culton',
            'Howe',
            'Stoval',
            'Michaud',
            'Mote',
            'Menjivar',
            'Wiers',
            'Paris',
            'Grisby',
            'Noren',
            'Damron',
            'Kazmierczak',
            'Haslett',
            'Guillemette',
            'Buresh',
            'Center',
            'Kucera',
            'Catt',
            'Badon',
            'Grumbles',
            'Antes',
            'Byron',
            'Volkman',
            'Klemp',
            'Pekar',
            'Pecora',
            'Schewe',
            'Ramage',
        );

        $name = $firstname[rand ( 0 , count($firstname) -1)];
        $name .= ' ';
        $name .= $lastname[rand ( 0 , count($lastname) -1)];

        return $name;
    }
    public function generateEmailAddress($maxLenLocal=64, $maxLenDomain=255){
        $numeric        =  '0123456789';
        $alphabetic     = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $extras         = '.-_';
        $all            = $numeric . $alphabetic . $extras;
        $alphaNumeric   = $alphabetic . $numeric;
        $alphaNumericP  = $alphabetic . $numeric . "-";
        $randomString   = '';

        // GENERATE 1ST 4 CHARACTERS OF THE LOCAL-PART
        for ($i = 0; $i < 4; $i++) {
            $randomString .= $alphabetic[rand(0, strlen($alphabetic) - 1)];
        }
        // GENERATE A NUMBER BETWEEN 20 & 60
        $rndNum         = rand(20, $maxLenLocal-4);

        for ($i = 0; $i < $rndNum; $i++) {
            $randomString .= $all[rand(0, strlen($all) - 1)];
        }

        // ADD AN @ SYMBOL...
        $randomString .= "@";

        // GENERATE DOMAIN NAME - INITIAL 3 CHARS:
        for ($i = 0; $i < 3; $i++) {
            $randomString .= $alphabetic[rand(0, strlen($alphabetic) - 1)];
        }

        // GENERATE A NUMBER BETWEEN 15 & $maxLenDomain-7
        $rndNum2        = rand(15, $maxLenDomain-7);
        for ($i = 0; $i < $rndNum2; $i++) {
            $randomString .= $all[rand(0, strlen($all) - 1)];
        }
        // ADD AN DOT . SYMBOL...
        $randomString .= ".";

        // GENERATE TLD: 4
        for ($i = 0; $i < 4; $i++) {
            $randomString .= $alphaNumeric[rand(0, strlen($alphaNumeric) - 1)];
        }

        return $randomString;

    }
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // nếu tồn tại email trùng thì thôi
        $check = DB::table('users')->where('email', 'hieunm3103@gmail.com')->count();
        if (!$check){
            DB::table('users')->insert([
                'name' => 'Nguyễn Minh Hiếu',
                'email'=> 'hieunm3103@gmail.com',
                'group_id' => 1,
                'password' => Hash::make('111111'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        $check = DB::table('users')->where('email', 'admin@gmail.com')->count();
        if (!$check){
            DB::table('users')->insert([
                'name' => 'Administrator',
                'username' => 'admin',
                'email'=> 'admin@gmail.com',
                'group_id' => 1,
                'password' => Hash::make('111111'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        // tạo  20 bản ghi users
        $count = DB::table('users')->count();
        if ($count<1){
            for ($i = 0; $i < 2; $i++) {
                DB::table('users')->insert([
                    'name' => $this->randomName(),
                    'email'=> $this->generateEmailAddress(10, 10),
                    'group_id' => 3,
                    'password' => Hash::make('12345678'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
    }
}
