<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function getbowtied_dashboard_pages_styles_and_scripts() {

	global $theme_version_gbt_dash;

	// Styles
	wp_enqueue_style('getbowtied-dashboard-pages', get_template_directory_uri() . '/dashboard/css/pages.css', false, $theme_version_gbt_dash, 'all');

	
	// Scripts 
	wp_enqueue_script('getbowtied-dashboard-pages', get_template_directory_uri() . '/dashboard/js/pages.js', array('jquery'), $theme_version_gbt_dash, TRUE);

    if ( (!empty( $_GET['page'] ) && ('getbowtied-documentation' == $_GET['page'])) || (!empty( $_GET['page'] ) && ('getbowtied-changelog' == $_GET['page'])) ) {
    	wp_enqueue_script('getbowtied-iframe-resizer', get_template_directory_uri() . '/dashboard/js/vendor/iframe-resizer/iframeResizer.min.js', array('jquery'), '4.3.2', TRUE);
    	wp_enqueue_script('getbowtied-dashboard-iframe', get_template_directory_uri() . '/dashboard/js/iframe.js', array('jquery'), $theme_version_gbt_dash, TRUE);
	}
}
add_action( 'admin_enqueue_scripts', 'getbowtied_dashboard_pages_styles_and_scripts' );
