<?php
// Theme option
$snsavaz_headerLayout = snsavaz_themeoption('header_layout', 'layout_1');
// Get page config
$page_config = false;
if( snsavaz_metabox('snsavaz_header_layout') !='' ){
	$snsavaz_headerLayout = snsavaz_metabox('snsavaz_header_layout');
	$page_config = true;
}

$showbreadcrumbs = 1;

if ( get_post_type( get_the_ID() ) == 'page' ) :
	if ( is_front_page() || ( snsavaz_metabox('snsavaz_showbreadcrump') == '2' ) ) :
		$showbreadcrumbs = 0;
	endif;
elseif ( get_post_type( get_the_ID() ) == 'post') :
		$showbreadcrumbs = 1;
endif;
//
if( snsavaz_themeoption('use_stickmenu') == 1): ?>
    <div id="sticky-navigation-holder" class=""></div>
<?php
endif;
?>
<!-- Top Header -->
<div id="sns_topheader" class="wrap <?php if($snsavaz_headerLayout == 'layout_1') echo 'visible-lg'; ?>">
	<div class="container">
		<div class="topheader-left">
			<?php bloginfo( 'description' ); ?>
		</div>
		<div class="topheader-right">
			<!-- Top Menu -->
			<?php
            if(has_nav_menu('top_navigation')): ?>
            <div class="sns-quickaccess">
				<div class="quickaccess-inner">
			<?php
	           wp_nav_menu( array(
	           				'theme_location' => 'top_navigation',
	           				'container' => false, 
	           				'menu_id' => 'top_navigation',
	           				'menu_class' => 'links',
	           				'walker' => new snsavaz_Megamenu_Front,
	           			));
	        ?>
	        	</div>
	        </div>
	        <?php endif; ?>
		</div>
	</div>
