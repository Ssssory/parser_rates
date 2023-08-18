<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateRequest;
use App\Services\RateService;
use Illuminate\Http\JsonResponse;

class RateController extends Controller
{

    public function __construct(
        private RateService $rateService
    ) 
    {}
    
    function rate(RateRequest $request) : JsonResponse
    {

        $data = $request->data();

        $rate = $this->rateService->getRate($data);

        return new JsonResponse([
            'status' => 'success',
            'body' => $rate
        ]);
    }
}
