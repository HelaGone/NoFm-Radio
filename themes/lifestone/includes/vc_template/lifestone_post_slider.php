<?php
// Set empty default

$atts = lifestone_set_default('no_of_post', 6, $atts);
$atts = lifestone_set_default('posts_order', 'ASC', $atts);
$atts = lifestone_set_default('category_label', 'normal', $atts);
$atts = vc_map_get_attributes( 'lifestone_post_slider', $atts );
extract($atts);


$query_args = array(
    'ignore_sticky_posts'	=> true,
    'posts_per_page'        => (int)$no_of_post,
    'meta_key'              => '_thumbnail_id',
    'cat'                   => $category,
    'order_by'              => $order_by,
    'order'                 => $posts_order
);
$the_query = new WP_Query( $query_args );

if ($the_query->have_posts()) {?>
    <section class="nopadding wh100 home-slider">

        <div class="container relative">

            <div class="row">

                <div class="col-lg-12">

                    <div class="flexslider home-slide">

                        <ul class="slides">
                        <?php
                            while($the_query->have_posts()): $the_query->the_post();

                                $featuredImageUrl = wp_get_attachment_url( get_post_thumbnail_id() );

                                $featuredImageUrl = aq_resize($featuredImageUrl, '1010', '562', true, true, true);

                                $mediaOption = get_post_meta( get_the_ID(), 'lifestone_post_media_option', true );

                                $postClass = get_post_class();

                                $postClass = implode( ' ', $postClass );

                                if(!empty($mediaOption) && $mediaOption == 'gallery'){

                                    $postClass .= ' post-slider';


                                } ?>
                                <li>

                                    <div id="post-slider-<?php the_ID(); ?>" class="post-article <?php echo esc_attr($postClass); ?>">

                                        <div class="thumbnail">

                                            <?php if(lifestone_categories()) { ?>

                                                <div class="post-category">

                                                    <?php echo ($category_label == 'colored') ? lifestone_categories_colored_label() : lifestone_categories(); ?>

                                                </div>

                                            <?php }

                                            if(!empty($mediaOption) || !empty($featuredImageUrl)){


                                                if($mediaOption == 'gallery') {

                                                    $galleryImages = get_post_meta(get_the_ID(), 'lifestone_post_media_gallery', true);

                                                    if (!empty($galleryImages)) {

                                                        $galleryImages = explode(',', $galleryImages); ?>

                                                        <div id="post" class="owl-carousel owl-theme owl-post">

                                                            <?php
                                                            foreach ($galleryImages as $galleryImage) {

                                                                $galleryImageUrl = wp_get_attachment_url($galleryImage); ?>

                                                                <div class="item"><img src="<?php echo esc_url($galleryImageUrl); ?>"
                                                                           alt="<?php the_title(); ?>"></div>

                                                            <?php
                                                            } ?>

                                                        </div><!-- end of owl-carousel-->

                                                    <?php
                                                    }
                                                } elseif($mediaOption == 'video'){

                                                    $videoSourceOption = get_post_meta( get_the_ID(), 'lifestone_post_media_video_source_option', true);

                                                    $videoUrl  = get_post_meta( get_the_ID(), 'lifestone_post_video_url', true);

                                                    if(!empty($videoUrl)) {

                                                        if ($videoSourceOption == 'youtube') {

                                                            $videoID = lifestone_youtube_id_from_url($videoUrl);

                                                            if (!empty($videoID)) { ?>
                                                                <div class="yt_container"
                                                                     data-pe-videoid="<?php echo esc_attr($videoID); ?>"
                                                                     data-pe-fitvids="true"></div>
                                                                <?php
                                                            }
                                                        } else {

                                                            $video_Id = str_replace('https://vimeo.com/', '', $videoUrl);

                                                            $videoThumbnail = lifestone_get_video_thumbnail($videoUrl);

                                                            if (!empty($video_Id)) { ?>

                                                                <img src="<?php echo esc_url($videoThumbnail); ?>"
                                                                     class="video-thumb"
                                                                     data-vimeo-id="<?php echo esc_attr($video_Id); ?>"/>

                                                                <?php
                                                            }
                                                        }
                                                    }?>

                                                <?php } elseif( !empty($featuredImageUrl) ) {?>

                                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                        <img src="<?php echo esc_url($featuredImageUrl); ?>" alt="<?php the_title(); ?>">
                                                    </a>

                                                <?php
                                                }
                                            } ?>

                                        </div>

                                        <div class="post-entry">

                                            <div class="post-content">

                                                <ul class="post-author">

                                                    <li><?php echo lifestone_author(); ?></li>

                                                </ul>

                                                <h5 class="post-title">

                                                    <a href="<?php the_permalink(); ?>"><?php echo esc_html(lifestone_truncate(get_the_title(), 50)); ?></a>

                                                </h5>

                                                <?php echo esc_html(lifestone_truncate(get_the_content(), 90)); ?>

                                            </div><!-- end of post-content-->

                                            <div class="post-footer">



                                            </div><!-- end of post-footer-->

                                        </div><!-- end of post-entry-->

                                    </div><!-- end of post-article-->

                                </li>

                            <?php endwhile; wp_reset_postdata(); ?>

                        </ul>

                    </div><!-- end of flexslider-->

                </div><!-- end of col-lg-12-->

            </div><!-- end of row -->

        </div><!--end of container -->

    </section><!-- end of section -->

<?php } ?>