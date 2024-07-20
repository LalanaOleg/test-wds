// Connecting the functionality of "Freelancer's Halls"
import { isMobile, uniqArray, FLS } from "../files/functions.js";
import { flsModules } from "../files/modules.js";

// Observer for objects [all-seeing eye]
// data-watch - you can write values to apply custom code
// data-watch-root - parent element inside which to observe the object
// data-watch-margin - margin
// data-watch-threshold - percentage of the object visible to trigger
// data-watch-once - observe only once
// _watcher-view - class added when the object appears

class ScrollWatcher {
	constructor(props) {
		let defaultConfig = {
			logging: true,
		}
		this.config = Object.assign(defaultConfig, props);
		this.observer;
		!document.documentElement.classList.contains('watcher') ? this.scrollWatcherRun() : null;
	}
	// Updating the constructor
	scrollWatcherUpdate() {
		this.scrollWatcherRun();
	}
	// Starting the constructor
	scrollWatcherRun() {
		document.documentElement.classList.add('watcher');
		this.scrollWatcherConstructor(document.querySelectorAll('[data-watch]'));
	}
	// Constructor for watchers
	scrollWatcherConstructor(items) {
		if (items.length) {
			this.scrollWatcherLogging(`Woke up, watching objects (${items.length})...`);
			// Unique parameters
			let uniqParams = uniqArray(Array.from(items).map(function (item) {
				return `${item.dataset.watchRoot ? item.dataset.watchRoot : null}|${item.dataset.watchMargin ? item.dataset.watchMargin : '0px'}|${item.dataset.watchThreshold ? item.dataset.watchThreshold : 0}`;
			}));
			// Get groups of objects with the same parameters,
			// create settings, initialize watcher
			uniqParams.forEach(uniqParam => {
				let uniqParamArray = uniqParam.split('|');
				let paramsWatch = {
					root: uniqParamArray[0],
					margin: uniqParamArray[1],
					threshold: uniqParamArray[2]
				}
				let groupItems = Array.from(items).filter(function (item) {
					let watchRoot = item.dataset.watchRoot ? item.dataset.watchRoot : null;
					let watchMargin = item.dataset.watchMargin ? item.dataset.watchMargin : '0px';
					let watchThreshold = item.dataset.watchThreshold ? item.dataset.watchThreshold : 0;
					if (
						String(watchRoot) === paramsWatch.root &&
						String(watchMargin) === paramsWatch.margin &&
						String(watchThreshold) === paramsWatch.threshold
					) {
						return item;
					}
				});

				let configWatcher = this.getScrollWatcherConfig(paramsWatch);

				// Initializing watcher with its settings
				this.scrollWatcherInit(groupItems, configWatcher);
			});
		} else {
			this.scrollWatcherLogging("Sleeping, no objects to watch. ZzzZZzz");
		}
	}
	// Function to create settings
	getScrollWatcherConfig(paramsWatch) {
		// Creating settings
		let configWatcher = {}
		// Parent element for observation
		if (document.querySelector(paramsWatch.root)) {
			configWatcher.root = document.querySelector(paramsWatch.root);
		} else if (paramsWatch.root !== 'null') {
			this.scrollWatcherLogging(`Umm... the parent object ${paramsWatch.root} is not on the page`);
		}
		// Trigger margin
		configWatcher.rootMargin = paramsWatch.margin;
		if (paramsWatch.margin.indexOf('px') < 0 && paramsWatch.margin.indexOf('%') < 0) {
			this.scrollWatcherLogging(`oops, the data-watch-margin setting should be in PX or %`);
			return
		}
		// Trigger points
		if (paramsWatch.threshold === 'prx') {
			// Parallax mode
			paramsWatch.threshold = [];
			for (let i = 0; i <= 1.0; i += 0.005) {
				paramsWatch.threshold.push(i);
			}
		} else {
			paramsWatch.threshold = paramsWatch.threshold.split(',');
		}
		configWatcher.threshold = paramsWatch.threshold;

		return configWatcher;
	}
	// Function to create a new watcher with its settings
	scrollWatcherCreate(configWatcher) {
		this.observer = new IntersectionObserver((entries, observer) => {
			entries.forEach(entry => {
				this.scrollWatcherCallback(entry, observer);
			});
		}, configWatcher);
	}
	// Function to initialize watcher with its settings
	scrollWatcherInit(items, configWatcher) {
		// Creating a new watcher with its settings
		this.scrollWatcherCreate(configWatcher);
		// Passing elements to the watcher
		items.forEach(item => this.observer.observe(item));
	}
	// Function to handle basic trigger point actions
	scrollWatcherIntersecting(entry, targetElement) {
		if (entry.isIntersecting) {
			// Seeing the object
			// Adding class
			!targetElement.classList.contains('_watcher-view') ? targetElement.classList.add('_watcher-view') : null;
			this.scrollWatcherLogging(`I see ${targetElement.classList}, added class _watcher-view`);
		} else {
			// Not seeing the object
			// Removing class
			targetElement.classList.contains('_watcher-view') ? targetElement.classList.remove('_watcher-view') : null;
			this.scrollWatcherLogging(`I don't see ${targetElement.classList}, removed class _watcher-view`);
		}
	}
	// Function to stop watching the object
	scrollWatcherOff(targetElement, observer) {
		observer.unobserve(targetElement);
		this.scrollWatcherLogging(`I stopped watching ${targetElement.classList}`);
	}
	// Function to log messages to the console
	scrollWatcherLogging(message) {
		this.config.logging ? FLS(`[Watcher]: ${message}`) : null;
	}
	// Function to handle watcher callback
	scrollWatcherCallback(entry, observer) {
		const targetElement = entry.target;
		// Handling basic trigger point actions
		this.scrollWatcherIntersecting(entry, targetElement);
		// If there is a data-watch-once attribute, stop watching
		targetElement.hasAttribute('data-watch-once') && entry.isIntersecting ? this.scrollWatcherOff(targetElement, observer) : null;
		// Creating a custom feedback event
		document.dispatchEvent(new CustomEvent("watcherCallback", {
			detail: {
				entry: entry
			}
		}));

		/*
		// Select the necessary objects
		if (targetElement.dataset.watch === 'some value') {
			// write unique specifics
		}
		if (entry.isIntersecting) {
			// Seeing the object
		} else {
			// Not seeing the object
		}
		*/
	}
}
// Start and add to the modules object
flsModules.watcher = new ScrollWatcher({});
