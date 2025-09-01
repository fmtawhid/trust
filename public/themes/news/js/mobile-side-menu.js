function openSidebar() {
    const modal = document.getElementById("mobileMenuModal");
    const sidebar = document.getElementById("sidebar");

    modal.classList.remove("hidden");
    document.body.classList.add("overflow-hidden");
    setTimeout(() => {
        sidebar.classList.add("side_bar_active");
    }, 10);
}

function closeSidebar() {
    const modal = document.getElementById("mobileMenuModal");
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.remove("side_bar_active");

    setTimeout(() => {
        modal.classList.add("hidden");
        document.body.classList.remove("overflow-hidden");
    }, 300);
}

// close sidebar when clicking outside
document.getElementById("mobileMenuModal").addEventListener("click", (e) => {
    if (e.target.id === "mobileMenuModal") {
        closeSidebar();
    }
});
