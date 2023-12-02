<?php

namespace App\Console;

use App\Jobs\SendWelcomeEmail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\User;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
//         $schedule->command('inspire')->everyMinute()->appendOutputTo('danh-ngon.txt');
//         $schedule->call(function () {
//            $user = new User();
//            $user->name = 'Nguyễn Minh Hiếu'.rand(1,20);
//            $user->email = 'email'.rand(1,20).'@gmail.com';
//            $user->password = 'password'.rand(1,20);
//            $user->save();
//         })->everyMinute();

//        $schedule->job(new SendWelcomeEmail)->everyFiveMinutes();

        $schedule->command('user:create')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
