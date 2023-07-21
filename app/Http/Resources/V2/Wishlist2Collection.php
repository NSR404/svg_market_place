<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Wishlist2Collection extends ResourceCollection
{
    public function toArray($request)
    {
        return  $this->collection->map(function($data) {
            return [
                'id' => (integer) $data->id,
                'product' => [
                    'id' => $data->product->id,
                    'name' => $data->product->name,
                    'thumbnail_image' => uploaded_asset($data->product->thumbnail_img),
                    'base_price' => format_price(home_base_price($data->product, false)) ,
                    'rating' => (double) $data->product->rating,
                ]
            ];
        });
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
