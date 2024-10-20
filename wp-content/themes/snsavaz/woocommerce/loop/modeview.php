<?php
if (isset($_COOKIE['sns_woo_list_modeview']) && $_COOKIE['sns_woo_list_modeview']== 'grid') {
    $modeview = 'grid';
}elseif (isset($_COOKIE['sns_woo_list_modeview']) && $_COOKIE['sns_woo_list_modeview']== 'list') {
    $modeview = 'list';
}
?>
<ul class="mode-view pull-left">
    <li class="grid">
    	<a class="grid<?php echo ($modeview=='grid')?' active':''; ?>" data-mode="grid" href="#" title="<?php echo esc_html__('Grid', 'snsavaz'); ?>">
    		<i class="fa fa-th"></i><span><?php echo esc_html__('Grid', 'snsavaz'); ?></span>
    	</a>
    </li>
    <li class="list">
    	<a class="list<?php echo ($modeview=='list')?' active':''; ?>" data-mode="list" href="#" title="<?php echo esc_html__('List', 'snsavaz'); ?>">
            <i class="fa fa-th-list"></i><span><?php echo esc_html__('List', 'snsavaz'); ?></span>
        </a>
    </li>
</ul>