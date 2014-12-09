(function($){  
    var fadeTime = 300; 
     
    $(function(){
        $(".view-about-us-row, .view-programs-row").click(clickOpen);
        $("<a href='#' class='close'>&nbsp;</a>").click(close).prependTo(contentRows());
        
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
        contentRows().each(function(i){
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
        contentRows().eq(i).fadeIn(fadeTime);
    }
    function closePopup()
    {
        contentRows().fadeOut(fadeTime);
    }
    
    function openOverlay()
    {
        if($(".popup-overlay").length == 0)
            $("<div class='popup-overlay'></div>").click(close).appendTo(".main-wrapper");
        
        $(".popup-overlay").fadeIn(fadeTime);
    }
    function closeOverlay()
    {
        $(".popup-overlay").fadeOut(fadeTime);
    }
    
    function contentRows()
    {
        return containers().find(".views-row");
    }
    function containers()
    {
        return $(".view-about-us-content, .view-programs-content");
    }
})(jQuery);
