<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest implements MergeRulesInterface
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
            'room_number' => 'required|unique:rooms,room_number',
            'description' => 'required',
            'category_id' => 'required'
        ];

        return $this->mergeRules($rules);
    }


    public function mergeRules(array $rules): array
    {
        if ($this->method === 'PUT' || $this->method === 'PATCH') {
            $rules = array_merge($rules, ['room_id' => 'required']);
        }
        return $rules;
    }
}
