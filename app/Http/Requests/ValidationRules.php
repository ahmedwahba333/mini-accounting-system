<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidationRules extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public static function rulesItem(): array
    {
        return [
            'name' => 'required|string|min:3',
            'details' => 'required|string',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|in:SAR,EGP,USD,GBP,RUB,CNY',
        ];
    }

    public static function rulesCustomer(): array
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone_number' => 'required|numeric|regex:/^[0-9]{10,15}$/',
            'company' => 'required|string|min:3',
            'cPerson' => 'required|string|min:3',
            'address' => 'required|string|min:3',
            'country' => 'required|string|min:3',
            'city' => 'required|string|min:3',
            'state' => 'required|string|min:3',
            'posCode' => 'required|string|min:2|max:5',
        ];
    }
    public static function rulesSale(): array
    {
        return [
            'customer_id' => 'required|numeric',
            'sale_date' => 'required|date',
            'status' => 'required|in:pending,finished,rejected',
            'discount' => 'required|numeric|min:0|max:100',
            'tax' => 'required|numeric|min:0|max:100',
            'shipping_address' => 'required|string|min:5',
            'shipping_price' => 'required|numeric|min:0',
            'item_id' => 'required|array|min:1',
            'quantity' => 'required|array|min:1',
        ];
    }
}
