<?php
global $product, $woocommerce_loop, $yith_woocompare;

$countdown = '';
if( isset($show_countdown) ){
	$countdown = $show_countdown;
}

$class = 'item product';
if ( isset($col) && $col > 0) :
	$column = ($col == 5) ? '15' : 12/$col;
	$column2 = 12/($col-1);
	$column3 = 12/($col-2);
	$class .= ' col-md-'.$column.' col-sm-'.$column2.' col-xs-'.$column3.' col-phone-12';
endif;
if ( isset($animate) && $animate) :
$class .= ' item-animate';
endif;
if ( isset($eclass) && $eclass) :
$class .= ' '.$eclass;
endif;
?>
<li class="<?php echo $class; ?>">
	<div class="block-product-inner grid-view">
		<div class="item-inner">
			<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
			<div class="item-img have-iconew have-additional clearfix">
				<div class="item-img-info">
					<a class="product-image" href="<?php the_permalink(); ?>">
						<?php
							/**
							 * woocommerce_before_shop_loop_item_title hook
							 *
							 * @hooked woocommerce_show_product_loop_sale_flash - 10
							 * @hooked woocommerce_template_loop_product_thumbnail - 10
							 */
							do_action( 'woocommerce_before_shop_loop_item_title' );
						?>
					</a>
					<?php 
					// Show countdown
					if($countdown == 'yes'):
					// Get the Sale Price Date To of the product
					$sale_price_dates_to 	= ( $date = get_post_meta( $product->id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y/m/d', $date ) : '';
					
					/** set sale price date to default 23 days for http://demo.snstheme.com/ */
					if($_SERVER['SERVER_NAME'] == 'demo.snstheme.com' || $_SERVER['SERVER_NAME'] == 'dev.snsgroup.me' ){
						if($sale_price_dates_to == 0)
							$sale_price_dates_to = date('Y/m/d', strtotime('+24 days'));
					}
					
					?>
					<div id="sns_itembox_countdown_<?php echo $product->id; ?>" class="item-box-countdown">
						<div class="box-countdown-day">
							<span class="n_">23</span>
							<span class="t_"><?php esc_html_e('Day', 'snsavaz');?></span>
						</div>
						<div class="box-countdown-hour">
							<span class="n_">8</span>
							<span class="t_"><?php esc_html_e('Hours', 'snsavaz');?></span>
						</div>
						<div class="box-countdown-minute">
							<span class="n_">15</span>
							<span class="t_"><?php esc_html_e('Minutes', 'snsavaz');?></span>
						</div>
						<div class="box-countdown-second">
							<span class="n_">23</span>
							<span class="t_"><?php esc_html_e('Seconds', 'snsavaz');?></span>
						</div>
						
						<script type="text/javascript">
							jQuery(document).ready(function($){
								$('#sns_itembox_countdown_<?php echo $product->id;?>').countdown('<?php echo $sale_price_dates_to; ?>', function(event) {
									//$(this).html(event.strftime('%-D day%!D : %H : %M : %S'));
									
									$(this).find('.box-countdown-day .n_').html(event.strftime('%-D'));
									$(this).find('.box-countdown-day .t_').html(event.strftime('day%!D'));

									$(this).find('.box-countdown-hour .n_').html(event.strftime('%H'));

									$(this).find('.box-countdown-minute .n_').html(event.strftime('%M'));

									$(this).find('.box-countdown-second .n_').html(event.strftime('%S'));
									
								});
							});
						</script>
					</div>
					<?php	
					endif;
					?>
					<div class="item-box-hover">
						<div class="cart-wrap">
							<?php
								/**
								 * woocommerce_after_shop_loop_item hook
								 *
								 * @hooked woocommerce_template_loop_add_to_cart - 10
								 */
								if ( class_exists('YITH_WCQV_Frontend') ) {
									remove_action('woocommerce_after_shop_loop_item',  array( YITH_WCQV_Frontend::get_instance(), 'yith_add_quick_view_button'), 15);
								}
								if ( isset($yith_woocompare) ) {
								    remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
								}
								do_action( 'woocommerce_after_shop_loop_item' ); 
							?>
						</div>
						
						<?php
			            if( class_exists( 'YITH_WCWL' ) ) {
			                echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
			            }
			            ?>

			            <?php if( class_exists( 'YITH_Woocompare' ) ) { ?>
			                <?php
			                $action_add = 'yith-woocompare-add-product';
			                $url_args = array(
			                    'action' => $action_add,
			                    'id' => $product->id
			                );
			                ?>
			                <a data-original-title="<?php echo esc_html( get_option('yith_woocompare_button_text') ); ?>" data-toggle="tooltip" href="<?php echo esc_url( wp_nonce_url( add_query_arg( $url_args ), $action_add ) ); ?>" class="compare btn btn-primary-outline" data-product_id="<?php echo esc_attr( $product->id ); ?>">
			                </a>
			            <?php } ?>
			            <?php if ( class_exists('YITH_WCQV_Frontend') ) { ?>
			            	<a data-original-title="<?php echo esc_html( get_option('yith-wcqv-button-label') ); ?>" data-toggle="tooltip" data-product_id="<?php echo esc_attr($product->id) ?>" class="button yith-wcqv-button" href="#"></a>
			            <?php } ?>
						
					</div>
				</div>
			</div>
			<div class="item-info">
				<div class="info-inner">
					<h3 class="item-title"><a class="product-name" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="item-content">
						<?php
							/**
							 * woocommerce_after_shop_loop_item_title hook
							 *
							 * @hooked woocommerce_template_loop_rating - 5
							 * @hooked woocommerce_template_loop_price - 10
							 */
							remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
							remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
							// Re-order
							add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5);
							add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10);
							do_action( 'woocommerce_after_shop_loop_item_title' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</li>