<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Enqueue scripts and styles.
 */
if(!function_exists('lifestone_scripts')){

    function lifestone_scripts() {

        wp_enqueue_script( 'shiv', get_template_directory_uri() . '/js/html5shiv.min.js', array(), '3.7.2', false );
        wp_script_add_data( 'shiv', 'conditional', 'lt IE 9' );

        wp_enqueue_script( 'respond', get_template_directory_uri() . '/js/respond.min.js', array(), '1.4.2', false);
        wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

        wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.6', true );
        wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), '2.8.3', true );
        wp_enqueue_script( 'drilldown', get_template_directory_uri() . '/js/jquery.drilldown.js', array('jquery'), '1.1.1', true );
        wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array('jquery'), '2.6.0', true );
        wp_enqueue_script( 'scrollup', get_template_directory_uri() . '/js/jquery.scrollUp.js', array('jquery'), '2.3.3', true );
        wp_enqueue_script( 'backstrecth', get_template_directory_uri() . '/js/jquery.backstretch.js', array('jquery'), '2.0.4', true );
        wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), null, true );
        wp_enqueue_script( 'smartvideoembed', get_template_directory_uri() . '/js/smartvideoembed.js', array('jquery'), null, true );
        wp_enqueue_script( 'prettyembed', get_template_directory_uri() . '/js/jquery.prettyembed.js', array('jquery'), '1.2.1', true );
        wp_enqueue_script( 'fullpage', get_template_directory_uri() . '/js/fullpage.js', array('jquery'), '1.3.2', true );
        wp_enqueue_script( 'theiastickysidebar', get_template_directory_uri() . '/js/theia-sticky-sidebar.js', array('jquery'), '1.2.2', true );
        wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.js', array('jquery'), '2.2.2', true );

        wp_enqueue_script( 'lifestone_script', get_template_directory_uri() . '/js/lifestone.js', array('jquery'), null, true );

        wp_register_script( 'lifestone-backstretch', get_template_directory_uri() . '/js/lifestone-backstretch.js', array( 'jquery' ), '1.0.0', true );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

    add_action( 'wp_enqueue_scripts', 'lifestone_scripts' );
}

if(!function_exists('lifestone_fonts_url')){

    function lifestone_fonts_url(){

        $fonts_url = '';

        $roboto = _x( 'on', 'Roboto fonts: on or off', 'lifestone' );

        $roboto_slab = _x( 'on', 'Roboto Slab fonts: on or off', 'lifestone' );

        if ( 'off' !== $roboto || 'off' !== $roboto_slab ) {
            $font_families = array();

            if ( 'off' !== $roboto_slab ) {
                $font_families[] = 'Roboto+Slab:400,100,300,700';
            }

            if ( 'off' !== $roboto ) {
                $font_families[] = 'Roboto:400,900italic,900,700italic,700,500italic,500,400italic,300italic,300,100italic,100';
            }

            $query_args = array(
                'family' =>  implode( '%7C', $font_families )
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }
        return esc_url_raw( $fonts_url );
    }
}

if(!function_exists('lifestone_styles')){

    function lifestone_styles(){

        wp_enqueue_style( 'lifestone-fonts', lifestone_fonts_url(), array(), null );
        wp_enqueue_style( 'bootstrap', get_template_directory_uri(). '/css/bootstrap.min.css', array(), '3.3.6', 'screen');
        wp_enqueue_style( 'font-awesome', get_template_directory_uri(). '/css/font-awesome.min.css', array(), '4.1.0', 'screen');
        wp_enqueue_style( 'ionicons', get_template_directory_uri(). '/css/ionicons.min.css', array(), '2.0.0', 'screen');
        wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css/owl.carousel.css', array(), '1.3.3');
        wp_enqueue_style( 'owl-theme', get_template_directory_uri(). '/css/owl.theme.css', array(), '1.3.3');
        wp_enqueue_style( 'owl-transitions', get_template_directory_uri(). '/css/owl.transitions.css', array(), '1.3.2');
        wp_enqueue_style( 'jquery-smartvimeoembed', get_template_directory_uri(). '/css/jquery-smartvimeoembed.css', 'screen');
        wp_enqueue_style( 'jquery-flexslider', get_template_directory_uri(). '/css/flexslider.css', array(), '2.4.0', 'screen');
        wp_enqueue_style( 'jquery-fullPage', get_template_directory_uri(). '/css/jquery.fullPage.css', array(), '2.7.9', 'screen');
        wp_enqueue_style( 'lifestone_style', get_template_directory_uri(). '/css/style.css', array(), '1.0.0', 'screen');

    }
    add_action( 'wp_enqueue_scripts', 'lifestone_styles' );
}

if(!function_exists('lifestone_backend_scripts')){
    function lifestone_backend_scripts(){
        wp_enqueue_style( 'lifestone-backend-css', get_template_directory_uri() . '/css/lifestone.css');
        wp_enqueue_script('lifestone-backend-js', get_template_directory_uri() .'/js/backend.js', array('jquery'), '1.0', true);
    }
    add_action( 'admin_enqueue_scripts', 'lifestone_backend_scripts' );
}