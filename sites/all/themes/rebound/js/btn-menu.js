(function($){    
    $(function(){
        $(".navigation .btn-menu").click(toggleMenu);
    });
    
    function toggleMenu()
    {
        $("body").toggleClass("open-menu");
        return false;
    }
})(jQuery);
