<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlazoRequest extends FormRequest
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
        return [
            'plazo'=>'required|numeric',
            'descripcion'=>'required',
            'tasa_normal'=>'required|numeric',
            'tasa_puntual'=>'required|numeric'
        ];
    }
}
