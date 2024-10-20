<?php

global $post;

if( !Shopkeeper_Opt::getOption( 'breadcrumbs', true ) ) {
	$custom_styles .= '
		.woocommerce .woocommerce-breadcrumb,
		.woocommerce-page .woocommerce-breadcrumb
		{
			display: none;
		}';
}

if( Shopkeeper_Opt::getOption( 'product_quantity_style', 'default' ) == 'custom' ) {
	$custom_styles .= '
		@media only screen and (max-width: 767px)
		{
			body.single-product .product_content_wrapper .product_infos form.cart .button:hover
			{
				background: ' . Shopkeeper_Opt::getOption( 'main_color', '#ff5943' ) . '!important;
			}
		}';

} else {
	$custom_styles .= '
		@media only screen and (max-width: 767px)
		{
			.product .product_infos form.cart .quantity:not(.custom) input.input-text.qty
			{
				color:  ' . Shopkeeper_Opt::getOption( 'body_color', '#545454' ) . '!important;
			}
		}';
}

$custom_styles .= '
	.woocommerce ul.products li.product .onsale,
	.woocommerce .products span.onsale,
	.woocommerce-page .products span.onsale,
	.woocommerce span.onsale,
	.wp-block-getbowtied-carousel ul.products li.product .onsale,
	.wc-block-grid .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-onsale
	{
		background:  ' . Shopkeeper_Opt::getOption( 'sale_badge_color', '#93af76' ) . ';
	}

	.shopkeeper_new_product
	{
		background-color:  ' . Shopkeeper_Opt::getOption( 'new_product_badge_color', '#ff5943' ) . ';
	}';

if ( isset($post->ID) && (get_post_meta( $post->ID, 'product_full_screen_description_meta_box_check', true ) == "on") ) {

	$custom_styles .= '
		#tab-description .boxed-row
		{
			max-width: 1255px;
			margin: 0 auto;
		}

		.woocommerce div.product .woocommerce-tabs #tab-description,
		.woocommerce #content div.product .woocommerce-tabs #tab-description,
		.woocommerce-page div.product .woocommerce-tabs #tab-description,
		.woocommerce-page #content div.product .woocommerce-tabs #tab-description
		{
			padding: 0;
		}

		#tab-description .row
		{
			padding: 0;
		}

		@media only screen and (max-width: 40.063em) {

			.woocommerce div.product .woocommerce-tabs #tab-description,
			.woocommerce #content div.product .woocommerce-tabs #tab-description,
			.woocommerce-page div.product .woocommerce-tabs #tab-description,
			.woocommerce-page #content div.product .woocommerce-tabs #tab-description
			{
				position: relative;
				top: -1px;
			}

			#tab-description .columns .columns
			{
				padding-left: 30px !important;
				padding-right: 30px !important;
			}
		}

		@media only screen and (min-width: 40.063em) and (max-width: 63.9375em) {

			#tab-description .columns .columns
			{
				padding-left: 60px !important;
				padding-right: 60px !important;
			}

		}

		@media only screen and (max-width: 63.9375em) {

			#tab-description .row,
			#tab-description .columns
			{
				padding-left: 0 !important;
				padding-right: 0 !important;
			}

			#tab-description .columns .row
			{
				margin-left: 0;
				margin-right: 0;
			}

			#tab-description .columns .columns .columns
			{
				padding-left: 0px !important;
				padding-right: 0px !important;
			}

			#tab-description .columns .wpb_content_element
			{
				padding-left: 0 !important;
				padding-right: 0 !important;
			}
		}

		@media only screen and (min-width: 63.9375em) {

			.woocommerce #tab-description > .row,
			.woocommerce #tab-description  .row  .large-centered
			{
				width:100% !important;
				max-width:100% !important;
				padding:0 !important;
				margin:0 !important;
			}
		}';
}

if( ( Shopkeeper_Opt::getOption( 'notification_mode', '1' ) == '1' ) && ( Shopkeeper_Opt::getOption( 'notification_style', '1' ) == '0' ) ) {

	$custom_styles .= '
		body.gbt_custom_notif:not(.woocommerce-account) .woocommerce-message .product_notification_wrapper .product_notification_background,
		body.gbt_custom_notif:not(.woocommerce-account) .woocommerce-info .product_notification_wrapper .product_notification_background
		{
			animation: image-in;
			animation-duration: 1.5s;
			animation-delay: .5s;
			animation-fill-mode: forwards;
			animation-timing-function: ease;
		}';
}

if( Shopkeeper_Opt::getOption( 'catalog_mode', false ) ) {
	$custom_styles .= '
	    form.cart div.quantity,
	    form.cart button.single_add_to_cart_button
	    {
	        display: none !important;
	    }';
}
