<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;

class Notification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::first();

        $user->notify("hello");

        // foreach($user as $u)
        // {
        //     if($u->reminder[0])
        //     {
        //         $u->notify("Reminder at : " . $u->reminder[0]->date . " - " . $u->reminder[0]->time);
        //     }

        //     // foreach($u->reminder as $r)
        //     // {
        //     // }
        // }
    }
}
