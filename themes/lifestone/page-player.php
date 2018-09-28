<?php 
	get_header('player'); 
	/*
	 * Template name: El Player
	*/
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://s2.voscast.com:8162/7.html");
	curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	$data = curl_exec($ch);
	curl_close($ch);

	$data = str_replace('</body></html>', "", $data);
	$split = explode(',', $data); 

	$artist_name = '';
	$album_name = '';
	$track_name = '';

	if (empty($split[6])) { 
		$title = "The current song is not available "; 
	} else {
		//print_r($split);
		$fullTitle = $split[6];
		$splited = explode(' - ', $fullTitle);
	}
?>
	<section class="player_container">
		<h2 style="color:red; margin-top:0px; font-weight: bold;font-family: sans-serif; ">No FM</h2>
		<audio controls class="player" autoplay>
		    <source src="http://s2.voscast.com:8162/;&type=mp3" type="audio/mpeg">
		</audio>
		<div class="track_name">
			<p style="color:#fff;">
				<?php 
					if(count($splited) >= 3):
						$artist_name = $splited[0];
						$album_name = $splited[1];
						$track_name = $splited[2];
						echo $artist_name.' '.$album_name.' '.$track_name;
					else:
						$artist_name = $splited[0];
						echo $artist_name;
					endif;
					?>
			</p>
		</div>
	</section>

<?php get_footer('player'); ?>