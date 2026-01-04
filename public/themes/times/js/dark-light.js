const baseUrl = $('meta[name="base-url"]').attr("content");
// Dark & Light Mode
document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("theme-toggle");
    const html = document.documentElement;

    // Optional: Persist theme in localStorage
    const storedTheme = localStorage.getItem("theme");
    if (storedTheme === "dark") {
        html.classList.add("dark");
    } else if (storedTheme === "light") {
        html.classList.remove("dark");
    }

    toggleButton.addEventListener("click", async () => {
        html.classList.toggle("dark");

        // Update localStorage
        let theme = "light";
        if (html.classList.contains("dark")) {
            localStorage.setItem("theme", "dark");
            theme = "dark";
        } else {
            localStorage.setItem("theme", "light");
        }

        await axios.get(baseUrl + "/mode/change/" + theme);
        window.location.reload();
    });
});
