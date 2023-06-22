@extends('frontend.layouts.app')
@push('css')
    <style>
        ul,
        li {
            list-style-type: none !important;
        }
    </style>
@endpush
@push('css')
    @if (app()->getLocale() == 'sa')
        <style>
            #phone-code {
                padding-right: 20% !important;
            }

            .iti__flag-container {
                left: auto !important;
                right: 0 !important;
            }
        </style>
    @endif
@endpush
@section('content')
    <section class="pt-4 mb-4">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left">
                    <h1 class="fw-700 fs-20 fs-md-24 text-dark">{{ translate('Contact Us') }}</h1>
                </div>
                <div class="col-lg-6">
                    <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                        <li class="breadcrumb-item has-transition opacity-50 hov-opacity-100">
                            <a class="text-reset" href="{{ route('home') }}">{{ translate('Home') }}</a>
                        </li>
                        <li class="text-dark fw-600 breadcrumb-item">
                            "{{ translate('Contact Us') }}"
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="mb-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-4 mx-auto">
                    <i class="las la-phone"></i>
                    {{ translate('Phone') }}
                </div>
                <div class="col-sm-4 mx-auto">
                    <i class="las la-map"></i>
                    {{ translate('Address') }}
                </div>
                <div class="col-sm-4 mx-auto">
                    <i class="las la-envelope"></i>
                    {{ translate('E-mail') }}
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-4 mx-auto">
                    <a href="tel:{{ get_setting('contact_phone') }}" >{{ get_setting('contact_phone') }}</a>
                </div>
                <div class="col-sm-4 mx-auto hove-text-primary text-primary">
                    {{ get_setting('contact_address', null, App::getLocale()) }}
                </div>
                <div class="col-sm-4 mx-auto">
                    <a href="mailto:{{ get_setting('contact_email') }}" >{{ get_setting('contact_email')  }}</a>
                </div>
            </div>
            <hr>
            {{-- Contact Form --}}
            <form class="custom-form" action="{{ route('contact_us.send') }}" method="POST">
                @csrf
                <div class="row mt-5 text-left">
                    <div class="col-sm-4 mb-2">
                        <label>{{ translate('Name') }}</label>
                        <input type="text" name="name" class="form-control" required value="{{ Auth::user()?->name }}">
                    </div>
                    <div class="col-sm-4 ">
                        <label>{{ translate('Phone') }}</label>
                        <input type="tel" id="phone-code" class="form-control rounded-0" name="phone" value="{{ Auth::user()?->phone }}"
                            autocomplete="off">
                        <input type="hidden" name="country_code" value="">
                    </div>
                    <div class="col-sm-4 mb-2">
                        <label>{{ translate('E-mail') }}</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()?->email }}" required>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <label>{{ translate('Message') }}</label>
                        <textarea name="message" class="form-control" required></textarea>
                    </div>
                    <div class="col-sm-12 text-center mt-5">
                        <button type="submit" class="btn btn-primary">{{ translate('Submit') }}</button>
                    </div>
                </div>
            </form>
            <hr>
            <div class="row mt-5 text-center">
                @forelse ($branches as $branch)
                    <div
                        class="col-md-6 mb-2 has-transition hov-scale-img hov-animate-outline border-right border-top border-bottom text-center">
                        <ul class="p5">
                            <li>
                                <h3 class="mt-2"><i class="las la-map"></i> {{ $branch->getTranslation('name') }} </h5>
                            </li>
                            <li><i class="las la-map-marker"></i> {{ $branch->address }}</li>
                            @foreach ($branch->phone_numbers as $phone_number)
                                <li>
                                    <i class="las la-phone"></i> <a href="tel:{{ $phone_number }}">{{ $phone_number }}</a>
                                </li>
                            @endforeach
                            <li>
                                <i class="las la-envelope"></i>
                                <a href="mailto:{{ $branch->emails }}">{{ $branch->emails }}</a>
                            </li>
                        </ul>
                        {!! $branch->google_map !!}
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        var utilsScriptVar = "{{ static_asset('assets/js/intlTelutils.js') }}";
    </script>
    <script src="{{ static_asset('assets/js/custom/phone.js?v=0.01') }}"></script>
@endsection
