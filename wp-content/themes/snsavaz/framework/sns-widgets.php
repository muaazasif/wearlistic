<?php
/**
 * SNSAVAZ_Widget_About_Me widget class
 */
class SNSAVAZ_Widget_About_Me extends WP_Widget {

	function __construct(){
		parent::__construct(
			'SNSAVAZ_Widget_About_Me',
			esc_html__( 'SNS - About Me', 'snsavaz' ),
			array( "description" => esc_html__("Display author info", 'snsavaz') )
		);
	}

	function widget( $args, $instance ) {
		$output = '';

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'About Simen','snsavaz' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$output .= $args['before_widget'];
		if ( $title ) {
			$output .= $args['before_title'] . esc_html($title) . $args['after_title'];
		}
		$about_author 	= ( ! empty( $instance['about_author'] ) ) ? ( $instance['about_author'] ) : '';

		$author_socials = array(
			'facebook' => ( ! empty( $instance['facebook'] ) ) ? strip_tags($instance['facebook']) : '',
			'twitter' => ( ! empty( $instance['twitter'] ) ) ? strip_tags($instance['twitter']) : '',
			'google-plus' => ( ! empty( $instance['google-plus'] ) ) ? strip_tags($instance['google-plus']) : '',
			'pinterest' => ( ! empty( $instance['pinterest'] ) ) ? strip_tags($instance['pinterest']) : '',
			'youtube' => ( ! empty( $instance['youtube'] ) ) ? strip_tags($instance['youtube']) : '',
			'linkedin' => ( ! empty( $instance['linkedin'] ) ) ? strip_tags($instance['linkedin']) : '',
			'tumblr' => ( ! empty( $instance['tumblr'] ) ) ? strip_tags($instance['tumblr']) : '',
			'flickr' => ( ! empty( $instance['flickr'] ) ) ? strip_tags($instance['flickr']) : ''
		);

		// Return HTML
		ob_start();
		?>
		<div class="block-sns-abount-me">
			
			<div class="sns-abount-content">
				<?php if( trim($about_author) != '' ) echo '<p>' . esc_html($about_author). '</p>';?>
				
				<div class="sns-abount-account">
					<?php 
                    	foreach ($author_socials as $key => $value){
                    		if( $value )
                    		echo '<a href="'.esc_url($value).'" target="_blank"><i class="fa fa-'.$key.'"></i> </a>';
                    	}
                    ?>
				</div>
				
			</div>
        </div><!-- /.block-sns-abount-me -->
		<?php 
		$output .= ob_get_contents();
		ob_end_clean();
		
		$output .= $args['after_widget'];

		echo $output;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['about_author'] 	=  $new_instance['about_author'];
		
		$instance['facebook'] 		=  $new_instance['facebook'];
		$instance['twitter'] 		=  $new_instance['twitter'];
		$instance['google-plus'] 	=  $new_instance['google-plus'];
		$instance['pinterest'] 		=  $new_instance['pinterest'];
		$instance['youtube'] 		=  $new_instance['youtube'];
		$instance['linkedin'] 		=  $new_instance['linkedin'];
		$instance['tumblr'] 		=  $new_instance['tumblr'];
		$instance['flickr'] 		=  $new_instance['flickr'];

		return $instance;
	}

	function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'About Simen';
		$about_author 	= isset( $instance['about_author'] ) ? esc_textarea( $instance['about_author'] ) : ''; //texteditor - About me content
		
		// 
		$author_socials = array(
			'facebook' => isset( $instance['facebook'] ) ? strip_tags($instance['facebook']) : '',
			'twitter' => isset( $instance['twitter'] ) ? strip_tags($instance['twitter']) : '',
			'google-plus' => isset( $instance['google-plus'] ) ? strip_tags($instance['google-plus']) : '',
			'pinterest' => isset( $instance['pinterest'] ) ? strip_tags($instance['pinterest']) : '',
			'youtube' => isset( $instance['youtube'] ) ? strip_tags($instance['youtube']) : '',
			'linkedin' => isset( $instance['linkedin'] ) ? strip_tags($instance['linkedin']) : '',
			'tumblr' => isset( $instance['tumblr'] ) ? strip_tags($instance['tumblr']) : '',
			'flickr' => isset( $instance['flickr'] ) ? strip_tags($instance['flickr']) : ''
		);
		
?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'snsavaz' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>

		<p><label for="<?php echo  esc_attr($this->get_field_id( 'about_author' )); ?>"><?php esc_html_e( 'About me:', 'snsavaz' ); ?></label>
			<br/><i><?php echo esc_html_e( 'About me content', 'snsavaz' ); ?></i><br/>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id('about_author')); ?>" name="<?php echo esc_attr($this->get_field_name('about_author')); ?>"><?php echo esc_html($about_author); ?></textarea>
		</p>
		
		<?php // Social accounts text fields
		foreach ( $author_socials as $key => $value ): ?>
		
			<p><label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php echo esc_attr( $key ). ' URL:'; ?></label>
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( $key )); ?>" name="<?php echo esc_attr($this->get_field_name( $key )); ?>" type="text" value="<?php echo esc_html($value); ?>" /></p>
		
		<?php
		endforeach;
		?>
<?php
	}
}
/*
 * Register Wiget
*/
function SNSAVAZ_Widget_About_Me_Register(){
	register_widget('SNSAVAZ_Widget_About_Me');
}
//add_action('widgets_init', 'SNSAVAZ_Widget_About_Me_Register');

/**
 * SNSAVAZ_Widget_Testimonial widget class
 */
class SNSAVAZ_Widget_Testimonial extends WP_Widget {

	function __construct(){
		parent::__construct(
			'SNSAVAZ_Widget_Testimonial',
			esc_html__( 'SNS - Testimonial', 'snsavaz' ),
			array( "description" => esc_html__("Display Testimonial", 'snsavaz') )
		);
	}

