@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="align-items-center">
            <h1 class="h3">{{ translate('All Contacts') }}</h1>
        </div>
    </div>


    <div class="card">
        <form id="contacts-form" action="{{ route('contacts.index') }}" method="GET">

            @csrf
            <input hidden name="type" value="{{ $type }}">
            <div class="card-header row gutters-5">
                <div class="col">
                    <h5 class="mb-0 h6">{{ translate('Contacts') }}</h5>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-0">
                        <input type="text" class="form-control" id="search"
                            name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset
                            placeholder="{{ translate('Type email or name & Enter') }}">
                    </div>
                </div>
                <div class="col-md-2 ml-auto">
                    <select class="form-control" onchange="redirecToSelected($(this).val());">
                        <option value="">{{ translate('--select--') }}</option>
                        <option value="{{ route('contacts.index', ['type' => 'read']) }}"
                            @if ($type == 'read') selected @endif>{{ translate('Read') }}</option>
                        <option value="{{ route('contacts.index', ['type' => 'unread']) }}"
                            @if ($type == 'unread') selected @endif>{{ translate('Unread') }}</option>
                    </select>
                </div>
            </div>
        </form>


        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>{{ translate('Name') }}</th>
                        <th>{{ translate('E-mail') }}</th>
                        <th>{{ translate('Phone') }}</th>
                        <th>{{ translate('Message') }}</th>
                        <th class="text-right">{{ translate('Options') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $key => $contact)
                        <tr id="{{ $contact->id }}">
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ Str::limit($contact->message, 40, '...') }}</td>
                            <td class="text-right">
                                <a href="#" data-toggle="modal" data-target="#show-contact-modal"
                                    data-id="{{ $contact->id }}" data-message="{{ $contact->message }}"
                                    class="btn btn-soft-info btn-icon btn-circle btn-sm" title="{{ translate('Show') }}">
                                    <i class="las la-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $contacts->appends(request()->input())->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="show-contact-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="custom-form" action="{{ route('contacts.mark_as_read') }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title h6">{{ translate('Contact Details') }}</h5>
                        <button type="button" class="close" data-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <textarea id="contact_message" disabled class="form-control"></textarea>
                        <input type="text" name="id" id="contact_id" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ translate('Close') }}</button>
                        @can('edit_contacts')
                            @if ($type == 'unread')
                                <button type="submit" class="btn btn-primary">{{ translate('Mark As Read') }}</button>
                            @endif
                        @endcan
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).on('shown.bs.modal', function(e) {
            var src = e.relatedTarget;
            var id = src.getAttribute('data-id');
            var message = src.getAttribute('data-message');
            $('#contact_id').val(id);
            $('#contact_message').text(message);
        });

        function redirecToSelected(redirect) {
            location.href = redirect;
        }
        // Function to handle Enter keypress event on the search input
        document.getElementById('search').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent form submission
                document.getElementById('contacts-form').submit(); // Manually submit the form
            }
        });
    </script>
@endsection
