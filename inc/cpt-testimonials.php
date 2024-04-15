<?php
/**
 * Testimonials Custom Post Type
 */

// Register Custom Post Type
function testimonials_cpt() {

  $labels = array(
    'name'                  => _x( 'Testimonials', 'Post Type General Name', 'paintingpixels' ),
    'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'paintingpixels' ),
    'menu_name'             => __( 'Testimonials', 'paintingpixels' ),
    'name_admin_bar'        => __( 'Testimonial', 'paintingpixels' ),
    'archives'              => __( 'Testimonial Archives', 'paintingpixels' ),
    'parent_item_colon'     => __( 'Parent Testimonial:', 'paintingpixels' ),
    'all_items'             => __( 'All Testimonials', 'paintingpixels' ),
    'add_new_item'          => __( 'Add New Testimonial', 'paintingpixels' ),
    'add_new'               => __( 'Add New', 'paintingpixels' ),
    'new_item'              => __( 'New Testimonial', 'paintingpixels' ),
    'edit_item'             => __( 'Edit Testimonial', 'paintingpixels' ),
    'update_item'           => __( 'Update Testimonial', 'paintingpixels' ),
    'view_item'             => __( 'View Testimonial', 'paintingpixels' ),
    'search_items'          => __( 'Search Testimonial', 'paintingpixels' ),
    'not_found'             => __( 'Not found', 'paintingpixels' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'paintingpixels' ),
    'featured_image'        => __( 'Featured Image', 'paintingpixels' ),
    'set_featured_image'    => __( 'Set featured image', 'paintingpixels' ),
    'remove_featured_image' => __( 'Remove featured image', 'paintingpixels' ),
    'use_featured_image'    => __( 'Use as featured image', 'paintingpixels' ),
    'insert_into_item'      => __( 'Insert into Testimonial', 'paintingpixels' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Testimonial', 'paintingpixels' ),
    'items_list'            => __( 'Testimonials list', 'paintingpixels' ),
    'items_list_navigation' => __( 'Testimonials list navigation', 'paintingpixels' ),
    'filter_items_list'     => __( 'Filter Testimonials list', 'paintingpixels' ),
  );
  $args = array(
    'label'                 => __( 'Testimonial', 'paintingpixels' ),
    'description'           => __( 'Testimonials', 'paintingpixels' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', ),
    //'taxonomies'            => array( 'category', 'post_tag' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 20,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => false,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'testimonials', $args );

}
add_action( 'init', 'testimonials_cpt', 0 );


// Register Custom Taxonomy
function testimonials_taxonomy() {

  $labels = array(
    'name'                       => _x( 'Testimonial Categories', 'Taxonomy General Name', 'text_domain' ),
    'singular_name'              => _x( 'Testimonial Category', 'Taxonomy Singular Name', 'text_domain' ),
    'menu_name'                  => __( 'Testimonial Category', 'text_domain' ),
    'all_items'                  => __( 'All Testimonial Categories', 'text_domain' ),
    'parent_item'                => __( 'Parent Testimonial Category', 'text_domain' ),
    'parent_item_colon'          => __( 'Parent Testimonial Category:', 'text_domain' ),
    'new_item_name'              => __( 'New Testimonial Category Name', 'text_domain' ),
    'add_new_item'               => __( 'Add New Testimonial Category', 'text_domain' ),
    'edit_item'                  => __( 'Edit Testimonial Category', 'text_domain' ),
    'update_item'                => __( 'Update Testimonial Category', 'text_domain' ),
    'view_item'                  => __( 'View Testimonial Category', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate Testimonial Category with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove Testimonial Categories', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
    'popular_items'              => __( 'Popular Testimonial Categories', 'text_domain' ),
    'search_items'               => __( 'Search Testimonial Categories', 'text_domain' ),
    'not_found'                  => __( 'Not Found', 'text_domain' ),
    'no_terms'                   => __( 'No Testimonial Categories', 'text_domain' ),
    'items_list'                 => __( 'Testimonial Categories list', 'text_domain' ),
    'items_list_navigation'      => __( 'Testimonial Categories list navigation', 'text_domain' ),
  );
  $args = array(
    'labels'                     => $labels,
    'hierarchical'               => true,
    'public'                     => true,
    'show_ui'                    => true,
    'show_admin_column'          => true,
    'show_in_nav_menus'          => true,
    'show_tagcloud'              => true,
  );
  register_taxonomy( 'testimonial_category', array( 'testimonials' ), $args );

}
add_action( 'init', 'testimonials_taxonomy', 0 );