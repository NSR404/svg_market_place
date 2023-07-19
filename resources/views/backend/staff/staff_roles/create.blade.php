@extends('backend.layouts.app')

@section('content')
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Role Information') }}</h5>
            </div>
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label" for="name">{{ translate('Name') }}</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="{{ translate('Name') }}" id="name" name="name"
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('Permissions') }}</h5>
                    </div>
                    <br>
                    @php
                        $exclueded_sections = [ 'seller'];
                        $excluded_permissions = [
                            'delete_classified_package',
                            'seller_verification_form_configuration',
                            'wallet_transaction_report',
                            'show_seller_products',
                            'show_digital_products',
                            'add_digital_product',
                            'edit_digital_product',
                            'delete_digital_product',
                            'delete_digital_product',
                            'product_bulk_import',
                            'product_bulk_export',
                            'download_digital_product',
                            'view_seller_orders',
                            'view_pickup_point_orders',
                            'update_order_payment_status',
                            'view_classified_products',
                            'publish_classified_product',
                            'delete_classified_product',
                            'view_classified_packages',
                            'add_classified_package',
                            'edit_classified_package',
                            'delete_classified_packages',
                            'wallet_transaction_report',
                            'commission_history_report',
                            'seller_products_sale_report',
                            'seller_products_sale_report',
                            'products_stock_report',
                            'features_activation',
                            'currency_setup',
                            'vat_&_tax_setup',
                            'pickup_point_setup',
                            'smtp_settings',
                            'payment_methods_configurations',
                            'order_configuration',
                            'file_system_&_cache_configuration',
                            'social_media_logins',
                            'facebook_chat',
                            'facebook_comment',
                            'google_recaptcha_configuration',
                            'google_map_setting',
                            'google_firebase_setting',
                            'shipping_configuration',
                            'shipping_country_setting',
                            'manage_shipping_states',
                            'manage_shipping_cities',
                            'manage_zones',
                            'manage_carriers',
                            'system_update',
                            'server_status',
                            'manage_addons',
                        ];
                        $permission_groups = \App\Models\Permission::all()
                            ->whereNotIn('section', $exclueded_sections)
                            ->whereNotIn('name', $excluded_permissions)
                            ->groupBy('section');
                        $addons = ['offline_payment', 'club_point', 'pos_system', 'paytm', 'seller_subscription', 'otp_system', 'refund_request', 'affiliate_system', 'african_pg', 'delivery_boy', 'auction', 'wholesale'];
                    @endphp
                    @foreach ($permission_groups as $key => $permission_group)
                        @php
                            $show_permission_group = true;

                            if (in_array($permission_group[0]['section'], $addons)) {
                                if (addon_is_activated($permission_group[0]['section']) == false) {
                                    $show_permission_group = false;
                                }
                            }
                        @endphp
                        @if ($show_permission_group)
                            <ul class="list-group mb-4">
                                <li class="list-group-item bg-light" aria-current="true">
                                    {{ translate(Str::headline($permission_group[0]['section'])) }}</li>
                                <li class="list-group-item">
                                    <div class="row">
                                        @foreach ($permission_group as $key => $permission)
                                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                                <div class="p-2 border mt-1 mb-2">
                                                    <label
                                                        class="control-label d-flex">{{ translate(Str::headline($permission->name)) }}</label>
                                                    <label class="aiz-switch aiz-switch-success">
                                                        <input type="checkbox" name="permissions[]"
                                                            class="form-control demo-sw" value="{{ $permission->id }}">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </li>
                            </ul>
                        @endif
                    @endforeach

                    <div class="form-group mb-3 mt-3 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
