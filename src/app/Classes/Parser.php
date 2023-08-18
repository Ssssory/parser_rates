<?php

namespace App\Classes;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Log\Logger;
use GuzzleHttp\Psr7\Response as GuzzleResponce;

final class Parser
{
    private const URL = "http://www.cbr.ru/scripts/XML_daily.asp?";

    public function __construct(
        private Client $client,
        private LoggerInterface $log
    ) {}

    private function getUrl(string $date): string
    {
        return self::URL . http_build_query([
            "date_req" => $date
        ]);
    }

    private function getHeaders()
    {
        return [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36',
                'Accept'     => 'application/xml'
            ]
        ];
    }

    /**
     * @param string $date
     * @return string
     */
    public function getDayData(string $date): string
    {
        try {
            /* @var GuzzleResponce $responce */
            $responce = $this->client->get($this->getUrl($date),$this->getHeaders());
            if ($code = $responce->getStatusCode() !== Response::HTTP_OK) {
                $this->log->warning('Check answer from cbr', ['code' => $code]);
            }

            return $responce->getBody()->getContents();

        } catch (\Throwable $th) {
            $this->log->critical('Parser problem',['message' => $th->getMessage()]);
        }
        return '';
    }
}
