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
	if (document.querySelector(".swiper")) {
		new Swiper(".swiper", {
			modules: [Navigation],
			observer: true,
			observeParents: true,
			slidesPerView: 1,
			spaceBetween: 0,
			//autoHeight: true,
			speed: 800,

			//touchRatio: 0,
			//simulateTouch: false,
			//loop: true,
			//preloadImages: false,
			//lazy: true,

			/*
			effect: 'fade',
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
			},
			*/

			/*
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			*/

			/*
			scrollbar: {
				el: '.swiper-scrollbar',
				draggable: true,
			},
			*/

			navigation: {
				prevEl: ".swiper-button-prev",
				nextEl: ".swiper-button-next",
			},
			/*
			breakpoints: {
				640: {
					slidesPerView: 1,
					spaceBetween: 0,
					autoHeight: true,
				},
				768: {
					slidesPerView: 2,
					spaceBetween: 20,
				},
				992: {
					slidesPerView: 3,
					spaceBetween: 20,
				},
				1268: {
					slidesPerView: 4,
					spaceBetween: 30,
				},
			},
			*/
			on: {},
		});
	}
}

window.addEventListener("load", function (e) {
	// Start sliders initialization
	initSliders();
});
