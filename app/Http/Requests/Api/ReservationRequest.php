<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class ReservationRequest extends FormRequest
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
        $rules = [
            'data' => 'required|array',
            'data.type' => 'required|in:reservation',
            'data.attributes' => 'required|array',
            'data.attributes.reservation_user_id' => 'required|string',
            'data.attributes.reservation_room' => 'required|string',
            'data.attributes.reservation_price' => 'required|integer',
            'data.attributes.reservation_num_of_rooms' => 'required|integer',
            'data.attributes.reservation_num_of_persons' => 'required|integer',
            'data.attributes.reservation_num_of_children' => 'required|integer',
            'data.attributes.reservation_open_buffet' => 'required|string',
            'data.attributes.reservation_from_date' => 'required|string',
            'data.attributes.reservation_stay_days' => 'required|integer',
        ];
        return $this->mergeRulesInMethod($rules);
    }

    public function mergeRulesInMethod(array $rules)
    {
        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $rule = [
                'data.reservation_id' => 'required|string'
            ];
            $rules = array_merge($rules, $rule);
        }
        return $rules;
    }
}
