<?php

function lifestone_map_fn()
{
    vc_map( array(
        "name"          => esc_html__("Map", 'lifestone'),
        "base"          => "lifestone_map",
        'description'   => esc_html__('Embed Google Maps', 'lifestone'),
        "category"      => esc_html__('Lifestone','lifestone'),
        "params"        => array(
            array(
                "type"        => "attach_image",
                "holder"      => "div",
                "heading"     => esc_html__("Image", 'lifestone'),
                "param_name"  => "pin_image",
                'value'       => '',
                "description" => esc_html__("Select image to pinpoint your location in the map.", 'lifestone')
            ),
            array(
                "type"        => "textfield",
                "holder"      => "div",
                "heading"     => esc_html__("Latitude", 'lifestone'),
                "param_name"  => "latitude",
                "value"       => '',
                "description" => esc_html__("Enter the correct latitude coordinates for map.", 'lifestone')
            ),
            array(
                "type"        => "textfield",
                "holder"      => "div",
                "heading"     => esc_html__("Longitude", 'lifestone'),
                "param_name"  => "longitude",
                "value"       => '',
                "description" => esc_html__( "Enter the correct longitude coordinates for map.", 'lifestone')
            ),
            array(
                "type"        => "textarea_html",
                "holder"      => "div",
                "heading"     => esc_html__( 'Description', 'lifestone'),
                "param_name"  => "content",
                "value"       => '',
                "description" => esc_html__( 'Enter short description to display when user clicks over the pin image in the map.', 'lifestone')
            )
        )
    ));
}
lifestone_map_fn();

class WPBakeryShortCode_Lifestone_Map extends WPBakeryShortCode
{

}
