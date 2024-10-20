<?php
/**
 * SNS Get theme options - post meta.
 * This function to get the options in theme option and the page config.
 * The option in page config will priority than the option in theme option if set.
 * 
 * @param string $option ID of the option to get. Required.
 * @param string|int|null $default Return to default value. Optional.
 * @param string $key. Enter the key if the $option is an array. Default leave blank. Optional.
 * 					   This only support for theme option.
 * 
 * @return the value of theme option or page config. If the page config leave blank or "def" return theme option.
 */
function snsavaz_set_themeoption($key, $value){
	global $snsavaz_opt;
	if ( $key != '' && $value != '' )
		$snsavaz_opt[$key] = $value;
}
function snsavaz_themeoption($option, $default = '', $key = ''){
	global $snsavaz_obj;
	return $snsavaz_obj->snsavaz_getOption($option, $default, $key);
}

/*
 * get meta box data
 */
function snsavaz_metabox($field_id, $args = array()){
	if( !function_exists('rwmb_meta') ){
		return '';
	}
	if( function_exists('is_shop') && is_shop() ) {
		return rwmb_meta($field_id, $args, get_option('woocommerce_shop_page_id'));
	}
	return rwmb_meta($field_id, $args);
}
/**
 * return number of published sticky posts
 */
function snsavaz_get_sticky_posts_count(){
	global $wpdb;
	$sticky_posts = array_map('absint', (array)get_option('sticky_posts') );
	return count($sticky_posts) > 0 ? $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( 1 ) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' AND ID IN (".implode(',', $sticky_posts).")" ) ) : 0;
}

/**
 * Display Ajax loading
 * 
 * @param $content_div (string) ID of the DIV which contains items
 * @param $template (string) Name of the template file hold HTML for a single item.
 */
function snsavaz_paging_nav_ajax( $content_div = '#snsmain', $template = '' ){
	// Don't print empty markup if there is only one page.
	if( $GLOBALS['wp_query']->max_num_pages < 2 ){
		return;
	}
	
	?>
	<nav class="navigation-ajax" role="navigation">
		<a href="javascript:void(0)" data-target="<?php echo esc_attr($content_div);?>" data-template="<?php echo esc_attr($template); ?>" id="navigation-ajax" class="load-more">
			<span><?php echo esc_html__('Show more', 'snsavaz');?></span>
			<div class="sns-navloading"><div class="sns-navloader"></div></div>
		</a>
	</nav>
	<?php
}

/**
 * Display navigation to next/previous post when applicable.
 */
function snsavaz_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<div class="post-standard-navigation navigation post-navigation" role="navigation">
	    	<?php 
        	if( $previous ):
        	?>
	        <div class="nav-previous">
	            <div class="area-content">
	            	<?php
	            	previous_post_link('%link',''); // link overlay
	                ?>
	                <div class="nav-content">
	                	<?php 
	                		previous_post_link( '<div class="nav-post-link">%link</div>', _x( 'Previous post', 'Previous post link', 'snsavaz' ) );
						
							previous_post_link( '<div class="nav-post-title">%link</div>');?>
							
							<div class="nav-meta">
								<span class="nav-author"><i class="fa fa-user"></i><?php printf( wp_kses(__( '<a class="author-link" href="%s" ref="author">%s</a>', 'snsavaz' ), array(
																		'a' => array(
																			'href' => array(),
																			'class' => array(),
																			'ref' => array()
																		),
																		) ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),  get_the_author_meta('display_name') );?></span>
								<?php
			            		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
									echo '<span class="nav-comments-link"><i class="fa fa-comment"></i>';
									/* translators: %s: post title */
									comments_popup_link( esc_html__( '0 Comments','snsavaz' ),  esc_html__( '1 Comment','snsavaz' ), '%' . esc_html__(' Comments','snsavaz'));
									echo '</span>';
								}
								?>
							</div>
	                </div>
	            </div>
	        </div>
	        <?php endif; ?>
	        <?php if( $next ): ?>
	        <div class="nav-next">
	            <div class="area-content ">
	            	<?php
	            	next_post_link( '%link',''); // link overlay
	                ?>
	                <div class="nav-content">
	                	<?php 
	                		next_post_link( '<div class="nav-post-link">%link</div>', _x( 'Next post', 'Next post link', 'snsavaz' ) );
						
							next_post_link( '<div class="nav-post-title">%link</div>');?>
							
							<div class="nav-meta">
								<span class="nav-author"><i class="fa fa-user"></i><?php printf( wp_kses(__( '<a class="author-link" href="%s" ref="author">%s</a>', 'snsavaz' ), array(
																		'a' => array(
																			'href' => array(),
																			'class' => array(),
																			'ref' => array()
																		),
																		) ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),  get_the_author_meta('display_name') );?></span>
								<?php
			            		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
									echo '<span class="nav-comments-link"><i class="fa fa-comment"></i>';
									/* translators: %s: post title */
									comments_popup_link( esc_html__( '0 Comments','snsavaz' ),  esc_html__( '1 Comment','snsavaz' ), '%' . esc_html__(' Comments','snsavaz'));
									echo '</span>';
								}
								?>
							</div>
							
	                </div>
	            </div>
	        </div>
	        <?php endif; ?>
	</div>
	
	
	<?php
}

/*
 * snsavaz_featured_image_shop_page hook
 */
add_filter('snsavaz_featured_image_shop_page', 'snsavaz_featured_image_shop_page');
function snsavaz_featured_image_shop_page(){
	global $post;
	$page_id = '';
	if( is_shop() ){
		$page_id = woocommerce_get_page_id('shop');
		// Check has post thumbnai
		if(has_post_thumbnail($page_id)): // return html featured image shop page
		?>
			<div class="sns-shop-page-thumbnail"><?php echo get_the_post_thumbnail($page_id, 'full')?></div>
		<?php
		endif;
	}
}

if( !function_exists('sns_yith_woocompare') ){
	function sns_yith_woocompare(){
		global $product;
		if( class_exists( 'YITH_Woocompare' ) ) {
                $action_add = 'yith-woocompare-add-product';
                $url_args = array(
                    'action' => $action_add,
                    'id' => $product->id
                );
                ?>
                <a data-original-title="<?php echo esc_html( get_option('yith_woocompare_button_text') ); ?>" data-toggle="tooltip" href="<?php echo esc_url( wp_nonce_url( add_query_arg( $url_args ), $action_add ) ); ?>" class="compare btn btn-primary-outline" data-product_id="<?php echo esc_attr( $product->id ); ?>">
                </a>
        <?php }
	}
}

if( !function_exists('sns_yith_wcwl_add_to_wishlist') ){
	function sns_yith_wcwl_add_to_wishlist(){
		if( class_exists( 'YITH_WCWL' ) ) {
			echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
		}
	}
}