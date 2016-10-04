(function($){    
    $(function(){
        var container = $(".view-about-us, .view-programs").find(".view-content");
        
        if (container.length == 0) return;
        
        var height = $(window).height() - 139;
        var width = $(window).width();
        var min = Math.ceil(container.find(".views-row").length/Math.floor((width+10)/270))*250;
        if (height < min)
        {
            return;
        }
        container.height(height);
        
        var offset = container.offset();
        var options = {
            gravity: {x: 0, y: 0.75}, 
            containment: [0, offset.top, width, offset.top + height], 
            shape: "circle",
            drag: false
        };
        container.find(".views-row")
        .each(function(i){
            var numPerRow = Math.floor((width+10)/270);
            $(this).css({
                "left":(i%numPerRow)*270+getRandom(-25,25)+"px",
                "top":Math.floor(i/numPerRow)*270+"px",
                "position":"absolute"
            }).appendTo("body");
        })
        .throwable(options);
    });
    
    function getRandom(min, max)
    {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
})(jQuery);
