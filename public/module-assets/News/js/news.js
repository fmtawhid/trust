document.addEventListener('DOMContentLoaded', () => {
    let aiGeneratedText = '';
    console.log("Tested AI");
    // ✅ 1️⃣ Config div থেকে ডেটা পড়া
    const aiConfig = document.getElementById('aiConfig');
    const generateUrl = aiConfig.dataset.generateUrl;
    const csrfToken = aiConfig.dataset.csrfToken;

    // ✅ 2️⃣ Generate Text
    document.getElementById('generateTextBtn').addEventListener('click', () => {
        const aiCommand = document.getElementById('aiCommand');
        const aiResponseArea = document.getElementById('aiResponseArea');
        const prompt = aiCommand.value.trim();

        if (!prompt) {
            alert('Please enter your command.');
            return;
        }

        aiResponseArea.innerHTML = '<em>Generating...</em>';

        fetch(generateUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ prompt })
        })
        .then(res => res.json())
        .then(data => {
            console.log(data.text);
            if (data.error) {
                aiGeneratedText = '';
                aiResponseArea.innerHTML = '<span class="text-danger">' + data.error + '</span>';
            } else {
                aiGeneratedText = data.text ?? '';
                aiResponseArea.innerHTML = '<div style="white-space: pre-wrap;">' + aiGeneratedText + '</div>';
            }
        })
        .catch(() => {
            aiGeneratedText = '';
            aiResponseArea.innerHTML = '<span class="text-danger">Something went wrong!</span>';
        });
    });

    // ✅ 3️⃣ Use Text
    document.getElementById('useTextBtn').addEventListener('click', () => {
        if (!aiGeneratedText.trim()) {
            alert('No generated text available.');
            return;
        }

        const detailsNews = document.getElementById('details_news');
        if (detailsNews) {
            if (window.CKEDITOR && CKEDITOR.instances && CKEDITOR.instances.details_news) {
                CKEDITOR.instances.details_news.setData(aiGeneratedText);
                console.log('Used CKEditor API to set data.');
            }
            else if (window.ClassicEditor) {
                if (detailsNews.editorInstance) {
                    detailsNews.editorInstance.setData(aiGeneratedText);
                    console.log('Used CKEditor 5 instance to set data.');
                }
            }
            else {
                detailsNews.value = aiGeneratedText;
                console.log('Set plain textarea value.');
            }
        }

        // Close modal
        const modalEl = document.getElementById('aiWriterModal');
        if (modalEl) {
            const modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modalInstance.hide();
        }
    });
});



var image_up_route = $("#image_up").val();

CKEDITOR.replace("details_news", {
    filebrowserUploadUrl: image_up_route,
    filebrowserUploadMethod: "form",
});

/**
 * create callback function
 */
var showCallBackData = function (response) {
    let data = response.data;

    setTimeout(() => {
        $("#photo-library-preview").html("");
        $("#latest_confirmed").prop("checked", true);
        $("#status_confirmed").prop("checked", true);

        $("#report_modal").modal("hide");
    }, 3000);
};

/**
 * Report Create callback function
 */
var showCallBackReportData = function (response) {
    let data = response.data;
    if (data) {
        $("#reporter_id").append(new Option(data.name, data.id));
    }

    $("#report_modal").modal("hide");
};





/**
 * Report Update callback function
 */
var showCallBackUpdateData = function (response) {
    let data = response.data;
    let redirectUrl = $("#newsDetailsForm").attr("data-redirect-url");
    if (redirectUrl) {
        setTimeout(() => {
            window.location.href = redirectUrl;
        }, 3000);
    }

    $("#photo-library-preview").html("");
};

("use strict");
$(document).ready(function () {
    $("#slug").hide();
    $(".page_slug a").on("click", function () {
        $("#slug").toggle("show");
    });

    $("#post_tag").tagsinput();
    $("#meta_keyword").tagsinput();

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

    /** Category */
    $(document).on("change", "#language_id", function () {
        let languageId = $(this).val();
        if (languageId) {
            axios
                .get(`${baseUrl}/admin/news/category-by-language/${languageId}`)
                .then(function (response) {
                    let data = response.data;

                    $("#other_page").html("");
                    let optionHtml = `<option value="">Select Category</option>`;
                    $.each(data, function (key, value) {
                        optionHtml += `<option value="${value.id}">${value.category_name}</option>`;
                    });

                    $("#other_page").html(optionHtml);
                    $("#other_page").select2({
                        placeholder: "Select Category",
                        allowClear: true,
                    });

                })
                .catch(function (error) {
                    console.log(error);
                });
        } else {
            $("#other_page").html("");
        }
    });

});
