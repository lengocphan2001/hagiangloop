<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTourRequest extends FormRequest
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
        $tour = $this->route('tour');
        $tourId = $tour ? $tour->id : null;
        
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:tours,slug,' . $tourId . '|max:255',
            'duration' => 'required|string|max:50',
            'nights' => 'required|integer|min:0',
            'days' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'detail_images' => 'nullable|array',
            'detail_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
            'days_data' => 'required|array',
            'days_data.*.day_number' => 'required|integer|min:1',
            'days_data.*.title' => 'required|string|max:255',
            'days_data.*.route' => 'nullable|string|max:255',
            'days_data.*.breakfast_time' => 'nullable|date_format:H:i',
            'days_data.*.departure_time' => 'nullable|date_format:H:i',
            'days_data.*.notes' => 'nullable|string',
            'days_data.*.locations' => 'required|array',
            'days_data.*.locations.*.name' => 'required|string|max:255',
            'days_data.*.locations.*.description' => 'nullable|string',
            'days_data.*.locations.*.type' => 'nullable|string|in:location,meal,accommodation',
            'days_data.*.locations.*.arrival_time' => 'nullable|date_format:H:i',
            'days_data.*.locations.*.thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'days_data.*.locations.*.detail_images' => 'nullable|array',
            'days_data.*.locations.*.detail_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tour_types' => 'nullable|array',
            'tour_types.*.id' => 'nullable|exists:tour_types,id',
            'tour_types.*.name' => 'required|string|max:255',
            'tour_types.*.price' => 'required|numeric|min:0',
            'tour_types.*.is_active' => 'boolean',
            'tour_types.*.sort_order' => 'nullable|integer',
        ];
    }
}
