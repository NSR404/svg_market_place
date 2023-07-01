@extends('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="h2 fs-16 mb-0">{{ translate('Order Details') }}</h1>
        </div>
        <div class="card-body">
            <div class="row gutters-5">
                <div class="col text-md-left text-center">
                </div>
                @php
                    $delivery_status = $order->delivery_status;
                    $payment_status = $order->payment_status;
                    $admin_user_id = App\Models\User::where('user_type', 'admin')->first()->id;
                @endphp



                <!--Assign Delivery Boy-->
                {{-- @if ($order->seller_id == $admin_user_id || get_setting('product_manage_by_admin') == 1)

                    @if (addon_is_activated('delivery_boy'))
                        <div class="col-md-3 ml-auto">
                            <label for="assign_deliver_boy">{{ translate('Assign Deliver Boy') }}</label>
                            @if (($delivery_status == 'pending' || $delivery_status == 'confirmed' || $delivery_status == 'picked_up') &&
    auth()->user()->can('assign_delivery_boy_for_orders'))
                                <select class="form-control aiz-selectpicker" data-live-search="true"
                                    data-minimum-results-for-search="Infinity" id="assign_deliver_boy">
                                    <option value="">{{ translate('Select Delivery Boy') }}</option>
                                    @foreach ($delivery_boys as $delivery_boy)
                                        <option value="{{ $delivery_boy->id }}"
                                            @if ($order->assign_delivery_boy == $delivery_boy->id) selected @endif>
                                            {{ $delivery_boy->name }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text" class="form-control" value="{{ optional($order->delivery_boy)->name }}"
                                    disabled>
                            @endif
                        </div>
                    @endif

                    <div class="col-md-3 ml-auto">
                        <label for="update_payment_status">{{ translate('Payment Status') }}</label>
                        @if (auth()->user()->can('update_order_payment_status'))
                            <select class="form-control aiz-selectpicker" data-minimum-results-for-search="Infinity"
                                id="update_payment_status">
                                <option value="unpaid" @if ($payment_status == 'unpaid') selected @endif>
                                    {{ translate('Unpaid') }}
                                </option>
                                <option value="paid" @if ($payment_status == 'paid') selected @endif>
                                    {{ translate('Paid') }}
                                </option>
                            </select>
                        @else
                            <input type="text" class="form-control" value="{{ $payment_status }}" disabled>
                        @endif
                    </div> --}}
                <div class="col-md-3 ml-auto mb-3">
                    <label for="update_delivery_status">{{ translate('Delivery Status') }}</label>
                    @if (auth()->user()->can('update_order_delivery_status') &&
                            $delivery_status != 'delivered' &&
                            $delivery_status != 'cancelled')
                        <select class="form-control aiz-selectpicker" data-minimum-results-for-search="Infinity"
                            id="update_delivery_status">
                            <option value="pending" @if ($order->status == 'pending') selected @endif>
                                {{ translate('Pending') }}
                            </option>
                            <option value="completed" @if ($order->status == 'completed') selected @endif>
                                {{ translate('Completed') }}
                            </option>
                            <option value="cancelled" @if ($order->status == 'cancelled') selected @endif>
                                {{ translate('Cancelled') }}
                            </option>
                        </select>
                    @else
                        <input type="text" class="form-control" value="{{ $order->status }}" disabled>
                    @endif
                </div>
            </div>
            <div class="row gutters-5">
                <div class="col text-md-left text-center">
                    <address>
                        <strong class="text-main">
                            {{ $order->user->name }}
                        </strong><br>
                        {{ $order->user->email }}<br>
                        {{ $order->address?->country->getTranslation('name') }}<br>
                        {{ $order->address?->address }}<br>
                        <pre>
                        {{ $order->address?->phone }}</pre><br>
                    </address>
                </div>
                <div class="col-md-4 ml-auto">
                    <table>
                        <tbody>
                            <tr>
                                <td class="text-main text-bold">{{ translate('Order #') }}</td>
                                <td class="text-info text-bold text-right"> {{ $order->code }}</td>
                            </tr>
                            <tr>
                                <td class="text-main text-bold">{{ translate('Order Type') }} : </td>
                                <td class="text-right">{{ $order->type }}</td>
                            </tr>
                            <tr>
                                <td class="text-main text-bold">{{ translate('Order Status') }}</td>
                                <td class="text-right">
                                    {{ $order->getStatusAttributeInHtml() }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-main text-bold">{{ translate('Order Date') }} </td>
                                <td class="text-right">{{ date('d-m-Y h:i A', $order->date) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr class="new-section-sm bord-no">
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table-bordered aiz-table invoice-summary table">
                        <thead>
                            <tr class="bg-trans-dark">
                                <th data-breakpoints="lg" class="min-col">#</th>
                                <th width="10%">{{ translate('Photo') }}</th>
                                <th class="text-uppercase">{{ translate('Description') }}</th>
                                {{-- <th data-breakpoints="lg" class="text-uppercase">{{ translate('Delivery Type') }}</th> --}}
                                <th data-breakpoints="lg" class="min-col text-uppercase text-center">
                                    {{ translate('Qty') }}
                                </th>
                                {{-- <th data-breakpoints="lg" class="min-col text-uppercase text-center">
                                    {{ translate('Price') }}</th>
                                <th data-breakpoints="lg" class="min-col text-uppercase text-right">
                                    {{ translate('Total') }}</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->products as $key => $orderDetail)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <a href="{{ route('product', $orderDetail->slug) }}" target="_blank">
                                            <img height="50" src="{{ uploaded_asset($orderDetail->thumbnail_img) }}">
                                        </a>
                                    </td>
                                    <td>
                                        <strong>
                                            <a href="{{ route('product', $orderDetail->slug) }}" target="_blank"
                                                class="text-muted">
                                                {{ $orderDetail->getTranslation('name') }}
                                            </a>
                                        </strong>
                                        <small>
                                            {{ $orderDetail->pivot->variation }}
                                        </small>
                                        <br>
                                        <small>
                                            @php
                                                $product_stock = json_decode($orderDetail->stocks->first(), true);
                                            @endphp
                                            {{ translate('SKU') }}: {{ $product_stock['sku'] }}
                                        </small>
                                        <strong>
                                            <a href="{{ route('auction-product', $orderDetail->slug) }}" target="_blank"
                                                class="text-muted">
                                                {{ $orderDetail->getTranslation('name') }}
                                            </a>
                                        </strong>
                                    </td>
                                    <td class="text-center">
                                        {{ $orderDetail->pivot->quantity }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="clearfix float-right">
                <div class="no-print text-right">
                    <a href="{{ route('invoice.download', $order->id) }}" type="button" class="btn btn-icon btn-light"><i
                            class="las la-print"></i></a>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#assign_deliver_boy').on('change', function() {
            var order_id = {{ $order->id }};
            var delivery_boy = $('#assign_deliver_boy').val();
            $.post('{{ route('orders.delivery-boy-assign') }}', {
                _token: '{{ @csrf_token() }}',
                order_id: order_id,
                delivery_boy: delivery_boy
            }, function(data) {
                AIZ.plugins.notify('success', '{{ translate('Delivery boy has been assigned') }}');
            });
        });
        $('#update_delivery_status').on('change', function() {
            var order_id = {{ $order->id }};
            var status = $('#update_delivery_status').val();
            $.post('{{ route('orders.update_delivery_status') }}', {
                _token: '{{ @csrf_token() }}',
                order_id: order_id,
                status: status
            }, function(data) {
                AIZ.plugins.notify('success', '{{ translate('Delivery status has been updated') }}');
            });
        });
        $('#update_payment_status').on('change', function() {
            var order_id = {{ $order->id }};
            var status = $('#update_payment_status').val();
            $.post('{{ route('orders.update_payment_status') }}', {
                _token: '{{ @csrf_token() }}',
                order_id: order_id,
                status: status
            }, function(data) {
                AIZ.plugins.notify('success', '{{ translate('Payment status has been updated') }}');
            });
        });
        $('#update_tracking_code').on('change', function() {
            var order_id = {{ $order->id }};
            var tracking_code = $('#update_tracking_code').val();
            $.post('{{ route('orders.update_tracking_code') }}', {
                _token: '{{ @csrf_token() }}',
                order_id: order_id,
                tracking_code: tracking_code
            }, function(data) {
                AIZ.plugins.notify('success', '{{ translate('Order tracking code has been updated') }}');
            });
        });
    </script>
@endsection
