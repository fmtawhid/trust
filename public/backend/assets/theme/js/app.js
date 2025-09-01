document.getElementById('themeBackgroundColor').addEventListener('input', function () {
    document.getElementById('themeBackgroundColorCode').value = this.value;
});

document.getElementById('themeTextColor').addEventListener('input', function () {
    document.getElementById('themeTextColorCode').value = this.value;
});

$(document).on("click", "#resetThemeSettings", function () {
    window.location.href = base_url + "/admin/theme/settings/reset";
});


document.querySelectorAll('.color-picker').forEach(picker => {
    picker.addEventListener('input', function () {
        const colorInput = this.previousElementSibling;
        if (colorInput && colorInput.classList.contains('color-value')) {
            colorInput.value = this.value;
        }
    });
});