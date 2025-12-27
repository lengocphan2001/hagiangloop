<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'tour_id' => 'required|exists:tours,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'nullable|string|max:500',
            'tour_start_date' => 'required|date|after_or_equal:today',
            'adults_count' => 'required|integer|min:1',
            'children_count' => 'nullable|integer|min:0',
            'outbound_bus_service_id' => 'nullable|exists:bus_services,id',
            'return_bus_service_id' => 'nullable|exists:bus_services,id',
            'gift_id' => 'nullable|exists:gifts,id',
            'total_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ];
    }
}
