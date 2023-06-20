<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class ProductRequest extends FormRequest
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
        $rules = [];

        $rules['name']          = 'required|max:255';
        $rules['category_id']   = 'required';
        $rules['min_qty' ]      = 'required|numeric';
        $rules['unit_price']    = 'required|numeric';
        if ($this->get('discount_type') == 'amount') {
            $rules['discount' ] = 'required|numeric|lt:unit_price';
        }else {
            $rules['discount' ] = 'required|numeric|lt:100';
        }
        $rules['current_stock'] = 'required|numeric';

        return $rules;
    }
}
