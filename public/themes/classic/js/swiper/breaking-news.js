//Breaking News Swiper
var swiper = new Swiper(".BreakingNewsSwiper", {
    direction: "vertical",
    loop: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".breaking-news-next",
        prevEl: ".breaking-news-prev",
    },
});
//Breaking News Swiper
var swiper = new Swiper(".StoryNewsSwiper", {
    // direction: "vertical",
    loop: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".story-news-next",
        prevEl: ".story-news-prev",
    },
});
