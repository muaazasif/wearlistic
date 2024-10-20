<?php
/*
* SNS Custom Box
*/

$output = '';
$id = rand().time();
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

vc_icon_element_fonts_enqueue( $icon_type ); 
$icon_style = '';
if( $icon_color != '' ){
	$icon_style .= 'color:'.esc_attr($icon_color).';';
}
if( $icon_font_size != '' ){
	$icon_style .= 'font-size:'.esc_attr($icon_font_size).'px;';
}
if( $icon_border_size != '' ){
	if( $border_color == '' ){
		$border_color = '#dfdfdf';
	}
	$icon_style .= 'border:'.esc_attr($icon_border_size).' solid '.esc_attr($border_color).';';
	if( $icon_border_radius != '' ){
		$icon_style .= 'border-radius:'.esc_attr($icon_border_radius).';';
	}
}
$icon_style .= 'display: inline-block;';
$tclass = 'sns-custom-box faa-parent';
$tclass .= ( trim(esc_attr($extra_class))!='' )?' '.esc_attr($extra_class):'';
$tclass .= esc_attr($this->getCSSAnimation( $css_animation ));
$icon_style .= 'text-align:left; line-height: '.esc_attr($icon_font_size).'px;';

ob_start();
?>
<style scoped>
		#sns-custombox-<?php echo $id; ?>{ text-align: <?php echo esc_attr($text_align); ?> }
		#sns-custombox-<?php echo $id; ?> .custom-box-wrapper > span{ <?php echo $icon_style; ?> }
</style>

<div id="sns-custombox-<?php echo $id; ?>" class="<?php echo esc_attr($tclass); ?>' animated-hover" >
	<div class="custom-box-wrapper">
		<span class="vc_icon_element-icon <?php echo esc_attr( ${"icon_" . $icon_type} ); ?> faa-horizontal"></span>
		<div class="content-custom-box">
			<?php if($title != ''):?>
			<h2 class="wpb_heading"><a href="<?php echo esc_url( $link ) ?>"><?php echo esc_html( $title ) ?></a></h2>
			<?php endif; ?>
			<?php if($desc != ''):?>
			<p><?php echo esc_html( $desc ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php


$output = ob_get_clean();
echo $output;