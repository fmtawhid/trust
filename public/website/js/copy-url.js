function copyPageURL(element) {
    const url = window.location.href;
    const iconContainer = element.querySelector(".copy-icon");

    // Save original icon
    const originalIcon = iconContainer.innerHTML;

    // Checkmark icon SVG
    const checkIcon = `
        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12" />
        </svg>
    `;

    navigator.clipboard
        .writeText(url)
        .then(function () {
            // Show checkmark icon
            iconContainer.innerHTML = checkIcon;

            // Revert after 3 seconds
            setTimeout(() => {
                iconContainer.innerHTML = originalIcon;
            }, 3000);
        })
        .catch(function (err) {
            console.error("Could not copy text: ", err);
        });
}

/* Search */

const btnSearchAll = document.querySelectorAll(".btn_search");

btnSearchAll.forEach((btn) => {
    btn.addEventListener("click", () => {
        const wrapper = btn.closest(".search_wrapper");
        const searchSection = wrapper.querySelector(".search_section");
        const searchInput = searchSection.querySelector("input");

        searchSection.classList.toggle("hidden");
        if (!searchSection.classList.contains("hidden")) {
            searchInput.focus();
        }
    });
});
