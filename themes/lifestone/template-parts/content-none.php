<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Lifestone
 */

?>

<section class="page_404">
	<h4><?php esc_html_e( 'Nothing Found', 'lifestone' ); ?></h4>

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'lifestone' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php } elseif ( is_search() ) { ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'lifestone' ); ?></p>
			<?php if(function_exists('lifestone_error_page_search_form')){
				echo lifestone_error_page_search_form();
			} ?>

		<?php }else{ ?>

			<p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lifestone'); ?></p>
			<?php if(function_exists('lifestone_error_page_search_form')){
				echo lifestone_error_page_search_form();
			} ?>

		<?php } ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
