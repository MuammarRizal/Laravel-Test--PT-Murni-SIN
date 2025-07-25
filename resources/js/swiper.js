document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".netflixHero", {
        loop: true,
        autoplay: {
            delay: 8000,
            disableOnInteraction: false,
        },
        speed: 1000,
        effect: "fade",
        fadeEffect: {
            crossFade: true,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        allowTouchMove: false,
    });
});
