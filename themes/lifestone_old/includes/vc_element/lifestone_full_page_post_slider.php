<?php
function lifestone_full_page_post_slider_fn() {
    vc_map( array(
        "name" => esc_html__("Blog (Full Page Slider)", 'lifestone'),
        "base" => "lifestone_full_page_post_slider",
        "category" => esc_html__('Lifestone','lifestone'),
        "params" => array(
            array(
                'type'          => 'dropdown',
                'holder'        => 'div',
                'heading'       => esc_html__('Post source', 'lifestone'),
                'param_name'    => 'post_source',
                'description'   => esc_html__('Do you want the most recent post to be shown regardless of any category or from a particular category?', 'lifestone'),
                'admin_label'   => false,
                'weight'        => '',
                'group'         => '',
                'value'         => array(
                    esc_html__('Recent Post', 'lifestone')   => '',
                    esc_html__('From category', 'lifestone') => 'category'
                ),
                'dependency'    => '',
            ),
            array(
                'type'          => 'dropdown',
                'holder'        => 'div',
                'heading'       => esc_html__('Select category.', 'lifestone'),
                'param_name'    => 'category',
                'description'   => '',
                'admin_label'   => false,
                'value'         => lifestone_get_category('category'),
                'dependency'    => array(
                    'element' => 'post_source',
                    'value'   => array( 'category' )
                ),
            ),
            array(
                'type'          => 'dropdown',
                'holder'        => 'div',
                'heading'       => esc_html__('Number of posts', 'lifestone'),
                'param_name'    => 'no_of_post',
                'description'   => esc_html__('Select the number of posts to be displayed in the blog section', 'lifestone'),
                'admin_label'   => false,
                'weight'        => '',
                'group'         => '',
                'value'         => array(
                    esc_html__('Select Number', 'lifestone')   => '',
                    esc_html__('All', 'lifestone')             => '-1',
                    esc_html__('1', 'lifestone')               => '1',
                    esc_html__('2', 'lifestone')               => '2',
                    esc_html__('3', 'lifestone')               => '3',
                    esc_html__('4', 'lifestone')               => '4',
                    esc_html__('5', 'lifestone')               => '5',
                    esc_html__('6', 'lifestone')               => '6',
                    esc_html__('7', 'lifestone')               => '7',
                    esc_html__('8', 'lifestone')               => '8',
                    esc_html__('9', 'lifestone')               => '9',
                    esc_html__('10', 'lifestone')              => '10'
                )
            ),
            array(
                "type"        => "dropdown",
                "holder"      => "div",
                "heading"     => esc_html__("Sort Order", 'lifestone'),
                "param_name"  => "posts_order",
                "description" => __('Designates the ascending or descending order. More at <a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters">WordPress codex page.</a>', 'lifestone'),
                "value"       => array(
                    esc_html__( 'Select Order', 'lifestone' )          => '',
                    esc_html__( 'Ascending', 'lifestone' )             => 'ASC',
                    esc_html__( 'Descending', 'lifestone' )            => 'DESC',

                )
            )
        )
    ) );
}
lifestone_full_page_post_slider_fn();

class WPBakeryShortCode_Lifestone_Full_Page_Post_Slider extends WPBakeryShortCode
{

}
