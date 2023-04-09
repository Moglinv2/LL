<?php

namespace App\Console\Commands;

use App\Models\LotteryNumber;
use Illuminate\Console\Command;

class GenerateLotteryTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lottery:generate';

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

        $lottery_numbers = LotteryNumber::GenerateNumbers();
        $lottery_numbers->save();

        return 0;
    }
}
