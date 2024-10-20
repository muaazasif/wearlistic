<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $pagenow;

$theme_slug_gbt_dash 					= get_template();
$theme_name_gbt_dash 					= wp_get_theme(get_template()) -> get('Name');
$theme_version_gbt_dash 				= wp_get_theme(get_template()) -> get('Version');
$theme_child_download_link_gbt_dash     = "https://getbowtied.github.io/repository/themes/".$theme_slug_gbt_dash."/".$theme_slug_gbt_dash."-child.zip";

$theme_url_docs_gbt_dash        = "";
$theme_url_changelog_gbt_dash   = "";
$theme_url_support_gbt_dash     = "";

switch ($theme_slug_gbt_dash) {
    
    case "shopkeeper":
        $theme_url_docs_gbt_dash        = "https://getbowtied.com/docs/shopkeeper/";
		$theme_url_changelog_gbt_dash   = "https://getbowtied.com/documentation/shopkeeper/changelog/";
		$theme_url_support_gbt_dash     = "https://getbowtied.com/shopkeeper-contact-our-support-team/";
        break;

    case "block-shop":
        $theme_url_docs_gbt_dash        = "https://woo.com/document/block-shop-theme/";
		$theme_url_changelog_gbt_dash   = "https://woo.com/products/block-shop/";
		$theme_url_support_gbt_dash     = "https://woo.com/my-account/contact-support/";
        break;

    case "theretailer":
        $theme_url_docs_gbt_dash        = "https://getbowtied.com/docs/the-retailer/";
		$theme_url_changelog_gbt_dash   = "https://getbowtied.com/documentation/the-retailer/changelog-the-retailer/";
		$theme_url_support_gbt_dash     = "https://getbowtied.com/the-retailer-contact-our-support-team/";
        break;

    case "mrtailor":
        $theme_url_docs_gbt_dash        = "https://getbowtied.com/docs/mr-tailor/";
		$theme_url_changelog_gbt_dash   = "https://getbowtied.com/documentation/mr-tailor/changelog-mr-tailor/";
		$theme_url_support_gbt_dash     = "https://getbowtied.com/support/";
        break;
    
    case "merchandiser":
        $theme_url_docs_gbt_dash        = "https://getbowtied.com/docs/merchandiser/";
		$theme_url_changelog_gbt_dash   = "https://getbowtied.com/documentation/merchandiser/changelog-merchandiser/";
		$theme_url_support_gbt_dash     = "https://getbowtied.com/merchandiser-contact-our-support-team/";
        break;    
    
    case "the-hanger":
        $theme_url_docs_gbt_dash        = "https://getbowtied.com/docs/the-hanger/";
		$theme_url_changelog_gbt_dash   = "https://getbowtied.com/documentation/the-hanger/changelog-the-hanger/";
		$theme_url_support_gbt_dash     = "https://getbowtied.com/support/";
        break;

}

include_once( get_template_directory() . '/dashboard/index.php' );

// Redirect after theme activated

if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
    wp_safe_redirect(admin_url("admin.php?page=getbowtied-dashboard"));
    exit;
}

// Redirect after theme update

// Manual updates

if ( 'update.php' == $pagenow && isset( $_GET['overwrite'] ) && $_GET['overwrite'] == 'update-theme' ) {
    wp_safe_redirect(admin_url("admin.php?page=getbowtied-dashboard"));
    exit;
}

// Other updates

// Hook into the theme update process
add_action('upgrader_process_complete', 'gbt_theme_update_redirect', 10, 2);
function gbt_theme_update_redirect($upgrader_object, $options) {
    // Check if the action is an update and the type is a theme
    if ($options['action'] == 'update' && $options['type'] == 'theme') {
        // Get the current theme
        $theme = wp_get_theme();
        
        // Check if the active theme is a child theme
        $parent_theme = is_child_theme() ? $theme->parent() : null;
        
        // Check if the updated theme is the current theme or its parent theme
        if (isset($options['themes']) && (in_array($theme->get_stylesheet(), $options['themes']) || ($parent_theme && in_array($parent_theme->get_stylesheet(), $options['themes'])))) {
            // Set an option to trigger the redirect
            update_option('gbt_theme_updated_redirect', true);
        }
    }
}

