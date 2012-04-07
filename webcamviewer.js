/**
 * Javascript of Webcamviewer_XH.
 *
 * Copyright (c) 2012 Christoph M. Becker (see license.txt)
 */


(function($) {

    Webcamviewer = {

        images: [],

        urls: [],

        init: function() {
            Webcamviewer.images = $('.webcamviewer');
            Webcamviewer.urls = Webcamviewer.images.map(function() {
                return $(this).attr('src');
            });
        },

        refresh: function() {
            Webcamviewer.images.each(function(i) {
                $(this).attr('src', './plugins/webcamviewer/webcamviewer.php?url='
                        + encodeURIComponent(Webcamviewer.urls[i]) + '&time=' + new Date().getTime())
            })
        }
    }


    $(function() {
        Webcamviewer.init();
        setInterval(Webcamviewer.refresh, Webcamviewer.INTERVAL);
    })

})(jQuery)
