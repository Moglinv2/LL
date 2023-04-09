<?php

namespace App\Observers;

use App\Models\LotteryTicket;

class LotteryTicketObserver
{
    /**
     * Handle the LotteryTicket "updated" event.
     *
     * @param  \App\Models\LotteryTicket  $lotteryTicket
     * @return void
     */
    public function updated(LotteryTicket $lotteryTicket)
    {
        $lotteryTicket->user()->fixProfit();
    }
}
