// Initialize all tab groups
initTabs("tab_gazette1", "tab-pane1");
initTabs("tab_gazette2", "tab-pane2");
initTabs("tab_gazette3", "tab-pane3");
initTabs("tab_gazette4", "tab-pane4");

function initTabs(tabClass, paneClass) {
    const tabs = document.querySelectorAll(`.${tabClass}`);
    const panes = document.querySelectorAll(`.${paneClass}`);

    tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
            // Remove active class from all tabs in this group
            tabs.forEach((t) => t.classList.remove("tab_nav_link"));
            tab.classList.add("tab_nav_link");

            // Get target from clicked tab
            const target = tab.dataset.tab;

            // Toggle pane visibility based on matching data-content
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
}
