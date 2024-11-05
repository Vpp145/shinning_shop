$(document).ready(function () {
    //check password correct or not
    $("#current_pwd").keyup(function () {
        var current_pwd = $("#current_pwd").val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/check-current-password",
            data: {
                current_pwd,
            },
            success: function (resp) {
                if (resp == "false") {
                    $("#verifyCurrentPwd").html(
                        "<font color='red'>Current password is incorrect</font>"
                    );
                } else if (resp == "true") {
                    $("#verifyCurrentPwd").html(
                        "<font color='green'>Current password is correct</font>"
                    );
                }
            },
            error: function (err) {
                console.log("error", err);
            },
        });
    });
});
