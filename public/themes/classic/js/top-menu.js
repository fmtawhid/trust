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
                .forEach((b) => b.classList.remove("active"));
            document
                .querySelectorAll(".dropdown")
                .forEach((icon) => icon.classList.remove("rotate"));
            document
                .querySelectorAll(".menu > .item > .side_nav")
                .forEach((el) => el.classList.remove("active"));
            document
                .querySelectorAll(".sub-item")
                .forEach((el) => el.classList.remove("active"));

            subMenu.classList.add("open");
            subBtn.classList.add("active");
            dropdownIcon?.classList.add("rotate");
        });

        menuItem.addEventListener("mouseleave", () => {
            subMenu.classList.remove("open");
            subBtn.classList.remove("active");
            dropdownIcon?.classList.remove("rotate");
        });
    } else {
        // Items without submenu
        menuItem.addEventListener("mouseenter", () => {
            // Remove all active styles
            document
                .querySelectorAll(".menu > .item > .side_nav")
                .forEach((el) => el.classList.remove("active"));
            document
                .querySelectorAll(".sub-item")
                .forEach((el) => el.classList.remove("active"));
            document
                .querySelectorAll(".sub-menu")
                .forEach((sm) => sm.classList.remove("open"));
            document
                .querySelectorAll(".sub-btn")
                .forEach((b) => b.classList.remove("active"));
            document
                .querySelectorAll(".dropdown")
                .forEach((icon) => icon.classList.remove("rotate"));

            const sideNav = menuItem.querySelector(".side_nav");
            if (sideNav) {
                sideNav.classList.add("active");
            }
        });

        menuItem.addEventListener("mouseleave", () => {
            const sideNav = menuItem.querySelector(".side_nav");
            if (sideNav) {
                sideNav.classList.remove("active");
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
            .forEach((el) => el.classList.remove("active"));
        document
            .querySelectorAll(".menu > .item > .side_nav")
            .forEach((el) => el.classList.remove("active"));

        subItem.classList.add("active");
    });
});

// Main items without submenu click
document
    .querySelectorAll(".menu > .item > .side_nav:not(.sub-btn)")
    .forEach((link) => {
        link.addEventListener("click", () => {
            document
                .querySelectorAll(".menu > .item > .side_nav")
                .forEach((a) => a.classList.remove("active"));
            document
                .querySelectorAll(".sub-item")
                .forEach((el) => el.classList.remove("active"));

            link.classList.add("active");
        });
    });

// Fixed top menu on scroll
const topMenu = document.querySelector(".fixed_top_menu");

window.addEventListener("scroll", () => {
    if (window.pageYOffset > 200) {
        topMenu.classList.add("fixed_menu");
    } else {
        topMenu.classList.remove("fixed_menu");
    }
});
