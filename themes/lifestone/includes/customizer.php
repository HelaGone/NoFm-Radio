<?php
/**
 * Lifestone Theme Customizer.
 *
 * @package Lifestone
 */
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since MyTheme 1.0
 */
class Lifestone_Customize {

    public static function register ( $wp_customize ) {

        /**
         * Create Logo Setting and Upload Control
         */

        $wp_customize->add_section( 'lifestone_footer', array(
            'title' => __( 'Footer', 'lifestone' ),
            'description' => __( 'Add footer text here', 'lifestone' ),
            'panel' => '',
            'priority' => 160,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
        ) );

        $wp_customize->add_setting('lifestone_footer_text', array(

            'default'           => '',
            'sanitize_callback' => 'esc_textarea',
        ));

        // Add a control to upload the logo
        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'lifestone_footer_text',
            array(
                'label'     => esc_html__('Text for the footer', 'lifestone'),
                'section'   => 'lifestone_footer',
                'priority'  => 20
            ) )
        );

        $wp_customize->get_setting( 'blogname' )->transport              = 'postMessage';
        $wp_customize->get_setting( 'blogdescription' )->transport       = 'postMessage';
        $wp_customize->get_setting( 'header_textcolor' )->transport      = 'postMessage';
        $wp_customize->get_setting( 'background_color' )->transport      = 'postMessage';
        $wp_customize->get_setting( 'lifestone_footer_text' )->transport = 'refresh';
    }

    /**
     * This outputs the javascript needed to automate the live settings preview.
     * Also keep in mind that this function isn't necessary unless your settings
     * are using 'transport'=>'postMessage' instead of the default 'transport'
     * => 'refresh'
     *
     * Used by hook: 'customize_preview_init'
     *
     * @see add_action('customize_preview_init',$func)
     * @since MyTheme 1.0
     */
    public static function live_preview() {
        wp_enqueue_script(
            'lifestone-theme-customizer', // Give the script a unique ID
            get_template_directory_uri() . '/assets/js/customizer.js', // Define the path to the JS file
            array(  'jquery', 'customize-preview' ), // Define dependencies
            '', // Define a version (optional)
            true // Specify whether to put in footer (leave this true)
        );
    }

}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'Lifestone_Customize' , 'register' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'Lifestone_Customize' , 'live_preview' ) );