	function widget( $args, $instance ) {
		wp_enqueue_script('owlcarousel');
		$output = '';

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Testimonial','snsavaz' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$autoplay 	= ( ! empty( $instance['autoplay'] ) ) ? $instance['autoplay'] : 'false';

		$output .= $args['before_widget'];
		if ( $title ) {
			$output .= $args['before_title'] . esc_html($title) . $args['after_title'];
		}
		
		$uq = rand().time();
		$args_testi = array(
			'post_type' => 'testimonial',
			'posts_per_page' => -1
		);
		$brand = new WP_Query($args_testi);
		
		if ( $brand->have_posts() ) :
			ob_start();
			?>
				<div id="sns_testimonial_widget<?php echo esc_attr($uq); ?>" class="sns-testimonial-widget">
					<div class="testimonial-widget-content">
						<ul class="clearfix">
							<?php 
							while ( $brand->have_posts() ) : $brand->the_post(); ?>
							<li>
								<div class="quote-content"><i class="fa fa-quote-left"></i><?php the_content(); ?><i class="fa fa-quote-right"></i></div>
								<?php
								$title = get_the_title();
								$sub_title = get_post_meta(get_the_ID(), 'snsavaz_testisub', true);
								if( $sub_title != '')
									$title = $title . '<span>'.$sub_title.'</span>';
								?>
								<div class="sns-test-title"><?php echo esc_html($title); ?></div>
							</li>
							<?php 
							endwhile;?>
						</ul>
					</div>
					<div class="navslider">
						<span class="prev"><i class="fa fa-long-arrow-left"></i></span>
						<span class="next"><i class="fa fa-long-arrow-right"></i></span>
					</div>
					<script type="text/javascript">
						jQuery(document).ready(function(){
							jQuery('#sns_testimonial_widget<?php echo $uq;?> ul').owlCarousel({
								items: 1,
								loop: true,
					            dots: false,
					            nava: false,
							    autoplay: <?php echo esc_js($autoplay); ?>,
					            onInitialized: callback,
					            slideSpeed : 800
							});
			
							function callback(event) {
								if(this._items.length > this.options.items){
							        jQuery('#sns_testimonial_widget<?php echo $uq;?> .navslider').show();
							    }else{
							        jQuery('#sns_testimonial_widget<?php echo $uq;?> .navslider').hide();
							    }
							}
							jQuery('#sns_testimonial_widget<?php echo $uq;?> .navslider .prev').on('click', function(e){
								e.preventDefault();
								jQuery('#sns_testimonial_widget<?php echo $uq;?> ul').trigger('prev.owl.carousel');
							});
							jQuery('#sns_testimonial_widget<?php echo $uq;?> .navslider .next').on('click', function(e){
								e.preventDefault();
								jQuery('#sns_testimonial_widget<?php echo $uq;?> ul').trigger('next.owl.carousel');
							});
						});
					</script>
				</div>
			<?php
			$output .= ob_get_clean();
			wp_reset_postdata();
		endif;
		
		$output .= $args['after_widget'];

		echo $output;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 	= strip_tags($new_instance['title']);
		$instance['autoplay']  = $new_instance['autoplay'];
		
		return $instance;
	}

	function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'Testimonial';
		$autoplay  = isset( $instance['autoplay'] ) ? esc_attr( $instance['autoplay'] ) : 'true';
?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'snsavaz' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'autoplay' )); ?>"><?php esc_html_e( 'Autoplay:', 'snsavaz' ); ?></label>
			<select  class="widefat" name="<?php echo esc_attr($this->get_field_name( 'autoplay' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'autoplay' )); ?>">
				<option value="true" <?php selected($autoplay, 'true', true)?>><?php esc_html_e('Yes', 'snsavaz')?></option>
				<option value="false" <?php selected($autoplay, 'false', true)?>><?php esc_html_e('No', 'snsavaz')?></option>
			</select>
		</p>
<?php
	}
}
/*
 * Register Wiget
*/
function SNSAVAZ_Widget_Testimonial_Register(){
	register_widget('SNSAVAZ_Widget_Testimonial');
}
add_action('widgets_init', 'SNSAVAZ_Widget_Testimonial_Register');


/**
 * SNSAVAZ_Widget_Products widget class
 */
class SNSAVAZ_Widget_Products extends WP_Widget {

	function __construct(){
		parent::__construct(
			'SNSAVAZ_Widget_Products',
			esc_html__( 'SNS - Products', 'snsavaz' ),
			array( "description" => esc_html__("Display products", 'snsavaz') )
		);
	}

	function widget( $args, $instance ) {
		$output = '';
		$uq = rand().time();

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Latest posts','snsavaz' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		
		$type 	= ( ! empty( $instance['type'] ) ) ? $instance['type'] : 'recent';
		$number_display 	= ( ! empty( $instance['number_display'] ) ) ? (int)$instance['number_display'] : 4;
		$number_limit 	= ( ! empty( $instance['number_limit'] ) ) ? (int)$instance['number_limit'] : 10;
		$autoplay 	= ( ! empty( $instance['autoplay'] ) ) ? $instance['autoplay'] : 'false';

		$output .= $args['before_widget'];
		
		$output .= $args['before_title'] . esc_html($title) . $args['after_title'];

		if( class_exists('WooCommerce') ){
			global $woocommerce;
			$loop = snsavaz_woo_query($type, $number_display);
		
			$uq = rand().time();
			if( $loop->have_posts() ) :
				$output .= '<div id="sns_widget_products'.esc_attr( $uq ).'" class="sns-widget-products woocommerce sns-products sns-products-style-two">';
					ob_start();
					?>
					<div class="navslider"><span class="prev"><i class="fa fa-long-arrow-left"></i></span><span class="next"><i class="fa fa-long-arrow-right"></i></span></div>
					<ul class="widget_products product_list grid zoomOut">
						<?php
						$i = 0;
						while ( $loop->have_posts() ) : $loop->the_post();
							if($i == 0):?>
							<li class="item product">
							<?php
							endif;
						    	wc_get_template( 'vc/item.php' );
					    	if($i == $number_display):?>
		    		    	</li>
		    		    	<?php
		    		    	endif;
		    		    	$i++;
		    		    	if( $i == $number_display) $i = 0;
						endwhile; ?>
					</ul>
					<?php
					$output .= ob_get_clean();
				$output .= '</div>';
			endif;
			wp_reset_postdata();
		}
		
		$output .= $args['after_widget'];

		echo $output;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['type'] 			=  $new_instance['type'];
		$instance['number_display'] =  (int)$new_instance['number_display'] == 0 ? 4 : (int)$new_instance['number_display'];
		

		return $instance;
	}

