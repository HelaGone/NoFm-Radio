<?php

$predefinedClass = array(
    esc_html__('Select', 'lifestone')                    => '',
    esc_html__('contact', 'lifestone')                 => 'contact',
    esc_html__('contact-section alt-1', 'lifestone')   => 'contact-section alt-1',

);


vc_add_param( 'vc_row',
    array(
        'type'			=> 'dropdown',
        'heading'		=> esc_html__('Class', 'lifestone'),
        'param_name'	=> 'row_class',
        'value'			=> array(
            esc_html('Select', 'lifestone')       => '',
            esc_html__('Custom', 'lifestone')	    => 'custom',
            esc_html__('Predefined', 'lifestone')	=> 'predefined'
        ),
        'description'	=> esc_html__('Custom - enter your own class name for row | Predefined - select from predefined class.', 'lifestone')
    )
);

vc_add_param('vc_row', array(
    'type' 			=> 'dropdown',
    'class'			=> '',
    'heading' 		=> esc_html__('Predefined Classes', 'lifestone'),
    'param_name' 	=> 'predefined_class',
    'value' 		=> $predefinedClass,
    'description' 	=> esc_html__('Select Predefined Class', 'lifestone'),
    'dependency' 	=> array(
        'element' => 'row_class',
        'value'   => 'predefined'
    )

));
vc_add_param('vc_row', array(
    'type' 			=> 'textfield',
    'class' 		=> '',
    'heading' 		=> esc_html__('Custom Class', 'lifestone'),
    'param_name' 	=> 'el_class',
    'description' 	=> esc_html__('Enter Class Name for Row', 'lifestone'),
    'dependency' 	=> array(
        'element' => 'row_class',
        'value'   => 'custom'
    )
));


