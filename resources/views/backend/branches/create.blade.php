@extends('backend.layouts.app')

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3">{{ translate('Branches') }}</h1>
            </div>
        </div>
    </div>

    <!-- Language -->
    {{-- <ul class="nav nav-tabs nav-fill border-light">
        @foreach (\App\Models\Language::all() as $key => $language)
            <li class="nav-item">
                <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                    href="{{ route('website.footer', ['lang' => $language->code]) }}">
                    <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}" height="11" class="mr-1">
                    <span>{{ $language->name }}</span>
                </a>
            </li>
        @endforeach
    </ul> --}}

    <!-- Footer Widget -->
    <div class="card">
        <div class="card-header">
            <h6 class="fw-600 mb-0">{{ translate('Branches') }}</h6>
        </div>
        <div class="card-body">
            <div class="row gutters-10">


                <!-- Link Widget One -->
                <div class="col-lg-12">
                    <div class="card shadow-none bg-light">
                        <div class="card-header">
                            <h6 class="mb-0">{{ translate('New Branch') }}</h6>
                        </div>
                        <div class="card-body">
                            <form class="custom-form" action="{{ route('branches.store') }}" method="POST">
                                @csrf
                                <!-- Title -->
                                <div class="form-group">
                                    <label>{{ translate('Name') }} ({{ translate('Translatable') }})</label>
                                    <input type="text" class="form-control" name="name" value="">
                                </div>
                                <div class="form-group">
                                    <label>{{ translate('Address') }} ({{ translate('Translatable') }})</label>
                                    <input type="text" class="form-control"
                                        name="address" value="">
                                </div>
                                <div class="form-group">
                                    <label>{{ translate('Branch Email') }}</label>
                                    <input type="text" class="form-control"
                                        name="email">
                                </div>
                                <div class="form-group">
                                    <label>{{ translate('Google Map') }}</label>
                                    <textarea name="google_map" class="form-control"></textarea>
                                </div>
                                <!-- Phone Numbers -->
                                <div class="form-group">
                                    <label>{{ translate('Phone Numbers') }}</label>
                                    <div class="w3-links-target">
                                        @if (get_setting('widget_one_labels', null, $lang) != null)
                                            @foreach (json_decode(get_setting('widget_one_labels', null, $lang), true) as $key => $value)
                                                @php
                                                    $widget_one_links = '';
                                                    if (isset(json_decode(get_setting('widget_one_links'), true)[$key])) {
                                                        $widget_one_links = json_decode(get_setting('widget_one_links'), true)[$key];
                                                    }
                                                @endphp
                                                <div class="row gutters-5">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                placeholder="{{ translate('Label') }}"
                                                                name="widget_one_labels[]" value="{{ $value }}">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="http://"
                                                                name="widget_one_links[]" value="{{ $widget_one_links }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button"
                                                            class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                            data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more"
                                        data-content='<div class="row gutters-5">
    										<div class="col-6">
    											<div class="form-group">
    												<input type="text" class="form-control" placeholder="{{ translate('Phone Number') }}" name="phone_numbers[]" required>
    											</div>
    										</div>

    										<div class="col-auto">
    											<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
    												<i class="las la-times"></i>
    											</button>
    										</div>
    									</div>'
                                        data-target=".w3-links-target">
                                        {{ translate('Add New') }}
                                    </button>
                                </div>
                                <!-- Update Button -->
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">{{ translate('Create') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