	function form( $instance ) {
		$title 	 		= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'Latest Products';
		$typer 			= isset( $instance['type'] ) ? esc_attr( $instance['type'] ) : 'recent';
		$number_display = isset( $instance['number_display'] ) ? esc_attr( $instance['number_display'] ) : '4';
		
		
?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'snsavaz' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'type' )); ?>"><?php esc_html_e( 'Type:', 'snsavaz' ); ?></label>
			<select  class="widefat" name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'type' )); ?>">
				<option value="recent" <?php selected($typer, 'recent', true)?>><?php esc_html_e('Latest Products', 'snsavaz') ?></option>
				<option value="best_selling" <?php selected($typer, 'best_selling', true)?>><?php esc_html_e('BestSeller Products', 'snsavaz') ?></option>
				<option value="top_rate" <?php selected($typer, 'top_rate', true)?>><?php esc_html_e('Top Rated Products', 'snsavaz') ?></option>
				<option value="on_sale" <?php selected($typer, 'on_sale', true)?>><?php esc_html_e('Special Products', 'snsavaz') ?></option>
				<option value="featured_product" <?php selected($typer, 'featured_product', true)?>><?php esc_html_e('Featured Products', 'snsavaz') ?></option>
				<option value="recent_review" <?php selected($typer, 'recent_review', true)?>><?php esc_html_e('Recent Review', 'snsavaz') ?></option>
			</select>
		</p>
		
		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'number_display' )); ?>"><?php esc_html_e( 'Number of products to show:', 'snsavaz' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number_display' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number_display' )); ?>" type="text" value="<?php echo esc_html($number_display); ?>" /></p>
		
<?php
	}
}
/*
 * Register Wiget
*/
function SNSAVAZ_Widget_Products_Register(){
	register_widget('SNSAVAZ_Widget_Products');
}
add_action('widgets_init', 'SNSAVAZ_Widget_Products_Register');

/**
 * SNSAVAZ_Widget_Product_Countdown widget class
 */
class SNSAVAZ_Widget_Product_Countdown extends WP_Widget {

	function __construct(){
		parent::__construct(
			'SNSAVAZ_Widget_Product_Countdown',
			esc_html__( 'SNS - Product Sale Countdown', 'snsavaz' ),
			array( "description" => esc_html__("Display the sale will end at the beginning of the set date.", 'snsavaz') )
		);
	}

	function widget( $args, $instance ) {
		$output = '';
		$uq = rand().time();

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Deal of day','snsavaz' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$product_id = ( ! empty( $instance['product_id'] ) ) ? (int)$instance['product_id'] : '';
		
		// Get the Sale Price Date To of the product
		$sale_price_dates_to 	= ( $date = get_post_meta( $product_id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y/m/d', $date ) : '';
		
		/** set sale price date to default 10 days for http://demo.snstheme.com/ */
		if($_SERVER['SERVER_NAME'] == 'demo.snstheme.com' || $_SERVER['SERVER_NAME'] == 'dev.snsgroup.me' ){
			if($sale_price_dates_to == 0)
				$sale_price_dates_to = date('Y/m/d', strtotime('+10 days'));
		}
		
		$output .= $args['before_widget'];

		$output .= $args['before_title'] . esc_html($title) . $args['after_title'];

		if( class_exists('WooCommerce') ){
			if($sale_price_dates_to == ''){ // Return if is blank
				echo '<div class="alert-danger">'.esc_html__('May be the Scheduled Sale End Date of this product is not set.', 'snsavaz') . '</div>';
				return '';
			}
			
			$uq = rand().time();
			
			$output .= '<div id="sns_widget_product_sale_countdown'.esc_attr( $uq ).'" class="sns_widget_product_sale_countdown">';
			ob_start();
			?>		<div class="sns_sale_countdown_thumb">
						<?php
						if( has_post_thumbnail($product_id) ):?>
							<a href="<?php echo esc_url(get_permalink($product_id)); ?>" title="<?php echo esc_attr( get_the_title($product_id) );?>">
								<?php
								echo get_the_post_thumbnail($product_id);
								?>
							</a>
							<?php
						endif;
						?>
					</div>
					<div class="sns_sale_countdown">
						<div class="sns_sale_clock"></div>
						<div class="sns_sale_more"><a href="<?php echo esc_url(get_permalink($product_id)); ?>" title="<?php esc_attr_e('Click here', 'snsavaz');?>"><?php esc_html_e('Click here', 'snsavaz');?></a></div>
					</div>
					<div class="sns_sale_countdown_title">
						<div class="sns_sale_title"><a href="<?php echo esc_url(get_permalink($product_id)); ?>" title="<?php echo esc_attr(get_the_title($product_id)); ?>"><?php echo get_the_title($product_id); ?></a></div>
						<div class="sns_sale_price">
							<?php
							$product = new WC_Product( $product_id );
							echo $product->get_price_html();
							?>
						</div>
					</div>
					<script type="text/javascript">
					jQuery(document).ready(function($){
						$('#sns_widget_product_sale_countdown<?php echo $uq;?> .sns_sale_clock').countdown('<?php echo $sale_price_dates_to; ?>', function(event) {
							$(this).html(event.strftime('%-D day%!D : %H : %M : %S'));
						});
					});
					</script>
			<?php
			$output .= ob_get_clean();
			$output .= '</div>';
			wp_reset_postdata();
		}
		
		$output .= $args['after_widget'];

		echo $output;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['product_id'] 	= esc_attr($new_instance['product_id']);
		

		return $instance;
	}

	function form( $instance ) {
		$title 	 		= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'Deal of day';
		$product_id		= isset( $instance['product_id'] ) ? esc_attr( $instance['product_id'] ) : '';
		
?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'snsavaz' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'product_id' )); ?>"><?php esc_html_e( 'Product ID:', 'snsavaz' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'product_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'product_id' )); ?>" type="text" value="<?php echo esc_html($product_id); ?>" />
			<span class="description"><?php esc_html_e('The ID of the product to get the form Sale Price Date To.', 'snsavaz'); ?></span>
		</p>

<?php
	}
}
/*
 * Register Wiget
*/
function SNSAVAZ_Widget_Product_Countdown_Register(){
	register_widget('SNSAVAZ_Widget_Product_Countdown');
}
//add_action('widgets_init', 'SNSAVAZ_Widget_Product_Countdown_Register');


