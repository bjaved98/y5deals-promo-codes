<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP Coupon
 */
get_header();

/**
 * Hooks wpcoupon_after_header
 *
 * @see wpcoupon_page_header();
 *
 */
do_action( 'wpcoupon_after_header' );
$layout = wpcoupon_get_site_layout();
?>
    <div id="content-wrap" class="container">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <div class="content-404 widget-area">
                    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'wp-coupon-mate' ); ?></p>
                    <?php get_search_form(); ?>
                </div><!-- .page-content -->
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php

        if ( $layout != 'no-sidebar' ) {
            get_sidebar();
        }

        ?>
    </div> <!-- /#content-wrap -->

<?php get_footer(); ?>
