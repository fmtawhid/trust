"use strict";

/**
 * Report Create callback function
 */
var showCallBackData = function (response) {
    if (!response || typeof response !== "object" || !response.data) {
        console.warn("⚠️ showCallBackData called with invalid data:", response);
        return;
    }

    let data = response.data;
};

/**
 * Report View callback function
 */
var showCallBackViewData = function (response) {
    // ✅ safety check — prevents undefined errors
    if (!response || typeof response !== "object" || !response.data) {
        console.warn("⚠️ showCallBackViewData called with invalid data:", response);
        return;
    }

    let data = response.data;
    let title = data.title ?? "";

    // Set default dimensions
    $("#thumb_height").val(280);
    $("#thumb_width").val(400);
    $("#large_height").val(451);
    $("#large_width").val(643);

    // Build the image preview HTML
    let html = `
        <div class="m-2 photo-library-element"
            data-id="${data.uuid ?? ''}"
            data-actual_image_name="${data.actual_image_name ?? ''}"
            data-thumb_image="${data.thumb_image_path ?? ''}"
            data-caption="${title}">
            <p>${title}</p>
            <img class="img-responsive img-thumbnail photo-library-img"
                src="${data.thumb_image_path ?? ''}"
                height="100" width="100"
                alt="${title}" />
        </div>
    `;

    // Append and auto-select the new image
    $("#show-images").append(html);

    setTimeout(function () {
        $('#show-images .photo-library-element').last().trigger('click');
    }, 100);
};
