document.querySelectorAll(".item").forEach((menuItem) => {
    const subBtn = menuItem.querySelector(".sub-btn");
    const subMenu = menuItem.querySelector(".sub-menu");
    const dropdownIcon = subBtn?.querySelector(".dropdown");

    if (subBtn && subMenu) {
        // Items with submenu
        menuItem.addEventListener("mouseenter", () => {
            // Close all other submenus and remove active states
            document
                .querySelectorAll(".sub-menu")
                .forEach((sm) => sm.classList.remove("open"));
            document
                .querySelectorAll(".sub-btn")
                .forEach((b) => b.classList.remove("active_theme_2"));
            document
                .querySelectorAll(".dropdown")
                .forEach((icon) => icon.classList.remove("rotate"));
            document
                .querySelectorAll(".menu > .item > .side_nav_news")
                .forEach((el) => el.classList.remove("active_theme_2"));
            document
                .querySelectorAll(".sub-item")
                .forEach((el) => el.classList.remove("active_theme_2"));

            subMenu.classList.add("open");
            subBtn.classList.add("active_theme_2");
            dropdownIcon?.classList.add("rotate");
        });

        menuItem.addEventListener("mouseleave", () => {
            subMenu.classList.remove("open");
            subBtn.classList.remove("active_theme_2");
            dropdownIcon?.classList.remove("rotate");
        });
    } else {
        // Items without submenu
        menuItem.addEventListener("mouseenter", () => {
            // Remove all active styles
            document
                .querySelectorAll(".menu > .item > .side_nav_news")
                .forEach((el) => el.classList.remove("active_theme_2"));
            document
                .querySelectorAll(".sub-item")
                .forEach((el) => el.classList.remove("active_theme_2"));
            document
                .querySelectorAll(".sub-menu")
                .forEach((sm) => sm.classList.remove("open"));
            document
                .querySelectorAll(".sub-btn")
                .forEach((b) => b.classList.remove("active_theme_2"));
            document
                .querySelectorAll(".dropdown")
                .forEach((icon) => icon.classList.remove("rotate"));

            const sideNav = menuItem.querySelector(".side_nav_news");
            if (sideNav) {
                sideNav.classList.add("active_theme_2");
            }
        });

        menuItem.addEventListener("mouseleave", () => {
            const sideNav = menuItem.querySelector(".side_nav_news");
            if (sideNav) {
                sideNav.classList.remove("active_theme_2");
            }
        });
    }
});

// Handle submenu item active
document.querySelectorAll(".sub-menu .sub-item").forEach((subItem) => {
    subItem.addEventListener("click", (e) => {
        e.stopPropagation();

        document
            .querySelectorAll(".sub-item")
            .forEach((el) => el.classList.remove("active_theme_2"));
        document
            .querySelectorAll(".menu > .item > .side_nav_news")
            .forEach((el) => el.classList.remove("active_theme_2"));

        subItem.classList.add("active_theme_2");
    });
});

// Main items without submenu click
document
    .querySelectorAll(".menu > .item > .side_nav_news:not(.sub-btn)")
    .forEach((link) => {
        link.addEventListener("click", () => {
            document
                .querySelectorAll(".menu > .item > .side_nav_news")
                .forEach((a) => a.classList.remove("active_theme_2"));
            document
                .querySelectorAll(".sub-item")
                .forEach((el) => el.classList.remove("active_theme_2"));

            link.classList.add("active_theme_2");
        });
    });

// Fixed top menu on scroll
const topMenu = document.querySelector(".fixed_top_menu");
const topMenuOffset = topMenu.offsetTop;

window.addEventListener("scroll", () => {
    if (window.pageYOffset > topMenuOffset) {
        topMenu.classList.add("fixed_menu");
    } else {
        topMenu.classList.remove("fixed_menu");
    }
});
