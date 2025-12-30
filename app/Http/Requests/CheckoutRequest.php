<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

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
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Convert date format if needed (from dd/MM/yyyy to YYYY-MM-DD)
        if ($this->has('tour_start_date') && $this->tour_start_date) {
            try {
                // Parse date without timezone, just as a date string
                $date = Carbon::createFromFormat('Y-m-d', $this->tour_start_date);
                if (!$date) {
                    // Try other formats
                    $date = Carbon::parse($this->tour_start_date);
                }
                // Format as YYYY-MM-DD without time
                $this->merge([
                    'tour_start_date' => $date->format('Y-m-d')
                ]);
            } catch (\Exception $e) {
                // If parsing fails, keep original value
            }
        }
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
            'customer_country' => 'required|string|max:100',
            'tour_start_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    try {
                        // Parse date as YYYY-MM-DD format (date only, no time)
                        $date = Carbon::createFromFormat('Y-m-d', $value)->startOfDay();
                        if (!$date) {
                            // Fallback to parse
                            $date = Carbon::parse($value)->startOfDay();
                        }
                        
                        // Get today's date at start of day (same timezone)
                        $today = Carbon::today()->startOfDay();
                        
                        // Compare only the date part (year, month, day)
                        if ($date->format('Y-m-d') < $today->format('Y-m-d')) {
                            $fail('The tour start date must be today or a future date.');
                        }
                    } catch (\Exception $e) {
                        $fail('The tour start date is not a valid date.');
                    }
                },
            ],
            'adults_count' => 'required|integer|min:1',
            'children_count' => 'nullable|integer|min:0',
            'outbound_bus_service_id' => 'nullable|exists:bus_services,id',
            'return_bus_service_id' => 'nullable|exists:bus_services,id',
            'gift_id' => 'nullable|exists:gifts,id',
            'accommodation_id' => 'nullable|exists:accommodations,id',
            'total_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'additional_passengers' => 'nullable|array',
            'additional_passengers.*.name' => 'required|string|max:255',
            'additional_passengers.*.country' => 'required|string|max:255',
        ];
    }
}
