<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
        if ( is_singular() && pings_open( get_queried_object() ) ):
        ?>
            <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php
        endif; ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php 
        $loaderOption = lifestone_get_option('lifestone_loader_option', 'off');
        if($loaderOption == 'on'): ?>
            <div class="preloader">
                <div class="spinner">
                    <div class="dot1"></div>
                    <div class="dot2"></div>
                </div>
            </div><!-- end of preloader -->
    <?php
        endif; ?>
    <div id="wrapper">
        <div class="blog-container">
        <!--================= Start sidebar ==================-->
            <div id="sidebar-wrapper">
                <div class="drilldown sidebar-nav mCustomScrollbar">
                    <div class="sidebar-brand text-center">
                        <?php do_action('lifestone_header'); ?>
                    </div>
                <?php
                    if(lifestone_is_enabled('lifestone_sidebar_search_form_option')): ?>
                        <div class="sidebar-bottom-wrap">
                            <!--Search bar-->
                            <form id="search_form_1" class="search-form_header" action="<?php echo esc_url(home_url( '/' )); ?>" method="get"><span class="submit-wrap"><i class="fa fa-search" aria-hidden="true"></i></span>
                                <input type="text" onblur="if (this.value == '') {this.value = 'BUSCAR...'; }" onfocus="if (this.value == 'BUSCAR...') {this.value = '';}" id="search" name="s" value="<?php echo get_search_query() == '' ? esc_attr__('BUSCAR...', 'lifestone') : ''; ?>" class="textboxsearch">
                            </form>
                        <?php 
                            do_shortcode('[invoca-player]'); ?>
                        </div>
                <?php 
                    endif; ?>
                    <div class="drilldown-container">
                    <?php

                        // $defaults = array(
                        //     'theme_location'  => 'primary',
                        //     'container'       => false,
                        //     'menu_class'      => 'drilldown-root',
                        //     'echo'            => true,
                        //     'fallback_cb'     => 'wp_page_menu',
                        //     'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        //     'depth'           => 0,
                        //     'walker'          => new LifestoneNavWalker()

                        // );
                        // if ( has_nav_menu( 'primary' ) ) {
                        //     wp_nav_menu( $defaults );
                        // }
                    ?>
                        <figure class="aquiandamos_container">
                            <img src="<?php echo get_template_directory_uri().'/images/aquiandamos.png'; ?>">
                        </figure>
                        <div id="open_player">
                            <button id="playMe">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" fill="#ff0000" /><path d="M0 0h24v24H0z" fill="none"/>
                                </svg>
                            </button>
                            <div>
                                <ul>
                                    <li>
                                        <button class="external_player">
                                            <img src="<?php echo get_template_directory_uri().'/images/iconos/realplayer.png'?>" width="24" height="24">
                                        </button>
                                    </li>
                                    <li>
                                        <button class="external_player">
                                            <a href="https://tunein.com/radio/NoFM-Radio-s167908/" rel="noopener nofollow" target="_blank">
                                                <img src="<?php echo get_template_directory_uri().'/images/iconos/tunein.png'?>" width="24" height="24">
                                            </a>
                                        </button>
                                    </li>
                                    <li>
                                        <button class="external_player">
                                            <img src="<?php echo get_template_directory_uri().'/images/iconos/winamp.png'?>" width="24" height="24">
                                        </button>
                                    </li>
                                    <li>
                                        <button class="external_player">
                                            <img src="<?php echo get_template_directory_uri().'/images/iconos/windowsmedia.png'?>" width="24" height="24">
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="main-social-icons">
                            <ul>
                                <li><a class="no-eff" href="http://www.facebook.com/pages/NoFm-Radio/170849102955266" target="_blank"><img src="http://nofm-radio.com/wp-content/themes/brennius/images/light/social/picons06.png"/></a></li>
                                <li><a class="no-eff" href="http://twitter.com/nofm_radio" target="_blank"><img src="http://nofm-radio.com/wp-content/themes/brennius/images/light/social/picons03.png"/></a></li>
                                <li><a class="no-eff" href="http://instagram.com/nofm_radio" target="_blank"><img src="http://nofm-radio.com/wp-content/themes/brennius/images/light/social/picons02.png"/></a></li>
                                <!-- <li><a class="no-eff" href="http://vine.co/u/979158773568536576" target="_blank"><img src="http://nofm-radio.com/wp-content/themes/brennius/images/light/social/picons08.png"/></a></li> -->
                                <li><a class="no-eff" href="http://feeds.feedburner.com/nofm-radio/HgNX" target="_blank"><img src="http://nofm-radio.com/wp-content/themes/brennius/images/light/social/picons20.png"/></a></li>
                            </ul>
                        </div>
                        <p style="margin-left:0px; margin-top:10px; text-align: center;">Tel: <a href="tel:+5215562748323" class="unblack">62748323</a></p>
                        <div class="patreon_container">
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                <input type="hidden" name="cmd" value="_s-xclick">
                                <input type="hidden" name="hosted_button_id" value="8KBZCV9NSWUQU">
                                <input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea." style="margin-left:20px; margin-top:10px;">
                                <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1" >
                            </form>
                            <figure>
                                <a href="https://www.patreon.com/NoFMradio" target="_blank" rel="noopener">
                                    <img src="<?php echo get_template_directory_uri().'/images/patreon.png'; ?>">
                                </a>
                            </figure>
                        </div>
                        <div class="clear"></div>

                        <?php wp_nav_menu( array( 'theme_location' => 'hk-custom-menu', 'container_class' => 'custom-menu-class' ) ); ?>

                        <div class="bottom_logo">
                            <figure>
                                <img src="<?php echo get_template_directory_uri().'/images/logo.png';?>">
                            </figure>
                        </div>
                    </div>

                    <div class="sidebar-bottom">
                <?php
                        $social_profiles = lifestone_get_option('lifestone_social_profiles');
 
                        if(lifestone_is_enabled('lifestone_social_media_option') && !empty($social_profiles)): ?>
                            <div class="sidebar-bottom">
                                <div class="font-icon social-icons">
                                    <ul>
                                    <?php
                                        foreach ($social_profiles as $value): ?>
                                            <li>
                                                <a rel="nofollow" href="<?php echo esc_url($value['lifestone_social_profile_url']) ?>" target="_blank">
                                                    <i class="ion-social-<?php echo esc_attr($value['lifestone_social_profile_type']) ?>"></i>
                                                </a>
                                            </li>
                                    <?php
                                        endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                    <?php  
                        endif; ?>
                    </div>
                </div><!-- end of sidebar-wrapper -->
            </div>
            <!--================= End sidebar ==================-->
            <!--================= TOGGLE MENU ICON STARTS ==================-->
            <a href="#menu-toggle" class="menu-icon" id="menu-toggle">
                <i class="fa fa-bars"></i>
            </a>
            <!--================= TOGGLE MENU ICON end ==================-->