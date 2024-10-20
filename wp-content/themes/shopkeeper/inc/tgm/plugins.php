<?php


function getbowtied_theme_register_required_plugins() {

    $plugins = array(
        'woocommerce' => array(
            'name'               => 'WooCommerce',
            'slug'               => 'woocommerce',
            'required'           => true,
        ),
        'shopkeeper-extender' => array(
            'name'               => 'Shopkeeper Extender',
            'slug'               => 'shopkeeper-extender',
            'required'           => true,
        ),
        'hookmeup' => array(
            'name'               => 'WooCommerce HookMeUp',
            'slug'               => 'hookmeup',
            'required'           => true,
        ),
        'yith-woocommerce-wishlist' => array(
            'name'               => 'WooCommerce Wishlist',
            'slug'               => 'yith-woocommerce-wishlist',
            'required'           => true,
        ),
        'elementor' => array(
            'name'               => 'Elementor Page Builder',
            'slug'               => 'elementor',
            'required'           => false,
        ),
        'pro-elements' => array(
            'name'               => 'Elementor Pro Elements',
            'slug'               => 'pro-elements',
            'source'             => 'https://getbowtied.github.io/repository/plugins/pro-elements/pro-elements.zip',
            'required'           => false,
            'external_url'       => 'https://shopkeeper.getbowtied.com/'
        ),
        'kits-templates-and-patterns' => array(
            'name'               => 'Kits, Templates and Patterns',
            'slug'               => 'kits-templates-and-patterns',
            'required'           => true,
        ),
        'js_composer' => array(
            'name'               => 'WPBakery - Legacy Page Builder',
            'slug'               => 'js_composer',
            'source'             => 'https://getbowtied.github.io/repository/plugins/wp-bakery/js_composer.zip',
            'required'           => false,
            'external_url'       => '',
            'version'            => '7.9'
        ),
        /*'shopkeeper-portfolio ' => array(
            'name'                => 'Shopkeeper Portfolio Addon',
            'slug'                => 'shopkeeper-portfolio',
            'source'              => 'https://github.com/getbowtied/shopkeeper-portfolio/zipball/master',
            'required'            => false,
            'external_url'        => 'https://github.com/getbowtied/shopkeeper-portfolio',
            'description'         => 'Extends the functionality of Shopkeeper by adding a "Portfolio" custom post type.',
            'demo_required'       => true,
        ),*/
    );

    $config = array(
        'id'                => 'getbowtied',
        'default_path'      => '',
        'parent_slug'       => 'plugins.php',
        'menu'              => 'shopkeeper-plugins',
        'capability'        => 'edit_theme_options',
        'has_notices'       => true,
        'is_automatic'      => true,
        //'message'      		=> '',
        'strings'      => array(
			'page_title'                      => __( 'Shopkeeper Plugins', 'shopkeeper' ),
			'menu_title'                      => __( 'Shopkeeper Plugins', 'shopkeeper' ),
		)
    );

    tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'getbowtied_theme_register_required_plugins' );
