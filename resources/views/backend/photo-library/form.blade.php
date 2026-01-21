<!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Image Upload with Cropping</title>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" rel="stylesheet">
     <style>
         .crop-container {
             max-height: 400px;
             margin: 20px 0;
         }
         .preview-box .position-absolute { pointer-events: none; }


         .preview-container {
             display: flex;
             gap: 15px;
             margin-top: 15px;
         }

         .preview-box {
             border: 2px dashed #dee2e6;
             border-radius: 8px;
             padding: 10px;
             text-align: center;
             min-height: 150px;
             display: flex;
             flex-direction: column;
             justify-content: center;
             align-items: center;
         }

         .preview-box.has-image {
             border-style: solid;
             border-color: #198754;
         }

         .preview-image {
             max-width: 100%;
             max-height: 120px;
             border-radius: 4px;
         }

         .crop-controls {
             background: #f8f9fa;
             padding: 15px;
             border-radius: 8px;
             margin: 15px 0;
         }

         #originalImage {
             max-width: 100%;
             display: block;
         }

         .btn-group .btn {
             margin: 2px;
         }

         .size-info {
             font-size: 0.875rem;
             color: #6c757d;
             margin-top: 5px;
         }
     </style>
 </head>

 <body>
     <div class="container mt-4">
         <form id="imageUploadForm" method="POST" action="/upload-image" enctype="multipart/form-data">
             @csrf
             <div class="row">
                 <div class="col-md-9">
                     <div class="row">
                         <div class="col-md-6 p-4">
                             <legend>Thumb Image Size</legend>
                             <div class="col-md-12">
                                 <div class="row form-group mb-3">
                                     <label for="thumb_height" class="col-form-label fw-semibold">
                                         Height (Y) <span class="text-danger">*</span>
                                     </label>
                                     <input type="number" name="thumb_height" id="thumb_height" class="form-control" value="240" required>
                                 </div>
                             </div>
                             <div class="col-md-12">
                                 <div class="row form-group mb-3">
                                     <label for="thumb_width" class="col-form-label fw-semibold">
                                         Width (X) <span class="text-danger">*</span>
                                     </label>
                                     <input type="number" name="thumb_width" id="thumb_width" class="form-control" value="438" required>
                                 </div>
                             </div>
                         </div>
                         <div class="col-md-6 p-4">
                             <legend>Large Image Size</legend>
                             <div class="col-md-12">
                                 <div class="row form-group mb-3">
                                     <label for="large_height" class="col-form-label fw-semibold">
                                         Height (Y) <span class="text-danger">*</span>
                                     </label>
                                     <input type="number" name="large_height" id="large_height" class="form-control" value="585" required>
                                 </div>
                             </div>
                             <div class="col-md-12">
                                 <div class="row form-group mb-3">
                                     <label for="large_width" class="col-form-label fw-semibold">
                                         Width (X) <span class="text-danger">*</span>
                                     </label>
                                     <input type="number" name="large_width" id="large_width" class="form-control" value="1067" required>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>

                 <div class="col-md-3">
                     <div class="col-lg-12 col-xs-12">
                         <div class="form-group">
                             <label>Image <span class="text-danger">*</span></label>
                             <input type="file" accept="image/*" name="image" id="imageInput" class="form-control mb-2" required>
                             <div class="text-warning mb-2">* File size max 2 MB</div>
                             <div id="preview_file_image" class="preview-box">
                                 <small class="text-muted">No image selected</small>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <!-- Crop Section -->
             <div id="cropSection" class="row" style="display: none;">
                 <div class="col-12">
                     <div class="crop-controls">
                         <h5>Crop Your Image</h5>
                         <div class="btn-group mb-3">
                             <button type="button" class="btn btn-secondary btn-sm" onclick="cropImage('thumb')">Crop for Thumb</button>
                             <button type="button" class="btn btn-secondary btn-sm" onclick="cropImage('large')">Crop for Large</button>
                             <button type="button" class="btn btn-outline-secondary btn-sm" onclick="resetCrop()">Reset</button>
                             <button type="button" class="btn btn-outline-secondary btn-sm" onclick="rotateCrop(-90)">Rotate Left</button>
                             <button type="button" class="btn btn-outline-secondary btn-sm" onclick="rotateCrop(90)">Rotate Right</button>
                         </div>
                         <div class="crop-container">
                             <img id="originalImage" src="" alt="Original Image">
                         </div>
                         <div class="preview-container">
                             <div class="col-md-6">
                                 <h6>Thumbnail Preview</h6>
                                 <div id="thumbPreview" class="preview-box">
                                     <small class="text-muted">Crop for thumbnail to see preview</small>
                                 </div>
                                 <div class="size-info" id="thumbSizeInfo"></div>
                             </div>
                             <div class="col-md-6">
                                 <h6>Large Preview</h6>
                                 <div id="largePreview" class="preview-box">
                                     <small class="text-muted">Crop for large to see preview</small>
                                 </div>
                                 <div class="size-info" id="largeSizeInfo"></div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <!-- Caption & Reference -->
             <div class="row">

                 <div class="col-lg-9 col-xs-9">
                     <div class="row form-group mb-3">
                         <label for="caption" class="col-form-label fw-semibold">Caption</label>
                         <input type="text" name="caption" id="caption" class="form-control">
                     </div>
                 </div>
                 <div class="col-lg-3 col-xs-3">
                     <div class="row form-group mb-3">
                         <label for="reference" class="col-form-label fw-semibold">Reference</label>
                         <input type="text" name="reference" id="reference" class="form-control">
                     </div>
                 </div>
             </div>

             <div class="row">
                 <div class="col-12">
                     <button type="submit" class="btn btn-success" id="uploadBtn">Upload Image</button>
                     <button type="button" class="btn btn-secondary ms-2" onclick="clearAll()">Clear All</button>
                 </div>
             </div>

             <!-- Hidden inputs for cropped images -->
             <input type="hidden" name="cropped_thumb" id="croppedThumb">
             <input type="hidden" name="cropped_large" id="croppedLarge">
         </form>
     </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
