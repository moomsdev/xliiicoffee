// eslint-disable-next-line no-unused-vars...

import config from '@config';
import "./vendor/*.js";
import "./pages/*.js";
import "./pages/*.min.js";
import "@styles/theme";
import "@images/favicon.ico";
import "airbnb-browser-shims";

// Your code goes here ...

import "mmenu-js/src/mmenu";
import "mmenu-js/dist/mmenu.polyfills";

import 'swiper/swiper-bundle.min';
import Swiper from 'swiper/swiper-bundle.min';

// import "@fancyapps/fancybox/dist/jquery.fancybox.min";
jQuery(document).ready(function () {

    // // Smooth scrolling
    // $(window).on('scroll', function(event) {
    //     event.preventDefault();
    //     var scrollPosition = $(window).scrollTop();
    //     $('html, body').stop().animate({
    //         scrollTop: scrollPosition
    //     }, 200);
    // });
    //
    // $(window).on('mousewheel', function(event) {
    //     event.preventDefault();
    //     var delta = event.originalEvent.wheelDelta;
    //     var scrollPosition = $(window).scrollTop();
    //     $('html, body').stop().animate({
    //         scrollTop: scrollPosition - delta
    //     }, 200);
    // });

    //back to top
    var btn = $('#button');

    $(window).scroll(function() {
        if ($(window).scrollTop() > 600) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    });

    // Menu fixed
    let navbar = document.getElementById('header').classList
    let active_class = "fixed"

    /**
     * Scroll menu
     */
    window.addEventListener('scroll', e => {
        if(pageYOffset > 500) navbar.add(active_class)
        else navbar.remove(active_class)
    })

  // ---------mmenu

  new Mmenu("#mobile_menu", {
    extensions: ["position-bottom", "fullscreen", "theme-black", "border-full"],
    searchfield: false,
    counters: false,


  });

    // Slider Blocks
    const swiper_slider = new Swiper('.sliders', {
        spaceBetween: 30,
        centeredSlides: true,
        effect: 'fade',
        speed: 1500,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
        },
    });

    // Content Slider Blocks
    const content_slider = new Swiper('.content-slider', {
        spaceBetween: 30,
        cslidesPerView: 4,
        paginationClickable: true,
        loop: true,
        speed: 1500,
        // autoplay: {
        //     delay: 5000,
        //     disableOnInteraction: false,
        // },
        scrollbar: {
            el: ".swiper-scrollbar",
        },
        breakpoints: {
            1440: {
                slidesPerView: 4,
                spaceBetween: 30
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            576: {
                slidesPerView: 2,
                centeredSlides: true,
                spaceBetween: 30,
                grabCursor: true,
            },
            320: {
                slidesPerView: 1,
                spaceBetween: 15
            }
        }
    });

});