/**
 * SNSAVAZ_Widget_Latest_Posts widget class
 */
class SNSAVAZ_Widget_Latest_Posts extends WP_Widget {

	function __construct(){
		parent::__construct(
			'SNSAVAZ_Widget_Latest_Posts',
			esc_html__( 'SNS - Latest Posts Slider', 'snsavaz' ),
			array( "description" => esc_html__("Display latest posts", 'snsavaz') )
		);
	}

	function widget( $args, $instance ) {
		wp_enqueue_script('owlcarousel');
		$output = '';
		$uq = rand().time();
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Latest posts','snsavaz' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		
		$show_author 	= ( ! empty( $instance['show_author'] ) ) ? $instance['show_author'] : 'show';
		$show_date 	= ( ! empty( $instance['show_date'] ) ) ? $instance['show_date'] : 'show';
		$number 	= ( ! empty( $instance['number'] ) ) ? $instance['number'] : 3;
		$autoplay 	= ( ! empty( $instance['autoplay'] ) ) ? $instance['autoplay'] : 'false';

		$output .= $args['before_widget'];
		if ( $title ) {
			$output .= $args['before_title'] . esc_html($title) . $args['after_title'];
		}
		
		$my_query = array(
			'post_type'      => 'post',
			'posts_per_page' => $number ,
			'order'          => 'DESC',
			'orderby'        => 'date',
			'ignore_sticky_posts' => true,
			'post_status'    => 'publish'
		);
		$latest_posts = new WP_Query($my_query);
		
		
		if( $latest_posts->have_posts() ) :
			$output .= '<div id="sns_latestpost_wd'.esc_attr( $uq ).'" class="sns-latest-posts-widget">';
				$output .= '<ul>';
					while ( $latest_posts->have_posts() ) : $latest_posts->the_post();
						$output .= '<li class="item-post">';
							if(has_post_thumbnail()):
								$output .= '<div class="post-thumb">';
									$output .= '<a class="post-author" href="'. esc_url(get_permalink()).'">';
										$output .= get_the_post_thumbnail(get_the_ID(), 'snsavaz_latest_posts');
									$output .= '</a>';
								$output .= '</div>';
							endif;
							$output .= '<div class="post-info">';
							if ( $show_date == 'show' )
								$output .= '<div class="item-date date"><span class="d-day">'. esc_html(get_the_date('j')) .'</span><span class="d-month">'. esc_html(get_the_date('M')) .'</span>'.
								'</div>';
							$output .= '<div class="info-inner">';
							if ( $show_author == 'show' )
								$output .= '<a class="post-author" href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )) .'">'.get_the_author_meta('nickname').'</a>';
							
							$output .= '<h4 class="post-title"><a href="'.esc_url(get_permalink()).'">'.get_the_title().'</a></h4>';
							$output .= '</div>';
							$output .= '</div>';
						$output .= '</li>';
					endwhile;
				
				$output .= '</ul>';
				$output .= '<div class="navslider"><span class="prev"><i class="fa fa-long-arrow-left"></i></span><span class="next"><i class="fa fa-long-arrow-right"></i></span></div>';
			$output .= '</div>';
			ob_start();
			?>
			<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('#sns_latestpost_wd<?php echo $uq;?> ul').owlCarousel({
					items: 1,
					loop:true,
			        dots: false,
				   	autoplay: <?php echo esc_js($autoplay); ?>,
			        onInitialized: callback,
			        slideSpeed : 600
				});
				function callback(event) {
						if(this._items.length > this.options.items){
				        jQuery('#sns_latestpost_wd<?php echo $uq;?> .navslider').show();
				    }else{
				        jQuery('#sns_latestpost_wd<?php echo $uq;?> .navslider').hide();
				    }
				}
				jQuery('#sns_latestpost_wd<?php echo $uq;?> .navslider .prev').on('click', function(e){
					e.preventDefault();
					jQuery('#sns_latestpost_wd<?php echo $uq;?> ul').trigger('prev.owl.carousel');
				});
				jQuery('#sns_latestpost_wd<?php echo $uq;?> .navslider .next').on('click', function(e){
					e.preventDefault();
					jQuery('#sns_latestpost_wd<?php echo $uq;?> ul').trigger('next.owl.carousel');
				});
			});
			</script>
			<?php
			$output .= ob_get_clean();
		endif;
		/* Restore original Post Data */
		wp_reset_postdata();
		$output .= $args['after_widget'];

		echo $output;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['show_author'] 	=  $new_instance['show_author'];
		$instance['show_date'] 		=  $new_instance['show_date'];
		$instance['number'] 		=  (int)$new_instance['number'] == 0 ? 3 : (int)$new_instance['number'];
		$instance['autoplay'] 		=  $new_instance['autoplay'];

		return $instance;
	}

	function form( $instance ) {
		$title 	 		= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'Latest posts';
		$show_author 	= isset( $instance['show_author'] ) ? esc_attr( $instance['show_author'] ) : 'show';
		$show_date 		= isset( $instance['show_date'] ) ? esc_attr( $instance['show_date'] ) : 'show';
		$number 		= isset( $instance['number'] ) ? esc_attr( $instance['number'] ) : '3';
		$autoplay  = isset( $instance['autoplay'] ) ? esc_attr( $instance['autoplay'] ) : 'true';
		
?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'snsavaz' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'show_author' )); ?>"><?php esc_html_e( 'Show Author:', 'snsavaz' ); ?></label>
			<select  class="widefat" name="<?php echo esc_attr($this->get_field_name( 'show_author' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'show_author' )); ?>">
				<option value="show" <?php selected($show_author, 'show', true)?>><?php esc_html_e('Show', 'snsavaz')?></option>
				<option value="hide" <?php selected($show_author, 'hide', true)?>><?php esc_html_e('Hide', 'snsavaz')?></option>
			</select>
		</p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>"><?php esc_html_e( 'Show Date:', 'snsavaz' ); ?></label>
			<select  class="widefat" name="<?php echo esc_attr($this->get_field_name( 'show_date' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>">
				<option value="show" <?php selected($show_date, 'show', true)?>><?php esc_html_e('Show', 'snsavaz')?></option>
				<option value="hide" <?php selected($show_date, 'hide', true)?>><?php esc_html_e('Hide', 'snsavaz')?></option>
			</select>
		</p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number Posts:', 'snsavaz' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_html($number); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'autoplay' )); ?>"><?php esc_html_e( 'Autoplay:', 'snsavaz' ); ?></label>
			<select  class="widefat" name="<?php echo esc_attr($this->get_field_name( 'autoplay' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'autoplay' )); ?>">
				<option value="true" <?php selected($autoplay, 'true', true)?>><?php esc_html_e('Yes', 'snsavaz')?></option>
				<option value="false" <?php selected($autoplay, 'false', true)?>><?php esc_html_e('No', 'snsavaz')?></option>
			</select>
		</p>
