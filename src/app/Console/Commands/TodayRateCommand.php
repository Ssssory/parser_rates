<?php

namespace App\Console\Commands;

use App\Classes\Parser;
use App\Services\RateService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TodayRateCommand extends Command
{

    public function __construct(
        private Parser $parser,
        private RateService $rateService
    ) 
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:today-rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gat today rate';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();
        $xml = $this->parser->getDayData($today->format("d.m.Y"));
        if (!$xml) {
            return;
        }
        $dto = $this->rateService->parseXml($xml);
        $dto->history_date = $today;

        $isSaved = $this->rateService->saveRate($dto);
        if ($isSaved) {
            echo 'save today rate' . PHP_EOL;
        }else{
            echo 'already exist' . PHP_EOL;
        }
    }
}
