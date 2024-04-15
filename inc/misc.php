<?php
/**
 * Misc
 */


if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

/**
 * [wpse_custom_excerpts description]
 * @param  [type] $limit [word count]
 * @return [type]        [excerpt]
 */
function wpse_custom_excerpts($limit) {
    return wp_trim_words(get_the_excerpt(), $limit, '<a href="'. esc_url( get_permalink() ) . '">' . '&nbsp;&hellip;' . '</a>');
}

function wpse_custom_excerpts2($limit) {
    return wp_trim_words(get_the_excerpt(), $limit, '<a href="'. esc_url( get_permalink() ) . '">' . '&nbsp;&hellip;' . __( 'Read more &nbsp;&raquo;', 'paintingpixels' ) . '</a>');
}

if (class_exists('MultiPostThumbnails')) {
    foreach( array( 'post', 'page', 'services', 'team_member' ) as $post_type ){
        new MultiPostThumbnails(
            array(
                'label' => 'Header Image',
                'id' => 'banner-image',
                'post_type' => $post_type
            )
        );
    }
}