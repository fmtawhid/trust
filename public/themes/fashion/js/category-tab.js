//Tab Script
const tabs = document.querySelectorAll(".tab_news");
const panes = document.querySelectorAll(".tab-pane");

tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
        // Toggle active tab underline
        tabs.forEach((t) => t.classList.remove("tab_nav_link"));
        tab.classList.add("tab_nav_link");

        // Animate tab content
        const target = tab.dataset.tab;
        panes.forEach((pane) => {
            if (pane.dataset.content === target) {
                pane.classList.remove(
                    "opacity-0",
                    "translate-y-4",
                    "pointer-events-none"
                );
                pane.classList.add("opacity-100", "translate-y-0");
            } else {
                pane.classList.add(
                    "opacity-0",
                    "translate-y-4",
                    "pointer-events-none"
                );
                pane.classList.remove("opacity-100", "translate-y-0");
            }
        });
    });
});
