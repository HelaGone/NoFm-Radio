<?php
$thumb     = get_post_thumbnail_id();
$imgUrl    = wp_get_attachment_url( $thumb, 'full' );
$mediaOption = get_post_meta( $post->ID, 'lifestone_post_media_option', true );
$postClass = get_post_class();
array_push($postClass, 'no-box-shadow', 'post-article');
if(!empty($mediaOption) && $mediaOption == 'gallery'){
    $postClass .= ' post-slider';
} ?>
    <div id="post-<?php the_ID(); ?>" <?php if(is_single()){ post_class($postClass); } ?> >
        <div class="post-entry">
            <div class="thumbnail">
                <?php 
                    if(lifestone_categories()){?>
                        <div class="post-category">
                        <?php echo lifestone_categories(); ?>
                        </div>
                <?php 
                    }

                if(!empty($mediaOption) || !empty($imgUrl)){
                    if($mediaOption == 'gallery') {
                        $galleryImages = get_post_meta($post->ID, 'lifestone_post_media_gallery', true);
                        if (!empty($galleryImages)) {
                            $galleryImages = explode(',', $galleryImages); ?>
                            <div id="post" class="owl-carousel owl-theme owl-post">
                                <?php 
                                    foreach ($galleryImages as $galleryImage) {
                                        $galleryImageUrl = wp_get_attachment_url($galleryImage); ?>
                                        <div class="item">
                                            <img src="<?php echo esc_url($galleryImageUrl); ?>" alt="<?php the_title(); ?>">
                                        </div>
                                <?php 
                                    } ?>
                            </div><!-- end of owl-carousel-->
                        <?php }
                    } elseif($mediaOption == 'video'){
                        $videoSourceOption = get_post_meta( $post->ID, 'lifestone_post_media_video_source_option', true);
                        $videoUrl  = get_post_meta($post->ID, 'lifestone_post_media_video_source', true);
                        if(!empty($videoUrl)):
                            if($videoSourceOption == 'youtube'):
                                $videoID = lifestone_youtube_id_from_url($videoUrl);
                                if (!empty($videoID)): ?>
                                    <div class="yt_container" data-pe-videoid="<?php echo esc_attr($videoID); ?>" data-pe-fitvids="true"></div>
                            <?php
                                endif;
                            else:
                                $video_Id = str_replace('https://vimeo.com/','', $videoUrl);
                                $videoThumbnail = lifestone_get_video_thumbnail($videoUrl);
                                if(!empty($video_Id)): ?>
                                    <img src="<?php echo esc_url($videoThumbnail); ?>" class="video-thumb" data-vimeo-id="<?php echo esc_attr($video_Id); ?>"/>
                                    <?php
                                endif;
                            endif;
                        endif;    

                    } elseif(!empty($imgUrl)) {
                        $imgUrl = aq_resize($imgUrl, '1099.5', '618', true, true, true); ?>
                        <img src="<?php echo esc_url($imgUrl); ?>" alt="<?php the_title(); ?>">
                    <?php 
                    }
                } ?>
            </div><!-- end of thumbnail -->

            <div class="post-content">
                <ul class="post-author">
                    <li><?php echo lifestone_author(); ?></li>
                    <li>
                        <a href="<?php echo get_day_link( get_the_time('Y'), get_the_time('m'), get_the_time('d')); ?>">
                            <i class="fa fa-clock-o"></i> 
                            <?php echo get_the_date(); ?>
                        </a>
                    </li>
                    <?php 
                        if(get_comments_number() > 0): ?>
                            <li><a href="javscript::void(0);">
                                <i class="fa fa-comments-o"></i>
                                <?php 
                                    sprintf( _n( '%s Comment', '%s Comments', get_comments_number(), 'lifestone' ), number_format_i18n( get_comments_number() ) ); 
                                    ?>
                                </a>
                            </li>
                    <?php 
                        endif; ?>
                </ul>

                <h2 class="post-title">
                    <?php the_title(); ?>
                </h2>
                <?php 
                    the_content();
                    // wp_link_pages( 'before=<div class="page-links">&after=</div>&link_before=<span class="page-link">&link_after=</span>' ); 
                    ?>
            </div><!-- end of post-content -->

            <div class="post-footer">
                <?php 
                    if(lifestone_tags()): ?>
                        <div class="post-tag">
                            <h5>
                                <?php echo esc_html__('Tags:', 'lifestone'); ?>
                            </h5>
                            <?php echo lifestone_tags(); ?>
                        </div>
                <?php
                    endif; ?>

                    <div id="cooler-nav" class="navigation">
                        <?php 
                        $prevPost = get_previous_post(true);
                        if($prevPost){ ?>
                            <div class="nav-box previous">
                                <?php $prevthumbnail = get_the_post_thumbnail($prevPost->ID, array(100,100) );?>
                                <?php previous_post_link('%link',"$prevthumbnail  <p>%title</p>", TRUE); ?>
                            </div>
                        <?php 
                        } 

                        $nextPost = get_next_post(true);
                        if($nextPost) { ?>
                            <div class="nav-box next" style="float:right;">
                                <?php 
                                $nextthumbnail = get_the_post_thumbnail($nextPost->ID, array(100,100)); 
                                next_post_link('%link',"$nextthumbnail  <p>%title</p>", TRUE); 
                                ?>
                            </div>
                        <?php 
                        } ?>
                    </div><!--#cooler-nav div -->

                    <!--previous_post_link('&lt; %link', '%title');  
                    echo ' | ';
                    next_post_link('%link &gt;', '%title');-->
                <?php
                $postShareOption = lifestone_get_option('lifestone_single_post_share_option', 'on');
                if($postShareOption == 'on' && lifestone_is_package_activated()){ ?>

                    <div class="post-share">
                        <!--
                        <div class="share">
                            <?php
                                $url = get_permalink();
                                $lifestoneSocialShares = new LifestoneshareCount($url);
                                if(lifestone_is_enabled('lifestone_single_post_share_facebook_option')):
                                    $link = lifestone_get_post_share_url( 'facebook' );
                                    $noOfShare = $lifestoneSocialShares->lifestone_get_fb_count(); ?>
                                    <a href="<?php echo esc_url($link); ?>" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    <?php 
                                        if(!empty($noOfShare)): ?>
                                            <span class="count"><?php echo esc_html($noOfShare); ?></span>
                                    <?php 
                                        endif; ?>
                                    </a>
                            <?php 
                                endif;

                                if(lifestone_is_enabled('lifestone_single_post_share_twitter_option')):
                                    $link = lifestone_get_post_share_url('twitter'); ?>
                                    <a href="<?php echo esc_url($link); ?>" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                            <?php  
                                endif; 

                                if(lifestone_is_enabled('lifestone_single_post_share_google_option')):
                                    $link = lifestone_get_post_share_url('google-plus');
                                    $noOfShare = $lifestoneSocialShares->lifestone_get_plusones_count(); ?>
                                    <a href="<?php echo esc_url($link); ?>" target="_blank">
                                        <i class="fa fa-google-plus"></i>
                                    <?php 
                                        if(!empty($noOfShare)){ ?>
                                            <span class="count"><?php echo esc_html($noOfShare); ?></span>
                                    <?php 
                                        } ?>
                                    </a>

                            <?php 
                                endif; 

                                if(lifestone_is_enabled('lifestone_single_post_share_linkedin_option')):
                                    $link = lifestone_get_post_share_url('linkedin');
                                    $noOfShare = $lifestoneSocialShares->lifestone_get_linkedin_count(); ?>
                                    <a href="<?php echo esc_url($link); ?>" target="_blank">
                                        <i class="fa fa-linkedin-square"></i>
                                    <?php 
                                        if(!empty($noOfShare)): ?>
                                            <span class="count"><?php echo esc_html($noOfShare); ?></span>
                                    <?php 
                                        endif; ?>
                                    </a>

                            <?php 
                                endif; ?>
                        </div> end of share -->
                    </div><!--end of post-share -->
                <?php 
                    } ?>
            </div><!-- end of post-footer -->
        </div><!-- end of post-entry -->
    </div><!-- end of post-article -->

<?php 
    if(lifestone_author_info_box()){ ?>
        <div class="post-author-details">
            <div class="author-content">
            <?php echo lifestone_author_info_box(); ?>
            </div>
        </div> <!-- end of post-author-details -->
<?php 
    }