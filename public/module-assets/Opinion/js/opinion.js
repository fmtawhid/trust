var image_up_route = $("#image_up").val();

CKEDITOR.replace("details", {
    filebrowserUploadUrl: image_up_route,
    filebrowserUploadMethod: "form",
});

$(document).on('change', '#person_image', function(){
    var file = $(this)[0].files[0];
    var reader = new FileReader();
    reader.onload = function(e){
        $('#output').attr('src', e.target.result);
    }
    reader.readAsDataURL(file);
});

// Function to preview image
$(document).on('change', '#news_image', function(){
    var file = $(this)[0].files[0];
    var reader = new FileReader();
    reader.onload = function(e){
        $('#news-output').attr('src', e.target.result);
    }
    reader.readAsDataURL(file);
});

