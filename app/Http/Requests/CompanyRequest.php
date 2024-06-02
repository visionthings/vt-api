<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'user_id' => ['numeric', 'required'],
            'company_name' => ['string', 'required'],
            'company_type' => ['string', 'required'],
            'commercial_number' => ['string', 'required'],
            'building_number' => ['string', 'required'],
            'street' => ['string', 'required'],
            'district' => ['string', 'required'],
            'city' => ['string', 'required'],
        ];
    }
}
