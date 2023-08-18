<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateRequest;
use App\Models\Rate;
use App\Services\RateService;
use Carbon\Carbon;
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
        $targetDay = Carbon::parse($data->date);
        if (!Rate::where('history_date', $targetDay)->exists()) {
            return new JsonResponse([
                'status' => 'error',
                'message' => 'No data for this date'
            ], JsonResponse::HTTP_NOT_FOUND);
        }

        $rate = $this->rateService->getRate($data);

        return new JsonResponse([
            'status' => 'success',
            'body' => $rate
        ]);
    }
}
