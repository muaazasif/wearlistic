<?php
$vc_add_css_animation = array(
	'type' => 'dropdown',
	'heading' => esc_html__( 'CSS Animation', 'snsavaz' ),
	'param_name' => 'css_animation',
	'admin_label' => true,
	'value' => array(
		esc_html__( 'No', 'snsavaz' ) => '',
		esc_html__( 'Top to bottom', 'snsavaz' ) => 'top-to-bottom',
		esc_html__( 'Bottom to top', 'snsavaz' ) => 'bottom-to-top',
		esc_html__( 'Left to right', 'snsavaz' ) => 'left-to-right',
		esc_html__( 'Right to left', 'snsavaz' ) => 'right-to-left',
		esc_html__( 'Appear from center', 'snsavaz' ) => 'appear'
	),
	'description' => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'snsavaz' )
);
$sns_extra_class =array(
			"type" => "textfield",
			"heading" => esc_html__("Extra class name", 'snsavaz'),
			"param_name" => "extra_class"
		);

global $wpdb;
// Get category name
$sql = $wpdb->prepare( "
	SELECT a.name,a.slug,a.term_id 
	FROM {$wpdb->terms} a JOIN  {$wpdb->term_taxonomy} b ON (a.term_id= b.term_id ) 
	WHERE b.count> %d and b.taxonomy = %s",
	0,'category' );
$results = $wpdb->get_results($sql);
$cat_value = array();
foreach ($results as $cat) {
	$cat_value[$cat->name] = $cat->slug;
}
// Get woo category name
$sql = $wpdb->prepare( "
	SELECT a.name,a.slug,a.term_id 
	FROM {$wpdb->terms} a JOIN  {$wpdb->term_taxonomy} b ON (a.term_id= b.term_id ) 
	WHERE b.count> %d and b.taxonomy = %s",
	0,'product_cat' );
$results = $wpdb->get_results($sql);
$woocat_value = array();
foreach ($results as $cat) {
	$woocat_value[$cat->name] = $cat->slug;
}

// SNS Custom Box
class WPBakeryShortCode_SNS_Custom_Box extends WPBakeryShortCode {}
vc_map( array(
	"name"  => esc_html__("SNS Custom Box", 'snsavaz'),
	"base" => "sns_custom_box",
	"show_settings_on_create" => true ,
	"is_container" => false ,
	"icon" => "vc_icon_snstheme",
	"class" => "vc_icon_snstheme",
	"content_element" => true ,
	"category" => esc_html__('Content', 'snsavaz'),
	'description' => esc_html__( 'Box contain: icon, title, description', 'snsavaz' ),
	"params" => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'snsavaz' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'snsavaz' ) => 'fontawesome',
				// esc_html__( 'Open Iconic', 'snsavaz' ) => 'openiconic',
				// esc_html__( 'Typicons', 'snsavaz' ) => 'typicons',
				// esc_html__( 'Entypo', 'snsavaz' ) => 'entypo',
				esc_html__( 'Linecons', 'snsavaz' ) => 'linecons',
			),
			'param_name' => 'icon_type',
			'description' => esc_html__( 'Select icon library.', 'snsavaz' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'snsavaz' ),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-adjust', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'fontawesome',
			),
			'description' => esc_html__( 'Select icon from library.', 'snsavaz' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'snsavaz' ),
			'param_name' => 'icon_openiconic',
			'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'openiconic',
			),
			'description' => esc_html__( 'Select icon from library.', 'snsavaz' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'snsavaz' ),
			'param_name' => 'icon_typicons',
			'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'typicons',
			),
			'description' => esc_html__( 'Select icon from library.', 'snsavaz' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'snsavaz' ),
			'param_name' => 'icon_entypo',
			'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'entypo',
			),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'snsavaz' ),
			'param_name' => 'icon_linecons',
			'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'linecons',
			),
			'description' => esc_html__( 'Select icon from library.', 'snsavaz' ),
		),
		array(
			"type" => "colorpicker",
			"value" => "",
			"heading" => esc_html__("Color for icon", 'snsavaz'),
			"param_name" => "icon_color"
	    ),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Font size for icon", 'snsavaz'),
			"param_name" => "icon_font_size" ,
			"description" => esc_html__("It's font-size for icon you sellected, example: 24px", 'snsavaz')
		),
		array(
			"type" => "dropdown",
			"value" => Array( 
						"No border" => "" ,
						"1px" => "1px" ,
						"2px" => "2px" ,
						"3px" => "3px" ,
						"4px" => "4px" ,
						"5px" => "5px" ,
						"6px" => "6px" ,
						"7px" => "7px" ,
						"8px" => "8px" 
			), 	
			"heading" => esc_html__("Border size for icon", 'snsavaz'),
			"param_name" => "icon_border_size" ,
			"description" => esc_html__("It's border size for icon box", 'snsavaz')
		),
		array(
			"type" => "textfield",	
			"heading" => esc_html__("Border radius for icon box", 'snsavaz'),
			"param_name" => "icon_border_radius" ,
			'dependency' => array(
				'element' => 'icon_border_size',
				'value' => array('1px', '2px', '3px', '4px', '5px', '6px', '7px', '8px')
			),
			"description" => esc_html__("It's border radius for icon box, example: 10px, or 50%, or none ", 'snsavaz')
		),
		array(
			"type" => "colorpicker",
			"value" => "",
			"heading" => esc_html__("Border color", 'snsavaz'),
			"param_name" => "border_color",
			'dependency' => array(
				'element' => 'icon_border_size',
				'value' => array('1px', '2px', '3px', '4px', '5px', '6px', '7px', '8px')
			)

	    ),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Custom Link", 'snsavaz'),
			"param_name" => "link" ,
			"description" => esc_html__("Enter the  link. Do't forget to include http:// ", 'snsavaz')
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Title", 'snsavaz'),
			"param_name" => "title",
			"value" => esc_html__("Your Title Here ...",'snsavaz'),
			"admin_label" => true 
		),
		array(
			"type" => "dropdown",
			"value" => Array( 
						"Sellect text align" => "" ,
						"left" => "left" ,
						"right" => "right" ,
						"center" => "center"
			), 	
			"heading" => esc_html__("Text align for box", 'snsavaz'),
			"param_name" => "text_align" 
		),
		array(
			"type" => "textarea",
			"heading" => esc_html__("Description", 'snsavaz'),
			"param_name" => "desc"
		),
		$vc_add_css_animation,
		$sns_extra_class,
	)
));


