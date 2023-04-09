<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class RefererCodeGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'referer:code';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generar Referer Code to Users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (User::where('referer_code', null)->lazy() as $user) {
            $user->update([
                'referer_code' => Str::random(8)
            ]);
        }
        return 0;
    }
}
