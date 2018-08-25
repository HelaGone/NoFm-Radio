<?php
/**
 * Lifestone functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Lifestone
 */

if ( ! function_exists( 'lifestone_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    /**
     *
     */
    function lifestone_setup() {


        /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Lifestone, use a find and replace
		 * to change 'lifestone' to the name of your theme in all the template files.
		 */
        load_theme_textdomain( 'lifestone', get_template_directory() . '/languages' );

        /**
         * Force Visual Composer to initialize
         */
        if(class_exists('Vc_Manager')) {

            vc_disable_frontend();

            // change vc template directory
            vc_set_shortcodes_templates_dir( get_template_directory(). '/includes/vc_template' );

            function lifestone_extend_composer() {
                // Includes All vc-content-element files
                require_once get_template_directory() . '/includes/vc_element/vc_row.php';
                require_once get_template_directory() . '/includes/vc_element/vc_row_inner.php';
                require_once get_template_directory() . '/includes/vc_element/lifestone_breadcrumb.php';
                require_once get_template_directory() . '/includes/vc_element/lifestone_contact_info.php';
                require_once get_template_directory() . '/includes/vc_element/lifestone_full_page_post_slider.php';
                require_once get_template_directory() . '/includes/vc_element/lifestone_map.php';
                require_once get_template_directory() . '/includes/vc_element/lifestone_post_slider.php';
                require_once get_template_directory() . '/includes/vc_element/lifestone_posts.php';
                require_once get_template_directory() . '/includes/vc_element/lifestone_featured_post_banner.php';
            }

            add_action('init', 'lifestone_extend_composer', 20);

        }

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support( 'title-tag' );

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support( 'post-thumbnails' );

        /*
		 * Enable support for custom logo.
		 *
		 */
        add_theme_support( 'custom-logo');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => esc_html__( 'Lifestone Menu', 'lifestone' ),
        ) );

        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'lifestone_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        if(!function_exists('lifestone_remove_customizer_settings')) {

            function lifestone_remove_customizer_settings($wp_customize)
            {
                $wp_customize->remove_section('colors');
                $wp_customize->remove_section('background_image');
                $wp_customize->remove_section('header_image');
            }

            add_action('customize_register', 'lifestone_remove_customizer_settings', 20);

        }
    }
endif;
add_action( 'after_setup_theme', 'lifestone_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lifestone_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'lifestone_content_width', 640 );
}
add_action( 'after_setup_theme', 'lifestone_content_width', 0 );


if(!function_exists('lifestone_widgets_init')) {
    /**
     * Register widget area.
     *
     * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
     */
    function lifestone_widgets_init()
    {
        register_sidebar(array(
            'name' => esc_html__('Sidebar', 'lifestone'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'lifestone'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h5 class="title">',
            'after_title' => '</h5>',
        ));
    }

    add_action('widgets_init', 'lifestone_widgets_init');
}

if(!function_exists('lifestone_pagination')) {

    /**
     * @param string $pages
     * @param int $range
     */
    function lifestone_pagination($pages = '', $range = 4)
    {
        $showitems = ($range * 2) + 1;
        global $paged;
        if (empty($paged)) {
            $paged = 1;
        }
        if ($pages == '') {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if (!$pages) {
                $pages = 1;
            }
        }

        if (1 != $pages) {
            echo "<div class='pagination clear col-md-12'>";
            if ($paged > 1 && $showitems < $pages) echo "<a href='" . get_pagenum_link($paged - 1) . "'><i class='fa fa-angle-left'></i></a></li>";

            for ($i = 1; $i <= $pages; $i++) {
                if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                    echo ($paged == $i) ? "<span class='page-numbers current'>" . $i . "</span>" : "<a href='" . get_pagenum_link($i) . "'>" . esc_html($i) . "</a>";
                }
            }

            if ($paged < $pages && $showitems < $pages) echo "<a href='" . get_pagenum_link($paged + 1) . "'><i class='fa fa-angle-right'></i></a>";
            echo "</div>\n";
        }
    }
}


if(!function_exists('lifestone_shape_comment')) {
    /**
     * @param $comment
     * @param $args
     * @param $depth
     */
    function lifestone_shape_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                ?>
                <li class="post pingback">
                <p><?php esc_html_e('Pingback:', 'lifestone'); ?><?php comment_author_link(); ?><?php edit_comment_link(esc_html__('Edit', 'lifestone'), '', ''); ?></p>
                <?php
                break;
            default :

                $comment_class = get_comment_class();
                $comment_class = implode(' ', $comment_class); ?>


            <li class="clearfix <?php echo esc_attr($comment_class); ?>" id="li-comment-<?php comment_ID(); ?>">

                <div class="pull-left avatar">
                    <?php echo get_avatar($comment, 40); ?>
                </div><!-- .comment-author .vcard -->
                <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php esc_html_e('Your comment is awaiting moderation.', 'lifestone'); ?></em>
                    <br/>
                <?php endif; ?>

                <div class="comment_right">
                    <div class="comment_info clearfix">
                        <div class="pull-left comment_author">
                            <?php comment_author_link(); ?>
                        </div>
                        <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>"></a><?php echo esc_html(html_entity_decode('&nbsp;&nbsp;')); ?><?php edit_comment_link(esc_html__('Edit', 'lifestone'), '', ''); ?>
                    </div><!-- end of comment_info -->
                    <p>
                        <?php comment_text(); ?>
                    </p>
                    <div class="comment_date">
                        <span class="pull-left"><?php echo get_comment_date(); ?> </span>
                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    </div><!-- end of comment_date -->

                </div><!-- end of comment_right -->


                <?php
                break;
        endswitch;
    }
}


