<?php
/**
 * Cornerstone functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link https://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since Cornerstone 1.0
 */

/**
 * Various clean up functions
 */
require_once( 'inc/cleanup.php' );

/**
 * Add theme support
 */
require_once( 'inc/theme-support.php' );

/**
 * Enqueue CSS and scripts
 */
require_once( 'inc/enqueue-scripts.php' );

/**
 * Register navigation menus
 */
require_once( 'inc/navigation.php' );

/**
 * Menu walkers
 */
require_once( 'inc/menu-walker.php' );

/**
 * Widgets
 */
require_once( 'inc/widget-areas.php' );
require_once( 'inc/widgets/widget-recent-posts-thumbs.php' );
require_once( 'inc/widgets/widget-advanced-custom-menu.php' );
//<strong><strong></strong></strong>require_once( 'inc/widgets/widget-contact.php' );

/**
 * Return entry meta information for posts
 */
require_once( 'inc/entry-meta.php' );

/**
 * Zurb Foundation specific functions
 */
require_once('inc/foundation.php');

/**
 * Theme Customizer
 */
require_once get_template_directory() . '/inc/include-kirki.php';
require_once get_template_directory() . '/inc/class-pptheme-kirki.php';
require_once('inc/theme-customizer.php');

/**
 * Custom Post Types
 */
if ( true == get_theme_mod( 'cpt_orbit', true ) ) {
	require_once( 'inc/cpt-orbit.php' );
}
if ( true == get_theme_mod( 'cpt_services', true ) ) {
	require_once( 'inc/cpt-services.php' );
	require_once( 'inc/widgets/widget-services.php' );
}
if ( true == get_theme_mod( 'cpt_testimonials', true ) ) {
	require_once( 'inc/cpt-testimonials.php' );
}
if ( true == get_theme_mod( 'cpt_team', true ) ) {
	require_once( 'inc/cpt-team.php' );
}
if ( true == get_theme_mod( 'cpt_videos', true ) ) {
	require_once( 'inc/cpt-videos.php' );
}

/**
 * WooCommerce
 */
if ( class_exists( 'woocommerce' ) ) {
	require_once('inc/woocommerce.php');
}

/**
 * Shortcodes
 */
require_once('inc/shortcodes.php');

/**
 * TGM Plugin Activation
 */
//require_once ('inc/class-tgm-plugin-activation.php');
require_once ('inc/plugin-installer.php');

/**
 * Contact Form 7
 */
//function check_cf7_plugin_installed()
//{
//	if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
//		require_once('inc/contact-form7-mods.php');
//	}
//}
//add_action('admin_init', 'check_cf7_plugin_installed');

/**
 * Default theme settings on activation (eg image sizes)
 */
require_once('inc/theme-defaults.php');

/**
 * Misc
 */
require_once('inc/misc.php');

/**
 * Gutenberg
 */
require_once('inc/gutenberg.php');

/**
 * Custom admin
 */
require_once('inc/custom-admin.php');

/**
 * Theme Updates
 */
 
 // Automatic theme updates from the GitHub repository
add_filter('pre_set_site_transient_update_themes', 'automatic_GitHub_updates', 100, 1);
function automatic_GitHub_updates($data) {
  // Theme information
  $theme   = get_stylesheet(); // Folder name of the current theme
  $current = wp_get_theme()->get('Version'); // Get the version of the current theme
  // GitHub information
  $user = 'piotrpaintingpixels'; // The GitHub username hosting the repository
  $repo = 'pp_customer_theme'; // Repository name as it appears in the URL
  // Get the latest release tag from the repository. The User-Agent header must be sent, as per
  // GitHub's API documentation: https://developer.github.com/v3/#user-agent-required
  $file = @json_decode(@file_get_contents('https://api.github.com/repos/'.$user.'/'.$repo.'/releases/latest', false,
      stream_context_create(['http' => ['header' => "User-Agent: ".$user."\r\n"]])
  ));
  if($file) {
	$update = filter_var($file->tag_name, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    // Only return a response if the new version number is higher than the current version
    if($update > $current) {
  	  $data->response[$theme] = array(
	      'theme'       => $theme,
	      // Strip the version number of any non-alpha characters (excluding the period)
	      // This way you can still use tags like v1.1 or ver1.1 if desired
	      'new_version' => $update,
	      'url'         => 'https://github.com/'.$user.'/'.$repo,
	      'package'     => $file->assets[0]->browser_download_url,
      );
    }
  }
  return $data;
}