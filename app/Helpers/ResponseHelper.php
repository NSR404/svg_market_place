<?php
namespace App\Helpers;

class ResponseHelper
{
    /**
     * General Success message
     */
        static function getSuccessMessage()
        {
            return __('custom.response_messages.Success');
        }

    /**
     * General Error message
     */
        static  function getErrorMessage()
            {
                return __('custom.response_messages.error');
            }


    /**
     * Create General Response Json
     */
        static function generateResponse($status , $redirect = null)
        {
                return [
                    'status'    =>   $status,
                    'messsage'  =>  $status ? self::getSuccessMessage() : self::getErrorMessage(),
                    'redirect'  =>  $redirect ? route($redirect) : null,
                ];
        }

}