<?php
	}
}
/*
 * Register Wiget
*/
function SNSAVAZ_Widget_Latest_Posts_Register(){
	register_widget('SNSAVAZ_Widget_Latest_Posts');
}
add_action('widgets_init', 'SNSAVAZ_Widget_Latest_Posts_Register');


class SNSAVAZ_Widget_Facebook extends WP_Widget {
	public function __construct() {
		$widget_ops = array('description' => esc_html__( 'Display your facebook like box', 'snsavaz' ) );
		parent::__construct('sns_facebook', esc_html__('SNS - Facebook', 'snsavaz'), $widget_ops);
	}
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		echo wp_kses( $args['before_widget'], array(
				                                'aside' => array(
				                                    'id' => array(),
				                                    'class' => array()
				                                ),
				                            ) );
		if ( $title ) echo wp_kses( $args['before_title'] . esc_html($title) . $args['after_title'], array(
				                                'h3' => array(
				                                    'class' => array()
				                                ),
				                                'h4' => array(
				                                    'class' => array()
				                                ),
				                                'span' => array(
				                                    'class' => array()
				                                ),
				                            ) );

		$fanpageName = empty( $instance['fanpageName'] ) ? 'snstheme' : esc_html($instance['fanpageName']);
		?>
		<div class="content">
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-page" 
			data-href="https://www.facebook.com/<?php echo esc_html($fanpageName); ?>" 
			data-small-header="true" 
			data-adapt-container-width="true" 
			data-hide-cover="false" 
			data-show-facepile="true" 
			data-show-posts="false">
				<div class="fb-xfbml-parse-ignore">
					<blockquote cite="https://www.facebook.com/<?php echo esc_html($fanpageName); ?>">
						<a href="https://www.facebook.com/<?php echo esc_html($fanpageName); ?>"><?php echo esc_html($fanpageName); ?></a>
					</blockquote>
				</div>
			</div>
		</div>
		<?php
		echo wp_kses( $args['after_widget'], array(
				                                'aside' => array()
				                            ) );
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 
			'title' => 'SNS Facebook',
			'fanpageName' => 'snstheme',
			'numberDisplay' => '12',
		));
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['fanpageName'] = strip_tags($new_instance['fanpageName']);
		$instance['numberDisplay'] = strip_tags($new_instance['numberDisplay']);
		return $instance;
	}
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' => 'SNS Facebook',
			'fanpageName' => 'snstheme',
			'numberDisplay' => '12',
		) );
		$title = $instance['title'];
		$fanpageName = $instance['fanpageName'];
		$numberDisplay = $instance['numberDisplay'];
?>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
			<?php esc_html_e('Title:', 'snsavaz'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</label>
	</p>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id('fanpageName')); ?>">
			<?php esc_html_e('Fanpage Name:', 'snsavaz'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('fanpageName')); ?>" name="<?php echo esc_attr($this->get_field_name('fanpageName')); ?>" type="text" value="<?php echo esc_attr($fanpageName); ?>" />
		</label>
	</p>
<?php
	}
}

class SNSAVAZ_Widget_Recent_Post extends WP_Widget {
	
