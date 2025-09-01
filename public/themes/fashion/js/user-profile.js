document.addEventListener("DOMContentLoaded", () => {
    const toggleButtons = document.querySelectorAll(".profile_toggle");

    toggleButtons.forEach((toggleBtn) => {
        const dropdown = toggleBtn.nextElementSibling;
        if (!dropdown) return;

        function showDropdown() {
            dropdown.classList.remove("hidden");

            // ✅ Force reflow before adding transition classes
            dropdown.offsetHeight;

            dropdown.classList.remove("opacity-0", "scale-95", "translate-y-2");
            dropdown.classList.add("opacity-100", "scale-100", "translate-y-0");
        }

        function hideDropdown() {
            dropdown.classList.add("opacity-0", "scale-95", "translate-y-2");
            dropdown.classList.remove(
                "opacity-100",
                "scale-100",
                "translate-y-0"
            );

            setTimeout(() => {
                dropdown.classList.add("hidden");
            }, 300);
        }

        toggleBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            if (dropdown.classList.contains("hidden")) {
                showDropdown();
            } else {
                hideDropdown();
            }
        });

        document.addEventListener("click", (e) => {
            if (!toggleBtn.contains(e.target) && !dropdown.contains(e.target)) {
                if (!dropdown.classList.contains("hidden")) {
                    hideDropdown();
                }
            }
        });

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape" && !dropdown.classList.contains("hidden")) {
                hideDropdown();
            }
        });
    });
});
