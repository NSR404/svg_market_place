@extends('backend.layouts.app')

@section('content')
    @php
        //CoreComponentRepository::instantiateShopRepository();
        ////CoreComponentRepository::initializeCache();
    @endphp

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('All User Groups') }}</h1>
            </div>
            @can('add_user_emails')
                <div class="col-md-6 text-md-right">
                    <a data-toggle="modal" data-target="#create-update-user-email-modal" data-is-create="1"
                        data-form-action="{{ route('user-emails.store') }}" class="btn btn-primary">
                        <span>{{ translate('Add New User Email') }}</span>
                    </a>
                </div>
            @endcan
        </div>
    </div>
    <div class="card">
        <div class="card-header d-block d-md-flex">
            <h5 class="mb-0 h6">{{ translate('Users Emails') }}</h5>
            <form class="" id="sort_categories" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search"
                            name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset
                            placeholder="{{ translate('Type name & Enter') }}">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th data-breakpoints="lg">#</th>
                        <th>{{ translate('Name') }}</th>
                        <th>{{ translate('Email') }}</th>
                        <th>{{ translate('Group') }}</th>
                        <th width="10%" class="text-right">{{ translate('Options') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 + ($users->currentPage() - 1) * $users->perPage() }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{ $user->group->name }}
                            </td>
                            <td class="text-right">
                                @can('edit_user_group')
                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" data-toggle="modal"
                                        data-target="#create-update-user-email-modal"
                                        data-form-action="{{ route('user-emails.update', $user->id) }}" data-is-create="0"
                                        data-user-name="{{ $user->name }}" data-group-id="{{ $user->group->id }}"
                                        data-user-email="{{ $user->email }}" title="{{ translate('Edit') }}">
                                        <i class="las la-edit"></i>
                                    </a>
                                @endcan
                                @can('delete_user_group')
                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                        data-href="{{ route('user-emails.destroy', $user->id) }}"
                                        title="{{ translate('Delete') }}">
                                        <i class="las la-trash"></i>
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $users->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
@endsection



@section('modal')
    @include('modals.delete_modal')
    @include('backend.marketing.user_emails.create-update-user-email-modal')
@endsection


@section('script')
    <script>
        $(document).on('shown.bs.modal', '#create-update-user-email-modal', function(e) {
            var src = e.relatedTarget;
            var is_create = src.getAttribute('data-is-create');
            var form_action = src.getAttribute('data-form-action');
            var form_method = is_create == true ? "POST" : "PUT";
            var name = is_create == true ? null : src.getAttribute('data-user-name');
            var email = is_create == true ? null : src.getAttribute('data-user-email');
            var group_id = is_create == true ? null : src.getAttribute('data-group-id');
            var header_title = is_create == true ? "{{ translate('Create New Group') }}" : (
                "{{ translate('Update Group : ') }}" + src.getAttribute('data-user-name'));
            $(this).find('.modal-title').text(header_title);
            $(this).find('form').attr('action', form_action);
            $(this).find('form input[name="_method"]').val(form_method);
            $(this).find('form input[name="name"]').val(name);
            $(this).find('form input[name="email"]').val(email);
            $(this).find('form select[name="group_id"]').val(group_id);
        });
    </script>
@endsection
