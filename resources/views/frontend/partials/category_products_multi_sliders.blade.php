@php
    $products = Cache::rememberForever('cateogry-products-' . $category->id, function () use ($category) {
        return $category
            ->products()
            ->where('published' , 1)
            ->orderByDesc('order_level')
            ->latest()
            ->take(80)
            ->get();
    });
    $slider_1_products = $products->slice(0, 20);
    $slider_2_products = $products->slice(19, 20);
    $slider_3_products = $products->slice(39, 20);
    $slider_4_products = $products->slice(59, 20);
    $products_count = count($products);
@endphp
@if (count($slider_1_products) > 0)
    <div class="text-center">
        <div class="row mx-auto my-auto">
            {{-- Passing Multi products for this swiper. --}}
            @include('frontend.partials.product_swiper_box_2', [
                'products' => $slider_1_products,
                'carousel_id' => 1,
            ])
        </div>
        @if (count($slider_2_products) > 0)
            <div class="box_products">
                <div class="row m-auto">
                    <!-- Swiper -->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($slider_2_products as $key => $product)
                                @include('frontend.partials.product_swiper_box', ['product' => $product])
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>

                </div>
            </div>
        @endif
        @if (count($slider_3_products) > 0)
            <div class="row mx-auto my-auto">
                {{-- Passing Multi products for this swiper. --}}
                @include('frontend.partials.product_swiper_box_2', [
                    'products' => $slider_3_products,
                    'carousel_id' => 2,
                ])
            </div>
        @endif
        @if (count($slider_4_products) > 0)
            <div class="box_products">
                <div class="row m-auto">
                    <!-- Swiper -->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($slider_4_products as $key => $product)
                                @include('frontend.partials.product_swiper_box', ['product' => $product])
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>

                </div>
            </div>
        @endif
    </div>
@endif
