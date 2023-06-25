<form class="form-default" role="form" action="{{ route('addresses.update', $address_data->id) }}" method="POST">
    @csrf
    <div class="p-3">

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

        <!-- Address -->
        <div class="row">
            <div class="col-md-2">
                <label>{{ translate('Address') }}</label>
            </div>
            <div class="col-md-10">
                <textarea class="form-control mb-3 rounded-0" placeholder="{{ translate('Your Address') }}" rows="2"
                    name="address" required>{{ $address_data->address }}</textarea>
            </div>
        </div>


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
        currentDialCode     =   "{{ $address_data->phone_country_code }}";

    for (var i = 0; i < countryData.length; i++) {
        var country = countryData[i];
        if(country.dialCode == currentDialCode)
        {
            iniCountry      =   country.iso2;
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
</script>
