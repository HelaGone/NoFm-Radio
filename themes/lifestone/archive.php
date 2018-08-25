<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Lifestone
 */

get_header(); ?>
<?php

if(lifestone_is_enabled('lifestone_archive_banner_option') || lifestone_is_enabled('lifestone_archive_cat_image_option')) {

    if (lifestone_is_enabled('lifestone_archive_banner_option')) {

        $heading = lifestone_get_option('lifestone_archive_banner_heading');

        $tagline = lifestone_get_option('lifestone_archive_banner_tagline');

        $bannerBg = lifestone_get_option('lifestone_archive_banner_image');

        if(!empty($bannerBg) && shortcode_exists('lifestone-backstretch-slider')) { ?>
            <?php
            $short = '[lifestone-backstretch-slider ids="'.$bannerBg.'"]';

            echo do_shortcode($short);
        }

    } else {

        $heading = '';

        $tagline = '';

        $output = '';

        if (lifestone_is_enabled('lifestone_archive_cat_title_option')) {

            $heading = get_the_archive_title();

            $tagline = get_the_archive_description();
        }

        if (function_exists('z_taxonomy_image_url') && is_category() || is_tag()) {

            $bannerBg = aq_resize(z_taxonomy_image_url(), '1280', '390', true, true, true);


            if (!empty($bannerBg)) { ?>

                <style>
                    #breadcrumb-banner {

                        background-image:url(<?php echo esc_url($bannerBg); ?>);

                    }

                </style>

            <?php
            }
        }
    } ?>

    <!--================= Start breadcrumb ==================-->
    <section id="breadcrumb-banner" class="backstretched">

        <div class="vertical-center-js">

            <?php if (!empty($heading)) { ?>

                <h1 class="section-title"><?php echo esc_html($heading); ?></h1>

            <?php } ?>

            <?php if (!empty($tagline)) { ?>

                <h5 class="category-post"><em><?php echo esc_html($tagline); ?></em></h5>

            <?php } ?>
        </div>

        <ol class="breadcrumb">
            <?php if (function_exists('bcn_display')) {
                bcn_display();
            } ?>
        </ol>
    </section>

    <!--================= End breadcrumb ==================-->
<?php }?>

    <section class="nopadding pattern-overlay blog-masonry">
        <div class="container relative">
            <div class="row p60">
                <div id="masonry" class="masonry infinite-scroll">

                    <?php
                    if ( have_posts() ) { ?>


                        <?php
                        /* Start the Loop */
                        while (have_posts()) : the_post();

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part('template-parts/content', 'search');

                        endwhile;
                        if (function_exists('lifestone_pagination')) {

                            lifestone_pagination(lifestone_max_num_pages());

                        }


                    } else {

                        get_template_part('template-parts/content', 'none');

                    } ?>
                </div><!-- end of masonry -->
            </div><!-- end of row -->
        </div><!-- end of container -->
    </section><!-- end of section -->
<?php get_footer();