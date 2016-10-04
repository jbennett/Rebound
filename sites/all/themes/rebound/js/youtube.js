(function($){    
    $(function(){
        $(".views-field-field-youtube-video-id").click(videoClick);
    });
    
    function videoClick()
    {
        var id = $(this).find("[data-vid]").data("vid");
        if (id)
        {
            $(this).addClass("open")
            .find(".field-content")
            .html("<iframe src='//www.youtube.com/embed/"+id+"?html5=1&autoplay=1&rel=0' frameborder='0' allowfullscreen></iframe>");
        }
    }
})(jQuery);
