<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['string'],
            'name' =>  ['string'],
            'phone' => ['string'],
            'email' =>  ['string'],
            'commercial_number' =>  ['string'],
            'address' => ['string'],
            'indoor_cameras' =>  ['numeric'],
            'outdoor_cameras' =>  ['numeric'],
            'storage_device' =>  ['string'],
            'period_of_record' =>  ['string'],
            'show_screens' =>  ['numeric'],
            'camera_type' =>  ['string'],
            'contract_date' =>  ['string'],
            'expiry_date' => ['string'],
            'price' => ['numeric'],
            'vat' => ['numeric'],
            'discount' => ['numeric'],
            'total_price' => ['numeric'],
            'is_paid' => ['boolean']
        ];
    }
}
