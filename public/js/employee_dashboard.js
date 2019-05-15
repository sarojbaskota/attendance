$(document).ready(function () {
    var base_url = 'http://localhost:8000';
    // for checkin in office
    $(".checkin").click(function () {
        event.preventDefault();
        swal({
            title: "Are you sure?",
            icon: "info",
            buttons: true,
        })
            .then((willAccept) => {
                if(willAccept) {
                    $.ajax({
                        // CSRF for all ajax call
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: base_url + '/employee_dashboard/checkin',
                        success: function (result) {
                            $("#check-button a").removeClass("checkin").addClass("checkout");
                            $(".attendance").text('I AM OUT');
                            location.reload();
                        }
                    });
                }
            });
    });
    // for checkout in office 
    $(".checkout").click(function () {
        event.preventDefault();
        swal({
            title: "Are you sure?",
            icon: "info",
            buttons: true,
        })
            .then((willAccept) => {
                if(willAccept) {
                    $.ajax({
                        // CSRF for all ajax call
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: base_url + '/employee_dashboard/checkout',
                        success: function (result) {
                            $("#check-button a").removeClass("checkout").addClass("checkin");
                            $(".attendance").text('I AM IN');
                            location.reload();
                        }
                    });
                }
            });
    });
    //break checkout form
    $("#break-checkout").submit(function (event) {
        event.preventDefault();
        $.ajax({
            // CSRF for all ajax call
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: base_url + '/employee_dashboard/break-checkout',
            data: $('#break-checkout').serialize(),
            success: function (result) {
                if(!result.errors) {
                    location.reload();
                }
                $(".error").text(result.errors);
            }
        });
    });
    // for breakchek in return in office 
    $("#break_button").click(function () {
        event.preventDefault();
        $.ajax({
            // CSRF for all ajax call
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: base_url + '/employee_dashboard/break-checkin',
            success: function (result) {
                location.reload();
            }
        });
    });
});
