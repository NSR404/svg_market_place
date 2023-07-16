@php
    $best_selling_products = Cache::remember('best_selling_products', 86400, function () {
        return filter_products(\App\Models\Product::orderBy('num_of_sale', 'desc'))
            ->limit(7)
            ->get();
    });
    $best_selling_products_first_section = $best_selling_products->slice(0, 3);
    $best_selling_products_second_section = $best_selling_products->slice(3)->take(4);

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
                    @foreach ($best_selling_products_first_section as $product)
                        <div
                            class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-6 text-center my-2 item_box @if ($loop->last) display_none @endif">
                            @include('frontend.partials.home_center_box', ['product' => $product])

                        </div>
                    @endforeach
                </div>

                <div class="box_row_num_3 row">
                    @foreach ($best_selling_products_second_section as $product)
                        <div
                            class="col-lg-3 col-md-3 col-sm-4 col-xs-4 col-4 text-center my-2 p-1 item_box @if ($loop->last) display_none @endif">
                            @include('frontend.partials.home_center_box', ['product' => $product])

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