/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load Helper file.
 */
require get_template_directory() . '/includes/helpers.php';

/**
 * Load functions for loading style, fonts and scripts.
 */
require get_template_directory() . '/includes/static.php';


/*
 * All the filters
 */

require get_template_directory() . '/includes/lifestone_filters.php';

/*
 * Navigation Menu Walker
 */
require get_template_directory() . '/includes/lifestone-nav-walker.php';

/*
 * Aqua Resizer
 */
require get_template_directory() . '/includes/aq_resizer.php';

/*
 * Load TGMPA Class
 */
require get_template_directory() . '/includes/class-tgm-plugin-activation.php';

if(!function_exists('lifestone_author')) {
    /**
     * @return string|void
     */
    function lifestone_author()
    {
        global $authordata;
        if (!is_object($authordata)) {
            return;
        }

        $link = sprintf(
            '<a href="%1$s" title="%2$s" rel="author"><i class="fa fa-user"></i>%3$s</a>',
            esc_url(get_author_posts_url($authordata->ID, $authordata->user_nicename)),
            esc_attr(sprintf(__('Posts by %s', 'lifestone'), get_the_author())),
            get_the_author()
        );
        return $link;
    }
}


if(!function_exists('lifestone_author_info_box')) {
    /**
     * @return string
     */
    function lifestone_author_info_box()
    {

        global $post;

        // Detect if it is a single post with a post author
        if (is_single() && isset($post->post_author)) {

            // Get author's display name
            $display_name = get_the_author_meta('display_name', $post->post_author);

            // If display name is not available then use nickname as display name
            if (empty($display_name))
                $display_name = get_the_author_meta('nickname', $post->post_author);

            // Get author's biographical information or description
            $user_description = get_the_author_meta('user_description', $post->post_author);

            // Get link to the author archive page
            $user_posts = get_author_posts_url(get_the_author_meta('ID', $post->post_author));

            $author_details = '';

            if (!empty($user_description)) {
                // Author avatar and bio

                $author_details .= '<a href="javascript:void(0)" class="avatar">' . get_avatar(get_the_author_meta('user_email'), 90) .'</a>';

                $author_details .= '<div class="author-bio"><h5><a href="' . $user_posts . '" class="author-link">' . $display_name . '</a></h5><p>' . $user_description . '</p></div>';
                return $author_details;
            }
        }
        return false;

    }
}

// Allow HTML in author bio section
remove_filter('pre_user_description', 'wp_filter_kses');

if(!function_exists('lifestone_register_required_plugins')) {
    /**
     * Register the required plugins for this theme.
     */
    function lifestone_register_required_plugins()
    {
        /*
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(

            // This is an example of how to include a plugin bundled with a theme.
            array(
                'name' => esc_html__('Lifestone Packages', 'lifestone'),
                'slug' => 'lifestone',
                'source' => get_template_directory() . '/includes/lib/plugins/lifestone.zip',
                'required' => true,
                'version' => '',
                'force_activation' => false,
                'force_deactivation' => false,
                'external_url' => '',
                'is_callable' => '',
            ),

            // Visual Composer
            array(
                'name' => esc_html__('WPBakery Visual Composer', 'lifestone'),
                'slug' => 'js_composer',
                'source' => get_template_directory() . '/includes/lib/plugins/js_composer.zip',
                'required' => true,
                'version' => '',
                'force_activation' => false,
                'force_deactivation' => true,
                'external_url' => '',
                'is_callable' => '',
            ),
            // Contact Form 7
            array(
                'name' => esc_html__('Contact Form 7', 'lifestone'),
                'slug' => 'contact-form-7',
                'required' => true,
            ),
            // Breadcrumb NavXT
            array(
                'name' => esc_html__('Breadcrumb NavXT', 'lifestone'),
                'slug' => 'breadcrumb-navxt',
                'required' => true,
            ),
            // NS Feaured Posts
            array(
                'name' => esc_html__('NS Featured Posts', 'lifestone'),
                'slug' => 'ns-featured-posts',
                'required' => true,
            ),
            // Categories Images
            array(
                'name' => esc_html__('Categories Images', 'lifestone'),
                'slug' => 'categories-images',
                'required' => true,
            ),
            // WP User Avatar
            array(
                'name' => esc_html__('WP User Avatar', 'lifestone'),
                'slug' => 'wp-user-avatar',
                'required' => false,
            ),
            //
            array(
                'name' => esc_html__('Option Tree', 'lifestone'),
                'slug' => 'option-tree',
                'required' => true,
            ),
        );

        $config = array(
            'id' => 'lifestone',
            'default_path' => '',
            'menu' => 'tgmpa-install-plugins',
            'has_notices' => true,
            'dismissable' => true,
            'dismiss_msg' => '',
            'is_automatic' => false,
            'message' => '',
        );

        tgmpa($plugins, $config);
    }

    add_action('tgmpa_register', 'lifestone_register_required_plugins');
}

if(!function_exists('lifestone_header_logo')) {

    /**
     * Header Logo
     */
    function lifestone_header_logo()
    {
        if (function_exists('the_custom_logo')) {
            if(has_custom_logo()) {

                the_custom_logo();

            } else {

                printf('<h3 class="header-text">%s</h3>', get_bloginfo('title'));

            }
        }
    }
    add_action('lifestone_header', 'lifestone_header_logo', 5);
}