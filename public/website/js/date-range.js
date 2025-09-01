/* range date picker */

$(function () {
    const $input = $('input[name="daterange"]');

    $input.daterangepicker({
        autoUpdateInput: false, // Prevent auto-filling until Apply
        maxDate: moment(), // ⛔ Prevent selecting future dates
        locale: {
            cancelLabel: "Clear",
        },
        opens: "left",
    });

    // Set value when range is applied
    $input.on("apply.daterangepicker", function (ev, picker) {
        $(this).val(
            picker.startDate.format("MM/DD/YYYY") + " - " + picker.endDate.format("MM/DD/YYYY")
        );
    });

    // Clear on cancel
    $input.on("cancel.daterangepicker", function (ev, picker) {
        $(this).val("");
    });

    // Icon click triggers input
    $(".calender_icon").on("click", function () {
        $input.trigger("click");
    });
});
