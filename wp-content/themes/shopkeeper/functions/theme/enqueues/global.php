<?php

// Global
	
function shopkeeper_enqueue_global() {

	    // Check minicart then remove this
	    wp_enqueue_style('shopkeeper-wc-cart', get_template_directory_uri() . '/css/public/wc-cart.css', NULL, shopkeeper_theme_version(), 'all');

	    wp_enqueue_script('shopkeeper-global-foundation-core', 				get_template_directory_uri() . '/js/vendor/foundation.core.min.js',				array('jquery'), '6.4.3', TRUE);
	    wp_enqueue_script('shopkeeper-global-foundation-util-mediaquery', 	get_template_directory_uri() . '/js/vendor/foundation.util.mediaQuery.min.js', 	array('jquery'), '6.4.3', TRUE);
	    wp_enqueue_script('shopkeeper-global-foundation-util-keyboard', 	get_template_directory_uri() . '/js/vendor/foundation.util.keyboard.min.js',	array('jquery'), '6.4.3', TRUE);
	    wp_enqueue_script('shopkeeper-global-foundation-offcanvas', 		get_template_directory_uri() . '/js/vendor/foundation.offcanvas.min.js',		array('jquery'), '6.4.3', TRUE);

	    wp_enqueue_script('shopkeeper-global-imagesloaded', 				get_template_directory_uri() . '/js/vendor/imagesloaded.pkgd.min.js',			array('jquery'), '4.1.4', TRUE);
	    wp_enqueue_script('shopkeeper-global-jquery-visible', 				get_template_directory_uri() . '/js/vendor/jquery.visible.js',					array('jquery'), '1.0.0', TRUE);

	    wp_enqueue_script('shopkeeper-global-fresco', 			 			get_template_directory_uri() . '/js/vendor/fresco.min.js', 		 				array('jquery'), '2.3.0', TRUE );

	    wp_enqueue_script('shopkeeper-global-header', 						get_template_directory_uri() . '/js/public/global-header.js', 					array('jquery'), shopkeeper_theme_version(), TRUE);
	    wp_enqueue_script('shopkeeper-global-wp-blocks', 					get_template_directory_uri() . '/js/public/global-wp-blocks.js', 				array('jquery'), shopkeeper_theme_version(), TRUE);

	    // Enqueue Adobe TypeKit Fonts
	    if( 'adobe' === Shopkeeper_Opt::getOption( 'main_font_source', 'default' ) ||
	        'adobe' === Shopkeeper_Opt::getOption( 'secondary_font_source', 'default' ) ) {
	        wp_enqueue_script(
	            'shopkeeper-adobe_typekit',
	            '//use.typekit.net/' . Shopkeeper_Opt::getOption( 'adobe_typekit_kit_id', '' ) . '.js',
	            array(),
	            shopkeeper_theme_version(),
	            FALSE
	        );
	        wp_enqueue_script(
	            'shopkeeper-adobe_typekit-exec',
	            get_template_directory_uri() . '/js/public/misc-adobe-typekit.js',
	            array( 'jquery' ),
	            shopkeeper_theme_version(),
	            FALSE
	        );
	    }

	    // Rtl
	    if ( is_rtl() ) {
	        wp_enqueue_script( 'shopkeeper-rtl', get_template_directory_uri() . '/js/public/misc-rtl.js', array('jquery'), shopkeeper_theme_version(), TRUE );
	    }

}
add_action( 'wp_enqueue_scripts', 'shopkeeper_enqueue_global' );
