<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'event_id'           => 'required|exists:events,id',
            'user_id'            => 'required|exists:users,id',
            'number_of_tickets'  => 'required|integer|min:1',
            'total_price'        => 'nullable|numeric|min:0',
            'booking_reference'  => 'nullable|string|max:255',

        ];
    }
}
