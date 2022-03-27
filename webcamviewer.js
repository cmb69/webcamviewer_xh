/**
 * Copyright 2012-2022 Christoph M. Becker
 *
 * This file is part of Webcamviewer_XH.
 *
 * Webcamviewer_XH is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Webcamviewer_XH is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Webcamviewer_XH.  If not, see <http://www.gnu.org/licenses/>.
 */

/*jslint browser: true, maxlen: 80 */

var images, urls;

/**
 * Registers an event listener.
 *
 * @param {EventTarget} element
 * @param {String}      type
 * @param {Function}    listener
 *
 * @returns {undefined}
 */
function on(element, type, listener) {
    if (typeof element.addEventListener !== "undefined") {
        element.addEventListener(type, listener, false);
    } else if (typeof element.attachEvent !== "undefined") {
        element.attachEvent("on" + type, listener);
    }
}

/**
 * Refreshes all webcam images.
 *
 * @returns {undefined}
 */
function refresh() {
    var i, len, image, url, separator, appendix;

    for (i = 0, len = images.length; i < len; i += 1) {
        image = images[i];
        url = urls[i];
        separator = url.indexOf("?") < 0 ? "?" : "&";
        appendix = "webcamviewer=" + new Date().valueOf();
        image.src =  url + separator + appendix;
    }
}

/**
 * Initializes the webcam viewers.
 *
 * @returns {undefined}
 */
function init() {
    var i, len, image, config;

    for (i = 0, len = document.images.length; i < len; i += 1) {
        image = document.images[i];
        if (/(^|\s)webcamviewer($|\s)/.test(image.className)) {
            images.push(image);
            urls.push(image.src);
        }
    }
    config = JSON.parse(document.getElementsByName("webcamviewer_config")[0].content);
    setInterval(refresh, config.interval);
}

on(window, "load", function () {
    images = [];
    urls = [];
    init();
});
