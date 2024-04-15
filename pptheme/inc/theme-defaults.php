<?php
/**
 * Theme default settings
 */

add_theme_support( 'post-thumbnails' );
add_image_size( 'orbit', get_theme_mod( 'orbit_image_width', 1200 ), get_theme_mod( 'orbit_image_height', 400 ), get_theme_mod( 'orbit_image_cropped', true ) );
add_image_size( 'banner', get_theme_mod( 'banner_image_width', 1200 ), get_theme_mod( 'banner_image_height', 400 ), get_theme_mod( 'banner_image_cropped', true ) );
add_image_size( 'services_thumbnail', get_theme_mod( 'services_thumbnail_width', 370 ), get_theme_mod( 'services_thumbnail_height', 250 ), get_theme_mod( 'services_thumbnail_cropped', true ) );
add_image_size( 'teammember_thumbnail', get_theme_mod( 'teammember_thumbnail_width', 370 ), get_theme_mod( 'teammember_thumbnail_height', 250 ), get_theme_mod( 'teammember_thumbnail_cropped', true ) );


/**
 * Define image sizes
 */
function pp_theme_activated() {
	global $pagenow;

	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}
  	$catalog = array(
		'width' 	=> '370',	// px
		'height'	=> '250',	// px
		'crop'		=> 1 		// true
	);
	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'		=> 1 		// true
	);
	$thumbnail = array(
		'width' 	=> '370',	// px
		'height'	=> '250',	// px
		'crop'		=> 0 		// false
	);
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	update_option( 'thumbnail_size_w', 370 );
    update_option( 'thumbnail_size_h', 250 );
    //update_option( 'medium_size_w', 370 );
    //update_option( 'medium_size_h', 250 );
    //update_option( 'large_size_w', 370 );
    //update_option( 'large_size_h', 250 );
}
add_action( 'after_switch_theme', 'pp_theme_activated', 1 );


//add_action('after_setup_theme', 'create_pages');
function create_pages(){
	if(get_option('page_on_front')=='0' && get_option('show_on_front')=='posts'){
        // Create homepage
        $homepage = array(
            'post_type'    => 'page',
            'post_title'    => 'Home',
            'post_content'  => '',
            'post_status'   => 'publish',
            //'post_author'   => 1
        );
        // Insert the post into the database
        $homepage_id = wp_insert_post( $homepage );
        //set the page template
        //assuming you have defined template on your-template-filename.php
        update_post_meta($homepage_id, '_wp_page_template', 'page-templates/template-home1.php');
    }
}
