var countryData = window.intlTelInputGlobals.getCountryData(),
input = document.querySelector("#phone-code");

for (var i = 0; i < countryData.length; i++) {
var country = countryData[i];
if(country.iso2 == 'bd'){
    country.dialCode = '88';
}
}

var iti = intlTelInput(input, {
separateDialCode: true,
utilsScript: utilsScriptVar,
initialCountry: 'ae', // Set the initial country to UAE
customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
    if(selectedCountryData.iso2 == 'bd'){
        return "01xxxxxxxxx";
    }
    return selectedCountryPlaceholder;
}
});

var country = iti.getSelectedCountryData();
$('input[name=country_code]').val(country.dialCode);

input.addEventListener("countrychange", function(e) {
// var currentMask = e.currentTarget.placeholder;

var country = iti.getSelectedCountryData();
$('input[name=country_code]').val(country.dialCode);

});

