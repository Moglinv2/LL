<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserFixCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (User::lazy() as $user) {
            $user->fixBalance();
            $user->fixProfit();
        }
        return 0;
    }
}
