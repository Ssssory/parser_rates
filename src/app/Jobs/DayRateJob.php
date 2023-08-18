<?php

namespace App\Jobs;

use App\Classes\Parser;
use App\Services\RateService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Log\Logger;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DayRateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Carbon $date;

    /**
     * Create a new job instance.
     */
    public function __construct(Carbon $date)
    {
        $this->date = $date;
    }

    /**
     * Execute the job.
     */
    public function handle(
        Parser $parser,
        RateService $rateService,
        Logger $logger
    ): void
    {
        $xml = $parser->getDayData($this->date->format("d.m.Y"));
        if (!$xml) {
            return;
        }
        $dto = $rateService->parseXml($xml);
        $dto->history_date = $this->date;

        $isSaved = $rateService->saveRate($dto);
        if ($isSaved) {
            $logger->info('save today rate', [$this->date->format("d.m.Y")]);
        } else {
            $logger->warning( 'already exist', [$this->date->format("d.m.Y")]);
        }
    }
}
