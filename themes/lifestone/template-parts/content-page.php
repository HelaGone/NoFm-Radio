<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Lifestone
 */

?>
<?php

$thumb     = get_post_thumbnail_id();

$imgUrl    = wp_get_attachment_url( $thumb, 'full' );

$postClass = get_post_class();

$postClass = implode(' ', $postClass); ?>

<section id="page-<?php the_ID(); ?>" class="nopadding <?php echo esc_attr($postClass); ?>">

    <div class="post-type-blog single">

        <div class="container relative">

            <div class="row">

                <?php
                if(lifestone_is_enabled_meta('lifestone_page_sidebar_option')){ ?>

                    <div class="col-md-8">

                <?php } else { ?>

                    <div class="col-md-10 col-md-offset-1">

                <?php } ?>

                        <div class="post-article">

                            <div class="post-entry">

                                <?php if(!empty($imgUrl)){ ?>

                                    <div class="thumbnail">

                                        <img src="<?php echo esc_url($imgUrl); ?>" alt="<?php the_title(); ?>">

                                    </div>

                                <?php } ?>

                                <div class="post-content">

                                    <h2 class="post-title"><?php the_title(); ?></h2>

                                    <?php the_content();

                                    wp_link_pages( array(
                                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lifestone' ),
                                        'after'  => '</div>',
                                    ) );?>

                                </div><!-- end of post-content -->

                            </div><!-- end of post-entry -->

                        </div><!-- end post-article -->

                        <?php if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        } ?>

                    </div> <!-- end of col -->
                    <?php
                    if(lifestone_is_enabled_meta('lifestone_page_sidebar_option')){

                        get_sidebar();
                    } ?>

            </div><!-- end of row-->

        </div><!-- end of container -->

    </div><!-- end of post-type-blog -->

</section> <!-- end of section -->
