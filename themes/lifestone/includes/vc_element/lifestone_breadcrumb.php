<?php

function lifestone_display_breadcrumb_fn()
{

    vc_map(array(
        "name"          => esc_html__("Breadcrumb", 'lifestone'),
        "base"          => "lifestone_breadcrumb",
        'description'   => esc_html__( 'Block to display breadcrumb.', 'lifestone'),
        "category"      => esc_html__('Lifestone', 'lifestone'),
        "params"        => array(
            array(
                "type"        => "textfield",
                "holder"      => "div",
                "heading"     => esc_html__("Heading", 'lifestone'),
                "param_name"  => "heading",
                "description" => esc_html__( 'Enter the heading for the page', 'lifestone')
            ),
            array(
                "type"        => "textfield",
                "holder"      => "div",
                "heading"     => esc_html__("Tagline", 'lifestone'),
                "param_name"  => "tagline",
                "description" => esc_html__( 'Enter the tagline for the page', 'lifestone')
            ),
            array(
                "type"        => "attach_images",
                "holder"      => "div",
                "heading"     => esc_html__("Slider Images", 'lifestone'),
                "description" => esc_html__( 'Upload the images for the slider. Single Image can be uploaded to display as background', 'lifestone'),
                "param_name"  => "slider_images"
            )

        )
    ));
}
lifestone_display_breadcrumb_fn();

class WPBakeryShortCode_Lifestone_Breadcrumb extends WPBakeryShortCode {

}