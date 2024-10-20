<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function getbowtied_documentation_content()
{
	global 	
		$theme_url_docs_gbt_dash;
?>

	<div class="wrap">
		<div style="padding:10px 40px; margin: 20px 0 0 0">
			<div style="padding:10px 10px; border: 1px solid #ddd; background: #fff">⚠ We are working on new documentation. You will find it here when it is ready. In the meantime you have the old one below.</div>
		</div>
		<iframe id="getbowtied_dashboard_iframe" src="<?php echo esc_url($theme_url_docs_gbt_dash); ?>"></iframe>
	</div>

<?php
}
