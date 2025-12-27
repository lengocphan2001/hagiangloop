<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusServiceRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'type' => 'required|in:vip_cabin,luxury_bus,limousine_bus',
            'departure_time' => 'required|string|max:50',
            'pick_up_location' => 'required|string|max:500',
            'price' => 'required|numeric|min:0',
            'is_recommended' => 'boolean',
            'starting_point' => 'nullable|string|max:255',
            'return_destination' => 'nullable|string|max:255',
            'direction' => 'required|in:outbound,return',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ];
    }
}
