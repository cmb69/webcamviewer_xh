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

// @ts-check

let images = [];
let urls = [];

/**
 * @returns {void}
 */
function refresh() {
    for (let i = 0, len = images.length; i < len; i += 1) {
        let image = images[i];
        let url = urls[i];
        let separator = url.indexOf("?") < 0 ? "?" : "&";
        let appendix = "webcamviewer=" + new Date().valueOf();
        image.src =  url + separator + appendix;
    }
}

/**
 * @returns {void}
 */
function init() {
    for (let image of document.images) {
        if (image.classList.contains("webcamviewer")) {
            images.push(image);
            urls.push(image.src);
        }
    }
    let el = /** @type {HTMLMetaElement} */ (document.getElementsByName("webcamviewer_config")[0]);
    let config = JSON.parse(el.content);
    setInterval(refresh, config.interval);
}

window.addEventListener("load", init, false);
