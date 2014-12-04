(function($){  
    var fadeTime = 300; 
     
    $(function(){
        $(".view-about-us-row").click(clickOpen);
        $("<a href='#' class='close'>&nbsp;</a>").click(close).prependTo(".view-about-us-content .views-row");
        
        $(window).on("popstate", popState);
        
        if (window.location.hash.indexOf("#!") == 0)
        {
            openPopupOnLoad();
        }
    });
    
    function popState(e)
    {
        closePopup();
        closeOverlay();
        if (e.originalEvent && e.originalEvent.state && e.originalEvent.state.i)
        {
            openPopup(e.originalEvent.state.i);
            openOverlay();
        }
    }
    function openPopupOnLoad()
    {
        $(".view-about-us-content .views-row").each(function(i){
        if (window.location.hash == "#!"+$(this).find(".views-field-title .field-content").text().toLowerCase().replace(" ","-"))
            {
                openPopup(i);
                openOverlay();
                return false;
            }
        });
    }
    
    function clickOpen()
    {
        openPopup($(this).data("i"));
        openOverlay();
        
        var state = {"i":$(this).data("i")};
        var url = "#!"+$(this).find(".views-field-title .field-content").text().toLowerCase().replace(/ /g,"-");
        window.history.pushState(state, '', url);
        
        return false;
    }
    function close()
    {
        closePopup();
        closeOverlay();
        
        window.history.pushState({}, '', window.location.pathname);
        
        return false;
    }
    
    function openPopup(i)
    {
        $(".view-about-us-content .views-row").eq(i).fadeIn(fadeTime);
    }
    function closePopup()
    {
        $(".view-about-us-content .views-row").fadeOut(fadeTime);
    }
    
    function openOverlay()
    {
        if($(".about-us-overlay").length == 0)
            $("<div class='about-us-overlay'></div>").click(close).appendTo(".main-wrapper");
        
        $(".about-us-overlay").fadeIn(fadeTime);
    }
    function closeOverlay()
    {
        $(".about-us-overlay").fadeOut(fadeTime);
    }
})(jQuery);