</div>
<!-- Header -->
<div class="wrap" id="sns_header">
	<div class="container">
		<div class="row">
			<div class="header-left col-sm-3 col-xs-4">
				<?php if( $snsavaz_headerLayout !== 'layout_2' ): ?>
				<div class="logo visible-lg">
					<?php 
					$logourl = SNSAVAZ_THEME_URI.'/assets/img/logo.png';
					if ( snsavaz_themeoption('header_logo','','url') && snsavaz_themeoption('header_logo','','url') !='' ){
						$logourl = snsavaz_themeoption('header_logo','','url');
					}
					?>
					<a href="<?php echo esc_url( home_url('/') ) ?>" title="<?php bloginfo( 'sitename' ); ?>">
						<img src="<?php echo esc_attr($logourl); ?>" alt="<?php bloginfo( 'sitename' ); ?>"/>
					</a>
				</div>
				<div class="icon-menu">
					<span class="line line-1"></span>
					<span class="line line-2"></span>
					<span class="line line-3"></span>
					<span class="line line-4"></span>
					<span class="line line-5"></span>
					<span class="line line-6"></span>
				</div>

				<?php else : ?>

				<div class="icon-menu">
					<span class="line line-1"></span>
					<span class="line line-2"></span>
					<span class="line line-3"></span>
					<span class="line line-4"></span>
					<span class="line line-5"></span>
					<span class="line line-6"></span>
				</div>
				<div class="icon-block-search-toggle visible-lg">
					<div class="icon-search"></div>
					<div class="header-left-search-block">
						<?php if( shortcode_exists( 'yith_woocommerce_ajax_search' ) ):
							echo do_shortcode('[yith_woocommerce_ajax_search]');
						else:
						?>
							<?php if(class_exists('WooCommerce')): ?>
							<div id="headerRightSearchForm">
									<form method="get" action="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>">
		                                <input type="text" name="s" id="s" class="input-search"
		                                       placeholder="<?php echo esc_html__('Enter your keywords...', 'snsavaz'); ?>" />
		                                <input type="hidden" name="post_type" value="product" />
		                                <button type="submit"><i class="fa fa-search"></i></button>
		                            </form>
							</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<div class="header-center col-sm-6 col-xs-4">
				<div class="header-center-inner">
					<div class="header-center-inner-content">
						<div class="header-center-logo <?php if( $snsavaz_headerLayout !== 'layout_2' ){ echo ' hidden-lg'; }  ?>">
							<div class="logo">
								<?php 
								$logourl = SNSAVAZ_THEME_URI.'/assets/img/logo.png';
								if ( snsavaz_themeoption('header_logo','','url') && snsavaz_themeoption('header_logo','','url') !='' ){
									$logourl = snsavaz_themeoption('header_logo','','url');
								}
								?>
								<a href="<?php echo esc_url( home_url('/') ) ?>" title="<?php bloginfo( 'sitename' ); ?>">
									<img src="<?php echo esc_attr($logourl); ?>" alt="<?php bloginfo( 'sitename' ); ?>"/>
								</a>
							</div>
						</div>
						
						<?php if( $snsavaz_headerLayout !== 'layout_2' ):  ?>
						<div class="header-center-search visible-lg">
							<?php if( shortcode_exists( 'yith_woocommerce_ajax_search' ) ):
								echo do_shortcode('[yith_woocommerce_ajax_search]');
							else:
								if(class_exists('WooCommerce')):
							?>
								<div id="headerRightSearchForm">
										<form method="get" action="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>">
			                                <input type="text" name="s" id="s" class="input-search"
			                                       placeholder="<?php echo esc_html__('Enter your keywords...', 'snsavaz'); ?>" />
			                                <input type="hidden" name="post_type" value="product" />
			                                <button type="submit"><i class="fa fa-search"></i></button>
			                            </form>
								</div>
								<?php endif; ?>
							<?php endif; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="header-right col-sm-3 col-xs-4">
				<div class="header-right-inner">
					<div class="header-tools">
						<div class="myaccount <?php if( $snsavaz_headerLayout == 'layout_1' ){ echo ' hidden-lg'; }  ?>">
							<div class="tongle" title="<?php echo esc_html__( 'My Account', 'snsavaz' ); ?>">
								<i class="fa fa-user"></i>
							</div>
							<div class="content">
								<?php
						           wp_nav_menu( array(
						           				'theme_location' => 'top_navigation',
						           				'container' => false, 
						           				'menu_id' => 'settings_navigation',
						           				'menu_class' => 'settings-links',
						           				'depth' => 1,
						           			));
						        ?>
							</div>
						</div>
						<?php if( snsavaz_themeoption('settings_option', '0') == '1' ): ?>
						<div class="mysetting visible-lg">
							<div class="tongle">
								<i class="fa fa-cog"></i>
							</div>
							<div class="content">
								<!-- Settings -->
								<div class="sns-switch">
									<div class="switch-inner">
										<div class="language-switcher">
											<div class="lan-current"><span><?php esc_html_e('Language', 'snsavaz');?></span> <img alt="en" src="<?php echo SNSAVAZ_THEME_URI.'/assets/img/en.png'?>"></div>
											<ul class="list-lang">
												<li><span class="current"><img src="<?php echo SNSAVAZ_THEME_URI.'/assets/img/en.png'?>" alt="en"></span></li>
												<li><a title="<?php esc_html_e('Germany', 'snsavaz');?>" href="#"><img src="<?php echo SNSAVAZ_THEME_URI.'/assets/img/ge.png'?>" alt="de"></a></li>
												<li><a title="<?php esc_html_e('France', 'snsavaz');?>" href="#"><img src="<?php echo SNSAVAZ_THEME_URI.'/assets/img/fr.png'?>" alt="fr"></a></li>
											</ul>
										</div>
										<div class="currency-switcher">
											<div class="currency">
												<span><?php esc_html_e('Currency :', 'snsavaz');?></span>
												<span><?php esc_html_e('USD', 'snsavaz');?></span>
											</div>
											<ul class="select-currency">
												<li><a title="<?php esc_html_e('Dollar', 'snsavaz');?>" href="#"><?php esc_html_e('USD', 'snsavaz');?></a></li>
												<li><a title="<?php esc_html_e('EURO', 'snsavaz');?>" href="#"><?php esc_html_e('EUR', 'snsavaz');?></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endif; ?>
						<?php if ( class_exists('WooCommerce') ) : ?>
						<div class="mini-cart sns-ajaxcart visible-lg">
							<div class="mycart mini-cart">
								<a title="View my shopping cart" class="tongle" href="<?php echo snsavaz_cart_url();?>">
									<div class="sns-shopping-cart-icon">
										<i class="fa fa-shopping-cart"></i>
									</div>
									<div class="sns-shopping-cart-info">
										<span class="ajax_cart_quantity">
											<span class="number-item"><?php echo sizeof( WC()->cart->get_cart() );?></span>
											<?php echo snsavaz_cart_total(); ?>
										</span>
									</div>
								</a>
								<?php if ( !is_cart() && !is_checkout() ) : ?>
								<div class="content"><div class="block-inner">
									<?php the_widget( 'WC_Widget_Cart', 'title= ', array('before_title' => '', 'after_title' => '') ); ?>
								</div></div>
								<?php endif; ?>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Menu  -->
