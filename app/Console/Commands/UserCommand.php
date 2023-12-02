<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
class UserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:user-create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
            $user = new User();
            $user->name = 'Nguyễn Minh Hiếu'.rand(1,20);
            $user->email = 'email'.rand(1,20).'@gmail.com';
            $user->password = 'password'.rand(1,20);
            $user->save();
            $this->info('User Created '.$user->id);
    }
}
