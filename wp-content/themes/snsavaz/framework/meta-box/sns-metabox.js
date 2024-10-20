jQuery(document).ready(function($){
	$('.img-layout').each(function(){
		// Add active class
		if($(this).attr('data-value') == $('#snsavaz_layouttype').attr('value')){
			$(this).addClass('active');
		}
		showHideDependLayout($('#snsavaz_layouttype').attr('value'));
		// Click img select
		$(this).unbind('click').click(function(){
			// Change active class
			$val = $(this).attr('data-value'); $('.img-layout').removeClass('active'); $(this).addClass('active');
			// Set value for select
			$('#post-body #snsavaz_layouttype').attr('value', $val);
			// Hide or show field codition
			showHideDependLayout($val);
		});
	});
	//
	if ( $('#page_template').attr('value') == 'fullwidth.php' || $('#page_template').attr('value') == 'sidepage.php' ){
		$('#sns_layout').fadeOut(500);
	}else{
		$('#sns_layout').fadeIn(500);
	}
	
	$('#page_template').change(function(){
		if( $(this).attr('value') == 'fullwidth.php' || $('#page_template').attr('value') == 'sidepage.php' ){
			$('#sns_layout').fadeOut(500);
		}else{
			$('#sns_layout').fadeIn(500);
		}
	})
	function showHideDependLayout($val){
		if( $val == 'm' ){
			$('#post-body #snsavaz_leftsidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
			$('#post-body #snsavaz_rightsidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
		}else if( $val == 'l-m' ){
			$('#post-body #snsavaz_leftsidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeIn(500);
			$('#post-body #snsavaz_rightsidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
		}else if( $val == 'm-r' ){
			$('#post-body #snsavaz_rightsidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeIn(500);
			$('#post-body #snsavaz_leftsidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
		}
	}
	// Enable layout config
	$('#post-body input[name="snsavaz_enablelayoutconfig"]').each(function(){
		if( $(this).attr('checked') == 'checked' ) enableLayoutConfig( $(this).attr('value') );
		$(this).change(function(){
			enableLayoutConfig( $(this).attr('value') );console.log($(this).attr('value'));
		})
	})
	// $('#post-body input[name="sns_enablelayoutconfig"]').change(function(){
	// 	enableLayoutConfig( $(this).attr('value') );
	// })
	function enableLayoutConfig($val){
		if( $val == '1' ){
			$('#post-body #snsavaz_layouttype').parents('.rwmb-layouttype-wrapper').stop(true,true).fadeIn(500);
			showHideDependLayout($('#snsavaz_layouttype').attr('value'));
		}else{
			$('#post-body #snsavaz_leftsidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
			$('#post-body #snsavaz_rightsidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
			$('#post-body #snsavaz_layouttype').parents('.rwmb-layouttype-wrapper').stop(true,true).fadeOut(500);
		}
	}
	//
	showHideDependPostFormat($('#post-format-gallery').attr('checked'), '#sns-post-gallery' );
	showHideDependPostFormat($('#post-format-video').attr('checked'), '#sns-post-video' );
	showHideDependPostFormat($('#post-format-audio').attr('checked'), '#sns-post-audio' );
	showHideDependPostFormat($('#post-format-quote').attr('checked'), '#sns-post-quote' );
	showHideDependPostFormat($('#post-format-link').attr('checked'), '#sns-post-link' );
	$('#post-formats-select input').each(function(){
		$(this).unbind('click').click(function(){
			showHideDependPostFormat($('#post-format-gallery').attr('checked'), '#sns-post-gallery' );
			showHideDependPostFormat($('#post-format-video').attr('checked'), '#sns-post-video' );
			showHideDependPostFormat($('#post-format-audio').attr('checked'), '#sns-post-audio' );
			showHideDependPostFormat($('#post-format-quote').attr('checked'), '#sns-post-quote' );
			showHideDependPostFormat($('#post-format-link').attr('checked'), '#sns-post-link' );
		});
	});
	function showHideDependPostFormat($checked, $id){
		if( $checked == 'checked' ){
			$($id).stop(true,true).fadeIn(500);
		}else {
			$($id).stop(true,true).fadeOut(500);
		}
	}
	// Revolution
	$('#post-body input[name=snsavaz_useslideshow]').each(function(){
		if( $(this).attr('checked') == 'checked' ){
			if ( $(this).attr('value') == '1' ) {
				$('#post-body select#snsavaz_revolutionslider').parents('.rwmb-select-wrapper').stop(true,true).fadeIn(500);
			}else {
				$('#post-body select#snsavaz_revolutionslider').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
			}
		}
		$(this).change(function(){
			if ( $(this).attr('value') == '1' ) {
				$('#post-body select#snsavaz_revolutionslider').parents('.rwmb-select-wrapper').stop(true,true).fadeIn(500);
			}else {
				$('#post-body select#snsavaz_revolutionslider').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
			}
		})
	})
	// Theme color
	$('#post-body input[name=snsavaz_page_themecolor]').each(function(){
		if( $(this).attr('checked') == 'checked' ){
			if ( $(this).attr('value') == '1' ) {
				$('#post-body input#snsavaz_theme_color').parents('.rwmb-color-wrapper').stop(true,true).fadeIn(500);
			}else {
				$('#post-body input#snsavaz_theme_color').parents('.rwmb-color-wrapper').stop(true,true).fadeOut(500);
			}
		}
		$(this).change(function(){
			if ( $(this).attr('value') == '1' ) {
				$('#post-body input#snsavaz_theme_color').parents('.rwmb-color-wrapper').stop(true,true).fadeIn(500);
			}else {
				$('#post-body input#snsavaz_theme_color').parents('.rwmb-color-wrapper').stop(true,true).fadeOut(500);
			}
		})
	})

	// Header Layout
	$('#post-body select[id=snsavaz_header_layout]').each(function(){
		var $thisSelected = $(this).val();
		if($thisSelected == 'layout_1' || $thisSelected == 'layout_3'){
				$('#post-body select#snsavaz_header_sidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeIn(500);
				$('#post-body input#snsavaz_header_bg').parents('.rwmb-color-wrapper').stop(true,true).fadeIn(500);
				$('#post-body input#snsavaz_header_color').parents('.rwmb-color-wrapper').stop(true,true).fadeIn(500);
				$('#post-body #snsavaz_menubg_description').parents('.rwmb-image_advanced-wrapper').stop(true,true).fadeIn(500);
		}else{
				$('#post-body select#snsavaz_header_sidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
				$('#post-body input#snsavaz_header_bg').parents('.rwmb-color-wrapper').stop(true,true).fadeOut(500);
				$('#post-body input#snsavaz_header_color').parents('.rwmb-color-wrapper').stop(true,true).fadeOut(500);
				$('#post-body #snsavaz_menubg_description').parents('.rwmb-image_advanced-wrapper').stop(true,true).fadeOut(500);
		}

		$(this).on('change', function(){
			if(this.value == 'layout_1' || this.value == 'layout_3'){
				$('#post-body select#snsavaz_header_sidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeIn(500);
				$('#post-body input#snsavaz_header_bg').parents('.rwmb-color-wrapper').stop(true,true).fadeIn(500);
				$('#post-body input#snsavaz_header_color').parents('.rwmb-color-wrapper').stop(true,true).fadeIn(500);
				$('#post-body #snsavaz_menubg_description').parents('.rwmb-image_advanced-wrapper').stop(true,true).fadeIn(500);
			}else{
				$('#post-body select#snsavaz_header_sidebar').parents('.rwmb-select-wrapper').stop(true,true).fadeOut(500);
				$('#post-body input#snsavaz_header_bg').parents('.rwmb-color-wrapper').stop(true,true).fadeOut(500);
				$('#post-body input#snsavaz_header_color').parents('.rwmb-color-wrapper').stop(true,true).fadeOut(500);
				$('#post-body #snsavaz_menubg_description').parents('.rwmb-image_advanced-wrapper').stop(true,true).fadeOut(500);
			}
		});

	});
})
