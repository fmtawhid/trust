//Global Tab Script
const global_tabs = document.querySelectorAll(".global_tab");
const global_tab_panes = document.querySelectorAll(".global_tab_pane");

global_tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
        // Toggle active tab underline
        global_tabs.forEach((t) => t.classList.remove("global_nav_link"));
        tab.classList.add("global_nav_link");

        // Animate tab content
        const target = tab.dataset.tab;
        global_tab_panes.forEach((pane) => {
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