// Hook into the admin_init action to perform the redirect
add_action('admin_init', 'gbt_redirect_after_theme_update');
function gbt_redirect_after_theme_update() {
    // Check if the option is set
    if (get_option('gbt_theme_updated_redirect')) {
        // Delete the option to ensure the redirect only happens once
        delete_option('gbt_theme_updated_redirect');
        
        // Redirect to the specified admin page
        wp_safe_redirect(admin_url('admin.php?page=getbowtied-dashboard'));
        exit;
    }
}





// Freemius setup

// Title
function gbt_fs_custom_connect_header($header_html) {
    global  $theme_name_gbt_dash,
            $theme_version_gbt_dash;
    return sprintf(
        __( '<h2>Thank you for using %s Theme v%s!</h2>', 'freemius' ),
        $theme_name_gbt_dash,
        $theme_version_gbt_dash
    );
}

// Message
function gbt_fs_custom_connect_message(
    $message,
    $user_first_name,
    $theme_title,
    $user_login,
    $site_link,
    $freemius_link
)
{
    return sprintf(
        __( 'You\'re almost there! <strong>Complete the Activation Process</strong> for your %2$s theme. Simply click the button below to finalize the activation, and you\'re done!', 'freemius' ),
        $user_first_name,
        $theme_title,
        $user_login,
        $site_link,
        $freemius_link
    );
}

// Other messages
$gbt_fs_txt = array(
    'opt-in-connect'    => __( "Complete the Activation Process", 'freemius' ),
    'skip'              => __( 'Later', 'freemius' ),
    'few-plugin-tweaks' => sprintf(
        __( "🚩 You are just one step away! %s now. Once done, you can start using the theme's features.", 'freemius' ),
        sprintf( '<b><a href="%s">%s</a></b>',
            admin_url('admin.php?page=getbowtied-dashboard'),
            sprintf(
                __( 'Complete %s Theme Activation Process', 'freemius' ),
                $theme_name_gbt_dash
            ),
        )
    ),
    'complete-the-opt-in' => sprintf(
        '<a href="%s" class="gbt_fs_complete_activation_link"><strong>%s</strong></a>',
        admin_url('admin.php?page=getbowtied-dashboard'),
        __( 'complete the activation process', 'freemius' ),
    ),
    'plugin-x-activation-message' => sprintf(
        '%s activation process was successfully completed.',
        $theme_name_gbt_dash
    )
);

function gbt_fs_add_custom_messages( $activation_state ) {
    
    if ( $activation_state[ 'is_license_activation' ] ) {
        // The opt-in is rendered as license activation.
    }
         
    if ( $activation_state[ 'is_pending_activation' ] ) {
        // The user clicked the opt-in and now pending email confirmation.
        echo sprintf( '<p style="text-align:center">Incorrect email? <b><a href="%s">Update your profile</a></b>.</p>',
            admin_url('profile.php')
        );
    }
         
    if ( $activation_state[ 'is_network_level_activation' ] ) {
        // A network-level opt-in after network activation of the plugin (only applicable for plugins).
    }
         
    if ( $activation_state[ 'is_dialog' ] ) {
        // The opt-in is rendered within a modal dialog (only applicable for themes).
    }

}

if ( function_exists( 'merchandiser_fs' ) ) {
    merchandiser_fs()->add_filter( 'hide_freemius_powered_by',  '__return_true' );
    merchandiser_fs()->add_filter( 'connect-header',            'gbt_fs_custom_connect_header',  10, 6 );
    merchandiser_fs()->add_filter( 'connect-header_on-update',  'gbt_fs_custom_connect_header',  10, 6 );
    merchandiser_fs()->add_filter( 'connect_message',           'gbt_fs_custom_connect_message', 10, 6 );
    merchandiser_fs()->add_filter( 'connect_message_on_update', 'gbt_fs_custom_connect_message', 10, 6 );
    merchandiser_fs()->override_i18n( $gbt_fs_txt );
    merchandiser_fs()->add_filter( 'connect/after_actions', 'gbt_fs_add_custom_messages' );
}

