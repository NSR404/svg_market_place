@php
    $best_selling_products = Cache::remember('best_selling_products', 86400, function () {
        return filter_products(\App\Models\Product::orderBy('num_of_sale', 'desc'))
            ->limit(12)
            ->get();
    });
@endphp

@if (get_setting('best_selling') == 1 && count($best_selling_products) > 0)
    <section class="mb-2 mb-md-3 mt-2 mt-md-3">
        <div class="container">
            <!-- Top Section -->
            <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                <!-- Title -->
                <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                    <span class="">{{ translate('Best Selling') }}</span>
                </h3>
                <!-- Links -->
                <div class="d-flex">
                    {{-- <a type="button" class="arrow-prev slide-arrow link-disable text-secondary mr-2 px-3" onclick="clickToSlide('slick-prev','section_newest')"><i class="las la-angle-left fs-20 fw-600"></i></a> --}}
                    <a class="general_clr fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                        href="{{ route('search', ['sort_by' => 'newest']) }}">{{ translate('View All') }}</a>
                    {{-- <a type="button" class="arrow-next slide-arrow text-secondary ml-2" onclick="clickToSlide('slick-next','section_newest')"><i class="las la-angle-right fs-20 fw-600"></i></a> --}}
                </div>
            </div>
            <hr />
            <!-- Products Section -->
            <div class="px-sm-3 w-100">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-6 text-center my-2 item_box">
                          <div class="div_img_with_cart">
                            <img src="{{ static_asset('uploads/all/K4KfLUhF5yWMku8ZCGA1DFqdtr089amLGdNrVD4k.webp') }}" alt="image product" width="100%" height="85%">
                            {{--  <!-- add to cart -->  --}}
                                <a class="cart-btn   h-35px aiz-p-hov-icon text-white fs-13 fw-700 d-flex flex-column   justify-content-center align-items-center"
                                    href="javascript:void(0)">
                                    <span class="cart-btn-text">
                                        {{ translate('Add to Cart') }}
                                    </span>
                                    <br>
                                    <span><i class="las la-2x la-shopping-cart"></i></span>
                                </a>
                           </div>
                            <h5 class="my-2 general_clr">غرف معيشة </h6>
                                <!-- wishlisht & compare icons -->
                                <div class="absolute-top-right aiz-p-hov-icon">
                                    <a href="javascript:void(0)" class="hov-svg-white"
                                         data-placement="left">
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
                                    <a href="javascript:void(0)" class="hov-svg-white" data-placement="left">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                            <path id="_9f8e765afedd47ec9e49cea83c37dfea" data-name="9f8e765afedd47ec9e49cea83c37dfea"
                                                d="M18.037,5.547v.8a.8.8,0,0,1-.8.8H7.221a.4.4,0,0,0-.4.4V9.216a.642.642,0,0,1-1.1.454L2.456,6.4a.643.643,0,0,1,0-.909L5.723,2.227a.642.642,0,0,1,1.1.454V4.342a.4.4,0,0,0,.4.4H17.234a.8.8,0,0,1,.8.8Zm-3.685,4.86a.642.642,0,0,0-1.1.454v1.661a.4.4,0,0,1-.4.4H2.84a.8.8,0,0,0-.8.8v.8a.8.8,0,0,0,.8.8H12.854a.4.4,0,0,1,.4.4V17.4a.642.642,0,0,0,1.1.454l3.267-3.268a.643.643,0,0,0,0-.909Z"
                                                transform="translate(-2.037 -2.038)" fill="#919199" />
                                        </svg>
                                    </a>
                                </div>

                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-6  text-center my-2 item_box">
                            <div class="div_img_with_cart">
                                <img src="{{ static_asset('uploads/all/k2gOY5Y7vmOFCPsBK4tZ1WLK6Pdetsl9VWJODBo7.webp') }}" alt="image product" width="100%" height="85%">
                                {{--  <!-- add to cart -->  --}}
                                    <a class="cart-btn   h-35px aiz-p-hov-icon text-white fs-13 fw-700 d-flex flex-column   justify-content-center align-items-center"
                                        href="javascript:void(0)">
                                        <span class="cart-btn-text">
                                            {{ translate('Add to Cart') }}
                                        </span>
                                        <br>
                                        <span><i class="las la-2x la-shopping-cart"></i></span>
                                    </a>
                               </div>
                              <h5 class="my-2 general_clr">غرف معيشة </h6>
                                <!-- wishlisht & compare icons -->
                                <div class="absolute-top-right aiz-p-hov-icon">
                                    <a href="javascript:void(0)" class="hov-svg-white"
                                         data-placement="left">
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
                                    <a href="javascript:void(0)" class="hov-svg-white" data-placement="left">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                            <path id="_9f8e765afedd47ec9e49cea83c37dfea" data-name="9f8e765afedd47ec9e49cea83c37dfea"
                                                d="M18.037,5.547v.8a.8.8,0,0,1-.8.8H7.221a.4.4,0,0,0-.4.4V9.216a.642.642,0,0,1-1.1.454L2.456,6.4a.643.643,0,0,1,0-.909L5.723,2.227a.642.642,0,0,1,1.1.454V4.342a.4.4,0,0,0,.4.4H17.234a.8.8,0,0,1,.8.8Zm-3.685,4.86a.642.642,0,0,0-1.1.454v1.661a.4.4,0,0,1-.4.4H2.84a.8.8,0,0,0-.8.8v.8a.8.8,0,0,0,.8.8H12.854a.4.4,0,0,1,.4.4V17.4a.642.642,0,0,0,1.1.454l3.267-3.268a.643.643,0,0,0,0-.909Z"
                                                transform="translate(-2.037 -2.038)" fill="#919199" />
                                        </svg>
                                    </a>
                                </div>

                       </div>
                         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4   text-center my-2 display_none item_box">
                             <div class="div_img_with_cart">
                                <img src="{{ static_asset('uploads/all/lNryfQzQ97ERKl8pHlA7EuNwt3PQo63sqpXFePea.webp') }}" alt="image product" width="100%" height="85%">
                                {{--  <!-- add to cart -->  --}}
                                    <a class="cart-btn   h-35px aiz-p-hov-icon text-white fs-13 fw-700 d-flex flex-column   justify-content-center align-items-center"
                                        href="javascript:void(0)">
                                        <span class="cart-btn-text">
                                            {{ translate('Add to Cart') }}
                                        </span>
                                        <br>
                                        <span><i class="las la-2x la-shopping-cart"></i></span>
                                    </a>
                               </div>
                              <h5 class="my-2 general_clr">غرف معيشة </h6>
                                <!-- wishlisht & compare icons -->
                                <div class="absolute-top-right aiz-p-hov-icon">
                                    <a href="javascript:void(0)" class="hov-svg-white"
                                         data-placement="left">
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
                                    <a href="javascript:void(0)" class="hov-svg-white" data-placement="left">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                            <path id="_9f8e765afedd47ec9e49cea83c37dfea" data-name="9f8e765afedd47ec9e49cea83c37dfea"
                                                d="M18.037,5.547v.8a.8.8,0,0,1-.8.8H7.221a.4.4,0,0,0-.4.4V9.216a.642.642,0,0,1-1.1.454L2.456,6.4a.643.643,0,0,1,0-.909L5.723,2.227a.642.642,0,0,1,1.1.454V4.342a.4.4,0,0,0,.4.4H17.234a.8.8,0,0,1,.8.8Zm-3.685,4.86a.642.642,0,0,0-1.1.454v1.661a.4.4,0,0,1-.4.4H2.84a.8.8,0,0,0-.8.8v.8a.8.8,0,0,0,.8.8H12.854a.4.4,0,0,1,.4.4V17.4a.642.642,0,0,0,1.1.454l3.267-3.268a.643.643,0,0,0,0-.909Z"
                                                transform="translate(-2.037 -2.038)" fill="#919199" />
                                        </svg>
                                    </a>
                                </div>

                         </div>
                         <div class="box_row_num_3 row ">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 col-4 text-center my-2 p-1 item_box">
                                <div class="div_img_with_cart">
                                    <img src="{{ static_asset('uploads/all/k2gOY5Y7vmOFCPsBK4tZ1WLK6Pdetsl9VWJODBo7.webp') }}" alt="image product" width="100%" height="83%">
                                    {{--  <!-- add to cart -->  --}}
                                        <a class="cart-btn   h-35px aiz-p-hov-icon text-white fs-13 fw-700 d-flex flex-column   justify-content-center align-items-center"
                                            href="javascript:void(0)">
                                            <span class="cart-btn-text">
                                                {{ translate('Add to Cart') }}
                                            </span>
                                            <br>
                                            <span><i class="las la-2x la-shopping-cart"></i></span>
                                        </a>
                                   </div>
                                   <h5 class="my-2 general_clr">غرف معيشة </h6>
                                    <!-- wishlisht & compare icons -->
                                    <div class="absolute-top-right aiz-p-hov-icon">
                                        <a href="javascript:void(0)" class="hov-svg-white"
                                             data-placement="left">
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
                                        <a href="javascript:void(0)" class="hov-svg-white" data-placement="left">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                                <path id="_9f8e765afedd47ec9e49cea83c37dfea" data-name="9f8e765afedd47ec9e49cea83c37dfea"
                                                    d="M18.037,5.547v.8a.8.8,0,0,1-.8.8H7.221a.4.4,0,0,0-.4.4V9.216a.642.642,0,0,1-1.1.454L2.456,6.4a.643.643,0,0,1,0-.909L5.723,2.227a.642.642,0,0,1,1.1.454V4.342a.4.4,0,0,0,.4.4H17.234a.8.8,0,0,1,.8.8Zm-3.685,4.86a.642.642,0,0,0-1.1.454v1.661a.4.4,0,0,1-.4.4H2.84a.8.8,0,0,0-.8.8v.8a.8.8,0,0,0,.8.8H12.854a.4.4,0,0,1,.4.4V17.4a.642.642,0,0,0,1.1.454l3.267-3.268a.643.643,0,0,0,0-.909Z"
                                                    transform="translate(-2.037 -2.038)" fill="#919199" />
                                            </svg>
                                        </a>
                                    </div>

                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 col-4 text-center my-2 p-1 item_box">
                                <div class="div_img_with_cart">
                                      <img src="{{ static_asset('uploads/all/sLI9ku0D4tUtvdTTVRuF5ZkCjoAuk2JpjJRtnQgF.webp') }}" alt="image product" width="100%" height="83%">
                                    {{--  <!-- add to cart -->  --}}
                                        <a class="cart-btn   h-35px aiz-p-hov-icon text-white fs-13 fw-700 d-flex flex-column   justify-content-center align-items-center"
                                            href="javascript:void(0)">
                                            <span class="cart-btn-text">
                                                {{ translate('Add to Cart') }}
                                            </span>
                                            <br>
                                            <span><i class="las la-2x la-shopping-cart"></i></span>
                                        </a>
                                   </div>
                                    <h5 class="my-2 general_clr">غرف معيشة </h6>
                                        <!-- wishlisht & compare icons -->
                                        <div class="absolute-top-right aiz-p-hov-icon">
                                            <a href="javascript:void(0)" class="hov-svg-white"
                                                 data-placement="left">
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
                                            <a href="javascript:void(0)" class="hov-svg-white" data-placement="left">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                                    <path id="_9f8e765afedd47ec9e49cea83c37dfea" data-name="9f8e765afedd47ec9e49cea83c37dfea"
                                                        d="M18.037,5.547v.8a.8.8,0,0,1-.8.8H7.221a.4.4,0,0,0-.4.4V9.216a.642.642,0,0,1-1.1.454L2.456,6.4a.643.643,0,0,1,0-.909L5.723,2.227a.642.642,0,0,1,1.1.454V4.342a.4.4,0,0,0,.4.4H17.234a.8.8,0,0,1,.8.8Zm-3.685,4.86a.642.642,0,0,0-1.1.454v1.661a.4.4,0,0,1-.4.4H2.84a.8.8,0,0,0-.8.8v.8a.8.8,0,0,0,.8.8H12.854a.4.4,0,0,1,.4.4V17.4a.642.642,0,0,0,1.1.454l3.267-3.268a.643.643,0,0,0,0-.909Z"
                                                        transform="translate(-2.037 -2.038)" fill="#919199" />
                                                </svg>
                                            </a>
                                        </div>

                             </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 col-4 text-center my-2 p-1 item_box">
                                <div class="div_img_with_cart">
                                    <img src="{{ static_asset('uploads/all/K4KfLUhF5yWMku8ZCGA1DFqdtr089amLGdNrVD4k.webp') }}" alt="image product" width="100%" height="83%">
                                {{--  <!-- add to cart -->  --}}
                                        <a class="cart-btn   h-35px aiz-p-hov-icon text-white fs-13 fw-700 d-flex flex-column   justify-content-center align-items-center"
                                            href="javascript:void(0)">
                                            <span class="cart-btn-text">
                                                {{ translate('Add to Cart') }}
                                            </span>
                                            <br>
                                            <span><i class="las la-2x la-shopping-cart"></i></span>
                                        </a>
                                   </div>
                                <h5 class="my-2 general_clr">غرف معيشة </h6>
                                    <!-- wishlisht & compare icons -->
                                    <div class="absolute-top-right aiz-p-hov-icon">
                                        <a href="javascript:void(0)" class="hov-svg-white"
                                             data-placement="left">
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
                                        <a href="javascript:void(0)" class="hov-svg-white" data-placement="left">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                                <path id="_9f8e765afedd47ec9e49cea83c37dfea" data-name="9f8e765afedd47ec9e49cea83c37dfea"
                                                    d="M18.037,5.547v.8a.8.8,0,0,1-.8.8H7.221a.4.4,0,0,0-.4.4V9.216a.642.642,0,0,1-1.1.454L2.456,6.4a.643.643,0,0,1,0-.909L5.723,2.227a.642.642,0,0,1,1.1.454V4.342a.4.4,0,0,0,.4.4H17.234a.8.8,0,0,1,.8.8Zm-3.685,4.86a.642.642,0,0,0-1.1.454v1.661a.4.4,0,0,1-.4.4H2.84a.8.8,0,0,0-.8.8v.8a.8.8,0,0,0,.8.8H12.854a.4.4,0,0,1,.4.4V17.4a.642.642,0,0,0,1.1.454l3.267-3.268a.643.643,0,0,0,0-.909Z"
                                                    transform="translate(-2.037 -2.038)" fill="#919199" />
                                            </svg>
                                        </a>
                                    </div>

                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 col-4 text-center my-2 p-1 display_none item_box">
                                <div class="div_img_with_cart">
                                    <img src="{{ static_asset('uploads/all/U6SUkK0zmi05FBQ1mzGE2yGfRzuuU3NQZ4ns32cx.webp') }}" alt="image product" width="100%" height="83%">
                                    {{--  <!-- add to cart -->  --}}
                                        <a class="cart-btn   h-35px aiz-p-hov-icon text-white fs-13 fw-700 d-flex flex-column   justify-content-center align-items-center"
                                            href="javascript:void(0)">
                                            <span class="cart-btn-text">
                                                {{ translate('Add to Cart') }}
                                            </span>
                                            <br>
                                            <span><i class="las la-2x la-shopping-cart"></i></span>
                                        </a>
                                   </div>
                                <h5 class="my-2 general_clr">غرف معيشة </h6>
                                    <!-- wishlisht & compare icons -->
                                    <div class="absolute-top-right aiz-p-hov-icon">
                                        <a href="javascript:void(0)" class="hov-svg-white"
                                             data-placement="left">
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
                                        <a href="javascript:void(0)" class="hov-svg-white" data-placement="left">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                                <path id="_9f8e765afedd47ec9e49cea83c37dfea" data-name="9f8e765afedd47ec9e49cea83c37dfea"
                                                    d="M18.037,5.547v.8a.8.8,0,0,1-.8.8H7.221a.4.4,0,0,0-.4.4V9.216a.642.642,0,0,1-1.1.454L2.456,6.4a.643.643,0,0,1,0-.909L5.723,2.227a.642.642,0,0,1,1.1.454V4.342a.4.4,0,0,0,.4.4H17.234a.8.8,0,0,1,.8.8Zm-3.685,4.86a.642.642,0,0,0-1.1.454v1.661a.4.4,0,0,1-.4.4H2.84a.8.8,0,0,0-.8.8v.8a.8.8,0,0,0,.8.8H12.854a.4.4,0,0,1,.4.4V17.4a.642.642,0,0,0,1.1.454l3.267-3.268a.643.643,0,0,0,0-.909Z"
                                                    transform="translate(-2.037 -2.038)" fill="#919199" />
                                            </svg>
                                        </a>
                                    </div>

                            </div>
                         </div>
                    </div>
             </div>
        </div>
    </section>
@endif