<script>
let cropper = null;
let originalData = null;

document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    if (file.size > 2 * 1024 * 1024) {
        alert('Max 2MB allowed');
        e.target.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = function(evt) {
        originalData = evt.target.result;
        const previewDiv = document.getElementById('preview_file_image');
        previewDiv.innerHTML = `<img class="preview-image" src="${evt.target.result}" style="max-width:100%;height:auto;">`;
        document.getElementById('cropSection').style.display = 'block';
        initializeCropper(evt.target.result);
    };
    reader.readAsDataURL(file);
});

function initializeCropper(src) {
    const image = document.getElementById('originalImage');
    image.src = src;
    if (cropper) cropper.destroy();
    cropper = new Cropper(image, {
        viewMode: 1,
        autoCropArea: 0.8,
        movable: true,
        zoomable: true,
        rotatable: true,
        scalable: true,
        cropBoxMovable: true,
        cropBoxResizable: true,
    });
}

function cropImage(type) {
    if (!cropper) return;

    let width, height, targetPreview, targetInput, sizeInfo;
    if (type === 'thumb') {
        width = parseInt(document.getElementById('thumb_width').value);
        height = parseInt(document.getElementById('thumb_height').value);
        targetPreview = document.getElementById('thumbPreview');
        targetInput = document.getElementById('croppedThumb');
        sizeInfo = document.getElementById('thumbSizeInfo');
    } else {
        width = parseInt(document.getElementById('large_width').value);
        height = parseInt(document.getElementById('large_height').value);
        targetPreview = document.getElementById('largePreview');
        targetInput = document.getElementById('croppedLarge');
        sizeInfo = document.getElementById('largeSizeInfo');
    }

    const croppedCanvas = cropper.getCroppedCanvas({ width, height });
    if (!croppedCanvas) return;

    const finalCanvas = document.createElement('canvas');
    finalCanvas.width = croppedCanvas.width;
    finalCanvas.height = croppedCanvas.height;
    const ctx = finalCanvas.getContext('2d');

    // Draw cropped image
    ctx.drawImage(croppedCanvas, 0, 0, croppedCanvas.width, croppedCanvas.height);

    // Add logo on top-right corner
    const logo = new Image();
    logo.src = "{{ asset('assets/logo4.png') }}";
    logo.onload = function() {
        const logoWidth = croppedCanvas.width * 0.15;
        const logoHeight = (logo.height / logo.width) * logoWidth;
        const x = croppedCanvas.width - logoWidth - 15; // right
        const y = 15; // top

        ctx.globalAlpha = 0.9;
        ctx.drawImage(logo, x, y, logoWidth, logoHeight);
        ctx.globalAlpha = 1.0;

        // Compress image: thumb at 0.70 quality, large at 0.75 quality
        let quality = type === 'thumb' ? 0.70 : 0.75;
        const dataURL = finalCanvas.toDataURL('image/jpeg', quality);

        targetPreview.innerHTML = `<img src="${dataURL}" style="max-width:100%;height:auto;display:block;border-radius:8px;">`;
        targetInput.value = dataURL;

        const approxKb = Math.round((dataURL.length * 3 / 4) / 1024);
        sizeInfo.textContent = `Saved: ${width}×${height}px (~${approxKb} KB) - Compressed`;
        console.log(type + ' crop created with logo at top-right (Quality: ' + (quality * 100) + '%)');
        
        // Validate compressed size doesn't exceed 2MB
        if (dataURL.length > 2 * 1024 * 1024) {
            alert('Compressed image still exceeds 2MB. Please crop to a smaller size.');
        }
    };
}


function ensureCrops() {
    if (cropper) {
        if (!document.getElementById('croppedThumb').value) cropImage('thumb');
        if (!document.getElementById('croppedLarge').value) cropImage('large');
        return;
    }

    if (originalData) {
        if (!document.getElementById('croppedThumb').value)
            document.getElementById('croppedThumb').value = originalData;
        if (!document.getElementById('croppedLarge').value)
            document.getElementById('croppedLarge').value = originalData;
    }
}

document.getElementById('imageUploadForm').addEventListener('submit', function(e) {
    ensureCrops();
    console.log('Submitting — thumb len:', document.getElementById('croppedThumb').value.length || 0,
        'large len:', document.getElementById('croppedLarge').value.length || 0);
});

function resetCrop() {
    if (cropper) cropper.reset();
}

function rotateCrop(deg) {
    if (cropper) cropper.rotate(deg);
}

function clearAll() {
    document.getElementById('imageInput').value = '';
    document.getElementById('preview_file_image').innerHTML = '<small>No image selected</small>';
    document.getElementById('cropSection').style.display = 'none';
    document.getElementById('thumbPreview').innerHTML = '<small>Crop for thumbnail to see preview</small>';
    document.getElementById('largePreview').innerHTML = '<small>Crop for large to see preview</small>';
    document.getElementById('croppedThumb').value = '';
    document.getElementById('croppedLarge').value = '';
    if (cropper) {
        cropper.destroy();
        cropper = null;
    }

}


</script>



 </body>

 </html>