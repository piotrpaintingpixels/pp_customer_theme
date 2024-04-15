<?php
/**
 * Enqueue CSS and scripts
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since Cornerstone 3.5.3
 */

if ( ! function_exists( 'load_cornerstone_css' ) ) {

	function load_cornerstone_css() {

		wp_enqueue_style(
			'foundation-style',
			'https://cdnjs.cloudflare.com/ajax/libs/foundation/6.6.3/css/foundation.min.css',
			array(),
			false,
			'all'
		);

		wp_enqueue_style(
			'motion-ui-style',
			'https://cdnjs.cloudflare.com/ajax/libs/motion-ui/2.0.3/motion-ui.min.css',
			array('foundation-style'),
			false,
			'all'
		);

		if ( has_nav_menu( 'header-megamenu-left' ) || has_nav_menu( 'header-megamenu-right' ) ) {
			wp_enqueue_style(
				'megamenu-style',
				get_theme_file_uri( 'css/megamenu.css' ),
				false,
				false,
				'all'
			);
		}
	}
}

if ( ! function_exists( 'load_cornerstone_main_css' ) ) {
	function load_cornerstone_main_css() {
		wp_enqueue_style(
			'theme-style',
			get_theme_file_uri( 'style.min.css' ),
			array('foundation-style'),
			false,
			'all'
		);

	}

}

if ( ! function_exists( 'load_cornerstone_scripts' ) ) {

	function load_cornerstone_scripts() {

		wp_enqueue_script(
			'foundation-script',
			'https://cdnjs.cloudflare.com/ajax/libs/foundation/6.6.3/js/foundation.min.js',
			array('jquery'),
			false,
			true
		);

		wp_enqueue_script(
			'what-input-script',
			'https://cdnjs.cloudflare.com/ajax/libs/what-input/5.2.10/what-input.min.js',
			array('jquery'),
			false,
			true
		);

		if ( has_nav_menu( 'header-megamenu-left' ) || has_nav_menu( 'header-megamenu-right' ) ) {
			wp_enqueue_script(
				'megamenu_js',
				get_stylesheet_directory_uri() . '/js/megamenu.js',
				array('jquery'),
				false,
				true
			);
		}

		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}

	}

}

add_action( 'wp_enqueue_scripts', 'load_cornerstone_css', 0 );
add_action( 'wp_enqueue_scripts', 'load_cornerstone_main_css', 50 ); // loads below plugin css
add_action( 'wp_enqueue_scripts', 'load_cornerstone_scripts', 0 );




if ( ! function_exists( 'cornerstone_foundation_responsive_embed' ) ) {
	function cornerstone_foundation_responsive_embed() { ?>
	<script type="text/javascript">
	jQuery(function($) {
		<?php // Add Responsive Embed to YouTube and Vimeo Embeds ?>
		$('iframe[src*="youtube.com"], iframe[src*="vimeo.com"], iframe[src*="facebook.com"]').each(function() {
	    	if ( $(this).innerWidth() / $(this).innerHeight() > 1.5 ) {
	    		$(this).wrap("<div class='responsive-embed widescreen'/>");
	    	} else {
	    		$(this).wrap("<div class='responsive-embed'/>");
	    	}
	    });
	});
	</script>
	<?php }
}
if ( true == get_theme_mod( 'responsive_embed', true ) ) {
	add_action( 'wp_footer', 'cornerstone_foundation_responsive_embed', 9999 );
}

add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
function my_deregister_styles() {
  wp_deregister_style('mailchimpSF_main_css');
  wp_deregister_style('mailchimpSF_ie_css');
  wp_deregister_style('dashicons');
  wp_dequeue_style('yoast-seo-adminbar');
  wp_deregister_style('yoast-seo-adminbar');
}


function webfont_load() {
?>
<script>
WebFontConfig = {
custom: {families: ['FontAwesome'],
urls: [ 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' ]}
};
(function(d) {
var wf = d.createElement('script'), s = d.scripts[0];
wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
s.parentNode.insertBefore(wf, s);
})(document);
</script>
<?php }
add_action( 'wp_footer', 'webfont_load', 999999 );


function ga_script() {
	$ga = get_theme_mod( 'google_analytics' );
?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo $ga ?>', { 'anonymize_ip': true });
</script>
<?php }
if ( ! empty(get_theme_mod( 'google_analytics' ) ) ) {
	add_action( 'wp_footer', 'ga_script' );
}


// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );


//add_action('wp_enqueue_scripts', 'rudr_move_jquery_to_footer');
//function rudr_move_jquery_to_footer() {
//	// unregister the jQuery at first
// 	wp_deregister_script('jquery');
//	// register to footer (the last function argument should be true)
//	wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), false, null, true);
//	wp_enqueue_script('jquery');
//}

add_filter( 'script_loader_tag', 'wsds_defer_scripts', 10, 3 );
function wsds_defer_scripts( $tag, $handle, $src ) {

	// The handles of the enqueued scripts we want to defer
	$defer_scripts = array(
		'what-input_js',
		'wp-embed'
	);

    if ( in_array( $handle, $defer_scripts ) ) {
        return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
    }

    return $tag;
}


// Update CSS within in Admin
function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');
