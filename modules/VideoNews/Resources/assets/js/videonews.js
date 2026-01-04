var image_up_route = $("#image_up").val();

CKEDITOR.replace("details", {
    filebrowserUploadUrl: image_up_route,
    filebrowserUploadMethod: "form",
});


let uploadedImageDataURL = null;

// Image preview
$(document).on('change', '#image', function () {
    const file = this.files[0];
    const reader = new FileReader();
    reader.onload = function (e) {
        uploadedImageDataURL = e.target.result;
        $('#output').attr('src', uploadedImageDataURL);
    };
    reader.readAsDataURL(file);
});

// Video file preview
$(document).on('change', '#video', function () {
    const file = this.files[0];
    if (file) {
        const videoURL = URL.createObjectURL(file);
        const $video = $('#videoPreview');
        const $iframe = $('#videoIframe');

        $video.find('source').attr('src', videoURL);

        const posterToUse = $('#output').attr('src') || $('#defaultPosterUrl').val();
        $video.attr('poster', posterToUse);

        $iframe.addClass('d-none'); // Hide iframe
        $video.removeClass('d-none').show(); // Show video tag
        $video[0].load();
    }
});

// Video URL input
$(document).on('input', '#video_url', function () {
    const url = $(this).val().trim();
    const $video = $('#videoPreview');
    const $iframe = $('#videoIframe');

    if (url) {
        let embedUrl = getEmbedUrl(url);
        if (embedUrl) {
            $iframe.attr('src', embedUrl);
            $video.addClass('d-none'); // Hide video file preview
            $iframe.removeClass('d-none').show(); // Show iframe
        }
    } else {
        $iframe.attr('src', '').addClass('d-none');
        $video.removeClass('d-none').show();
    }
});

// Convert YouTube/Vimeo links to embeddable URL
function getEmbedUrl(url) {
    const youtubeMatch = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\s&]+)/);
    const vimeoMatch = url.match(/vimeo\.com\/(\d+)/);

    if (youtubeMatch) {
        return `https://www.youtube.com/embed/${youtubeMatch[1]}`;
    } else if (vimeoMatch) {
        return `https://player.vimeo.com/video/${vimeoMatch[1]}`;
    }

    return null;
}



// Delete video while update if need 
$(document).on('click', '.videonews-delete-btn', function () {
    let route = $(this).data('route');
    let csrf = $(this).data('csrf');

    Swal.fire({
        title: 'Delete Video?',
        text: 'Are you sure you want to delete the uploaded video?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(route, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Content-Type': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Deleted!', 'The video has been removed.', 'success');

                    // Hide delete button
                    document.getElementById('deleteVideoBtn').style.display = 'none';

                    // Reset video source
                    const videoPreview = document.getElementById('videoPreview');
                    videoPreview.querySelector('source').src = '';
                    videoPreview.load();

                    // Set default poster
                    const defaultPoster = document.getElementById('defaultPosterUrl').value;
                    videoPreview.poster = defaultPoster;

                    // Hide iframe in case it was used
                    document.getElementById('videoIframe').src = '';

                } else {
                    Swal.fire('Failed', 'Unable to delete the video.', 'error');
                }
            })
            .catch(() => {
                Swal.fire('Error', 'An error occurred while deleting the video.', 'error');
            });
        }
    });
});



$(document).on('click', '.thumbnail-delete-btn', function () {
    let route = $(this).data('route');
    let csrf = $(this).data('csrf');

    Swal.fire({
        title: 'Delete Image?',
        text: 'Are you sure you want to delete the uploaded image?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(route, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Content-Type': 'application/json',
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Deleted!', 'The image has been removed.', 'success');

                    // Hide delete button
                    document.getElementById('deleteImageBtn').style.display = 'none';

                    // Replace preview with default placeholder
                    document.getElementById('output').src = document.getElementById('defaultThumUrl').value;
                    
                } else {
                    Swal.fire('Failed', 'Unable to delete the image.', 'error');
                }
            })
            .catch(() => {
                Swal.fire('Error', 'An error occurred while deleting the image.', 'error');
            });
        }
    });
});


