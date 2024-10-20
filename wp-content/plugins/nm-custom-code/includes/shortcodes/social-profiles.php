<?php
	
// Shortcode: nm_social_profiles
function nm_shortcode_social_profiles( $atts, $content = NULL ) {
    if ( function_exists( 'nm_get_social_profiles' ) ) {
        global $nm_theme_options;

        $social_profiles_meta = nm_get_social_profiles( '', true ); // Args: $wrapper_class, $return_meta
        $rel_attribute = apply_filters( 'nm_social_profiles_nofollow_attr', 'rel="nofollow"' );
        $output = '';

        // Loop theme settings to get custom order
        foreach( $nm_theme_options['social_profiles'] as $slug => $theme_setting_url ) {
            if ( isset( $atts['social_profile_' . $slug] ) && ! empty( $atts['social_profile_' . $slug] ) ) {
                $url = $atts['social_profile_' . $slug];

                if ( $slug == 'email' ) {
                    $url = 'mailto:' . $url;
                }

                $output .= '<li><a href="' . esc_url( $url ) . '" target="_blank" title="' . esc_attr( $social_profiles_meta[$slug]['title'] ) . '" class="dark" ' . $rel_attribute . '><i class="nm-font nm-font-' . esc_attr( $social_profiles_meta[$slug]['icon'] ) . '"></i></a></li>';
            }
        }

        // General settings
        $icon_size = ( isset( $atts['icon_size'] ) ) ? $atts['icon_size'] : 'medium';
        $alignment = ( isset( $atts['alignment'] ) ) ? $atts['alignment'] : 'center';

        return '<ul class="nm-social-profiles icon-size-' . esc_attr( $icon_size ) . ' align-' . esc_attr( $alignment ) . '">' . $output . '</ul>';
    }
}

add_shortcode( 'nm_social_profiles', 'nm_shortcode_social_profiles' );
