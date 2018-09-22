jQuery(document).ready(function($) {

    "use strict";

    $(window).on("load resize scroll",function(e){
        var contentHeight = jQuery(window).height();
        var footerHeight = jQuery('footer').height();
        var footerTop = jQuery('footer').position().top + footerHeight;
        if (footerTop < contentHeight) {
            jQuery('footer').css('margin-top', 0+ (contentHeight - footerTop) + 'px');
        }



        /* ===========================================================
         -------------------------- Equal Height -----------------------
         =========================================================== */
        equalheight('.contact-height');

        /* ===========================================================
         -------------------------- Blog filter -----------------------
         =========================================================== */
        var jQuerycontainer = $('#masonry')
        jQuerycontainer.isotope({
            layoutMode: 'masonry',
            transitionDuration: '.8s',
            hiddenStyle: {
                opacity: 0,
                transform: 'perspective(100em) scale(0.2) rotateX(180deg)'
            },
            visibleStyle: {
                opacity: 1,
                transform: 'perspective(100em) scale(1) rotateX(0)'
            },
            masonry: {
                columnWidth: '.masonry'
            }
        });
        $('.filters a').on("click", function(){
            $('.select-filter').removeClass('select-filter');
            $(this).parent('li').addClass('select-filter');
            var selector = $(this).attr('data-filter');
            jQuerycontainer.isotope({ filter: selector });
            return false;
        });
    });

    /* ===========================================================
     ----------------------- Page Preloader -----------------------
     =========================================================== */
    $(window).load(function() {
        $('.preloader').fadeOut();
        $('#wrapper').css('opacity', '1').fadeIn();
    });
    /* ===========================================================
     -------------------------- Side Menu -------------------------
     =========================================================== */
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    $('.drilldown').drilldown();

    /* ===========================================================
     ------------------------- Page Banner ------------------------
     =========================================================== */
    var bannerheight = $(window).height();
    var blogimage = $(window).height()/2 + 80;
    $('.page-header,.post-image').css('height',bannerheight);
    $('.post-image.half').css('height',blogimage);

    $(window).resize(function(){
        $('.page-header,.post-image').css('height',bannerheight);
        $('.post-image.half').css('height',blogimage);
    });

    /* ===========================================================
     --------------------- Embed Youtube video --------------------
     =========================================================== */
    $(".yt_container").prettyEmbed({
        // videoID: 'BFVROcHReU0',
        previewSize: "hd",
        customPreviewImage: "",
        showInfo: false,
        showControls: true,
        loop: false,
        colorScheme: "dark",
        showRelated: false,
        useFitVids: true
    });

    /* ===============================================
     --------------------- Fitvids --------------------
     =============================================== */
    $(".video-thumb").fitVids();

    /* ===========================================================
     --------------------- Embed Vimeo video ----------------------
     =========================================================== */
    $('.video-thumb').smartVimeoEmbed({
        idSelectorName: 'vimeo-id',
    });


    /* ======================================================
     --------------------- Sticky Sidebar --------------------
     ======================================================= */

    $('.main-sidebar').theiaStickySidebar({
        additionalMarginTop: 30
    });
    /* =======================================================
     --------------------- Owl post slider --------------------
     ======================================================= */
    $(".owl-post").owlCarousel({
        navigation : false, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        autoPlay:true,
        responsiveRefreshRate:700
    });

    /* ===================================================
     --------------------- Flex Slider --------------------
     ==================================================== */
    $('.home-slide').flexslider({
        animation: "fade",
        slideDirection: "horizontal",
        directionNav: true,
        touch: true,
        slideshow: true,
        prevText: ["<i class='fa fa-angle-left'></i>"],
        nextText: ["<i class='fa fa-angle-right'></i>"],
    });


    /* =================================================
     --------------------- Scroll up --------------------
     ================================================= */
    $.scrollUp({
        scrollName: 'scrollUp', // Element ID
        scrollDistance: 300, // Distance from top/bottom before showing element (px)
        scrollFrom: 'top', // 'top' or 'bottom'
        scrollSpeed: 300, // Speed back to top (ms)
        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
        animation: 'fade', // Fade, slide, none
        animationSpeed: 200, // Animation in speed (ms)
        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or $ object
        //scrollTarget: false, // Set a custom target element for scrolling to the top
        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
        scrollTitle: false, // Set a custom <a> title if required.
        scrollImg: false, // Set true to use image
        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        zIndex: 2147483647 // Z-Index for the overlay
    });


    $('#page-content-wrapper-2').fullpage({
        'verticalCentered': false,
        'css3': true,
        'navigation': true,
        'navigationPosition': 'right',

    });

});
(function($) {


    /*-----------------------------------------------------------------------------------*/
    /*  equal height
     /*-----------------------------------------------------------------------------------*/
    equalheight = function(container){

        var currentTallest = 0,
            currentRowStart = 0,
            rowDivs = new Array(),
            $el,
            topPosition = 0;
        $(container).each(function() {

            $el = $(this);
            $($el).height('auto')
            topPostion = $el.position().top;

            if (currentRowStart != topPostion) {
                for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                    rowDivs[currentDiv].height(currentTallest);
                }
                rowDivs.length = 0; // empty the array
                currentRowStart = topPostion;
                currentTallest = $el.height();
                rowDivs.push($el);
            } else {
                rowDivs.push($el);
                currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
            }
            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
        });
    }


})(jQuery);
