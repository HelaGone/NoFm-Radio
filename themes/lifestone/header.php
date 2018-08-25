<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
    if ( is_singular() && pings_open( get_queried_object() ) ) { ?>

        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

        <?php
    } ?>

    <?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>

<?php $loaderOption = lifestone_get_option('lifestone_loader_option', 'off');

if($loaderOption == 'on') { ?>

    <div class="preloader">

        <div class="spinner">

            <div class="dot1"></div>

            <div class="dot2"></div>

        </div>

    </div><!-- end of preloader -->

<?php } ?>

<div id="wrapper">
    <div class="blog-container">
        <!--================= Start sidebar ==================-->
        <div id="sidebar-wrapper">

            <div class="drilldown sidebar-nav mCustomScrollbar">

                <div class="sidebar-brand text-center">

                    <?php do_action('lifestone_header'); ?>

                </div>

                <?php

                if(lifestone_is_enabled('lifestone_sidebar_search_form_option')){ ?>

                    <div class="sidebar-bottom-wrap">
                        <!--Search bar-->
                        <form id="search_form_1" class="search-form_header" action="<?php echo esc_url(home_url( '/' )); ?>" method="get"><span class="submit-wrap"><i class="fa fa-search" aria-hidden="true"></i></span>
                            <input type="text" onblur="if (this.value == '') {this.value = 'SEARCH...'; }" onfocus="if (this.value == 'SEARCH...') {this.value = '';}" id="search" name="s" value="<?php echo get_search_query() == '' ? esc_attr__('SEARCH...', 'lifestone') : ''; ?>" class="textboxsearch">
                        </form>

                    </div>

                <?php } ?>

                <div class="drilldown-container">

                    <?php

                    $defaults = array(
                        'theme_location'  => 'primary',
                        'container'       => false,
                        'menu_class'      => 'drilldown-root',
                        'echo'            => true,
                        'fallback_cb'     => 'wp_page_menu',
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'           => 0,
                        'walker'          => new LifestoneNavWalker()

                    );
                    if ( has_nav_menu( 'primary' ) ) {

                        wp_nav_menu( $defaults );

                    }
                    ?>
                </div>
                <?php
                $social_profiles = lifestone_get_option('lifestone_social_profiles');

                if(lifestone_is_enabled('lifestone_social_media_option') && !empty($social_profiles)){?>

                    <div class="sidebar-bottom">

                        <div class="font-icon social-icons">

                            <ul>

                                <?php
                                foreach ($social_profiles as $value) { ?>

                                    <li><a rel="nofollow" href="<?php echo esc_url($value['lifestone_social_profile_url']) ?>" target="_blank">
                                            <i class="ion-social-<?php echo esc_attr($value['lifestone_social_profile_type']) ?>"></i></a></li>
                                <?php }
                                ?>

                            </ul>

                        </div><!-- end of font-icon -->

                    </div><!-- end of sidebar-bottom -->

                <?php } ?>

            </div><!-- end of drilldown -->

        </div><!-- end of sidebar-wrapper -->
        <!--================= End sidebar ==================-->

        <!--================= TOGGLE MENU ICON STARTS ==================-->

        <a href="#menu-toggle" class="menu-icon" id="menu-toggle"><i class="fa fa-bars"></i></a>

        <!--================= TOGGLE MENU ICON end ==================-->