// SNS Info Box
class WPBakeryShortCode_SNS_Info_Box extends WPBakeryShortCode {}
vc_map( array(
	"name"  => esc_html__("SNS Info Box", 'snsavaz'),
	"base" => "sns_info_box",
	"show_settings_on_create" => true ,
	"is_container" => false ,
	"icon" => "vc_icon_snstheme",
	"class" => "vc_icon_snstheme",
	"content_element" => true ,
	"category" => esc_html__('Content', 'snsavaz'),
	'description' => esc_html__( 'A Box contain: title, description, and 2 buttons link.', 'snsavaz' ),
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => esc_html__("Heading", 'snsavaz'),
			"param_name" => "heading",
			"value" => esc_html__("Shop discounts",'snsavaz'),
			"admin_label" => true
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Title", 'snsavaz'),
			"param_name" => "title",
			"value" => esc_html__("Brand Avaz",'snsavaz'),
			"admin_label" => true
		),
		array(
			"type" => "textarea",
			"heading" => esc_html__("Description", 'snsavaz'),
			"param_name" => "desc"
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Title link #1", 'snsavaz'),
			"description" => '',
			"param_name" => "title_link_1"
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Url link #1", 'snsavaz'),
			"description" => esc_html__("Enter the link. Don't forget to include http://", 'snsavaz'),
			"param_name" => "link_1"
		),
		
		array(
			"type" => "textfield",
			"heading" => esc_html__("Title link #2", 'snsavaz'),
			"description" => '',
			"param_name" => "title_link_2"
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Url link #2", 'snsavaz'),
			"description" => esc_html__("Enter the link. Don't forget to include http://", 'snsavaz'),
			"param_name" => "link_2"
		),
		
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Link Target",'snsavaz'),
			"param_name" => "link_target",
			"value" => array(
				"New Windown" => "blank",
				"Same Windown" => "_self"
			),
			"description" => ""
		),
		
		$vc_add_css_animation,
		$sns_extra_class,
	)
));

