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
        static function generateResponse($status , $redirect = null , $modal_to_hide  = null , $row_to_delete = null)
        {
                return [
                    'status'             =>   $status,
                    'message'            =>  $status ? self::getSuccessMessage() : self::getErrorMessage(),
                    'redirect'           =>  $redirect ? route($redirect) : null,
                    'modal_to_hide'      =>  $modal_to_hide,
                    'row_to_delete'      =>  $row_to_delete
                ];
        }

}
