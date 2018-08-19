<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Lifestone
 */
?>

<?php

$thumb     = get_post_thumbnail_id();
$imgUrl    = wp_get_attachment_url( $thumb, 'full' );
$mediaOption = get_post_meta( $post->ID, 'lifestone_post_media_option', true );

$postClass = get_post_class();
$postClass = implode( ' ', $postClass );

if(!empty($mediaOption) && $mediaOption == 'gallery'){
    $postClass .= ' post-slider';
}?>

<div id="post-<?php the_ID(); ?>" class="post-article <?php echo esc_attr( $postClass ); ?>">
    <div class="thumbnail">
        <?php if(lifestone_categories()){ ?>

            <div class="post-category">

                <?php echo lifestone_categories(); ?>

            </div>

        <?php }

        if(!empty($mediaOption) || !empty($imgUrl)){

            if($mediaOption == 'gallery') {

                $galleryImages = get_post_meta($post->ID, 'lifestone_post_media_gallery', true);

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

                $videoSourceOption = get_post_meta( $post->ID, 'lifestone_post_media_video_source_option', true);

                $videoUrl  = get_post_meta($post->ID, 'lifestone_post_media_video_source', true);

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

            <?php } elseif( !empty($imgUrl) ) {
                $imgUrl = aq_resize($imgUrl, '1099.5', '618', true, true, true); ?>

                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <img src="<?php echo esc_url($imgUrl); ?>" alt="<?php the_title(); ?>">
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

                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

            </h5>

            <?php

            if( strpos( $post->post_content, '<!--more-->' ) ) {

                /* translators: %s: Name of current post */
                the_content( sprintf(
                    __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'lifestone' ),
                    get_the_title()
                ) );

            } else {

                the_excerpt('');

            } ?>


        </div><!-- end of post-content -->

        <div class="post-footer">

            <?php if(get_comments_number() < 0){ ?>

                <ul class="post-link right">

                    <li><a href="javscript::void(0);"><i class="fa fa-comments-o"></i> <?php sprintf( _n( '%s Comment', '%s Comments', get_comments_number(), 'lifestone' ), number_format_i18n( get_comments_number() ) ); ?></a></li>

                </ul>
            <?php } ?>

            <ul class="post-link">

                <li><a href="<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d')); ?>"><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></a></li>

            </ul>
<?php posts_nav_link('—','Nota anterior','Nota siguiente'); ?>
        </div><!-- end of post-footer-->

    </div>

</div>
