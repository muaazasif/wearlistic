<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
// Array tabs title
$tab_titles = $this->snsavaz_getListTabTitle();

$uq = rand().time();
$class = 'sns-product-tabs woocommerce template-'.esc_attr($template);
if( $template == 'carousel' ){
	wp_enqueue_script('owlcarousel');
	$class .= ' pre-load'; 
}
$class .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
$class .= esc_attr($this->getCSSAnimation( $css_animation ));

ob_start();
?>
<div id="sns_product_tabs<?php echo esc_attr($uq);?>" class="<?php echo esc_attr($class); ?>">
<?php if( class_exists('WooCommerce') ){ ?>
	<?php 
	if ($template == 'grid') :
		$number_query = $row*$col;
	else:
		$number_query = $number_limit;
	endif;
	
	if ($tab_types == 'category'){
		if( empty($list_cat) ){
			$tabs = $this->snsavaz_getCats();
		}else{
			$tabs = explode(',', $list_cat);
		}
	}else{ // Tab type orderby
		$tabs = explode(',', $list_orderby);
	}
	?>
	
	<div class="sns-nav-tabs-warpper <?php echo esc_attr($heading_style); ?>">
		<?php if ($title !='' ) : ?>
		<h2 class="wpb_heading"><span><?php echo esc_attr($title); ?></span></h2>
		<?php endif; ?>
		<ul class="nav-tabs gfont">
			<?php
			$i = 0;
			$aclass = '';
			$data_type = 'cat';
			foreach ($tab_titles as $tab) { 
				$i++;
				$aclass = 'intent-tab ';
				if ( $i == 1){
					$class = 'nav-item first';
					$aclass .= 'tab-loaded ';
				}else{
					$class = 'nav-item';
				}
				
				if($tab_types == 'category'){
					$cat = $tab['name'];
					$data_type = 'cat';
				}else{
					$cat = $list_cat;
					$orderby = $tab['name'];
					$data_type = 'order';
				}
				
				?>
					<li class="<?php echo esc_attr($class); ?>">
						<a href="#producttabs_<?php echo esc_attr($tab['name'].$uq); ?>" class="<?php echo esc_attr($aclass);?>" title="<?php echo esc_attr($tab['title']); ?>"
							data-type			= "<?php echo esc_attr($data_type);?>"
							data-wrap-id		= "sns_product_tabs<?php echo esc_attr($uq);?>"
							data-tab-id			= "producttabs_<?php echo esc_attr($tab['name'].$uq);?>"
							data-cat			= "<?php echo esc_attr($cat);?>"
							data-template		= "<?php echo esc_attr($template);?>"
							data-orderby		= "<?php echo esc_attr($orderby);?>"
							data-number-query	= "<?php echo esc_attr($number_query);?>"
							data-number-display	= "<?php echo esc_attr($number_display);?>"
							data-number-limit	= "<?php echo esc_attr($number_limit);?>"
							data-effect-load	= "<?php echo esc_attr($effect_load);?>"
							data-col			= "<?php echo esc_attr($col);?>"
							data-uq				= "<?php echo esc_attr($uq);?>"
							data-number-load	= "<?php echo esc_attr($number_load);?>"
							>
							<span><?php echo esc_html($tab['short_title']); ?></span>
						</a>
					</li>
				<?php
			}
			?>
		</ul>
		<ul>
		    <li class="dropdown pull-left tabdrop hidden-lg hidden-md">
		        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
		            <span class="display-tab"><i class="fa fa-align-justify"></i></span>
		        </a>
		        <ul class="dropdown-menu gfont">
		            <?php
		            foreach ($tab_titles as $tab) { 
		                ?>
		                <li class="nav-item">
		                    <a href="#drop_producttabs_<?php echo esc_attr($tab['name']); ?>" class="<?php echo esc_attr($aclass);?>" title="<?php echo esc_attr($tab['title']); ?>"
								data-type			= "<?php echo esc_attr($data_type);?>"
								data-wrap-id		= "sns_product_tabs<?php echo esc_attr($uq);?>"
								data-tab-id			= "producttabs_<?php echo esc_attr($tab['name'].$uq);?>"
								data-cat			= "<?php echo esc_attr($cat);?>"
								data-template		= "<?php echo esc_attr($template);?>"
								data-orderby		= "<?php echo esc_attr($orderby);?>"
								data-number-query	= "<?php echo esc_attr($number_query);?>"
								data-number-display	= "<?php echo esc_attr($number_display);?>"
								data-number-limit	= "<?php echo esc_attr($number_limit);?>"
								data-effect-load	= "<?php echo esc_attr($effect_load);?>"
								data-col			= "<?php echo esc_attr($col);?>"
								data-uq				= "<?php echo esc_attr($uq);?>"
								data-number-load	= "<?php echo esc_attr($number_load);?>"
		                    ><?php echo esc_html($tab['short_title']); ?></a>
		                </li>
		            <?php } ?>
		        </ul>
		    </li>
		</ul>
	</div><!-- /.sns-nav-tabs-warppe -->
	
	<div class="tab-content">
	<?php 
		$ii = 0;
		foreach ($tabs as $tab) {
			$ii ++;
			if( $ii == 1){
				if($tab_types == 'category'){
					$cat = $tab;
				}else{
					$cat = $list_cat;
					$orderby = $tab;
				}
				$tab_args = array(
					'data_type'		=> $data_type,
					'wrap_id'		=> 'sns_product_tabs'.$uq,
					'tab_id'		=> 'producttabs_'.$tab.$uq,
					'cat'			=> $cat,
					'template'		=> $template,
					'orderby'		=> $orderby,
					'number_query'	=> $number_query,
					'number_display'=> $number_display,
					'number_limit'	=> $number_limit,
					'effect_load'	=> $effect_load,
					'col'			=> $col,
					'uq'			=> $uq,
					'number_load'	=> $number_load
				);
				wc_get_template( 'vc/template-tab.php', array('tab_args' => $tab_args) );
	    	}
		}
	?>
	</div>
<?php } ?>
</div>
<?php
$output .= ob_get_clean();
wp_reset_postdata();
echo $output;
