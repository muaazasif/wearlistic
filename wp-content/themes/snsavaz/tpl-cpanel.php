<?php
$theme_color = snsavaz_themeoption('theme_color', '#e34444');

// Get page meta data
if (function_exists('rwmb_meta') && rwmb_meta('snsavaz_page_themecolor') == 1) {
	$theme_color = rwmb_meta('snsavaz_theme_color') != '' ? rwmb_meta('snsavaz_theme_color') : $theme_color;
}

$theme_color = str_replace('#', '', $theme_color);
$boxedlayout =  snsavaz_themeoption('use_boxedlayout');
$stickymenu = snsavaz_themeoption('use_stickmenu');

?>
<div id="sns_cpanel">
    <div class="cpanel-head">
    	<a class="button btn-buy" href="#" title="<?php echo esc_html__('Buy Theme Now', 'snsavaz'); ?>"><?php echo esc_html__('Buy Theme Now', 'snsavaz'); ?></a>
    </div>
    <div class="cpanel-set">
    	<div class="form-group">
    		<div class="col-xs-12">
				<label><?php echo esc_html__('Theme Color', 'snsavaz'); ?></label>
				<?php /*
				<div class="" id="cpanel_themecolor">
					<input data-default-color="<?php echo esc_attr($theme_color); ?>" name="sns_themeboxcolor" type="text" id="sns_themeboxcolor" value="<?php echo esc_attr($theme_color); ?>" />
					
					<input type="hidden" name="sns_themecolor" value="<?php echo esc_attr($theme_color); ?>"/>
				</div>
				*/ ?>
				<div class="" id="cpanel_themecolor">
					<a class="<?php echo ( $theme_color == 'c4b498' ) ? 'active color' : 'color'; ?>" href="<?php echo ( get_page(370) ) ? esc_url( get_page_link(370) ) : '' ; ?>" data-color="c4b498">#c4b498</a>
					<a class="<?php echo ( $theme_color == 'e34444' ) ? 'active color' : 'color'; ?>" href="<?php echo ( get_page(372) ) ? esc_url( get_page_link(372) ) : '' ; ?>" data-color="e34444">#e34444</a>
                    <a class="<?php echo ( $theme_color == '17a7f1' ) ? 'active color' : 'color'; ?>" href="<?php echo ( get_page(374) ) ? esc_url( get_page_link(374) ) : '' ; ?>" data-color="17a7f1">#17a7f1</a>
				</div>

				<p><?php echo esc_html__('You can also sellect color codes via admin theme options', 'snsavaz'); ?></p>
			</div>		
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<label><?php echo esc_html__('Enable sticky menu', 'snsavaz'); ?></label>
				<div class="content sticky_menu">
					<a class="<?php echo ($stickymenu == 1)?'active menu':'menu'; ?>" href="#" data-sticky="1">Yes</a>
					<a class="<?php echo ($stickymenu == 0)?'active menu':'menu'; ?>" href="#" data-sticky="0">No</a>
					<input type="hidden" name="sticky_menu" value="<?php echo esc_attr($stickymenu); ?>"/>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<label><?php echo esc_html__('Use boxed Layout', 'snsavaz'); ?></label>
				<div class="content boxed_layout">
					<a class="<?php echo ($boxedlayout == 1)?'active layout':'layout'; ?>" href="#" data-boxed="1">Yes</a>
					<a class="<?php echo ($boxedlayout == 0)?'active layout':'layout'; ?>" href="#" data-boxed="0">No</a>
					<input type="hidden" name="sns_boxed_layout" value="<?php echo esc_attr($boxedlayout); ?>" />
				</div>
			</div>
		</div>
    </div>
    <div class="cpanel-bottom">
    	<div class="form-group">
			<div class="col-xs-12">
				<div class="button-action">
					<!--<a class="button btn-preview" href="#"><?php //echo esc_html__('Preview', 'snsavaz'); ?></a> -->
					<a class="button btn-reset" href="#"><?php echo esc_html__('Reset Options', 'snsavaz'); ?></a>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<!-- <label>Cpanel tool</label> -->
				<p><?php echo esc_html__('That is some options to demo for you.', 'snsavaz'); ?></p>
			</div>
		</div>
	</div>
    <div id="sns_cpanel_btn">
        <i class="fa fa-cog fa-spin"></i>
    </div>
	<script type="text/javascript">
	// <![CDATA[
	jQuery(document).ready(function($){
		
		$('#sns_cpanel_btn').click(function(){
			if( !$('#sns_cpanel').hasClass('open') ){
				$('#sns_cpanel').animate({right:'0px'});
				$('#sns_cpanel').addClass('open');
			}else{
				$('#sns_cpanel').animate({right:'-290px'});
				$('#sns_cpanel').removeClass('open');
			}
		});
		
		// var themecolorOptions = {
		// 		change: function(event, ui){
		// 		    $('input[name="sns_themecolor"]').val(ui.color.toString());
		// 		    //console.log(ui.color.toString());
		// 		},
		// };
		
		//$("#sns_themeboxcolor").wpColorPicker(themecolorOptions);
		
		$('#cpanel_themecolor a').each(function(){
			$(this).css({
				'background-color': '#'+$(this).data('color')
			});
		})

		// Click theme color
		$('#cpanel_themecolor a').click(function(){
            var color = $(this).data('color');
            var href = $(this).attr('href');
            $('#sns_cpanel').addClass('wait');
            if ( href != '#' ) window.location.href = href;
            else window.location.href = window.location.href;
            return false;
        });

        // Click Boxed Layout
		$('#sns_cpanel .boxed_layout a').click(function(){
            var boxed = $(this).attr('data-boxed');
            var href = '<?php echo site_url(); ?>';
            $('#sns_cpanel').addClass('wait');
            $.ajax({
                url: ajaxurl,
                data:{
                	action : 'sns_setcookies',
                	key	: 'use_boxedlayout',
                	value : boxed
                },
                type: 'POST',
                success:function(result){
                	if ( href != '#' ) window.location.href = href;
                	else window.location.href = window.location.href;
                }
            });
            return false;
        });
        
        // Click Sticky Menu
		$('#sns_cpanel .sticky_menu a').click(function(){
            var sticky = $(this).data('sticky');
            var href = $(this).attr('href');
            $('#sns_cpanel').addClass('wait');
            $.ajax({
                url: ajaxurl,
                data:{
                	action : 'sns_setcookies',
                	key	: 'use_stickmenu',
                	value : sticky
                },
                type: 'POST',
                success:function(result){
                	if ( href != '#' ) window.location.href = href;
                	else window.location.href = window.location.href;
                }
            });
            return false;
        });
        
        // Reset cookie
        $('#sns_cpanel .btn-reset').click(function(){
            var href = '<?php echo site_url(); ?>';
            $('#sns_cpanel').addClass('wait');
            $.ajax({
                url: ajaxurl,
                data:{
                	action : 'sns_resetcookies'
                },
                type: 'POST',
                success:function(result){
                	if ( href != '#' ) window.location.href = href;
                	else window.location.href = window.location.href;
                }
            });
            return false;
        });
	});
	// ]]>
	</script>
</div>