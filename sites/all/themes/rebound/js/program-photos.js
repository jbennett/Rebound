(function($){    
    var scrolling = false;
    
    $(function(){
        if (container().length > 0)
        {
            init();
        }
    });
    
    function init()
    {    
        $(".view-program .arrow-left")
        .on("mousedown", leftMousedown)
        .on("mouseup keyup", mouseup)
        .on("keydown", keydown)
        .click(click);
        
        $(".view-program .arrow-right")
        .on("mousedown", rightMousedown)
        .on("mouseup keyup", mouseup)
        .on("keydown", keydown)
        .click(click);
        
        $(window).resize(showHideArrows);
    }
    
    function container()
    {
        return $(".view-program .views-field-field-photos");
    }
    
    function click()
    {
        return false;
    }
    function mouseup()
    {
        scrolling = false;
    }
    
    function leftMousedown()
    {
        scrolling = true;
        leftScroll();
    }
    function leftScroll()
    {
        var $ul = container().find("ul");
        var left = parseInt($ul.css("left")) || 0;
        var max = 0;
        if (!scrolling || left >= max)
        {
            $ul.stop();
        }
        else
        {            
            $ul.animate({"left":"+=5px"}, 10, "linear", function(){
                if (scrolling)
                {
                    leftScroll();
                }
            });
        }
    }
    
    function rightMousedown()
    {
        scrolling = true;
        rightScroll();
    }
    function rightScroll()
    {
        var $ul = container().find("ul");
        var left = parseInt($ul.css("left")) || 0;
        var min = $ul.find("li").length*-138 + $ul.parent().width();

        if (!scrolling || left <= min)
        {
            $ul.stop();
        }
        else
        {
            $ul.animate({"left":"-=5px"}, 10, "linear", function(){
                if (scrolling)
                {
                    rightScroll();
                }
            });
        }
    }
    
    function keydown(e)
    {
        if (e.which == 13)
        {
            $(this).trigger("mousedown");
        }
    }
    
    function showHideArrows()
    {
        var width = 0;
        container().find("li").each(function(){
            width += $(this).outerWidth();
        });
        
        if (width > container().width())
        {
            showArrows();
        }
        else
        {
            hideArrows();
        }
    }
    function showArrows()
    {
        container().find(".arrow-left").add(container().find(".arrow-right")).fadeIn(200);
    }
    function hideArrows()
    {
        container().find(".arrow-left").add(container().find(".arrow-right")).fadeOut(200);
    }
})(jQuery);
