<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function generateResponse($status , $redirect = null) :array
    {
            return [
                'status'    =>   $status,
                'messsage'  =>  $status ? $this->getSuccessMessage() : $this->getErrorMessage(),
                'redirect'  =>  route($redirect),
            ];
    }

    public function getSuccessMessage()
    {
        return __('custom.response_messages.Success');
    }

    public function getErrorMessage()
    {
        return __('custom.response_messages.error');
    }
}