// SNS Twitter
class WPBakeryShortCode_SNS_Twitter extends WPBakeryShortCode {}
vc_map( array(
	"name"  => esc_html__("SNS Twitter", 'snsavaz'),
	"base" => "sns_twitter",
	"show_settings_on_create" => true ,
	"is_container" => false ,
	"icon" => "",
	"class" => "sns_twitter",
	"content_element" => true ,
	"category" => esc_html__('Content', 'snsavaz'),
	'description' => esc_html__( 'Show your list tweets', 'snsavaz' ),
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => esc_html__("Title", 'snsavaz'),
			"param_name" => "title",
			"value" => esc_html__("Latest Tweets",'snsavaz'),
			"admin_label" => true 
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Widget ID", 'snsavaz'),
			"param_name" => "widget_id",
			"value" => "420187988887212033",
			"admin_label" => true 
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Twitter Account", 'snsavaz'),
			"param_name" => "account_name",
			"value" => "snstheme",
			"admin_label" => true 
		),
		array(
			"type" => "dropdown",
			"value" => Array( 
						"List" => "list" ,
						"Carousel" => "carousel" 
			), 	
			"heading" => esc_html__("Template", 'snsavaz'),
			"param_name" => "template" 
		),
		array(
			"type" => "dropdown",
			"value" => Array( 
						"Yes" => "1" ,
						"No" => "2" ,
			), 	
			"heading" => esc_html__("Show Navigation", 'snsavaz'),
			"param_name" => "show_navigation",
			'dependency' => array(
				'element' => 'template',
				'value' => 'carousel'
			)
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Tweets number display", 'snsavaz'),
			"param_name" => "tweets_num_display",
			"value" => "2",
			"admin_label" => true 
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Tweets number limit", 'snsavaz'),
			"param_name" => "tweets_num_limit",
			"value" => "6",
			'dependency' => array(
				'element' => 'template',
				'value' => 'carousel'
			),
			"admin_label" => true 
		),
		array(
			"type" => "dropdown",
			"value" => Array( 
						"Yes" => "1" ,
						"No" => "2" ,
			), 	
			"heading" => esc_html__("Show Avartar", 'snsavaz'),
			"param_name" => "show_avartar",
		),
		array(
			"type" => "dropdown",
			"value" => Array( 
						"Yes" => "1" ,
						"No" => "2" ,
			), 	
			"heading" => esc_html__("Show Follow Link", 'snsavaz'),
			"param_name" => "show_follow_link",
		),
		array(
			"type" => "dropdown",
			"value" => Array( 
						"Yes" => "1" ,
						"No" => "2" ,
			), 	
			"heading" => esc_html__("Show Interact Link", 'snsavaz'),
			"param_name" => "show_interact_link",
		),
		array(
			"type" => "dropdown",
			"value" => Array( 
						"Yes" => "1" ,
						"No" => "2" ,
			), 	
			"heading" => esc_html__("Show Date", 'snsavaz'),
			"param_name" => "show_date",
		),
		$vc_add_css_animation,
		$sns_extra_class,
	)
));

class WPBakeryShortCode_SNS_Latest_Posts extends WPBakeryShortCode {}

vc_map( array(
	"name" => esc_html__("SNS Latest Posts",'snsavaz'),
	"base" => "sns_latest_posts",
	"icon" => "sns_icon_latestpost",
	"class" => "sns_latestpost",
	"category" => esc_html__("Content",'snsavaz'),
	"description" => esc_html__( "Show latest posts", 'snsavaz' ),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Template",'snsavaz'),
			"param_name" => "template",
			"value" => array(
				esc_html__('Layout 1', 'snsavaz') => "layout_1",
				esc_html__('Layout 2', 'snsavaz') => "layout_2",
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Title",'snsavaz'),
			"param_name" => "title",
			"value" => "Latest Posts",
			"admin_label" => true,
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Show Author",'snsavaz'),
			"param_name" => "show_author",
			"value" => array(
				"Show" => "show",
				"Hide" =>  "hide"
			),
			'dependency' => array(
				'element' => 'template',
				'value' => 'layout_1'
			),
			"description" => esc_html__("Show / Hide Author",'snsavaz'),
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Show Comment count",'snsavaz'),
			"param_name" => "show_comment",
			"value" => array(
				"Show" => "show",
				"Hide" =>  "hide"
			),
			"description" => esc_html__("Show / Hide comment count",'snsavaz'),
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Posts number limit",'snsavaz'),
			"param_name" => "number_limit",
			"value" => "12"
		),
		$vc_add_css_animation,
		$sns_extra_class,
	)
) );

class WPBakeryShortCode_SNS_Blog_Page extends WPBakeryShortCode {}

