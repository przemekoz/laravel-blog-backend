<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Element extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//        return [
//            'city_id' => 'required|integer|exists:cities,id',
//            'address' => 'required'
//        ];
        
        return [
            'title' => 'required',
        ];
    }
}
