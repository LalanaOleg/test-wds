/*
Slider: https://swiperjs.com/
Snippet(HTML): swiper
Modules: Navigation, Pagination, Autoplay, 
EffectFade, Lazy, Manipulation
*/
import Swiper from "swiper";
import { Navigation } from "swiper/modules";

import "../../scss/base/swiper.scss";
// Styles from scss/libs/swiper.scss
// import "../../scss/libs/swiper.scss";
// All styles from node_modules
// import 'swiper/css';

// Slider initialization
function initSliders() {
	if (document.querySelector(".featured__swiper")) {
		new Swiper(".featured__swiper", {
			modules: [Navigation],
			observer: true,
			observeParents: true,
			slidesPerView: "auto",
			spaceBetween: 15,
			//autoHeight: true,
			speed: 800,

			//touchRatio: 0,
			//loop: true,
			//lazy: true,

			/*
			effect: 'fade',
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
			},
			*/

			navigation: {
				prevEl: ".featured__left-arrow",
				nextEl: ".featured__right-arrow",
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
				},
				480: {
					slidesPerView: 2,
				},
				639.8: {
					slidesPerView: "auto",
				},
			},
			on: {},
		});
	}
	if (document.querySelector(".blog-swiper")) {
		new Swiper(".blog-swiper", {
			modules: [Navigation],
			observer: true,
			observeParents: true,
			slidesPerView: 3,
			spaceBetween: 15,
			//autoHeight: true,
			speed: 800,

			//touchRatio: 0,
			//loop: true,
			//lazy: true,

			/*
			effect: 'fade',
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
			},
			*/

			navigation: {
				prevEl: ".blog__left-arrow",
				nextEl: ".blog__right-arrow",
			},
			breakpoints: {
				320: {
					slidesPerView: 1,
				},
				540: {
					slidesPerView: 2,
				},
				760: {
					slidesPerView: 3,
				},
			},
			on: {},
		});
	}
}

window.addEventListener("load", function (e) {
	// Start sliders initialization
	initSliders();
});
