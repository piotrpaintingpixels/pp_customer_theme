<?php
/**
 * Video Custom Post Type
 */

// Register Custom Post Type
function create_video_cpt() {

	$labels = array(
		'name' => __( 'Videos', 'Post Type General Name', 'paintingpixels' ),
		'singular_name' => __( 'Video', 'Post Type Singular Name', 'paintingpixels' ),
		'menu_name' => __( 'Videos', 'paintingpixels' ),
		'name_admin_bar' => __( 'Video', 'paintingpixels' ),
		'archives' => __( 'Video Archives', 'paintingpixels' ),
		'attributes' => __( 'Video Attributes', 'paintingpixels' ),
		'parent_item_colon' => __( 'Parent Video:', 'paintingpixels' ),
		'all_items' => __( 'All Videos', 'paintingpixels' ),
		'add_new_item' => __( 'Add New Video', 'paintingpixels' ),
		'add_new' => __( 'Add New', 'paintingpixels' ),
		'new_item' => __( 'New Video', 'paintingpixels' ),
		'edit_item' => __( 'Edit Video', 'paintingpixels' ),
		'update_item' => __( 'Update Video', 'paintingpixels' ),
		'view_item' => __( 'View Video', 'paintingpixels' ),
		'view_items' => __( 'View Videos', 'paintingpixels' ),
		'search_items' => __( 'Search Video', 'paintingpixels' ),
		'not_found' => __( 'Not found', 'paintingpixels' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'paintingpixels' ),
		'featured_image' => __( 'Featured Image', 'paintingpixels' ),
		'set_featured_image' => __( 'Set featured image', 'paintingpixels' ),
		'remove_featured_image' => __( 'Remove featured image', 'paintingpixels' ),
		'use_featured_image' => __( 'Use as featured image', 'paintingpixels' ),
		'insert_into_item' => __( 'Insert into Video', 'paintingpixels' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Video', 'paintingpixels' ),
		'items_list' => __( 'Videos list', 'paintingpixels' ),
		'items_list_navigation' => __( 'Videos list navigation', 'paintingpixels' ),
		'filter_items_list' => __( 'Filter Videos list', 'paintingpixels' ),
	);
	$args = array(
		'label' => __( 'Video', 'paintingpixels' ),
		'description' => __( 'Video Gallery', 'paintingpixels' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-video-alt3',
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author', 'custom-fields', ),
		'taxonomies' => array('video_category', ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'video', $args );

}
add_action( 'init', 'create_video_cpt', 0 );


// Register Taxonomy Category
// Taxonomy Key: category
function create_category_tax() {

	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'paintingpixels' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'paintingpixels' ),
		'search_items'      => __( 'Search Categories', 'paintingpixels' ),
		'all_items'         => __( 'All Categories', 'paintingpixels' ),
		'parent_item'       => __( 'Parent Category', 'paintingpixels' ),
		'parent_item_colon' => __( 'Parent Category:', 'paintingpixels' ),
		'edit_item'         => __( 'Edit Category', 'paintingpixels' ),
		'update_item'       => __( 'Update Category', 'paintingpixels' ),
		'add_new_item'      => __( 'Add New Category', 'paintingpixels' ),
		'new_item_name'     => __( 'New Category Name', 'paintingpixels' ),
		'menu_name'         => __( 'Category', 'paintingpixels' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( '', 'paintingpixels' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_rest' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => false,
	);
	register_taxonomy( 'video_category', array('video', ), $args );

}
add_action( 'init', 'create_category_tax' );



add_action( "load-edit.php", 'pp_help_tabs_videos' );
add_action( "load-post.php", 'pp_help_tabs_videos' );


function pp_help_tabs_videos() {

    $screen = get_current_screen();

    $screen_ids = array( 'edit-page', 'page' );

    if ( ! in_array( $screen->id, $screen_ids ) ) {
        return;
    }

    $screen->add_help_tab(
        array(
            'id'      => 'pp_help_videos',
            'title'   => 'Videos shortcode',
            'content' => '<p>[pp_video_gallery posts_per_page="" loop_wrap_tag="" loop_wrap_class="" post_wrap_tag="" show_title="" title_tag="h3" post_order="" thumbnail="" lightbox="" link_to_full="" grid=true grid_columns_mobile=1 grid_columns_tablet=2 grid_columns_desktop=4]</p>'
        )
    );


    // Add a sidebar to contextual help.
    //$screen->set_help_sidebar( 'This is the content you will be adding to the sidebar.' );
}

// Create Shortcode pp_video_gallery
// Use the shortcode: [pp_video_gallery posts_per_page="" loop_wrap_tag="" loop_wrap_class="" post_wrap_tag="" show_title="" title_tag="h3" post_order="" thumbnail="" lightbox="" link_to_full="" grid=true grid_columns_mobile=1 grid_columns_tablet=2 grid_columns_desktop=4]

function create_ppvideogallery_shortcode($atts) {
	// Attributes
   $atts = array_change_key_case((array)$atts, CASE_LOWER); // normalize attribute keys, lowercase
	$atts = shortcode_atts(
		array(
			'posts_per_page' => null,
			'loop_wrap_tag' => null,
			'loop_wrap_class' => null,
			'post_wrap_tag' => null,
			'post_wrap_class' => null,
			'show_title' => true,
			'title_tag' => 'h3',
			'grid' => true,
			'grid_columns_mobile' => 1,
			'grid_columns_tablet' => 2,
			'grid_columns_desktop' => 4,
			'post_order' => '',
			'show_thumbnail' => 'true',
			'lightbox' => 'true',
			//'link_to_full' => '',
		),
		$atts,
		'pp_video_gallery'
	);
	// Attributes in var
	$posts_per_page = $atts['posts_per_page'];
	$loop_wrap_tag = $atts['loop_wrap_tag'];
	$loop_wrap_class = $atts['loop_wrap_class'];
	$post_wrap_tag = $atts['post_wrap_tag'];
	$post_wrap_class = $atts['post_wrap_class'];
	$show_title = filter_var( $atts['show_title'], FILTER_VALIDATE_BOOLEAN );
	$title_tag = $atts['title_tag'];
	$grid = filter_var( $atts['grid'], FILTER_VALIDATE_BOOLEAN );
	$grid_columns_mobile = $atts['grid_columns_mobile'];
	$grid_columns_tablet = $atts['grid_columns_tablet'];
	$grid_columns_desktop = $atts['grid_columns_desktop'];
	$post_order = $atts['post_order'];
	$show_thumbnail = $atts['show_thumbnail'];
	$lightbox = filter_var( $atts['lightbox'], FILTER_VALIDATE_BOOLEAN );
	//$link_to_full = $atts['link_to_full'];

	global $post;
	global $wp_embed;
	$output = "";

	$output .= (empty($loop_wrap_tag)) ? '' : '<' . $loop_wrap_tag . ((empty($loop_wrap_class)) ? '' : ' class="' . $loop_wrap_class . '"') . '>';

	$loopArgs = array(
		'post_type' => 'video',
		'posts_per_page' => (empty($atts['posts_per_page'])) ? '-1' : $atts['posts_per_page'],
		'no_found_rows' => true, // counts posts, remove if pagination required
		'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
		'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
		);
	$loop = new WP_Query($loopArgs);
	$output .= '<div class="video_gallery">';
	$output .= ($grid == 'true') ? ('<div class="grid-x grid-padding-x grid-padding-y small-up-' . $grid_columns_mobile . ' medium-up-' . $grid_columns_tablet . ' large-up-' . $grid_columns_desktop . '">') : '';
	while ($loop->have_posts()) : $loop->the_post();

		$output .= ($grid == 'true') ? '<div class="cell">' : '';
		$output .= (empty($post_wrap_tag)) ? '' : '<' . $post_wrap_tag . ((empty($post_wrap_class)) ? '' : ' class="' . $post_wrap_class . '"') . '>';

		/* Thumbnail */
		if ( $show_thumbnail == 'true' && has_post_thumbnail() ) :
			$output .= ($lightbox == 'true') ? '<a data-toggle="videoreveal' . $post->ID . '">' : '';
			$output .= get_the_post_thumbnail($post->ID, 'thumbnail');
			$output .= ($lightbox == 'true') ? '</a>' : '';
			$output .= ($lightbox == 'true') ? '<i class="play fa fa-4x fa-youtube-play" aria-hidden="true" data-toggle="videoreveal' . $post->ID . '"></i>' : '';
			$output .= ($lightbox == 'true') ? '<div class="large reveal" id="videoreveal' . $post->ID . '" data-reveal data-reset-on-close="true">' . apply_filters('the_content', get_the_content()). '<button class="close-button" data-close aria-label="Close reveal" type="button"><span aria-hidden="true">&times;</span></button></div>' : '';
		else :
			$output .= apply_filters('the_content', get_the_content());
		endif;

		if ($show_title == 'true') :
			$output .= (empty($title_tag)) ? '' : '<' . $title_tag . '>';
			//$output .= ($link_to_full == 'true') ? '<a href="' . get_permalink( $post, false ) . '">' : '';
			$output .= get_the_title();
			//$output .= ($link_to_full == 'true') ? '</a>' : '';
		endif;

		$output .= (empty($post_wrap_tag)) ? '' : '</' . $post_wrap_tag . '>';
		$output .= ($grid == 'true') ? '</div>' : '';
	endwhile; wp_reset_query(); // End the loop

	$output .= ($grid == 'true') ? '</div>' : '';
	$output .= '</div>';

	$output .= (empty($loop_wrap_tag)) ? '' : '</' . $loop_wrap_tag . '>';

	return $output;
}
add_shortcode( 'pp_video_gallery', 'create_ppvideogallery_shortcode' );