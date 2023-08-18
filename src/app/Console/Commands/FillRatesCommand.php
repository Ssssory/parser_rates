<?php

namespace App\Console\Commands;

use App\Jobs\DayRateJob;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FillRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get rates from last 180 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();
        $lastDate = Carbon::now()->subDays(180);
        while($lastDate->format("d.m.Y") != $today->format("d.m.Y")){
            DayRateJob::dispatch($today);

            $today->subDay();
        }
    }
}
