<?php
    /**
     * The template for displaying the footer.
     *
     * Contains the closing of the #content div and all content after
     *
     * @package WP Coupon
     */
    global $st_option;
        if( wpcoupon_get_option( 'before_footer', '' ) != '' ) {
            if( wpcoupon_get_option( 'before_footer_apply', 'home' ) != 'all' ) {
                if ( get_option( 'show_on_front' ) == 'page' && is_home() ) {
                    echo do_shortcode( wpcoupon_get_option( 'before_footer', '' ) );
                }
            } else {
                echo do_shortcode( wpcoupon_get_option( 'before_footer', '' ) );
            }
        }
        $lic = trim( get_option( get_template() . '_license_key' ) );
        $sta = get_option( get_template() . '_license_key_status', false );
        ?>
		</div> <!-- END .site-content -->

        <footer id="colophon" class="site-footer footer-widgets-on" role="contentinfo">
            <div class="container">
                <div class="footer_copy">
                    <div id="footer-nav" class="site-footer-nav">
                        <?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'footer', 'fallback_cb' => false ) ); ?>
                    </div>
                    <div class="footer-cpy-text">
                        <?php
                        echo '<div>';
                        if ( wpcoupon_get_option('footer_copyright') == '' ) {
                            printf( esc_html__( 'Copyright &copy; %1$s %2$s. All Rights Reserved. ', 'wp-coupon-mate' ), esc_attr(date('Y')), get_bloginfo('name') );
                        } else {
                            echo wp_kses_post( wpcoupon_get_option('footer_copyright') );
                        }
                        echo '</div>';
                        echo '<div class="c-text">';
                        if ( wpcoupon_get_option('enable_footer_author') ) {
                            echo '<span>'.sprintf( esc_html__( 'WordPress Coupon Theme by %s', 'wp-coupon-mate' ), '<a href="https://couponthemes.net/">Coupon Themes</a>' ).'</span>' ;
                        }
                        echo '</div>';
                        ?>
                    </div>
                </div>
            </div>
        </footer><!-- END #colophon-->
	</div><!-- END #page -->

    <?php wp_footer(); ?>
</body>
</html>
