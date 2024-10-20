<?php
if ( ! class_exists( 'snsavaz_Options' ) ) {
class snsavaz_Options {
	public $args = array();
	public $sections = array();
	public $theme;
	public $ReduxFramework;

	public function __construct() {
		if ( ! class_exists( 'ReduxFramework' ) ) {
		 return;
		}
		if ( true == Redux_Helpers::isTheme( SNSAVAZ_THEME_DIR . '/framework/sns-options.php' ) ) {
			$this->initSettings();
		} else {
			add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
		}
	}

	public function initSettings() {
	    // Set the default arguments
	    $this->setArguments();
	    // Set a few help tabs so you can see how it's done
	    $this->setHelpTabs();
	    // Create the sections and fields
	    $this->setSections();
	    if ( ! isset( $this->args['opt_name'] ) ) {
	        return;
	    }
	    $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
	}

	public function setArguments() {
	    $theme = wp_get_theme();
	    $this->args = array(
            'opt_name'  			=> 'snsavaz_themeoptions',
            'display_name' 			=> $theme->get( 'Name' ),
            'menu_type'          	=> 'menu',
	        'allow_sub_menu'     	=> true,
	        'menu_title'         	=> esc_html__( 'SNS Avaz', 'snsavaz' ),
	        'page_title'         	=> esc_html__( 'SNS Avaz', 'snsavaz' ),
	        'customizer' 			=> true,
	        'page_priority'      	=> 50,
	        'menu_icon' 			=> '',
	        'hints'              	=> array(
	            'icon'          => 'icon-question-sign',
	            'icon_position' => 'right',
	            'icon_color'    => 'lightgray',
	            'icon_size'     => 'normal',
	            'tip_style'     => array(
	                'color'   	=> 'light',
	                'shadow'  	=> true,
	                'rounded' 	=> false,
	                'style'   	=> '',
	            ),
	            'tip_position'  => array(
	                'my' => 'top left',
	                'at' => 'bottom right',
	            ),
	            'tip_effect'    => array(
	                'show' => array(
	                    'effect'   => 'slide',
	                    'duration' => '500',
	                    'event'    => 'mouseover',
	                ),
	                'hide' => array(
	                    'effect'   => 'slide',
	                    'duration' => '500',
	                    'event'    => 'click mouseleave',
	                ),
	            ),
	        ),
	        'dev_mode' 				=> false,
	        //'forced_dev_mode_off'	=> false,
	        'show_options_object'   => false
	    );
	}

	public function setHelpTabs() {
	    $this->args['help_tabs'][] = array(
	        'id'      => 'redux-help-tab-1',
	        'title'   => esc_html__( 'Theme Information 1', 'snsavaz' ),
	        'content' => wp_kses(__( '<p>This is the tab content, HTML is allowed.</p>', 'snsavaz' ), array(
							'p' => array()
						 ))
	    );
	    $this->args['help_tabs'][] = array(
	        'id'      => 'redux-help-tab-2',
	        'title'   => esc_html__( 'Theme Information 2', 'snsavaz' ),
	        'content' => wp_kses(__( '<p>This is the tab content, HTML is allowed.</p>', 'snsavaz' ), array(
							'p' => array()
						 ))
	    );
	    $this->args['help_sidebar'] = wp_kses(__( '<p>This is the sidebar content, HTML is allowed.</p>', 'snsavaz' ), array(
										'p' => array()
									  ));
	}
	public function setSections() {
		$this->sections[] = $this->importSampleData();
	    $this->sections[] = $this->getGeneralCfg();
	    $this->sections[] = $this->getHeaderCfg();
	    $this->sections[] = $this->getFooterCfg();
	    $this->sections[] = $this->getBlogCfg();
	    $this->sections[] = $this->getPageNotFoundCfg();
	    $this->sections[] = $this->getWooCfg();
	    $this->sections[] = $this->getAdvanceCfg();
	}
	public function getPatterns(){
		$patterns = array();
		$path = SNSAVAZ_THEME_DIR . '/assets/img/patterns';
		$regex = '/(\.gif)|(.jpg)|(.png)|(.bmp)$/i';
		if( !is_dir($path) ) return;
		
		$dk =  opendir ( $path );
		$files = array();
		while ( false !== ($filename = readdir ( $dk )) ) {
			if (preg_match ( $regex, $filename )) {
				$files[] = $filename;
			}
		}
		foreach( $files as $p ) $patterns[] = $p;
		return $patterns;
	}
	public function importSampleData(){
		$desc = '';
		if ( ! function_exists( 'is_plugin_active' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }
		if( is_plugin_active('wordpress-importer/wordpress-importer.php') ){
			$subtitle = '
				<input type=\'button\' class=\'button\' name=\'btn_sampledata\' disabled=\'disabled\' id=\'btn_sampledata\' value=\'Import\' />
				<p><i class="fa fa-exclamation-circle"></i> Please Deactivate plugin Wordpress Importer</p>
			';
		}else{
			$subtitle = '<input type=\'button\' class=\'button\' name=\'btn_sampledata\' id=\'btn_sampledata\' value=\'Import\' />';
		}
    	$subtitle .= '
	    	<div class=\'sns-importprocess\'>
	    		<div  class=\'sns-importprocess-width\'></div>
	    	</div>
	    	<span id=\'sns-importmsg\'><span class=\'status\'></span></span>
    		<div id="sns-import-tablecontent">
				<label>List contents will import:</label>
				<ul>
				  <li class="theme-cfg"><i class="fa fa-hand-pointer-o"></i>Theme config</li>
				  <li class="revslider-cfg"><i class="fa fa-hand-pointer-o"></i>Revolution Slider config</li>
				  <li class="all-content"><i class="fa fa-hand-pointer-o"></i>All contents</li>
				  <li class="widget-cfg"><i class="fa fa-hand-pointer-o"></i>Widget config</li>
				</ul>
			</div>
    	';
		return  array(
		    'icon' => 'el-icon-briefcase',
		    'title' => esc_html__('Demo content', 'snsavaz'),
		    'subsection' => true,
		    'fields' => array(
		        array(
		        	'title' => '',
		            'subtitle' => $subtitle,
		            'desc'	=> $desc,
		            'id' => 'theme_data',
		            'icon' => true,
		            'type' => 'image_select',
		            'default' => 'sns_logo',
		            'options' => array(
		                'sns_logo' => get_template_directory_uri().'/assets/img/logo.png',
		            ),
		        )
		    )
		);
	}
	public function getGeneralCfg() {
		$patterns = $this->getPatterns();
		$pattern_opt = array();
		foreach($patterns as $pattern)
			$pattern_opt[$pattern] = array('img' => SNSAVAZ_THEME_URI . '/assets/img/patterns/' . $pattern, 'alt' => $pattern);
		
	    return array(
	        'title'		=> esc_html__( 'General', 'snsavaz' ),
	        'icon'		=> 'el-icon-cog',
	        'fields'	=> array(
	            array(
	                'id'       => 'theme_color',
	                'type'     => 'color',
	                'output'   => array( '.site-title' ),
	                'title'    => esc_html__( 'Theme Color', 'snsavaz' ),
	                'default'  => '#fe7524',
	        		'transparent'	=> false
	            ),
	            array(
	                'id'       => 'use_boxedlayout',
	                'type'     => 'switch',
	                'title'    => 'Use Boxed Layout',
	                'default'  => false,
	                'on'       => 'Yes',
                    'off'      => 'No',
	            ),
	            array(
	                'id'       => 'body_bg',
	                'type'     => 'background',
	                'output'   => array( 'body' ),
	                'title'    => esc_html__( 'Body Background', 'snsavaz' ),
	                'background-image' => false,
	        		'preview'	=> false,
	        		'required' => array( 'use_boxedlayout', '=', '1' )
	            ),
	            array(
	                'id'       => 'body_bg_type',
	                'type'     => 'select',
	                'title'    => 'Body Background Image',
	                'options'  => array(
	                    'none'   	=> 'No image',
	                    'pantern'   => 'Pantern',
	                    'img'  		=> 'Image',
	                ),
	                'default'  => 'pantern',
	                'select2'  => array( 'allowClear' => false ),
	                'required' => array( 'use_boxedlayout', '=', '1' )
	            ),
	            array(
	                'id'       => 'body_bg_type_pantern',
	                'type'     => 'image_select',
	                'options'  => $pattern_opt,
	                'width'		=>  '50px !important',
	                'height'	=> 50,
              	  	'required' => array( 'body_bg_type', '=', array( 'pantern' ) )
	            ),
			    array(
			        'id'		=> 'body_bg_type_img',
			        'type'		=> 'media',
              	 	'required' => array( 'body_bg_type', '=', array( 'img' ) ),
			    ),
	            array(
	                'id'          => 'body_font',
	                'type'        => 'typography',
	                'title'       => esc_html__( 'Body font', 'snsavaz' ),
	                'line-height'   => false,
	                'text-align'   => false,
	                'color'         => true,
	                'all_styles'  => true,
	                'units'       => 'px',
	                // 'subsets'       => true,
	                'default'     => array(
	                    'font-size'   => '14px',
	                    'font-family' => 'Raleway',
	                    'font-weight' => '400',
	                    'color'		  => '#8f8f8f'
	                ),
	            ),
	            array(
	                'id'          => 'secondary_font',
	                'type'        => 'typography',
	                'title'       => esc_html__( 'Secondary font', 'snsavaz' ),
	                'line-height'   => false,
	                'text-align'   => false,
	                'color'         => false,
	                'all_styles'  => true,
	                'units'       => 'px',
                	'font-size'     => false,
	                // 'subsets'       => true,
	                'default'     => array(
	                    'font-family' => 'Raleway',
	                    'font-weight' => '400',
	                ),
	            ),
	            array(
	                'id'       => 'secondary_font_target',
	                'type'     => 'textarea',
	                'title'    => esc_html__( 'Secondary font target', 'snsavaz' ),
	                'default'  => 'h1, h2, h3, h4, h5, h6,
input[type="submit"],
input[type="button"],
.button,
button,
blockquote,
#wp-calendar tfoot td a,
.gfont,
.onsale,
.price,
.widget a.title,
.widget .product-title,
.widget .post-title,
#sns_titlepage,
#sns_mainmenu > ul > li.menu-item > a',
	                'validate' => 'no_html'
	            ),
	        )
	    );
	}
	public function getHeaderCfg() {
	    return array(
	        'title'		=> esc_html__( 'Header', 'snsavaz' ),
	        'icon'		=> 'el el-brush',
	        'fields'	=> array(
	        	array(
	        		'id'       => 'header_layout',
	        		'type'     => 'image_select',
	        		'title'    => esc_html__( 'Header Layout', 'snsavaz' ),
	        		'default'  => 'layout_1',
	        		'options'  => array(
	        			'layout_1'      => array(
	        				'alt'   => esc_html__( 'Layout 1', 'snsavaz' ),
	        				'img'   => SNSAVAZ_THEME_URI.'/assets/img/admin/thumb_head1.jpg'
	        			),
	        			'layout_2'      => array(
	        				'alt'   => esc_html__( 'Layout 2 (Transparent)', 'snsavaz' ),
	        				'img'   => SNSAVAZ_THEME_URI.'/assets/img/admin/thumb_head2.jpg'
	        			),
	        			'layout_3'      => array(
	        				'alt'   => esc_html__( 'Layout 3', 'snsavaz' ),
	        				'img'   => SNSAVAZ_THEME_URI.'/assets/img/admin/thumb_head3.jpg'
	        			),
	        		),
	        		'desc'		=> esc_html__('Select Header layout', 'snsavaz'),
	        	),
			    array(
			        'id'		=> 'header_logo',
			        'type'		=> 'media',
			        'default'	=> '',
			        'title'		=> esc_html__( 'Logo', 'snsavaz' ),
                	'subtitle' => esc_html__( 'If this is not selected, This theme will be display logo with "theme/snsavaz/img/logo.png"', 'snsavaz' ),
			        'desc'		=> esc_html__( 'Image that you want to use as logo', 'snsavaz' ),
			    ),
			    array(
	                'id'       => 'use_logocolor',
	                'type'     => 'switch',
	                'title'    => 'Use background-color for logo',
	                'subtitle' => esc_html__( 'Some logo image is transparent. Maybe it need background-color', 'snsavaz' ),
	                'default'  => false,
	                'on'       => 'Yes',
                    'off'      => 'No',
	            ),
			    array(
	                'id'       => 'use_stickmenu',
	                'type'     => 'switch',
	                'title'    => 'Enable Sticky Menu',
	                'subtitle' => esc_html__( 'Keep menu on top when scroll down/up', 'snsavaz' ),
	                'default'  => false,
	                'on'       => 'Yes',
                    'off'      => 'No',
	            ),
	      //       array(
			    //     'id'		=> 'menu_bg',
			    //     'type'		=> 'media',
			    //     'title'		=> esc_html__( 'Background Image for menu wrapper', 'snsavaz' ),
       //          	'subtitle' => esc_html__( 'Menu wrapper contain: Slideshow, Page title, Breadcrumbs', 'snsavaz' ),
			    //     'desc'		=> esc_html__( 'This is default vaule fo all page', 'snsavaz' ),
			    // ),
			    array(
	                'id'       => 'settings_option',
	                'type'     => 'switch',
	                'title'    => 'Enable Settings Option',
	                'subtitle' => esc_html__( 'Show / Hide the Settings button contain: Language options, Currency', 'snsavaz' ),
	                'default'  => false,
	                'on'       => 'Yes',
                    'off'      => 'No',
	            ),
	        )
	    );
	}
	public function  getFooterCfg(){
		return array(
	        'title'		=> esc_html__( 'Footer', 'snsavaz' ),
	        'icon'		=> 'el el-link',
	        'fields'	=> array(
			    array(
			        'id'		=> 'payment_img',
			        'type'		=> 'media',
			        'title'		=> esc_html__( "Payment method's image", 'snsavaz' ),
			    	'default'	=> get_template_directory_uri() . '/assets/img/default/payment.png',
			    ),
			    array(
			        'id'		=> 'copyright',
			        'type'		=> 'textarea',
			        'title'		=> esc_html__( "Copyright", 'snsavaz' ),
			        'default' => esc_html__( "Designed by SNSTheme.Com", 'snsavaz' ),
			    ),
	        )
	    );
	}
	public function getBlogCfg() {
		$siderbars = array(
		    'widget-area' => esc_html__( 'Main Sidebar', 'snsavaz' ),
		    'right-sidebar' => esc_html__( 'Right Sidebar', 'snsavaz' ),
			'left-sidebar' => esc_html__( 'Left Sidebar', 'snsavaz' ),
			'woo-sidebar' => esc_html__( 'Woo Sidebar', 'snsavaz' ),
		);
		//if( is_admin() ) wp_enqueue_style('sns-admin-css', SNSAVAZ_THEME_URI . '/assets/css/admin-theme-option.css');
	    return array(
	        'title'		=> esc_html__( 'Blog', 'snsavaz' ),
	        'icon'		=> 'el el-file-edit',
	        'fields'	=> array(
				array(
				    'id'       => 'layouttype',
				    'type'     => 'image_select',
				    'title'    => esc_html__('Default Blog Layout', 'snsavaz'), 
				    'options'  => array(
				        'm'      => array(
				            'alt'   => esc_html__( 'Without Sidebar', 'snsavaz' ), 
				            'img'   => SNSAVAZ_THEME_URI.'/assets/img/admin/m.jpg'
				        ),
				        'l-m'      => array(
				            'alt'   => esc_html__( 'Use Left Sidebar', 'snsavaz' ), 
				            'img'   => SNSAVAZ_THEME_URI.'/assets/img/admin/l-m.jpg'
				        ),
				        'm-r'      => array(
				            'alt'  => esc_html__( 'Use Right Sidebar', 'snsavaz' ), 
				            'img'  => SNSAVAZ_THEME_URI.'/assets/img/admin/m-r.jpg'
				        ),
				        // 'l-m-r'      => array(
				        //     'alt'   => esc_html__( 'Use Left & Right Sidebar', 'snsavaz' ), 
				        //     'img'   => SNSAVAZ_THEME_URI.'/assets/img/admin/l-m-r.jpg'
				        // )
				    ),
				    'default' => 'm-r'
				),
				// Left Sidebar
				array(
					'title'  => esc_html__( 'Left Sidebar', 'snsavaz' ),
					'id'    => "leftsidebar",
					//'desc'  => esc_html__( 'Text description', 'snsavaz' ),
					'type'  => 'select',
					'options'	=> $siderbars,
					'multiselect'	=> false,
					'required' => array( 'layouttype', '=', array( 'l-m', 'l-m-r' ) )
				),
				// Right Sidebar
				array(
					'title'  => esc_html__( 'Right Sidebar', 'snsavaz' ),
					'id'    => "rightsidebar",
					//'desc'  => esc_html__( 'Text description', 'snsavaz' ),
					'type'  => 'select',
					'options'	=> $siderbars,
					'multiselect'	=> false,
					'required' => array( 'layouttype', '=', array( 'm-r', 'l-m-r' ) )
				),
				array( 
		        	'title' => esc_html__( 'Blog Style', 'snsavaz'),
					'id' => 'blog_type',
					'default' => '',
					'type' => 'select',
					'multiselect' => false ,
					'options' => array(
						'' 				=> esc_html__( 'Blog Layout 1', 'snsavaz'),
						'layout2' 		=> esc_html__( 'Blog Layout 2', 'snsavaz'),
						'masonry' 		=> esc_html__( 'Masonry', 'snsavaz'),
					)
				),
				// array(
	   //              'id'       => 'blog_gridcol',
	   //              'type'     => 'select',
	   //              'title'    => esc_html__( 'Grid columns', 'snsavaz' ),
	   //              'subtitle'  => esc_html__( 'We are using grid bootstap - 12 cols layout', 'snsavaz' ),
	   //              'default'  => '3',
	   //              'options'  => array(
	   //                  '2' => '2',
	   //                  '3' => '3',
	   //                  '4' => '4',
	   //                  '6' => '6',
	   //              ),
	   //              'required' => array( 'blog_type', '=', array( 'grid' ) )
	   //          ),
	   //          array(
	   //              'id'       => 'blog_enablemasonry',
	   //              'type'     => 'switch',
	   //              'title'    => esc_html__( 'Enable Masonry', 'snsavaz' ),
	   //              'default'  => true,
	   //              'on'       => 'Yes',
	   //              'off'      => 'No',
	   //              'required' => array( 'blog_type', '=', array( 'grid' ) )
	   //          ),
	   //          array(
	   //              'id'       => 'blog_pagination',
	   //              'type'     => 'select',
	   //              'title'    => esc_html__( 'Blog Pagination', 'snsavaz' ),
	   //              'default'  => '',
	   //              'options'  => array(
	   //                  '' => 'Standard',
	   //                  'infinite' => 'Infinite Scroll',
	   //                  'loadmore' => 'Load More Button'
	   //              ),
	   //              'required' => array( 'blog_type', '=', array( 'grid' ) )
	   //          ),
				array(
				    'id'   =>'divider_blog',
				    'type' => 'divide'
				),
	            array(
	                'id'       => 'show_categories',
	                'type'     => 'switch',
	                'title'    => esc_html__( 'Show Categories for Blog Entries Page', 'snsavaz' ),
	                'default'  => true,
	                'on'       => 'Yes',
	                'off'      => 'No',
	            ),
	        	array(
	        		'id'       => 'show_date',
	        		'type'     => 'switch',
	        		'title'    => esc_html__( 'Show Date for Blog Entries Page', 'snsavaz' ),
	        		'default'  => true,
	        		'on'       => 'Yes',
	        		'off'      => 'No',
	        	),
	        	/*array(
	        		'id'       => 'show_view_count',
	        		'type'     => 'switch',
	        		'title'    => esc_html__( 'Show View Count', 'snsavaz' ),
	        		'default'  => true,
	        		'on'       => 'Yes',
	        		'off'      => 'No',
	        	),*/
	            array(
	                'id'       => 'show_author',
	                'type'     => 'switch',
	                'title'    => esc_html__( 'Show Author for Blog Entries Page', 'snsavaz' ),
	                'default'  => true,
	                'on'       => 'Yes',
	                'off'      => 'No',
	            ),
	        	array(
	        		'id'       => 'show_tags',
	        		'type'     => 'switch',
	        		'title'    => esc_html__( 'Show Tags for Blog Entries Page', 'snsavaz' ),
	        		'default'  => true,
	        		'on'       => 'Yes',
	        		'off'      => 'No',
	        	),
	        	array(
	        		'id'       => 'show_comment_count',
	        		'type'     => 'switch',
	        		'title'    => esc_html__( 'Show Comment Count', 'snsavaz' ),
	        		'default'  => true,
	        		'on'       => 'Yes',
	        		'off'      => 'No',
	        	),
	        	array(
	        		'id'       => 'excerpt_length',
	        		'type'     => 'text',
	        		'title'    => esc_html__( 'Blog Excerpt Length', 'snsavaz' ),
	        		'default'  => '55',
	        	),
	        	array(
	        		'id'       => 'show_readmore',
	        		'type'     => 'switch',
	        		'title'    => esc_html__( 'Enable Read More Button', 'snsavaz' ),
	        		'default'  => false,
	        		'on'       => 'Yes',
	        		'off'      => 'No',
	        	),
	        	array(
	        		'id'       => 'tag_showmore',
	        		'type'     => 'switch',
	        		'title'    => esc_html__( 'Enable View More Tags', 'snsavaz' ),
	        		'subtitle' => esc_html__( 'Apply for widget Tag Cloud to show the number for tags display first.', 'snsavaz' ),
	        		'default'  => true,
	        		'on'       => 'Yes',
	        		'off'      => 'No',
	        	),
	        	array(
	                'id'       => 'tag_display_first',
	                'type'     => 'text',
	                'title'    => esc_html__( 'The number for Tags display first.', 'snsavaz' ),
	                'default'  => '7',
	                'required' => array( 'tag_showmore', '=', true )
	            ),

	            array(
				    'id'   =>'divider_post',
				    //'desc' => esc_html__('Options for blog page', 'snsavaz'),
				    'type' => 'divide'
				),
	            array(
	                'id'       => 'show_postauthor',
	                'type'     => 'switch',
	                'title'    => esc_html__( 'Enable Author Info on Post Detail', 'snsavaz' ),
	                'default'  => true,
	                'on'       => 'Yes',
	                'off'      => 'No',
	            ),
	            array(
	                'id'       => 'enalble_related',
	                'type'     => 'switch',
	                'title'    => esc_html__( 'Enable Related Posts on Post Detail', 'snsavaz' ),
	                'default'  => false,
	                'on'       => 'Yes',
	                'off'      => 'No',
	            ),
	        	array(
	        		'id' 		=> 'related_posts_by',
	        		'title' 	=> esc_html__( 'Related Post By', 'snsavaz'),
	        		'desc'		=> esc_html__('Get related post by Categories or Tags', 'snsavaz'),
	        		'default' 	=> 'cat',
	        		'type' 		=> 'select',
	        		'multiselect' => false ,
	        		'options'	=> array(
	        			'cat' 	=> 'Categories',
	        			'tag' 	=>  'Tags',
	        		),
	        		'required' => array( 'enalble_related', '=', true )
	        	),
	            array(
	                'id'       => 'related_num',
	                'type'     => 'text',
	                'title'    => esc_html__( 'Related Posts Number', 'snsavaz' ),
	                'default'  => '5',
	                'required' => array( 'enalble_related', '=', true )
	            ),
	            array(
	                'id'       => 'show_postsharebox',
	                'type'     => 'switch',
	                'title'    => esc_html__( 'Enable Share Box on Post Detail', 'snsavaz' ),
	                'default'  => false,
	                'on'       => 'Yes',
	                'off'      => 'No',
	            ),
	            array(
				    'id'       => 'show_facebook_sharebox',
				    'type'     => 'checkbox',
				    'title'    => esc_html__('Show Facebook in Sharing Box', 'snsavaz'),
				    'required' => array( 'show_postsharebox', '=', true ),
				    'default'  => '1'// 1 = on | 0 = off
				),
	            array(
				    'id'       => 'show_twitter_sharebox',
				    'type'     => 'checkbox',
				    'title'    => esc_html__('Show Twitter in Sharing Box', 'snsavaz'), 
				    'required' => array( 'show_postsharebox', '=', true ),
				    'default'  => '1'// 1 = on | 0 = off
				),
				array(
				    'id'       => 'show_gplus_sharebox',
				    'type'     => 'checkbox',
				    'title'    => esc_html__('Show G + in Sharing Box', 'snsavaz'),
				    'required' => array( 'show_postsharebox', '=', true ), 
				    'default'  => '1'// 1 = on | 0 = off
				),
				array(
				    'id'       => 'show_linkedin_sharebox',
				    'type'     => 'checkbox',
				    'title'    => esc_html__('Show Linkedin in Sharing Box', 'snsavaz'), 
				    'required' => array( 'show_postsharebox', '=', true ),
				    'default'  => '1'// 1 = on | 0 = off
				),
				array(
				    'id'       => 'show_pinterest_sharebox',
				    'type'     => 'checkbox',
				    'title'    => esc_html__('Show Pinterest in Sharing Box', 'snsavaz'), 
				    'required' => array( 'show_postsharebox', '=', true ),
				    'default'  => '1'// 1 = on | 0 = off
				),
				array(
				    'id'       => 'show_tumblr_sharebox',
				    'type'     => 'checkbox',
				    'title'    => esc_html__('Show Tumblr in Sharing Box', 'snsavaz'), 
				    'required' => array( 'show_postsharebox', '=', true ),
				    'default'  => '1'// 1 = on | 0 = off
				),
				array(
				    'id'       => 'show_email_sharebox',
				    'type'     => 'checkbox',
				    'title'    => esc_html__('Show Send Email in Sharing Box', 'snsavaz'), 
				    'required' => array( 'show_postsharebox', '=', true ),
				    'default'  => '1'// 1 = on | 0 = off
				),
	        	array(
	        		'id' 		=> 'pagination',
	        		'title' 	=> esc_html__( 'Page Navigation', 'snsavaz'),
	        		'desc'		=> esc_html__('Choose Type of navigation for blog and any listing page.', 'snsavaz'),
	        		'default' 	=> 'def',
	        		'type' 		=> 'select',
	        		'multiselect' => false ,
	        		'options'	=> array(
	        			'def' 	=> esc_html__('Default PageNavi', 'snsavaz'),
	        			'ajax' 	=>  esc_html__('Ajax', 'snsavaz'),
	        		),
	        	),

	            
	        )
	    );
	}
	public function getPageNotFoundCfg(){
		return array(
			'title'		=> esc_html__( 'Page Not Found', 'snsavaz' ),
			'icon'		=> 'el el-warning-sign',
			'fields'	=> array(
				array(
	                'id'       => 'notfound_title',
	                'type'     => 'text',
	                'title'    => esc_html__( 'Title', 'snsavaz' ),
	                'default'  => esc_html__('PAGE NOT FOUND', 'snsavaz'),
	            ),
				array(
					'id'       => 'notfound_content',
					'type'     => 'textarea',
					'title'    => esc_html__( 'Content', 'snsavaz' ),
					'default'  => esc_html__('Sory but the page you are looking for does not exit, have been removed or name changed. Go back Homepage or enter the key words to search, please!', 'snsavaz'),
				),
			  )
			);
	}
	public function getWooCfg() {
		return array(
	        'title'		=> esc_html__( 'WooCommerce', 'snsavaz' ),
	        'icon'		=> 'el el-shopping-cart',
	        'fields'	=> array(
	        	array(
	                'id'       => 'woo_uselazyload',
	                'type'     => 'switch',
	                'title'    => esc_html__( 'Use lazyload for Product Image', 'snsavaz' ),
	                'default'  => true,
	                'on'       => 'Yes',
	                'off'      => 'No',
	            ),
	            array(
	                'id'		=> 'woo_list_modeview',
	                'type'		=> 'select',
	                'title'		=> esc_html__( 'Default mode view for listing page', 'snsavaz' ),
	                'options'  => array(
	                    'grid' => 'Grid',
	                    'list' => 'List',
	                ),
	                'default'  => 'grid'
			    ),
	            array(
	                'id'       => 'woo_grid_col',
	                'type'     => 'select',
	                'title'    => esc_html__( 'Grid columns', 'snsavaz' ),
	                'subtitle'  => esc_html__( 'We are using grid bootstap - 12 cols layout', 'snsavaz' ),
	                'default'  => '3',
	                'options'  => array(
	                    '1' => '1',
	                    '2' => '2',
	                    '3' => '3',
	                    '4' => '4',
	                    '6' => '6',
	                ),
	            ),
	            array(
	                'id'       => 'woo_number_perpage',
	                'type'     => 'text',
	                'title'    => esc_html__( 'Number products per listing page', 'snsavaz' ),
	                'default'  => '9',
	            ),
	        	
	            array(
				    'id'   =>'divider_blog',
				    'type' => 'divide'
				),
	            array(
	                'id'       => 'woo_sharebox',
	                'type'     => 'switch',
	                'title'    => esc_html__( 'Enable Share box', 'snsavaz' ),
	                'default'  => true,
	                'on'       => 'Yes',
	                'off'      => 'No',
	            ),
	            array(
	                'id'       => 'woo_related',
	                'type'     => 'switch',
	                'title'    => esc_html__( 'Enable Related Products', 'snsavaz' ),
	                'default'  => true,
	                'on'       => 'Yes',
	                'off'      => 'No',
	            ),
	            array(
	            	'id'       => 'woo_related_num',
                 	'type'     => 'text',
                 	'title'    => esc_html__( 'Number Related Products to display', 'snsavaz' ),
                 	'required' => array( 'woo_related', '=', '1' ),
                 	'default'  => '6',
                )
	        )
	    );
	}
	public function getAdvanceCfg() {
	    return array(
	        'title'		=> esc_html__( 'Advance', 'snsavaz' ),
	        'icon'		=> 'el el-wrench',
	        'fields'	=> array(
	            array(
	                'id'       => 'advance_tooltip',
	                'type'     => 'switch',
	                'title'    => esc_html__( 'Enable Tooltip', 'snsavaz' ),
	                'default'  => false,
	                'on'       => 'Yes',
	                'off'      => 'No',
	            ),
	            array(
	                'id'       => 'advance_cpanel',
	                'type'     => 'switch',
	                'title'    => esc_html__( 'Enable Cpanel', 'snsavaz' ),
	                'default'  => false,
	                'on'       => 'Yes',
	                'off'      => 'No',
	            ),
	            array(
	                'id'       => 'advance_scrolltotop',
	                'type'     => 'switch',
	                'title'    => esc_html__( 'Enable Button Scroll To Top', 'snsavaz' ),
	                'default'  => true,
	                'on'       => 'Yes',
	                'off'      => 'No',
	            ),
	            array(
	                'id'		=> 'advance_scss_compile',
	                'type'		=> 'select',
	                'title'		=> esc_html__( 'SCSS Compile', 'snsavaz' ),
	                'options'  => array(
	                    '1' => 'Only compile when don\'t have the css file',
	                    '2' => 'Alway compile'
	                ),
	                'default'  => '1'
			    ),
	            array(
	                'id'		=> 'advance_scss_format',
	                'type'		=> 'select',
	                'title'		=> esc_html__( 'CSS Format', 'snsavaz' ),
	                'options'  => array(
	                    'scss_formatter' => 'scss_formatter',
	                    'scss_formatter_nested' => 'scss_formatter_nested',
	                    'scss_formatter_compressed' => 'scss_formatter_compressed',
	                ),
	                'default'  => 'scss_formatter_compressed'
			    ),
	            array(
	                'id'       => 'advance_customcss',
	                'type'     => 'ace_editor',
	                'title'    => esc_html__( 'Custom CSS', 'snsavaz' ),
	                'subtitle' => esc_html__( 'Paste your CSS code here. EX: .class{font-size:13px}', 'snsavaz' ),
	                'mode'     => 'css',
	                'theme'    => 'monokai',
	                'default'  => ""
	            ),
	            array(
	                'id'       => 'advance_customjs',
	                'type'     => 'ace_editor',
	                'title'    => esc_html__( 'Custom JS', 'snsavaz' ),
	                'subtitle' => esc_html__( 'Enter your JS code here.', 'snsavaz' ),
	                'theme'    => 'chrome',
	                'default'  => ""
	            ),
	        )
	    );
	}
}
}

?>