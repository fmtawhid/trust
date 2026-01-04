("use strict");
$(document).ready(function () {
    $(document).on("submit", "#data-table-filter", function (e) {
        e.preventDefault();
        let form = $(e.target);
        let table = $($(form.data("filter-table")));

        let from_date = form.find("input[name='from_date']").val();
        let to_date = form.find("input[name='to_date']").val();
        let title = form.find("input[name='title']").val();
        let other_page = form.find("select[name='other_page']").val();
        let sub_category = form.find("select[name='sub_category_id']").val();

        table.on("preXhr.dt", function (e, settings, data) {
            data.from_date = from_date;
            data.to_date = to_date;
            data.title = title;
            data.other_page = other_page;
            data.sub_category_id = sub_category;
        });
        table.DataTable().ajax.reload();
    });
    $(document).on("reset", "#data-table-filter", function (e) {
        e.preventDefault();
        let form = $(e.target);
        let table = $($(form.data("filter-table")));

        form.find("input[name='from_date']").val('');
        form.find("input[name='to_date']").val('');
        form.find("input[name='title']").val('');
        form.find("select[name='other_page']").val('').trigger('change');
        form.find("select[name='sub_category_id']").val('').trigger('change');

        table.on("preXhr.dt", function (e, settings, data) {
            data.from_date = '';
            data.to_date = '';
            data.title = '';
            data.other_page = '';
            data.sub_category_id = '';
        });
        table.DataTable().ajax.reload();
    });

    /** Sub-category */
    let baseUrl = $('meta[name="base-url"]').attr('content');
    $(document).on("change", "#other_page", function () {
        let categoryId = $(this).val();
        if (categoryId) {
            axios
                .get(`${baseUrl}/admin/news/sub-category/${categoryId}`)
                .then(function (response) {
                    let data = response.data;
                    $("#sub_category_id").html("");
                    let optionHtml = `<option value="">Select Sub Category</option>`;
                    $.each(data, function (key, value) {
                        optionHtml += `<option value="${value.id}">${value.category_name}</option>`;
                    });

                    $("#sub_category_id").html(optionHtml);
                    $("#sub_category_id").select2({
                        placeholder: "Select Sub Category",
                        allowClear: true,
                    });

                })
                .catch(function (error) {
                    console.log(error);
                });
        } else {
            $("#sub_category_id").html("");
        }
    });
});


$(document).on("click", ".auto-social-post-btn", function () {
    const thisAction = $(this);
    let action = thisAction.attr("data-action");

    Swal.fire({
        title: "Do you want to share this post on social media?",
        confirmButtonText: "Yes",
        showDenyButton: true,
        denyButtonText: `No`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: action,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader(
                        "X-CSRF-Token",
                        $('meta[name="csrf-token"]').attr("content")
                    );
                },
                type: "PATCH",
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        success_alert(response.message, response.title);
                        thisAction.parent().html(response.data);

                        $("#news-table").DataTable().ajax.reload();
                    } else {
                        error_alert(response.message, response.title);
                    }
                },
                error: function (response) {
                    let data = response.responseJSON;
                    error_alert(data.message, data.title);
                },
            });
        }
    });
});