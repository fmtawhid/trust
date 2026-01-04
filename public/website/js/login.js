$(document).ready(function () {
    $('#loginForm').on('submit', async function (e) {
        e.preventDefault();

        const loginBtn = $('#loginBtn');
        const responseBox = $('#responseMessage');

        loginBtn.text('Logging in...').prop('disabled', true);
        responseBox.removeClass().text('');

        const formData = new FormData(this);

        try {
            const response = await axios.post(loginRoute, formData);
            const res = response.data;

            if (res.status) {
                responseBox.addClass('text-green-600').text(res.message);
                window.location.reload();
            } else {
                responseBox.addClass('text-red-600').text(res.message);
            }
        } catch (error) {
            let message = 'Login failed.';
            if (error.response && error.response.data && error.response.data.message) {
                message = error.response.data.message;
            }
            responseBox.addClass('text-red-600').text(message);
        } finally {
            loginBtn.text('Login').prop('disabled', false);
        }
    });
});
