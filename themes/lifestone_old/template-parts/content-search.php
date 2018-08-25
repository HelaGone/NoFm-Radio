<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Lifestone
 */


$thumb     = get_post_thumbnail_id();
$imgUrl    = wp_get_attachment_url( $thumb, 'full' );

$mediaOption = get_post_meta( $post->ID, 'lifestone_post_media_option', true );

$postClass = get_post_class();
$postClass = implode(' ', $postClass);

if(!empty($mediaOption) && $mediaOption == 'gallery'){

    $postClass .= ' post-slider';

}?>

<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 col-12 masonry">

	<div id="post-<?php the_ID(); ?>" class="post-article <?php echo esc_attr($postClass); ?>">

		<div class="thumbnail">

			<?php if(lifestone_categories()){?>

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

                    <?php
                    }
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

                <?php } elseif( !empty($imgUrl) ) { ?>

                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <img src="<?php echo esc_url($imgUrl); ?>" alt="<?php the_title(); ?>">
                    </a>

                <?php
                }
            } ?>

        </div><!-- end of thumbnail -->

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

                    the_content('');

                } else {

                    the_excerpt('');

                } ?>


			</div><!-- end of post-content -->

		</div><!-- end of post-entry -->

	</div><!--end of post-->

</div><!-- end of masonry -->
