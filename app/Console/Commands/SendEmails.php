<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {email*: Email muốn gửi} {--Q|queue=*: Kịch hoạt hàng đợi}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email Command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        var_dump($this->argument());
//        echo $this->email->send();
    }
}
