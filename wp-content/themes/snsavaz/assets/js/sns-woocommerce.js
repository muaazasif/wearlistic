(function ($) {
	"use strict";
	$(document).ready(function() {
		// Click mode view
		$('.mode-view a').click(function(){
            var mode = $(this).data('mode');
            if(!$(this).hasClass('active')){
	            $.ajax({
	                url: ajaxurl,
	                data:{
	                	action : 'sns_setmodeview',
	                	mode : mode
	                },
	                type: 'POST'
	            });
	        }else{
	        	return false;
	        }
	        $('.mode-view a').removeClass('active');
            $('.mode-view a').each(function(){
            	if ( $(this).hasClass(mode) ) $(this).addClass('active');
            })
            
            //
            if( $('#sns_woo_list.product_list').hasClass('grid') ){
            	$('#sns_woo_list.product_list').removeClass('grid');
            	$('#sns_woo_list.product_list').addClass('list');
            }else if( $('#sns_woo_list.product_list').hasClass('list') ){
            	$('#sns_woo_list.product_list').removeClass('list');
            	$('#sns_woo_list.product_list').addClass('grid');
            }
            return false;
        });
		// Rating
		$('.star-rating .value').each(function(){
			if( typeof $(this).attr('data-width') !== typeof undefined ){
				$(this).css('width', $(this).attr('data-width'));
			}
		})
        // Accordion for category
		$('.product-categories').SnsAccordion({
			btn_open: '<span class="ac-tongle open"></span>',
			btn_close: '<span class="ac-tongle close"></span>',
		});
		// Click add to cart
		$('.grid-view a.add_to_cart_button.product_type_simple').click(function(e) {
			var $this = $(this);
		});
		$('.list-view a.add_to_cart_button.product_type_simple').each(function() {
		});

		// Wishlist & compare
		$('.type-product .summary .compare, .yith-wcwl-add-to-wishlist .add_to_wishlist, .yith-wcwl-wishlistaddedbrowse a, .yith-wcwl-wishlistexistsbrowse a').each(function(){
			$(this).attr('data-toggle', 'tooltip').attr('data-original-title', $(this).text().trim());
		});

		jQuery(document).ajaxComplete(function(){
			// Wishlist & compare
			$('.type-product .summary .compare, .yith-wcwl-add-to-wishlist .add_to_wishlist, .yith-wcwl-wishlistaddedbrowse a, .yith-wcwl-wishlistexistsbrowse a').each(function(){
				$(this).attr('data-toggle', 'tooltip').attr('data-original-title', $(this).text().trim());
			});
			// View cart
			$('.products .added_to_cart').each(function(){
				if( $(this).text().trim() != '') $(this).attr('data-toggle', 'tooltip').attr('data-original-title', $(this).text().trim());
			});
			// Compare
			$('.woocommerce .compare.button').each(function(){
				if( $(this).text().trim() != '') $(this).attr('data-original-title', $(this).text().trim());
			});
			// Need check clear all .clear-all
			// Mini cart number
			$('.sns-ajaxcart .tongle .number-item').html($('.sns-ajaxcart .sns-cart-number').html());
			// Compare number
			var countC = 0;
			$('.block-compare .products-list > li').each(function(){
				if( $(this).find('a').length ) countC ++;
			});
			$('.block-compare .compare-toggle .total-compare-val').html(countC);
		});
		
		
		snsProductTabsListHeight();

		// Product tabs load products
		if( $('.sns-product-tabs').length > 0 ){

			$('.sns-product-tabs').each(function(){
				var $this_product_tabs_id = $(this).attr('id');
				// Only handle preload for template is carousel
				$('#'+$this_product_tabs_id+'.template-carousel').removeClass('pre-load');
				// Tab
				$('#'+$this_product_tabs_id+' .nav-tabs').find("li").first().addClass("active");
				$('#'+$this_product_tabs_id+' ul.dropdown-menu').find("li").first().addClass("active");
				// Tab content
				$('#'+$this_product_tabs_id+' .tab-content .tab-pan').css({'overflow':'hidden', 'height':'0'});
				$('#'+$this_product_tabs_id+' .tab-content').find(".tab-pan").first().addClass("active in").css({'overflow':'', 'height':''});
				// Handle click
				$('#'+$this_product_tabs_id+' .nav-tabs > li, '+'#'+$this_product_tabs_id+' ul.dropdown-menu > li').click(function(e){
					e.preventDefault();
					if( !$(this).hasClass('active') ){
						var id = $(this).find('a').attr('href');
						// lazyload
						if( $('body').hasClass('use_lazyload') ){
							var timeout = setTimeout(function() {
						        $(id + " img.lazy:not(.loaded)").trigger("appear")
						    }, 2000);
						}
						// Tab
						$('#'+$this_product_tabs_id+' .nav-tabs li').removeClass('active');
						$('#'+$this_product_tabs_id+' ul.dropdown-menu li').removeClass('active');
						$(this).addClass('active');
						if( id.indexOf('drop_') == 1){
							id = id.replace('drop_', '');
							$('#'+$this_product_tabs_id+' .nav-tabs li').each(function(){
								if ( $(this).find('a').attr('href') == id ) $(this).addClass('active');
							})	
						}else{
							$('#'+$this_product_tabs_id+' ul.dropdown-menu li').each(function(){
								if ( $(this).find('a').attr('href').replace('drop_', '') == id ) $(this).addClass('active');
							})
						}
						// Tab content
						$('#'+$this_product_tabs_id+' .tab-pan').removeClass('active').removeClass('in').css({'overflow':'hidden', 'height':'0'});
						$('#'+$this_product_tabs_id).find(id).addClass('active').addClass('in').css({'overflow':'', 'height':''});
						// Reset effect
						SnsJsWoo.resetAnimate($(this));
						return false;
					}
				});
				// set min height of tab content
				var $tab_content_height = $(this).find('.tab-content').height();
				$(this).find('.tab-content').css('min-height', $tab_content_height);

				$(this).find('.nav-tabs a.intent-tab, ul.dropdown-menu > li a.intent-tab').each(function(){
					$(this).one('click', function(){
						var $this = $(this);
						// Load tab products
						if( ! $this.hasClass('tab-loaded')){
							$('#'+$this_product_tabs_id+' .tab-content').addClass('tab-loading');
							var data_type 			= $(this).attr('data-type'),
								wrap_id 			= $(this).attr('data-wrap-id'),
								tab_id 				= $(this).attr('data-tab-id'),
								cat 				= $(this).attr('data-cat'),
								template 			= $(this).attr('data-template'),
								orderby 			= $(this).attr('data-orderby'),
								number_query 		= $(this).attr('data-number-query'),
								number_display 		= $(this).attr('data-number-display'),
								number_limit 		= $(this).attr('data-number-limit'),
								effect_load 		= $(this).attr('data-effect-load'),
								col 				= $(this).attr('data-col'),
								uq 					= $(this).attr('data-uq'),
								number_load 		= $(this).attr('data-number-load');
							var eclass = 'animate-'+Math.floor((Math.random() * 1000000000));
							$.ajax({
				                url: ajaxurl,
				                data:{
				                	action 				: 'sns_wootabloadproducts',
				                	data_type 			: data_type,
				                	wrap_id				: wrap_id,
				                	tab_id 				: tab_id,
									cat 				: cat,
									template 			: template,
									orderby 			: orderby,
									number_query 		: number_query,
									number_display 		: number_display,
									number_limit 		: number_limit,
									effect_load 		: effect_load,
									col 				: col,
									uq 					: uq,
									number_load 		: number_load,
									eclass				: eclass,
				                },
				                type: 'POST',
				                success: function(data){
				                	if( data!='' ){
					                	$('#'+$this_product_tabs_id+' .tab-content').removeClass('tab-loading');
					                	$('#'+$this_product_tabs_id+' .tab-content').append(data);
					                	$('#'+$this_product_tabs_id+' .tab-content').find('#'+tab_id).addClass('active in');
					                	SnsJsWoo.setAnimate( '#'+$this_product_tabs_id+ ' .tab-content  #'+tab_id, eclass );
					                	$this.addClass('tab-loaded');
					                	// lazy load image
					                	if( $('body').hasClass('use_lazyload') ){
											$('#' + tab_id + ' img.lazy').each(function(){
													$(this).lazyload();
											});
										}
					                }else{
					                	
					                }
				                }
				            });
				            snsProductTabsListHeight();
						}
						// END Load tab products
					});
				});
			});
		}

	});
})(jQuery);

