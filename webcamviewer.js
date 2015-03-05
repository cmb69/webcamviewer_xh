/*!
 * Webcamviewer_XH
 *
 * @author  Christoph M. Becker <cmbecker69@gmx.de>
 * @license GPL-3.0+
 */

/*jslint browser: true, maxlen: 80 */
/*global WEBCAMVIEWER */

(function () {
    "use strict";

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
            appendix = "qwerty=" + new Date().valueOf();
            image.src =  url + separator + appendix;
        }
    }

    /**
     * Initializes the webcam viewers.
     *
     * @returns {undefined}
     */
    function init() {
        var i, len, image;

        for (i = 0, len = document.images.length; i < len; i += 1) {
            image = document.images[i];
            if (/(^|\s)webcamviewer($|\s)/.test(image.className)) {
                images.push(image);
                urls.push(image.src);
            }
        }
        setInterval(refresh, WEBCAMVIEWER.interval);
    }

    on(window, "load", function () {
        images = [];
        urls = [];
        init();
    });
}());
