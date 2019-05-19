$(document).ready(function () {
    var base_url = "http://localhost:8000";
    // create username
    $("#create_user").click(function (event) {
        event.preventDefault();
        $('#myModal_create').modal({ backdrop: 'static', keyboard: false })
    }); // store data with ajax username
    $("#post_create_form .post_form").on("click", function (event) {
        event.preventDefault();
        var full_name = $("#post_create_form .full_name").val();
        var username = $("#post_create_form .username").val();
        var role = $("#post_create_form .role").val();
        var status = $("#post_create_form .status").val();
        var email = $("#post_create_form .email").val();
        var password = $("#post_create_form .password").val();
        var password_confirmation = $(
            "#post_create_form .password_confirmation"
        ).val();

        var formData = new FormData($("#post_create_form")[0]);
        var file = $(".profile_avatar")[0].files[0];

        formData.append("profile_avatar", file);
        formData.append("full_name", full_name);
        formData.append("username", username);
        formData.append("role", role);
        formData.append("status", status);
        formData.append("email", email);
        formData.append("password", password);
        formData.append("password_confirmation", password_confirmation);

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: base_url + "/administration/users",
            method: "POST",
            dataType: "JSON",
            enctype: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            data: formData,
            success: function (result) {
                if(result.errors) {
                    if(result.errors.profile_avatar) {
                        $(".profile_error").text(result.errors.profile_avatar);
                    }
                    if(result.errors.username) {
                        $(".username_error").text(result.errors.username);
                    }
                    if(result.errors.password) {
                        $(".password_error").text(result.errors.password);
                    }
                    if(result.errors.password_confirmation) {
                        $(".password_con_error").text(result.errors.password_confirmation);
                    }
                    if(result.errors.email) {
                        $(".email_error").text(result.errors.email);
                    }
                    if(result.errors.full_name) {
                        $(".full_name_error").text(result.errors.full_name);
                    }
                    if(result.errors.role) {
                        $(".role_error").text(result.errors.role);
                    }
                }
                swal(result.success, "success").then(function (isConfirm) {
                    $("#post_create_form").trigger("reset");
                    $("#post_create_form").modal("hide");
                });
            },
        });
    });

    // view quick details of user
    $(".show-details").click(function (event) {
        var id = $(this).data("id");
        event.preventDefault();
        $.ajax({
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: base_url + "/administration/users/" + id,
            success: function (data) {
                console.log(data);
                $("#show_modal").html(data);
                $("#users_myModal_show").modal("show");
            }
        });
    });
    // edit user
    $(".edit-user").click(function (event) {
        var id = $(this).data("id");
        event.preventDefault();
        $.ajax({
            type: "GET",
            url: base_url + "/administration/users/" + id + "/edit/",
            success: function (data) {
                $(".user_id").val(data.id);
                $(".full_name").val(data.full_name);
                $(".username").val(data.username);
                $(".role").val(data.role);
                $(".email").val(data.email);
                // $("#myModal_edit").modal("show");
                $('#myModal_edit').modal({ backdrop: 'static', keyboard: false })
            }
        });
    });

    $("#myupdate .update_form").on("click", function (event) {
        event.preventDefault();
        var id = $("#myupdate .user_id").val();
        var full_name = $("#myupdate .full_name").val();
        var username = $("#myupdate .username").val();
        var role = $("#myupdate .role").val();
        var email = $("#myupdate .email").val();
        var formData = new FormData($("#myupdate")[0]);
        var file = $("#myupdate .profile_avatar")[0].files[0];

        formData.append("profile_avatar", file);
        formData.append("full_name", full_name);
        formData.append("username", username);
        formData.append("role", role);
        formData.append("email", email);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: base_url + "/administration/users/" + id,
            method: "POST", //PUT| Patch
            dataType: "JSON",
            enctype: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
            data: formData,
            success: function (result) {
                if(result.errors) {
                    if(result.errors.profile_avatar) {
                        $(".profile_error").text(result.errors.profile_avatar);
                    }
                    if(result.errors.username) {
                        $(".username_error").text(result.errors.username);
                    }
                    // if(result.errors.password) {
                    //     $(".password_error").text(result.errors.password);
                    // }
                    // if(result.errors.password_confirmation) {
                    //     $(".password_con_error").text(result.errors.password_confirmation);
                    // }
                    if(result.errors.email) {
                        $(".email_error").text(result.errors.email);
                    }
                    if(result.errors.full_name) {
                        $(".full_name_error").text(result.errors.full_name);
                    }
                    if(result.errors.role) {
                        $(".role_error").text(result.errors.role);
                    }
                }
                swal(result.status, "success").then(function (isConfirm) {
                    $("#update_form").trigger("reset");
                    $("#myModal_edit").modal("hide");
                    location.reload();
                });
            },
        });
    });

    // delete user
    $(".delete-user").click(function (event) {
        var id = $(this).data("id");
        event.preventDefault();
        if(confirm("Are Sure ?")) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                method: "DELETE",
                url: base_url + "/administration/users/" + id,
                success: function (result) {
                    swal(result.status, "success").then(function (isConfirm) {
                        location.reload();
                    });
                }
            });
        } else {
            alert("Your Record Is Save !");
        }
    });

    // change status of user
    $(".status_change").click(function (event) {
        var id = $(this).data("id");
        event.preventDefault();
        if(confirm("Are Sure ?")) {
            $.ajax({
                type: "GET",
                url: "/administration/status_change/" + id,
                success: function (result) {
                    console.log(result);
                    swal(result.success, "success").then(function (isConfirm) {
                        location.reload();
                    });
                }
            });
        } else {
            swal("Nothing change !");
        }
    });
});
