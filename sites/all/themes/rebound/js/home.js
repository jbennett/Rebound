(function($){
    var controller;
    
    $(function(){
        if ($("body").hasClass("not-front")) return;
        
        resizeHeader();
        $(window).resize(resizeHeader);
        
        initParallax();
    });
    
    function resizeHeader()
    {
        $("#block-block-12, .region-header").height($(window).height());
    }
    
    function initParallax()
    {
        controller = new ScrollMagic();
        createDecorativeCircles();
        parallaxScenes()
    }
    function parallaxScenes()
    {
        $(".view-primary-circles .views-row, .view-secondary-circles .views-row, .view-red-circles .views-row").each(function(){
            new ScrollScene({triggerElement: $(this), duration:$(this).outerHeight()})
            .setClassToggle($(this), "active")
            .addTo(controller);
        });
        
        var contentHeight = $(".main-wrapper").height();
        var contentOffset = $(".main-wrapper").offset();
        var contentTop = contentOffset.top;
        $(".region-content .circle").each(function(i){
            var startTop = getRandom(0, contentHeight);
            var movement = getRandomDuration();
            var endTop = startTop + movement;
            var duration = $(window).height() + movement + 100;
            var triggerPosition = startTop;
            
            var tween = new TweenMax.fromTo($(this), 1, {"top":startTop+"px"}, {"top":endTop+"px"});
            
            new ScrollScene({offset: triggerPosition, "duration":duration})
            .setTween(tween)
            .addTo(controller);
        });
    }
    
    function createDecorativeCircles()
    {    
        var numCircles = 20;
        var numColors = 8;
        var numPositions = 7;
        
        for (var i=0; i < numCircles; i++)
        {
            var color = getRandom(1, numColors);
            var left = getRandom(0, 100);
            $("<div class='circle color-"+color+"' style='left:"+left+"%;'></div>").appendTo(".region-content");
        }
    }
    
    function getRandom(min, max)
    {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
    function getRandomDuration()
    {
        var windowHeight = $(window).height();
        var max = Math.floor(windowHeight*0.75);
        var min = -1*max;
        return getRandom(min, max);
    }
})(jQuery);