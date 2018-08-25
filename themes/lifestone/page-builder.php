<?php
/**
 * Template Name: VC Page
 */

get_header();?>

<?php
if(have_posts()){
	while(have_posts()){
		the_post();
		the_content();
	}
} wp_reset_postdata();
get_footer();