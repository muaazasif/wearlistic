<?php
define( 'SNSAVAZ_THEME_DIR', get_template_directory() );
define( 'SNSAVAZ_THEME_URI', get_template_directory_uri() );

// Require framework
require_once( SNSAVAZ_THEME_DIR.'/framework/init.php' );
/** 
    Initialize Visual Composer in the theme.
 **/
add_action( 'vc_before_init', 'snsavaz_vcSetAsTheme' );
function snsavaz_vcSetAsTheme() {
	vc_set_as_theme(true);
}
// Initialising Visual shortcode editor
 if (class_exists('WPBakeryVisualComposerAbstract')) {
 	function snsavaz_requireVcExtend(){
 		include_once( SNSAVAZ_THEME_DIR . '/vc_extend/extend-vc.php' );
 	}
 	add_action('init', 'snsavaz_requireVcExtend', 2);
 }
/** 
 *	Width of content, it's max width of content without sidebar.
 **/
if ( ! isset( $content_width ) ) { $content_width = 660; }

/** 
 *	Set base function for theme.
 **/
if ( ! function_exists( 'snsavaz_setup' ) ) {
    function snsavaz_setup() {
        global $snsavaz_opt, $snsavaz_obj;
    	// Load default theme textdomain.
        load_theme_textdomain( 'snsavaz' , SNSAVAZ_THEME_DIR . '/languages' );
		// Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );
		// Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );
        // Add title-tag, it auto title of head
        add_theme_support( 'title-tag' );
        // Enable support for Post Formats.
        add_theme_support( 'post-formats',
            array(
                'video', 'audio', 'quote', 'link', 'gallery'
            )
        );
        // Register images size
        add_image_size('snsavaz_megamenu_thumb', 250, 150, true);
        add_image_size('snsavaz_blog_layout2_thumbnail_size', 720,480, true); // blog layout 2
        add_image_size('snsavaz_latest_posts', 370, 266, true);
        add_image_size('snsavaz_latest_posts_widget', 80, 53, true);
        add_image_size('snsavaz_testimonial_avatar', 120, 120, true);
        add_image_size('snsavaz_products_slider_thumb', 680, 530, false);
        
		//Setup the WordPress core custom background & custom header feature.
         $default_background = array(
            'default-color' => '#FFF',
        );
        add_theme_support( 'custom-background', $default_background );
        $default_header = array();
        add_theme_support( 'custom-header', $default_header );
        // Register navigations
	    register_nav_menus( array(
	    	'top_navigation'  => esc_html__( 'Top navigation', 'snsavaz' ),
			'main_navigation' => esc_html__( 'Main navigation', 'snsavaz' ),
		) );
    }
    add_action ( 'after_setup_theme', 'snsavaz_setup' );
}
add_action( 'after_setup_theme', 'snsavaz_woocommerce_support' );
function snsavaz_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_filter( 'body_class', 'snsavaz_bodyclass' );
function snsavaz_bodyclass( $classes ) {
    if ( snsavaz_themeoption('use_boxedlayout', 0) == 1) {
        $classes[] = 'boxed-layout';
    }
    if( snsavaz_themeoption('advance_tooltip', 1) == 1){
        $classes[] = 'use-tooltip';
    }
    if( snsavaz_themeoption('use_stickmenu') == 1){
        $classes[] = 'use_stickmenu';
    }
    if( snsavaz_themeoption('use_logocolor', 0) == 1){
        $classes[] = 'use_logocolor';
    }
    if ( snsavaz_themeoption('woo_uselazyload') == 1 ){
        $classes[] = 'use_lazyload';
    }
    $snsavaz_headerLayout = snsavaz_themeoption('header_layout', 'layout_1');
    if( snsavaz_metabox('snsavaz_header_layout') !='' ){
        $snsavaz_headerLayout = snsavaz_metabox('snsavaz_header_layout');
    }
    $classes[] = 'sns_header_' . $snsavaz_headerLayout;
    if(class_exists('WooCommerce')){
        $classes[] = 'woocommerce';
    }
    return $classes;
}

