<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'business_name' => 'required',
            'business_type' => 'required',
            'bkash_token' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'business_name.required' => 'Your Busimess Name is Required',
            'business_type.required' => 'Please Tell Us Your Business Type eg: Real Estate, Furniture etc',
            'bkash_token.required'  => 'Put The Bkash Payment Token Here To Verify Your Payment',
        ];
    }
}
