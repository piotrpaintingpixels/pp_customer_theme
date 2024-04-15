<?php
/**
 * Widget areas in sidebar and footer
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since Cornerstone 3.5.3
 */

if (function_exists('register_sidebar')) {

	function cornerstone_widgets_init() {

		// Right Sidebar
		register_sidebar(array(
			'name'=> 'Right Sidebar',
			'id' => 'right_sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		));

		// Footer Sidebar
		register_sidebar(array(
			'name'=> 'Footer Widgets',
			'id' => 'footer_widgets',
			'before_widget' => '<div class="cell"><div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'name'=> 'Footer Top Widgets',
			'id' => 'footer_top_widgets',
			'before_widget' => '<div class="cell"><div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>',
		));

		// Frontpage Sidebar
		register_sidebar(array(
			'name'=> 'Frontpage Widgets',
			'id' => 'frontpage_widgets',
			'before_widget' => '<div class="cell"><div id="%1$s" class="widget %2$s" data-equalizer-watch>',
			'after_widget' => '</div></div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		));

		// Woocommerce Sidebar
		if ( class_exists( 'woocommerce' ) ) {
			register_sidebar(array(
				'name'=> 'Woocommerce Sidebar',
				'id' => 'woocommerce_sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widgettitle">',
				'after_title' => '</h4>',
			));
			register_sidebar(array(
				'name'=> 'Woocommerce Filter',
				'id' => 'woocommerce_filter',
				'before_widget' => '<div class="cell"><div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div></div>',
				'before_title' => '<h4 class="widgettitle">',
				'after_title' => '</h4>',
			));
		}

		if ( class_exists( 'Kirki' ) ) {
			$homepage_widget_areas = get_theme_mod( 'frontpage_widget_areas', array() );
			foreach ($homepage_widget_areas as $key=>$widget_area) {
				$widget_id = str_replace(" ", "_", strtolower( $widget_area['title'] ));
				register_sidebar(array(
					'name'=> $widget_area['title'],
					'id' => $widget_id,
					'before_widget' => '<div class="cell"><div id="%1$s" class="widget %2$s" data-equalizer-watch>',
					'after_widget' => '</div></div>',
					'before_title' => '<h4 class="widgettitle">',
					'after_title' => '</h4>',
				));
			};
		}
	}
	add_action( 'widgets_init', 'cornerstone_widgets_init' );
}

/**
 * Hide empty widget titles
 */
function pp_widget_title($title) {
    return $title == '&nbsp;' ? '' : $title;
}
add_filter('widget_title', 'pp_widget_title');

/**
 * Enable shortcodes in widgets
 */
add_filter('widget_text', 'do_shortcode');