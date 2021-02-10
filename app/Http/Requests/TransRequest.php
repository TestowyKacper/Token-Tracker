<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransRequest extends FormRequest
{
    protected $redirectRoute= 'portfel';

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
            'edit_cena'=>'required|numeric|gt:0'
        ];
           
    }
    public function messages()
{
    return [
        'edit_cena.min:0' => 'Daj >0'
     
    ];
}
}
