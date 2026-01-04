$('#subscribe-form').on('submit', function (e) {
    e.preventDefault();

    const email = $('#subscriber_email').val();
    const token = $('input[name="_token"]').val();

    $('#subscribe-btn').prop('disabled', true).text('Subscribing...');
    $('#subscribe-message').removeClass('text-green-600 text-red-600').text('');

    $.ajax({
      url: subscribeUrl,
      method: 'POST',
      data: {
        _token: token,
        email: email
      },
      success: function (response) {
        if (response.success) {
          $('#subscribe-message').addClass('text-green-600').text(response.message);
          $('#subscriber_email').val('');
        }
      },
      error: function (xhr) {
        let errors = xhr.responseJSON.errors;
        $('#subscribe-message').addClass('text-red-600').html(errors.join('<br>'));
      },
      complete: function () {
        $('#subscribe-btn').prop('disabled', false).text('Subscribe');
      }
    });
});