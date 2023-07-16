@php
    $sub_categories = $category
        ->childrenCategories()
        ->where('featured', 1)
        ->orderByDesc('created_at')
        // ->orderByDesc('order_level')
        ->limit(10)
        ->get();
    $first_box_products = $sub_categories->slice(0, 4);
    $second_box_products = $sub_categories->slice(4, 2);
    $third_box_products = $sub_categories->slice(6)->take(4);
@endphp
<div class="row">
    {{--  <!--Start Box products num => 1 -->  --}}
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12 p-2 text-center">
        <div class="row">
            @foreach ($first_box_products as $sub_category)
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6 text-center mb-2 ">
                    <a href="{{ route('products.category', $sub_category->slug) }}">

                        <img class="lazyload   has-transition" src="{{ static_asset('assets/img/placeholder.jpg') }}"
                            data-src="{{ uploaded_asset($sub_category->cover_image) }}"
                            alt="{{ $sub_category->getTranslation('name') }}"
                            title="{{ $sub_category->getTranslation('name') }}" width="100%">
                    </a>
                    <a href="{{ route('products.category', $sub_category->slug) }}">
                        <h6 class="my-2">{{ $sub_category->getTranslation('name') }}</h6>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    {{--  <!--End Box products num => 1 -->  --}}

    {{--  <!--Start Box products num => 2 -->  --}}
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12 p-2 text-center">
        @foreach ($second_box_products as $sub_category)
            @if ($loop->index == 0)
                <a href="{{ route('products.category', $sub_category->slug) }}">

                    <img class="lazyload   has-transition" src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ uploaded_asset($sub_category->cover_image) }}"
                        alt="{{ $sub_category->getTranslation('name') }}"
                        title="{{ $sub_category->getTranslation('name') }}" width="100%">
                </a>
                <a href="{{ route('products.category', $sub_category->slug) }}">
                    <h6 class="my-2">{{ $sub_category->getTranslation('name') }} </h6>
                </a>
            @endif
        @endforeach

    </div>
    {{--  <!--End Box products num => 2 -->  --}}



    {{--  <!--Start Box products num => 4 -->  --}}
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12 p-2">
        <div class="row">
            @foreach ($third_box_products as $sub_category)
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6 text-center mb-2 ">
                    <a href="{{ route('products.category', $sub_category->slug) }}">

                        <img class="lazyload   has-transition" src="{{ static_asset('assets/img/placeholder.jpg') }}"
                            data-src="{{ uploaded_asset($sub_category->cover_image) }}"
                            alt="{{ $sub_category->getTranslation('name') }}"
                            title="{{ $sub_category->getTranslation('name') }}" width="100%">
                    </a>
                    <a href="{{ route('products.category', $sub_category->slug) }}">

                        <h6 class="my-2">{{ $sub_category->getTranslation('name') }}</h6>
                    </a>
                </div>
            @endforeach
        </div>
    </div>


    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12 p-2 text-center">
        @foreach ($second_box_products as $sub_category)
            @if ($loop->index == 1)
                <a href="{{ route('products.category', $sub_category->slug) }}">
                    <img class="lazyload   has-transition" src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ uploaded_asset($sub_category->cover_image) }}"
                        alt="{{ $sub_category->getTranslation('name') }}"
                        title="{{ $sub_category->getTranslation('name') }}" width="100%">
                </a>
                <a href="{{ route('products.category', $sub_category->slug) }}">
                    <h6 class="my-2">{{ $sub_category->getTranslation('name') }} </h6>
                </a>
            @endif
        @endforeach

    </div>
    {{--  <!--End Box products num => 5 -->  --}}

</div>