	function __construct(){
		$widget_ops = array('description' => esc_html__( 'Display recent posts', 'snsavaz' ) );
		parent::__construct('snsavaz_recentpost', esc_html__('SNS - Recent Post', 'snsavaz'), $widget_ops);
	}
	
	function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$number = esc_attr($instance['number']);
		
		echo wp_kses( $before_widget, array(
				                                'aside' => array(
				                                	'class' => array()
				                                )
				                            ) );

		if($title) {
			echo wp_kses( $before_title . esc_html($title) . $after_title, array(
				                                'h3' => array(
				                                    'class' => array()
				                                ),
				                                'h4' => array(
				                                    'class' => array()
				                                ),
				                                'span' => array(
				                                    'class' => array()
				                                ),
				                            ) );
		}
		?>
		<?php
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $number ,
			'order'          => 'DESC',
		    'orderby'        => 'date',
		    'ignore_sticky_posts' => true,
		    'post_status'    => 'publish'
		);
		$recent_posts = new WP_Query($args);
		if($recent_posts->have_posts()):
		?>
        <ul class="widget-posts">
		<?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
	        <li class="post-item">
			<?php if(has_post_thumbnail()): ?>
			<div class="post-img">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			    <?php the_post_thumbnail('snsavaz_latest_posts_widget'); ?>
				</a>
			</div>
			<?php endif; ?>
	        <div class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title() ?></a></div>
	        <!--<span class="post-date"><?php //echo get_the_date();?></span> -->
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
        </ul>
		<?php endif; ?>
     
		<?php echo wp_kses( $after_widget, array(
				                                'aside' => array()
				                            ) );
	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['title'] = esc_attr($new_instance['title']);
		$instance['number'] = esc_attr($new_instance['number']);
		
		return $instance;
	}

	function form($instance){
		$defaults = array('title' => 'Recent posts', 'number' => 4);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'snsavaz'); ?></label>
			<input class="widefat" type="text"  id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of items to show:', 'snsavaz'); ?></label>
			<input class="widefat" type="text"  id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" value="<?php echo esc_attr($instance['number']); ?>" />
		</p>
	<?php
	}
}

class SNSAVAZ_Widget_Icon_Box extends WP_Widget{

	function __construct(){
		parent::__construct(
			'SNSAVAZ_Widget_Icon_Box',
			esc_html__('SNS - Icon Box', 'snsavaz'),
			array('description' => esc_html__('Display a box with Awesome Icon, Title, Description.','snsavaz'))
		);
	}

	function widget($args, $instance){
		$html = '';

		$title = ( !empty( $instance['title'] ) ) ? $instance['title'] : esc_html__('Your Title Here...', 'snsavaz');
		$url = ( !empty( $instance['url'] ) ) ? $instance['url'] : '#';
		$icon = ( !empty( $instance['icon'] ) ) ? $instance['icon'] : 'fa fa-home';
		$desc = ( !empty( $instance['desc'] ) ) ? $instance['desc'] : '';

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$html .= esc_html($args['before_widget']);
		
		ob_start();
		?>
		<div class="sns_icon_box">
			<div class="sns_icon_left">
				<div><a href="<?php echo esc_url($url) ?>" target="_blank"><i class="<?php echo esc_attr($icon); ?>"></i></a></div>
			</div>
			<div class="sns_icon_content_right">
				<div>
					<?php 
					if($title){
						echo $args['before_title'] . '<a href="'.esc_url($url).'" target="_blank">'. esc_html($title) . '</a>' . $args['after_title'];
					}
					echo esc_html($desc);
					?>
				</div>
			</div>
		</div>
		<?php
		$html .= ob_get_contents();
		ob_end_clean();

		$html .= esc_html($args['after_widget']);

			
		echo $html;

	}

	function update($new_instance, $old_instance){
		$instance 			= $old_instance;
		$instance['title'] 	= strip_tags($new_instance['title']);
		$instance['icon'] 	= esc_attr($new_instance['icon']);
		$instance['url'] 	= esc_attr($new_instance['url']);
		$instance['desc'] 	= $new_instance['desc'];

		return $instance;
	}

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'url' => '#', 'icon' => 'fa fa-home', 'desc' => '' ) );
		$title = $instance['title'] ? strip_tags($instance['title']) : 'Your Title Here';
		$url = strip_tags($instance['url']);
		$icon = strip_tags($instance['icon']);
		$desc = esc_textarea($instance['desc']);
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:', 'snsavaz' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'url' )); ?>"><?php echo esc_html__( 'URL:', 'snsavaz' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'url' )); ?>" type="text" value="<?php echo esc_html($url); ?>" /></p>
		<p class="description"><?php echo esc_html__('External url for Title', 'snsavaz');?></p>
		</p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'icon' )); ?>"><?php echo esc_html__( 'Icon:', 'snsavaz' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon' )); ?>" type="text" value="<?php echo esc_html($icon); ?>" />
		<p class="description"><?php echo esc_html__('Use Font Awesome Icon. EX: fa fa-home', 'snsavaz');?></p>
		</p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'desc' )); ?>"><?php esc_html__( 'Description:', 'snsavaz'); ?></label>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id('desc')); ?>" name="<?php echo esc_attr($this->get_field_name('desc')); ?>"><?php echo esc_html($desc); ?></textarea></p>
		
	<?php
	}
	
}


