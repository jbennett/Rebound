(function($){    
    $(function(){
        var container = $(".view-about-us, .view-programs").find(".view-content");
        
        var height = $(window).height() - 139;
        var min = Math.ceil(container.find(".views-row").length/3) * 225;
        if (height < min) height = min;
        container.height(height);
        
        var offset = container.offset();
        var width = container.width();
        var options = {
            gravity: {x: 0, y: 1}, 
            containment: [offset.left, offset.top, offset.left + width, offset.top + height], 
            shape: "circle"
        };
        container.find(".views-row").throwable(options);
    });
})(jQuery);
