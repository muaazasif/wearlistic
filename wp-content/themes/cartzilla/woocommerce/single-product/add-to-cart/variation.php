<?php
/**
 * Single variation display
 *
 * This is a javascript-based template for single variations (see https://codex.wordpress.org/Javascript_Reference/wp.template).
 * The values will be dynamically replaced after selecting attributes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

defined( 'ABSPATH' ) || exit;

?>
<script type="text/template" id="tmpl-variation-template">
	<div class="woocommerce-variation-description font-size-ms">{{{ data.variation.variation_description }}}</div>
	<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 variation-price-wrap">
		<div class="woocommerce-variation-price">{{{ data.variation.price_html }}}</div>
		<div class="woocommerce-variation-availability">{{{ data.variation.availability_html }}}</div>
	</div>
</script>
<script type="text/template" id="tmpl-unavailable-variation-template">
	<p class='font-size-sm text-muted'><?php esc_html_e( 'Sorry, this product is unavailable. Please choose a different combination.', 'cartzilla' ); ?></p>
</script>
