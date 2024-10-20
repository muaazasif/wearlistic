<?php
/**
 * The template for displaying tab content of Product Tabs shortcode
 *
 */
?>
<?php 
extract($tab_args);
$eclass_e = '';
if ( isset($eclass) && $eclass){
	$eclass_e = $eclass;
}

if ( isset($animate) && $animate){
    $animate = $animate;
}else{
    $animate = '';
}
?>
<div id="<?php echo esc_attr($tab_id); ?>" class="tab-pan fade sns-template-tab">
<?php 
	$loop = snsavaz_woo_query($orderby, $number_query, $cat);
    if( $loop->have_posts() ):
        	if ($template == 'grid') :
        		?>
        		<ul class="products product_list grid <?php echo esc_attr($effect_load); ?>">
        		<?php
        		while ( $loop->have_posts() ) : $loop->the_post();
                	wc_get_template( 'vc/item-grid.php', array('col' => $col, 'animate' => $animate , 'eclass' => $eclass_e) );
            	endwhile;
            	?>
            	</ul>
            	<div class="sns-woo-loadmore-wrap">
            		<?php $loadmoreID = ($data_type == 'cat') ?  $cat : $orderby; ?>
            		<div id="sns_woo_loadmore_<?php echo esc_attr($loadmoreID).'_'.$uq; ?>" class="sns-woo-loadmore btn gfont"
            			data-tab-id = "<?php echo esc_attr($tab_id);?>"
                        data-numberquery="<?php echo esc_attr($number_load);?>"
            			data-start="<?php echo esc_attr($number_query); ?>"
            			data-order="<?php echo esc_attr($orderby); ?>"
            			data-cat="<?php echo esc_attr($cat); ?>"
            			data-col="<?php echo esc_attr($col); ?>"
            			data-type="<?php echo esc_attr($data_type); ?>"
            			data-loadtext="<?php echo esc_html__('Load more items', 'snsavaz'); ?>"
            			data-loadingtext="<?php echo esc_html__('Loading...', 'snsavaz'); ?>"
            			data-loadedtext="<?php echo esc_html__('All ready', 'snsavaz'); ?>">
            			<?php echo esc_html__('Load more items', 'snsavaz'); ?>
            		</div>
            	</div>
                <script type="text/javascript">
                    jQuery(document).ready(function($){
                        SnsJsWoo.snsWooLoadMore("#sns_woo_loadmore_<?php echo esc_attr($loadmoreID).'_'.$uq; ?>");
                    });
                </script>
            	<?php
            else:
            ?>
           		<div class="navslider"><span class="prev"><i class="fa fa-long-arrow-left"></i></span><span class="next"><i class="fa fa-long-arrow-right"></i></span></div>
            
            <?php
        	    	wc_get_template( 'vc/carousel.php', array('loop' => $loop, 'number_display' => intval($number_display), 'number_limit' => intval($number_limit), 'wrap_id' => esc_attr($wrap_id), 'id' => esc_attr($tab_id), 'animate' => $animate , 'eclass' => $eclass_e) );
        	    endif;
            ?>
    <?php
    else:
        wc_get_template( 'loop/no-products-found.php' );
    endif;
    
    $template = '';
    ?>
</div>