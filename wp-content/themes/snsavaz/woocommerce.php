<?php
$lclass = '';
$rclass = '';
$mclass = '';
$hasL = 0;
$hasR = 0;

$snsavaz_layouttype = snsavaz_metabox('snsavaz_layouttype', 'm-r');

if( is_product() ){
	$mclass = 'col-md-12';
}else{
	if ( $snsavaz_layouttype == '' || $snsavaz_layouttype == 'l-m'){
	    $lclass .= 'col-md-3';
	    $mclass = 'col-md-9';
	    $hasL = 1;
	}elseif( $snsavaz_layouttype == 'm-r' ){
	    $rclass .= 'col-md-3';
	    $mclass = 'col-md-9';
	    $hasR = 1;
	}elseif( $snsavaz_layouttype == 'l-m-r' ){
	    $lclass .= 'col-md-3';
	    $rclass .= 'col-md-3';
	    $mclass = 'col-md-6';
	    $hasL = 1;
	    $hasR = 1;
	}else{
	    $mclass = 'col-md-12';
	}
}
?>
<?php get_header(); ?>
<!-- Content -->
<div id="sns_content">
	<div class="container">
		<div class="row sns-content sns-woocommerce-page">
			<?php if ($hasL == 1) :?>
			<!-- left sidebar -->
			<div class="<?php echo esc_attr($lclass); ?> sns-left">
			    <?php 
				if( snsavaz_metabox('snsavaz_leftsidebar')!= '' && is_active_sidebar( snsavaz_metabox('snsavaz_leftsidebar') ) ){
			        dynamic_sidebar( snsavaz_metabox('snsavaz_leftsidebar') );
			    }else{
			        dynamic_sidebar( 'woo-sidebar' );
			    }
			    ?>
			</div>
		<?php endif; ?>
			<!-- Main content -->
			<div class="<?php echo esc_attr($mclass); ?> sns-main">
			    <?php
		    	if( is_product() ){
					wc_get_template( 'single-product.php' );
				}else{
					wc_get_template( 'listing-product.php' );
				}
				?>
			</div>
			<?php if ($hasR == 1): ?>
			<!-- Right sidebar -->
			<div class="<?php echo esc_attr($rclass); ?> sns-right">
			    <?php 
			    if( snsavaz_metabox('snsavaz_rightsidebar')!= '' && is_active_sidebar( snsavaz_metabox('snsavaz_rightsidebar') ) ){
			        dynamic_sidebar( snsavaz_metabox('snsavaz_rightsidebar') );
			    }else{
			        dynamic_sidebar( 'woo-sidebar' );
			    }
			    ?>
			</div>
			<?php endif ?>
		</div>
	</div>
</div>
<!-- End Content -->
<?php get_footer(); ?>