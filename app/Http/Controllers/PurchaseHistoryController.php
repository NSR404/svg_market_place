<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Order;
use App\Models\Upload;
use App\Models\Product;
use App\Models\SvgOrder;
use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type               =   $request->query('type');
        $search             =   $request->serach;
        $data['orders']     =   SvgOrder::query()
                                ->whereBelongsTo(Auth::user())
                                ->when($type , function($query)use($type){
                                    return $query->where('type' , $type);
                                });
        if($search)
        {
            $data['orders']     =   $data['orders']->where('code' , 'like' , '%'.$search.'%')
                                                    ->orWhereHas('products' , function($products) use($search){
                                                        $products->where('name' , 'like' , '%'.$search.'%')
                                                                ->orWhereHas('product_translation' , function($translation)use($search){
                                                                    $translation->where('name' , 'like' , '%'.$search.'%');
                                                                });
                                                    });
        }
        $data['orders'] =   $data['orders']->where('status' , '!=' , 'cancelled')->orderByDesc('created_at')->paginate(15);
        $data['type']   =   $type;
        return view('frontend.user.purchase_history', $data);
    }

    public function digital_index()
    {
        $orders = DB::table('orders')
                        ->orderBy('code', 'desc')
                        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->join('products', 'order_details.product_id', '=', 'products.id')
                        ->where('orders.user_id', Auth::user()->id)
                        ->where('products.digital', '1')
                        ->where('order_details.payment_status', 'paid')
                        ->select('order_details.id')
                        ->paginate(15);
        return view('frontend.user.digital_purchase_history', compact('orders'));
    }


    public function purchase_history_details($id)
    {
        $order = SvgOrder::query()->with('products.category')->findOrFail(decrypt($id));
        return view('frontend.user.svg_order_details_customer', compact('order'));
    }

    public function download(Request $request)
    {
        $product = Product::findOrFail(decrypt($request->id));
        $downloadable = false;
        foreach (Auth::user()->orders as $key => $order) {
            foreach ($order->orderDetails as $key => $orderDetail) {
                if ($orderDetail->product_id == $product->id && $orderDetail->payment_status == 'paid') {
                    $downloadable = true;
                    break;
                }
            }
        }
        if ($downloadable) {
            $upload = Upload::findOrFail($product->file_name);
            if (env('FILESYSTEM_DRIVER') == "s3") {
                return \Storage::disk('s3')->download($upload->file_name, $upload->file_original_name . "." . $upload->extension);
            } else {
                if (file_exists(base_path('public/' . $upload->file_name))) {
                    return response()->download(base_path('public/' . $upload->file_name));
                }
            }
        } else {
            flash(translate('You cannot download this product at this product.'))->success();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function order_cancel($id)
    {
        $order = SvgOrder::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if($order && ($order->status == 'pending')) {
            $order->status = 'cancelled';
            $order->save();
            flash(translate('Order has been canceled successfully'))->success();
        } else {
            flash(translate('Something went wrong'))->error();
        }
        return back();
    }
}