vc_map( array(
	"name" => esc_html__("SNS Blog Page",'snsavaz'),
	"base" => "sns_blog_page",
	"icon" => "sns_icon_blogpage",
	"class" => "sns_blogpage",
	"category" => esc_html__("Content",'snsavaz'),
	"description" => esc_html__( "To create blog page with some style", 'snsavaz' ),
	"params" => array(
		array(
			"type" => "checkbox",
			"value" => $cat_value,
			"class" => "",
			"heading" => esc_html__("Categories",'snsavaz'),
			"description" => "If you dont sellect category, the default is sellected all category",
			"param_name" => "category"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Blog Style",'snsavaz'),
			"param_name" => "blog_type",
			"value" => array(
				"Blog Layout 1" 	=> "",
				"Blog Layout 2" 	=>  "layout2",
				"Masonry" 			=>  "masonry",
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Post per pages",'snsavaz'),
			"param_name" => "posts_per_page",
			"value" => "6"
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Excerpt Length",'snsavaz'),
			"param_name" => "excerpt_length",
			"value" => "35"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Enable Read More Button",'snsavaz'),
			"param_name" => "show_readmore",
			"value" => array(
				"Yes" => '1',
				"No" =>  '2',
			),
			'description' => esc_html__('Choose Type of navigation.','snsavaz')
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Page Navigation",'snsavaz'),
			"param_name" => "pagination",
			"value" => array(
				"Default" => 'def',
				"Ajax" =>  'ajax'
			),
			'description' => esc_html__('Choose Type of navigation.','snsavaz')
		),
		
		$vc_add_css_animation,
		$sns_extra_class,
	)
) );


class WPBakeryShortCode_SNS_Our_Brand extends WPBakeryShortCode {}

vc_map( array(
	"name" => esc_html__("SNS Our Brand",'snsavaz'),
	"base" => "sns_our_brand",
	"icon" => "sns_icon_ourbrand",
	"class" => "sns_ourbrand",
	"category" => esc_html__("Content",'snsavaz'),
	"description" => esc_html__( "Carousel list brands(image, link)", 'snsavaz' ),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Title",'snsavaz'),
			"param_name" => "title",
			"value" => "Our brands"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Link Target",'snsavaz'),
			"param_name" => "link_target",
			"value" => array(
				"New Windown" => "blank",
				"Same Windown" =>  "_self"
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Brands number display",'snsavaz'),
			"param_name" => "num_display",
			"value" => "5",
			"description" => "Numbers display with each page carousel"
		),
		$vc_add_css_animation,
		$sns_extra_class,
	)
) );

class WPBakeryShortCode_SNS_Testimonial extends WPBakeryShortCode {}

vc_map( array(
	"name" => esc_html__("SNS Testimonial",'snsavaz'),
	"base" => "sns_testimonial",
	"icon" => "sns_icon_testimonial",
	"class" => "sns_testimonial",
	"category" => esc_html__("Content",'snsavaz'),
	"description" => esc_html__( "Carousel list testimonial", 'snsavaz' ),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Template",'snsavaz'),
			"param_name" => "template",
			"value" => array(
				"While" =>  "sns_testimonial_white",
				"Dark" => "sns_testimonial_dark",
			),
			"description" => esc_html__("The template Dark allow you to use a background image.",'snsavaz'),
		),
		/*array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Icon type",'snsavaz'),
			"param_name" => "icon_type",
			"value" => array(
				"Image" => "image",
				"FontAwesome" =>  "fontawesome"
			),
			"description" => ""
		),
		array(
			"type" => "attach_image",
			"class" => "",
			"heading" => esc_html__("Icon",'snsavaz'),
			"param_name" => "icon_image",
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'image',
			),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'snsavaz' ),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-adjust', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'fontawesome',
			),
			'description' => esc_html__( 'Select icon from library.', 'snsavaz' ),
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Title",'snsavaz'),
			"param_name" => "title",
			"value" => "What client say"
		),*/
		$vc_add_css_animation,
		$sns_extra_class,
		
	)
) );

class WPBakeryShortCode_SNS_Member extends WPBakeryShortCode {}

