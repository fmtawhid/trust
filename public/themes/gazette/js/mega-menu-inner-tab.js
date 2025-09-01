document.addEventListener("DOMContentLoaded", function () {
    // Function to handle showing/hiding sub-menus and activating default tabs
    function handleMainMenuHover() {
        const mainMenuItems = document.querySelectorAll(".item.cursor-pointer");

        mainMenuItems.forEach((item) => {
            item.addEventListener("mouseenter", function () {
                const subMenu = this.querySelector(".sub-menu");
                if (subMenu) {
                    // Set max-height to scrollHeight to allow CSS transition for dropdown
                    subMenu.style.maxHeight = subMenu.scrollHeight + "px";

                    const categoryTabsContainer =
                        subMenu.querySelector("#category_tabs");
                    if (categoryTabsContainer) {
                        // 1. IMPORTANT: Hide all tab content within this submenu first
                        subMenu
                            .querySelectorAll(".tab-content")
                            .forEach((content) => {
                                content.classList.remove(
                                    "opacity-100",
                                    "translate-y-0",
                                    "pointer-events-auto"
                                );
                                content.classList.add(
                                    "opacity-0",
                                    "translate-y-2",
                                    "pointer-events-none"
                                );
                            });

                        // 2. Deactivate all tab links visually
                        categoryTabsContainer
                            .querySelectorAll(".sub-item")
                            .forEach((tabLink) => {
                                tabLink.classList.remove(
                                    "text-cyan-600",
                                    "dark:text-cyan-500"
                                );
                                tabLink.classList.add(
                                    "text-gray-800",
                                    "dark:text-white"
                                );
                            });

                        // 3. Activate the 'all' tab or the first available tab by default
                        let defaultTab = categoryTabsContainer.querySelector(
                            '.sub-item[data-tab$="_all"]'
                        );
                        if (!defaultTab) {
                            defaultTab =
                                categoryTabsContainer.querySelector(
                                    ".sub-item"
                                ); // Fallback to first tab
                        }

                        if (defaultTab) {
                            defaultTab.classList.add(
                                "text-cyan-600",
                                "dark:text-cyan-500"
                            );
                            defaultTab.classList.remove(
                                "text-gray-800",
                                "dark:text-white"
                            );
                            const targetContentId = defaultTab.dataset.tab;
                            const targetContent = subMenu.querySelector(
                                `[data-content="${targetContentId}"]`
                            );
                            if (targetContent) {
                                targetContent.classList.add(
                                    "opacity-100",
                                    "translate-y-0",
                                    "pointer-events-auto"
                                );
                                targetContent.classList.remove(
                                    "opacity-0",
                                    "translate-y-2",
                                    "pointer-events-none"
                                );
                            }
                        }
                    }
                }
            });

            item.addEventListener("mouseleave", function () {
                const subMenu = this.querySelector(".sub-menu");
                if (subMenu) {
                    subMenu.style.maxHeight = "0px"; // Hide submenu
                }
            });
        });
    }

    // Function to handle hovers on inner sub-tabs (category tabs)
    function handleInnerTabHovers() {
        const innerTabs = document.querySelectorAll(
            ".sub-menu #category_tabs .sub-item"
        );

        innerTabs.forEach((tab) => {
            // CHANGED: Use 'mouseover' instead of 'click'
            tab.addEventListener("mouseover", function (e) {
                e.preventDefault(); // Still prevent default link behavior, if any

                const hovecyanTab = this; // Renamed for clarity
                const targetContentId = hovecyanTab.dataset.tab;
                const parentSubMenu = hovecyanTab.closest(".sub-menu");

                if (parentSubMenu) {
                    // 1. Deactivate all tab links visually within the current submenu
                    parentSubMenu
                        .querySelectorAll("#category_tabs .sub-item")
                        .forEach((tabLink) => {
                            tabLink.classList.remove(
                                "text-cyan-600",
                                "dark:text-cyan-500"
                            );
                            tabLink.classList.add(
                                "text-gray-800",
                                "dark:text-white"
                            );
                        });

                    // 2. Activate the hovecyan tab link visually
                    hovecyanTab.classList.add(
                        "text-cyan-600",
                        "dark:text-cyan-500"
                    );
                    hovecyanTab.classList.remove(
                        "text-gray-800",
                        "dark:text-white"
                    );

                    // 3. IMPORTANT: Hide ALL content divs within the current submenu.
                    parentSubMenu
                        .querySelectorAll(".tab-content")
                        .forEach((content) => {
                            content.classList.remove(
                                "opacity-100",
                                "translate-y-0",
                                "pointer-events-auto"
                            );
                            content.classList.add(
                                "opacity-0",
                                "translate-y-2",
                                "pointer-events-none"
                            );
                        });

                    // 4. Show the content div corresponding to the hovecyan tab
                    const targetContent = parentSubMenu.querySelector(
                        `[data-content="${targetContentId}"]`
                    );
                    if (targetContent) {
                        targetContent.classList.add(
                            "opacity-100",
                            "translate-y-0",
                            "pointer-events-auto"
                        );
                        targetContent.classList.remove(
                            "opacity-0",
                            "translate-y-2",
                            "pointer-events-none"
                        );
                    }
                }
            });
        });
    }

    // Function to handle nested "More" menu hover
    function handleMoreMenuHover() {
        const innerMenus = document.querySelectorAll(".inner_menu");

        innerMenus.forEach((innerMenu) => {
            innerMenu.addEventListener("mouseenter", function () {
                const innerSubMenu = this.querySelector(".inner_sub_menu");
                if (innerSubMenu) {
                    innerSubMenu.style.maxWidth =
                        innerSubMenu.scrollWidth + "px";
                    innerSubMenu.style.width = "max-content";
                    innerSubMenu.classList.add("opacity-100", "left-full");
                    innerSubMenu.classList.remove("opacity-0", "w-0", "left-0");
                }
            });

            innerMenu.addEventListener("mouseleave", function () {
                const innerSubMenu = this.querySelector(".inner_sub_menu");
                if (innerSubMenu) {
                    innerSubMenu.classList.remove("opacity-100", "left-full");
                    innerSubMenu.classList.add("opacity-0", "w-0", "left-0");
                    innerSubMenu.style.maxWidth = "0px";
                    innerSubMenu.style.width = "0";
                }
            });
        });
    }

    // Initialize all menu functionalities
    handleMainMenuHover();
    handleInnerTabHovers(); // Changed function call here
    handleMoreMenuHover();
});
