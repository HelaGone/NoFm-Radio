jQuery(document).ready(function(){
	jQuery('.menu-item-has-children').on('click', function(){
		jQuery(this).find('ul.sub-menu').slideToggle("slow");
		console.log('action');
	});
});//END JQUERY

(function(){
	window.onload = function(){
		console.log('dom load');
		let playerElement = document.getElementById('playMe');
		playerElement.addEventListener('click', ()=>{
			let params = 'scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no, width=400,height=200,left=100,top=100';
			open('./nofm-radio/player/', 'NoFM-Radio', params);
		});
	}//END onloaf function



})();//END PLAIN JAVASCRIPT