<div id="sns_menu_wrap">
	<div class="wrap" id="sns_menu">
		<div class="sns_menu_wrapper">
			<div class="container">
				<div class="inner">
					<div class="sns-mainnav-wrapper">
							<div id="sns_mainnav">
								<div class="visible-lg" id="sns_mainmenu">
									<?php
					                if(has_nav_menu('main_navigation')):
							           wp_nav_menu( array(
							           				'theme_location' => 'main_navigation',
							           				'container' => false, 
							           				'menu_id' => 'main_navigation',
							           				'walker' => new snsavaz_Megamenu_Front,
							           				'menu_class' => 'nav navbar-nav'
							           	) ); 
									else:
										echo '<p class="main_navigation_alert">'.esc_html__('Please sellect menu for Main navigation', 'snsavaz').'</p>';
									endif;
									?>
								</div>
								<?php get_template_part('tpl-respmenu'); ?>
							</div>
							<div class="sns_nav-right">
								<div class="header-right-inner">
									<?php if( snsavaz_themeoption('settings_option', '0') == '1' ): ?>
									<div class="mysetting hidden-lg">
										<div class="tongle">
											<i class="fa fa-cog"></i>
										</div>
										<div class="content">
											<!-- Settings -->
											<div class="sns-switch">
												<div class="switch-inner">
													<div class="language-switcher">
														<div class="lan-current"><span><?php esc_html_e('Language', 'snsavaz');?></span> <img alt="en" src="<?php echo SNSAVAZ_THEME_URI.'/assets/img/en.png'?>"></div>
														<ul class="list-lang">
															<li><span class="current"><img src="<?php echo SNSAVAZ_THEME_URI.'/assets/img/en.png'?>" alt="en"></span></li>
															<li><a title="<?php esc_html_e('Germany', 'snsavaz');?>" href="#"><img src="<?php echo SNSAVAZ_THEME_URI.'/assets/img/ge.png'?>" alt="de"></a></li>
															<li><a title="<?php esc_html_e('France', 'snsavaz');?>" href="#"><img src="<?php echo SNSAVAZ_THEME_URI.'/assets/img/fr.png'?>" alt="fr"></a></li>
														</ul>
													</div>
													<div class="currency-switcher">
														<div class="currency">
															<span><?php esc_html_e('Currency :', 'snsavaz');?></span>
															<span><?php esc_html_e('USD', 'snsavaz');?></span>
														</div>
														<ul class="select-currency">
															<li><a title="<?php esc_html_e('Dollar', 'snsavaz');?>" href="#"><?php esc_html_e('USD', 'snsavaz');?></a></li>
															<li><a title="<?php esc_html_e('EURO', 'snsavaz');?>" href="#"><?php esc_html_e('EUR', 'snsavaz');?></a></li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php endif; ?>
									<?php if ( class_exists('WooCommerce') ) : ?>
									<div class="mini-cart sns-ajaxcart hidden-lg">
										<div class="mycart mini-cart">
											<a title="View my shopping cart" class="tongle" href="<?php echo snsavaz_cart_url();?>">
												<div class="sns-shopping-cart-icon">
													<i class="fa fa-shopping-cart"></i>
												</div>
												<div class="sns-shopping-cart-info">
													<span class="ajax_cart_quantity">
														<span class="number-item"><?php echo sizeof( WC()->cart->get_cart() );?></span>
														<?php echo snsavaz_cart_total(); ?>
													</span>
												</div>
											</a>
											<?php if ( !is_cart() && !is_checkout() ) : ?>
											<div class="content"><div class="block-inner">
												<?php the_widget( 'WC_Widget_Cart', 'title= ', array('before_title' => '', 'after_title' => '') ); ?>
											</div></div>
											<?php endif; ?>
										</div>
									</div>
									<?php endif; ?>
									<div class="icon-search hidden-lg">
										<i class="fa fa-search"></i>
									</div>
									
									<div class="email-header visible-lg">
										<a href="mailto:sale@example.com"><?php esc_html_e('sale@example.com', 'snsavaz');?><i class="fa fa-envelope"></i></a>
									</div>
								</div>
							</div>
					</div>
				</div>
			</div>
			
			<div class="sns_menu_search_wrap">
				<?php if( shortcode_exists( 'yith_woocommerce_ajax_search' ) ):
					echo do_shortcode('[yith_woocommerce_ajax_search]');
				else:
					if(class_exists('WooCommerce')):
				?>
					<div id="headerRightSearchForm">
							<form method="get" action="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>">
			                     <input type="text" name="s" id="s" class="input-search"
			                             placeholder="<?php echo esc_html__('Enter your keywords...', 'snsavaz'); ?>" />
			                      <input type="hidden" name="post_type" value="product" />
			                      <button type="submit"><i class="fa fa-search"></i></button>
			                </form>
					</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	
	<?php if ( is_page() && snsavaz_metabox('snsavaz_useslideshow') == 1 ): ?>
	<div id="sns_slideshow" class="wrap">
		<?php
			echo do_shortcode('[rev_slider '.esc_attr(snsavaz_metabox('snsavaz_revolutionslider')).' ]');
		?>
	</div>
	<?php endif; ?>
</div>
<?php if (!is_search() && $showbreadcrumbs == 1 && !is_front_page()  && !is_404()) : ?>
<div id="sns_breadcrumbs" class="wrap">
	<div class="container">
		<div id="sns_pathway" class="clearfix">
			<?php snsavaz_breadcrumbs(); ?>
		</div>
	</div>
</div>
<?php endif; ?>