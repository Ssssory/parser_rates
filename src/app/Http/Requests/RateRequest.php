<?php

namespace App\Http\Requests;

use App\Dto\RateRequestDto;
use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'required|string',
            'currency' => 'required|string|size:3',
            'currency_from' => 'string|size:3'
        ];
    }

    public function data()
    {
        $data = $this->validated();

        return new RateRequestDto($data);
    }
}
