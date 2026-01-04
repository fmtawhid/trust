document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.getElementById("lang-toggle");
    const dropdown = document.getElementById("lang-menu");
    let storiesNewsSwiperInstance;
    let articleNewsSwiperInstance;

    function initializeSwipers(direction = "ltr") {
        // Destroy existing instances if they exist
        if (storiesNewsSwiperInstance) {
            storiesNewsSwiperInstance.destroy(true, true);
        }

        if (articleNewsSwiperInstance) {
            articleNewsSwiperInstance.destroy(true, true);
        }

        // Initialize Stories News Swiper
        storiesNewsSwiperInstance = new Swiper(".StoriesNewsSwiper", {
            dir: direction,
            loop: false,
            slidesPerView: 2,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".stories-swiper-button-next",
                prevEl: ".stories-swiper-button-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 4,
                },
                1024: {
                    slidesPerView: 5,
                },
                1280: {
                    slidesPerView: 7,
                },
            },
        });

        // Initialize Article News Swiper
        articleNewsSwiperInstance = new Swiper(".ArticleSwiper", {
            dir: direction,
            spaceBetween: 30,
            slidesPerView: 1,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".article-swiper-button-next",
                prevEl: ".article-swiper-button-prev",
            },
        });
    }

    // Initial setup
    const initialDirection = $("#direction").val() || "ltr";
    document.documentElement.setAttribute("dir", initialDirection);
    const initialLang = $("#language").val() ?? "en";
    document.documentElement.setAttribute("lang", initialLang);
    document.getElementById("lang-label").textContent = document.querySelector(
        `.lang-option[data-lang="${initialLang}"]`
    ).textContent;

    initializeSwipers(initialDirection);

    toggleBtn.addEventListener("click", () => {
        dropdown.classList.toggle("opacity-0");
        dropdown.classList.toggle("scale-95");
        dropdown.classList.toggle("translate-y-2");
        dropdown.classList.toggle("pointer-events-none");
    });

    document.addEventListener("click", (e) => {
        if (!toggleBtn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add(
                "opacity-0",
                "scale-95",
                "translate-y-2",
                "pointer-events-none"
            );
        }
    });

    document.querySelectorAll(".lang-option").forEach((option) => {
        option.addEventListener("click", (e) => {
            const selectedLang = e.target.getAttribute("data-lang");
            const baseUrl = $('meta[name="base-url"]').attr("content");
            window.location.href = `${baseUrl}/${selectedLang}`;
        });
    });
});

$(document).on("change", "#language, #language_side", function () {
    let language = $(this).val();
    const baseUrl = $('meta[name="base-url"]').attr("content");
    window.location.href = `${baseUrl}/${language}`;
});
