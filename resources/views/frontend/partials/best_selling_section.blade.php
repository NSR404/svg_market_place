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
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-6 text-center my-2">
                        <img src="{{ static_asset('uploads/all/K4KfLUhF5yWMku8ZCGA1DFqdtr089amLGdNrVD4k.webp') }}" alt="image product" width="100%" height="85%">
                        <h5 class="my-2 general_clr">غرف معيشة </h6>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-6  text-center my-2">
                            <img src="{{ static_asset('uploads/all/k2gOY5Y7vmOFCPsBK4tZ1WLK6Pdetsl9VWJODBo7.webp') }}" alt="image product" width="100%" height="85%">
                            <h5 class="my-2 general_clr">غرف معيشة </h6>
                         </div>
                         <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4   text-center my-2 display_none">
                            <img src="{{ static_asset('uploads/all/lNryfQzQ97ERKl8pHlA7EuNwt3PQo63sqpXFePea.webp') }}" alt="image product" width="100%" height="85%">
                            <h5 class="my-2 general_clr">غرف معيشة </h6>
                         </div>
                         <div class="box_row_num_3 row">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 col-4 text-center my-2 p-1">
                                <img src="{{ static_asset('uploads/all/k2gOY5Y7vmOFCPsBK4tZ1WLK6Pdetsl9VWJODBo7.webp') }}" alt="image product" width="100%" height="83%">
                                   <h5 class="my-2 general_clr">غرف معيشة </h6>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 col-4 text-center my-2 p-1">
                                  <img src="{{ static_asset('uploads/all/sLI9ku0D4tUtvdTTVRuF5ZkCjoAuk2JpjJRtnQgF.webp') }}" alt="image product" width="100%" height="83%">
                                    <h5 class="my-2 general_clr">غرف معيشة </h6>
                             </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 col-4 text-center my-2 p-1">
                                <img src="{{ static_asset('uploads/all/K4KfLUhF5yWMku8ZCGA1DFqdtr089amLGdNrVD4k.webp') }}" alt="image product" width="100%" height="83%">
                                <h5 class="my-2 general_clr">غرف معيشة </h6>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 col-4 text-center my-2 p-1 display_none">
                                <img src="{{ static_asset('uploads/all/U6SUkK0zmi05FBQ1mzGE2yGfRzuuU3NQZ4ns32cx.webp') }}" alt="image product" width="100%" height="83%">
                                <h5 class="my-2 general_clr">غرف معيشة </h6>
                            </div>
                         </div>
                    </div>
             </div>
        </div>
    </section>
@endif
