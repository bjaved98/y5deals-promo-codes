<div id="secondary" class="widget-area sidebar store-sidebar" role="complementary">
<!--Store logo-->
    <div class="inner shadow-box">
        <div class="inner-content clearfix">
            <div class="header-thumb">
                <div class="header-store-thumb">
                    <a rel="nofollow" target="_blank" title="<?php esc_html_e( 'Shop ', 'wp-coupon-mate' );
                    echo wpcoupon_store()->get_display_name(); ?>" href="<?php echo wpcoupon_store()->get_go_store_url(); ?>">
                        <?php
                        echo wpcoupon_store()->get_thumbnail();
                        ?>
                    </a>
                </div>
                <!-- <a class="add-favorite" data-id="<?php echo wpcoupon_store()->term_id; ?>" href="#"><i class="fa-heart"></i><span><?php esc_html_e( 'Favorite This Store', 'wp-coupon-mate' ); ?></span></a> -->
                <div class="rating">
                    <?php if(function_exists("bp_star_ratings")) : echo bp_star_ratings(); endif; ?>
                </div>
            </div>
        </div>
    </div>
<!--  Store Description  -->
    <h4 class="store-about-title">About <?php echo wpcoupon_store()->get_display_name();?></h4>
    <div class="inner shadow-box">
        <div class="inner-content clearfix">
            <div class="header-content">
                <?php
                wpcoupon_store()->get_content( true, true );
                ?>
            </div>
        </div>
    </div>


	<?php 
		/**
		 * Hook: wpcoupon_coupon_store_before_sidebar
		 * @since 1.2.6
		 * hooked wpcoupon_store_cat_filter - 10
		 */
		do_action( 'wpcoupon_coupon_store_before_sidebar' );

	?>
    <?php dynamic_sidebar( 'sidebar-store' ); ?>
	<?php 
		/**
		 * Hook: wpcoupon_coupon_store_after_sidebar
		 * @since 1.2.6
		 */
		do_action( 'wpcoupon_coupon_store_after_sidebar' );

		
	?>
</div><!-- #secondary -->