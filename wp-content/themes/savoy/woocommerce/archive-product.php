<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 NM: Modified */

defined( 'ABSPATH' ) || exit;

// Handle AJAX
if ( isset( $_REQUEST['shop_load'] ) && nm_is_ajax_request() ) {
	if ( 'products' !== $_REQUEST['shop_load'] ) {
        wc_get_template( 'ajax/shop-full.php' ); // AJAX: Filter/search - Get shop template
	} else {
        wc_get_template( 'ajax/shop-products.php' ); // AJAX: Infinite load - Get products template
	}
    exit;
}

global $nm_theme_options, $nm_globals;

nm_add_page_include( 'products' );

$shop_class = 'nm-shop';

// Actions
remove_action( 'woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Breadcrumbs
$hide_breadcrumbs = apply_filters( 'nm_shop_breadcrumbs_hide', true );
if ( $hide_breadcrumbs ) {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
}

// Product taxonomy
$is_product_taxonomy = ( is_product_taxonomy() ) ? true : false;

// Page content
$show_shop_page            = ( $nm_theme_options['shop_content_home'] ) ? true : false;
$show_taxonomy_header      = false;
$show_taxonomy_heading     = false;
$show_taxonomy_description = ( $nm_theme_options['shop_category_description'] ) ? true : false;
if ( $is_product_taxonomy ) {
    $show_shop_page            = ( $show_shop_page && $nm_theme_options['shop_content_taxonomy'] == 'shop_page' ) ? true : false;
    $show_taxonomy_header      = ( $nm_theme_options['shop_content_taxonomy'] == 'taxonomy_header' ) ? true : false;
    $show_taxonomy_heading     = ( $nm_theme_options['shop_content_taxonomy'] == 'taxonomy_heading' ) ? true : false;
    $show_taxonomy_description = ( ! $show_taxonomy_header && $nm_theme_options['shop_category_description'] ) ? true : false;
} else if ( is_search() ) {
    $show_shop_page = apply_filters( 'nm_shop_search_page_content', false );
}

// Shop page
$shop_page = ( $show_shop_page ) ? nm_shop_get_page_content() : null;

// Shop header
$shop_class .= ( $nm_theme_options['shop_header'] ) ? ' header-enabled' : ' header-disabled';

// Sidebar/Filters: Ajax class
$shop_class .= ( $nm_theme_options['shop_filters_enable_ajax'] == '1' ) ? ' ajax-enabled' : ' ajax-disabled' . $nm_theme_options['shop_filters_enable_ajax'];

// Sidebar/Filters
$show_filters_popup = false;
if ( $nm_theme_options['shop_filters'] == 'default' ) {
    nm_add_page_include( 'shop_filters' );
    $show_filters_sidebar = true;
    $shop_class           .= ' nm-shop-sidebar-' . $nm_theme_options['shop_filters'] . ' nm-shop-sidebar-position-' . $nm_theme_options['shop_filters_sidebar_position'];
    $shop_column_size     = 'col-md-9 col-sm-12';
} else {
    $show_filters_sidebar = false;
    $shop_class           .= ' nm-shop-sidebar-' . $nm_theme_options['shop_filters'];
    $shop_column_size     = 'col-xs-12';
    if ( $nm_theme_options['shop_filters'] == 'popup' ) {
        nm_add_page_include( 'shop_filters' );
        $show_filters_popup = true;
    }
}

// Image lazy-loading class
if ( $nm_theme_options['product_image_lazy_loading'] ) {
    $shop_class .= ' images-lazyload';
}

get_header( 'shop' ); ?>

<?php
    /**
     * Shop page
     */
    if ( $shop_page ) :
?>
<div class="nm-page-full">
    <?php echo $shop_page; ?>
</div>
<?php endif; ?>

<?php 
    /** 
     * Taxonomy banner/header
     */
    if ( $show_taxonomy_header ) {
        wc_get_template_part( 'content', 'product_nm_taxonomy_header' );
    }
?>

<?php
    /** 
     * Taxonomy heading
     */
    if ( $show_taxonomy_heading ) :
?>
<div class="nm-shop-taxonomy-heading">
    <div class="nm-row">
        <div class="col-xs-12">
            <h1><?php woocommerce_page_title(); ?></h1>
        </div>
    </div>
</div>
<?php endif; ?>

<div id="nm-shop" class="<?php echo esc_attr( $shop_class ); ?>">
    <?php
        /**
         * Hook: woocommerce_before_main_content.
         *
         * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
         * NM: Removed - @hooked woocommerce_breadcrumb - 20
         * @hooked WC_Structured_Data::generate_website_data() - 30
         */
        do_action( 'woocommerce_before_main_content' );
    ?>

    <?php 
        /**
         * Shop header
         */
        if ( $nm_theme_options['shop_header'] ) {
            /**
             * Hook: woocommerce_shop_loop_header.
             *
             * @since 8.6.0
             *
             * NM: Removed - @hooked woocommerce_product_taxonomy_archive_header - 10
             */
            do_action( 'woocommerce_shop_loop_header' );
            
            wc_get_template_part( 'content', 'product_nm_header' );
        }
    ?>

    <?php nm_print_shop_notices(); // Note: Don't remove, WooCommerce will output multiple messages otherwise ?>

    <div id="nm-shop-products" class="nm-shop-products">
        <div class="nm-row">
            <?php 
                if ( $show_filters_sidebar ) {
                    /**
                     * Hook: woocommerce_sidebar.
                     *
                     * @hooked woocommerce_get_sidebar - 10
                     */
                    do_action( 'woocommerce_sidebar' );
                }
            ?>

            <div class="nm-shop-products-col <?php echo esc_attr( $shop_column_size ); ?>">
                <div id="nm-shop-products-overlay" class="nm-loader"></div>
                <div id="nm-shop-browse-wrap" class="nm-shop-description-<?php echo esc_attr( $nm_theme_options['shop_description_layout'] ); ?>">
                    <?php
                        /**
                         * Results bar
                         */
                        wc_get_template_part( 'content', 'product_nm_results_bar' );
                    ?>

                    <?php
                        /**
                         * Taxonomy description - Top
                         */
                        if ( $show_taxonomy_description && $nm_theme_options['shop_description_position'] == 'top' ) {    
                            if ( $is_product_taxonomy ) {
                                /**
                                 * Hook: woocommerce_archive_description.
                                 *
                                 * @hooked woocommerce_taxonomy_archive_description - 10
                                 * @hooked woocommerce_product_archive_description - 10
                                 */
                                do_action( 'woocommerce_archive_description' );
                            } else {
                                nm_shop_description(); // Default shop description
                            }
                        }
                    ?>

                    <?php
                    if ( woocommerce_product_loop() ) {
                        /**
                         * Hook: woocommerce_before_shop_loop.
                         *
                         * @hooked wc_print_notices - 10
                         * NM: Removed - @hooked woocommerce_result_count - 20
                         * NM: Removed - @hooked woocommerce_catalog_ordering - 30
                         */
                        do_action( 'woocommerce_before_shop_loop' );

                        // Set Large column-size for shop catalog
                        global $woocommerce_loop;
                        $woocommerce_loop['columns'] = $nm_theme_options['shop_columns'];

                        woocommerce_product_loop_start();

                        $nm_globals['is_categories_shortcode'] = false;
                        
                        if ( wc_get_loop_prop( 'total' ) ) {
                            while ( have_posts() ) {
                                the_post();

                                // Note: Don't place in another template (image lazy-loading is only used in the Shop and WooCommerce shortcodes can use the other product templates)                 
                                $nm_globals['shop_image_lazy_loading'] = ( $nm_theme_options['product_image_lazy_loading'] ) ? true : false;

                                /**
                                 * Hook: woocommerce_shop_loop.
                                 */
                                do_action( 'woocommerce_shop_loop' );

                                wc_get_template_part( 'content', 'product' );
                            }
                        }

                        woocommerce_product_loop_end();

                        /**
                         * Hook: woocommerce_after_shop_loop.
                         *
                         * @hooked woocommerce_pagination - 10
                         */
                        do_action( 'woocommerce_after_shop_loop' );
                    } else {
                        /**
                         * Hook: woocommerce_no_products_found.
                         *
                         * @hooked wc_no_products_found - 10
                         */
                        do_action( 'woocommerce_no_products_found' );
                    }
                    ?>
                    
                    <?php
                        /**
                         * Taxonomy description - Bottom
                         */
                        if ( $show_taxonomy_description && $nm_theme_options['shop_description_position'] == 'bottom' ) {
                            if ( $is_product_taxonomy ) {
                                /**
                                 * Hook: woocommerce_archive_description.
                                 *
                                 * @hooked woocommerce_taxonomy_archive_description - 10
                                 * @hooked woocommerce_product_archive_description - 10
                                 */
                                do_action( 'woocommerce_archive_description' );
                            } else {
                                nm_shop_description(); // Default shop description
                            }
                        }
                    ?>
                </div>
            </div>
        </div>

        <?php
            /**
             * Hook: woocommerce_after_main_content.
             *
             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
             */
            do_action( 'woocommerce_after_main_content' );
        ?>
    </div>

    <?php
        /**
         * Popup filters
         */
        if ( $show_filters_popup ) {
            wc_get_template_part( 'content', 'product_nm_filters_popup' );
        }
    ?>

</div>

<?php
    /**
     * Hook: nm_after_shop.
     */
    do_action( 'nm_after_shop' );

    get_footer( 'shop' );
?>
