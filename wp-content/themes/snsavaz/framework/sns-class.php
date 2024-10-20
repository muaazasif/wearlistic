<?php
if ( ! class_exists( 'snsavaz_Class' ) ) {
	class snsavaz_Class {
		public function __construct() {
			// Set cookie theme option
			add_action( 'wp_ajax_sns_setcookies', array($this,'snsavaz_setcookies') );
			add_action( 'wp_ajax_nopriv_sns_setcookies', array($this,'snsavaz_setcookies') );
			// Reset cookie theme option
			add_action( 'wp_ajax_sns_resetcookies', array($this,'snsavaz_resetcookies') );
			add_action( 'wp_ajax_nopriv_sns_resetcookies', array($this,'snsavaz_resetcookies') );
		}
		public function snsavaz_setcookies(){
			setcookie('snsavaz_'.$_POST['key'], $_POST['value'], time()+3600*24*1, '/'); // 1 day
			
		}
		public function snsavaz_resetcookies(){
			setcookie('snsavaz_theme_color', '', 0, '/');
			setcookie('snsavaz_use_boxedlayout', '', 0, '/');
			setcookie('snsavaz_use_stickmenu', '', 0, '/');
		}
		function snsavaz_getStyle($compile = 2, $scss = array('dir' => '', 'name' => ''), $css = array('dir' => '', 'name' => ''), $format = 'scss_formatter_compressed', $variables = array() ) {
			if($css['name'] == '') $css['name'] = $scss['name'];
			$scss_variables = '';
			if($variables) {
				//$css['name'] .= '-';
				foreach($variables as $propety => $value) {
					$scss_variables .= $propety . ':' . $value . ';';
					$css['name'] .= '-'.strtolower(preg_replace('/\W/i', '', $value));
				}
			}
			
			if( $compile == 2 || !file_exists(get_template_directory() . '/assets/css/' . $css['name'] . '.css') )
				$this->snsavaz_compileScss($scss, $css, $format, $scss_variables);
			return $css['name'] . '.css';
		}
		function snsavaz_compileScss($scss, $css, $format, $scss_variables) {
			global $wp_filesystem;
			if (empty($wp_filesystem)) {
				require_once ABSPATH . '/wp-admin/includes/file.php';
				WP_Filesystem();
			}
			require "scssphp/scss.inc.php";
			require "scssphp/compass/compass.inc.php";
			$sass = new scssc();
			new scss_compass($sass);
			$format = ($format == NULL) ? 'scss_formatter_compressed' : $format;
			$sass->setFormatter($format);
			$sass->addImportPath($scss['dir']);
			$string_sass = $scss_variables . $wp_filesystem->get_contents($scss['dir'] . $scss['name'] . '.scss');
			$string_css = $sass->compile($string_sass);
			//$string_css = preg_replace('/\/\*[\s\S]*?\*\//', '', $string_css); // remove mutiple comments
			$wp_filesystem->put_contents(
				$css['dir'] . $css['name'] . '.css',
				$string_css,
			  	FS_CHMOD_FILE
			);
		}
		function snsavaz_getOption($param, $default = '', $key = ''){
			global $snsavaz_opt;
			$value = '';
			// Get config via theme option
			if($key !== ''){
				if ( isset($snsavaz_opt[$param][$key]) && $snsavaz_opt[$param][$key] ) $value = $snsavaz_opt[$param][$key];
			}else{
				if ( isset($snsavaz_opt[$param]) && $snsavaz_opt[$param] ) $value = $snsavaz_opt[$param];
			}
			
			// Get config via cookie
			if ( isset($_COOKIE['snsavaz_'.$param]) && $_COOKIE['snsavaz_'.$param] != '' ) {
				$value = $_COOKIE['snsavaz_'.$param];
			}
			
			// Get config via page config
			if(is_page()){
				if ( function_exists('rwmb_meta') && rwmb_meta('snsavaz_'.$param) ) $value = rwmb_meta('snsavaz_'.$param);
			}
			
			if($value || class_exists( 'ReduxFramework' ))
				return $value; 
			// return default value
			return $default;
		}
		function snsavaz_css_file(){
			$optimize = '';
			$theme_color = $this->snsavaz_getOption('theme_color', '#fe7524');
			
			// Get page meta data
			if ( is_page() && function_exists('rwmb_meta') && rwmb_meta('snsavaz_page_themecolor') == 1) {
				$theme_color = rwmb_meta('sns_theme_color') != '' ? rwmb_meta('snsavaz_theme_color') : $theme_color;
			}
			
			// Body color
			$body_color = $this->snsavaz_getOption('body_font', '#8f8f8f', 'color');
			
			$scss_compile = $this->snsavaz_getOption('advance_scss_compile', 1);
			$scss_format = $this->snsavaz_getOption('advance_scss_format', 'scss_formatter_compressed');

			// Compile scss and get css file name
			$css_file = $this->snsavaz_getStyle(
				$scss_compile,
				array('dir' => SNSAVAZ_THEME_DIR . '/assets/scss/', 'name' => 'theme'),
				array('dir' => SNSAVAZ_THEME_DIR . '/assets/css/', 'name' => 'theme'),
				$scss_format,
				array(
					'$color1' => $theme_color,
					'$color' => $body_color,
				)
			);
			
			return $css_file;
		}
		
	}
}
?>