var baseUrl = $('meta[name="base-url"]').attr('content');

$(document).on("click", ".view", async function () {
    let storyId = $(this).data("story");
    let storiesData = await axios.get(baseUrl + "/admin/story/" + storyId);
    let details = storiesData?.data?.details ?? [];

    let storyHtml = ``;
    details.forEach((story) => {
        storyHtml += `<tr>
            <td><img src="${baseUrl}/storage/${story?.image_path}" width="50" height="30" /></td>
            <td>${story?.title}</td>
            <td>${story?.views}</td>
        </tr>`;
    });
    
    $("#story-details").html(``);
    $("#story-details").html(storyHtml);
});

$(document).ready(function () {
    
    $('#language_id').select2({
        dropdownParent: $('#story_create')
    });

    let storyData = [];

    $(document).on('click', '#add_story_view', function () {
        let storyTitle = $('#story_title').val();
        let storyImageFile = $('#story_image')[0].files[0];
        let buttonText = $('#button_text').val() ?? 'N/A';
        let buttonLink = $('#button_link').val() ?? 'N/A';

        if (!storyTitle || !storyImageFile) {
            alert("The title and image fields are required!");
            return;
        }

        // Read the file as Base64
        const reader = new FileReader();
        reader.onload = function (e) {
            const base64Image = e.target.result; // This is the base64 string

            let rowId = Date.now();

            // Show preview
            $('#story_views_table tbody').append(`
                <tr id="row-${rowId}">
                    <td><img src="${base64Image}" alt="Story Image" width="50" height="30" /></td>
                    <td>${storyTitle}</td>
                    <td>${buttonText}</td>
                    <td>${buttonLink}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm delete-row" data-row-id="${rowId}"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            `);

            // Save into array
            storyData.push({
                id: rowId,
                title: storyTitle,
                image_base64: base64Image, // Base64 image
                text: buttonText,
                link: buttonLink,
            });

            // Clear inputs
            $('#story_title').val('');
            $('#story_image').val('');
            $('#button_text').val('');
            $('#button_link').val('');
        };

        reader.readAsDataURL(storyImageFile); // Convert file to Base64
    });

    $('#story_update').on('shown.bs.modal', function () {
        setTimeout(function () {
            const languageElement = document.getElementById('language_id_');
            const parentElement = document.getElementById('story_update');

            if (languageElement && parentElement) {
                $(languageElement).select2({
                    dropdownParent: $(parentElement)
                });
            }
        }, 100);
    });

    $(document).on('click', '#add_story_view_', function () {
        let storyTitle = $('#story_title_').val();
        let storyImageFile = $('#story_image_')[0].files[0];
        let buttonText = $('#button_text_').val() ?? 'N/A';
        let buttonLink = $('#button_link_').val() ?? 'N/A';

        if (!storyTitle || !storyImageFile) {
            alert("The title and image fields are required!");
            return;
        }

        // Read the file as Base64
        const reader = new FileReader();
        reader.onload = function (e) {
            const base64Image = e.target.result; // This is the base64 string

            let rowId = Date.now();

            // Show preview
            $('#story_views_table tbody').append(`
                <tr id="row-${rowId}">
                    <td><img src="${base64Image}" alt="Story Image" width="50" height="30" /></td>
                    <td>${storyTitle}</td>
                    <td>${buttonText}</td>
                    <td>${buttonLink}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm delete-row" data-row-id="${rowId}"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            `);

            // Save into array
            storyData.push({
                id: rowId,
                title: storyTitle,
                image_base64: base64Image, // Base64 image
                text: buttonText,
                link: buttonLink,
            });

            // Clear inputs
            $('#story_title_').val('');
            $('#story_image_').val('');
            $('#button_text_').val('');
            $('#button_link_').val('');
        };

        reader.readAsDataURL(storyImageFile); // Convert file to Base64
    });

    let deleteStory = [];
    // Delete row
    $(document).on('click', '.delete-row', function () {
        let rowId = $(this).data('row-id');
        $(this).closest('tr').remove();

        let hasNonMatchingIds = storyData.some(story => story.id === rowId);
        if (hasNonMatchingIds) {
            storyData = storyData.filter(story => story.id !== rowId);
        } else {
            deleteStory.push(rowId);
        }
    });

    // Submit form
    $(document).on('submit', '#createForm', function (e) {
        // Clear previous hidden inputs
        $('#createForm input[name^="stories"]').remove();

        storyData.forEach((story, index) => {
            $('<input>').attr({
                type: 'hidden',
                name: `stories[${index}][title]`,
                value: story.title,
            }).appendTo('#createForm');

            $('<input>').attr({
                type: 'hidden',
                name: `stories[${index}][text]`,
                value: story.text,
            }).appendTo('#createForm');

            $('<input>').attr({
                type: 'hidden',
                name: `stories[${index}][link]`,
                value: story.link,
            }).appendTo('#createForm');

            $('<input>').attr({
                type: 'hidden',
                name: `stories[${index}][image_base64]`,
                value: story.image_base64,
            }).appendTo('#createForm');
        });
    });

    $(document).on('submit', '#editForm', function (e) {
        // Clear previous hidden inputs
        $('#editForm input[name^="stories"]').remove();

        if (deleteStory.length > 0) {
            $('#editForm input[name="deleteStory[]"]').remove();
        }

        storyData.forEach((story, index) => {
            $('<input>').attr({
                type: 'hidden',
                name: `stories[${index}][title]`,
                value: story.title,
            }).appendTo('#editForm');

            $('<input>').attr({
                type: 'hidden',
                name: `stories[${index}][text]`,
                value: story.text,
            }).appendTo('#editForm');

            $('<input>').attr({
                type: 'hidden',
                name: `stories[${index}][link]`,
                value: story.link,
            }).appendTo('#editForm');

            $('<input>').attr({
                type: 'hidden',
                name: `stories[${index}][image_base64]`,
                value: story.image_base64,
            }).appendTo('#editForm');
        });

        if (deleteStory.length > 0) {
            deleteStory.forEach((rowId) => {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'deleteStory[]',
                    value: rowId,
                }).appendTo('#editForm');
            });
        }

        // Allow form to continue submitting
    });

    $(document).on("click", ".edit-story", async function () {
        let storyId = $(this).data("story");
        let storiesData = await axios.get(baseUrl + "/admin/story/" + storyId + "/edit");

        storyData = [];
        deleteStory = [];

        $(".story_update_data").html(``);
        $(".story_update_data").html(storiesData?.data);
    });
    
});
