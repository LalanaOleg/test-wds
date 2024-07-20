import LazyLoad from "vanilla-lazyload";

// Work with class ._lazy
const lazyMedia = new LazyLoad({
	elements_selector: '[data-src],[data-srcset]',
	class_loaded: '_lazy-loaded',
	use_native: true
});

//lazyMedia.update();