if ( function_exists( 'thehanger_fs' ) ) {
    thehanger_fs()->add_filter( 'hide_freemius_powered_by',  '__return_true' );
    thehanger_fs()->add_filter( 'connect-header',            'gbt_fs_custom_connect_header',  10, 6 );
    thehanger_fs()->add_filter( 'connect-header_on-update',  'gbt_fs_custom_connect_header',  10, 6 );
    thehanger_fs()->add_filter( 'connect_message',           'gbt_fs_custom_connect_message', 10, 6 );
    thehanger_fs()->add_filter( 'connect_message_on_update', 'gbt_fs_custom_connect_message', 10, 6 );
    thehanger_fs()->override_i18n( $gbt_fs_txt );
    thehanger_fs()->add_filter( 'connect/after_actions', 'gbt_fs_add_custom_messages' );
}

if ( function_exists( 'mrtailor_fs' ) ) {
    mrtailor_fs()->add_filter( 'hide_freemius_powered_by',  '__return_true' );
    mrtailor_fs()->add_filter( 'connect-header',            'gbt_fs_custom_connect_header',  10, 6 );
    mrtailor_fs()->add_filter( 'connect-header_on-update',  'gbt_fs_custom_connect_header',  10, 6 );
    mrtailor_fs()->add_filter( 'connect_message',           'gbt_fs_custom_connect_message', 10, 6 );
    mrtailor_fs()->add_filter( 'connect_message_on_update', 'gbt_fs_custom_connect_message', 10, 6 );
    mrtailor_fs()->override_i18n( $gbt_fs_txt );
    mrtailor_fs()->add_filter( 'connect/after_actions', 'gbt_fs_add_custom_messages' );
}

if ( function_exists( 'theretailer_fs' ) ) {
    theretailer_fs()->add_filter( 'hide_freemius_powered_by',  '__return_true' );
    theretailer_fs()->add_filter( 'connect-header',            'gbt_fs_custom_connect_header',  10, 6 );
    theretailer_fs()->add_filter( 'connect-header_on-update',  'gbt_fs_custom_connect_header',  10, 6 );
    theretailer_fs()->add_filter( 'connect_message',           'gbt_fs_custom_connect_message', 10, 6 );
    theretailer_fs()->add_filter( 'connect_message_on_update', 'gbt_fs_custom_connect_message', 10, 6 );
    theretailer_fs()->override_i18n( $gbt_fs_txt );
    theretailer_fs()->add_filter( 'connect/after_actions', 'gbt_fs_add_custom_messages' );
}

if ( function_exists( 'blockshop_fs' ) ) {
    blockshop_fs()->add_filter( 'hide_freemius_powered_by',  '__return_true' );
    blockshop_fs()->add_filter( 'connect-header',            'gbt_fs_custom_connect_header',  10, 6 );
    blockshop_fs()->add_filter( 'connect-header_on-update',  'gbt_fs_custom_connect_header',  10, 6 );
    blockshop_fs()->add_filter( 'connect_message',           'gbt_fs_custom_connect_message', 10, 6 );
    blockshop_fs()->add_filter( 'connect_message_on_update', 'gbt_fs_custom_connect_message', 10, 6 );
    blockshop_fs()->override_i18n( $gbt_fs_txt );
    blockshop_fs()->add_filter( 'connect/after_actions', 'gbt_fs_add_custom_messages' );
}

if ( function_exists( 'shopkeeper_fs' ) ) {
    shopkeeper_fs()->add_filter( 'hide_freemius_powered_by',  '__return_true' );
    shopkeeper_fs()->add_filter( 'connect-header',            'gbt_fs_custom_connect_header',  10, 6 );
    shopkeeper_fs()->add_filter( 'connect-header_on-update',  'gbt_fs_custom_connect_header',  10, 6 );
    shopkeeper_fs()->add_filter( 'connect_message',           'gbt_fs_custom_connect_message', 10, 6 );
    shopkeeper_fs()->add_filter( 'connect_message_on_update', 'gbt_fs_custom_connect_message', 10, 6 );
    shopkeeper_fs()->override_i18n( $gbt_fs_txt );
    shopkeeper_fs()->add_filter( 'connect/after_actions', 'gbt_fs_add_custom_messages' );
}