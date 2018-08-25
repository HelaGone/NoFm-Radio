<?php
// Set empty default

$is_tab = $is_load_more = '';

$atts = lifestone_set_default('no_of_post', 6, $atts);

$atts = lifestone_set_default('posts_order', 'ASC', $atts);

$atts = lifestone_set_default('category_label', 'normal', $atts);

$atts = vc_map_get_attributes( 'lifestone_posts', $atts );

extract($atts);


$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$query_args = array(
    'ignore_sticky_posts'	=> true,
    'posts_per_page'        => (int)$no_of_post,
    'cat'                   => $category,
    'order_by'              => $order_by,
    'order'                 => $posts_order,
    'paged'                 =>  $paged,
);

$the_query = new WP_Query( $query_args );


if ($the_query->have_posts()) {?>

    <section class="nopadding pattern-overlay blog-masonry <?php echo ((!empty($is_tab) && $is_tab == 'on')) ? esc_attr('blog-alt-1'): ''; ?>">

        <div class="container relative">

            <?php
            if((!empty($is_tab) && $is_tab == 'on')){?>

                <div class="row">

                    <div class="filters text-uppercase text-center">

                        <?php lifestone_categories_tabs(); ?>

                    </div><!-- end of filters -->

                </div><!-- end of row-->

            <?php } ?>

            <div class="row p60">

                <div id="masonry" class="masonry infinite-scroll">

                    <?php
                    while ($the_query->have_posts()): $the_query->the_post();

                        $featuredImageUrl = wp_get_attachment_url( get_post_thumbnail_id() );

                        $mediaOption = get_post_meta( get_the_ID(), 'lifestone_post_media_option', true );

                        $postClass = get_post_class();

                        $postClass = implode( ' ', $postClass );

                        if(!empty($mediaOption) && $mediaOption == 'gallery'){

                            $postClass .= ' post-slider';

                        }

                        $postCategories = get_the_category();

                        if(!empty($postCategories)){
                            $output = '';

                            foreach ($postCategories as $category) {

                                $output .= $category->slug . ' ';

                            }
                        }?>

                        <div id="post-<?php the_ID(); ?>" class="col-lg-4 col-md-6 col-sm-6 col-xs-6 col-12 masonry <?php echo esc_attr($output); ?>">

                            <div class="post-article <?php echo esc_attr($postClass); ?>">

                                <div class="thumbnail">

                                    <?php if(lifestone_categories()){ ?>

                                        <div class="post-category">

                                            <?php echo ($category_label == 'normal') ? lifestone_categories() :  lifestone_categories_colored_label(); ?>

                                        </div>

                                    <?php }

                                    if(!empty($mediaOption) || !empty($featuredImageUrl)){

                                        if($mediaOption == 'gallery') {

                                            $galleryImages = get_post_meta(get_the_ID(), 'lifestone_post_media_gallery', true);

                                            if (!empty($galleryImages)) {

                                                $galleryImages = explode(',', $galleryImages); ?>

                                                <div id="post" class="owl-carousel owl-theme owl-post">

                                                    <?php foreach ($galleryImages as $galleryImage) {

                                                        $galleryImageUrl = wp_get_attachment_url($galleryImage); ?>

                                                        <div class="item"><img src="<?php echo esc_url($galleryImageUrl); ?>"
                                                                               alt="<?php the_title(); ?>"></div>

                                                    <?php } ?>

                                                </div><!-- end of owl-carousel-->

                                            <?php }
                                        } elseif($mediaOption == 'video'){

                                            $videoSourceOption = get_post_meta( get_the_ID(), 'lifestone_post_media_video_source_option', true);

                                            $videoUrl  = get_post_meta( get_the_ID(), 'lifestone_post_media_video_source', true);

                                            if(!empty($videoUrl)){

                                                if($videoSourceOption == 'youtube') {

                                                    $videoID = lifestone_youtube_id_from_url($videoUrl);

                                                    if (!empty($videoID)) { ?>
                                                        <div class="yt_container" data-pe-videoid="<?php echo esc_attr($videoID); ?>"
                                                             data-pe-fitvids="true"></div>
                                                        <?php
                                                    }

                                                } else {

                                                    $video_Id = str_replace('https://vimeo.com/','', $videoUrl);

                                                    $videoThumbnail = lifestone_get_video_thumbnail($videoUrl);

                                                    if(!empty($video_Id)) { ?>

                                                        <img src="<?php echo esc_url($videoThumbnail); ?>" class="video-thumb"
                                                             data-vimeo-id="<?php echo esc_attr($video_Id); ?>"/>

                                                        <?php
                                                    }
                                                }

                                            }?>

                                        <?php } elseif( !empty($featuredImageUrl) ) { ?>

                                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                <img src="<?php echo esc_url($featuredImageUrl); ?>" alt="<?php the_title(); ?>">
                                            </a>

                                            <?php
                                        }
                                    } ?>

                                </div><!-- end of thumbnail-->

                                <div class="post-entry">

                                    <div class="post-content">

                                        <ul class="post-author">

                                            <li><?php echo lifestone_author(); ?></li>

                                        </ul>

                                        <h5 class="post-title">

                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

                                        </h5>

                                    </div><!-- end of post-content -->

                                </div><!-- end of post-entry-->

                            </div><!-- end of post-article -->

                        </div><!-- end of col -->

                    <?php endwhile; wp_reset_postdata(); ?>

                </div> <!-- end of masonry -->

            </div><!--end of row -->

        </div><!-- end of container -->

    </section><!-- end of section -->
<?php } ?>


