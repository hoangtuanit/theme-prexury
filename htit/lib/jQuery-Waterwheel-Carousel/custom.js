jQuery(document).ready(function( $ ){

    var carousel,
            $element = $('#watercarousel'),
            $carouselImages = $element.find('a');

    $carouselImages.css({
        overflow: 'hidden!important'
    });

    if (typeof $element.waterwheelCarousel == 'function') {
        // $carouselImages.removeAttr('style');
        // $carouselImages.off('click');
        var carousel = $element.waterwheelCarousel({
            forcedImageWidth: 700,
            forcedImageHeight: 380,
            horizonOffsetMultiplier: 0,
            speed: 600,
            flankingItems: 2,
            separation: 300,
            animationEasing: 'swing',
            opacityMultiplier: 1,
            movingToCenter:function(){
                console.log('movingToCenter');
            }, 
            movedToCenter:function(){
                console.log('movedToCenter');
            },
            clickedCenter:function(){
                console.log('clickedCenter');
            },
            movingFromCenter:function(){
                console.log('movingFromCenter');
            }, 
            movedFromCenter:function(){
                console.log('movedFromCenter');
            },
        });

        pixflow_showcase_moved($carouselImages.first(), $carouselImages);

        setTimeout(function () {

            $carouselImages.each(function (element, item ) {

                console.log('element',element);
                console.log('item',item);

                $(this).attr('data-left', $(this).css('left'));
                $(this).attr('data-top', $(this).css('top'));

                var $img = $(this).find('img');
                var img_w = $img.width();
                var img_h = $img.height();

                console.log('img_w',img_w);
                console.log('img_h',img_h);

            });
            featureLeft = $carouselImages.first().css('left').replace('px', '') * 1 + 119;
            featureTop = $carouselImages.first().css('top').replace('px', '') * 1 + 50;
            var showcaseTop = $element.offset().top,
                showcaseBottom = $element.offset().top + $element.outerHeight(true);
            if (($(window).scrollTop() + $(window).height()-100 >= showcaseTop) && ($(window).scrollTop() + 300 <= showcaseBottom)
                || window.self !== window.top) {
                    $element.addClass('open-showcase');
                    $carouselImages.each(function () {
                        $(this).animate({
                            'left': $(this).data('left'),
                            'top': $(this).data('top')
                        },1).finish();
                    })
            }else{
                $element.removeClass('open-showcase');
                $carouselImages.not('.carousel-center').animate({
                    left: featureLeft,
                    top: featureTop
                },1).finish();
                $carouselImages.filter('.carousel-center').animate({
                    left: $carouselImages.filter('.carousel-center').data('left'),
                    top: $carouselImages.filter('.carousel-center').data('top')
                },1).finish();
            }
        }, 1);

        function pixflow_showcase_moved($moveing, $carouselImages){
            "use strict";

            var current = $moveing,
                all = $carouselImages.length;

            $carouselImages.find('.showcase-overlay-first').remove();
            $carouselImages.find('.showcase-overlay-second').remove();

            for (var i = 0; i < all; i++) {
                if (current.index() == all - 1)
                    current = $carouselImages.first();
                else
                    current = current.next();
                if (i == 0 || (i == 3 && all == 5) || (i == 1 && all == 3)) {
                    current.append('<div class="showcase-overlay-first"></div>')
                }
                if ((i == 1 && all == 5) || (i == 2 && all == 5)) {
                    current.append('<div class="showcase-overlay-second"></div>')
                }
            }
        }


    }


})