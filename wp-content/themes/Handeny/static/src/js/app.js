import "../scss/style.scss";

import * as flsFunctions from "./files/functions.js";

flsFunctions.isWebp();
flsFunctions.addTouchClass();
/* For burger menu */
flsFunctions.menuInit();
flsFunctions.subMenus();

import "./libs/select.js";
import "./files/scroll/lazyload.js";
import { headerScroll } from "./files/scroll/scroll.js";
import "./files/sliders.js";

headerScroll();

import "./files/script.js";
