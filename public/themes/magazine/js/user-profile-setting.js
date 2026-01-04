document.addEventListener("DOMContentLoaded", function () {
    const tabButtons = document.querySelectorAll(".tab_item");
    const tabContents = document.querySelectorAll("[data-tab]:not(.tab_item)");

    tabButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const target = button.getAttribute("data-tab");

            // Toggle active
            tabButtons.forEach((btn) =>
                btn.classList.remove("profile_tab_active")
            );
            button.classList.add("profile_tab_active");

            // Show/hide tab contents
            tabContents.forEach((content) => {
                if (content.getAttribute("data-tab") === target) {
                    content.classList.remove("opacity-0", "hidden");
                    content.classList.add("opacity-100", "visible");
                } else {
                    content.classList.remove("opacity-100", "visible");
                    content.classList.add("opacity-0", "hidden");
                }
            });
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    window.previewBanner = function (input) {
        const file = input.files[0];
        const bannerPreview = document.getElementById("banner-preview");
        if (file && file.type.startsWith("image/") && bannerPreview) {
            const reader = new FileReader();
            reader.onload = function (e) {
                bannerPreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    };

    window.previewProfile = function (input) {
        const file = input.files[0];
        const profilePreview = document.getElementById("profile-preview");
        if (file && file.type.startsWith("image/") && profilePreview) {
            const reader = new FileReader();
            reader.onload = function (e) {
                profilePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    };
});