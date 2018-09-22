<?php
$atts = vc_map_get_attributes( 'lifestone_featured_post_banner', $atts );
extract($atts);

$args = array(
    'ignore_sticky_posts'	=> true,
    'meta_key' => '_thumbnail_id',
    'meta_query' => array(
        array(
            'key'              => '_thumbnail_id',
            'compare'          => 'EXISTS'
        )
    ),
    'posts_per_page'        => 1,
);

$featured_posts_query = new WP_Query($args);

if ( $featured_posts_query->have_posts() ):  ?>
    <section class="page-banner full">
        <?php
        while ( $featured_posts_query->have_posts() ) : $featured_posts_query->the_post();

            $featuredImgUrl    = wp_get_attachment_url( get_post_thumbnail_id(), 'full' ); ?>

            <div class="overlay">
                <?php if(!empty($featuredImgUrl)){ ?>
                    <div class="background-overlay overlay_opacity_5" style="background-image: url(<?php echo esc_url($featuredImgUrl);?>)"></div>
                <?php } ?>
            </div>
            <div class="page-header text-center">

                <div class="table">

                    <div class="inner">

                        <div class="page-header-content">

                            <?php if(get_the_tags()) { ?>
                                <?php lifestone_categories(); ?>
                            <?php } ?>

                            <h1 class="page-header-title"><?php the_title(); ?></h1>

                            <span><?php echo get_the_date(); ?> <?php echo esc_html__('BY', 'lifestone'); ?> <?php the_author_posts_link(); ?></span>
                            <?php if(!empty($readmore) && $readmore == 'on'){ ?>

                                <a href="<?php the_permalink(); ?>" class="readmore_btn"><?php echo esc_html__('Leer', 'lifestone'); ?></a>

                            <?php } ?>

                        </div><!-- end of page-header-content -->

                    </div><!-- end of inner -->

                </div><!-- end of table -->

            </div><!-- end of page-header -->
        <?php endwhile; wp_reset_postdata();  ?>
    </section>
<?php
endif; ?>