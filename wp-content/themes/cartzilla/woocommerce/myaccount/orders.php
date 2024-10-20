<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit; ?>

<div class="d-none d-lg-flex justify-content-end align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
	<a class="btn btn-primary btn-sm" href="<?php echo esc_url( wc_logout_url() ); ?>">
		<i class="czi-sign-out mr-2"></i>
		<?php echo esc_html_x( 'Logout', 'front-end', 'cartzilla' ); ?>
	</a>
</div>

<?php do_action( 'woocommerce_before_account_orders', $has_orders ); ?>

<?php if ( $has_orders ) : ?>
	<div class="table-responsive font-size-md">
		<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table table table-hover mb-0">
			<thead>
			<tr>
				<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
					<th class="woocommerce-orders-table__header woocommerce-orders-table__header-<?php echo esc_attr( $column_id ); ?>">
						<span class="nobr"><?php echo esc_html( $column_name ); ?></span>
					</th>
				<?php endforeach; ?>
			</tr>
			</thead>
			<tbody>
			<?php foreach ( $customer_orders->orders as $customer_order ) :
				$order      = wc_get_order( $customer_order ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
				$item_count = $order->get_item_count() - $order->get_item_count_refunded();
				?>
				<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status-<?php echo esc_attr( $order->get_status() ); ?> order">
					<?php foreach ( wc_get_account_orders_columns() as $column_id => $column_name ) : ?>
						<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr( $column_id ); ?> align-middle" data-title="<?php echo esc_attr( $column_name ); ?>">
							<?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
								<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>

							<?php elseif ( 'order-number' === $column_id ) : ?>
								<a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" class="nav-link-style font-weight-medium">
									<?php echo esc_html( _x( '#', 'hash before order number', 'cartzilla' ) . $order->get_order_number() ); ?>
								</a>
							<?php elseif ( 'order-date' === $column_id ) : ?>
								<time datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></time>
							<?php elseif ( 'order-status' === $column_id ) : ?>
								<span class="badge badge-<?php echo sanitize_html_class( $order->get_status() ); ?>"><?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?></span>
							<?php elseif ( 'order-total' === $column_id ) : ?>
								<?php
								/* translators: 1: formatted order total 2: total order items */
								echo wp_kses_post( sprintf( _n( '%1$s for %2$s item', '%1$s for %2$s items', $item_count, 'cartzilla' ), $order->get_formatted_order_total(), $item_count ) ); ?>
							<?php elseif ( 'order-actions' === $column_id ) : ?>
								<?php
								$actions = wc_get_account_orders_actions( $order );
								if ( ! empty( $actions ) ) :
									foreach ( $actions as $key => $action ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
										switch ( $key ) :
											case 'view': ?>
												<a href="<?php echo esc_url( $action['url'] ); ?>" class="btn btn-outline-secondary btn-icon btn-sm mr-1 my-1" data-toggle="tooltip" title="<?php echo esc_attr( $action['name'] ); ?>">
													<i class="czi-eye"></i>
												</a><?php
												break;

											case 'pay': ?>
												<a href="<?php echo esc_url( $action['url'] ); ?>" class="btn btn-outline-secondary btn-icon btn-sm mr-1 my-1" data-toggle="tooltip" title="<?php echo esc_attr( $action['name'] ); ?>">
													<i class="czi-card"></i>
												</a><?php
												break;

											case 'cancel': ?>
												<a href="<?php echo esc_url( $action['url'] ); ?>" class="btn btn-outline-danger text-danger btn-icon btn-sm mr-1 my-1" data-toggle="tooltip" title="<?php echo esc_attr( $action['name'] ); ?>">
													<i class="czi-close-circle"></i>
												</a><?php
												break;
											default: ?>
												<a href="<?php echo esc_url( $action['url'] ); ?>" class="btn bg-secondary text-dark btn-icon btn-sm mr-1 my-1">
													<?php echo esc_html( $action['name'] ); ?>
												</a><?php
												break;
										endswitch;
									endforeach;
								endif;
								?>
							<?php endif; ?>
						</td>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
		<hr class="pb-4">
		<nav class="d-flex justify-content-between pt-2" aria-label="<?php
		/* translators: aria-label for order navigation wrapper */
		echo esc_attr_x( 'Page navigation', 'front-end', 'cartzilla' ); ?>">
			<?php if ( 1 !== $current_page ) : ?>
				<ul class="pagination">
					<li class="page-item">
						<a class="page-link" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>">
							<i class="czi-arrow-left mr-2"></i><?php esc_html_e( 'Previous', 'cartzilla' ); ?>
						</a>
					</li>
				</ul>
			<?php endif; ?>
			<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
				<ul class="pagination">
					<li class="page-item">
						<a class="page-link" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>">
							<?php esc_html_e( 'Next', 'cartzilla' ); ?><i class="czi-arrow-right ml-2"></i>
						</a>
					</li>
				</ul>
			<?php endif; ?>
		</nav>
	<?php endif; ?>

<?php else : ?>
	<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAACgCAIAAAAErfB6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyhpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTQ1IDc5LjE2MzQ5OSwgMjAxOC8wOC8xMy0xNjo0MDoyMiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTkgKE1hY2ludG9zaCkiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MjU2RTFEMDAwRTE2MTFFQTlDN0JDNTAzRUUyMzIxMDMiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MjU2RTFEMDEwRTE2MTFFQTlDN0JDNTAzRUUyMzIxMDMiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDoyNTZFMUNGRTBFMTYxMUVBOUM3QkM1MDNFRTIzMjEwMyIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDoyNTZFMUNGRjBFMTYxMUVBOUM3QkM1MDNFRTIzMjEwMyIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PvFvdAsAABaQSURBVHja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" width='80' class="d-block mb-4" alt="Empty cart">
	<p><?php esc_html_e( 'No order has been made yet.', 'cartzilla' ); ?></p>
	<a class="btn btn-primary" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
		<?php esc_html_e( 'Browse products', 'cartzilla' ); ?>
	</a>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
