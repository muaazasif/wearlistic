<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 NM: Modified */

defined( 'ABSPATH' ) || exit;

global $product, $nm_theme_options, $nm_globals;


/* Global: Used to check for WooCommerce [product_page] shortcode */
$nm_globals['is_product'] = true;


/* Notices */
remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );


/* Summary: Opening tags */
add_action( 'woocommerce_single_product_summary', 'nm_single_product_summary_open', 1 );
/* Summary: Divider tags */
add_action( 'woocommerce_single_product_summary', 'nm_single_product_summary_divider', 15 );
/* Summary: Closing tag */
add_action( 'woocommerce_single_product_summary', 'nm_single_product_summary_close', 100 );


/* Sale flash */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );


/* Rating */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 21 );


/* Meta */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
if ( $nm_theme_options['product_meta_layout'] == 'summary' ) {
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 58 );
} else {
    add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_meta', 12 );
}


/* Tabs */
if ( $nm_theme_options['product_tabs_layout'] == 'summary' ) {
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
    add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 55 );
}


/* Layout */
$product_layout = get_post_meta( $product->get_id(), 'nm_product_layout', true );
$nm_globals['product_layout'] = ( $product_layout !== '' ) ? $product_layout : $nm_theme_options['product_layout'];

/* Layout: "Pin" details */
$product_details_pin = apply_filters( 'nm_product_layout_scroll_pin_details', true );
if ( $product_details_pin && strpos( $nm_globals['product_layout'], 'scroll' ) !== false ) {
    nm_add_page_include( 'product-layout-scroll' );
    
    $summary_pin_wrapper_open_escaped = '<div id="nm-summary-pin">';
    $summary_pin_wrapper_close_escaped = '</div>';
} else {
    $summary_pin_wrapper_open_escaped = '';
    $summary_pin_wrapper_close_escaped = '';
}


/* Classes */
// Main container
$post_class = 'nm-single-product layout-' . $nm_globals['product_layout'];
// Gallery column
$post_class .= ' gallery-col-' . $nm_theme_options['product_image_column_size'];
// Summary column
$summary_column_size = 12 - intval( $nm_theme_options['product_image_column_size'] );
$post_class .= ' summary-col-' . $summary_column_size;
// Thumbnails
$post_class .= ( $nm_globals['product_layout'] == 'default-thumbs-h' ) ? ' thumbnails-horizontal' : ' thumbnails-vertical';
// Background color
$post_class .= ( $nm_theme_options['single_product_background_color'] == 'transparent' ) ? ' no-bg-color' : ' has-bg-color';
// Meta
$post_class .= ( isset( $nm_theme_options['product_meta_layout'] ) && ! empty( $nm_theme_options['product_meta_layout'] ) ) ? ' meta-layout-' . $nm_theme_options['product_meta_layout'] : ' meta-layout-default';
// Tabs
$post_class .= ( isset( $nm_theme_options['product_tabs_layout'] ) && ! empty( $nm_theme_options['product_tabs_layout'] ) ) ? ' tabs-layout-' . $nm_theme_options['product_tabs_layout'] : ' tabs-layout-default';
    

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form();
    return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( $post_class, $product ); ?>>
    <div class="nm-single-product-bg clear">
    
        <?php wc_get_template( 'single-product/breadcrumb_nm.php' ); ?>
        
        <?php nm_print_shop_notices(); ?>

        <div class="nm-single-product-showcase">
            <div class="nm-single-product-summary-row nm-row">
                <div class="nm-single-product-summary-col col-xs-12">
                    <?php
                    /**
                     * Hook: woocommerce_before_single_product_summary.
                     *
                     * @hooked woocommerce_show_product_sale_flash - 10
                     * @hooked woocommerce_show_product_images - 20
                     */
                    do_action( 'woocommerce_before_single_product_summary' );
                    ?>

                    <div class="summary entry-summary">
                        <?php echo $summary_pin_wrapper_open_escaped; ?>
                        <?php
                        /**
                         * Hook: Woocommerce_single_product_summary.
                         *
                         * @hooked woocommerce_template_single_title - 5
                         * @hooked woocommerce_template_single_rating - 10
                         * @hooked woocommerce_template_single_price - 10
                         * @hooked woocommerce_template_single_excerpt - 20
                         * @hooked woocommerce_template_single_add_to_cart - 30
                         * @hooked woocommerce_template_single_meta - 40
                         * @hooked woocommerce_template_single_sharing - 50
                         * @hooked WC_Structured_Data::generate_product_data() - 60
                         */
                        do_action( 'woocommerce_single_product_summary' );
                        ?>
                        <?php echo $summary_pin_wrapper_close_escaped; ?>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
        
	<?php
    /**
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
