var preloader = document.getElementById('preloader');
$(document).ready(function () {
    // Hide the preloader initially
    preloader.style.display = 'none';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    /* ############# GENERAL FORM SUBMIT ################ */

    $(document).on('submit', '.custom-form', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        preloader.style.display = 'block';
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            processData: false,
            contentType: false,
            data: formData,
            enctype: "multipart/form-data",
            success: function (response) {
                if (response.status) {
                    AIZ.plugins.notify('success', response.message);
                } else {
                    AIZ.plugins.notify('danger', response.message);
                }
                if (response.reset_form) {
                    $(this).trigger('reset');
                }
                if (response.modal_to_hide) {
                    $(response.modal_to_hide).modal('hide');
                }
                if (response.reload) {
                    location.reload();
                }
                if (response.redirect) {
                    location.href = response.redirect;
                }
                if (response.row_to_delete) {
                    $('#' + response.row_to_delete).remove();
                }
                preloader.style.display = 'none';
            }, error: function (response) {
                console.log(response);
                if (response.status == 422) {
                    $.each(response.responseJSON.errors, function (key, errorsArray) {
                        $.each(errorsArray, function (item, error) {
                            AIZ.plugins.notify('danger', error);

                        });
                    });
                } else if (response.responseJSON && response.responseJSON.message) {
                    AIZ.plugins.notify('danger', response.responseJSON.message);
                } else {
                    AIZ.plugins.notify('danger', response.message);
                }
                preloader.style.display = 'none';
            }
        });
    });

    /* ############# GENERAL FORM SUBMIT ################ */




    // English Inputs
    // Get all input elements with the specified class
    const inputs = document.querySelectorAll('.en-only');

    // Iterate over each input and attach event listeners
    inputs.forEach((input) => {
        input.addEventListener('input', (event) => {
            const inputValue = event.target.value;
            const englishCharsRegex = /^[a-zA-Z0-9 -]*$/;

            if (!englishCharsRegex.test(inputValue)) {
                const englishCharsOnly = inputValue.replace(/[^a-zA-Z0-9 -]/g, '');
                event.target.value = englishCharsOnly;
            }
        });
    });


    // Arabic Inputs
    // Get all input elements with the specified class
    const arabicInputs = document.querySelectorAll('.ar-only');

    // Iterate over each input and attach event listeners
    arabicInputs.forEach((input) => {
        input.addEventListener('input', (event) => {
            const arabicInputValue = event.target.value;
            const arabicCharsRegex = /^[\u0600-\u06FF0-9 -]*$/;

            if (!arabicCharsRegex.test(arabicInputValue)) {
                const arabicCharsOnly = arabicInputValue.replace(/[^\u0600-\u06FF0-9 -]/g, '');
                event.target.value = arabicCharsOnly;
            }
        });
    });



});
