<?php

namespace App\Http\Requests\Backend\Branch;

use App\Http\Requests\Backend\BaseBackendRequest;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreateBranchReqeust extends BaseBackendRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'                  =>  'required|string',
            'address'               =>  'required',
            'email'                 =>   'required|email',
            'google_map'                 =>   'required',
            'phone_numbers'         =>  'required|array',
            'phone_numbers.*'       =>  'required'
        ];
    }
}
