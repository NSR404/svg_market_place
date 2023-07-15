{{-- @if (get_setting('home_categories') != null)
    @php $home_categories = json_decode(get_setting('home_categories')); @endphp
    @foreach ($home_categories as $key1 => $value)
        @php $category = \App\Models\Category::find($value); @endphp
        @if ($category)
            <section class="@if ($key1 != 0) mt-4 @endif" style="">
                <div class="container">
                    <div class="row gutters-16">
                        <!-- Home category Baner & name -->
                        <div class="col-xl-3 col-lg-4 col-md-5">
                            <div class="h-200px h-sm-250px h-md-340px">
                                <div class="h-100 w-100 w-xl-auto position-relative hov-scale-img overflow-hidden">
                                    <div class="position-absolute h-100 w-100 overflow-hidden">
                                        <img src="{{ uploaded_asset($category->cover_image) }}" alt="{{ $category->getTranslation('name') }}" class="img-fit h-100 has-transition"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    </div>
                                    <div class="pb-4 px-3 absolute-bottom-left w-100 has-transition h-100 d-flex flex-column align-items-center justify-content-end" style="background: linear-gradient(to top, rgba(0,0,0,0.7) 0%,rgba(0,0,0,0) 100%) !important;">
                                        <a class="fs-16 fw-700 text-white text-center animate-underline-white home-category-name d-flex align-items-center hov-column-gap-1" href="{{ route('products.category', $category->slug) }}" style="width: max-content;">{{ $category->getTranslation('name') }}&nbsp;<i class="las la-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Category Products -->
                        <div class="col-xl-9 col-lg-8 col-md-7">
                            <div class="aiz-carousel arrow-x-0 border-right arrow-inactive-none" data-items="5" data-xxl-items="5" data-xl-items="4" data-lg-items="4"  data-md-items="4" data-sm-items="4" data-xs-items="4" data-arrows='true' data-infinite='false'>
                                @foreach (get_cached_products($category->id) as $key => $product)
                                <div class="carousel-box px-3 position-relative has-transition border-right border-top border-bottom @if ($key == 0) border-left @endif hov-animate-outline">
                                    @include('frontend.partials.product_box_1',['product' => $product])
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach
@endif --}}

{{--  <!--Start Section Categories -->  --}}
@php
    // exclude the first category which is offers .
    $home_categories = $home_categories->slice(1);
@endphp
<section class="section_categ p-2 py-2">
    <div class="container">
        @foreach ($home_categories as $category)
        @if($category->products()->count() > 0)
            <div class="d-flex justify-content-between align-items-center mt-3">
                <h3 class="">{{ $category->getTranslation('name') }}</h3>
                <a class="general_clr fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                    href="{{ route('products.category', $category->slug) }}">{{ translate('View All') }}</a>
            </div>
            <hr />
        @endif
            @switch($loop->index)
                @case(0)
                    {{-- Amazon Way 1 For First Cateogry --}}
                    @include('frontend.partials.category_products_amazon_box_1', ['category' => $category])
                @break

                @case(1)
                    {{-- Mulit Slider For One Categoery "Usally Villa Design" --}}
                    @include('frontend.partials.category_products_multi_sliders', [
                        'category' => $category,
                    ])
                @break

                @case(2)
                    {{-- Amazon Way 2 For Third Cateogry (Displaying Sub Categories Only) --}}
                    @include('frontend.partials.category_products_amazon_box_2', ['category' => $category])
                @break

                @default
                    <div class="box_products">
                        <div class="row m-auto">
                            <!-- Swiper -->
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    @foreach (get_cached_products($category->id) as $key => $product)
                                        @include('frontend.partials.product_swiper_box', [
                                            'product' => $product,
                                        ])
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>

                        </div>
                    </div>
            @endswitch
        @endforeach





        {{--  <!-- Start Categoreies number => 2 -->  --}}
        {{-- <div class="d-flex justify-content-between align-items-center mt-3">
            <h3 class="">Villa design</h3>
            <a class="general_clr fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"
                href="{{ route('search', ['sort_by' => 'newest']) }}">{{ translate('View All') }}</a>
        </div>
        <hr />
        <div class="text-center">
            <div class="row mx-auto my-auto">
                <div id="myCarousel" class="carousel slide w-100" data-ride="carousel">
                    <div class="carousel-inner w-100" role="listbox">
                        <div class="carousel-item active w-100">
                            <div class="col-lg-2">
                                <img src="{{ static_asset('uploads/all/1hYXFIQRMMVbY1qJWaDGoUfWWqWAKnuUgaQs0K9L.jpg') }}"
                                    alt="image product" height="80%" width="100%">
                                <h5 class="my-2 mt-2 general_clr2">غرف معيشة </h6>
                            </div>
                        </div>
                        <div class="carousel-item w-100">
                            <div class="col-lg-2">
                                <img src="{{ static_asset('uploads/all/1hYXFIQRMMVbY1qJWaDGoUfWWqWAKnuUgaQs0K9L.jpg') }}"
                                    alt="image product" width="100%" height="80%">
                                <h5 class="my-2 mt-2 general_clr">غرف معيشة </h6>
                            </div>
                        </div>
                        <div class="carousel-item w-100">
                            <div class="col-lg-2">
                                <img src="{{ static_asset('uploads/all/1hYXFIQRMMVbY1qJWaDGoUfWWqWAKnuUgaQs0K9L.jpg') }}"
                                    alt="image product" width="100%" height="80%">
                                <h5 class="my-2 mt-2 general_clr">غرف معيشة </h6>
                            </div>
                        </div>

                    </div>

                    <a class="carousel-control-prev bg_clr  w-auto" href="#myCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next bg_clr w-auto" href="#myCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div> --}}
        {{--  <!-- End Categoreies number => 2 -->  --}}

        {{--  <!-- Start Categoreies number => 3 -->  --}}

        {{--  <!-- End Categoreies number => 3 -->  --}}

    </div>
</section>
{{--  <!--End Section Categories -->  --}}
