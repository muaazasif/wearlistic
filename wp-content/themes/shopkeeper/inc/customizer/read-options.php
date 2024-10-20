<?php
/**
 * Customizer Theme Options
 *
 * @package shopkeeper
 */

class Shopkeeper_Opt {

    /**
	 * Cache each request to prevent duplicate queries
	 *
	 * @var array
	 */
	protected static $cached = [];

	/**
	 *  We don't need a constructor
	 */
	private function __construct() {}

	/**
	 * Default values for theme options
	 *
	 * @return array
	 */
	private static function theme_defaults() {

		return [

        	// Header
        	'main_header_layout' 						=> '1',
        	'main_header_font_size' 					=> 13,
			'main_header_background_image'				=> '',
			'main_header_background_image_repeat'		=> 'no-repeat',
			'main_header_background_image_position'		=> 'left-top',
			'main_header_background_image_size'			=> 'cover',
			'main_header_background_image_attachment'	=> 'scroll',
        	'header_width' 								=> 'custom',
        	'header_max_width' 							=> 1680,

			'main_header_transparency' 					=> false,
        	'main_header_transparency_scheme' 			=> 'transparency_light',
        	'shop_category_header_transparency_scheme' 	=> 'no_transparency',
			'shop_product_header_transparency_scheme'	=> 'no_transparency',
        	'main_header_transparent_light_color' 		=> '#fff',
        	'light_transparent_header_logo' 			=> '',
        	'main_header_transparent_dark_color' 		=>  '#000',
        	'dark_transparent_header_logo' 				=> '',

			'main_header_font_color' 					=> '#000',
			'main_header_background_color' 				=> '#FFFFFF',
			'main_header_dropdown_font_color'			=> '#000000',
			'main_header_dropdown_background_color'		=> '#ffffff',

        	'main_header_wishlist' 						=> true,
        	'main_header_wishlist_icon' 				=> '',
        	'main_header_shopping_bag' 					=> true,
        	'main_header_shopping_bag_icon' 			=> '',
        	'option_minicart' 							=> '1',
        	'option_minicart_open' 						=> '1',
        	'main_header_minicart_message'				=> '',
        	'my_account_icon_state' 					=> true,
        	'custom_my_account_icon' 					=> '',
        	'main_header_search_bar'					=> true,
        	'main_header_search_bar_icon' 				=> '',
        	'main_header_off_canvas' 					=> false,
        	'main_header_off_canvas_icon' 				=> '',

        	'site_logo' 								=> get_template_directory_uri() . '/images/shopkeeper-logo.png',
        	'logo_height' 								=> 50,
			'spacing_above_logo' 						=> 20,
        	'spacing_below_logo' 						=> 20,

        	'top_bar_switch' 							=> false,
        	'top_bar_background_color' 					=> '#333333',
        	'top_bar_typography' 						=> '#fff',
        	'top_bar_text' 								=> esc_html__( 'Free Shipping on All Orders Over $75!', 'shopkeeper' ),
        	'top_bar_navigation_position' 				=> 'right',
			'top_bar_mobile'							=> false,

        	'sticky_header' 							=> true,
			'sticky_top_bar'							=> false,
        	'sticky_header_background_color' 			=> '#fff',
        	'sticky_header_color' 						=> '#000',
			'sticky_header_logo' 						=> get_template_directory_uri() . '/images/shopkeeper-logo.png',
			'sticky_logo_height'						=> 33,
			'sticky_spacing_below_logo'					=> 15,
			'sticky_spacing_above_logo'					=> 15,

			'mobile_sticky_header'						=> true,
			'mobile_sticky_top_bar'						=> false,
			'mobile_header_logo'						=> get_template_directory_uri() . '/images/shopkeeper-logo.png',
			'mobile_logo_height'						=> 33,

            'predictive_search' 						=> true,
        	'search_in_titles' 							=> false,

        	// Footer
        	'footer_background_color' 					=> '#f4f4f4',
        	'footer_texts_color' 						=> '#868686',
        	'footer_links_color' 						=> '#000',
        	'footer_copyright_text' 					=> esc_html__('Powered by ', 'shopkeeper' ) . '<a href="'.SK_THEME_WEBSITE.'" title="eCommerce WordPress Theme for Woocommerce">' . esc_html__( 'Shopkeeper', 'shopkeeper' ) . '</a>.',
        	'expandable_footer' 						=> true,
        	'back_to_top_button'						=> false,

        	// Blog
        	'layout_blog' 								=> 'layout-3',
        	'pagination_blog' 							=> 'infinite_scroll',
        	'sidebar_blog_listing' 						=> false,

        	// Single Post
			'single_post_sidebar'						=> false,
        	'post_meta_author' 							=> true,
        	'post_meta_date' 							=> true,
        	'post_meta_categories' 						=> true,
        	'single_post_width' 						=> 708,

        	// Shop
        	'catalog_mode' 								=> false,
        	'pagination_shop' 							=> 'infinite_scroll',
        	'breadcrumbs' 								=> true,
			'archive_product_count'						=> false,
        	'second_image_product_listing' 				=> true,
        	'product_card_animation' 					=> true,
        	'ratings_catalog_page' 						=> true,
        	'sidebar_style' 							=> '1',
			'hide_empty_categories'						=> false,
        	'add_to_cart_display' 						=> '1',
        	'notification_mode' 						=> '1',
        	'notification_style' 						=> '1',
            'product_title_font_size'                   => 13,
        	'category_style' 							=> 'styled_grid',
        	'out_of_stock_label' 						=> esc_html__( 'Out of stock', 'shopkeeper' ),
        	'sale_label' 								=> esc_html__( 'Sale!', 'shopkeeper' ),
			'sale_badge_color'							=> '#93af76',
			'sale_badge_percentage'						=> false,
			'new_products_badge'						=> false,
			'new_products_badge_label'					=> esc_html__( 'New!', 'shopkeeper' ),
			'new_product_badge_color'					=> '#ff5943',
			'new_product_badge_show_by'					=> 'day',
			'new_product_badge_x_days'					=> 8,
			'new_product_badge_x_last'					=> 8,
        	'mobile_columns' 							=> 2,
        	'categories_grid_count' 					=> true,

        	// Product Page
        	'product_layout' 							=> 'default',
        	'product_quantity_style' 					=> 'default',
        	'product_gallery_zoom' 						=> true,
        	'product_gallery_lightbox'					=> true,
        	'related_products' 							=> true,
        	'related_products_number' 					=> 4,
			'product_navigation'						=> true,
        	'review_tab' 								=> true,
        	'ajax_add_to_cart' 							=> true,
        	'disabled_outofstock_variations' 			=> true,

        	// Styling
        	'body_color' 								=> '#545454',
        	'headings_color' 							=> '#000000',
        	'main_color' 								=> '#ff5943',
			'main_background_color' 					=> '#FFFFFF',
        	'main_background_image' 					=> '',
			'main_background_image_repeat'				=> 'no-repeat',
			'main_background_image_position'			=> 'left-top',
			'main_background_image_size'				=> 'cover',
			'main_background_image_attachment'			=> 'scroll',
        	'offcanvas_bg_color' 						=> '#ffffff',
        	'offcanvas_headings_color' 					=> '#000000',
        	'offcanvas_text_color' 						=> '#545454',

        	// Fonts
			'adobe_typekit_kit_id'						=> '',
			'main_font_source'							=> 'default',
			'main_font_default'							=> 'NeueEinstellung',
			'main_font_google'							=> 'Roboto',
			'main_font_web_safe'						=> 'Arial',
			'main_font_custom'							=> '',
			'main_font_adobe'							=> '',
			'secondary_font_source'						=> 'default',
			'secondary_font_default'					=> 'Radnika',
			'secondary_font_google'						=> 'Roboto',
			'secondary_font_web_safe'					=> 'Arial',
			'secondary_font_custom'						=> '',
			'secondary_font_adobe'						=> '',
        	'headings_font_size' 						=> 23,
        	'body_font_size'							=> 16,
			'default_fonts_fontface_display'			=> 'swap'
		];
	}

    /**
	 * Switch case for options that need post processing
	 *
	 * @param  [string] $key   [name of option]
	 * @param  [string] $value [value]
	 *
	 * @return [string]        [processed value]
	 */
	private static function processOption($key, $value) {

		return $value;
	}

    /**
	 * Return the theme option from cache; if it isn't cached fetch it and cache it
	 *
	 * @param  string $option_name
	 * @param  string $default
	 *
	 * @return string
	 */
	public static function getOption( $option_name, $default= '' ) {
 		/* Return cached if possible */
 		if ( array_key_exists($option_name, self::$cached) && empty($default) )
 			return self::$cached[$option_name];
 		/* If no default is given, fetch from theme defaults variable */
 		if (empty($default)) {
 			$default = array_key_exists($option_name, self::theme_defaults())? self::theme_defaults()[$option_name] : '';
 		}

 		$opt= get_theme_mod($option_name, $default);

 		/* Cache the result */
 		self::$cached[$option_name]= $opt;

 		/* Process the variable */
 		if ( $opt !== self::processOption($option_name, $opt) ) {
 			self::$cached[$option_name]= self::processOption($option_name, $opt);
 		}

 		return self::$cached[$option_name];
 	}
}