vc_map( array(
	"name" => esc_html__("SNS Member",'snsavaz'),
	"base" => "sns_member",
	"icon" => "sns_icon_member",
	"class" => "sns_member",
	"category" => esc_html__("Content",'snsavaz'),
	"description" => esc_html__( "Display team member", 'snsavaz' ),
	"params" => array(
		array(
	      "type" => "attach_image",
	      "heading" => esc_html__("Avartar", 'snsavaz'),
	      "param_name" => "avartar" 
	    ),
	    array(
			"type" => "dropdown",
			"heading" => esc_html__("Avartar style",'snsavaz'),
			"param_name" => "avartar_style",
			"value" => array(
				"Default" => "",
				"Rounded" =>  "rounded",
				"Circle" =>  "circle"
			),
			"description" => ""
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__( 'Link to member', 'snsavaz' ),
			'param_name' => 'link',
		),
	    array(
	      "type" => "textfield",
	      "heading" => esc_html__("Member name", 'snsavaz'),
	      "param_name" => "name",
		  "admin_label" => true
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => esc_html__("Member role", 'snsavaz'),
	      "param_name" => "role",
		  "admin_label" => true
	    ),
	    array(
	      "type" => "textarea_html",
	      "heading" => esc_html__("Short description", 'snsavaz'),
	      "param_name" => "short_desc",
	    ),
	   //  array(
	   //    "type" => "checkbox",
	   //    "heading" => esc_html__("Social Links", 'snsavaz'),
	   //    "param_name" => "social_links",
		  // "value" => Array('Twitter'=>'twitter' ,'Facebook'=>'facebook','Linkedin'=>'linkedin','Youtube'=>'youtube','Google plus'=>'google','Behance'=>'behance','Dribbble'=>'dribbble','Pinterest'=>'pinterest')
	   //  ),
		array(
	      "type" => "textfield",
	      "heading" => esc_html__("Twitter link", 'snsavaz'),
	      "param_name" => "twitter",
		  //"dependency" => Array('element' => "social_links", 'value' => 'twitter')
	    ),
		array(
	      "type" => "textfield",
	      "heading" => esc_html__("Facebook link", 'snsavaz'),
	      "param_name" => "facebook",
		  //"dependency" => Array('element' => "social_links", 'value' => 'facebook')
	    ),
		array(
	      "type" => "textfield",
	      "heading" => esc_html__("linkedin link", 'snsavaz'),
	      "param_name" => "linkedin",
		  //"dependency" => Array('element' => "social_links", 'value' => 'linkedin')
	    ),
		array(
	      "type" => "textfield",
	      "heading" => esc_html__("youtube link", 'snsavaz'),
	      "param_name" => "youtube",
		  //"dependency" => Array('element' => "social_links", 'value' => 'youtube')
	    ),
		array(
	      "type" => "textfield",
	      "heading" => esc_html__("google link", 'snsavaz'),
	      "param_name" => "google",
		  //"dependency" => Array('element' => "social_links", 'value' => 'google')
	    ),
		array(
	      "type" => "textfield",
	      "heading" => esc_html__("behance link", 'snsavaz'),
	      "param_name" => "behance",
		  //"dependency" => Array('element' => "social_links", 'value' => 'behance')
	    ),
		array(
	      "type" => "textfield",
	      "heading" => esc_html__("dribbble link", 'snsavaz'),
	      "param_name" => "dribbble",
		  //"dependency" => Array('element' => "social_links", 'value' => 'dribbble')
	    ),
		array(
	      "type" => "textfield",
	      "heading" => esc_html__("pinterest link", 'snsavaz'),
	      "param_name" => "pinterest",
		  //"dependency" => Array('element' => "social_links", 'value' => 'pinterest')
	    ),
	    $vc_add_css_animation,
	    $sns_extra_class,
	)
) );

class WPBakeryShortCode_SNS_Counter extends WPBakeryShortCode {

}

