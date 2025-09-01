    let baseUrl = $('meta[name="base-url"]').attr('content');

    function addAdvDetails() {

        var url = $("#advertise_create").val();

        $.ajax({
            type: 'GET',
            dataType: 'html',
            url: url,
            success: function(data) {
                var f_up_url = $("#advertise_store").val();

                var lang_add_advertise = $("#lang_add_advertise").val();

                $('.modal-title').text(lang_add_advertise);
                $('#projectDetailsForm').attr('action', f_up_url);
                $('.modal-body').html(data);

                $('#language_id').select2();
                $('#theme').select2();
                $('#page').select2();
                $('#ad_type').select2();
                $('#position').select2();

                $('.img_ad').css({'display': 'none'});
                $('.embed_code_ad').css({'display': 'none'});

                $('#projectDetailsModal').modal('show');
            }
        });
    }

    $(document).ready(function() {
        "use strict";

         // Function to preview image
        $(document).on('change', '#ad_image', function(){
            var file = $(this)[0].files[0];
            var reader = new FileReader();
            reader.onload = function(e){
                $('#output').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });

        $(document).on("click", ".update-lg-status", function () {
            let url = $(this).data("route");
            let csrf = $(this).data("csrf");

            Swal.fire({
                title: get_phrases("Are you sure?"),
                text: get_phrases("You want to update status"),
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, update it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: url,
                        data: {
                            _token: csrf,
                            _method: "PUT",
                        },
                        success: function (data) {
                            $('#advertise-table').DataTable().ajax.reload();
                        },
                    });
                    Swal.fire("Updated!", "Status has been updated.", "success");
                }
            });
        });

        $(document).on("click", ".update-sm-status", function () {
            let url = $(this).data("route");
            let csrf = $(this).data("csrf");

            Swal.fire({
                title: get_phrases("Are you sure?"),
                text: get_phrases("You want to update status"),
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, update it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: url,
                        data: {
                            _token: csrf,
                            _method: "PUT",
                        },
                        success: function (data) {
                            $('#advertise-table').DataTable().ajax.reload();
                        },
                    });
                    Swal.fire("Updated!", "Status has been updated.", "success");
                }
            });
        });


        $('.img_ad').css({'display': 'none'});
        $('.embed_code_ad').css({'display': 'none'});

    });

    function ad_type_change(ad_type){

        "use strict";

        if (ad_type == 1) {
            $('.img_ad').css({'display': 'none'});
            $('.embed_code_ad').css({'display': 'block'});
        }
        else if (ad_type == 2) {
            $('.img_ad').css({'display': 'block'});
            $('.embed_code_ad').removeClass('d-block');
            $('.embed_code_ad').css({'display': 'none'}); 
        }
        else {
            $('.img_ad').css({'display': 'none'});
            $('.embed_code_ad').css({'display': 'none'});
        }
    }


    function editAdvDetails(id, page, ad_position) {

        var url = $("#advertise_edit").val();
        url = url.replace(':advertise', id);

        $.ajax({
            type: 'GET',
            dataType: 'html',
            url: url,
            success: function(data) {
                var up_url = $("#advertise_update").val();
                f_up_url = up_url.replace(':advertise', id);

                var lang_update_advertise = $("#lang_update_advertise").val();

                $('.modal-title').text(lang_update_advertise);
                $('#projectDetailsForm').attr('action', f_up_url);
                $('.modal-body').html(data);

                $('#language_id').select2();
                $('#theme').select2();
                $('#page').select2();
                $('#position').select2();
                $('#ad_type').select2();

                $('.img_ad').css({'display': 'none'});
                $('.embed_code_ad').css({'display': 'none'});

                $('#projectDetailsModal').modal('show');
            }
        });
    }

    //for ad provide
    var pages = {
        '1': 'Home Page',
        '2':'Category Page',
        '3':'News Details Page'
    };

    function view_ad_pages(selected){

        "use strict";

        for(var key in pages){
                if(selected===key){
        document.write('<option value='+key+' selected>'+pages[key]+'</option>');
                }
                else{
        document.write('<option value='+key+'>'+pages[key]+'</option>');
                }
        }
    }
    

    function loadPagePositions() {
        const themeId = document.getElementById('theme').value;
        const page = document.getElementById('page').value;

        if (themeId && page) {
            fetch(`${baseUrl}/admin/advertise/get-page-positions?theme_id=${themeId}&page=${page}`)
                .then(res => res.json())
                .then(data => {
                    const positionSelect = document.getElementById('position');
                    positionSelect.innerHTML = '<option value="">Select position</option>';

                    data.positions.forEach(pos => {
                        const option = document.createElement('option');
                        option.value = pos.id;
                        option.textContent = pos.name;
                        positionSelect.appendChild(option);
                    });
                });
        }
    }
