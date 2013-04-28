/**
 * Javascript of Webcamviewer_XH.
 *
 * Copyright (c) 2012 Christoph M. Becker (see license.txt)
 */


Webcamviewer = {

    images: [],

    urls: [],

    init: function() {
        var images = document.images;
        for (var i = 0; i < images.length; i++) {
            if (/(^|\s)webcamviewer($|\s)/.test(images[i].className)) {
                Webcamviewer.images.push(images[i]);
                Webcamviewer.urls.push(images[i].src);
            }
        }

        //Webcamviewer.images = $('.webcamviewer');
        //Webcamviewer.urls = Webcamviewer.images.map(function() {
        //    return $(this).attr('src');
        //});
        setInterval(Webcamviewer.refresh, Webcamviewer.INTERVAL);
    },

    refresh: function() {
        for (var i = 0; i < Webcamviewer.images.length; i++) {
            var image = Webcamviewer.images[i];
            image.src = Webcamviewer.urls[i] + '?time=' + new Date().getTime();
        }
        //Webcamviewer.images.each(function(i) {
        //    $(this).attr('src', './plugins/webcamviewer/webcamviewer.php?url='
        //            + encodeURIComponent(Webcamviewer.urls[i]) + '&time=' + new Date().getTime())
        //})
    }
}
