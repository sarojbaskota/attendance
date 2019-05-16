$(document).ready(function () {
    var base_url = 'http://localhost:8000';

    //leave request form
    $("#leave-request").submit(function (event) {
        event.preventDefault();
        $.ajax({
            // CSRF for all ajax call
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: base_url + '/employee_dashboard/leaves',
            data: $('#leave-request').serialize(),
            success: function (result) {
                if(!result.errors) {
                    swal(result.status)
                        .then((willAccept) => {
                            if(willAccept) {
                                location.reload();
                            }
                        });
                    $(".error").text('field required');
                    console.log(result.errors);
                }
            }
        });
    });
});
