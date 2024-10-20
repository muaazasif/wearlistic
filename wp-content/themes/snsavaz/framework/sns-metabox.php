<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://metabox.io/docs/registering-meta-boxes/
 */
add_filter( 'rwmb_meta_boxes', 'snsavaz_register_meta_boxes' );
/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @param array $meta_boxes List of meta boxes
 *
 * @return array
 */
function snsavaz_register_meta_boxes( $meta_boxes ){
	/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	wp_enqueue_script('sns-imgselect', SNSAVAZ_THEME_URI . '/framework/meta-box/sns-metabox.js', array('jquery'), '', true);
	$prefix = 'snsavaz_';
	global $wpdb, $snsavaz_opt;
	$revsliders =array();
	$revsliders[0] = 'Select a slider';
	if (is_plugin_active('revslider/revslider.php')) {
		$query = $wpdb->prepare("
			SELECT * 
			FROM {$wpdb->prefix}revslider_sliders 
			ORDER BY %s"
			, "ASC");
	    $get_sliders = $wpdb->get_results($query);
	    if($get_sliders) {
		    foreach($get_sliders as $slider) {
			   $revsliders[$slider->alias] = $slider->title;
		   }
	    }
	}
	//
	$default_layout = 'm-r';
	if ( isset($snsavaz_opt['blog_layout']) ) $default_layout = $snsavaz_opt['blog_layout'];
	//
	$siderbars = array();
	foreach ($GLOBALS['wp_registered_sidebars'] as $sidebars) {
		$siderbars[ $sidebars['id']] = $sidebars['name'];
	}
	// Layout config
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'sns_layout',
		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title'      => esc_html__( 'Layout Config', 'snsavaz' ),
		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
		'post_types' => array( 'page' ),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority'   => 'high',
		// Auto save: true, false (default). Optional.
		// 'autosave'   => true,
		// List of meta fields

		'fields'     => array(
			
			array(
				'name'        => esc_html__( 'Config layout for this page', 'snsavaz' ),
				'id'          => "{$prefix}enablelayoutconfig",
				'type'    => 'radio',
				'options' => array(
					'1' => esc_html__( 'Yes', 'snsavaz' ),
					'2' => esc_html__( 'No', 'snsavaz' ),
				),
				'std'         => '2',
				'desc'		  => esc_html__( 'Sellect Yes if you want config layout for this page', 'snsavaz' ),
			),
			// Layout Type
			array(
				'name'        => esc_html__( 'Layout Type', 'snsavaz' ),
				'id'          => "{$prefix}layouttype",
				'type'        => 'layouttype',
				// Array of 'value' => 'Label' pairs for select box
				'options'     => array(
					'm' => esc_html__( 'Without Sidebar', 'snsavaz' ),
					'l-m' => esc_html__( 'Use Left Sidebar', 'snsavaz' ),
					'm-r' => esc_html__( 'Use Right Sidebar', 'snsavaz' ),
					//'l-m-r' => esc_html__( 'Use Left & Right Sidebar', 'snsavaz' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => $default_layout,
				'placeholder' => esc_html__( '--- Select a layout type ---', 'snsavaz' ),
			),
			// Left Sidebar
			array(
				'name'  => esc_html__( 'Left Sidebar', 'snsavaz' ),
				'id'    => "{$prefix}leftsidebar",
				//'desc'  => esc_html__( 'Text description', 'snsavaz' ),
				'type'  => 'select',
				'options'	=> $siderbars,
				'multiple'	=> false,
				'std'		=> 'left-sidebar',
				'placeholder' => esc_html__( '--- Select a sidebar ---', 'snsavaz' ),
			),
			// Right Sidebar
			array(
				'name'  => esc_html__( 'Right Sidebar', 'snsavaz' ),
				'id'    => "{$prefix}rightsidebar",
				//'desc'  => esc_html__( 'Text description', 'snsavaz' ),
				'type'  => 'select',
				'options'	=> $siderbars,
				'multiple'	=> false,
				'std'		=> 'right-sidebar',
				'placeholder' => esc_html__( '--- Select a sidebar ---', 'snsavaz' ),
			),
		)
	);
	
	$menus = get_terms('nav_menu', array( 'hide_empty' => false ));
	$menu_options[''] = __('Default Menu...', 'snsavaz');
	foreach ( $menus as $menu ){
		$menu_options[$menu->term_id] = $menu->name;
	}
	
	// Page config
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'sns_pageconfig',
		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title'      => esc_html__( 'Page Config', 'snsavaz' ),
		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
		'post_types' => array( 'page' ),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority'   => 'high',
		// Auto save: true, false (default). Optional.
		// 'autosave'   => true,
		// List of meta fields

		'fields'     => array(
			array(
				'name'    => esc_html__( 'Header Layout', 'snsavaz' ),
				'id'       => "{$prefix}header_layout",
				'type'     => 'select',
				'std'  => '',
				'options'  => array(
					''  => esc_html__( 'Default', 'snsavaz' ),
					'layout_1'  => esc_html__( 'Layout 1', 'snsavaz' ),
					'layout_2'  => esc_html__( 'Layout 2', 'snsavaz' ),
					'layout_3'  => esc_html__( 'Layout 3', 'snsavaz' ),
				),
				'desc'		=> esc_html__('Select Header layout. Select "Default" to use in Theme Options.', 'snsavaz'),
			),
			
			array(
				'name'    => esc_html__( 'Main Navigation Menu', 'snsavaz' ),
				'id'       => "{$prefix}main_menu",
				'type'     => 'select',
				'std'  => 'def',
				'options'  => $menu_options,
				'desc' => esc_html__( 'Select which main menu displays on this page.', 'snsavaz' ),
			),
			array(
				'name'    => esc_html__( 'Show Title', 'snsavaz' ),
				'id'      => "{$prefix}showtitle",
				'type'    => 'radio',
				'options' => array(
					'1' => esc_html__( 'Yes', 'snsavaz' ),
					'2' => esc_html__( 'No', 'snsavaz' ),
				),
				'std'         => '1',
			),
			array(
				'name'    => esc_html__( 'Use Slideshow', 'snsavaz' ),
				'id'      => "{$prefix}useslideshow",
				'type'    => 'radio',
				'options' => array(
					'1' => esc_html__( 'Yes', 'snsavaz' ),
					'2' => esc_html__( 'No', 'snsavaz' ),
				),
				'std'         => '2',
			),
			array(
				'name'    => esc_html__( 'Select Slideshow', 'snsavaz' ),
				'id'      => "{$prefix}revolutionslider",
				'type'    => 'select',
				'options' =>  $revsliders ,
				'std'         => '',
			),
			array(
				'name'    => esc_html__( 'Show Breadcrumbs', 'snsavaz' ),
				'id'      => "{$prefix}showbreadcrump",
				'type'    => 'radio',
				'options' => array(
					'1' => esc_html__( 'Yes', 'snsavaz' ),
					'2' => esc_html__( 'No', 'snsavaz' ),
				),
				'std'         => '1',
				'desc' => esc_html__( 'Dont apply for Front page. Because breadcrumbs dont sense in Front page.', 'snsavaz' ),
			),
			// array(
			// 	'name' => esc_html__( 'Image background for menu wrapper', 'snsavaz' ),
			// 	'id'   => "{$prefix}menubg",
			// 	'type' => 'image_advanced',
			// 	'max_file_uploads' => 1,
			// 	'desc' => esc_html__( 'Default value in theme option - SNS Theme', 'snsavaz' ),
			// ),
			array(
				'name'    => esc_html__( 'Config Theme Color for this page?', 'snsavaz' ),
				'id'      => "{$prefix}page_themecolor",
				'type'    => 'radio',
				'options' => array(
					'1' => esc_html__( 'Yes', 'snsavaz' ),
					'2' => esc_html__( 'No', 'snsavaz' ),
				),
				'std'         => '2',
			),
			array(
				'name' => esc_html__( 'Sellect Theme Color', 'snsavaz' ),
				'id'   => "{$prefix}theme_color",
				'type' => 'color',
				'desc' => esc_html__( 'It will priority than Theme Color in Theme Option panel', 'snsavaz' ),
			),
		)
	);
	// Post format - Gallery
	$meta_boxes[] = array(
	    	'id' => 'sns-post-gallery',
		    'title' =>  esc_html__('Gallery Settings','snsavaz'),
	    	'description' => '',
    		'pages'      => array( 'post' ), // Post type
	    	'context'    => 'normal',
		    'priority'   => 'high',
	    	'fields' => array(
			     array(
			        'name'		=> 'Gallery Images',
			        'desc'	    => 'Upload Images for post Gallery ( Limit is 15 Images ).',
			        'type'      => 'image_advanced',
			        'id'	    => "{$prefix}post_gallery",
	         		'max_file_uploads' => 15 
	        	)
			)
	);
	// Post format - Video
    $meta_boxes[] = array(
		'id' => 'sns-post-video',
		'title' => esc_html__('Featured Video','snsavaz'),
		'description' => '',
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'fields' => array( 
		    array(
				'id'    => "{$prefix}post_video",
				'name'  => esc_html__( 'Video', 'snsavaz' ),
				'type'  => 'oembed',
				// Allow to clone? Default is false
				'clone' => false,
				// Input size
				'size'  => 50,
			)
		)
	);
	// Post format - Audio
    $meta_boxes[] = array(
		'id' => 'sns-post-audio',
		'title' => esc_html__('Featured Audio','snsavaz'),
		'description' => '',
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'fields' => array( 
		    array(
				'id'    => "{$prefix}post_audio",
				'name'  => esc_html__( 'Audio', 'snsavaz' ),
				'type'  => 'oembed',
				// Allow to clone? Default is false
				'clone' => false,
				// Input size
				'size'  => 50,
			)
		)
	);
	// Post format - quote
    $meta_boxes[] = array(
		'id' => 'sns-post-quote',
		'title' => esc_html__('Featured Quote','snsavaz'),
		'description' => '',
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'fields' => array( 
		    array(
				'id'    => "{$prefix}post_quotecontent",
				'name'  => esc_html__( 'Quote Content', 'snsavaz' ),
				'type'  => 'textarea',
				// Allow to clone? Default is false
				'clone' => false,
			),
			array(
				'id'      => "{$prefix}post_quoteauthor",
				'name'    => esc_html__( 'Quote author', 'snsavaz' ),
				'type'    => 'text',
				'clone' => false,
			),
			array(
				'id'      => "{$prefix}post_quote_bg",
				'name'    => esc_html__( 'Quote Background Color', 'snsavaz' ),
				'type'    => 'color',
				'std'         => '#fe7524',
			),
			array(
				'id'      => "{$prefix}post_quote_color",
				'name'    => esc_html__( 'Quote Text Color', 'snsavaz' ),
				'type'    => 'color',
				'std'         => '#ffffff',
			),
		)
	);
	// Post format - Link
    $meta_boxes[] = array(
		'id' => 'sns-post-link',
		'title' => esc_html__('Link Settings','snsavaz'),
		'description' => '',
		'pages'      => array( 'post' ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'fields' => array( 
		    array(
				'id'    => "{$prefix}post_linkurl",
				'name'  => esc_html__( 'Link URL', 'snsavaz' ),
				'type'  => 'text',
				// Allow to clone? Default is false
				'clone' => false,
			),
			array(
				'id'      => "{$prefix}post_linktitle",
				'name'    => esc_html__( 'Link Title', 'snsavaz' ),
				'type'    => 'text',
				'clone' => false,
			),
		)
	);
	// Brand config
	$meta_boxes[] = array(
		'id'         => 'sns_brandconfig',
		'title'      => esc_html__( 'Brand Config', 'snsavaz' ),
		'post_types' => array( 'brand' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'fields'     => array(
			array(
				'name'    => esc_html__( 'Link for brand', 'snsavaz' ),
				'id'      => "{$prefix}brandlink",
				'type'    => 'text'
			),
		)
	);
	// Testimonial subtitle
	/*$meta_boxes[] = array(
		'id'         => 'sns_testisub',
		'title'      => esc_html__( 'Sub Title', 'snsavaz' ),
		'post_types' => array( 'testimonial' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'fields'     => array(
			array(
				'name'    => esc_html__( 'Sub Title', 'snsavaz' ),
				'id'      => "{$prefix}testisub",
				'type'    => 'text',
				'desc'	  => esc_html__('Ex: display your company.', 'snsavaz')
			),
		),
	);*/
	return $meta_boxes;
}


if ( class_exists( 'RWMB_Field' ) ) {
	class RWMB_Layouttype_Field extends RWMB_Select_Field {

		static function admin_enqueue_scripts(){
			wp_enqueue_style( 'sns-imgselect', SNSAVAZ_THEME_URI . '/framework/meta-box/img-select.css' );
		}
		public static function walk( $options, $db_fields, $meta, $field ){
			$attributes = call_user_func( array( RW_Meta_Box::get_class_name( $field ), 'get_attributes' ), $field, $meta );
			$walker     = new RWMB_Select_Walker( $db_fields, $field, $meta );
			$output = sprintf(
				'<select class="rwmb-select img-select" name="%s" id="%s" size="%s"%s>',
				$field['field_name'],
				$field['id'],
				$field['size'],
				$field['multiple'] ? ' multiple' : ''
			);
			$output .= $walker->walk( $options, $field['flatten'] ? - 1 : 0 );
			$output .= '</select>';
			$output .= self::get_select_all_html( $field );
			$output .= self::img_select( $field, $meta );
			return $output;
		}
		
		static function img_select( $field, $meta ){
			$html = '';
			$img = '<span class="img-layout %s" data-value="%s" title="%s"></span>';

			foreach ( $field['options'] as $value => $label )
			{
				$html .= sprintf( $img, $value, $value, $label);
			}
			return $html;
		}
	}
}
