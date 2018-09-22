<?php
function lifestone_featured_post_banner_fn()
{

    vc_map(array(
        "name"          => esc_html__("Featured Post Banner", 'lifestone'),
        "base"          => "lifestone_featured_post_banner",
        'holder'        => 'div',
        'description'   => esc_html__( 'Block to dislay featured posts.', 'lifestone'),
        "category"      => esc_html__('Lifestone', 'lifestone'),
        "params"        => array(
            array(
                "type"        => "dropdown",
                "holder"      => "div",
                "heading"     => esc_html__("Readmore button", 'lifestone'),
                "param_name"  => "Leer",
                "description" => esc_html__( 'Enable Read-more button', 'lifestone'),
                "value"       => array(
                    esc_html__('Select', 'lifestone')    => '',
                    esc_html__('On', 'lifestone')        => 'on',
                    esc_html__('Off', 'lifestone')       => 'off'
                )
            )
        )
    ));
}
lifestone_featured_post_banner_fn();

class WPBakeryShortCode_Lifestone_Featured_Post_Banner extends WPBakeryShortCode {

}