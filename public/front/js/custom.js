$(document).ready(function () {
    $("#sort").on("change", function () {
        this.form.submit();
    });

    $(".color__check input[type='checkbox']").on("change", function () {
        var colors = [];
        $(".color__check input[type='checkbox']:checked").each(function () {
            colors.push($(this).val());
        });
        var colorString = colors.join("~");
        $("#color-filter-form").append(
            "<input type='hidden' name='color' value='" + colorString + "'>"
        );
        $("#color-filter-form").submit();
    });

    $(".size__check input[type='checkbox']").on("change", function () {
        var sizes = [];
        $(".size__check input[type='checkbox']:checked").each(function () {
            sizes.push($(this).val());
        });
        var sizeString = sizes.join("~");
        $("#size-filter-form").append(
            "<input type='hidden' name='size' value='" + sizeString + "'>"
        );
        $("#size-filter-form").submit();
    });

    $(".brand__check input[type='checkbox']").on("change", function () {
        var brands = [];
        $(".brand__check input[type='checkbox']:checked").each(function () {
            brands.push($(this).val());
        });
        var brandString = brands.join("~");
        $("#brand-filter-form").append(
            "<input type='hidden' name='brand' value='" + brandString + "'>"
        );
        $("#brand-filter-form").submit();
    });
});
