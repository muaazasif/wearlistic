<?php
if(class_exists('WooCommerce')){
	class snsavaz_Woocommerce{
		public static function getInstance(){
			static $_instance;
			if( !$_instance ){
				$_instance = new snsavaz_Woocommerce();
			}
			return $_instance;
		}
		public function __construct(){
			// Add Scripts
			add_action('wp_head', array($this, 'snsavaz_renderurlajax'), 15);
			add_action( 'wp_enqueue_scripts', array($this,'snsavaz_getscripts') );
			// Number product per page
			add_filter( 'loop_shop_columns', array($this, 'snsavaz_woo_shop_columns') );
			// Grid cols per row
			add_filter( 'loop_shop_per_page', array($this, 'snsavaz_woo_shop_perpage') );
			// Remove each style one by one
			add_filter( 'woocommerce_enqueue_styles', array($this, 'snsavaz_dequeue_woostyles') );
			// Set modeview
			add_action( 'wp_ajax_sns_setmodeview', array($this,'snsavaz_set_modeview') );
			add_action( 'wp_ajax_nopriv_sns_setmodeview', array($this,'snsavaz_set_modeview') );
			// Ajax load more
			add_action('wp_ajax_sns_wooloadmore', array($this, 'snsavaz_woo_loadmore'));
			add_action('wp_ajax_nopriv_sns_wooloadmore', array($this, 'snsavaz_woo_loadmore'));
			
			// Ajax load more
			add_action('wp_ajax_sns_wootabloadproducts', array($this, 'snsavaz_woo_tab_load_products'));
			add_action('wp_ajax_nopriv_sns_wootabloadproducts', array($this, 'snsavaz_woo_tab_load_products'));

			remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
            add_action( 'woocommerce_before_shop_loop_item_title', 'snsavaz_product_thumbnail', 11 );

			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		}
		
		public function snsavaz_getscripts(){
            $optimize = '';
			wp_enqueue_script('sns-woocommerce', SNSAVAZ_THEME_URI.'/assets/js/sns-woocommerce'.$optimize.'.js', array('jquery'), '', true);
		}
		
		public function snsavaz_renderurlajax() {
		?>
			<script type="text/javascript">
				var ajaxurl = '<?php echo esc_js( admin_url('admin-ajax.php') ); ?>';
			</script>
			<?php
		}
		
		public function snsavaz_woo_loadmore(){
			$orderby        = $_POST['order'];
			$number_query   = $_POST['numberquery'];
			$start          = $_POST['start'];
			$list_cat       = $_POST['cat'];
			$col            = $_POST['col'];
			$eclass         = $_POST['eclass'];
			$loop = snsavaz_woo_query($orderby, $number_query, $list_cat, $start);
			while ( $loop->have_posts() ) : $loop->the_post();
			wc_get_template( 'vc/item-grid.php', array('col' => $col, 'animate' => 1, 'eclass' => $eclass) );
			endwhile;
			wp_die();
		}
		
		public function snsavaz_woo_tab_load_products(){
			
			$tab_args = array(
					'data_type'		=> $_POST['data_type'],
					'wrap_id'		=> $_POST['wrap_id'],
					'tab_id'		=> $_POST['tab_id'],
					'cat'			=> $_POST['cat'],
					'template'		=> $_POST['template'],
					'orderby'		=> $_POST['orderby'],
					'number_query'	=> $_POST['number_query'],
					'number_display'=> $_POST['number_display'],
					'number_limit'	=> $_POST['number_limit'],
					'effect_load'	=> $_POST['effect_load'],
					'col'			=> $_POST['col'],
					'uq'			=> $_POST['uq'],
					'number_load'	=> $_POST['number_load'],
					'eclass'		=> $_POST['eclass'],
					'animate'		=> 'yes',
				);
			
			wc_get_template( 'vc/template-tab.php', array('tab_args' => $tab_args) );
			wp_die();
		}

		public function snsavaz_set_modeview(){
			setcookie('sns_woo_list_modeview', $_POST['mode'] , time()+3600*24*100, '/');
		}
		public function snsavaz_woo_shop_columns( $columns ) {
			global $snsavaz_opt;
		    return $snsavaz_opt['woo_grid_col'];
		}
		public function snsavaz_woo_shop_perpage( $columns ) {
			global $snsavaz_opt;
		    return $snsavaz_opt['woo_number_perpage'];
		}
		
		public function snsavaz_dequeue_woostyles( $enqueue_styles ) {
			unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
			unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
			unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
			return $enqueue_styles;
		}
		
	}
	snsavaz_Woocommerce::getInstance();
    function snsavaz_cart_url(){
        global $woocommerce;
        return esc_url( $woocommerce->cart->get_cart_url() );
    }
    function snsavaz_cart_total(){
        global $woocommerce;
        return $woocommerce->cart->get_cart_total();
    }
    // Re-render rating
    add_filter( 'woocommerce_product_get_rating_html', 'snsavaz_get_rating_html', 100, 2 );
    function snsavaz_get_rating_html(){
        global $woocommerce, $product;
        if( $product && $product->get_average_rating() ) $rating = $product->get_average_rating();
        if( isset($rating) && $rating > 0){
        	$rating_html  = '<div class="star-rating" title="' . sprintf( esc_html__( 'Rated %s out of 5', 'snsavaz' ), $rating ) . '">';
    		$rating_html .= '<span class="value" data-width="' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . esc_html__( 'out of 5', 'snsavaz' ) . '</span>';
        }else{
        	$rating_html  = '<div class="star-rating">';
        }
    	$rating_html .= '</div>';
    	return $rating_html;
    }

    // Set template view mode
    function snsavaz_woo_modeview() {
    	global $snsavaz_opt;
    	wc_get_template( 'loop/modeview.php', array('modeview' => $snsavaz_opt['woo_list_modeview']) );
    }
    // Override quickview
    function snsavaz_woo_images_quickview() {
    	wc_get_template( 'single-product/product-image-quickview.php' );
    }

    function snsavaz_woo_query($type, $post_per_page=-1, $cat='', $offset=0, $paged=1){
        global $woocommerce;
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $post_per_page,
            'post_status' => 'publish',
        	'offset'            => $offset,
            'paged' => $paged
        );
        switch ($type) {
            case 'best_selling':
                $args['meta_key']='total_sales';
                $args['orderby']='meta_value_num';
                $args['ignore_sticky_posts']   = 1;
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'featured_product':
                $args['ignore_sticky_posts']=1;
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = array(
                             'key' => '_featured',
                             'value' => 'yes'
                         );
                $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'top_rate':
                add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'recent':
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                break;
            case 'on_sale':
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $args['post__in'] = wc_get_product_ids_on_sale();
                break;
            case 'recent_review':
                if($post_per_page == -1) $_limit = 4;
                else $_limit = $post_per_page;
                global $wpdb;
                $query = $wpdb->prepare( "
                    SELECT c.comment_post_ID 
                    FROM {$wpdb->prefix}posts p, {$wpdb->prefix}comments c 
                    WHERE p.ID = c.comment_post_ID AND c.comment_approved > %d 
                    AND p.post_type = %s AND p.post_status = %s
                    AND p.comment_count > %d ORDER BY c.comment_date ASC" ,
                    0, 'product', 'publish', 0 );
                $results = $wpdb->get_results($query, OBJECT);
                $_pids = array();
                foreach ($results as $re) {
                    if(!in_array($re->comment_post_ID, $_pids))
                        $_pids[] = $re->comment_post_ID;
                    if(count($_pids) == $_limit)
                        break;
                }

                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $args['post__in'] = $_pids;
                break;
        }

        if($cat!=''){
            $args['product_cat']= $cat;
        }
        return new WP_Query($args);
    }
    //
    add_action('woocommerce_single_product_summary', 'snsavaz_woo_addthis', 22);
    function snsavaz_woo_addthis(){
        global $snsavaz_opt;
        $html = '';
        if ( $snsavaz_opt['woo_sharebox'] == 1 ) {
            $html .= '
            <div class="addthis_toolbox addthis_default_style ">
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
            <a class="addthis_button_tweet"></a>
            <a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal"></a>
            <a class="addthis_counter addthis_pill_style"></a>
            </div>
            <script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-507b2455057cfd5f"></script>
            ';
        }
        echo wp_kses($html, array(
                                'div' => array(
                                    'class' => array(),
                                ),
                                'a' => array(
                                    'href' => array(),
                                    'class' => array(),
                                    'fb:like:layout' => array()
                                ),
                                'script' => array(
                                    'type' => array(),
                                    'src' => array()
                                ),
                            ) );
    }
    //
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    add_action('woocommerce_after_single_product_summary', 'snsavaz_relatedproducts', 20);
    function snsavaz_relatedproducts() {
        global $snsavaz_opt;
        if ( $snsavaz_opt['woo_related'] == '1' ) {
            $args = array(
                'posts_per_page' => $snsavaz_opt['woo_related_num'],
                'orderby' => 'rand'
            );
            woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
        }else{
            return;
        }
    }
    add_action( 'woocommerce_archive_description', 'snsavaz_woo_category_image', 2 );
    function snsavaz_woo_category_image() {
        if ( is_product_category() ){
            global $wp_query;
            $cat = $wp_query->get_queried_object();
           
            $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
            
            $image = wp_get_attachment_image_src($thumbnail_id, 'full');
            $image = isset($image[0]) ? $image[0] : '';
            if ( $image ) {
                echo '<p class="cate-img"><img src="' . esc_attr($image) . '" alt="" /></p>';
            }
        }
    }

    // Override thumbnail
    function snsavaz_post_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr) {
        if(snsavaz_themeoption('woo_uselazyload') == 1){
            $id = get_post_thumbnail_id();
            $src = wp_get_attachment_image_src($id, $size);
            $alt = get_the_title($id);
            $class = ( isset($attr['class']) ) ? $attr['class'] : '';
            if (strpos($class, 'lazy') !== false) {
                $html = '<img src="'.SNSAVAZ_THEME_URI.'/assets/img/prod_loading.gif" alt="'.$alt.'" data-original="' . $src[0] . '" class="' . $class . '" />';
            }
        }
        return $html;
    }
    add_filter('post_thumbnail_html', 'snsavaz_post_thumbnail_html', 99, 5);
    function snsavaz_product_thumbnail(){
        global $post;
        $size = 'shop_catalog';
        if ( has_post_thumbnail() ) {
            if( snsavaz_themeoption('woo_uselazyload') == 1 ){
                echo get_the_post_thumbnail( $post->ID, $size, array('class' => "lazy attachment-$size") );
            }else{
                echo get_the_post_thumbnail( $post->ID, $size );
            }
        } elseif ( wc_placeholder_img_src() ) {
            echo wc_placeholder_img( $size );
        }
    }
    
    function snsavaz_get_woocommerce_categories(){
    	$args = array(
    		'taxonomy' => 'product_cat'
    	);
    	 return get_categories($args);
    }
}

?>