<?php

namespace App\Http\Resources\V2;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PurchaseHistoryMiniCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id' => $data->id,
                    'code' => $data->code,
                    'user_id' => intval($data->user_id),
                    'status' => ucwords(str_replace('_', ' ', $data->status)) ,
                    // 'payment_status' => $data->payment_status,
                    // 'payment_status_string' => ucwords(str_replace('_', ' ', $data->payment_status)),
                    'type' => $data->type,
                    // 'delivery_status_string' => $data->delivery_status == 'pending'? "Order Placed" : ucwords(str_replace('_', ' ',  $data->delivery_status)),
                    // 'grand_total' => format_price($data->grand_total) ,
                    'date' => Carbon::createFromTimestamp($data->created_at->timestamp)->format('d-m-Y'),
                    'links' => [
                        'details' => ''
                    ]
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
