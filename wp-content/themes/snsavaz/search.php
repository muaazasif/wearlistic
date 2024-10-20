<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage snstheme
 */

$lclass = '';
$rclass = '';
$mclass = '';
$hasL = 0;
$hasR = 0;

$layouttype = snsavaz_themeoption('layouttype', 'l-m');

if ( $layouttype == 'l-m'){
    $lclass .= 'col-md-3';
    $mclass = 'col-md-9';
    $hasL = 1;
}elseif( $layouttype == 'm-r' ){
    $rclass .= 'col-md-3';
    $mclass = 'col-md-9';
    $hasR = 1;
}elseif( $layouttype == 'l-m-r' ){
    $lclass .= 'col-md-3';
    $rclass .= 'col-md-3';
    $mclass = 'col-md-6';
    $hasL = 1;
    $hasR = 1;
}else{
    $mclass = 'col-md-12';
}
?>
<?php get_header(); ?>
<!-- Content -->
<div id="sns_content">
	<div class="container">
		<div class="row sns-content">
		    <?php if( $hasL == 1): ?>
			<!-- left sidebar -->
			<div class="<?php echo esc_attr($lclass); ?> sns-left">
			    <?php 
			    if( class_exists('WooCommerce') && is_woocommerce() ){
			        dynamic_sidebar( 'woo-sidebar'); 
			    }else{
			        if( snsavaz_themeoption('leftsidebar')!= '' && is_active_sidebar( snsavaz_themeoption('leftsidebar') ) ) :
			        	dynamic_sidebar( snsavaz_themeoption('leftsidebar') ); 
			        else :
			        	dynamic_sidebar('widget-area');
			        endif;
			    }
			    ?>
			</div>
			<?php endif; ?>
			<!-- Main content -->
			<div class="<?php echo esc_attr($mclass); ?> sns-main">
				<h1 class="page-header"><?php printf( esc_html__( 'Search Results for: %s', 'snsavaz' ), get_search_query() ); ?></h1>
			    <?php
			    if ( have_posts() ) :
			    	$pagination = snsavaz_themeoption('pagination', 'def'); // get theme option
			    	?>
			    	<div id="snsmain" class="blog-layout2 posts sns-blog-posts ">
				    	<?php 
						// Theloop
						while ( have_posts() ) : the_post();
						    get_template_part( 'content', 'search' );
						endwhile;
						// Paging
						if( $pagination == 'def' || $pagination == '')
							get_template_part('tpl-paging');
						?>
			    	</div>
			    <?php
				    if( $pagination == 'ajax')
				    	snsavaz_paging_nav_ajax('#snsmain', 'content-search' ); // This paging nav should be outside #snsmain div
				    
				    echo '<input type="hidden" name="hidden_snsavaz_blog_layout" value="' . snsavaz_themeoption('blog_type') .  '">';
			    
			    // If no posts found
			    else:
			    	get_template_part( 'content', 'none' );
			    endif; ?>
			</div>
			<?php if ($hasR == 1): ?>
			<!-- Right sidebar -->
			<div class="<?php echo esc_attr($rclass); ?> sns-right">
			    <?php 
			    if( class_exists('WooCommerce') && is_woocommerce() ){
			        dynamic_sidebar( 'woo-sidebar'); 
			    }else{
			    	if( snsavaz_themeoption('rightsidebar')!= '' && is_active_sidebar( snsavaz_themeoption('rightsidebar') ) ) :
			    	dynamic_sidebar( snsavaz_themeoption('rightsidebar') );
			    	else :
			    	dynamic_sidebar('widget-area');
			    	endif;
			    }
			    ?>
			</div>
			<?php endif ?>
		</div>
	</div>
</div>
<!-- End Content -->
<?php get_footer(); ?>