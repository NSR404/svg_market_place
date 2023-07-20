<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UserEmailRequest extends BaseBackendRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'      =>      'nullable',
            'email'     =>       'required|email|unique:user_emails',
            'group_id'  =>       'required',
        ];
    }
}
