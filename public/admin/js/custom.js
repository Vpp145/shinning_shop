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
                current_pwd: current_pwd,
            },
            success: function (resp) {
                if (resp == false) {
                    $("#verifyCurrentPwd").html(
                        "<font color='red'>Current password is incorrect</font>"
                    );
                } else if (resp == true) {
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

    //active/inactive
    $(document).on("click", ".updateCmsPageStatus", function () {
        var status = $(this).children("i").attr("status");
        var page_id = $(this).attr("page_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-cms-page-status",
            data: { status: status, page_id: page_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#page-" + page_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey' aria-hidden='true' status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#page-" + page_id).html(
                        "<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>"
                    );
                }
            },
            error: function (err) {
                console.log("error", err);
            },
        });
    });

    // confirm deletion of cms pages
    // $(".confirmDelete").click(function () {
    //     var name = $(this).attr("name");
    //     if (confirm("Are you sure you want to delete " + name + "?")) {
    //         return true;
    //     }
    //     return false;
    // });

    // confirm deletion of cms pages2
    $(document).on("click", ".confirmDelete", function () {
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.value) {
                Swal.fire("Deleted!", "Your file has been deleted.", "success");
                window.location.href =
                    "/admin/delete-" + record + "/" + recordid;
            }
        });
    });

    // subadmin active , inactive
    $(document).on("click", ".updateSubadminStatus", function () {
        var status = $(this).children("i").attr("status");
        var subadmin_id = $(this).attr("subadmin_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-subadmin-status",
            data: { status: status, subadmin_id: subadmin_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#subadmin-" + subadmin_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey' aria-hidden='true' status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#subadmin-" + subadmin_id).html(
                        "<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>"
                    );
                }
            },
            error: function (err) {
                console.log("error", err);
            },
        });
    });
});
