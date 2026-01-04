$(document).ready(function() {
    "use strict";

    let baseUrl = $('meta[name="base-url"]').attr('content');

    // Ajax data submit for normal FORM
    $("#homePageSettingsFormSave").submit(function (e) {
        e.preventDefault();

        var url = $("#homePageSettingsFormSave").attr("action");
        var csrf = $('meta[name="csrf-token"]').attr("content");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": csrf,
            },
        });
        var formData = new FormData($("#homePageSettingsFormSave")[0]);

        // Send an Ajax request to the server
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {

                if (data.error == false) {
                    toastr.success(data.msg, "Success", {
                        timeOut: 5000,
                    });

                    setTimeout(function() {
                        location.reload();
                    }, 2000); // 2000 milliseconds = 2 seconds

                } else {
                    toastr.error(data.msg, "Error", {
                        timeOut: 5000,
                    });
                }
            },
            error: function(response) {
                let data = response.responseJSON;
                if(data.message){
                    toastr.error(data.message, data.title);
                }

                $.each(data.errors, function (field_name, error) {
                    toastr.error(error, "Error:" + field_name, {
                        timeOut: 5000,
                    });
                });
            },
        });
    });

    // Ajax data submit for normal FORM
    $("#homePageSettingsFormUpdate").submit(function (e) {
        e.preventDefault();

        var url = $("#homePageSettingsFormUpdate").attr("action");
        var csrf = $('meta[name="csrf-token"]').attr("content");

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": csrf,
            },
        });
        var formData = new FormData($("#homePageSettingsFormUpdate")[0]);

        // Send an Ajax request to the server
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {

                if (data.error == false) {
                    toastr.success(data.msg, "Success", {
                        timeOut: 5000,
                    });

                    setTimeout(function() {
                        location.reload();
                    }, 2000); // 2000 milliseconds = 2 seconds

                } else {
                    toastr.error(data.msg, "Error", {
                        timeOut: 5000,
                    });
                }
            },
            error: function (response) {
                let data = response.responseJSON;
                if(data.message){
                    toastr.error(data.message, data.title);
                }

                $.each(data.errors, function (field_name, error) {
                    toastr.error(error, "Error:" + field_name, {
                        timeOut: 5000,
                    });
                });
            },
        });
    });

    /** Category */
    $(document).on("change", "#language_id", function () {
        let languageId = $(this).val();
        if (languageId) {
            axios
                .get(`${baseUrl}/admin/news/category-by-language/${languageId}`)
                .then(function (response) {
                    let data = response.data;

                    $("#category_name").html("");
                    let optionHtml = `<option value="">Select Category</option>`;
                    $.each(data, function (key, value) {
                        optionHtml += `<option value="${value.id}">${value.category_name}</option>`;
                    });

                    $("#category_name").html(optionHtml);
                    $("#category_name").select2({
                        placeholder: "Select Category",
                        allowClear: true,
                    });

                })
                .catch(function (error) {
                    console.log(error);
                });
        } else {
            $("#category_name").html("");
        }
    });

});
