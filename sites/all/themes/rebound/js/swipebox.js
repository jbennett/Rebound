(function($){    
    $(function(){
        $('.swipebox, .view-program .views-field-field-photos a').swipebox();
        
        $(".view-photo-galleries .view-content a").click(function(){
            var photos = [];
            var $items = $(this).parents(".views-row").find("[data-href]");
            for (var i=0; i<$items.length; i++)
            {
                photos.push({href: $items.eq(i).data("href")});
            }
            $.swipebox(photos);
            
            return false;
        });
    });
})(jQuery);
