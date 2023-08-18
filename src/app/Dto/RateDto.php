<?php 

namespace App\Dto;

final class RateDto
{
    public $history_date = null;
    public $AUD = null;
    public $AZN = null;
    public $GBP = null;
    public $AMD = null;
    public $BYN = null;
    public $BGN = null;
    public $BRL = null;
    public $HUF = null;
    public $VND = null;
    public $HKD = null;
    public $GEL = null;
    public $DKK = null;
    public $AED = null;
    public $USD = null;
    public $EUR = null;
    public $EGP = null;
    public $INR = null;
    public $IDR = null;
    public $KZT = null;
    public $CAD = null;
    public $QAR = null;
    public $KGS = null;
    public $CNY = null;
    public $MDL = null;
    public $NZD = null;
    public $NOK = null;
    public $PLN = null;
    public $RON = null;
    public $XDR = null;
    public $SGD = null;
    public $TJS = null;
    public $THB = null;
    public $TRY = null;
    public $TMT = null;
    public $UZS = null;
    public $UAH = null;
    public $CZK = null;
    public $SEK = null;
    public $CHF = null;
    public $RSD = null;
    public $ZAR = null;
    public $KRW = null;
    public $JPY = null;

    public static function create(array $values): self
    {
        $dto = new self();

        foreach ($values as $key => $value) {
            if (property_exists($dto, $key)) {
                $dto->$key = $value;
            }
        }

        return $dto;
    }
}