function snsavaz_widgetlocations(){
    // Register widgetized locations
    if(function_exists('register_sidebar')) {
        register_sidebar(array(
           'name' => 'Main Area',
           'id'   => 'widget-area',
            'description'   => esc_html__( 'These are widgets for the Widget Area.','snsavaz' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));
        
        register_sidebar(array(
	        'name' => 'Menu Sidebar #1',
	        'id'   => 'menu_sidebar_1',
	        'description'   => esc_html__( 'These are widgets for Mega Menu Columns style. This sidebar displayed in the right of column.','snsavaz' ),
	        'before_widget' => '<div class="sidebar-menu-widget %2$s">',
	        'after_widget'  => '</div>',
	        'before_title'  => '<h4 class="hide">',
	        'after_title'   => '</h4>'
        ));
        
        register_sidebar(array(
	        'name' => 'Menu Sidebar #2',
	        'id'   => 'menu_sidebar_2',
	        'description'   => esc_html__( 'These are widgets for Mega Menu Columns style. This sidebar displayed in the bottom of column.','snsavaz' ),
	        'before_widget' => '<div class="sidebar-menu-widget col-md-6 %2$s">',
	        'after_widget'  => '</div>',
	        'before_title'  => '<h4 class="hide">',
	        'after_title'   => '</h4>'
        ));
        
        register_sidebar(array(
           'name' => 'Footer Widgets',
           'id'   => 'footer-widgets',
            'description'   => esc_html__( 'These are widgets for the Footer.','snsavaz' ),
            'before_widget' => '<aside id="%1$s" class="widget widget-footer %2$s col-md-3 col-sm-6">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>'
        ));

        register_sidebar(
            array(
            'name' => 'Right Sidebar',
            'id' => 'right-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));

        register_sidebar(
            array(
            'name' => 'Left Sidebar',
            'id' => 'left-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));

        register_sidebar(
            array(
            'name' => 'Woo Sidebar',
            'id' => 'woo-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));
    }
}
add_action( 'widgets_init', 'snsavaz_widgetlocations' );
/** 
 *	Add styles & scripts
 **/
function snsavaz_scripts() {
	global $snsavaz_opt, $snsavaz_obj;
    $optimize = '.min';
	// Enqueue style
	$css_file = $snsavaz_obj->snsavaz_css_file();
	wp_enqueue_style('bootstrap', SNSAVAZ_THEME_URI . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('owlcarousel', SNSAVAZ_THEME_URI . '/assets/css/owl.carousel.min.css');
	wp_enqueue_style('fonts-awesome', SNSAVAZ_THEME_URI . '/assets/fonts/awesome/css/font-awesome.min.css');
    wp_enqueue_style('fonts-awesome-animation', SNSAVAZ_THEME_URI . '/assets/fonts/awesome/css/font-awesome-animation.min.css');
    wp_enqueue_style('snsavaz-ie9', SNSAVAZ_THEME_URI . '/assets/css/ie9.css');
    wp_enqueue_style('snsavaz-woocommerce', SNSAVAZ_THEME_URI . '/assets/css/woocommerce'.$optimize.'.css');
	wp_enqueue_style('snsavaz-theme-style', SNSAVAZ_THEME_URI . '/assets/css/' . $css_file);
	
	wp_register_script('owlcarousel', SNSAVAZ_THEME_URI . '/assets/js/owl.carousel.min.js', array('jquery'), '', true);
    wp_enqueue_script('owlcarousel');
	wp_register_script('masonry', SNSAVAZ_THEME_URI . '/assets/js/masonry.pkgd.min.js', array('jquery'), '', true);
	wp_register_script('imagesloaded', SNSAVAZ_THEME_URI . '/assets/js/imagesloaded.pkgd.min.js', array('jquery'), '', true);
	wp_register_script('countdown', SNSAVAZ_THEME_URI . '/assets/countdown/jquery.countdown.min.js', array('jquery'), '2.1.0', true);
    // Enqueue script
    wp_enqueue_script('bootstrap', SNSAVAZ_THEME_URI . '/assets/js/bootstrap.min.js', array('jquery'), '', true);
    wp_enqueue_script('bootstrap-tabdrop', SNSAVAZ_THEME_URI . '/assets/js/bootstrap-tabdrop.min.js', array('jquery'), '', true);
    if( snsavaz_themeoption('woo_uselazyload') == 1 ) wp_enqueue_script('lazyload', SNSAVAZ_THEME_URI . '/assets/js/jquery.lazyload'.$optimize.'.js', array(), '', true);
    wp_enqueue_script('snsavaz-script', SNSAVAZ_THEME_URI . '/assets/js/sns-script'.$optimize.'.js', array('jquery'), '', true);
    // IE
    wp_enqueue_script('html5shiv', SNSAVAZ_THEME_URI . '/assets/js/html5shiv.min.js', array('jquery'), '');
    wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');
    wp_enqueue_script('respond', SNSAVAZ_THEME_URI . '/assets/js/respond.min.js', array('jquery'), '');
    wp_script_add_data('respond', 'conditional', 'lt IE 9');
    // Add style inline with option in admin theme option
    wp_add_inline_style('snsavaz-theme-style', snsavaz_cssinline());
    // Code to embed the javascript file that makes the Ajax request
    wp_enqueue_script('ajax-request', SNSAVAZ_THEME_URI . '/assets/js/ajax.js', array('jquery'));
    // Code to declare the URL to the file handing the AJAX request
    $js_params = array(
    	'ajaxurl' => admin_url( 'admin-ajax.php' )
    );
    global $wp_query, $wp;
    $js_params['query_vars'] = $wp_query->query_vars;
    $js_params['current_url'] = esc_url(home_url($wp->request));
    
    wp_localize_script('ajax-request', 'sns', $js_params);
    
}
add_action( 'wp_enqueue_scripts', 'snsavaz_scripts' );

/*
 * Enqueue admin styles and scripts
 */
function snsavaz_admin_styles_scripts(){
	wp_enqueue_style('snsavaz_admin_style', SNSAVAZ_THEME_URI.'/admin/assets/css/admin-style.css');
	wp_enqueue_style( 'wp-color-picker' );
	
	wp_enqueue_media();
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script('snsavaz_admin_template_js', SNSAVAZ_THEME_URI.'/admin/assets/js/admin_template.js', array( 'jquery', 'wp-color-picker' ), false, true);
}
add_action('admin_enqueue_scripts', 'snsavaz_admin_styles_scripts');

// Editor style
add_editor_style('assets/css/editor-style.css');
/**
 * CSS inline
**/
function snsavaz_cssinline(){
    global $snsavaz_opt, $snsavaz_obj;
    $inline_css = '';
    // Body style
    $bodycss = '';
    if ($snsavaz_obj->snsavaz_getOption('use_boxedlayout') == 1) {
        if ($snsavaz_opt['body_bg_type'] == 'pantern') {
        	$body_bg_type_pantern = snsavaz_themeoption('body_bg_type_pantern', '');
            $bodycss .= 'background-image: url('.SNSAVAZ_THEME_URI.'/assets/img/patterns/'.$body_bg_type_pantern.');';
        }elseif( $snsavaz_opt['body_bg_type'] == 'img' ){
            $bodycss .= 'background-image: url('.$snsavaz_opt['body_bg_type_img']['url'].');';
        }
    }
    if(isset($snsavaz_opt['body_font']) && is_array($snsavaz_opt['body_font'])) {
        $body_font = '';
        foreach($snsavaz_opt['body_font'] as $propety => $value)
            if($value != 'true' && $value != 'false' && $value != '' && $propety != 'subsets')
                $body_font .= $propety . ':' . $value . ';';
        
        if($body_font != '') $bodycss .= $body_font;
    }
    $inline_css .= 'body {'.$bodycss.'}';
    // Selectors use google font
    if(isset($snsavaz_opt['secondary_font_target']) && $snsavaz_opt['secondary_font_target']) {
        if(isset($snsavaz_opt['secondary_font']) && is_array($snsavaz_opt['secondary_font'])) {
            $secondary_font = '';
            foreach($snsavaz_opt['secondary_font'] as $propety => $value)
                if($value != 'true' && $value != 'false' && $value != '' && $propety != 'subsets')
                    $secondary_font .= $propety . ':' . $value . ';';
            
            if($secondary_font != '') $inline_css .= $snsavaz_opt['secondary_font_target'] . ' {'.$secondary_font.'}';
        }
    }
    
    return $inline_css;
}

/*
 * Custom CSS theme
 */
if(!function_exists('snsavaz_wp_head')){
	function snsavaz_wp_head(){
		echo '<!-- Custom CSS -->
				<style type="text/css">';
			require SNSAVAZ_THEME_DIR . '/assets/css/custom.css.php';
			
		echo '</style>
			<!-- end custom css -->';
	}
	add_action('wp_head', 'snsavaz_wp_head', 1000);
}

/* 
 * Add tpl footer
 */
function snsavaz_tplfooter() {
    $output = '';
    ob_start();
    require SNSAVAZ_THEME_DIR . '/tpl-footer.php';
    $output = ob_get_clean();
    echo $output;
}
add_action('wp_footer', 'snsavaz_tplfooter');
/* 
 * Custom js to footer
 */
if(!function_exists('snsavaz_wp_foot')){
	function snsavaz_wp_foot(){
		// write out custom code
        $output = '';
        ob_start();
        ?>
		<script type="text/javascript">
        jQuery(document).ready(function(){
            <?php if( snsavaz_themeoption('tag_showmore', '1') == '1' ): ?>
		            if(jQuery('.widget_tag_cloud').length > 0){
						var $tag_display_first 	= <?php echo absint( snsavaz_themeoption('tag_display_first', 7) ) - 1?>;
						var $number_tags 		= jQuery('.widget_tag_cloud .tagcloud a').length;
						var $_this 				= jQuery('.widget_tag_cloud .tagcloud');
						var $view_all_tags		= "<?php echo esc_html__('View all tags', 'snsavaz');?>";
						var $hide_all_tags		= "<?php echo esc_html__('Hide all tags', 'snsavaz');?>";
						
						if( $number_tags > $tag_display_first ){
							jQuery('.widget_tag_cloud .tagcloud a:gt('+$tag_display_first+')').addClass('is_visible').hide();
							jQuery($_this).append('<div class="view-more-tag"><a href="#" title="">'+$view_all_tags+'</a></div>');
		
							jQuery('.widget_tag_cloud .tagcloud .view-more-tag a').click(function(){
								if(jQuery(this).hasClass('active')){
									if( jQuery($_this).find('a').hasClass('is_hidden') ){
										$_this.find('.is_hidden').removeClass('is_hidden').addClass('is_visible').stop().slideUp(300);
									}
									jQuery(this).removeClass('active');
									jQuery(this).html($view_all_tags);
									
								}else{
									if(jQuery($_this).find('a').hasClass('is_visible')){
										$_this.find('.is_visible').removeClass('is_visible').addClass('is_hidden').stop().slideDown(400);
									}
									jQuery(this).addClass('active');
									jQuery(this).html($hide_all_tags);
								}
								
								return false;
							});
						}
		            }
            <?php endif; ?>
            <?php echo snsavaz_themeoption('advance_customjs','');?>
        });
		</script>
        <?php
        $output = ob_get_clean();
        echo $output;
	}
	add_action('wp_footer', 'snsavaz_wp_foot', 100);
}

/** 
 *	Tile for page, post
 **/
function snsavaz_pagetitle(){
	// Disable title in page
	if( is_page() && function_exists('rwmb_meta') && rwmb_meta('snsavaz_showtitle') == '2' ) return;
	// Show title in page, single post
	if( is_single() || is_page() || ( is_home() && get_option( 'show_on_front' ) == 'page' ) ) : ?>
		<h1 class="page-header">
          <?php the_title(); ?>
        </h1>
    <?php 
    // Show title for category page
    elseif ( is_category() ) : ?>
        <h1 class="page-header">
          <?php single_cat_title(); ?>
        </h1>
    <?php
    // Author
    elseif ( is_author() ) : ?>
        <h1 class="page-header">
        <?php
            printf( esc_html__( 'All posts by: %s', 'snsavaz' ), get_the_author() );
        ?>
        </h1>
        <?php if ( get_the_author_meta( 'description' ) ) : ?>
        <header class="archive-header">
            <div class="author-description"><p><?php the_author_meta( 'description' ); ?></p></div>
        </header>
        <?php endif; ?>
    <?php 
    // Tag
    elseif ( is_tag() ) : ?>
        <h1 class="page-header">
            <?php printf( esc_html__( 'Tag Archives: %s', 'snsavaz' ), single_tag_title( '', false ) ); ?>
        </h1>
        <?php
        $term_description = term_description();
        if ( ! empty( $term_description ) ) : ?>
        <header class="archive-header">
            <?php printf( '<div class="taxonomy-description">%s</div>', $term_description ); ?>
        </header>
        <?php endif; ?>
    <?php 
    // Search
    elseif ( is_search() ) : ?>
    <h1 class="page-header"><?php printf( esc_html__( 'Search Results for: %s', 'snsavaz' ), get_search_query() ); ?></h1>
    <?php
    // Archive
    elseif ( is_archive() ) : ?>
        <?php the_archive_title( '<h1 class="page-header">', '</h1>' ); ?>
        <?php
        if( get_the_archive_description() ): ?>
        <header class="archive-header">
            <?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
        </header>
        <?php    
        endif;
        ?>
    <?php
    // Default
    else : ?>
        <h1 class="page-header">
          <?php the_title(); ?>
        </h1>
    <?php
	endif;
}


// Excerpt Function
if(!function_exists('snsavaz_excerpt')){
    function snsavaz_excerpt($limit, $afterlimit='...') {
        $limit = ($limit) ? $limit : 55 ;
        $excerpt = get_the_excerpt();
        if( $excerpt != '' ){
           $excerpt = explode(' ', strip_tags( $excerpt ), intval($limit));
        }else{
            $excerpt = explode(' ', strip_tags(get_the_content( )), intval($limit));
        }
        if ( count($excerpt) >= $limit ) {
            array_pop($excerpt);
            $excerpt = implode(" ",$excerpt).' '.$afterlimit;
        } else {
            $excerpt = implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
        return strip_shortcodes( $excerpt );
    }
}

/*
 * Ajax page navigation
 */
function snsavaz_ajax_load_next_page(){
	// Get current layout
	global $snsavaz_blog_layout, $snsavaz_obj;
	$snsavaz_blog_layout = isset($_POST['snsavaz_blog_layout']) ? esc_html($_POST['snsavaz_blog_layout']) : '';
	if( $snsavaz_blog_layout == '' ) $snsavaz_blog_layout = $snsavaz_obj->snsavaz_getOption('blog_type');
	
	// Get current page
	$page = $_POST['page'];
	
	// Number of published sticky posts
	$sticky_posts = snsavaz_get_sticky_posts_count();
	
	// Current query vars
	$vars = $_POST['vars'];
	
	// Convert string value into corresponding data types
	foreach ($vars as $key => $value){
		if( is_numeric($value) ) $vars[$key] = intval($value);
		if( $value == 'false' ) $vars[$key] = false;
		if( $value == 'true' ) $vars[$key] = true;
	}
	
	// Item template file 
	$template = $_POST['template'];
	
	// Return next page
	$page = intval($page) + 1;
	
	$posts_per_page = get_option('posts_per_page');
    if( $page == 2 && $vars['posts_per_page'] ){
        $offset = $vars['posts_per_page'];
    }else{
        $offset = $vars['posts_per_page'] + ($page - 2) * $posts_per_page;
    }
	
	/*
	 * This is confusing. Just leave it here to later reference
	 *
	
	 if(!$vars['ignore_sticky_posts']){
	 $offset += $sticky_posts;
	 }
	 *
	 */
	
	// Get more posts per page than necessary to detect if there are more posts
	$args = array('post_status'=>'publish', 'posts_per_page'=>$posts_per_page + 1, 'offset'=>$offset);
	$args = array_merge($vars, $args);
	
	// Remove unnecessary variables
	unset($args['paged']);
	unset($args['p']);
	unset($args['page']);
	unset($args['pagename']); // This is necessary in case Posts Page is set to static page
	
	$query = new WP_Query($args);
	
	$idx = 0;
	if( $query->have_posts() ){
		while ( $query->have_posts() ){
			$query->the_post();
			$idx = $idx + 1;
			if( $idx < $posts_per_page + 1 )
				get_template_part($template, get_post_format());
		}
		
		if( $query->post_count <= $posts_per_page ){
			// There are no more posts
			// Print a flag to detect
			echo '<div id="sns-load-more-no-posts" class="no-posts"><!-- --></div>';
		}
	}else{
		// No posts found
	}
	
	/* Restore original Post Data*/
	wp_reset_postdata();
	
	die('');
}
// When the request action is "load_more", the snsavaz_ajax_load_next_page() will be called
add_action('wp_ajax_load_more', 'snsavaz_ajax_load_next_page');
add_action('wp_ajax_nopriv_load_more', 'snsavaz_ajax_load_next_page');

// Word Limiter
function snsavaz_limitwords($string, $word_limit) {
    $words = explode(' ', $string);
    return implode(' ', array_slice($words, 0, $word_limit));
}
//
if(!function_exists('snsavaz_sharebox')){
    function snsavaz_sharebox( $layout='',$args=array() ){
        global $post, $snsavaz_obj;
        $default = array(
            'position' => 'top',
            'animation' => 'true'
            );
        $args = wp_parse_args( (array) $args, $default );
        
        $path = SNSAVAZ_THEME_DIR.'/tpl-sharebox';
        if( $layout!='' ){
            $path = $path.'-'.$layout;
        }
        $path .= '.php';

        if( is_file($path) ){
            require($path);
        }
 
    }
}
//
if(!function_exists('snsavaz_relatedpost')){
    function snsavaz_relatedpost(){
        global $post;
        if($post){
        	$post_id = $post->ID;
        }else{
        	// Return if cannot find any post
        }
        
        $relate_count = snsavaz_themeoption('related_num');
        $get_related_post_by = snsavaz_themeoption('related_posts_by');

        $args = array(
            'post_status' => 'publish',
            'posts_per_page' => $relate_count,
            'orderby' => 'date',
            'ignore_sticky_posts' => 1,
            'post__not_in' => array ($post_id)
        );
        
        if($get_related_post_by == 'cat'){
        	$categories = wp_get_post_categories($post_id);
        	$args['category__in'] = $categories;
        }else{
        	$posttags = wp_get_post_tags($post_id);
        	
        	$array_tags = array();
        	if($posttags){
        		foreach ($posttags as $tag){
        			$tags = $tag->term_id;
        			array_push($array_tags, $tags);
        		}
        	}
        	$args['tag__in'] = $array_tags;
        }
        
        $relates = new WP_Query( $args );
        
        $template_name = '/framework/tpl/posts/related_post.php';
        if(is_file(SNSAVAZ_THEME_DIR.$template_name)) {
            include(SNSAVAZ_THEME_DIR.$template_name);
        }
        
        wp_reset_postdata();
    }
}

/*
 * Function to display number of posts.
 */
function snsavaz_get_post_views($post_id){
	$count_key = 'post_views_count';
	$count = get_post_meta($post_id, $count_key, true);
	if($count == ''){
		delete_post_meta($post_id, $count_key);
		add_post_meta($post_id, $count_key, '0');
		return esc_html__('0 view', 'snsavaz');
	}
	return $count. esc_html__(' View', 'snsavaz');
}

/*
 * Function to count views.
 */
function snsavaz_set_post_views($post_id){
	$count_key = 'post_views_count';
	$count = get_post_meta($post_id, $count_key, true);
	if($count == ''){
		$count = 0;
		delete_post_meta($post_id, $count_key);
		add_post_meta($post_id, $count_key, '0');
	}else{
		$count++;
		update_post_meta($post_id, $count_key, $count);
	}
}


function snsavaz_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <?php $add_below = ''; ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
        <div class="comment-body">
        	<div class="comment-user-meta">
        		<?php echo get_avatar($comment, 50); ?>
        		<div>
        			<h4 class="comment-user"><?php echo get_comment_author_link(); ?></h4>
	            	<div class="comment-meta"><?php printf(esc_html__('%1$s at %2$s,', 'snsavaz'), get_comment_date(),  get_comment_time()) ?></div>
        		</div>
        	</div>
            <div class="comment-content">
            	<?php if ($comment->comment_approved == '0') : ?>
	            <p>
	                <em><?php echo esc_html__('Your comment is awaiting moderation.', 'snsavaz') ?></em><br />
	            </p>
	            <?php endif; ?>
	             <?php comment_text() ?>
	            <div class="reply">
	              <?php edit_comment_link(esc_html__('Edit', 'snsavaz'),'  ','') ?>
	              <?php comment_reply_link(array_merge( $args, array('reply_text' => esc_html__('Reply', 'snsavaz'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth'])))?>
	            </div>
            </div>
        </div>
  <?php 
}
/** 
 *	Breadcrumbs
 **/
function snsavaz_breadcrumbs(){
    $template_name = '/tpl-breadcrumb.php';
	if(is_file(SNSAVAZ_THEME_DIR.$template_name)) {
        include(SNSAVAZ_THEME_DIR.$template_name);
    }
}

/*
 * Woocommerce advanced search functionlity
 */
add_action('pre_get_posts', 'snsavaz_advanced_search_query', 1000);
function snsavaz_advanced_search_query($query){
	if($query->is_search()) {
		// Category terms search
		if( isset($_GET['snsavaz_woo_category']) && !empty($_GET['snsavaz_woo_category']) ){
			$query->set('tax_query', array(array(
				'taxonomy' 	=> 'product_cat',
				'field'		=> 'slug',
				'term'		=> array($_GET['snsavaz_woo_category']) )
			));
		}
	}
	return $query;
}

/* Sample data */
add_action( 'admin_enqueue_scripts', 'snsavaz_importlib' );
function snsavaz_importlib(){
    wp_enqueue_script('sampledata', SNSAVAZ_THEME_URI . '/framework/sample-data/assets/script.js', array('jquery'), '', true);
    wp_enqueue_style('sampledata-css', SNSAVAZ_THEME_URI . '/framework/sample-data/assets/style.css');
}
add_action( 'wp_ajax_sampledata', 'snsavaz_importsampledata' );
function snsavaz_importsampledata(){
    include_once(SNSAVAZ_THEME_DIR . '/framework/sample-data/sns-importdata.php');
    snsavaz_importdata();
}
?>