class SNSAVAZ_Widget_Twitter extends WP_Widget {
	public function __construct() {
		$widget_ops = array('description' => esc_html__( 'Display your tweets', 'snsavaz' ) );
		parent::__construct('sns_twitter', esc_html__('SNS - Twitter', 'snsavaz'), $widget_ops);
	}
	public function widget( $args, $instance ) {
   		wp_enqueue_script('twitter-js', SNSAVAZ_THEME_URI . '/assets/js/twitterfetcher.min.js', array('jquery'), '', true );
   		
		$title 			= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$widgets_id 	= isset($instance['widgets_id']) ? $instance['widgets_id'] : '420187988887212033';
		$limit 			= isset($instance['limit']) ? $instance['limit'] : 3;
		$follow_link 	= isset($instance['follow_link']) ? $instance['follow_link'] : true;
		$account_name 	= isset($instance['account_name']) ? $instance['account_name'] : 'snstheme';
		$avartar 		= isset($instance['avartar']) ? $instance['avartar'] : false;
		$interact_link 	= isset($instance['interact_link']) ? $instance['interact_link'] : true;
		$date 			= isset($instance['date']) ? $instance['date'] : false;
		
		$uq = rand().time();
		$class  = "";
		$class .= ($avartar)?'':' no-avartar';
		$class .= ($follow_link)?'':' no-follow-link';
		$class .= ($interact_link)?'':' no-interact-link';
		$class .= ($date)?'':' no-date';
		
		echo wp_kses( $args['before_widget'], array(
				                                'aside' => array(
				                                	'class' => array(),
				                                	'id' => array()
				                                )
				                            ) );
		if ( $title ) echo wp_kses( $args['before_title'] . esc_html($title) . $args['after_title'], array(
				                                'h3' => array(
				                                    'class' => array()
				                                ),
				                                'h4' => array(
				                                    'class' => array()
				                                ),
				                                'span' => array(
				                                    'class' => array()
				                                ),
				                            ) );
		
		if($follow_link && $account_name != ''){ ?>
		<a class="follow-link" href="http://twitter.com/follow?user=<?php echo esc_attr($account_name); ?>">
			<span><?php echo esc_html__("Follow", 'snsavaz'); ?></span>
		</a>
		<?php
		}
		?>
		<div class="content">
			<div id="sns_twitter_<?php echo esc_attr( $uq ); ?>" class="sns-tweets <?php echo esc_attr($class); ?>"></div>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					var config5 = {
					  "id": '<?php echo $widgets_id; ?>',
					  "domId": '',
					  "maxTweets": <?php echo esc_attr($limit); ?>,
					  "enableLinks": true,
					  "showUser": <?php echo esc_attr($avartar); ?>,
					  "showTime": <?php echo esc_attr($date); ?>,
					  "dateFunction": '',
					  "showRetweet": false,
					  "customCallback": handleTweets,
					  "showInteraction": <?php echo esc_attr($interact_link); ?>
					};

					function handleTweets(tweets) {
					    var x = tweets.length;
					    var n = 0;
					    var element = document.getElementById('sns_twitter_<?php echo $uq; ?>');
					    var html = '<ul>';
					    while(n < x) {
					      html += '<li>' + tweets[n] + '</li>';
					      n++;
					    }
					    html += '</ul>';
					    element.innerHTML = html;
					}

					twitterFetcher.fetch(config5);
				});
			</script>
		</div>
		<?php
		
		echo wp_kses( $args['after_widget'], array(
				                                'aside' => array()
				                            ) );
	}
	public function update( $new_instance, $old_instance ) {
		$new_instance = (array) $new_instance;
		$instance = array( 
			'follow_link' => 0,
			'avartar' => 0,
			'interact_link' => 0,
			'date' => 0,
		);
		foreach ( $instance as $field => $val )
			if ( isset($new_instance[$field]) )
				$instance[$field] = 1;

		$instance['title'] = ! empty( $new_instance['title'] ) ? $new_instance['title'] : 'SNS Twitter';
		$instance['widgets_id'] = ! empty( $new_instance['widgets_id'] ) ? $new_instance['widgets_id'] : '420187988887212033';
		$instance['limit'] = ! empty( $new_instance['limit'] ) ? intval( $new_instance['limit'] ) : 3;
		$instance['account_name'] = ! empty( $new_instance['account_name'] ) ? $new_instance['account_name'] : 'snstheme';

		return $instance;
	}
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' => 'SNS Twitter',
			'widgets_id' => '420187988887212033',
			'limit' => 2,
			'follow_link' => false,
			'account_name' => 'snstheme',
			'avartar' => true,
			'interact_link' => false,
			'date' => true
		) );
		$title = $instance['title'];
		$widgets_id = $instance['widgets_id'];
		$limit = $instance['limit'];
		$follow_link = $instance['follow_link'];
		$account_name = $instance['account_name'];
		$avartar = $instance['avartar'];
		$interact_link = $instance['interact_link'];
		$date = $instance['date'];
?>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
			<?php esc_html_e('Title:', 'snsavaz'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</label>
	</p>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id('widgets_id')); ?>">
			<?php esc_html_e('Widgets Id:', 'snsavaz'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('widgets_id')); ?>" name="<?php echo esc_attr( $this->get_field_name('widgets_id') ); ?>" type="text" value="<?php echo esc_attr($widgets_id); ?>" />
		</label>
	</p>
	<p>
		<label for="<?php echo esc_attr($this->get_field_id('limit')); ?>">
			<?php esc_html_e('Tweets Count:', 'snsavaz'); ?>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('limit')); ?>" name="<?php echo esc_attr($this->get_field_name('limit')); ?>" type="text" value="<?php echo esc_attr($limit); ?>" />
		</label>
	</p>
	<p>
		<input class="checkbox" type="checkbox" <?php checked($instance['follow_link'], true) ?> id="<?php echo esc_attr($this->get_field_id('follow_link')); ?>" name="<?php echo esc_attr( $this->get_field_name('follow_link') ); ?>" />
		<label for="<?php echo esc_attr($this->get_field_id('follow_link')); ?>"><?php esc_html_e('Show follow link', 'snsavaz'); ?></label>
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id('account_name') ); ?>">
			<?php esc_html_e('Account Name:', 'snsavaz'); ?>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('account_name')); ?>" name="<?php echo esc_attr( $this->get_field_name('account_name')); ?>" type="text" value="<?php echo esc_attr($account_name); ?>" />
		</label>
	</p>
	<p>
		<input class="checkbox" type="checkbox" <?php checked($instance['interact_link'], true) ?> id="<?php echo esc_attr( $this->get_field_id('interact_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('interact_link') ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id('interact_link') ); ?>"><?php esc_html_e('Show interact link', 'snsavaz'); ?></label>
	</p>
	<p>
		<input class="checkbox" type="checkbox" <?php checked($instance['date'], true) ?> id="<?php echo esc_attr( $this->get_field_id('date') ); ?>" name="<?php echo esc_attr( $this->get_field_name('date') ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id('date') ); ?>"><?php esc_html_e('Show date', 'snsavaz'); ?></label>
	</p>
	<br />

	<?php
	}
}


