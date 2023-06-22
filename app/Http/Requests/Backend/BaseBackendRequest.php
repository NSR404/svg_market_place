<?php

namespace App\Http\Requests\Backend;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class BaseBackendRequest extends FormRequest
{
protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff');
    }
}
