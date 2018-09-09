jQuery(function ($) {
    var service = $('#creation_validator_service');
    // When sport gets selected ...s
    service.change(function () {
        // ... retrieve the corresponding form.
        var $form = $(this).closest('form');
        // Simulate form data, but only include the selected sport value.
        var data = {};
        data[service.attr('name')] = service.val();
        // Submit data via AJAX to the form's action path.
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: data,
            success: function (html) {
                $('#creation_validator_parameters').html(
                    $(html).find('#creation_validator_parameters')
                );
            }
        });
    });
});