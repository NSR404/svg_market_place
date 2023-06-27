@extends('frontend.layouts.app')
@push('css')
    <style>
        ul,
        li {
            list-style-type: none !important;
        }

        @media (max-width: 576px) {
            .img-xs-400 {
                width: 400px !important;
            }
        }

        @media (min-width: 576px) and (max-width: 768px) {
            img-xs-400 {
                width: 400px !important;
            }
        }
    </style>
@endpush
@section('content')
    <section class="pt-4 mb-4">
        <div class="container text-center">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="fw-700 fs-20 fs-md-24 text-dark"> {{ translate('Our Story') }}</h1>
                </div>
                <div class="col-sm-12 text-center mb-5">
                    <p class="fs-14 fw-600">
                        {{ translate('about_us_our_story_text') }}

                    </p>
                </div>

                <div class="col-6 text-center">
                    <h1 class="fw-700 fs-20 fs-md-24 text-dark"><i class="las la-crosshairs text-primary"></i>
                        {{ translate('Our Goal') }}</h1>
                </div>
                <div class="col-6 text-center">
                    <h1 class="fw-700 fs-20 fs-md-24 text-dark"><i class="las la-eye text-primary"></i>
                        {{ translate('Our Vision') }}</h1>
                </div>
                <div class="col-6 text-center">
                    <p class="fw-300 fs-14 fs-md-15 text-dark">{{ translate('about_us_our_goal_text') }}</p>
                </div>
                <div class="col-6 text-center">
                    <p class="fw-300 fs-14 fs-md-15 text-dark">{{ translate('about_us_our_vision_text') }}</p>
                </div>
            </div>
            <hr>
            {{-- Our Mission --}}
            <div class="row mt-5 ">
                <div class="col-12 text-center">
                    <h1 class="fw-700 fs-20 fs-md-24 text-dark">{{ translate('Our Mission') }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 mt-5">
                    <h6>
                        {{ translate('We Work as a Creative partners. to Perform for our customer the best designs & the highest level of
                        quality construction services at fair and market competitive.') }}
                    </h6>
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-6 fs-20 fw-500 mb-5">
                                <i class="text-primary las la-money-bill"></i>
                                {{ translate('Save Money') }}
                            </div>
                            <div class="col-6  fs-20 fw-500 mb-5">
                                <i class="text-primary las la-lightbulb"></i>
                                {{ translate('Better Ideas') }}
                            </div>
                            <div class="col-6  fs-20 fw-500 mb-5">
                                <i class="text-primary las la-users"></i>
                                {{ translate('Collaboration') }}
                            </div>
                            <div class="col-6  fs-20 fw-500">
                                <i class="text-primary las la-search"></i>
                                {{ translate('Easy To Find') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 text-center mt-5">
                    <div class="img-fit">
                        <img src="https://svec.ae/assets/images/others/mission.jpg" class="img mg-fit img-xs-400 mx-auto"
                            width="500">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mt-5">
                <div class="col-sm-12">
                    <p class="fw-700 fs-26 fs-md-24 text-dark"> {{ translate('Our Services') }}</p>
                </div>
                <div class="col-sm-6 bg-light mb-2 border-right border-left p-5 text-center">
                    <p class="fs-24 fw-700 hov-text-primary"><i class="text-primary las la-list"></i> {{ translate('Contract Managment') }}</p>
                    <p class="fw-300 fs-16 hov-text-primary">{{ translate('about_us_contract_text') }}</p>
                </div>
                <div class="col-sm-6 bg-light mb-2 border-right border-left p-5 text-center">
                    <p class="fs-24 fw-700 hov-text-primary"><i class="text-primary las la-home"></i> {{ translate('Landscape Architecture') }}</p>
                    <p class="fw-300 fs-16 hov-text-primary">{{ translate('about_us_langscape_arch_text') }}</p>
                </div>
                <div class="col-sm-6 bg-light mb-2 border-right border-left p-5 text-center">
                    <p class="fs-24 fw-700 hov-text-primary"><i class="text-primary las la-users"></i> {{ translate('Sustainability') }}</p>
                    <p class="fw-300 fs-16 hov-text-primary">{{ translate('about_us_sustainability_text') }}</p>
                </div>
                <div class="col-sm-6 bg-light mb-2 border-right border-left p-5 text-center">
                    <p class="fs-24 fw-700 hov-text-primary"><i class="text-primary las la-palette"></i> {{ translate('Architecture & Design') }}</p>
                    <p class="fw-300 fs-16 hov-text-primary">{{ translate('about_us_architecture_text') }}</p>
                </div>
                <div class="col-sm-6 bg-light mb-2 border-right border-left p-5 text-center">
                    <p class="fs-24 fw-700 hov-text-primary"><i class="text-primary las la-sitemap"></i> {{ translate('Construction Supervision') }}</p>
                    <p class="fw-300 fs-16 hov-text-primary">{{ translate('about_us_construction_text') }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
