<?php
$params = array();

// General settings
$params[] = array(
    'type' 			=> 'dropdown',
    'heading' 		=> esc_html__( 'Icon Size', 'nm-framework-admin' ),
    'param_name' 	=> 'icon_size',
    'description'	=> esc_html__( 'Select icon size.', 'nm-framework-admin' ),
    'value' 		=> array(
        'Small'		=> 'small',
        'Medium'	=> 'medium',
        'Large'		=> 'large',
    ),
    'std' 			=> 'medium',
);
$params[] = array(
    'type' 			=> 'dropdown',
    'heading' 		=> esc_html__( 'Icon Alignment', 'nm-framework-admin' ),
    'param_name' 	=> 'alignment',
    'description'	=> esc_html__( 'Select icon alignment.', 'nm-framework-admin' ),
    'value' 		=> array(
        'Center'	=> 'center',
        'Left'		=> 'left',
        'Right'		=> 'right',
    ),
    'std' 			=> 'center',
);

// Social profiles settings
if ( function_exists( 'nm_get_social_profiles' ) ) {
    global $nm_theme_options;
    
    if ( isset( $nm_theme_options['social_profiles'] ) && ! empty( $nm_theme_options['social_profiles'] ) ) {
        $social_profiles_meta = nm_get_social_profiles( '', true ); // Args: $wrapper_class, $return_meta
        
        foreach( $nm_theme_options['social_profiles'] as $slug => $theme_setting_url ) { // Loop theme settings to get custom order
            if ( isset( $social_profiles_meta[$slug] ) ) {
                $params[] = array(
                    'type' 			=> 'textfield',
                    'heading' 		=> $social_profiles_meta[$slug]['title'],
                    'param_name' 	=> 'social_profile_' . $slug,
                );
            }
        }
    }
}

// VC element: nm_social_profiles
vc_map( array(
   'name'			=> esc_html__( 'Social Profiles', 'nm-framework-admin' ),
   'category'		=> esc_html__( 'Social', 'nm-framework-admin' ),
   'description'	=> esc_html__( 'Social media profile icons', 'nm-framework-admin' ),
   'base'			=> 'nm_social_profiles',
   'icon'			=> 'nm_social_profiles',
   'params'			=> $params,
) );
