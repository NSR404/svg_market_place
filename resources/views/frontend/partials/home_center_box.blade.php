@php
    if (auth()->user() != null) {
        $user_id = Auth::user()->id;
        $cart = \App\Models\Cart::where('user_id', $user_id)->get();
    } else {
        $temp_user_id = Session()->get('temp_user_id');
        if ($temp_user_id) {
            $cart = \App\Models\Cart::where('temp_user_id', $temp_user_id)->get();
        }
    }

    $cart_added = [];
    if (isset($cart) && count($cart) > 0) {
        $cart_added = $cart->pluck('product_id')->toArray();
    }
@endphp
<div class="div_img_with_cart">
    <a href="{{ route('product', $product->slug) }}">
        <img class="lazyload   has-transition" src="{{ static_asset('assets/img/placeholder.jpg') }}"
            data-src="{{ uploaded_asset($product->thumbnail_img) }}" alt="{{ $product->getTranslation('name') }}"
            title="{{ $product->getTranslation('name') }}" width="100%" height="83%">
    </a>
    {{--  <!-- add to cart -->  --}}
    <a class="cart-btn   h-35px aiz-p-hov-icon text-white fs-13 fw-700 d-flex flex-column   justify-content-center align-items-center  @if (in_array($product->id, $cart_added)) active @endif"
        href="javascript:void(0)"
         onclick="showAddToCartModal({{ $product->id }})">
        <span class="cart-btn-text">
            {{ translate('Add to Cart') }}
        </span>
        <br>
        <span><i class="las la-2x la-shopping-cart"></i></span>
    </a>
</div>
<a href="{{ route('product', $product->slug) }}">
    <h6 class="my-2 general_clr">{{ $product->getTranslation('name') }}</h6>
</a>
<!-- wishlisht & compare icons -->
<div class="absolute-top-right aiz-p-hov-icon">
    <a href="javascript:void(0)" class="hov-svg-white" data-placement="left" onclick="addToWishList({{ $product->id }})">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14.4" viewBox="0 0 16 14.4" class="w-sm-10">
            <g id="_51a3dbe0e593ba390ac13cba118295e4" data-name="51a3dbe0e593ba390ac13cba118295e4"
                transform="translate(-3.05 -4.178)">
                <path id="Path_32649" data-name="Path 32649"
                    d="M11.3,5.507l-.247.246L10.8,5.506A4.538,4.538,0,1,0,4.38,11.919l.247.247,6.422,6.412,6.422-6.412.247-.247A4.538,4.538,0,1,0,11.3,5.507Z"
                    transform="translate(0 0)" fill="#919199" />
                <path id="Path_32650" data-name="Path 32650"
                    d="M11.3,5.507l-.247.246L10.8,5.506A4.538,4.538,0,1,0,4.38,11.919l.247.247,6.422,6.412,6.422-6.412.247-.247A4.538,4.538,0,1,0,11.3,5.507Z"
                    transform="translate(0 0)" fill="#919199" />
            </g>
        </svg>
    </a>
    <a href="javascript:void(0)" class="hov-svg-white" data-placement="left" onclick="addToCompare({{ $product->id }})" >
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
            <path id="_9f8e765afedd47ec9e49cea83c37dfea" data-name="9f8e765afedd47ec9e49cea83c37dfea"
                d="M18.037,5.547v.8a.8.8,0,0,1-.8.8H7.221a.4.4,0,0,0-.4.4V9.216a.642.642,0,0,1-1.1.454L2.456,6.4a.643.643,0,0,1,0-.909L5.723,2.227a.642.642,0,0,1,1.1.454V4.342a.4.4,0,0,0,.4.4H17.234a.8.8,0,0,1,.8.8Zm-3.685,4.86a.642.642,0,0,0-1.1.454v1.661a.4.4,0,0,1-.4.4H2.84a.8.8,0,0,0-.8.8v.8a.8.8,0,0,0,.8.8H12.854a.4.4,0,0,1,.4.4V17.4a.642.642,0,0,0,1.1.454l3.267-3.268a.643.643,0,0,0,0-.909Z"
                transform="translate(-2.037 -2.038)" fill="#919199" />
        </svg>
    </a>
</div>
