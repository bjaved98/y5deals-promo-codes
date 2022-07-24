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
 */
do_action( 'wpcoupon_after_header' );
$layout = wpcoupon_get_site_layout();

global $post;
wpcoupon_setup_coupon( $post );
the_post();
?>
<div id="content-wrap" class="single-coupon-container container <?php echo esc_attr( $layout ); ?>">
    <!-- Coupon single -->
    <div data-modal-id="<?php echo wpcoupon_coupon()->ID; ?>" class="ui single-coupon-box coupon-modal coupon-code-modal shadow-box">
        <div class="scrolling content">
            <div class="coupon-header clearfix">
                <div class="coupon-store-thumb">
                    <?php
                    echo wpcoupon_coupon()->get_thumb( );
                    ?>
                </div>
                <div class="coupon-title" title="<?php echo esc_attr( get_the_title( wpcoupon_coupon()->ID ) ) ?>"><?php echo get_the_title( wpcoupon_coupon()->ID ); ?></div>
            </div>
            <div class="coupon-content">
                <p class="coupon-type-text">
                    <?php
                    switch ( wpcoupon_coupon()->get_type() ) {
                        case 'sale':
                            esc_html_e( 'Deal Activated, no coupon code required!', 'wp-coupon-mate' );
                            break;
                        case 'print':
                            esc_html_e( 'Print this coupon and redeem it in-store', 'wp-coupon-mate' );
                            break;
                        default:
                            esc_html_e( 'Copy this code and use at checkout', 'wp-coupon-mate' );
                    }
                    ?>
                </p>
                <div class="modal-code">
                    <?php
                    switch ( wpcoupon_coupon()->get_type() ) {

                        case 'sale':
                            ?>
                            <a class="ui button btn btn_secondary deal-actived" target="_blank" rel="nofollow" href="<?php echo esc_attr( wpcoupon_coupon()->get_go_out_url() ); ?>"><?php esc_html_e( 'Go To Store', 'wp-coupon-mate' ); ?><i class="angle right icon"></i></a>
                            <?php
                            break;
                        case 'print':
                            $image_url = esc_url( wpcoupon_coupon()->get_print_image() );
                            ?>
                            <a class="btn-print-coupon" target="_blank" href="<?php echo esc_attr( $image_url ); ?>"><img alt="" src="<?php echo esc_attr( $image_url ); ?>"/></a>
                            <?php
                            break;
                        default:
                            ?>
                            <div class="coupon-code">
                                <div class="ui fluid action input massive">
                                    <input  type="text" class="code-text" autocomplete="off" readonly value="<?php echo esc_attr( wpcoupon_coupon()->get_code() ); ?>">
                                    <button class="ui right labeled icon button btn btn_secondary copy-btn">
                                        <i class="copy icon"></i>
                                        <span><?php esc_html_e( 'Copy', 'wp-coupon-mate' ); ?></span>
                                    </button>
                                </div>
                            </div>

                        <?php
                    }
                    ?>
                </div>
                <div class="clearfix">
                    <div class="user-ratting">
                        <div class="ui icon basic buttons">
                            <div class="ui button icon-popup coupon-vote" data-vote-type="up" data-coupon-id="<?php echo wpcoupon_coupon()->ID; ?>"  data-position="top center" data-inverted="" data-tooltip="<?php esc_attr_e( 'This Worked', 'wp-coupon-mate' ); ?>"><i class="thumbs up outline icon"></i></div>
                            <div class="ui button icon-popup coupon-vote" data-vote-type="down" data-coupon-id="<?php echo wpcoupon_coupon()->ID; ?>"  data-position="top center" data-inverted=""  data-tooltip="<?php esc_attr_e( "Did Not Work", 'wp-coupon-mate' ); ?>"><i class="thumbs down outline icon"></i></div>
                            <div class="ui button icon-popup coupon-save" data-coupon-id="<?php echo wpcoupon_coupon()->ID; ?>" data-position="top center" data-inverted=""  data-tooltip="<?php esc_attr_e( "Save This Coupon", 'wp-coupon-mate' ); ?>" ><i class="save outline icon"></i></div>
                        </div>
                        <div class="user-ratting-text"><?php esc_html_e( 'Did it work?', 'wp-coupon-mate' ); ?></div>
                    </div>

                    <div class="go-store">
                        <div class="go-to-btn">
                            <?php if ( wpcoupon_coupon()->get_type() !== 'sale' ) { ?>
                                <?php if ( wpcoupon_coupon()->get_type() == 'print' ) { ?>
                                    <a class="ui button btn btn_secondary btn-print-coupon"  href="<?php echo esc_attr( $image_url ); ?>"><?php esc_html_e( 'Print Now', 'wp-coupon-mate' ); ?> <i class="print icon"></i></a>
                                <?php } else { ?>
                                    <a href="<?php echo esc_attr( wpcoupon_coupon()->get_go_out_url() ); ?>" rel="nofollow" target="_blank" class="ui button btn btn_secondary go-store"><?php esc_html_e( 'Go To Store', 'wp-coupon-mate' ); ?><i class="angle right icon"></i></a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="show-detail show-detail-single"><a href="#"><?php esc_html_e( 'Coupon Detail', 'wp-coupon-mate' ) ?><i class="angle down icon"></i></a></div>
                    </div>

                </div>
                <div class="coupon-popup-detail">
                    <div class="coupon-detail-content"><?php
                        echo str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', wpcoupon_coupon()->post_content ) );  ;
                        ?></div>
                    <p><strong><?php esc_html_e( 'Expires', 'wp-coupon-mate' ); ?></strong>: <?php echo wpcoupon_coupon()->get_expires( null, true ); ?></p>
                    <p><strong><?php esc_html_e( 'Submitted', 'wp-coupon-mate' ); ?></strong>:
                        <?php printf( esc_html__( '%s ago', 'wp-coupon-mate' ), human_time_diff( get_the_time('U'), current_time('timestamp') ) ); ?>
                    </p>
                </div>
            </div>
            <div class="coupon-footer">
                <ul class="clearfix">
                    <li><span><i class="wifi icon"></i> <?php printf( esc_html__( '%1$s Used - %2$s Today', 'wp-coupon-mate' ), wpcoupon_coupon()->get_total_used(), wpcoupon_coupon()->get_used_today() ); ?></span></li>
                    <li class="modal-share">
                        <a class="" href="#"><i class="share alternate icon"></i> <?php esc_html_e( 'Share', 'wp-coupon-mate' ); ?></a>
                        <div class="share-modal-popup ui popup top right transition hidden---">
                            <?php
                            $args =  array(
                                'title'     => get_the_title( wpcoupon_coupon()->ID ),
                                'summary'   => wpcoupon_coupon()->get_excerpt(140),
                                'url'       => wpcoupon_coupon()->get_share_url()
                            );
                            echo WPCoupon_Socials::facebook_share( $args );
                            echo WPCoupon_Socials::twitter_share( $args );

                            do_action('loop_coupon_more_share_buttons');
                            ?>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>

    <div id="primary" class="content-area-single">
        <main id="main" class="site-main" role="main">
            <?php
            $has_thumb = wpcoupon_maybe_show_coupon_thumb();
            $has_expired = wpcoupon_coupon()->has_expired();
            ?>
            <?php

            if ( wpcoupon_get_option( 'enable_single_popular', true ) ) {
                // in this stores
                $number = wpcoupon_get_option( 'single_popular_number', 10 );
                $number = absint( $number );

                $custom_text = wpcoupon_get_option( '' );
                if ( ! $custom_text ) {
                    $custom_text = esc_html__( 'Most popular {store} coupons.', 'wp-coupon-mate' );
                }
                $terms = get_the_terms( $post->ID, 'coupon_store' );
                if ( $terms ) {
                    $current = current_time( 'timestamp' );
                    $tag_ids = wp_list_pluck( $terms, 'term_id' );

                    $first_store = current( $terms );
                    $custom_text = str_replace( '{store}', $first_store->name, $custom_text );
                    $args = array(
                        'tax_query' => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'coupon_store',
                                'field' => 'term_id',
                                'terms' => $tag_ids,
                                'operator' => 'IN',
                            ),
                        ),
                        /*
                        'meta_query'     => array(
                            'relation' => 'AND',
                            array(
                                'relation' => 'OR',
                                array(
                                    'key'     => '_wpc_expires',
                                    'value'   => '',
                                    'compare' => '=',
                                ),
                                array(
                                    'key'     => '_wpc_expires',
                                    'value'   => $current,
                                    'compare' => '>=',
                                ),
                            )
                        ),
                    */
                        'post__not_in' => array( $post->ID ),
                        'posts_per_page' => $number,
                        'meta_key' => '_wpc_used',
                        'orderby' => 'meta_value_num',
                        'order' => 'desc',
                    );

                    $args = apply_filters( 'wpcoupon_single_popular_coupons_args', $args );

                    $wp_query = new WP_Query( $args );
                    $max_pages = $wp_query->max_num_pages;
                    $coupons = $wp_query->get_posts();

                    if ( $coupons ) {
                        if ( $custom_text ) {
                            ?>
                            <h2 class="section-heading coupon-status-heading"><?php echo wp_kses_post( $custom_text ); ?></h2>
                            <?php
                        }
                        $tpl_name = 'cat';
                        foreach ( $coupons as $post ) {
                            wpcoupon_setup_coupon( $post );
                            get_template_part( 'loop/loop-coupon', $tpl_name );
                        }
                        ?>

                        <?php
                    }
                }

                wp_reset_query();
            }
            ?>

            <?php echo get_the_term_list( $post->ID, 'coupon_tag', '<p class="coupon-tags"><strong>' . esc_html__( 'Tags:', 'wp-coupon-mate' ) . ' </strong>', ', ', '</p>' ); ?>

            <div class="single-coupon-comments shadow-box content-box">
                <?php
                comments_template();
                ?>
            </div>

        </main><!-- #main -->
    </div><!-- #primary -->
</div> <!-- /#content-wrap -->

<?php get_footer(); ?>
