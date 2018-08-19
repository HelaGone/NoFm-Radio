<?php
$heading = $tagline = $css = $slider_images = '';
$atts = vc_map_get_attributes( 'lifestone_breadcrumb', $atts );

extract( $atts );

if(!empty($slider_images) && shortcode_exists('lifestone-backstretch-slider')) { ?>

    <?php
    $short = '[lifestone-backstretch-slider ids="'.$slider_images.'"]';

    echo do_shortcode($short);
} ?>
<section id="breadcrumb-banner" class="backstretched">
    <div class="vertical-center-js">
        <?php if(!empty($heading)){ ?>
            <h1 class="section-title "><?php echo esc_html($heading); ?></h1>
        <?php }
        if(!empty($tagline)){ ?>

            <h2 class="section-sub-title"><?php echo esc_html($tagline); ?></h2>

        <?php } ?>
    </div>
    <?php if(function_exists('bcn_display')) { ?>

        <ol class="breadcrumb">

            <?php bcn_display(); ?>

        </ol>

    <?php } ?>
</section><!-- end of section -->