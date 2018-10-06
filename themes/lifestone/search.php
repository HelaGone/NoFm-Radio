<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Lifestone
 */

get_header(); ?>

<?php if(lifestone_is_enabled('lifestone_search_banner_option')){

    $heading  = lifestone_get_option('lifestone_search_banner_heading');

    $tagline  = lifestone_get_option('lifestone_search_banner_tagline');

    $bannerBg = lifestone_get_option('lifestone_search_banner_image');

    if(!empty($bannerBg) && shortcode_exists('lifestone-backstretch-slider')) { ?>
        <?php
        $short = '[lifestone-backstretch-slider ids="'.$bannerBg.'"]';

        echo do_shortcode($short);
    } ?>

	<!--================= Start breadcrumb ==================-->
	<!-- <section id="breadcrumb-banner" class="backstretched">

		<div class="vertical-center-js">

            <?php/* if(!empty($tagline)) { ?>

			    <h5 class="category-post"><em><?php echo esc_html($tagline); ?></em></h5>

            <?php } ?>

            <?php if(!empty($heading)){ ?>

			    <h1 class="section-title "><?php echo esc_html($heading); ?></h1>

            <?php } ?>
		</div>
		<ol class="breadcrumb">

			<?php if(function_exists('bcn_display') && lifestone_is_enabled('lifestone_search_breadcrumb_option')){

				bcn_display();

			} */?>
		</ol>
	</section> -->
	<!--================= Start breadcrumb ==================-->
<?php } ?>

<?php
if ( have_posts() ) : ?>

    <section class="nopadding pattern-overlay blog-masonry alt2">
        <div class="container relative">
            <div class="row p60">
                <div id="masonry" class="masonry infinite-scroll">
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();

                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', 'search' );

                    endwhile; ?>
                </div>

                <?php

                if (function_exists('lifestone_pagination')) {

                    lifestone_pagination();

                } ?>
            </div>
        </div>
    </section>

<?php else :

    get_template_part( 'template-parts/content', 'none' );

endif;

get_footer();