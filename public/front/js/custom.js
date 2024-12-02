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
});
