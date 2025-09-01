/*  */
var swiper = new Swiper(".OpinionFadeSwiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    effect: "fade",
    loop: false,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".opinion-swiper-button-next",
        prevEl: ".opinion-swiper-button-prev",
    },
});
