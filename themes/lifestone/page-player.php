<?php 
	get_header('player'); 
	/*
	 * Template name: El Player
	*/ 
	?>

	<script type="text/javascript">
		setInterval(function(){
		   fetch('http://localhost/~cube/nofm-radio/voscast_title/voscast.php')
		    .then(response => {
		     if(response.status !== 200){
		      console.log('bad response');
		     }
		     response.text().then(data => {
		     	var title = document.getElementById('title_here');
		     	title.innerHTML = data;
		      console.log(title);
		     });
		    })
		    .catch(err => {
		     console.log(err);
		    });
		  }, 5000);
	</script>
	<section class="player_container">
		<h2 style="color:red; margin-top:0px; font-weight: bold;font-family: sans-serif; ">NoFM<br><span style="color:#fff; font-size:70%;">TODO MENOS MIEDO</span></h2>
		<audio controls class="player" autoplay>
		    <source src="http://s2.voscast.com:8162/;&type=mp3" type="audio/mpeg">
		</audio>
		<div class="track_name">
			<p style="color:#fff;" id="title_here">
				<?php 
					// if($the_title){
					// 	echo $the_title;
					// }
					?>
			</p>
		</div>
	</section>

<?php get_footer('player'); ?>