document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".netflixHero", {
        loop: true,
        autoplay: {
            delay: 8000,
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
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const swiper = new Swiper(".top10Swiper", {
        slidesPerView: 2,
        spaceBetween: 10,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 3,
                spaceBetween: 15,
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 5,
                spaceBetween: 25,
            },
            1280: {
                slidesPerView: 6,
                spaceBetween: 30,
            },
        },
    });
});
