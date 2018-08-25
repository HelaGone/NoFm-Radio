/*
 lifestone-backstretch.js
 Author: Prajwal Shrestha - https://np.linkedin.com/in/prajwalstha
 Git: https://github.com/prajwalstha123
 */

jQuery(document).ready(function($){
    "use strict";

    var images = lifestoneSliders.sliderImages.split(', ');

    $("#breadcrumb-banner.backstretched").backstretch(images, {
        duration: 6000,
        fade: 1200
    });

});