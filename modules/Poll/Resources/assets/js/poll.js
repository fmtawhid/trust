function addPollDetails() {

    var url = $("#poll_create").val();

    $.ajax({
        type: 'GET',
        dataType: 'html',
        url: url,
        success: function(data) {
            var f_up_url = $("#poll_store").val();
            var lang_add_poll = $("#lang_add_poll").val();

            $('.modal-title').text(lang_add_poll);
            $('#opinionDetailsModalForm').attr('action', f_up_url);
            $('.modal-body').html(data);

            $('#language_id').select2({
                dropdownParent: $('#opinionDetailsModal')
            });
            $('#vote_permission').select2({
                dropdownParent: $('#opinionDetailsModal')
            });

            $('#opinionDetailsModal').modal('show');
        }
    });
}

$(document).ready(function() {
    "use strict";

    $(document).on("click", ".poll-status-update", function () {
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
                    error: function (response) {
                        let data = response.responseJSON;

                        if(data.message){
                            toastr.error(data.message, data.title);
                        }
                    },
                    success: function (data) {
                        $('#poll-table').DataTable().ajax.reload();
                        Swal.fire("Updated!", "Status has been updated.", "success");
                    },
                });
            }
        });
    });

});


function editPollDetails(id) {

    var url = $("#poll_edit").val();
    url = url.replace(':poll', id);

    $.ajax({
        type: 'GET',
        dataType: 'html',
        url: url,
        success: function(data) {
            var up_url = $("#poll_update").val();
            f_up_url = up_url.replace(':poll', id);

            var lang_update_poll = $("#lang_update_poll").val();

            $('.modal-title').text(lang_update_poll);
            $('#opinionDetailsModalForm').attr('action', f_up_url);
            $('.modal-body').html(data);

            $('#language_id').select2({
                dropdownParent: $('#opinionDetailsModal')
            });
            $('#vote_permission').select2({
                dropdownParent: $('#opinionDetailsModal')
            });

            $('#opinionDetailsModal').modal('show');
        }
    });
}

function pollResultDetails(id) {

    var url = $("#poll_result").val();
    url = url.replace(':poll', id);

    $.ajax({
        type: 'GET',
        dataType: 'html',
        url: url,
        success: function(data) {
            
            $('.result-modal-body').html(data);

            $('#pollResultModal').modal('show');
        }
    });
}
