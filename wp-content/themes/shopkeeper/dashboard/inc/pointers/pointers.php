<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action(
    'in_admin_footer',
    function() {

    	global $theme_name_gbt_dash;
    	
        wp_enqueue_script( 'jquery' );
        wp_enqueue_style( 'wp-pointer' );
        wp_enqueue_script( 'wp-pointer' );
    
		if (
			! get_user_meta(
				get_current_user_id(),
				'getbowtied-welcome-pointer-dismissed',
				true
			)
		):
			
		?>
			<style>
				/*.getbowtied-welcome-pointer {

				}
				.getbowtied-welcome-pointer h3 {
					background: #FF5A44;
					border-color: #FF5A44;
				}
				.getbowtied-welcome-pointer h3:before {
					color: #FF5A44;
					content: "\f174";
				}*/
			</style>

			<script>
			jQuery(
				function() {
					jQuery('#toplevel_page_getbowtied-dashboard').pointer( 
						{
							content:
								"<h3><?php echo esc_html($theme_name_gbt_dash); ?> Dashboard</h3>" +
								"<h4>Welcome to <?php echo esc_html($theme_name_gbt_dash); ?> Dashboard!</h4>" +
								"<p>Here you will find templates, kits, plugins, useful links, documentation and help.</p>" +
								"<p>If you get lost, come back here.</p>",


							position:
								{
									edge:  'left',
									align: 'center'
								},

							pointerClass:
								'getbowtied-welcome-pointer',

							pointerWidth: 500,
							
							close: function() {
								jQuery.post(
									ajaxurl,
									{
										pointer: 'getbowtied-welcome-pointer',
										action: 'dismiss-getbowtied-welcome-pointer',
									}
								);
							},

						}
					).pointer('open');
				}
			);
			</script>

		<?php
		endif;
	}
);

add_action(
	'admin_init',
	function() {

		if ( isset( $_POST['action'] ) && 'dismiss-getbowtied-welcome-pointer' == $_POST['action'] ) {

			update_user_meta(
				get_current_user_id(),
				'getbowtied-welcome-pointer-dismissed',
				$_POST['pointer'],
				true
			);
		}
	}
);

// reset pointer on Theme Switch
function gbt_reset_getbowtied_welcome_pointer() {
	delete_metadata( 'user', null, 'getbowtied-welcome-pointer-dismissed', null, true );
}
add_action( 'after_switch_theme', 'gbt_reset_getbowtied_welcome_pointer' );