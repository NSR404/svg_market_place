<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'state_id'           =>  'nullable',
            'phone'             =>  'required|numeric',
            'country_id'        =>  'required',
            'country_code'      =>  'required',
            'name'              =>  Auth::check() ? 'nullable' : 'required',
        ];
    }
}
