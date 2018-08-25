jQuery(document).ready(function(){
	jQuery('.menu-item-has-children').on('click', function(){
		jQuery(this).find('ul.sub-menu').slideToggle("slow");
		console.log('action');
	})
});

(function($){
	"use strict";

	console.log('custom scripts here');



})();

//tunein
// https://tunein.com/radio/NoFM-Radio-s167908/