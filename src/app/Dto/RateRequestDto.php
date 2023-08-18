<?php

namespace App\Dto;

final class RateRequestDto
{
    public ?string $date;
    public ?string $currency;
    public ?string $currency_from;

    public function __construct(array $arr ) {
        $this->date = $arr['date'];
        $this->currency = $arr['currency'];
        $this->currency_from = $arr['currency_from'] ?? 'RUR';
    }
}