<?php
/**
 * Navigation
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since Cornerstone 3.5.3
 */

/**
 * Register wp_nav_menus
 */
if ( ! function_exists( 'cornerstone_menus' ) ) {
	function cornerstone_menus() {

		register_nav_menus(
			array(
				'offCanvasLeft' => esc_attr__( 'Off Canvas Left (mobile)', 'paintingpixels'),
				'offCanvasRight' => esc_attr__( 'Off Canvas Right (mobile)', 'paintingpixels'),
				'header-menu-top' => esc_attr__( 'Header Menu (top)', 'paintingpixels'),
				'header-menu-left' => esc_attr__( 'Header Menu (left)', 'paintingpixels' ),
				'header-menu-right' => esc_attr__( 'Header Menu (right)', 'paintingpixels' ),
				'header-megamenu-left' => esc_attr__( 'Header Mega Menu (left)', 'paintingpixels' ),
				'header-megamenu-right' => esc_attr__( 'Header Mega Menu (right)', 'paintingpixels' ),
				'footer-menu' => esc_attr__( 'Footer Menu', 'paintingpixels' ),
				'footer-menu-bottom' => esc_attr__( 'Footer Menu (Bottom)', 'paintingpixels' )
			)
		);

	}
}
add_action( 'init', 'cornerstone_menus' );


// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '') {
    $args['container'] = false;
    return $args;
}
// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var) {
    return is_array($var) ? array() : '';
}


add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
//add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's