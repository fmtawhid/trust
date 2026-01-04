document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.getElementById("lang-toggle");
    const dropdown = document.getElementById("lang-menu");
    let opinionSwiperInstance;
    let storiesNewsSwiperInstance;
    let politicsNewsSwiperInstance;
    let techNewsSwiperInstance;
    let foodNewsSwiperInstance;
    let binodonNewsSwiperInstance;
    let lifestyleNewsSwiperInstance;
    let articleNewsSwiperInstance;

    let sectionPage = 1;
    let sectionFourAjaxUrl = $("#section-four-ajax-url").val();

    let sectionFiveFirstPage = 1;
    let sectionFiveFirstAjaxUrl = $("#section-five-first-ajax-url").val();

    let sectionFiveSecondPage = 1;
    let sectionFiveSecondAjaxUrl = $("#section-five-second-ajax-url").val();

    let sectionFiveThirdPage = 1;
    let sectionFiveThirdAjaxUrl = $("#section-five-third-ajax-url").val();

    let sectionFiveFourthPage = 1;
    let sectionFiveFourthAjaxUrl = $("#section-five-fourth-ajax-url").val();

    function initializeSwipers(direction = "ltr") {
        // Destroy existing instances if they exist
        if (opinionSwiperInstance) {
            opinionSwiperInstance.destroy(true, true);
        }
        if (storiesNewsSwiperInstance) {
            storiesNewsSwiperInstance.destroy(true, true);
        }
        if (politicsNewsSwiperInstance) {
            politicsNewsSwiperInstance.destroy(true, true);
        }
        if (techNewsSwiperInstance) {
            techNewsSwiperInstance.destroy(true, true);
        }
        if (foodNewsSwiperInstance) {
            foodNewsSwiperInstance.destroy(true, true);
        }
        if (binodonNewsSwiperInstance) {
            binodonNewsSwiperInstance.destroy(true, true);
        }
        if (lifestyleNewsSwiperInstance) {
            lifestyleNewsSwiperInstance.destroy(true, true);
        }
        if (articleNewsSwiperInstance) {
            articleNewsSwiperInstance.destroy(true, true);
        }

        // Initialize Opinion Swiper
        opinionSwiperInstance = new Swiper(".OpinionSwiper", {
            dir: direction,
            spaceBetween: 30,
            slidesPerView: 1,
            centeredSlides: true,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".opinion-swiper-button-next",
                prevEl: ".opinion-swiper-button-prev",
            },
        });

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

        // Initialize Politics News Swiper
        politicsNewsSwiperInstance = new Swiper(".PoliticsSwiper", {
            dir: direction,
            spaceBetween: 30,
            centeredSlides: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".politics-swiper-button-next",
                prevEl: ".politics-swiper-button-prev",
            },
            on: {
                slideNextTransitionStart: function () {
                    sectionPage++;
                    loadSectionFourNews(sectionPage);
                },
                slidePrevTransitionStart: function () {
                    if (sectionPage > 1) {
                        sectionPage--;
                        loadSectionFourNews(sectionPage);
                    }
                },
            },
        });

        function loadSectionFourNews(page) {
            // If slide for this page already exists, don't fetch via AJAX
            if ($("#swiper-slide-sec-four-" + page).length > 0) {
                return;
            }

            // Show existing loader
            $("#sec-four-loader").removeClass("hidden");

            $.ajax({
                url: sectionFourAjaxUrl,
                method: "GET",
                data: { page: page },
                success: function (res) {
                    // Hide loader
                    $("#sec-four-loader").addClass("hidden");

                    // Insert the new slide before the final slide marker
                    $("#no-need-to-slide-sec-four").before(res.html);

                    if (page == res.maxSliders) {
                        $("#no-need-to-slide-sec-four").remove();
                    }

                    politicsNewsSwiperInstance.update();
                },
                error: function () {
                    console.error("Failed to load news");
                    $("#sec-four-loader").addClass("hidden");
                },
            });
        }

        /* Initialize Tech News Swiper */
        techNewsSwiperInstance = new Swiper(".TechNewsSwiper", {
            dir: direction,
            spaceBetween: 30,
            centeredSlides: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".tech-news-next",
                prevEl: ".tech-news-prev",
            },
            on: {
                slideNextTransitionStart: function () {
                    sectionFiveFirstPage++;
                    loadSectionFiveFirstNews(sectionFiveFirstPage);
                },
                slidePrevTransitionStart: function () {
                    if (sectionFiveFirstPage > 1) {
                        sectionFiveFirstPage--;
                        loadSectionFiveFirstNews(sectionFiveFirstPage);
                    }
                },
            },
        });

        function loadSectionFiveFirstNews(page) {
            // If slide for this page already exists, don't fetch via AJAX
            if ($("#swiper-slide-sec-five-first-" + page).length > 0) {
                return;
            }

            // Show existing loader
            $("#sec-five-first-loader").removeClass("hidden");

            $.ajax({
                url: sectionFiveFirstAjaxUrl,
                method: "GET",
                data: { page: page },
                success: function (res) {
                    // Hide loader
                    $("#sec-five-first-loader").addClass("hidden");

                    // Insert the new slide before the final slide marker
                    $("#no-need-to-slide-sec-five-first").before(res.html);

                    if (page == res.maxSliders) {
                        $("#no-need-to-slide-sec-five-first").remove();
                    }

                    techNewsSwiperInstance.update();
                },
                error: function () {
                    console.error("Failed to load news");
                    $("#sec-five-first-loader").addClass("hidden");
                },
            });
        }

        // Initialize Food News Swiper
        foodNewsSwiperInstance = new Swiper(".FoodNewsSwiper", {
            dir: direction,
            spaceBetween: 30,
            centeredSlides: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".food-news-next",
                prevEl: ".food-news-prev",
            },
            on: {
                slideNextTransitionStart: function () {
                    sectionFiveSecondPage++;
                    loadSectionFiveSecondNews(sectionFiveSecondPage);
                },
                slidePrevTransitionStart: function () {
                    if (sectionFiveSecondPage > 1) {
                        sectionFiveSecondPage--;
                        loadSectionFiveSecondNews(sectionFiveSecondPage);
                    }
                },
            },
        });

        function loadSectionFiveSecondNews(page) {
            // If slide for this page already exists, don't fetch via AJAX
            if ($("#swiper-slide-sec-five-second-" + page).length > 0) {
                return;
            }

            // Show existing loader
            $("#sec-five-second-loader").removeClass("hidden");

            $.ajax({
                url: sectionFiveSecondAjaxUrl,
                method: "GET",
                data: { page: page },
                success: function (res) {
                    // Hide loader
                    $("#sec-five-second-loader").addClass("hidden");

                    // Insert the new slide before the final slide marker
                    $("#no-need-to-slide-sec-five-second").before(res.html);

                    if (page == res.maxSliders) {
                        $("#no-need-to-slide-sec-five-second").remove();
                    }

                    foodNewsSwiperInstance.update();
                },
                error: function () {
                    console.error("Failed to load news");
                    $("#sec-five-second-loader").addClass("hidden");
                },
            });
        }

        // Initialize Binodon News Swiper
        binodonNewsSwiperInstance = new Swiper(".BinodonNewsSwiper", {
            dir: direction,
            spaceBetween: 30,
            centeredSlides: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".binodon-news-next",
                prevEl: ".binodon-news-prev",
            },
            on: {
                slideNextTransitionStart: function () {
                    sectionFiveThirdPage++;
                    loadSectionFiveThirdNews(sectionFiveThirdPage);
                },
                slidePrevTransitionStart: function () {
                    if (sectionFiveThirdPage > 1) {
                        sectionFiveThirdPage--;
                        loadSectionFiveThirdNews(sectionFiveThirdPage);
                    }
                },
            },
        });

        function loadSectionFiveThirdNews(page) {
            // If slide for this page already exists, don't fetch via AJAX
            if ($("#swiper-slide-sec-five-third-" + page).length > 0) {
                return;
            }

            // Show existing loader
            $("#sec-five-third-loader").removeClass("hidden");

            $.ajax({
                url: sectionFiveThirdAjaxUrl,
                method: "GET",
                data: { page: page },
                success: function (res) {
                    // Hide loader
                    $("#sec-five-third-loader").addClass("hidden");

                    // Insert the new slide before the final slide marker
                    $("#no-need-to-slide-sec-five-third").before(res.html);

                    if (page == res.maxSliders) {
                        $("#no-need-to-slide-sec-five-third").remove();
                    }

                    binodonNewsSwiperInstance.update();
                },
                error: function () {
                    console.error("Failed to load news");
                    $("#sec-five-third-loader").addClass("hidden");
                },
            });
        }

        // Initialize Lifestyle News Swiper
        lifestyleNewsSwiperInstance = new Swiper(".LifestyleNewsSwiper", {
            dir: direction,
            spaceBetween: 30,
            centeredSlides: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".lifestyle-news-next",
                prevEl: ".lifestyle-news-prev",
            },
            on: {
                slideNextTransitionStart: function () {
                    sectionFiveFourthPage++;
                    loadSectionFiveFourthNews(sectionFiveFourthPage);
                },
                slidePrevTransitionStart: function () {
                    if (sectionFiveFourthPage > 1) {
                        sectionFiveFourthPage--;
                        loadSectionFiveFourthNews(sectionFiveFourthPage);
                    }
                },
            },
        });

        function loadSectionFiveFourthNews(page) {
            // If slide for this page already exists, don't fetch via AJAX
            if ($("#swiper-slide-sec-five-fourth-" + page).length > 0) {
                return;
            }

            // Show existing loader
            $("#sec-five-fourth-loader").removeClass("hidden");

            $.ajax({
                url: sectionFiveFourthAjaxUrl,
                method: "GET",
                data: { page: page },
                success: function (res) {
                    // Hide loader
                    $("#sec-five-fourth-loader").addClass("hidden");

                    // Insert the new slide before the final slide marker
                    $("#no-need-to-slide-sec-five-fourth").before(res.html);

                    if (page == res.maxSliders) {
                        $("#no-need-to-slide-sec-five-fourth").remove();
                    }

                    lifestyleNewsSwiperInstance.update();
                },
                error: function () {
                    console.error("Failed to load news");
                    $("#sec-five-fourth-loader").addClass("hidden");
                },
            });
        }

        // Initialize Article News Swiper
        articleNewsSwiperInstance = new Swiper(".ArticleSwiper", {
            dir: direction,
            loop: true,
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
