<form class="form-default" role="form" action="{{ route('addresses.update', $address_data->id) }}" method="POST">
    @csrf
    <div class="p-3">
        @guest
            <!-- Name -->
            <div class="row">
                <div class="col-md-2">
                    <label>{{ translate('Name') }}</label>
                </div>
                <div class="col-md-10">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" required value="{{ $address_data->name }}">
                    </div>
                </div>
            </div>
            <input type="text" name="user_id" value="{{ request()->session()->get('temp_user_id') }}" hidden>
        @endguest
        <!-- Country -->
        <div class="row">
            <div class="col-md-2">
                <label>{{ translate('Country') }}</label>
            </div>
            <div class="col-md-10">
                <div class="mb-3">
                    <select class="form-control aiz-selectpicker rounded-0" data-live-search="true"
                        data-placeholder="{{ translate('Select your country') }}" name="country_id" id="edit_country"
                        required>
                        <option value="">{{ translate('Select your country') }}</option>
                        @foreach ($countries as $key => $country)
                            <option value="{{ $country->id }}" @if ($address_data->country_id == $country->id) selected @endif>
                                {{ $country->getTranslation('name') }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- State -->
        {{-- <div class="row">
            <div class="col-md-2">
                <label>{{ translate('State') }}</label>
            </div>
            <div class="col-md-10">
                <select class="form-control mb-3 aiz-selectpicker rounded-0" name="state_id" id="edit_state"
                    data-live-search="true" required>
                    @foreach ($states as $key => $state)
                        <option value="{{ $state->id }}" @if ($address_data->state_id == $state->id) selected @endif>
                            {{ __('custom.' . $state->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div> --}}


        <!-- Phone -->
        <div class="row">
            <div class="col-md-2">
                <label>{{ translate('Phone') }}</label>
            </div>
            <div class="col-md-10">
                <input type="tel" id="phone-code-2" class="form-control mb-3 rounded-0"
                    value="{{ $address_data->phone }}" name="phone" required>
                <input type="text" hidden name="country_code">
            </div>
        </div>

        <!-- Save button -->
        <div class="form-group text-right mt-2">
            <button type="submit" class="btn btn-primary rounded-0 w-150px">{{ translate('Save') }}</button>
        </div>
    </div>
</form>

<script>
    var countryData = window.intlTelInputGlobals.getCountryData(),
        input = document.querySelector("#phone-code-2"),
        currentDialCode = "{{ $address_data->phone_country_code }}";

    for (var i = 0; i < countryData.length; i++) {
        var country = countryData[i];
        if (country.dialCode == currentDialCode) {
            iniCountry = country.iso2;
        }
    }

    var iti = intlTelInput(input, {
        separateDialCode: true,
        utilsScript: utilsScriptVar,
        initialCountry: iniCountry,
        search: true,
        customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
            if (selectedCountryData.iso2 == 'bd') {
                return "01xxxxxxxxx";
            }
            return selectedCountryPlaceholder;
        }
    });

    var country = iti.getSelectedCountryData();
    $('input[name=country_code]').val("{{ $address_data->phone_country_code }}");

    input.addEventListener("countrychange", function(e) {
        // var currentMask = e.currentTarget.placeholder;

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

    });

    function get_states(country_id) {
        $('[name="state"]').html("");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('get-state') }}",
            type: 'POST',
            data: {
                country_id: country_id
            },
            success: function(response) {
                var obj = JSON.parse(response);
                if (obj != '') {
                    $('[name="state_id"]').html(obj);
                    AIZ.plugins.bootstrapSelect('refresh');
                }
            }
        });
    }

    $(document).on('change', '[name=country_id]', function() {
        var country_id = $(this).val();
        get_states(country_id);
    });
</script>