vc_map( array(
	"name" => esc_html__("SNS Counter", 'snsavaz'),
	"base" => "sns_counter",
	"class" => "sns_counter",
	"icon" => "sns_icon_counter",
	"description" => esc_html__( "Display box count to", 'snsavaz' ),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Use icon?",'snsavaz'),
			"param_name" => "enable_icon",
			"value" => array(
				esc_html__('Yes', 'snsavaz') => "1",
				esc_html__('No', 'snsavaz') => "0"
			),
			"description" => ""
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'snsavaz' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'snsavaz' ) => 'fontawesome',
				esc_html__( 'Linecons', 'snsavaz' ) => 'linecons',
			),
			'param_name' => 'icon_type',
			'description' => esc_html__( 'Select icon library.', 'snsavaz' ),
			'dependency' => array(
				'element' => 'enable_icon',
				'value' => '1',
			),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'snsavaz' ),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-adjust', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false,
				// default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000,
				// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'fontawesome',
			),
			'description' => esc_html__( 'Select icon from library.', 'snsavaz' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'snsavaz' ),
			'param_name' => 'icon_linecons',
			'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'linecons',
			),
			'description' => esc_html__( 'Select icon from library.', 'snsavaz' ),
		),
		array(
			"type" => "colorpicker",
			"value" => "",
			"heading" => esc_html__("Color for icon", 'snsavaz'),
			"param_name" => "icon_color",
			'dependency' => array(
				'element' => 'enable_icon',
				'value' => '1',
			),
	    ),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Font size for icon", 'snsavaz'),
			"param_name" => "icon_font_size" ,
			"description" => esc_html__("It's font-size for icon you sellected, example: 24px", 'snsavaz'),
			'dependency' => array(
				'element' => 'enable_icon',
				'value' => '1',
			),
		),
  
	  	array(
	      "type" => "textfield",
	      "heading" => esc_html__("Value to Count", 'snsavaz'),
	      "param_name" => "value" ,
		  "description" => "This value must be an integer", 
		  "admin_label" => true
	    ),
	    array(
			"type" => "colorpicker",
			"value" => "",
			"heading" => esc_html__("Color for Value", 'snsavaz'),
			"param_name" => "value_color"
	    ),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Font size for Value", 'snsavaz'),
			"param_name" => "value_font_size" ,
			"description" => esc_html__("It's font-size for Value, example: 18px", 'snsavaz')
		),
	    array(
	      "type" => "textfield",
	      "heading" => esc_html__("Unit", 'snsavaz'),
	      "param_name" => "unit",
		  "description" => 'You can use any text such as % , cm or any other . Leave Blank if you do not want to display any unit value'
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => esc_html__("Counter Title", 'snsavaz'),
	      "param_name" => "title" ,
		  "value" => esc_html__("Your Title Goes Here...",'snsavaz'),
	    ),
	    array(
			"type" => "colorpicker",
			"value" => "",
			"heading" => esc_html__("Color for Title", 'snsavaz'),
			"param_name" => "title_color"
	    ),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Font size for Title", 'snsavaz'),
			"param_name" => "title_font_size" ,
			"description" => esc_html__("It's font-size for Title, example: 12px", 'snsavaz')
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("From to count", 'snsavaz'),
			"param_name" => "from" ,
			"value"		=> "0",
			"description" => esc_html__("The number the element should start at, example: 0", 'snsavaz')
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Speed to count", 'snsavaz'),
			"param_name" => "speed",
			"value"		=> "900",
			"description" => esc_html__("How long it should take to count between the target numbers, example: 900", 'snsavaz')
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__("Interval to count", 'snsavaz'),
			"param_name" => "interval",
			"value"		=> "10",
			"description" => esc_html__("How often the element should be updated, example: 10", 'snsavaz')
		),
		$vc_add_css_animation,
		$sns_extra_class,
  	)

));


class WPBakeryShortCode_SNS_Products extends WPBakeryShortCode {}

vc_map( array(
	"name" => esc_html__("SNS Products",'snsavaz'),
	"base" => "sns_products",
	"icon" => "sns_icon_products",
	"class" => "sns_products",
	"category" => esc_html__("WooCommerce",'snsavaz'),
	"description" => esc_html__( "WooCommerce products",'snsavaz' ),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Title",'snsavaz'),
			"param_name" => "title",
			"admin_label" => true,
			"value" => "New Products"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Type",'snsavaz'),
			"param_name" => "type",
			"value" => array(
				esc_html__('Latest Products', 'snsavaz') => "recent",
				esc_html__('BestSeller Products', 'snsavaz') => "best_selling",
				esc_html__('Top Rated Products', 'snsavaz') => "top_rate",
				esc_html__('Special Products', 'snsavaz') => "on_sale",
				esc_html__('Featured Products', 'snsavaz') => "featured_product",
				esc_html__('Recent Review', 'snsavaz') => "recent_review",
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Template",'snsavaz'),
			"param_name" => "template",
			"admin_label" => true,
			"value" => array(
				esc_html__("Carousel",'snsavaz') => '1',
				esc_html__("List",'snsavaz') => '2',
			),
			"description" => esc_html__("Select template.", 'snsavaz')
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Show Count Sale",'snsavaz'),
			"param_name" => "show_countdown",
			"value" => array(
				esc_html__("Yes",'snsavaz') => 'yes',
				esc_html__("No",'snsavaz') => 'no',
			),
			'dependency' => array(
				'element' => 'template',
				'value' => '1',
			),
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Product number display per row",'snsavaz'),
			"param_name" => "number_display",
			"value" => "4",
			'dependency' => array(
				'element' => 'template',
				'value' => '1',
			),
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Product number limit",'snsavaz'),
			"param_name" => "number_limit",
			"value" => "10",
		),
		$vc_add_css_animation,
		$sns_extra_class,
		
	)
) );

