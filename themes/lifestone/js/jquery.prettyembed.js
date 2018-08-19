//===============================================
// ------------- prettyembed v1.2.1 -------------
//===============================================
/*
 **********************************************************
 * prettyEmbed.js | https://github.com/mike-zarandona/prettyembed.js
 *
 * Version:		v1.2.1
 * Author:		Mike Zarandona
 * Release:		July 31 2014
 *
 * Reqs:			jQuery  |  http://jquery.com
 * 				waitForImages  |  https://github.com/alexanderdickson/waitForImages
 *
 * Optional:		FitVids.js  |  http://fitvidsjs.com
 *
 * Usage:		$('#video-placeholder-element').prettyEmbed({
 * 					videoID: 'aBcDeFg12345',
 * 					previewSize: '',
 * 					customPreviewImage: '',
 *
 * 					showInfo: true,
 * 					showControls: true,
 * 					loop: false,
 *					closedCaptions: false,
 * 					colorScheme: 'dark',
 * 					showRelated: false,
 *
 * 					useFitVids: true
 * 				});
 **********************************************************
 */

(function ($, undefined) {
    $.fn.prettyEmbed = function (options) {

        // Override defaults with specified options
        options = $.extend({}, $.fn.prettyEmbed.options, options);

        // Test for mobile devices
        var mobile = (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent))? true : false;

        // Inject styles if not already present
        if ( $('#pretty-embed-style').length === 0 ) {
            var styles = $('<style />', {
                id:		'pretty-embed-style',
                html:	''
            }).appendTo('head');
        }

        // Error Checking
        if (options.useFitVids) {
            if (!$.isFunction($.fn.fitVids)) {
                console.error('PrettyEmbed.js Error:  options.useFitVids is set to true; FitVids not found!');
            }
        }

        // Store $('this') in a variable to minimize DOM searches
        var elem;

        // if no selector, only fire on .pretty-embed
        if ( $(this).length === 0 ) { elem = $('.pretty-embed'); }
        else { elem = $(this); }

        // Main setup loop
        elem.each(function() {

            // Tag the selected elements
            $(this).addClass('pretty-embed');

            var $newDOMElement,
                thisVideoID = '',
                thisPreviewSize = '',
                thisCustomPreviewImage = '',
                thisShowInfo,
                thisShowControls,
                thisLoop,
                thisClosedCaptions,
                thisLocalization,
                thisColorScheme,
                thisShowRelated,
                thisAllowFullScreen,
                fullScreenFlag;

            // videoID
            if ( $(this).attr('data-pe-videoid') !== undefined ) { thisVideoID = $(this).attr('data-pe-videoid'); }
            else if ( $(this).attr('href') !== undefined ) { thisVideoID = youtube_parser( $(this).attr('href') ); }
            else { thisVideoID = options.videoID; }

            // previewsize
            if ( $(this).attr('data-pe-preview-size') !== undefined ) { thisPreviewSize = $(this).attr('data-pe-preview-size'); }
            else if ( options.previewSize !== undefined ) { thisPreviewSize = options.previewSize; }
            else { thisPreviewSize = undefined; }

            // custom placeholder
            if ( $(this).attr('data-pe-custom-preview-image') !== undefined ) { thisCustomPreviewImage = $(this).attr('data-pe-custom-preview-image'); }
            else if ( options.customPreviewImage !== undefined ) { thisCustomPreviewImage = options.customPreviewImage; }
            else { thisCustomPreviewImage = undefined; }

            // showinfo
            if ( $(this).attr('data-pe-show-info') !== undefined ) { thisShowInfo = $(this).attr('data-pe-show-info'); }
            else if ( options.showInfo !== undefined ) { thisShowInfo = options.showInfo; }
            else { thisShowInfo = undefined; }

            // show controls
            if ( $(this).attr('data-pe-show-controls') !== undefined ) { thisShowControls = $(this).attr('data-pe-show-controls'); }
            else if ( options.showControls !== undefined ) { thisShowControls = options.showControls; }
            else { thisShowControls = undefined; }

            // loop
            if ( $(this).attr('data-pe-loop') !== undefined ) { thisLoop = $(this).attr('data-pe-loop'); }
            else if ( options.loop !== undefined ) { thisLoop = options.loop; }
            else { thisLoop = undefined; }

            // closed captions
            if ( $(this).attr('data-pe-closed-captions') !== undefined ) { thisClosedCaptions = $(this).attr('data-pe-closed-captions'); }
            else if ( options.closedCaptions !== undefined ) { thisClosedCaptions = options.closedCaptions; }
            else { thisClosedCaptions = undefined; }

            // localization
            if ( $(this).attr('data-pe-localization') !== undefined ) { thisLocalization = $(this).attr('data-pe-localization'); }
            else if ( options.localization !== undefined ) { thisLocalization = options.localization; }
            else { thisLocalization = undefined; }

            // color scheme
            if ( $(this).attr('data-pe-color-scheme') !== undefined ) { thisColorScheme = $(this).attr('data-pe-color-scheme'); }
            else if ( options.colorScheme !== undefined ) { thisColorScheme = options.colorScheme; }
            else { thisColorScheme = undefined; }

            // show related
            if ( $(this).attr('data-pe-show-related') !== undefined ) { thisShowRelated = $(this).attr('data-pe-show-related'); }
            else if ( options.showRelated !== undefined ) { thisShowRelated = options.showRelated; }
            else { thisShowRelated = undefined; }

            // allow full screen
            if ( $(this).attr('data-pe-allow-fullscreen') !== undefined ) { thisAllowFullScreen = $(this).attr('data-pe-allow-fullscreen'); }
            else if ( options.allowFullScreen !== undefined ) { thisAllowFullScreen = options.allowFullScreen; }
            else { thisAllowFullScreen = undefined; }


            // If this element is an <a/>, create a placeholder replacement
            if ( $(this).is('a') ) {

                // build the DOM structure
                $newDOMElement = $('<div />').addClass('pretty-embed');

                // rebuild the data-pe- attributes
                $newDOMElement.attr('data-pe-videoid', thisVideoID)
                    .attr('data-pe-preview-size', thisPreviewSize)
                    .attr('data-pe-custom-preview-image', thisCustomPreviewImage)
                    .attr('data-pe-show-info', thisShowInfo)
                    .attr('data-pe-show-controls', thisShowControls)
                    .attr('data-pe-loop', thisLoop)
                    .attr('data-pe-closed-captions', thisClosedCaptions)
                    .attr('data-pe-localization', thisLocalization)
                    .attr('data-pe-color-scheme', thisColorScheme)
                    .attr('data-pe-show-related', thisShowRelated)
                    .attr('data-pe-allow-fullscreen', thisAllowFullScreen);

                // append the new element, and remove the <a/>
                $(this).after($newDOMElement);
            }

            // Write the options.customPreviewImage OR choose a size
            if ( thisCustomPreviewImage !== undefined && thisCustomPreviewImage !== '' ) {
                $(this).html('<img src="' + thisCustomPreviewImage + '" width="100%" alt="YouTube Video Preview" />');
            }
            else {
                var previewSizePrefix = '';

                switch (thisPreviewSize) {
                    case 'thumb-default':
                        previewSizePrefix = 'default';
                        break;
                    case 'thumb-1':
                        previewSizePrefix = '1';
                        break;
                    case 'thumb-2':
                        previewSizePrefix = '2';
                        break;
                    case 'thumb-3':
                        previewSizePrefix = '3';
                        break;
                    case 'default':
                        previewSizePrefix = 'mqdefault';
                        break;
                    case 'medium':
                        previewSizePrefix = '0';
                        break;
                    case 'high':
                        previewSizePrefix = 'hqdefault';
                        break;
                    default:	// 'hd' or max-resolution quality
                        previewSizePrefix = 'maxresdefault';
                        break;
                }

                // Write the <img/> element
                $(this).html('<img src="http://img.youtube.com/vi/' + thisVideoID + '/' + previewSizePrefix + '.jpg" width="100%" alt="YouTube Video Preview" />');
            }

            if ( $(this).is('a') ) {
                $newDOMElement.html( $(this).html() );
                $(this).remove();
            }

            // if mobile, go straight to iframe
            if (mobile) {
                $(window).on('load', function() {
                    $('.pretty-embed').trigger('click');
                });
            }
        });



        // Click handler: load the video
        $('body').on('click', '.pretty-embed', function(e) {
            e.preventDefault();

            clickEventRunner( $(this) );
        });



        /**
         * Function: clickEventRunner(obj)
         * Contains the functionality for .on('click') events
         * obj = the current object referenced passed from $(this)
         */
        function clickEventRunner(obj) {
            var wrapperWidth = obj.find('img').outerWidth(true),
                wrapperHeight = obj.find('img').outerHeight(true),
                playerOptions = '',
                thisVideoID = '';

            // videoid - set from data-pe- attribute or options
            if ( obj.attr('data-pe-videoid') !== undefined ) { thisVideoID = obj.attr('data-pe-videoid'); }
            else if ( options.videoID !== undefined ) { thisVideoID = options.videoID; }
            else {
                thisVideoID = undefined;
                console.error('PrettyEmbed.js Error:  Misformed or missing video ID.');
            }


            // Assemble the player options string
            // showInfo
            if ( (obj.attr('data-pe-show-info') === 'false') || (options.showInfo === false) ) { playerOptions += '&showinfo=0'; }

            // showControls
            if ( (obj.attr('data-pe-show-controls') === 'false') || (options.showControls === false) ) { playerOptions += '&controls=0'; }

            // loop
            if ( (obj.attr('data-pe-loop') === 'true') || (options.loop === true) ) { playerOptions += '&loop=1'; }

            // closed captions
            if ( (obj.attr('data-pe-closed-captions') === 'true') || (options.closedCaptions === true) ) { playerOptions += '&cc_load_policy=1'; }

            // localization
            if ( (obj.attr('data-pe-localization') !== undefined) || (options.localization !== undefined) ) {
                if ( obj.attr('data-pe-localization') !== undefined ) {
                    playerOptions += '&hl=' + obj.attr('data-pe-localization');
                }
                else if ( options.localization !== undefined ) {
                    playerOptions += '&hl=' + options.localization;
                }
            }

            // colorScheme
            if ( (obj.attr('data-pe-color-scheme') == 'light') || (options.colorScheme == 'light') ) { playerOptions += '&theme=light'; }

            // showRelated
            if ( (obj.attr('data-pe-show-related') === 'false') || (options.showRelated === false) ) { playerOptions += '&rel=0'; } else { playerOptions += '&rel=1'; }

            // allow full screen
            if ( (obj.attr('data-pe-allow-fullscreen') === 'false') || (options.allowFullScreen === false) ) { fullScreenFlag = ''; } else { fullScreenFlag = 'allowfullscreen '; }

            // Write the YouTube video iFrame into the element at the exact dimensions it is now
            obj.html('<iframe width="' + wrapperWidth + '" height="' + wrapperHeight + '" ' + fullScreenFlag + 'style="border:none;" src="//www.youtube.com/embed/' + thisVideoID + '?autoplay=1' + playerOptions + '"></iframe>')
            // Remove the YouTube 'play' button using a CSS class
                .addClass('play');

            // @Christo_edited: Remove video caption
            obj.next('.post__youtube__caption').hide();

            // If we're using FitVids, call it now
            if (options.useFitVids) {
                if ( $.isFunction($.fn.fitVids) ) {
                    obj.parent().fitVids();
                }
            }
        }



        // Helper function: get video ID from youtube URLs
        function youtube_parser(url) {
            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = url.match(regExp);
            if (match && match[7].length == 11) {
                return match[7];
            } else {
                console.error('PrettyEmbed.js Error:  Bad URL.');
            }
        }



        // Default the defaults
        $.fn.prettyEmbed.options = {
            videoID: '',
            previewSize: '',
            customPreviewImage: '',

            // Embed controls
            showInfo: true,
            showControls: true,
            loop: false,
            closedCaptions: false,

            colorScheme: 'dark',
            showRelated: false,

            // FitVids.js
            useFitVids: false
        };
    };
})(jQuery);
