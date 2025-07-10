<?php

namespace Modules\Booking\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Booking\Models\Booking;

class StoreBookingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'resource_id' => ['required', 'exists:resources,id'],
            'user_id' => ['required', 'exists:users,id'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date', 'after:start_time'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $exists = Booking::query()->where('resource_id', $this->get('resource_id'))
                ->where('start_time', '<', $this->get('start_time'))
                ->where('end_time', '>', $this->get('end_time'))
                ->exists();

            if ($exists) {
                $validator->errors()->add(
                    'start_time',
                    'Resource is already booked for this time range.'
                );
            }
        });
    }
}
