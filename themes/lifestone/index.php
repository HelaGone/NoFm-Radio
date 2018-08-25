<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Lifestone
 */

get_header(); ?>

    <!--================= Start home page ==================-->
    <div id="page-content-wrapper">

        <?php
        $args = array(
            'ignore_sticky_posts'	=> true,
            'meta_key'              => '_thumbnail_id',
            'meta_query'            => array(
                array(
                    'key'       => '_thumbnail_id',
                    'compare'   => 'EXISTS'
                )
            ),
            'posts_per_page'        => 1,
        );

        $featured_posts_query = new WP_Query($args);

        if ( $featured_posts_query->have_posts() ):  ?>

            <section class="page-banner full">
                <?php
                while ( $featured_posts_query->have_posts() ) : $featured_posts_query->the_post();
                    $featuredThumb     = get_post_thumbnail_id();
                    $featuredImgUrl    = wp_get_attachment_url( $featuredThumb, 'full' ); ?>

                    <div class="overlay">
                        <?php if(!empty($featuredImgUrl)){ ?>

                            <div class="background-overlay overlay_opacity_5" style="background-image: url(<?php echo esc_url($featuredImgUrl);?>)"></div>

                        <?php } ?>

                    </div><!-- end of overlay -->

                    <div class="page-header text-center">
                        <div class="table">
                            <div class="inner">

                                <div class="page-header-content">
                                    <?php if(get_the_tags()) { ?>
                                        <?php lifestone_categories(); ?>
                                    <?php } ?>
                                    <h1 class="page-header-title"><?php the_title(); ?></h1>
                                    <span><?php echo get_the_date(); ?> <?php echo esc_html__('BY', 'lifestone'); ?> <?php the_author_posts_link(); ?></span>
                                    <a href="<?php the_permalink(); ?>" class="readmore_btn"><?php echo esc_html__('Readmore', 'lifestone'); ?></a>
                                </div><!-- end of page-header-content-->

                            </div><!-- end of inner-->

                        </div><!-- end of table -->

                    </div><!-- end of page-header -->

                <?php endwhile; wp_reset_postdata();  ?>
            </section>
            <?php
        endif; ?>

        <?php
        if ( have_posts() ) : ?>
            <section class="nopadding pattern-overlay">
                <div class="container relative">
                    <div class="row <?php echo (!lifestone_is_enabled('lifestone_blog_sidebar_option')) ? esc_attr('blog-posts-content blog-alt-2') : ''; ?>">
                        <?php if(lifestone_is_enabled('lifestone_blog_sidebar_option')){ ?>
                        <div class="col-md-8">
                            <div class="row blog-posts-content blog-alt-2">
                                <div class="col-lg-12">

                                    <?php } else {?>
                                    <div class="col-lg-10 col-lg-offset-1">
                                        <?php } ?>

                                        <?php

                                        /* Start the Loop */
                                        while ( have_posts() ) : the_post();

                                            /*
                                             * Include the Post-Format-specific template for the content.
                                             * If you want to override this in a child theme, then include a file
                                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                             */
                                            get_template_part( 'template-parts/content', get_post_format() );


                                        endwhile; wp_reset_postdata();

                                        ?>

                                        <div class="pagination clear">
                                            <?php

                                            $args = array(
                                                'prev_text'          => '<i class="fa fa-angle-left"></i>',
                                                'next_text'          => '<i class="fa fa-angle-right"></i>',
                                            );

                                            echo paginate_links( $args );

                                            ?>

                                        </div><!-- end of pagination clear -->

                                        <?php if(lifestone_is_enabled('lifestone_blog_sidebar_option')){ ?>
                                    </div><!-- end of col-lg -->
                                </div><!-- end of row  blog posts-->

                                <?php } ?>
                            </div><!-- end of col-md-8 -->
                            <?php if(lifestone_is_enabled('lifestone_blog_sidebar_option')) {
                                get_sidebar();
                            }?>
                        </div><!-- end of row -->
                    </div><!-- end of container relative -->
            </section><!-- end of section -->

            <?php
        else :

            get_template_part( 'template-parts/content', 'none' );

        endif; ?>
    </div><!-- end of page-content-wrapper -->

<?php get_footer();