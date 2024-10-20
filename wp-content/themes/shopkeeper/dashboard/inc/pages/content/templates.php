<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function getbowtied_templates_content()
{
	global 	
		$theme_slug_gbt_dash,
		$theme_name_gbt_dash;
?>

	<div class="wrap">
	
		<h1>You're just starting out?</h1>

		<p>
	    	Install the "<strong>Kits, Templates and Patterns</strong>" plugin and give our Starter Templates a try! They'll help you launch your project faster.<br />
	    	These templates are built with Elementor, and you will have access to all the widgets in Elementor PRO without a subscription.
	    </p>

		<a href="<?php echo esc_url(admin_url('plugins.php?page='.$theme_slug_gbt_dash.'-plugins')); ?>" class="button button-primary button-large">Get "Kits, Templates and Patterns" plugin for <?php echo esc_html($theme_name_gbt_dash); ?>. It's free.</a>
	
	</div>

<?php
}