if ( class_exists('YITH_Woocompare_Widget') ){
	class SNSAVAZ_Woocompare_Widget extends YITH_Woocompare_Widget {
		function widget( $args, $instance ) {
            global $yith_woocompare;

            /**
             * WPML Support
             */
            $lang = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : false;

            extract( $args );

            $localized_widget_title = function_exists( 'icl_translate' ) ? icl_translate( 'Widget', 'widget_yit_compare_title_text', $instance['title'] ) : $instance['title'];

            echo wp_kses( $before_widget . $before_title . $localized_widget_title . $after_title, array(
            									'div' => array(
				                                    'class' => array()
				                                ),
				                                'h3' => array(
				                                    'class' => array()
				                                ),
				                                'h4' => array(
				                                    'class' => array()
				                                ),
				                                'span' => array(
				                                    'class' => array()
				                                ),
				                            ) );
            ?>

            <ul class="products-list" data-lang="<?php echo esc_attr( $lang ); ?>">
                <?php echo $yith_woocompare->obj->list_products_html(); ?>
            </ul>

            <a href="<?php echo esc_url( $yith_woocompare->obj->remove_product_url('all') ) ?>" data-product_id="all" class="clear-all"><?php esc_html_e( 'Clear all', 'snsavaz' ) ?></a>
            <a href="<?php echo esc_url( add_query_arg( array( 'iframe' => 'true' ), $yith_woocompare->obj->view_table_url() ) ) ?>" class="compare button"><?php esc_html_e( 'Compare', 'snsavaz' ) ?></a>

            <?php echo wp_kses( $after_widget, array(
            									'div' => array()
				                            ) );
        }
	}
}
/**
 * SNSAVAZ_Widget_Text class
 */

/**
 * Core class used to implement a SNS Text widget.
 */
class SNSAVAZ_Widget_Text extends WP_Widget {
	
	function __construct(){
		parent::__construct(
			'SNSAVAZ_Widget_Text',
			esc_html__( 'SNS Text', 'snsavaz' ),
			array( "description" => esc_html__("Allow set image replace Title and Arbitrary text or HTML in content.", 'snsavaz') )
		);
	}

	
	public function widget( $args, $instance ) {

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		
		$image_url = ! empty( $instance['url'] ) ? $instance['url'] : '';
		
		$widget_text = ! empty( $instance['text'] ) ? $instance['text'] : '';

		/**
		 * Filter the content of the Text widget.
		 *
		 * @since 2.3.0
		 * @since 4.4.0 Added the `$this` parameter.
		 *
		 * @param string         $widget_text The widget content.
		 * @param array          $instance    Array of settings for the current widget.
		 * @param WP_Widget_Text $this        Current Text widget instance.
		 */
		$text = apply_filters( 'widget_text', $widget_text, $instance, $this );

		echo $args['before_widget'];
		if ( ! empty($image_url) ){
			echo $args['before_title'] . '<img src="'. esc_url($image_url) .'" alt="'.esc_attr($title).'"/>' . $args['after_title'];
		}
		elseif ( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html($title) . $args['after_title'];
		} ?>
			<div class="textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>
		<?php
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['url'] = sanitize_text_field( $new_instance['url'] );
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = wp_kses_post( stripslashes( $new_instance['text'] ) );
		$instance['filter'] = ! empty( $new_instance['filter'] );
		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'url' => '', 'text' => '' ) );
		$filter = isset( $instance['filter'] ) ? $instance['filter'] : 0;
		$title = sanitize_text_field( $instance['title'] );
		$url = sanitize_text_field( $instance['url'] );
		
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'snsavaz'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('url')); ?>"><?php esc_html_e('Image URL:', 'snsavaz'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('url')); ?>" name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" value="<?php echo esc_url($url); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'text' )); ?>"><?php esc_html_e( 'Content:', 'snsavaz' ); ?></label>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo esc_textarea( $instance['text'] ); ?></textarea></p>

		<p><input id="<?php echo esc_attr($this->get_field_id('filter')); ?>" name="<?php echo esc_attr($this->get_field_name('filter')); ?>" type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label for="<?php echo esc_attr($this->get_field_id('filter')); ?>"><?php esc_html_e('Automatically add paragraphs', 'snsavaz'); ?></label></p>
		<?php
	}
}

function snsavaz_load_widgets() {
    register_widget( 'SNSAVAZ_Widget_Facebook');
    register_widget( 'SNSAVAZ_Widget_Twitter');
    register_widget( 'SNSAVAZ_Widget_Recent_Post');
    register_widget( 'SNSAVAZ_Widget_Icon_Box');
    register_widget( 'SNSAVAZ_Widget_Text');
    if ( class_exists('WooCommerce') && class_exists('YITH_Woocompare_Widget') ) register_widget( 'SNSAVAZ_Woocompare_Widget');
}
add_action('widgets_init', 'snsavaz_load_widgets');

