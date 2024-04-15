<?php
/**
 * Team Members Custom Post Type
 */

// Register Custom Post Type
function team_members_cpt() {

  $labels = array(
    'name'                  => _x( 'Team Members', 'Post Type General Name', 'paintingpixels' ),
    'singular_name'         => _x( 'Team Member', 'Post Type Singular Name', 'paintingpixels' ),
    'menu_name'             => __( 'Team Members', 'paintingpixels' ),
    'name_admin_bar'        => __( 'Team Member', 'paintingpixels' ),
    'archives'              => __( 'Team Member Archives', 'paintingpixels' ),
    'parent_item_colon'     => __( 'Parent Team Member:', 'paintingpixels' ),
    'all_items'             => __( 'All Team Members', 'paintingpixels' ),
    'add_new_item'          => __( 'Add New Team Member', 'paintingpixels' ),
    'add_new'               => __( 'Add New', 'paintingpixels' ),
    'new_item'              => __( 'New Team Member', 'paintingpixels' ),
    'edit_item'             => __( 'Edit Team Member', 'paintingpixels' ),
    'update_item'           => __( 'Update Team Member', 'paintingpixels' ),
    'view_item'             => __( 'View Team Member', 'paintingpixels' ),
    'search_items'          => __( 'Search Team Member', 'paintingpixels' ),
    'not_found'             => __( 'Not found', 'paintingpixels' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'paintingpixels' ),
    'featured_image'        => __( 'Featured Image', 'paintingpixels' ),
    'set_featured_image'    => __( 'Set featured image', 'paintingpixels' ),
    'remove_featured_image' => __( 'Remove featured image', 'paintingpixels' ),
    'use_featured_image'    => __( 'Use as featured image', 'paintingpixels' ),
    'insert_into_item'      => __( 'Insert into Team Member', 'paintingpixels' ),
    'uploaded_to_this_item' => __( 'Uploaded to this Team Member', 'paintingpixels' ),
    'items_list'            => __( 'Team Members list', 'paintingpixels' ),
    'items_list_navigation' => __( 'Team Members list navigation', 'paintingpixels' ),
    'filter_items_list'     => __( 'Filter Team Members list', 'paintingpixels' ),
  );
  $args = array(
    'label'                 => __( 'Team Member', 'paintingpixels' ),
    'description'           => __( 'Team Members', 'paintingpixels' ),
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
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'team_member', $args );

}
add_action( 'init', 'team_members_cpt', 0 );


/**
 * Meta Box
 */

function team_member_details_get_meta( $value ) {
    global $post;

    $field = get_post_meta( $post->ID, $value, true );
    if ( ! empty( $field ) ) {
        return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
    } else {
        return false;
    }
}

function team_member_details_add_meta_box() {
    add_meta_box(
        'team_member_details-team-member-details',
        __( 'Team Member details', 'paintingpixels' ),
        'team_member_details_html',
        'team_member',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'team_member_details_add_meta_box' );

function team_member_details_html( $post) {
    wp_nonce_field( '_team_member_details_nonce', 'team_member_details_nonce' ); ?>

    <p>
        <label for="team_member_details_job_title"><?php _e( 'Job title', 'paintingpixels' ); ?></label><br>
        <input class="widefat" type="text" name="team_member_details_job_title" id="team_member_details_job_title" value="<?php echo team_member_details_get_meta( 'team_member_details_job_title' ); ?>">
    </p>
    <p>
        <label for="team_member_details_facebook"><?php _e( 'Facebook', 'paintingpixels' ); ?></label><br>
        <input class="widefat" type="text" name="team_member_details_facebook" id="team_member_details_facebook" value="<?php echo team_member_details_get_meta( 'team_member_details_facebook' ); ?>">
    </p>
    <p>
        <label for="team_member_details_twitter"><?php _e( 'Twitter', 'paintingpixels' ); ?></label><br>
        <input class="widefat" type="text" name="team_member_details_twitter" id="team_member_details_twitter" value="<?php echo team_member_details_get_meta( 'team_member_details_twitter' ); ?>">
    </p>
    <p>
        <label for="team_member_details_linkedin"><?php _e( 'LinkedIn', 'paintingpixels' ); ?></label><br>
        <input class="widefat" type="text" name="team_member_details_linkedin" id="team_member_details_linkedin" value="<?php echo team_member_details_get_meta( 'team_member_details_linkedin' ); ?>">
    </p>
<?php }

function team_member_details_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! isset( $_POST['team_member_details_nonce'] ) || ! wp_verify_nonce( $_POST['team_member_details_nonce'], '_team_member_details_nonce' ) ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['team_member_details_job_title'] ) )
        update_post_meta( $post_id, 'team_member_details_job_title', esc_attr( $_POST['team_member_details_job_title'] ) );
    if ( isset( $_POST['team_member_details_facebook'] ) )
        update_post_meta( $post_id, 'team_member_details_facebook', esc_attr( $_POST['team_member_details_linkedin'] ) );
    if ( isset( $_POST['team_member_details_twitter'] ) )
        update_post_meta( $post_id, 'team_member_details_twitter', esc_attr( $_POST['team_member_details_linkedin'] ) );
    if ( isset( $_POST['team_member_details_linkedin'] ) )
        update_post_meta( $post_id, 'team_member_details_linkedin', esc_attr( $_POST['team_member_details_linkedin'] ) );
}
add_action( 'save_post', 'team_member_details_save' );

/*
    Usage: team_member_details_get_meta( 'team_member_details_job_title' )
    Usage: team_member_details_get_meta( 'team_member_details_linkedin' )
*/