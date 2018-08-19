<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Lifestone
 */

get_header(); ?>

<?php if(lifestone_is_enabled('lifestone_404_banner_option')){

    $heading = lifestone_get_option('lifestone_404_banner_heading');

    $tagline = lifestone_get_option('lifestone_404_banner_tagline');

    $bannerBg = lifestone_get_option('lifestone_404_banner_image');

    if(!empty($bannerBg) && shortcode_exists('lifestone-backstretch-slider')) { ?>
        <?php
        $short = '[lifestone-backstretch-slider ids="'.$bannerBg.'"]';

        echo do_shortcode($short);
    } ?>

    <!--================= Start breadcrumb ==================-->
    <section id="breadcrumb-banner" class="backstretched">

        <div class="vertical-center-js">

            <?php if(!empty($tagline)){ ?>

                <h5 class="category-post"><em><?php echo esc_html($tagline); ?></em></h5>

            <?php } ?>

            <?php if(!empty($heading)){ ?>

                <h1 class="section-title "><?php echo esc_html($heading); ?></h1>

            <?php } ?>

        </div><!-- end of vertical-center-js -->

        <?php
        if (lifestone_is_enabled('lifestone_404_breadcrumb_option') && function_exists('bcn_display')) { ?>

            <ol class="breadcrumb">

                <?php bcn_display(); ?>

            </ol>

        <?php } ?>

    </section>

<?php } ?>
    <!--================= end breadcrumb ==================-->

    <!--================= Start 404 page ==================-->
    <section class="page_404">

        <?php $content404 = lifestone_get_option('lifestone_404_breadcrumb_content');

        if(!empty($content404)){

            echo wp_filter_post_kses($content404);

        } ?>

        <?php if(function_exists('lifestone_error_page_search_form')){

            echo lifestone_error_page_search_form();

        } ?>
    </section>
    <!--================= End 404 page ==================-->

<?php get_footer();