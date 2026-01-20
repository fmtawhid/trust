// Toggle dropdown open/close
document.addEventListener("DOMContentLoaded", () => {
    const dropdownButton = document.getElementById("dropdownButton");
    const dropdownMenu = document.getElementById("dropdownMenu");

    // Only attach listeners if elements exist
    if (dropdownButton && dropdownMenu) {
        dropdownButton.addEventListener("click", () => {
            dropdownMenu.classList.toggle("hidden");
        });

        document.addEventListener("click", (e) => {
            if (
                !dropdownButton.contains(e.target) &&
                !dropdownMenu.contains(e.target)
            ) {
                dropdownMenu.classList.add("hidden");
            }
        });
    }
});

// Handle click on a language <li>
$(document).on("click", "#dropdownMenu a", function (e) {
    e.preventDefault();
    let language = $(this).data("lang");
    const baseUrl = $('meta[name="base-url"]').attr("content");
    window.location.href = `${baseUrl}/${language}`;
});

// Keep your old <select> listener if you still use it:
$(document).on("change", "#language, #language_side", function () {
    let language = $(this).val();
    const baseUrl = $('meta[name="base-url"]').attr("content");
    window.location.href = `${baseUrl}/${language}`;
});
