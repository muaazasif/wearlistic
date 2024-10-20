<?php
require_once SNSAVAZ_THEME_DIR . '/framework/class-tgm-plugin-activation.php'; // Plugin for installation and activation plugins.
require_once SNSAVAZ_THEME_DIR . '/framework/plugins-need-active.php'; // Active somes plugins.
require_once SNSAVAZ_THEME_DIR . '/framework/sns-class.php'; // Theme Class
require_once SNSAVAZ_THEME_DIR . '/framework/sns-options.php'; // Theme Options.
require_once SNSAVAZ_THEME_DIR . '/framework/sns-metabox.php'; // Metabox
require_once SNSAVAZ_THEME_DIR . '/framework/sns-menu.php'; // Mega menu
require_once SNSAVAZ_THEME_DIR . '/framework/sns-widgets.php'; // Widgets

if ( class_exists('WooCommerce') ) require_once SNSAVAZ_THEME_DIR . '/framework/sns-woocomerce.php'; // Woo function
// Init Theme Options in admin panel
$reduxConfig = new snsavaz_Options();
// Get Theme Options's value
$snsavaz_opt =  get_option('snsavaz_themeoptions');
// 
$snsavaz_obj = new snsavaz_Class;

require_once SNSAVAZ_THEME_DIR . '/framework/sns-functions.php'; // Functions
?>