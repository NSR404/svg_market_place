<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\PurchasedResource;
use App\Http\Resources\V2\PurchaseHistoryMiniCollection;
use App\Http\Resources\V2\PurchaseHistoryCollection;
use App\Http\Resources\V2\PurchaseHistoryItemsCollection;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\SvgOrder;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PurchaseHistoryController extends Controller
{
    public function index(Request $request)
    {
        $order_query = SvgOrder::query();
        if ($request->type != "" || $request->type != null) {
            $order_query->where('type', $request->type);
        }
        if ($request->status != "" || $request->status != null) {
            $status = $request->status;
            $order_query->where('status', $request->status);
        }
        return new PurchaseHistoryMiniCollection($order_query->where('user_id', auth()->user()->id)->latest()->paginate(5));
    }

    public function details($id)
    {
        $order_detail = SvgOrder::where('id', $id)->where('user_id', auth()->user()->id)->get();
        // $order_query = auth()->user()->orders->where('id', $id);

        // return new PurchaseHistoryCollection($order_query->get());
        return new PurchaseHistoryCollection($order_detail);
    }

    public function items($id)
    {
        $order_detail = SvgOrder::where('id', $id)->where('user_id', auth()->user()->id)->get();
        // $order_query = auth()->user()->orders->where('id', $id);

        // return new PurchaseHistoryCollection($order_query->get());
        return new PurchaseHistoryCollection($order_detail);
    }

    public function digital_purchased_list()
    {
        $order_detail_products = Product::query()
            ->where('digital', 1)
            ->whereHas('orderDetails', function ($query) {
                $query->whereHas('order', function ($q) {
                    $q->where('payment_status', 'paid');
                    $q->where('user_id', auth()->id());
                });
            })->paginate(15);
        // $order_detail_products = OrderDetail::whereHas('order', function ($q) {
        //     $q->where('payment_status', 'paid');
        //     $q->where('user_id', auth()->id());
        // })->with(['product' => function ($query) {
        //     $query->where('digital', 1);
        // }])
        //     ->paginate(1);

        //   $products = Product::with(['orderDetails', 'orderDetails.order' => function($q) {
        //          $q->where('payment_status', 'paid');
        //          $q->where('user_id', auth()->id());
        //     }])
        //     ->where('digital', 1)
        //     ->paginate(15);

        // dd($order_detail_products);

        return PurchasedResource::collection($order_detail_products);
    }
}
