<?php
get_header();
$cate_title = single_cat_title( '', false );
$cate_id = get_queried_object_id();

$layout = wpcoupon_get_option( 'coupon_cate_layout', 'right-sidebar' );
?>

<div id="content-wrap" class="container <?php echo esc_attr( $layout ); ?>">
	<div id="primary" class="content-area">
		<main id="main" class="site-main ajax-coupons" role="main">
			<?php
			?>
			<section id="store-listings-wrapper" class="st-list-coupons wpb_content_element">
                <?php
                $heading = wpcoupon_get_option( 'coupon_cate_heading', esc_html__( 'Newest %coupon_cate% Coupons', 'wp-coupon-mate' ) );
                $heading = str_replace( '%coupon_cate%', $cate_title, $heading );
                ?>
                <h1><?php echo wp_kses_post( $heading ); ?></h1>
				<?php
				/**
				 * Hook: wpcoupon_coupon_category_before_render_coupons
				 *
				 * @since 1.2.6
				 * hooked wpcoupon_store_cat_filter - 10
				 */
				do_action( 'wpcoupon_coupon_category_before_render_coupons' );

				global $wp_rewrite, $wp_query;
				$max_pages = $wp_query->max_num_pages;
				$paged = wpcoupon_get_paged();

				$current_link = $_SERVER['REQUEST_URI'];
				$tpl = wpcoupon_get_option( 'coupon_cate_tpl', 'cat' );
				?>
				<div class="cat-coupon-lists" id="cat-coupon-lists">
				<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						wpcoupon_setup_coupon( get_the_ID(), $current_link );
						get_template_part( 'loop/loop-coupon', $tpl );
					}
				} else {
					?>
						<div class="ui warning message">
							<div class="header">
							<?php esc_html_e( 'Oops! No coupons found', 'wp-coupon-mate' ); ?>
							</div>
							<p><?php esc_html_e( 'There are no coupons for this store, please come back later.', 'wp-coupon-mate' ); ?></p>
						</div>
					<?php
				}
				?>
				</div>
			</section>
			<?php

			if ( 'ajax_loadmore' == wpcoupon_get_option( 'coupon_cate_paging', 'ajax_loadmore' ) ) {
				if ( $max_pages > $paged ) { ?>
					<div class="couponcat-pagination-wrap">
						<div class="couponcat-load-more wpb_content_element">
							<a href="<?php next_posts( $max_pages ); ?>" class="ui button btn btn_primary btn_large"
							data-link="<?php echo esc_attr( $current_link ); ?>" data-cat-id="<?php echo esc_attr( $cate_id ); ?>"
							data-loading-text="<?php esc_attr_e( 'Loading...', 'wp-coupon-mate' ); ?>"><?php esc_html_e( 'Load More Coupons', 'wp-coupon-mate' ); ?> <i class="fa fa-arrow-alt-circle-down"></i></a>
						</div>
					</div>
				<?php }
			} else {
				?>
				<div class="couponcat-pagination-wrap">
					<?php get_template_part( 'content', 'paging' ); ?>
				</div>
				<?php
			}

			?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<div id="secondary" class="widget-area sidebar category-sidebar" role="complementary">


        <div class="inner shadow-box">
            <div class="inner-content clearfix">
                <?php

                $image_id = get_term_meta( $cate_id, '_wpc_cat_image_id', true );
                $thumb = false;
                if ( $image_id > 0 ) {
                    $image = wp_get_attachment_image_src( $image_id, 'medium' );
                    if ( $image ) {
                        $thumb = '<img src="' . esc_attr( $image[0] ) . '" alt=" ">';
                    }
                }

                if ( ! $thumb ) {
                    $icon = get_term_meta( $cate_id, '_wpc_icon', true );
                    if ( trim( $icon ) !== '' ) {
                        $thumb = '<i class="circular ' . esc_attr( $icon ) . '"></i>';
                    }
                }

                if ( $thumb ) {
                    ?>
                    <div class="header-thumb">
                        <div class="ui center aligned icon">
                            <?php
                            echo apply_filters( '_wpcoupon_cat_thumb', $thumb );
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php $description = get_the_archive_description();?>
        <?php if($description){?>

        <div class="inner shadow-box">
            <div class="inner-content clearfix">
                <h4 class="widget-title">About <?php echo $cate_title; ?></h4>
                <div class="header-content">
                    <?php
                    if ( $description ) {
                        echo '<div class="tax-desc">' . wpcoupon_toggle_content_more( $description ) . '</div>';
                    } ?>

                </div>
            </div>
        </div>
        <?php }?>



		<?php
		/**
		 * Hook: wpcoupon_coupon_category_before_sidebar
		 * Hooked: wpcoupon_coupon_cat_filter_box - 10
		 *
		 * @since 1.2.6
		 */
		do_action( 'wpcoupon_coupon_category_before_sidebar' );
		dynamic_sidebar( 'sidebar-coupon-category' );
		/**
		 * Hook: wpcoupon_coupon_category_after_sidebar
		 *
		 * @since 1.2.6
		 */
		do_action( 'wpcoupon_coupon_category_after_sidebar' );
		?>
	</div>

	<?php
	$ads = wpcoupon_get_option( 'coupon_cate_ads', '' );
	if ( $ads ) {
		echo '<div class="clear"></div>';
		echo balanceTags( $ads );
	}
	?>

</div> <!-- /#content-wrap -->

<?php
get_footer();
?>