class WPBakeryShortCode_SNS_Product_Tabs extends WPBakeryShortCode {
	public function snsavaz_getListTabTitle(){
		$this->atts = vc_map_get_attributes( $this->getShortcode(), $this->atts );
		$array_tab = array();
		if ( $this->atts['tab_types'] == 'category' ) :
			if( empty($this->atts['list_cat']) ) :
				$array_tab = $this->snsavaz_getCats();
			else :
				$array_tab = explode(',', $this->atts['list_cat']);
			endif;
			//var_dump($array_tab);
		else :
			$array_tab = explode(',', $this->atts['list_orderby']);
		endif;
		foreach ($array_tab as $tab) {
			$list_tab[$tab] = $this->snsavaz_tabTitle($tab, $this->atts['tab_types']);
		}
		return $list_tab;
	}

	public function snsavaz_tabTitle($tab, $tab_types){
		if( $tab_types == 'category' ){
			$cat = get_term_by('slug', $tab, 'product_cat');
			
			return array('name'=>str_replace(' ', '_', $tab),'title'=>$cat->name,'short_title'=>$cat->name);
		}else{
			switch ($tab) {
				case 'recent':
					return array('name'=>$tab,'title'=>esc_html__('Latest Products','snsavaz'),'short_title'=>esc_html__('Latest','snsavaz'));
				case 'featured_product':
					return array('name'=>$tab,'title'=>esc_html__('Featured Products','snsavaz'),'short_title'=>esc_html__('Featured','snsavaz'));
				case 'top_rate':
					return array('name'=>$tab,'title'=> esc_html__('Top Rated Products','snsavaz'),'short_title'=>esc_html__('Top Rated', 'snsavaz'));
				case 'best_selling':
					return array('name'=>$tab,'title'=>esc_html__('BestSeller Products','snsavaz'),'short_title'=>esc_html__('Best Seller','snsavaz'));
				case 'on_sale':
					return array('name'=>$tab,'title'=>esc_html__('Special Products','snsavaz'),'short_title'=>esc_html__('Special','snsavaz'));
			}
		}
	}
	public function snsavaz_getCats(){
		$cats = get_terms('product_cat');
		$arr = array();
		foreach ($cats as $cat) {
			$arr[] = $cat->slug;
		}
		return $arr;
	}
}

