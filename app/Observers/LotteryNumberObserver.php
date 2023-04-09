<?php

namespace App\Observers;

use App\Models\LotteryNumber;
use App\Models\LotteryTicket;

class LotteryNumberObserver
{
    /**
     * Handle the LotteryNumber "created" event.
     *
     * @param  \App\Models\LotteryNumber  $lotteryNumber
     * @return void
     */
    public function created(LotteryNumber $lotteryNumber)
    {
        $tickets = LotteryTicket::Active()->get();
        $winners = [];

        foreach ($tickets as $ticket) {
            $correct_numbers = 0;
            foreach ($lotteryNumber->numbers as $number) {
                if (in_array($number, $ticket->numbers)) {
                    $correct_numbers++;
                }
            }

            switch ($correct_numbers) {
                case 4:
                    $ticket->profit = intval('system.hits_profit_4');
                    break;

                case 5:
                    $ticket->profit = intval('system.hits_profit_5');
                    break;

                case 6:
                    $ticket->profit = 0;
                    $winners[] = $ticket;
                    break;

                default:
                    $ticket->profit = 0;
                    break;
            }

            $ticket->save();
        }

        if (count($winners) > 0) {
            $winners_profit = LotteryNumber::Accumulated() / count($winners);
            foreach ($winners as $winner) {
                $winner->update([
                    'profit' => $winners_profit
                ]);
            }
        }
    }

    /**
     * Handle the LotteryNumber "updated" event.
     *
     * @param  \App\Models\LotteryNumber  $lotteryNumber
     * @return void
     */
    public function updated(LotteryNumber $lotteryNumber)
    {
        //
    }

    /**
     * Handle the LotteryNumber "deleted" event.
     *
     * @param  \App\Models\LotteryNumber  $lotteryNumber
     * @return void
     */
    public function deleted(LotteryNumber $lotteryNumber)
    {
        //
    }

    /**
     * Handle the LotteryNumber "restored" event.
     *
     * @param  \App\Models\LotteryNumber  $lotteryNumber
     * @return void
     */
    public function restored(LotteryNumber $lotteryNumber)
    {
        //
    }

    /**
     * Handle the LotteryNumber "force deleted" event.
     *
     * @param  \App\Models\LotteryNumber  $lotteryNumber
     * @return void
     */
    public function forceDeleted(LotteryNumber $lotteryNumber)
    {
        //
    }
}
