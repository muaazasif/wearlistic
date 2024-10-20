<?php
/**
 * WP filters
 *
 * @package shopkeeper
 */

/**
 * Add Fresco to Galleries
 */
function shopkeeper_fresco_galleries($content, $id, $size, $permalink, $icon, $text) {
    if ($permalink) {
        return $content;
    }
    $content = preg_replace("/<a/","<span class=\"fresco\" data-fresco-group=\"\"", $content, 1);

    return $content;
}
add_filter( 'wp_get_attachment_link', 'shopkeeper_fresco_galleries', 10, 6 );


/**
 * Wrap oembed html
 */
function shopkeeper_embed_oembed_html($html, $url, $attr, $post_id) {
	if ( strstr( $html,'youtube.com/embed/' ) || strstr( $html,'player.vimeo.com' ) ) {
		return '<div class="video-container responsive-embed widescreen">' . $html . '</div>';
	}

	return '<div class="video-container">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'shopkeeper_embed_oembed_html', 99, 4 );


/**
 * MIMES
 */
function shopkeeper_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'shopkeeper_mime_types');
add_filter('mime_types', 'shopkeeper_mime_types');



/**
 * OCDI
 */
add_filter( 'ocdi/regenerate_thumbnails_in_content_import', '__return_false' );
