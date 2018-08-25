<?php
// Set empty default

$atts = lifestone_set_default('no_of_post', 6, $atts);
$atts = lifestone_set_default('posts_order', 'ASC', $atts);
$atts = vc_map_get_attributes( 'lifestone_full_page_post_slider', $atts );

extract($atts);

$query_args = array(
    'ignore_sticky_posts'	=> true,
    'posts_per_page'        => (int)$no_of_post,
    'meta_key'              => '_thumbnail_id',
    'cat'                   => $category,
    'order'                 => $posts_order
);
$the_query = new WP_Query( $query_args );

if ($the_query->have_posts()) {?>

    <div id="page-content-wrapper-2" class="main-wrap alt1">

        <?php
        while ($the_query->have_posts()): $the_query->the_post();
            $featuredImageUrl = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
            <div class="section page-home page page-cent">
                <div class="post-image full">
                    <div class="overlay">
                        <div class="background-overlay overlay_opacity_5" style="background-image: url(<?php echo esc_url($featuredImageUrl); ?>)"></div>
                    </div>
                    <div class="post-article">
                        <div class="post-entry">
                            <div class="post-content">
                                <h5 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h5>
                            </div>
                            <div class="post-footer">
                                <ul class="post-link">
                                    <li><?php the_author_posts_link(); ?></li>
                                    <li><a href="<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d')); ?>">
                                            <i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?>
                                        </a>
                                    </li>
                                    <?php
                                    if(get_comments_number() < 0){ ?>
                                        <li><a href="javscript::void(0);"><i class="fa fa-comments-o"></i> <?php sprintf( _n( '%s Comment', '%s Comments', get_comments_number(), 'lifestone' ), number_format_i18n( get_comments_number() ) ); ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div><!-- post-footer -->

                            <a href="<?php the_permalink(); ?>" class="readmore_btn"><?php echo esc_html__('Leer', 'lifestone'); ?></a>

                        </div><!-- post-entry -->

                    </div><!-- post article -->

                </div><!--post image full -->

            </div><!-- end of section page-home page page-cent -->

        <?php endwhile; ?>

    </div>
<?php
}