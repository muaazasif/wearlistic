<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function getbowtied_changelog_content()
{
	global 	
		$theme_url_changelog_gbt_dash;

?>
	<div class="wrap">
		<iframe id="getbowtied_dashboard_iframe" src="<?php echo esc_url($theme_url_changelog_gbt_dash); ?>"></iframe>
	</div>

<?php
}
