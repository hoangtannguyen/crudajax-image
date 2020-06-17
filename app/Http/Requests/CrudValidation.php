<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrudValidation extends FormRequest
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
            'first_name' => 'required | string | min:2 | max:15 | regex:/\D/',
            'last_name' => 'required | string |min:2 | max:15 | regex:/\D/ ',
        ];
    }

    public function messages()
    {
        $messages = [
            'first_name.required' => 'Nhập chữ đi bố',
            'first_name.min'    => 'Nhập ít thế',
            'first_name.max'    => 'Nhập nhiều lên',
            'first_name.regex'    => 'Không nhập số',


            'last_name.required' => 'Nhập chữ đi bố',
            'last_name.min'    => 'Nhập ít thế',
            'last_name.max'    => 'Nhập nhiều lên',
            'last_name.regex'    => 'Không nhập số',


        ];

        return $messages;
    }


}
