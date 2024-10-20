<?php
/*
* SNS Info Box
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$title = esc_html($title);

$first_title = '';
$first_space_pos = strpos($title, ' ');

if($first_space_pos > 0){
	$first_title = substr($title, 0, $first_space_pos);
	$sub_title = substr($title, $first_space_pos);
	$title = '<span>'.$first_title.'</span>'.$sub_title;
}

ob_start();
?>
<div class="sns-info-box">
	<div class="sns-info-box-wrapper">
		<div class="info-heading"><?php echo esc_html($heading); ?></div>
		<div class="info-title">
		<?php echo wp_kses( $title, array(
										'span' => array()
									)); ?>
		</div>
		<div class="info-desc"><?php echo esc_html($desc); ?></div>
		<div class="info-links">
			<?php 
			if($title_link_1):?>
			<a href="<?php echo esc_url($link_1);?>" title="<?php echo esc_attr($title_link_1); ?>" target="<?php echo esc_attr($link_target);?>"><?php echo esc_html($title_link_1); ?></a>
			<?php endif; ?>
			<?php
			if($title_link_2): ?>
			<a href="<?php echo esc_url($link_2);?>" title="<?php echo esc_attr($title_link_2); ?>" target="<?php echo esc_attr($link_target);?>"><?php echo esc_html($title_link_2); ?></a>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php
$output = ob_get_clean();

echo $output;