<?php
/**
 * Template Name: VC Page
 */

get_header();?>
<?php
if(wp_is_mobile()): ?>
	<div class="mobile_logo_header">
		<img src="http://nofm-radio.com/wp-content/uploads/2018/10/logo_nofm_2.png">
	</div>
	<?php
endif;
if(have_posts()){
	while(have_posts()){
		the_post();
		the_content();
	}
} wp_reset_postdata();
get_footer();