vc_map( array(
	"name" => esc_html__("SNS Product Tabs",'snsavaz'),
	"base" => "sns_product_tabs",
	"icon" => "sns_icon_product_tabs",
	"class" => "sns_product_tabs",
	"category" => esc_html__("WooCommerce",'snsavaz'),
	"description" => esc_html__( "WooCommerce product tabs", 'snsavaz' ),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Title",'snsavaz'),
			"param_name" => "title",
			"admin_label" => true,
			"value" => "New Products"
		),
// 		array(
// 			"type" => "textarea",
// 			"heading" => esc_html__("Pre text", 'snsavaz'),
// 			"param_name" => "pretext"
// 		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Template",'snsavaz'),
			"param_name" => "template",
			"value" => array(
				"Grid" => "grid",
				"Carousel" =>  "carousel"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Heading style",'snsavaz'),
			"param_name" => "heading_style",
			"value" => array(
				esc_html__('Heading sytle #1', 'snsavaz') => "",
				esc_html__('Heading sytle #2', 'snsavaz') => "heading_2",
			),
			"dependency" => array("element" => "template" , "value" => "grid" ),
			"description" => "Select heading style applied for title and tab panel."
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Tab types",'snsavaz'),
			"param_name" => "tab_types",
			"value" => array(
				"Categories" => "category",
				"Order By" =>  "orderby"
			),
			"description" => ""
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"value" => $woocat_value,
			"heading" => esc_html__("Select Category",'snsavaz'),
			"param_name" => "list_cat",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Order By for all tab",'snsavaz'),
			"param_name" => "orderby",
			"value" => array(
				esc_html__('Latest Products', 'snsavaz') => "recent",
				esc_html__('BestSeller Products', 'snsavaz') => "best_selling",
				esc_html__('Top Rated Products', 'snsavaz') => "top_rate",
				esc_html__('Special Products', 'snsavaz') => "on_sale",
				esc_html__('Featured Products', 'snsavaz') => "featured_product",
				esc_html__('Recent Review', 'snsavaz') => "recent_review",
			),
			"dependency" => array("element" => "tab_types" , "value" => "category" ),
			"description" => ""
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => esc_html__("Select Order By",'snsavaz'),
			"param_name" => "list_orderby",
			"value" => array(
				esc_html__('Latest Products', 'snsavaz') => "recent",
				esc_html__('BestSeller Products', 'snsavaz') => "best_selling",
				esc_html__('Top Rated Products', 'snsavaz') => "top_rate",
				esc_html__('Special Products', 'snsavaz') => "on_sale",
				esc_html__('Featured Products', 'snsavaz') => "featured_product",
				esc_html__('Recent Review', 'snsavaz') => "recent_review",
			),
			"dependency" => array("element" => "tab_types" , "value" => "orderby" ),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Row",'snsavaz'),
			"param_name" => "row",
			"dependency" => array("element" => "template" , "value" => "grid" ),
			"value" => "2"
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Column per Row",'snsavaz'),
			"param_name" => "col",
			"dependency" => array("element" => "template" , "value" => "grid" ),
			"value" => "4"
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Number product with each click to Load more button",'snsavaz'),
			"param_name" => "number_load",
			"dependency" => array("element" => "template" , "value" => "grid" ),
			"value" => "4"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Effect for product when click to Load more button",'snsavaz'),
			"param_name" => "effect_load",
			"value" => array(
				esc_html__('zoomOut', 'snsavaz') => "zoomOut",
				esc_html__('zoomIn', 'snsavaz') => "zoomIn",
				esc_html__('pageRight', 'snsavaz') => "pageRight",
				esc_html__('pageLeft', 'snsavaz') => "pageLeft",
				esc_html__('pageTop', 'snsavaz') => "pageTop",
				esc_html__('pageBottom', 'snsavaz') => "pageBottom",
				esc_html__('starwars', 'snsavaz') => "starwars",
				esc_html__('slideBottom', 'snsavaz') => "slideBottom",
				esc_html__('slideLeft', 'snsavaz') => "slideLeft",
				esc_html__('slideRight', 'snsavaz') => "slideRight",
				esc_html__('bounceIn', 'snsavaz') => "bounceIn",
			),
			"dependency" => array("element" => "template" , "value" => "grid" ),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Product number display per row",'snsavaz'),
			"param_name" => "number_display",
			"dependency" => array("element" => "template" , "value" => "carousel" ),
			"value" => "4"
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => esc_html__("Product number limit",'snsavaz'),
			"param_name" => "number_limit",
			"dependency" => array("element" => "template" , "value" => "carousel" ),
			"value" => "10"
		),
		$vc_add_css_animation,
		$sns_extra_class,
		
	)
) );

class WPBakeryShortCode_SNS_Products_Slider extends WPBakeryShortCode {}

$order_by_values = array(
	'',
	esc_html__('Latest Products', 'snsavaz') => "recent",
	esc_html__('BestSeller Products', 'snsavaz') => "best_selling",
	esc_html__('Top Rated Products', 'snsavaz') => "top_rate",
	esc_html__('Special Products', 'snsavaz') => "on_sale",
	esc_html__('Featured Products', 'snsavaz') => "featured_product",
	esc_html__('Recent Review', 'snsavaz') => "recent_review",
);

$order_way_values = array(
	'',
	esc_html__( 'Descending', 'snsavaz' ) => 'DESC',
	esc_html__( 'Ascending', 'snsavaz' ) => 'ASC',
);

vc_map( array(
		"name" => esc_html__("SNS Products Slider",'snsavaz'),
		"base" => "sns_products_slider",
		"icon" => "sns_icon_products_slider",
		"class" => "sns_products_slider",
		"category" => esc_html__("WooCommerce",'snsavaz'),
		"description" => esc_html__( "Show products slider", 'snsavaz' ),
		"params" => array(
				array(
					"type" => "checkbox",
					"class" => "",
					"value" => $woocat_value,
					"heading" => esc_html__("Select Category",'snsavaz'),
					"param_name" => "list_cat",
					"description" => ""
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order by', 'snsavaz' ),
					'param_name' => 'orderby',
					'value' => $order_by_values,
					'description' => ""
				),
				array(
					'type' => 'dropdown',
					'heading' => __( 'Order', 'snsavaz' ),
					'param_name' => 'order',
					'value' => $order_way_values,
					'description' => ""
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_html__("Product number limit",'snsavaz'),
					"param_name" => "number_limit",
					"value" => "3"
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_html__("Excerpt length",'snsavaz'),
					"param_name" => "excerpt_lenght",
					"value" => "20"
				),
			$vc_add_css_animation,
			$sns_extra_class,
		)
) );

?>