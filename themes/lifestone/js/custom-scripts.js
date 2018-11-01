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
		if(playerElement){
			playerElement.addEventListener('click', ()=>{
				let params = 'scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no, width=400,height=400,left=100,top=100';
				// open('http://nofm-radio.com/player/', 'NoFM-Radio', params);
				open('http://localhost/~cube/nofm-radio/player/', 'NoFM-Radio', params);
			});
		}
	}//END onloaf function



})();//END PLAIN JAVASCRIPT