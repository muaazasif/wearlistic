<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
if( class_exists('WooCommerce') ){
	$uq = rand().time();
	ob_start();
	
	$posts_per_page = absint($number_limit) ? absint($number_limit) : 3;
	$products = snsavaz_woo_query($orderby, $posts_per_page, $list_cat);

	if( $products->have_posts() ):
		wp_enqueue_script('owlcarousel');
		wp_enqueue_script('countdown');
		?>
		<div id="sns-products-slider-<?php echo $uq; ?>" class="sns-products-slider">
			<div class="sns-products-slider-content">
				<div class="navslider">
					<span class="prev"></span>
					<span class="next"></span>
				</div>
				<ul class="sns-products-slider-list clearfix">
					<?php while ($products->have_posts() ): $products->the_post();?>
						<li class="item-product-slider item-<?php echo get_the_ID(); ?> product">
							<div class="item-slider-thumb">
								<a class="product-image" href="<?php the_permalink(); ?>">
									<?php
									$size = 'snsavaz_products_slider_thumb';
									if ( has_post_thumbnail() ) {
										echo get_the_post_thumbnail( get_the_ID(), $size );
									} elseif ( wc_placeholder_img_src() ) {
										echo wc_placeholder_img( $size );
									}
									?>
								</a>
							</div>
							<div class="item-slider-content">
								<?php // Get the Sale Price Date To of the product
								$sale_price_dates_to 	= ( $date = get_post_meta( get_the_ID(), '_sale_price_dates_to', true ) ) ? date_i18n( 'Y/m/d', $date ) : '';
								/** set sale price date to default 10 days for http://demo.snstheme.com/ */
								if($_SERVER['SERVER_NAME'] == 'demo.snstheme.com' || $_SERVER['SERVER_NAME'] == 'dev.snsgroup.me' ){
									if($sale_price_dates_to == 0 || empty($sale_price_dates_to))
										$sale_price_dates_to = date('Y/m/d', strtotime('+30 days'));
								}
								if(!empty($sale_price_dates_to)):
								?>
								<div class="item-slider-countdown">
									<div class="sns_sale_clock">
										<div><span class="day"></span><?php esc_html_e('Day', 'snsavaz');?></div>
										<div><span class="hours"></span><?php esc_html_e('Hours', 'snsavaz');?></div>
										<div><span class="minutes"></span><?php esc_html_e('Minutes', 'snsavaz');?></div>
										<div><span class="seconds"></span><?php esc_html_e('Seconds', 'snsavaz');?></div>
									</div>
									<script type="text/javascript">
										jQuery(document).ready(function($){
											$('#sns-products-slider-<?php echo $uq; ?> .item-<?php echo get_the_ID(); ?> .item-slider-countdown .sns_sale_clock').countdown('<?php echo $sale_price_dates_to; ?>', function(event){
												$(this).find('.day').html(event.strftime('%-D'));
												$(this).find('.hours').html(event.strftime('%H'));
												$(this).find('.minutes').html(event.strftime('%M'));
												$(this).find('.seconds').html(event.strftime('%S'));
											});
										});
									</script>
								</div>
								<?php endif; ?>
								<div class="item-slider-title">
									<h3 itemprop="name" class="product_title entry-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
								</div>
								<div class="item-slider-short-desc">
									<div itemprop="description">
										<?php
										$limit = ($excerpt_lenght) ? absint($excerpt_lenght) : 20;
										$excerpt = explode(' ', get_the_excerpt(), $limit);
										if (count($excerpt)>=$limit) {
											array_pop($excerpt);
											$excerpt = implode(" ",$excerpt).'...';
										} else {
											$excerpt = implode(" ",$excerpt);
										}
										$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
										echo $excerpt;
										?>
									</div>				
								</div>
								<div class="item-slider-price">
									<?php wc_get_template( 'loop/price.php' );?>
								</div>
								<div class="item-slider-actions">
									<?php 
									add_action('snswoo_slider_actions_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
									add_action( 'snswoo_slider_actions_loop_item', 'sns_yith_wcwl_add_to_wishlist', 15 );
									add_action( 'snswoo_slider_actions_loop_item', 'sns_yith_woocompare', 20 );
									do_action('snswoo_slider_actions_loop_item');
									?>
								</div>
							</div>
						</li>
					<?php endwhile; ?>
				</ul>
				<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('#sns-products-slider-<?php echo $uq; ?> ul').owlCarousel({
						items: 1,
						loop: true,
			            dots: false,
					    autoplay: true,
					    autoplayHoverPause:true,
			            onInitialized: callback,
			            slideSpeed : 800,
			            animateOut: 'fadeOut',
					});
					function callback(event) {
			   			if(this._items.length > this.options.items){
					        jQuery('#sns-products-slider-<?php echo $uq; ?> .navslider').show();
					    }else{
					        jQuery('#sns-products-slider-<?php echo $uq; ?> .navslider').hide();
					    }
					}
					jQuery('#sns-products-slider-<?php echo $uq; ?> .navslider .prev').on('click', function(e){
						e.preventDefault();
						jQuery('#sns-products-slider-<?php echo $uq; ?> ul').trigger('prev.owl.carousel');
					});
					jQuery('#sns-products-slider-<?php echo $uq; ?> .navslider .next').on('click', function(e){
						e.preventDefault();
						jQuery('#sns-products-slider-<?php echo $uq; ?> ul').trigger('next.owl.carousel');
					});
				});
			</script>
			</div>
		</div>
		<?php
	endif;
	$output .= ob_get_clean();
	wp_reset_postdata();
}
echo $output;
