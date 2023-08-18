<?php

namespace App\Services;

use App\Dto\RateDto;
use App\Dto\RateRequestDto;
use App\Models\Rate;
use Carbon\Carbon;

final class RateService
{
    /**
     * @param RateRequestDto $dto
     * @return array
     */
    public function getRate(RateRequestDto $dto): array
    {

        $targetDay = Carbon::parse($dto->date);
        $yesterDay = Carbon::parse($dto->date)->subDay();
        $rates = Rate::whereIn('history_date',[$targetDay, $yesterDay])->get();

        $answer = $rates->mapWithKeys(function($item) use ($targetDay, $yesterDay, $dto){
            $rates = $item->only($dto->currency, $dto->currency_from);
            if ($targetDay->format('Y-m-d') == $item->history_date) {
                return ['today' => $rates];
            }
            if ($yesterDay->format('Y-m-d') == $item->history_date) {
                return ['yesterday' => $rates];
            }
        });

        if ($dto->currency_from == 'RUR') {
            $rate = $answer['today'][$dto->currency];
            $diff = $answer['yesterday'][$dto->currency] - $answer['today'][$dto->currency];
        }else{
            $crossToday = $answer['today'][$dto->currency]/ $answer['today'][$dto->currency_from];
            $crossYestrday = $answer['yesterday'][$dto->currency]/ $answer['yesterday'][$dto->currency_from];
            $diff = $crossYestrday - $crossToday;
            $rate = $crossToday;
        }

        return [
            'rate' => round( $rate, 4),
            'diff' => round( $diff, 4)
        ];
    }

    /**
     * @param string $xml
     * @return RateDto
     */
    public function parseXml(string $xml): RateDto {
        $data = simplexml_load_string($xml);
        $result = [];
        foreach ($data as $item) {
            $result[(string)$item->CharCode] = (float)str_replace(',','.',$item->Value);
        }
        return RateDto::create($result);
    }

    /**
     * @param RateDto $dto
     * @return boolean
     */
    public function saveRate(RateDto $dto): bool 
    {
        if (!Rate::where('history_date', $dto->history_date->format('Y-m-d'))->exists()) {
            Rate::create((array)$dto);
            return true;
        }
        return false;
    }
}
