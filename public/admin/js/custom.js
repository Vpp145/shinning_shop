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

    //update category status
    $(document).on("click", ".updateCategoryStatus", function () {
        var status = $(this).children("i").attr("status");
        var category_id = $(this).attr("category_id");

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-category-status",
            data: { status: status, category_id: category_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#category-" + category_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#category-" + category_id).html(
                        "<i class='fas fa-toggle-on' style='color:#3f6ed3' status='Active'></i>"
                    );
                }
            },
            error: function (err) {
                console.log("error", err);
            },
        });
    });

    //update product status
    $(document).on("click", ".updateProductStatus", function () {
        var status = $(this).children("i").attr("status");
        var product_id = $(this).attr("product_id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/admin/update-product-status",
            data: { status: status, product_id: product_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#product-" + product_id).html(
                        "<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>"
                    );
                } else if (resp["status"] == 1) {
                    $("#product-" + product_id).html(
                        "<i class='fas fa-toggle-on' style='color:#3f6ed3' status='Active'></i>"
                    );
                }
            },
            error: function (err) {
                console.log("error", err);
            },
        });
    });

    //Add Attribtute Script
    var maxField = 10;
    var addButton = $(".add_button");
    var wrapper = $(".field_wrapper");
    var fieldHTML =
        "<div class='controls field_wrapper' style='margin-left: 0px; margin-top: 10px;'><input type='text' name='sku[]' style='width: 120px'/>&nbsp;<input type='text' name='size[]' style='width: 120px'/>&nbsp;<input type='text' name='price[]' style='width: 120px'/>&nbsp;<input type='text' name='stock[]' style='width: 120px'/>&nbsp;<a href='javascript:void(0);' class='remove_button' title='Remove field'><i class='fas fa-minus'></i></a></div>";
    var x = 1;
    $(addButton).click(function () {
        if (x < maxField) {
            x++;
            $(wrapper).append(fieldHTML);
        }
    });
    $(wrapper).on("click", ".remove_button", function (e) {
        e.preventDefault();
        $(this).parent("div").remove();
        x--;
    });
});
