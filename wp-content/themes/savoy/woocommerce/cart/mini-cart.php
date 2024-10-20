<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 NM: Modified */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $nm_theme_options;

if ( ! WC()->cart ) {
    return;
}

$nm_cart_empty_class_attr_escaped = ( WC()->cart->is_empty() ) ? ' class="nm-cart-panel-empty"' : '';
?>

<div id="nm-cart-panel"<?php echo $nm_cart_empty_class_attr_escaped; ?>>

<form id="nm-cart-panel-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
    <?php
        // Nonce field and cart URL needed for quantity inputs
        wp_nonce_field( 'woocommerce-cart' );
    ?>
</form>
    
<div id="nm-cart-panel-loader">
    <span class="nm-loader"><?php esc_html_e( 'Updating&hellip;', 'nm-framework' ); ?></span>
</div>
    
<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<div class="nm-cart-panel-list-wrap">

<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
    
    <?php if ( ! WC()->cart->is_empty() ) : ?>

        <?php
            do_action( 'woocommerce_before_mini_cart_contents' );
    
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    /**
                     * This filter is documented in woocommerce/templates/cart/cart.php.
                     *
                     * @since 2.1.0
                     */
                    $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                    $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                    //$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                    $product_price     = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                    
                    // NM
                    if ( empty( $product_permalink ) ) {
                        $product_name = '<span class="nm-cart-panel-product-title">' . wp_kses_post( $product_name ) . '</span>';
                    } else {
                        $product_permalink = esc_url( $product_permalink );
                        $thumbnail = '<a href="' . $product_permalink . '">' . $thumbnail . '</a>';
                        $product_name = '<a href="' . $product_permalink . '" class="nm-cart-panel-product-title">' . wp_kses_post( $product_name ) . '</a>';
                    }
                    ?>
                    <li id="nm-cart-panel-item-<?php echo esc_attr( $cart_item_key ); ?>" class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
                        <div class="nm-cart-panel-item-thumbnail">
                            <div class="nm-cart-panel-thumbnail-wrap">
                                <?php echo $thumbnail; ?>
                                <div class="nm-cart-panel-thumbnail-loader nm-loader"></div>
                            </div>
                        </div>
                        <div class="nm-cart-panel-item-details">
                            <div class="nm-cart-item-loader nm-loader"></div>
                            
                            <?php
                            echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                'woocommerce_cart_item_remove_link',
                                sprintf(
                                    '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s" data-success_message="%s"><i class="nm-font nm-font-close2"></i></a>',
                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                    /* translators: %s is the product name */
                                    esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
                                    esc_attr( $product_id ),
                                    esc_attr( $cart_item_key ),
                                    esc_attr( $_product->get_sku() ),
							/* translators: %s is the product name */
							esc_attr( sprintf( __( '&ldquo;%s&rdquo; has been removed from your cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) )
                                ),
                                $cart_item_key );
                            ?>
                            
                            <?php echo $product_name; ?>
                            <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                            
                            <div class="nm-cart-panel-quantity-pricing">
                                <?php if ( ! $nm_theme_options['cart_panel_quantity_arrows'] || $_product->is_sold_individually() ) : ?>
                                    <?php
                                        echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . esc_html__( 'Qty', 'woocommerce' ) . ': ' . $cart_item['quantity'] . '</span>', $cart_item, $cart_item_key );
                                    ?>
                                <?php else: ?>
                                    <div class="product-quantity" data-title="<?php esc_html_e( 'Quantity', 'woocommerce' ); ?>">
                                        <?php
                                            $product_quantity = woocommerce_quantity_input( array(
                                                'input_name'  => "cart[{$cart_item_key}][qty]",
                                                'input_value' => $cart_item['quantity'],
                                                'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                                'min_value'   => '1',
                                                'nm_mini_cart_quantity' => true // NM: Makes it possible to check if the quantity-input is for the cart-panel when using the "woocommerce_quantity_input_args" filter
                                            ), $_product, false );
                                            
                                            echo apply_filters( 'woocommerce_widget_cart_item_quantity', $product_quantity, $cart_item, $cart_item_key );
                                        ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="nm-cart-panel-item-price">
                                    <?php echo $product_price; ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
            }
    
            do_action( 'woocommerce_mini_cart_contents' );
        ?>

    <?php endif; ?>

    <li class="empty">
        <i class="nm-font nm-font-close2"></i>
        <span><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></span>
    </li>

</ul><!-- end product list -->

</div>
    
<div class="nm-cart-panel-summary">
    
    <div class="nm-cart-panel-summary-inner">
        
        <?php if ( ! WC()->cart->is_empty() ) : ?>
        
        <p class="woocommerce-mini-cart__total total">
            <?php
            /**
             * Hook: woocommerce_widget_shopping_cart_total.
             *
             * @hooked woocommerce_widget_shopping_cart_subtotal - 10
             */
            do_action( 'woocommerce_widget_shopping_cart_total' );
            ?>
        </p>

        <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
        
        <p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>
        
        <?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>
        
        <?php endif; ?>
        
        <p class="buttons nm-cart-empty-button">
            <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" id="nm-cart-panel-continue" class="button border"><?php esc_html_e( 'Continue shopping', 'woocommerce' ); ?></a>
        </p>
        
    </div>

</div>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
    
</div>