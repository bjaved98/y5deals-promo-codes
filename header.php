<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package WP Coupon
 */

global $st_option;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div id="page" class="hfeed site">
    	<header id="masthead" class="ui page site-header site-navigation" role="banner" id="site-header-nav">
            <?php do_action('wpcoupon_before_header_top'); ?>
            <div class="primary-header">
                <div class="container">
                    <div class="logo_area fleft">
                        <?php if ( wpcoupon_get_option('site_logo', false, 'url') != '' ) { ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                            <img src="<?php echo wpcoupon_get_option('site_logo', false, 'url'); ?>" alt="<?php echo get_bloginfo( 'name' ) ?>" />
                        </a>
                        <?php } else { ?>
                        <div class="title_area">
                            <?php if ( is_home() || is_front_page() ) { ?>
                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                            <?php } else {  ?>
                                <h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
                            <?php } ?>
                            <p class="site-description"><?php  bloginfo( 'description' ); ?></p>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="header_right fright">
                        <nav class="primary-navigation clearfix fleft" role="navigation">
                            <div id="nav-toggle"><i class="content icon"></i></div>
                            <ul class="st-menu">
                                <?php wp_nav_menu( array('theme_location' => 'primary', 'container' => '', 'items_wrap' => '%3$s' ) ); ?>
                            </ul>
                        </nav> <!-- END .primary-navigation -->
                    </div>
                </div>
            </div> <!-- END .header -->
            <?php do_action('wpcoupon_after_header_top'); ?>
    	</header><!-- END #masthead -->
        <div id="content" class="site-content">
<?php
