<?php
wp_enqueue_script('owlcarousel');
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

global $post;
$args = array(
	'post_status' => 'publish',
	'post_type' => 'post',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => (int)$number_limit,
	'ignore_sticky_posts' => 1,
);
 
$uq = rand().time();

$lp_query = new WP_Query( $args );

$class = 'sns-latest-posts pre-load ';
$class .= ( trim($extra_class)!='' )?' '.esc_attr($extra_class):'';
$class .= esc_attr($this->getCSSAnimation( $css_animation ));

if( $lp_query->have_posts() ) :
	$output .= '<div id="sns_latestpost'.$uq.'" class="'.$class.' '. esc_attr($template).'">';
	$output .= '<div class="wrapper-latest-posts">';
	if ( $title != '' ) $output .= '<h2 class="wpb_heading"><span>'.esc_attr($title).'</span></h2>';
	$output .= '<div class="navslider"><span class="prev"><i class="fa fa-long-arrow-left"></i></span><span class="next"><i class="fa fa-long-arrow-right"></i></span></div>';
	$output .= '</div>';
	$output .= '<ul>';
	while ( $lp_query->have_posts() ) : $lp_query->the_post();
		$output .= '<li class="item-post">';
			if($template == 'layout_2'){
			$output .= '<div class="post-content">';
			}
				if(has_post_thumbnail()):
				$output .= '<div class="post-thumb">';
					$output .= '<a class="post-author" href="'. esc_url(get_permalink()) .'">';
					$output .= get_the_post_thumbnail(get_the_ID(), 'snsavaz_latest_posts');
					$output .= '<i class="fa fa-link"></i></a>';
				$output .= '</div>';
				endif;
				$output .= '<div class="post-info">';
					$output .= '<div class="info-inner">';
						$output .= '<h4 class="post-title"><a href="'.esc_url( get_permalink() ).'">'.get_the_title().'</a></h4>';
						
						if($template == 'layout_2'){
						$output .= '<div class="post-excerpt">' . get_the_excerpt() . '</div>';
						}else{
						$output .= '<div class="post-excerpt">' . get_the_excerpt() . '<a href="'.esc_url( get_permalink() ).'" class="read-more" title="">'.esc_html__('Read more', 'snsavaz').'</a></div>';
						}
						
						if ( $show_author == 'show' || $show_comment == 'show'){
						$output .= '<div class="latest-post-meta-sc">';
						
						if($show_author == 'show' && $template != 'layout_2')
						$output .= '<span class="post-author"><i class="fa fa-user"></i><a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )) .'">'.get_the_author_meta('nickname').'</a></span>';
						
						$output .= '<span class="comment-count"><i class="fa fa-comment"></i>';
							$output .= '<span class="comments-link">';
							/* translators: %s: post title */
							ob_start();
							comments_popup_link( esc_html__( '0 Comments','snsavaz' ),  esc_html__( '1 Comment','snsavaz' ), '%' . esc_html__(' Comments','snsavaz'));
							$output .= ob_get_clean();
							$output .= '</span>';
						$output .= '</span>';
						$output .= '</div>';
						}
						
						if($template == 'layout_2')
						$output .= '<div  class="read-more"><a href="'.esc_url( get_permalink() ).'" title="">'.esc_html__('Read more', 'snsavaz').'</a></div>';
							
					$output .= '</div>';
				$output .= '</div>';
			if($template == 'layout_2'){
			$output .= '</div>';
			}
		$output .= '</li>';
	endwhile;
	
	$output .= '</ul>';
	$output .= '</div>';
	ob_start();
	?>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#sns_latestpost<?php echo $uq;?>').removeClass('pre-load');

		var $items_display = '<?php echo ($template == 'layout_2') ? 2 : 3; ?>';
		jQuery('#sns_latestpost<?php echo $uq;?> ul').owlCarousel({
			items: $items_display,
			responsive : {
			    0 : { items: 1 },
			    480 : { items: 2 },
			    768 : { items: 2 },
			    992 : { items: $items_display },
			    1200 : { items: $items_display }
			},
			loop:true,
	        dots: false,
		    // autoplay: true,
	        onInitialized: callback,
	        slideSpeed : 800
		});
		function callback(event) {
				if(this._items.length > this.options.items){
		        jQuery('#sns_latestpost<?php echo $uq;?> .navslider').show();
		    }else{
		        jQuery('#sns_latestpost<?php echo $uq;?> .navslider').hide();
		    }
		}
		jQuery('#sns_latestpost<?php echo $uq;?> .navslider .prev').on('click', function(e){
			e.preventDefault();
			jQuery('#sns_latestpost<?php echo $uq;?> ul').trigger('prev.owl.carousel');
		});
		jQuery('#sns_latestpost<?php echo $uq;?> .navslider .next').on('click', function(e){
			e.preventDefault();
			jQuery('#sns_latestpost<?php echo $uq;?> ul').trigger('next.owl.carousel');
		});
	});
	</script>
	<?php
	$output .= ob_get_clean();
endif;
/* Restore original Post Data */
wp_reset_postdata();
echo $output;
