<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Lifestone
 */

get_header(); ?>
    <!--================= Start home page ==================-->
    <div id="page-content-wrapper">

        <?php
        $bannerOption = lifestone_get_option('lifestone_single_banner_option', 'off');

        if('off' != $bannerOption){

            $heading = lifestone_get_option('lifestone_single_banner_heading');

            $tagline = lifestone_get_option('lifestone_single_banner_tagline');

            $bannerBg = lifestone_get_option('lifestone_single_banner_image');

            if(!empty($bannerBg) && shortcode_exists('lifestone-backstretch-slider')) {

                $short = '[lifestone-backstretch-slider ids="'.$bannerBg.'"]';

                echo do_shortcode($short);

            } ?>

            <section id="breadcrumb-banner" class="backstretched">

                <div class="vertical-center-js">

                    <?php if(!empty($heading)){ ?>

                        <h1 class="section-title "><?php echo esc_html($heading); ?></h1>

                    <?php } ?>

                    <?php if(!empty($tagline)){ ?>

                        <h2 class="section-sub-title"><?php echo esc_html($tagline); ?></h2>

                    <?php } ?>
                </div>
                <?php

                if (function_exists('bcn_display') && lifestone_is_enabled('lifestone_single_breadcrumb_option')) { ?>

                    <ol class="breadcrumb">

                        <?php bcn_display(); ?>

                    </ol>

                <?php } ?>
            </section>
        <?php } ?>
        <!--================= End breadcrumb ==================-->
        <?php
        while ( have_posts() ) : the_post(); ?>
            <section>

                <div class="post-type-blog single <?php echo (lifestone_is_enabled('lifestone_single_sidebar_option')) ? esc_attr('alt2') : ''; ?>">

                    <div class="container relative">

                        <div class="row">
                            <?php if(lifestone_is_enabled('lifestone_single_sidebar_option')){ ?>
                            <div class="col-md-8">
                                <?php } else { ?>

                                <div class="col-md-10 col-md-offset-1">
                                    <?php } ?>
                                    <?php get_template_part( 'template-parts/content', 'single' ); ?>

                                    <?php


                                    // If comments are open or we have at least one comment, load up the comment template.
                                    if ( comments_open() || get_comments_number() ) {
                                        comments_template();
                                    } ?>
                                </div> <!-- end of col-md-10 -->

                                <?php
                                $sidebarOption = lifestone_get_option('lifestone_single_sidebar_option', 'off');
                                if($sidebarOption == 'on'){

                                    get_sidebar();

                                } ?>

                            </div><!--end of row -->

                        </div><!-- end of container-realtive -->

                    </div><!-- end of post-type-blog -->

            </section>

        <?php endwhile; ?>

    </div><!-- end of page-content-wrapper -->
<?php get_footer();