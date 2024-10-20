<?php

// Helpers.
include_once( get_template_directory() . '/functions/helpers/helpers.php');

// Theme setup.
include_once( get_template_directory() . '/functions/theme/theme-setup.php');
include_once( get_template_directory() . '/functions/theme/theme-styles.php');
include_once( get_template_directory() . '/functions/theme/theme-scripts.php');
include_once( get_template_directory() . '/functions/theme/theme-update.php');

if ( ! function_exists( 'shopkeeper_fs' ) ) {

    function shopkeeper_fs() {
        global $shopkeeper_fs;

        if ( ! isset( $shopkeeper_fs ) ) {

            require_once dirname(__FILE__) . '/freemius/start.php';

            $shopkeeper_fs = fs_dynamic_init( array(
                'id'                  => '16122',
                'slug'                => 'shopkeeper',
                'type'                => 'theme',
                'public_key'          => 'pk_03b827f35d0bf54009952bb4ceb61',
                'is_premium'          => false,
                'has_addons'          => false,
                'has_paid_plans'      => false,
                'is_org_compliant'    => false,
                'menu'                => array(
                    'slug'           => 'getbowtied-dashboard',
                    'first-path'     => 'admin.php?page=getbowtied-dashboard',
                    'contact'        => false,
                    'support'        => false,
                ),
                'enable_anonymous' => false,
            ) );
        }

        return $shopkeeper_fs;
    }

    shopkeeper_fs();
    do_action( 'shopkeeper_fs_loaded' );
}

// Admin setup.
if ( is_admin() ) {
	include_once( get_template_directory() . '/functions/admin/admin-setup.php');
	include_once( get_template_directory() . '/functions/admin/admin-styles.php');
	include_once( get_template_directory() . '/functions/admin/admin-scripts.php');
	include_once( get_template_directory() . '/dashboard/setup.php' );
}

// Customizer.
include_once( get_template_directory() . '/inc/customizer/read-options.php' );
include_once( get_template_directory() . '/inc/customizer/backend/class/class-fonts.php' );
include_once( get_template_directory() . '/inc/customizer/frontend.php' );
include_once( get_template_directory() . '/inc/customizer/backend.php' );

// WP.
include_once( get_template_directory() . '/functions/wp/header-functions.php');
include_once( get_template_directory() . '/functions/wp/footer-functions.php');
include_once( get_template_directory() . '/functions/wp/actions.php');
include_once( get_template_directory() . '/functions/wp/filters.php');

// WC.
if( SHOPKEEPER_WOOCOMMERCE_IS_ACTIVE ) {
	include_once( get_template_directory() . '/functions/plugins/wc/actions.php');
	include_once( get_template_directory() . '/functions/plugins/wc/filters.php');
	include_once( get_template_directory() . '/functions/plugins/wc/custom.php');
}

// Germanized & German Market.
if( SHOPKEEPER_GERMAN_MARKET_IS_ACTIVE || SHOPKEEPER_WOOCOMMERCE_GERMANIZED_IS_ACTIVE ) {
	include_once( get_template_directory() . '/functions/plugins/germanized/functions.php');
}

// WPBakery.
if( SHOPKEEPER_WPBAKERY_IS_ACTIVE ) {
	include_once( get_template_directory() . '/functions/plugins/wb/functions.php');
}

// YITH Wishlist
if( SHOPKEEPER_WISHLIST_IS_ACTIVE ) {
	include_once( get_template_directory() . '/functions/plugins/wishlist/actions.php');
}

// WPML.
include_once( get_template_directory() . '/functions/plugins/wpml/functions.php');

// Load Custom Styles.
include_once( get_template_directory() . '/inc/custom-styles/init.php' );

// Load Post meta template.
include_once( get_template_directory() . '/inc/templates/post-meta.php' );

// Load Template Tags.
include_once( get_template_directory() . '/inc/templates/template-tags.php' );

//Include Metaboxes.
include_once( get_template_directory() . '/inc/metaboxes/page.php' );
include_once( get_template_directory() . '/inc/metaboxes/post.php' );
include_once( get_template_directory() . '/inc/metaboxes/product.php' );


function shopkeeper_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_all_core_location();
}
add_action( 'elementor/theme/register_locations', 'shopkeeper_register_elementor_locations' );
