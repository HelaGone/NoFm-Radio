<?php

function lifestone_contact_info_fn()
{

    vc_map(array(
        "name"          => esc_html__("Contact Info", 'lifestone'),
        "base"          => "lifestone_contact_info",
        'description'   => esc_html__( 'Block to display contact info.', 'lifestone'),
        "category"      => esc_html__('Lifestone', 'lifestone'),
        "params"        => array(
            array(
                "type"        => "dropdown",
                "holder"      => "div",
                "heading"     => esc_html__("Alignment", 'lifestone'),
                "param_name"  => "alignment",
                "description" => esc_html__( 'Select the alignment for this block', 'lifestone'),
                "value"       => array(
                    esc_html__('Select Alignment', 'lifestone')   => '',
                    esc_html__('Horizontal', 'lifestone')         => 'horizontal',
                    esc_html__('Vertical', 'lifestone')           => 'vertical',
                ),
            ),
            array(
                "type"        => "textarea",
                "holder"      => "div",
                "heading"     => esc_html__("Address", 'lifestone'),
                "param_name"  => "address",
                "description" => esc_html__( 'Enter the heading for the page', 'lifestone')
            ),
            array(
                "type"        => "textarea",
                "holder"      => "div",
                "heading"     => esc_html__("Contact No.", 'lifestone'),
                "param_name"  => "phone",
                "description" => esc_html__( 'Enter the phone numbers', 'lifestone')
            ),
            array(
                "type"        => "textarea_html",
                "holder"      => "div",
                "heading"     => esc_html__("Email", 'lifestone'),
                "param_name"  => "content",
                "description" => esc_html__( 'Enter the e-mail address', 'lifestone')
            ),
        )
    ));
}
lifestone_contact_info_fn();

class WPBakeryShortCode_Lifestone_Contact_Info extends WPBakeryShortCode {

};
