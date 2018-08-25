<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Lifestone
 */

get_header();

if(lifestone_is_enabled_meta('lifestone_page_banner_option')) {

    $heading  = get_post_meta($post->ID, 'lifestone_page_banner_heading', true);

    $tagline  = get_post_meta($post->ID, 'lifestone_page_banner_tagline', true);

    $bannerBg = get_post_meta($post->ID, 'lifestone_page_banner_image', true);

    if(!empty($bannerBg) && shortcode_exists('lifestone-backstretch-slider')) { ?>

        <?php
        $short = '[lifestone-backstretch-slider ids="'.$bannerBg.'"]';

        echo do_shortcode($short);
    } ?>

    <!--================= Start breadcrumb ==================-->
    <section id="breadcrumb-banner" class="backstretched">

        <div class="vertical-center-js">

            <?php if(!empty($heading)){  ?>

                <h1 class="section-title "><?php echo esc_html($heading); ?></h1>

            <?php } ?>

            <?php if(!empty($tagline)){ ?>

                <h2 class="section-sub-title"><?php echo esc_html($tagline); ?></h2>

            <?php } ?>

        </div>
        <?php if(function_exists('bcn_display') && lifestone_is_enabled_meta('lifestone_page_breadcrumb_option')) { ?>

            <ol class="breadcrumb">

                <?php bcn_display(); ?>

            </ol>

        <?php } ?>

    </section>
<?php }

while ( have_posts() ) : the_post();

    get_template_part( 'template-parts/content', 'page' );

endwhile; ?>

<?php get_footer();