// Set min-height for product tabs list
function snsProductTabsListHeight(){
	var $product_list_h = 0;
	jQuery('.sns-product-tabs ul.product_list > li').each(function(){
		var _this_height = jQuery(this).height();
		if( $product_list_h > 0 && _this_height < $product_list_h){
			jQuery(this).css( 'min-height', $product_list_h);
		}else{
			$product_list_h = _this_height;
		}
	});
}

var SnsJsWoo= {
	setAnimate: function (el, eclass){
		jQuery(el).find('.sns-woo-loadmore').fadeOut('fast');
		morec = '';
		if( jQuery(el+' .product_list').hasClass('owl-carousel') ){
		 	morec = '.owl-item.active ';
		}
		jQuery(el+' .product_list '+morec+'.'+eclass).each(function(i){
			jQuery(this).attr("style", "-webkit-animation-delay:" + i * 300 + "ms;"
	                + "-moz-animation-delay:" + i * 300 + "ms;"
	                + "-o-animation-delay:" + i * 300 + "ms;"
	                + "animation-delay:" + i * 300 + "ms;");
			if (i == jQuery(el+' .product_list '+morec+'.'+eclass).size() -1) {
	            jQuery(el+' .product_list').addClass("play");
	            jQuery(el).find('.sns-woo-loadmore').fadeIn(i*0.3);
	            if( morec!='' ){
	            	setTimeout(function(){
	            		SnsJsWoo.delAnimate(el);
	            	}, i*300+700);
	            }
	        }
		});

		snsProductTabsListHeight();
	},
	resetAnimate: function (el){
		var wrapid, eclass, contentid;
		wrapid = el.parents('.sns-product-tabs').attr('id');
    	eclass = 'animate-'+Math.floor((Math.random() * 1000000000));
    	contentid = el.find('a').attr('href');
    	//
    	jQuery('#'+wrapid+' .product_list').removeClass('play');
    	jQuery('#'+wrapid+' .product_list li').removeClass('item-animate');
    	jQuery('#'+wrapid+' .product_list li').attr('style', '');
    	// Remove class with prefix animate-
    	var classNames = [];
		jQuery('#'+wrapid+' .product_list li[class*="animate-"]').each(function(i, el){
		    var name = (el.className.match(/(^|\s)(animate\-[^\s]*)/) || [,,''])[2];
		    if(name){
		        classNames.push(name);
		        jQuery(el).removeClass(name);
		    }
		});
    	//
    	jQuery('#'+wrapid+' '+contentid+' .product_list li').addClass('item-animate').addClass(eclass);
    	// Set effect
	    SnsJsWoo.setAnimate('#'+wrapid+' '+contentid, eclass );

	},
	delAnimate: function(el){
		if( jQuery(el+' .product_list li').hasClass('item-animate') ) jQuery(el+' .product_list li').removeClass('item-animate');
	},
	// Click loadmore from shortcode SNS Product Tabs
	snsWooLoadMore: function(readmore){
		if (readmore == '') readmore = '.sns-woo-loadmore';
		jQuery(readmore).each(function() {
			jQuery(this).click(function(){
				if(!jQuery(this).hasClass('loaded')){
					var btnid, tab_id, numberquery, start, order, col, cat, loadtext, loadingtext, loadedtext, type, wrapid, eclass;
					btnid       = jQuery(this).attr('id');
					tab_id 		= jQuery(this).attr('data-tab-id'),
					numberquery = jQuery(this).attr('data-numberquery');
					start       = jQuery(this).attr('data-start');
	            	order       = jQuery(this).attr('data-order');
	            	col         = jQuery(this).attr('data-col');
	            	cat         = jQuery(this).attr('data-cat');
	            	loadtext    = jQuery(this).attr('data-loadtext');
	            	loadingtext = jQuery(this).attr('data-loadingtext');
	            	loadedtext  = jQuery(this).attr('data-loadedtext');
	            	type        = jQuery(this).attr('data-type');

	            	wrapid = jQuery('#'+btnid).parents('.sns-product-tabs').attr('id'); //alert(wrapid);

	            	eclass = 'animate-'+Math.floor((Math.random() * 1000000000));

	            	jQuery('#'+btnid).html(loadingtext); jQuery('#'+btnid).addClass('loading');

		            jQuery.ajax({
		                url: ajaxurl,
		                data:{
		                	action 		: 'sns_wooloadmore',
		                	numberquery : numberquery,
		                	start       : start,
		                	order       : order,
		                	col         : col,
		                	cat         : cat,
		                	eclass      : eclass,
		                },
		                type: 'POST',
		                success: function(data){
		                	if( data!='' ){
		                		jQuery('#'+wrapid+' #'+tab_id+' .product_list').append(data);
		                		SnsJsWoo.setAnimate( '#'+wrapid+' #'+tab_id, eclass );
			                	
			                	jQuery('#'+btnid).removeClass('loading');
			                	if( (parseInt(start) + parseInt(numberquery)) > jQuery('#'+wrapid+' #'+tab_id+' .product_list li').size() ){
			                		jQuery('#'+btnid).html(loadedtext);
			                		jQuery('#'+btnid).addClass('loaded');
			                	}else{
			                		jQuery('#'+btnid).html(loadtext);
			                	}
			                	jQuery('#'+btnid).attr('data-start', parseInt(start) + parseInt(numberquery));
			                	// Callback quickview, wishlist
			                	jQuery.fn.yith_quick_view();
			                	
			                	// Lazy load product image
			            	    jQuery("img.lazy:not(.loaded)").lazyload({
			            	        //effect : "fadeIn"
			            	    });
			            	    
			                }else{
			                	jQuery('#'+btnid).html(loadedtext);
			                	jQuery('#'+btnid).addClass('loaded');
			                }
		                }
		            });
		            snsProductTabsListHeight();
		        }else{
		         	return false;
		        }
		    });
		});
	}
};
