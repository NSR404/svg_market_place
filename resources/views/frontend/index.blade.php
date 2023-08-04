{{--  /* <!-- Link Swiper's CSS --> */  --}}
<link rel="stylesheet" href="{{ static_asset('assets/css/swiper-bundle.min.css') }}" />

@extends('frontend.layouts.app')
@push('css')
    <style>
        .custom-d-none {
            display: none !important;
        }
    </style>
@endpush
@section('content')
    <!-- Sliders & Today's deal -->
    <div class="home-banner-area mb-3" style="">
        <div class="container">
            <div class="d-flex flex-wrap position-relative">
                <div class="position-static d-none d-xl-block">
                    @include('frontend.partials.category_menu')
                </div>

                <!-- Sliders -->
                <div class="home-slider">
                    @if (get_setting('home_slider_images') != null)
                        <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-autoplay="true">
                            @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
                            @foreach ($slider_images as $key => $value)
                                <div class="carousel-box">
                                    <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
                                        <!-- Image -->
                                        <img class="d-block mw-100 img-fit overflow-hidden h-sm-auto h-md-320px h-lg-460px overflow-hidden"
                                            src="{{ uploaded_asset($slider_images[$key]) }}"
                                            alt="{{ env('APP_NAME') }} promo"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Deal -->
    @php
        $flash_deal = \App\Models\FlashDeal::where('status', 1)
            ->where('featured', 1)
            ->first();
    @endphp
    @if (
        $flash_deal != null &&
            strtotime(date('Y-m-d H:i:s')) >= $flash_deal->start_date &&
            strtotime(date('Y-m-d H:i:s')) <= $flash_deal->end_date)
        <section class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                <!-- Top Section -->
                <div class="d-flex flex-wrap mb-2 mb-md-3 align-items-baseline justify-content-between">
                    <!-- Title -->
                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                        <span class="d-inline-block">{{ translate('Flash Sale') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="24" viewBox="0 0 16 24"
                            class="ml-3">
                            <path id="Path_28795" data-name="Path 28795"
                                d="M30.953,13.695a.474.474,0,0,0-.424-.25h-4.9l3.917-7.81a.423.423,0,0,0-.028-.428.477.477,0,0,0-.4-.207H21.588a.473.473,0,0,0-.429.263L15.041,18.151a.423.423,0,0,0,.034.423.478.478,0,0,0,.4.2h4.593l-2.229,9.683a.438.438,0,0,0,.259.5.489.489,0,0,0,.571-.127L30.9,14.164a.425.425,0,0,0,.054-.469Z"
                                transform="translate(-15 -5)" fill="#fcc201" />
                        </svg>
                    </h3>
                    <!-- Links -->
                    <div>
                        <div class="text-dark d-flex align-items-center mb-0">
                            <a href="{{ route('flash-deals') }}"
                                class="veiw_btn fs-10 fs-md-12 fw-700 text-reset has-transition opacity-60 hov-opacity-100 hov-text-primary animate-underline-primary mr-3">{{ translate('View All Flash Sale') }}</a>
                            <span class=" border-left border-soft-light border-width-2 pl-3">
                                <a href="{{ route('flash-deal-details', $flash_deal->slug) }}"
                                    class="veiw_btn fs-10 fs-md-12 fw-700 text-reset has-transition opacity-60 hov-opacity-100 hov-text-primary animate-underline-primary">{{ translate('View All Products from This Flash Sale') }}</a>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Countdown for small device -->
                <div class="bg-white mb-3 d-md-none">
                    <div class="aiz-count-down-circle" end-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                </div>

                <div class="row gutters-5 gutters-md-16">
                    <!-- Flash Deals Baner & Countdown -->
                    <div class="col-xxl-4 col-lg-5 col-6 h-200px h-md-400px h-lg-475px">
                        <div class="h-100 w-100 w-xl-auto"
                            style="background-image: url('{{ uploaded_asset($flash_deal->banner) }}'); background-size: cover; background-position: center center;">
                            <div class="py-5 px-md-3 px-xl-5 d-none d-md-block">
                                <div class="bg-white">
                                    <div class="aiz-count-down-circle"
                                        end-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Flash Deals Products -->
                    <div class="col-xxl-8 col-lg-7 col-6">
                        @php
                            $flash_deals = $flash_deal->flash_deal_products->take(10);
                        @endphp
                        <div class="aiz-carousel border-top @if (count($flash_deals) > 8) border-right @endif arrow-inactive-none arrow-x-0"
                            data-items="5" data-xxl-items="5" data-xl-items="3.5" data-lg-items="3" data-md-items="2"
                            data-sm-items="2.5" data-xs-items="2" data-arrows="true" data-dots="false">
                            @php
                                $init = 0;
                                $end = 1;
                            @endphp
                            @for ($i = 0; $i < 5; $i++)
                                <div class="carousel-box  @if ($i == 0) border-left @endif">
                                    @foreach ($flash_deals as $key => $flash_deal_product)
                                        @if ($key >= $init && $key <= $end)
                                            @php
                                                $product = \App\Models\Product::find($flash_deal_product->product_id);
                                            @endphp
                                            @if ($product != null && $product->published != 0)
                                                @php
                                                    $product_url = route('product', $product->slug);
                                                    if ($product->auction_product == 1) {
                                                        $product_url = route('auction-product', $product->slug);
                                                    }
                                                @endphp
                                                <div
                                                    class="h-100px h-md-200px h-lg-auto flash-deal-item position-relative text-center border-bottom @if ($i != 4) border-right @endif has-transition hov-shadow-out z-1">
                                                    <a href="{{ $product_url }}"
                                                        class="d-block py-md-3 overflow-hidden hov-scale-img"
                                                        title="{{ $product->getTranslation('name') }}">
                                                        <!-- Image -->
                                                        <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                            class="lazyload h-60px h-md-100px h-lg-140px mw-100 mx-auto has-transition"
                                                            alt="{{ $product->getTranslation('name') }}"
                                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                        {{-- <!-- Price -->
                                                        <div
                                                            class="fs-10 fs-md-14 mt-md-3 text-center h-md-48px has-transition overflow-hidden pt-md-4 flash-deal-price">
                                                            <span
                                                                class="d-block text-primary fw-700">{{ home_discounted_base_price($product) }}</span>
                                                            @if (home_base_price($product) != home_discounted_base_price($product))
                                                                <del
                                                                    class="d-block fw-400 text-secondary">{{ home_base_price($product) }}</del>
                                                            @endif
                                                        </div> --}}
                                                    </a>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach

                                    @php
                                        $init += 2;
                                        $end += 2;
                                    @endphp
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Today's deal -->
    @if (count($todays_deal_products) > 0)
        <section class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                <!-- Banner -->
                @if (get_setting('todays_deal_banner') != null || get_setting('todays_deal_banner_small') != null)
                    <div class="overflow-hidden d-none d-md-block">
                        <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                            data-src="{{ uploaded_asset(get_setting('todays_deal_banner')) }}"
                            alt="{{ env('APP_NAME') }} promo" class="lazyload img-fit h-100 has-transition"
                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                    </div>
                    <div class="overflow-hidden d-md-none">
                        <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                            data-src="{{ get_setting('todays_deal_banner_small') != null ? uploaded_asset(get_setting('todays_deal_banner_small')) : uploaded_asset(get_setting('todays_deal_banner')) }}"
                            alt="{{ env('APP_NAME') }} promo" class="lazyload img-fit h-100 has-transition"
                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                    </div>
                @endif
                <!-- Products -->
                <div class="section_products"
                    style="background-color: {{ get_setting('todays_deal_bg_color', '#efefef') }}">
                    <div class="text-right px-4 px-xl-5 pt-2 pt-md-2 padding_t">
                        <a href="{{ route('todays-deal') }}"
                            class="fs-15 fw-700 general_clr has-transition  veiw_btn hov-text-warning">{{ translate('View All') }}</a>
                    </div>
                    <div class="c-scrollbar-light overflow-hidden p-3 pb-3 pt-2  pt-md-2">
                        <div class="h-100 d-flex flex-column justify-content-center">
                            <div class="todays-deal aiz-carousel" data-items="7" data-xxl-items="7" data-xl-items="6"
                                data-lg-items="5" data-md-items="4" data-sm-items="4" data-xs-items="4" data-arrows="true"
                                data-dots="false" data-autoplay="true" data-infinite="true">

                                @foreach ($todays_deal_products as $key => $product)
                                    <div class="carousel-box mx-sm-5">
                                        <a href="{{ route('product', $product->slug) }}"
                                            class="h-100 overflow-hidden hov-scale-img mx-auto"
                                            title="{{ $product->getTranslation('name') }}">
                                            <!-- Image -->
                                            <div class="div_img_slid img rounded-content overflow-hidden mx-2 w-lg-90">
                                                <img class="lazyload img-fit m-auto has-transition"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                    alt="{{ $product->getTranslation('name') }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                                    width="100%">
                                            </div>
                                            {{-- <h3
                                                class="fw-600 fs-16 text-truncate-2 lh-1-4 mb-0 h-35px text-center fs-mobile-9 py-3 mx-0 mb-3 ">
                                                <a href="" class="d-block text-center hov-text-primary p-0"
                                                    title="{{ $product->getTranslation('name') }}">{{ $product->getTranslation('name') }}</a>
                                            </h3> --}}
                                            <!-- Price -->
                                            <div class="fs-14 mt-3 text-center custom-d-none">
                                                <span
                                                    class="d-block text-white fw-700">{{ home_discounted_base_price($product) }}</span>
                                                @if (home_base_price($product) != home_discounted_base_price($product))
                                                    <del
                                                        class="d-block text-secondary fw-400">{{ home_base_price($product) }}</del>
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


    {{-- START   Highest Priorty Category "Usally Offers" --}}
    <div>
        @if (count($offers_category_products) > 0)
            <section class="mb-2 mb-md-3 mt-2 mt-md-3">
                <div class="container">
                    <!-- Top Section -->
                    <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                        <!-- Title -->
                        <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                            <span class="">{{ $offers_category_products->first()->category->name }}</span>
                        </h3>
                        <!-- Links -->
                        <div class="d-flex">
                            <a class="veiw_btn general_clr fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                                href="{{ route('products.category', $offers_category_products?->first()?->category?->slug) }}">{{ translate('View All') }}</a>
                        </div>
                    </div>
                    <hr />
                    <!-- Products Section -->
                    <div class="box_products">
                        <div class="row m-auto">
                            <!-- Swiper -->
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    @foreach ($offers_category_products_for_slider as $key => $product)
                                        @include('frontend.partials.product_swiper_box', [
                                            'product' => $product,
                                            'is_price_visible' => true,
                                        ])
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>

                        </div>
                    </div>
                    {{--  <!--Start offers product grid layout  -->  --}}
                    <div class="row mt-5">
                        {{--  <!--Start Box products num => 1 -->  --}}
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12 p-2 text-center">
                            <div class="row">
                                @foreach ($offers_category_products_for_grid_1 as $product)
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6 text-center mb-2 item_box">
                                        <div class="div_img_with_cart">
                                            <a href="{{ route('product', $product->slug) }}">
                                                <img class="lazyload   has-transition"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                    alt="{{ $product->getTranslation('name') }}"
                                                    title="{{ $product->getTranslation('name') }}" width="100%">
                                            </a>
                                            @if (home_base_price($product) != home_discounted_base_price($product))
                                                <span>
                                                    <del
                                                        class="fw-400 text-secondary mr-1">{{ home_base_price($product) }}</del>
                                                </span>
                                            @endif
                                            <!-- price -->
                                            <span
                                                class="fw-700 text-primary">{{ home_discounted_base_price($product) }}</span>
                                            <a href="{{ route('product', $product->slug) }}">
                                                <h6 class="my-2">{{ $product->getShowName() }} </h6>
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
                                        <!-- wishlisht & compare icons -->
                                        <div class="absolute-top-right aiz-p-hov-icon"
                                            style="margin-left:17% !important;z-index:99 !important;">
                                            <a href="javascript:void(0)" class="hov-svg-white" data-placement="left"
                                                style=""
                                                onclick="addToWishList({{ $product->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14.4"
                                                    viewBox="0 0 16 14.4" class="w-sm-10">
                                                    <g id="_51a3dbe0e593ba390ac13cba118295e4"
                                                        data-name="51a3dbe0e593ba390ac13cba118295e4"
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
                                            <a href="javascript:void(0)" class="hov-svg-white" data-placement="left"
                                                onclick="addToCompare({{ $product->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16">
                                                    <path id="_9f8e765afedd47ec9e49cea83c37dfea"
                                                        data-name="9f8e765afedd47ec9e49cea83c37dfea"
                                                        d="M18.037,5.547v.8a.8.8,0,0,1-.8.8H7.221a.4.4,0,0,0-.4.4V9.216a.642.642,0,0,1-1.1.454L2.456,6.4a.643.643,0,0,1,0-.909L5.723,2.227a.642.642,0,0,1,1.1.454V4.342a.4.4,0,0,0,.4.4H17.234a.8.8,0,0,1,.8.8Zm-3.685,4.86a.642.642,0,0,0-1.1.454v1.661a.4.4,0,0,1-.4.4H2.84a.8.8,0,0,0-.8.8v.8a.8.8,0,0,0,.8.8H12.854a.4.4,0,0,1,.4.4V17.4a.642.642,0,0,0,1.1.454l3.267-3.268a.643.643,0,0,0,0-.909Z"
                                                        transform="translate(-2.037 -2.038)" fill="#919199" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{--  <!--End Box products num => 1 -->  --}}

                        {{--  <!--Start Box products num => 2 -->  --}}
                        @foreach ($offers_category_products_for_grid_2 as $product)
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12 p-2 text-center item_box">
                                <div class="div_img_with_cart">
                                    <a href="{{ route('product', $product->slug) }}">
                                        <img class="lazyload   has-transition"
                                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                            data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                            alt="{{ $product->getTranslation('name') }}"
                                            title="{{ $product->getTranslation('name') }}" width="100%">
                                    </a>
                                    @if (home_base_price($product) != home_discounted_base_price($product))
                                        <span>
                                            <del class="fw-400 text-secondary mr-1">{{ home_base_price($product) }}</del>
                                        </span>
                                    @endif
                                    <!-- price -->
                                    <span class="fw-700 text-primary">{{ home_discounted_base_price($product) }}</span>
                                    <a href="{{ route('product', $product->slug) }}">
                                        <h6 class="my-2">{{ $product->getShowName() }} </h6>
                                    </a>
                                    {{--  <!-- add to cart -->  --}}
                                    <a class="cart-btn   h-35px aiz-p-hov-icon text-white fs-13 fw-700 d-flex flex-column   justify-content-center align-items-center  @if (in_array($product->id, $cart_added)) active @endif"
                                        href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})">
                                        <span class="cart-btn-text">
                                            {{ translate('Add to Cart') }}
                                        </span>
                                        <br>
                                        <span><i class="las la-2x la-shopping-cart"></i></span>
                                    </a>
                                </div>
                                <!-- wishlisht & compare icons -->
                                <div class="absolute-top-right aiz-p-hov-icon"
                                    style="margin-left:17% !important;z-index:99 !important;">
                                    <a href="javascript:void(0)" class="hov-svg-white" data-placement="left"
                                        onclick="addToWishList({{ $product->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14.4"
                                            viewBox="0 0 16 14.4" class="w-sm-10">
                                            <g id="_51a3dbe0e593ba390ac13cba118295e4"
                                                data-name="51a3dbe0e593ba390ac13cba118295e4"
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
                                    <a href="javascript:void(0)" class="hov-svg-white" data-placement="left"
                                        onclick="addToCompare({{ $product->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 16 16">
                                            <path id="_9f8e765afedd47ec9e49cea83c37dfea"
                                                data-name="9f8e765afedd47ec9e49cea83c37dfea"
                                                d="M18.037,5.547v.8a.8.8,0,0,1-.8.8H7.221a.4.4,0,0,0-.4.4V9.216a.642.642,0,0,1-1.1.454L2.456,6.4a.643.643,0,0,1,0-.909L5.723,2.227a.642.642,0,0,1,1.1.454V4.342a.4.4,0,0,0,.4.4H17.234a.8.8,0,0,1,.8.8Zm-3.685,4.86a.642.642,0,0,0-1.1.454v1.661a.4.4,0,0,1-.4.4H2.84a.8.8,0,0,0-.8.8v.8a.8.8,0,0,0,.8.8H12.854a.4.4,0,0,1,.4.4V17.4a.642.642,0,0,0,1.1.454l3.267-3.268a.643.643,0,0,0,0-.909Z"
                                                transform="translate(-2.037 -2.038)" fill="#919199" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        {{--  <!--End Box products num => 2 -->  --}}



                        {{--  <!--Start Box products num => 4 -->  --}}
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12 p-2">
                            <div class="row">
                                @foreach ($offers_category_products_for_grid_3 as $product)
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6 text-center mb-2 item_box">
                                        <div class="div_img_with_cart">
                                            <a href="{{ route('product', $product->slug) }}">
                                                <img class="lazyload   has-transition"
                                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                    data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                    alt="{{ $product->getTranslation('name') }}"
                                                    title="{{ $product->getTranslation('name') }}" width="100%">
                                            </a>
                                            @if (home_base_price($product) != home_discounted_base_price($product))
                                                <span>
                                                    <del
                                                        class="fw-400 text-secondary mr-1">{{ home_base_price($product) }}</del>
                                                </span>
                                            @endif
                                            <!-- price -->
                                            <span
                                                class="fw-700 text-primary">{{ home_discounted_base_price($product) }}</span>
                                            <a href="{{ route('product', $product->slug) }}">
                                                <h6 class="my-2">{{ $product->getShowName() }} </h6>
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
                                        <!-- wishlisht & compare icons -->
                                        <div class="absolute-top-right aiz-p-hov-icon"
                                            style="margin-left:17% !important;z-index:99 !important;">
                                            <a href="javascript:void(0)" class="hov-svg-white" data-placement="left"
                                                onclick="addToWishList({{ $product->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14.4"
                                                    viewBox="0 0 16 14.4" class="w-sm-10">
                                                    <g id="_51a3dbe0e593ba390ac13cba118295e4"
                                                        data-name="51a3dbe0e593ba390ac13cba118295e4"
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
                                            <a href="javascript:void(0)" class="hov-svg-white" data-placement="left"
                                                onclick="addToCompare({{ $product->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 16 16">
                                                    <path id="_9f8e765afedd47ec9e49cea83c37dfea"
                                                        data-name="9f8e765afedd47ec9e49cea83c37dfea"
                                                        d="M18.037,5.547v.8a.8.8,0,0,1-.8.8H7.221a.4.4,0,0,0-.4.4V9.216a.642.642,0,0,1-1.1.454L2.456,6.4a.643.643,0,0,1,0-.909L5.723,2.227a.642.642,0,0,1,1.1.454V4.342a.4.4,0,0,0,.4.4H17.234a.8.8,0,0,1,.8.8Zm-3.685,4.86a.642.642,0,0,0-1.1.454v1.661a.4.4,0,0,1-.4.4H2.84a.8.8,0,0,0-.8.8v.8a.8.8,0,0,0,.8.8H12.854a.4.4,0,0,1,.4.4V17.4a.642.642,0,0,0,1.1.454l3.267-3.268a.643.643,0,0,0,0-.909Z"
                                                        transform="translate(-2.037 -2.038)" fill="#919199" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{--  <!--End Box products num => 5 -->  --}}

                    </div>

                    {{--  <!--End offers product grid layout  -->  --}}
                </div>
            </section>
        @endif
    </div>
    {{-- END   Highest Priorty Category "Usally Offers" --}}




    <!-- Video Section -->
    @if (@json_decode(get_setting('home_banner1_links'), true)[0])
        <div class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                <div class="w-100">
                    <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15 text-center"
                        data-items="1" data-xxl-items="1" data-xl-items="1" data-lg-items="1" data-md-items="1"
                        data-sm-items="1" data-xs-items="1" data-arrows="true" data-dots="false">
                        <div class="carousel-box overflow-hidden hov-scale-img ">
                            <div class="row p-3">
                                <div
                                    class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-12 m-auto div_child_iframe text-center">
                                    <a href="https://www.youtube.com/@svec-uae" target="_blank">
                                        <img src="{{ asset('assets/img/custom/youtube-subscribe.png') }}" width="60%"
                                            class="m-auto">
                                    </a>
                                    <iframe id="home_iframe"
                                        src="{{ json_decode(get_setting('home_banner1_links'), true)[0] }}"
                                        style="margin:auto !important;" frameborder="0" allowfullscreen width="100%"
                                        height="320px">
                                    </iframe>
                                    <div class="btn_youtube">
                                        <a href="https://www.youtube.com/@svec-uae" class="btn_first"  target="_blank">
                                            <span>Subsecribe</span>
                                        </a>
                                        <a href="https://www.youtube.com/@svec-uae" class="btn_seconed"  target="_blank">
                                            <span>Like</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif



    {{-- Start Home Categories Section --}}
    @if (get_setting('home_categories') != null)
        @include('frontend.partials.home_categories_section', ['home_categories' => $home_categories])
    @endif
    {{-- End Home Categories Section --}}



    <!-- Banner Section 2 -->
    @if (get_setting('home_banner2_images') != null)
        <div class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                @php
                    $banner_2_imags = json_decode(get_setting('home_banner2_images'));
                    $data_md = count($banner_2_imags) >= 2 ? 2 : 1;
                @endphp
                <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15"
                    data-items="{{ count($banner_2_imags) }}" data-xxl-items="{{ count($banner_2_imags) }}"
                    data-xl-items="{{ count($banner_2_imags) }}" data-lg-items="{{ $data_md }}"
                    data-md-items="{{ $data_md }}" data-sm-items="1" data-xs-items="1" data-arrows="true"
                    data-dots="false">
                    @foreach ($banner_2_imags as $key => $value)
                        <div class="carousel-box overflow-hidden hov-scale-img">
                            <a href="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}"
                                class="d-block text-reset overflow-hidden">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                    data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"
                                    class="img-fluid lazyload w-100 has-transition"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif




    {{--  <!-- New Products -->  --}}
    <div id="section_newest">
        @if (count($newest_products) > 0)
            <section class="mb-2 mb-md-3 mt-2 mt-md-3">
                <div class="container">
                    <!-- Top Section -->
                    <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                        <!-- Title -->
                        <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                            <span class="">{{ translate('New Products') }}</span>
                        </h3>
                        <!-- Links -->
                        <div class="d-flex">
                            <a class="veiw_btn general_clr fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                                href="{{ route('search', ['sort_by' => 'newest']) }}">{{ translate('View All') }}</a>
                        </div>
                    </div>
                    <hr />
                    <!-- Products Section -->
                    <div class="box_products">
                        <div class="row m-auto">
                            <!-- Swiper -->
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper">

                                    @foreach ($newest_products as $key => $product)
                                        @include('frontend.partials.product_swiper_box', [
                                            'product' => $product,
                                        ])
                                    @endforeach

                                </div>
                                <div class="swiper-pagination"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>







    <div class="container">
        <div class="row">
            <div class="col-12 py-2">
                <!-- Best Selling  -->
                <div id="section_best_selling">

                </div>
            </div>
            <div class="col-12 py-2">

                <!-- Featured Products -->
                <div id="section_featured">

                </div>
            </div>
        </div>
    </div>





    <!-- Banner Section 2 -->
    @if (get_setting('home_banner3_images') != null)
        <div class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                @php
                    $banner_2_imags = json_decode(get_setting('home_banner3_images'));
                    $data_md = count($banner_2_imags) >= 2 ? 2 : 1;
                @endphp
                <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15"
                    data-items="{{ count($banner_2_imags) }}" data-xxl-items="{{ count($banner_2_imags) }}"
                    data-xl-items="{{ count($banner_2_imags) }}" data-lg-items="{{ $data_md }}"
                    data-md-items="{{ $data_md }}" data-sm-items="1" data-xs-items="1" data-arrows="true"
                    data-dots="false">
                    @foreach ($banner_2_imags as $key => $value)
                        <div class="carousel-box overflow-hidden hov-scale-img">
                            <a href="{{ json_decode(get_setting('home_banner3_links'), true)[$key] }}"
                                class="d-block text-reset overflow-hidden">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                    data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"
                                    class="img-fluid lazyload w-100 has-transition"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif



    <!-- Auction Product -->
    @if (addon_is_activated('auction'))
        <div id="auction_products">

        </div>
    @endif

    <!-- Cupon -->
    @if (get_setting('coupon_system') == 1)
        <div class="mb-2 mb-md-3 mt-2 mt-md-3"
            style="background-color: {{ get_setting('cupon_background_color', '#292933') }}">
            <div class="container">
                <div class="row py-5">
                    <div class="col-xl-8 text-center text-xl-left">
                        <div class="d-lg-flex">
                            <div class="mb-3 mb-lg-0">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="109.602" height="93.34" viewBox="0 0 109.602 93.34">
                                    <defs>
                                        <clipPath id="clip-pathcup">
                                            <path id="Union_10" data-name="Union 10" d="M12263,13778v-15h64v-41h12v56Z"
                                                transform="translate(-11966 -8442.865)" fill="none" stroke="#fff"
                                                stroke-width="2" />
                                        </clipPath>
                                    </defs>
                                    <g id="Group_24326" data-name="Group 24326"
                                        transform="translate(-274.201 -5254.611)">
                                        <g id="Mask_Group_23" data-name="Mask Group 23"
                                            transform="translate(-3652.459 1785.452) rotate(-45)"
                                            clip-path="url(#clip-pathcup)">
                                            <g id="Group_24322" data-name="Group 24322"
                                                transform="translate(207 18.136)">
                                                <g id="Subtraction_167" data-name="Subtraction 167"
                                                    transform="translate(-12177 -8458)" fill="none">
                                                    <path
                                                        d="M12335,13770h-56a8.009,8.009,0,0,1-8-8v-8a8,8,0,0,0,0-16v-8a8.009,8.009,0,0,1,8-8h56a8.009,8.009,0,0,1,8,8v8a8,8,0,0,0,0,16v8A8.009,8.009,0,0,1,12335,13770Z"
                                                        stroke="none" />
                                                    <path
                                                        d="M 12335.0009765625 13768.0009765625 C 12338.3095703125 13768.0009765625 12341.0009765625 13765.30859375 12341.0009765625 13762 L 12341.0009765625 13755.798828125 C 12336.4423828125 13754.8701171875 12333.0009765625 13750.8291015625 12333.0009765625 13746 C 12333.0009765625 13741.171875 12336.4423828125 13737.130859375 12341.0009765625 13736.201171875 L 12341.0009765625 13729.9990234375 C 12341.0009765625 13726.6904296875 12338.3095703125 13723.9990234375 12335.0009765625 13723.9990234375 L 12278.9990234375 13723.9990234375 C 12275.6904296875 13723.9990234375 12272.9990234375 13726.6904296875 12272.9990234375 13729.9990234375 L 12272.9990234375 13736.201171875 C 12277.5576171875 13737.1298828125 12280.9990234375 13741.1708984375 12280.9990234375 13746 C 12280.9990234375 13750.828125 12277.5576171875 13754.869140625 12272.9990234375 13755.798828125 L 12272.9990234375 13762 C 12272.9990234375 13765.30859375 12275.6904296875 13768.0009765625 12278.9990234375 13768.0009765625 L 12335.0009765625 13768.0009765625 M 12335.0009765625 13770.0009765625 L 12278.9990234375 13770.0009765625 C 12274.587890625 13770.0009765625 12270.9990234375 13766.412109375 12270.9990234375 13762 L 12270.9990234375 13754 C 12275.4111328125 13753.9990234375 12278.9990234375 13750.4111328125 12278.9990234375 13746 C 12278.9990234375 13741.5888671875 12275.41015625 13738 12270.9990234375 13738 L 12270.9990234375 13729.9990234375 C 12270.9990234375 13725.587890625 12274.587890625 13721.9990234375 12278.9990234375 13721.9990234375 L 12335.0009765625 13721.9990234375 C 12339.412109375 13721.9990234375 12343.0009765625 13725.587890625 12343.0009765625 13729.9990234375 L 12343.0009765625 13738 C 12338.5888671875 13738.0009765625 12335.0009765625 13741.5888671875 12335.0009765625 13746 C 12335.0009765625 13750.4111328125 12338.58984375 13754 12343.0009765625 13754 L 12343.0009765625 13762 C 12343.0009765625 13766.412109375 12339.412109375 13770.0009765625 12335.0009765625 13770.0009765625 Z"
                                                        stroke="none" fill="#fff" />
                                                </g>
                                            </g>
                                        </g>
                                        <g id="Group_24321" data-name="Group 24321"
                                            transform="translate(-3514.477 1653.317) rotate(-45)">
                                            <g id="Subtraction_167-2" data-name="Subtraction 167"
                                                transform="translate(-12177 -8458)" fill="none">
                                                <path
                                                    d="M12335,13770h-56a8.009,8.009,0,0,1-8-8v-8a8,8,0,0,0,0-16v-8a8.009,8.009,0,0,1,8-8h56a8.009,8.009,0,0,1,8,8v8a8,8,0,0,0,0,16v8A8.009,8.009,0,0,1,12335,13770Z"
                                                    stroke="none" />
                                                <path
                                                    d="M 12335.0009765625 13768.0009765625 C 12338.3095703125 13768.0009765625 12341.0009765625 13765.30859375 12341.0009765625 13762 L 12341.0009765625 13755.798828125 C 12336.4423828125 13754.8701171875 12333.0009765625 13750.8291015625 12333.0009765625 13746 C 12333.0009765625 13741.171875 12336.4423828125 13737.130859375 12341.0009765625 13736.201171875 L 12341.0009765625 13729.9990234375 C 12341.0009765625 13726.6904296875 12338.3095703125 13723.9990234375 12335.0009765625 13723.9990234375 L 12278.9990234375 13723.9990234375 C 12275.6904296875 13723.9990234375 12272.9990234375 13726.6904296875 12272.9990234375 13729.9990234375 L 12272.9990234375 13736.201171875 C 12277.5576171875 13737.1298828125 12280.9990234375 13741.1708984375 12280.9990234375 13746 C 12280.9990234375 13750.828125 12277.5576171875 13754.869140625 12272.9990234375 13755.798828125 L 12272.9990234375 13762 C 12272.9990234375 13765.30859375 12275.6904296875 13768.0009765625 12278.9990234375 13768.0009765625 L 12335.0009765625 13768.0009765625 M 12335.0009765625 13770.0009765625 L 12278.9990234375 13770.0009765625 C 12274.587890625 13770.0009765625 12270.9990234375 13766.412109375 12270.9990234375 13762 L 12270.9990234375 13754 C 12275.4111328125 13753.9990234375 12278.9990234375 13750.4111328125 12278.9990234375 13746 C 12278.9990234375 13741.5888671875 12275.41015625 13738 12270.9990234375 13738 L 12270.9990234375 13729.9990234375 C 12270.9990234375 13725.587890625 12274.587890625 13721.9990234375 12278.9990234375 13721.9990234375 L 12335.0009765625 13721.9990234375 C 12339.412109375 13721.9990234375 12343.0009765625 13725.587890625 12343.0009765625 13729.9990234375 L 12343.0009765625 13738 C 12338.5888671875 13738.0009765625 12335.0009765625 13741.5888671875 12335.0009765625 13746 C 12335.0009765625 13750.4111328125 12338.58984375 13754 12343.0009765625 13754 L 12343.0009765625 13762 C 12343.0009765625 13766.412109375 12339.412109375 13770.0009765625 12335.0009765625 13770.0009765625 Z"
                                                    stroke="none" fill="#fff" />
                                            </g>
                                            <g id="Group_24325" data-name="Group 24325">
                                                <rect id="Rectangle_18578" data-name="Rectangle 18578" width="8"
                                                    height="2" transform="translate(120 5287)" fill="#fff" />
                                                <rect id="Rectangle_18579" data-name="Rectangle 18579" width="8"
                                                    height="2" transform="translate(132 5287)" fill="#fff" />
                                                <rect id="Rectangle_18581" data-name="Rectangle 18581" width="8"
                                                    height="2" transform="translate(144 5287)" fill="#fff" />
                                                <rect id="Rectangle_18580" data-name="Rectangle 18580" width="8"
                                                    height="2" transform="translate(108 5287)" fill="#fff" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="ml-lg-3">
                                <h5 class="fs-36 fw-400 text-white mb-3">{{ translate(get_setting('cupon_title')) }}</h5>
                                <h5 class="fs-20 fw-400 text-gray">{{ translate(get_setting('cupon_subtitle')) }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 text-center text-xl-right mt-4">
                        <a href="{{ route('coupons.all') }}"
                            class="btn veiw_btn text-white hov-bg-white hov-text-dark border border-width-2 fs-16 px-4"
                            style="border-radius: 28px;background: rgba(255, 255, 255, 0.2);box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.16);">{{ translate('View All Coupons') }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- Classified Product -->
    @if (get_setting('classified_product') == 1)
        @php
            $classified_products = \App\Models\CustomerProduct::where('status', '1')
                ->where('published', '1')
                ->take(6)
                ->get();
        @endphp
        @if (count($classified_products) > 0)
            <section class="mb-2 mb-md-3 mt-2 mt-md-3">
                <div class="container">
                    <!-- Top Section -->
                    <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                        <!-- Title -->
                        <h3 class="fs-16 fs-md-20 fw-700 mb- mb-sm-0">
                            <span class="">{{ translate('Classified Ads') }}</span>
                        </h3>
                        <!-- Links -->
                        <div class="d-flex">
                            <a class="general_clr veiw_btn fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                                href="{{ route('customer.products') }}">{{ translate('View All Products') }}</a>
                        </div>
                    </div>
                    <!-- Banner -->
                    @if (get_setting('classified_banner_image') != null || get_setting('classified_banner_image_small') != null)
                        <div class="mb-3 overflow-hidden hov-scale-img d-none d-md-block">
                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                data-src="{{ uploaded_asset(get_setting('classified_banner_image')) }}"
                                alt="{{ env('APP_NAME') }} promo" class="lazyload img-fit h-100 has-transition"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                        </div>
                        <div class="mb-3 overflow-hidden hov-scale-img d-md-none">
                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                data-src="{{ get_setting('classified_banner_image_small') != null ? uploaded_asset(get_setting('classified_banner_image_small')) : uploaded_asset(get_setting('classified_banner_image')) }}"
                                alt="{{ env('APP_NAME') }} promo" class="lazyload img-fit h-100 has-transition"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                        </div>
                    @endif
                    <!-- Products Section -->
                    <div class="bg-white">
                        <div class="row no-gutters border-top border-left">
                            @foreach ($classified_products as $key => $classified_product)
                                <div
                                    class="col-xl-4 col-md-6 border-right border-bottom has-transition hov-shadow-out z-1">
                                    <div class="aiz-card-box p-2 has-transition bg-white">
                                        <div class="row hov-scale-img">
                                            <div class="col-4 col-md-5 mb-3 mb-md-0">
                                                <a href="{{ route('customer.product', $classified_product->slug) }}"
                                                    class="d-block overflow-hidden h-auto h-md-150px text-center">
                                                    <img class="img-fluid lazyload mx-auto has-transition"
                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                                        data-src="{{ uploaded_asset($classified_product->thumbnail_img) }}"
                                                        alt="{{ $classified_product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                </a>
                                            </div>
                                            <div class="col">
                                                <h3
                                                    class="fw-400 fs-14 text-dark text-truncate-2 lh-1-4 mb-3 h-35px d-none d-sm-block">
                                                    <a href="{{ route('customer.product', $classified_product->slug) }}"
                                                        class="d-block text-reset hov-text-primary">{{ $classified_product->getTranslation('name') }}</a>
                                                </h3>
                                                <div class="fs-14 mb-3">
                                                    <span
                                                        class="text-secondary">{{ $classified_product->user ? $classified_product->user->name : '' }}</span><br>
                                                    <span
                                                        class="fw-700 text-primary">{{ single_price($classified_product->unit_price) }}</span>
                                                </div>
                                                @if ($classified_product->conditon == 'new')
                                                    <span
                                                        class="badge badge-inline badge-soft-info fs-13 fw-700 p-3 text-info"
                                                        style="border-radius: 20px;">{{ translate('New') }}</span>
                                                @elseif($classified_product->conditon == 'used')
                                                    <span
                                                        class="badge badge-inline badge-soft-warning fs-13 fw-700 p-3 text-danger"
                                                        style="border-radius: 20px;">{{ translate('Used') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif

    <!-- Top Sellers -->
    @php
        $best_selers = Cache::remember('best_selers', 86400, function () {
            return \App\Models\Shop::where('verification_status', 1)
                ->orderBy('num_of_sale', 'desc')
                ->take(5)
                ->get();
        });
    @endphp
    @if (get_setting('vendor_system_activation') == 1)
        <section class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                <!-- Top Section -->
                <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                    <!-- Title -->
                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                        <span class="pb-3">{{ translate('Top Sellers') }}</span>
                    </h3>
                    <!-- Links -->
                    <div class="d-flex">
                        <a class="general_clr veiw_btn fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                            href="{{ route('sellers') }}">{{ translate('View All Sellers') }}</a>
                    </div>
                </div>
                <!-- Sellers Section -->
                <div class="aiz-carousel arrow-x-0 arrow-inactive-none" data-items="5" data-xxl-items="5"
                    data-xl-items="4" data-lg-items="3.4" data-md-items="2.5" data-sm-items="2" data-xs-items="1.4"
                    data-arrows="true" data-dots="false">
                    @foreach ($best_selers as $key => $seller)
                        @if ($seller->user != null)
                            <div
                                class="carousel-box h-100 position-relative text-center border-right border-top border-bottom @if ($key == 0) border-left @endif has-transition hov-animate-outline">
                                <div class="position-relative px-3" style="padding-top: 2rem; padding-bottom:2rem;">
                                    <!-- Shop logo & Verification Status -->
                                    <div class="position-relative mx-auto size-100px size-md-120px">
                                        <a href="{{ route('shop.visit', $seller->slug) }}"
                                            class="d-flex mx-auto justify-content-center align-item-center size-100px size-md-120px border overflow-hidden hov-scale-img"
                                            tabindex="0"
                                            style="border: 1px solid #e5e5e5; border-radius: 50%; box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.06);">
                                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                                data-src="{{ uploaded_asset($seller->logo) }}"
                                                alt="{{ $seller->name }}" class="img-fit lazyload has-transition"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                        </a>
                                        <div class="absolute-top-right z-1 mr-md-2 mt-1 rounded-content bg-white">
                                            @if ($seller->verification_status == 1)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24.001" height="24"
                                                    viewBox="0 0 24.001 24">
                                                    <g id="Group_25929" data-name="Group 25929"
                                                        transform="translate(-480 -345)">
                                                        <circle id="Ellipse_637" data-name="Ellipse 637" cx="12"
                                                            cy="12" r="12" transform="translate(480 345)"
                                                            fill="#fff" />
                                                        <g id="Group_25927" data-name="Group 25927"
                                                            transform="translate(480 345)">
                                                            <path id="Union_5" data-name="Union 5"
                                                                d="M0,12A12,12,0,1,1,12,24,12,12,0,0,1,0,12Zm1.2,0A10.8,10.8,0,1,0,12,1.2,10.812,10.812,0,0,0,1.2,12Zm1.2,0A9.6,9.6,0,1,1,12,21.6,9.611,9.611,0,0,1,2.4,12Zm5.115-1.244a1.083,1.083,0,0,0,0,1.529l3.059,3.059a1.081,1.081,0,0,0,1.529,0l5.1-5.1a1.084,1.084,0,0,0,0-1.53,1.081,1.081,0,0,0-1.529,0L11.339,13.05,9.045,10.756a1.082,1.082,0,0,0-1.53,0Z"
                                                                transform="translate(0 0)" fill="#3490f3" />
                                                        </g>
                                                    </g>
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24.001" height="24"
                                                    viewBox="0 0 24.001 24">
                                                    <g id="Group_25929" data-name="Group 25929"
                                                        transform="translate(-480 -345)">
                                                        <circle id="Ellipse_637" data-name="Ellipse 637" cx="12"
                                                            cy="12" r="12" transform="translate(480 345)"
                                                            fill="#fff" />
                                                        <g id="Group_25927" data-name="Group 25927"
                                                            transform="translate(480 345)">
                                                            <path id="Union_5" data-name="Union 5"
                                                                d="M0,12A12,12,0,1,1,12,24,12,12,0,0,1,0,12Zm1.2,0A10.8,10.8,0,1,0,12,1.2,10.812,10.812,0,0,0,1.2,12Zm1.2,0A9.6,9.6,0,1,1,12,21.6,9.611,9.611,0,0,1,2.4,12Zm5.115-1.244a1.083,1.083,0,0,0,0,1.529l3.059,3.059a1.081,1.081,0,0,0,1.529,0l5.1-5.1a1.084,1.084,0,0,0,0-1.53,1.081,1.081,0,0,0-1.529,0L11.339,13.05,9.045,10.756a1.082,1.082,0,0,0-1.53,0Z"
                                                                transform="translate(0 0)" fill="red" />
                                                        </g>
                                                    </g>
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Shop name -->
                                    <h2 class="fs-14 fw-700 text-dark text-truncate-2 h-40px mt-3 mt-md-4 mb-0 mb-md-3">
                                        <a href="{{ route('shop.visit', $seller->slug) }}"
                                            class="text-reset hov-text-primary" tabindex="0">{{ $seller->name }}</a>
                                    </h2>
                                    <!-- Shop Rating -->
                                    <div class="rating rating-mr-1 text-dark mb-3">
                                        {{ renderStarRating($seller->rating) }}
                                        <span class="opacity-60 fs-14">({{ $seller->num_of_reviews }}
                                            {{ translate('Reviews') }})</span>
                                    </div>
                                    <!-- Visit Button -->
                                    <a href="{{ route('shop.visit', $seller->slug) }}" class="btn-visit">
                                        <span class="circle" aria-hidden="true">
                                            <span class="icon arrow"></span>
                                        </span>
                                        <span class="button-text">{{ translate('Visit Store') }}</span>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Top Brands -->
    @if (get_setting('top_brands') != null)
        <section class="mb-2 mb-md-3 mt-2 mt-md-3">
            <div class="container">
                <!-- Top Section -->
                <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                    <!-- Title -->
                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">{{ translate('Top Brands') }}</h3>
                    <!-- Links -->
                    <div class="d-flex">
                        <a class="general_clr veiw_btn fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                            href="{{ route('brands.all') }}">{{ translate('View All Brands') }}</a>
                    </div>
                </div>
                <!-- Brands Section -->
                <div class="bg-white px-3">
                    <div
                        class="row row-cols-xxl-6 row-cols-xl-6 row-cols-lg-4 row-cols-md-4 row-cols-3 gutters-16 border-top border-left">
                        @php $top_brands = json_decode(get_setting('top_brands')); @endphp
                        @foreach ($top_brands as $value)
                            @php $brand = \App\Models\Brand::find($value); @endphp
                            @if ($brand != null)
                                <div
                                    class="col text-center border-right border-bottom hov-scale-img has-transition hov-shadow-out z-1">
                                    <a href="{{ route('products.brand', $brand->slug) }}" class="d-block p-sm-3">
                                        <img src="{{ uploaded_asset($brand->logo) }}"
                                            class="lazyload h-md-100px mx-auto has-transition p-2 p-sm-4 mw-100"
                                            alt="{{ $brand->getTranslation('name') }}"
                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        <p class="text-center text-dark fs-12 fs-md-14 fw-700 mt-2">
                                            {{ $brand->getTranslation('name') }}</p>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection

@section('script')
    <script>
        $('#myCarousel').carousel({
            interval: 2000
        })

        $('.carousel .carousel-item').each(function() {
            var minPerSlide = 3;
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < minPerSlide; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $.post('{{ route('home.section.featured') }}', {
                _token: '{{ csrf_token() }}'
            }, function(data) {
                $('#section_featured').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_selling') }}', {
                _token: '{{ csrf_token() }}'
            }, function(data) {
                $('#section_best_selling').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.auction_products') }}', {
                _token: '{{ csrf_token() }}'
            }, function(data) {
                $('#auction_products').html(data);
                AIZ.plugins.slickCarousel();
            });
            // $.post('{{ route('home.section.home_categories') }}', {
            //     _token: '{{ csrf_token() }}'
            // }, function(data) {
            //     $('#section_home_categories').html(data);
            //     AIZ.plugins.slickCarousel();
            // });
            $.post('{{ route('home.section.best_sellers') }}', {
                _token: '{{ csrf_token() }}'
            }, function(data) {
                $('#section_best_sellers').html(data);
                AIZ.plugins.slickCarousel();
            });
        });
    </script>
    <!-- Swiper JS -->
    <script src="{{ static_asset('assets/js/swiper-bundle.min.js') }}"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            autoplay: {
                delay: 2500,
            },
        });
    </script>
@endsection
