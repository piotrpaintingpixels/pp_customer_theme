<?php
/**
 * Services Custom Post Type
 */

// Register Custom Post Type
function custom_post_type_services() {

	$labels = array(
		'name'                  => _x( 'Services', 'Post Type General Name', 'paintingpixels' ),
		'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'paintingpixels' ),
		'menu_name'             => __( 'Services', 'paintingpixels' ),
		'name_admin_bar'        => __( 'Services', 'paintingpixels' ),
		'archives'              => __( 'Service Archives', 'paintingpixels' ),
		'parent_item_colon'     => __( 'Parent Service:', 'paintingpixels' ),
		'all_items'             => __( 'All Services', 'paintingpixels' ),
		'add_new_item'          => __( 'Add New Service', 'paintingpixels' ),
		'add_new'               => __( 'Add New', 'paintingpixels' ),
		'new_item'              => __( 'New Service', 'paintingpixels' ),
		'edit_item'             => __( 'Edit Service', 'paintingpixels' ),
		'update_item'           => __( 'Update Service', 'paintingpixels' ),
		'view_item'             => __( 'View Service', 'paintingpixels' ),
		'search_items'          => __( 'Search Service', 'paintingpixels' ),
		'not_found'             => __( 'Not found', 'paintingpixels' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'paintingpixels' ),
		'featured_image'        => __( 'Featured Image', 'paintingpixels' ),
		'set_featured_image'    => __( 'Set featured image', 'paintingpixels' ),
		'remove_featured_image' => __( 'Remove featured image', 'paintingpixels' ),
		'use_featured_image'    => __( 'Use as featured image', 'paintingpixels' ),
		'insert_into_item'      => __( 'Insert into Service', 'paintingpixels' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Service', 'paintingpixels' ),
		'items_list'            => __( 'Items Service', 'paintingpixels' ),
		'items_list_navigation' => __( 'Items Service navigation', 'paintingpixels' ),
		'filter_items_list'     => __( 'Filter items Service', 'paintingpixels' ),
	);
	$args = array(
		'label'                 => __( 'Service', 'paintingpixels' ),
		'description'           => __( 'Services list', 'paintingpixels' ),
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
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true
	);
	register_post_type( 'services', $args );

}

add_action( 'init', 'custom_post_type_services', 0 );



class Services_Styling_Metabox {
	private $screen = array(
		'services',
	);
	private $meta_fields = array(
		array(
			'label' => 'Override default styling',
			'id' => 'override_default_styling',
			'type' => 'checkbox',
		),
		array(
			'label' => 'Background',
			'id' => 'card_background',
			'default' => '#fff',
			'type' => 'color',
		),
		array(
			'label' => 'Title colour',
			'id' => 'title_colour',
			'default' => '#fff',
			'type' => 'color',
		),
		array(
			'label' => 'Title background colour',
			'id' => 'title_background_colour',
			'default' => 'rgba(119, 119, 119, 0.9)',
			'type' => 'color',
		),
		array(
			'label' => 'Image background colour',
			'id' => 'image_background_colour',
			'default' => '#fff',
			'type' => 'color',
		),
		array(
			'label' => 'Text colour',
			'id' => 'text_colour',
			'default' => '#000',
			'type' => 'color',
		),
		array(
			'label' => 'Excerpt Background',
			'id' => 'excerpt_background',
			'default' => '#fff',
			'type' => 'color',
		),
	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts_styles')  );
		add_action( 'admin_footer', array( $this, 'color_field_js' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'servicesstyling',
				__( 'Services Styling', 'paintingpixels' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'normal',
				'high'
			);
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'servicesstyling_data', 'servicesstyling_nonce' );
		echo 'Override default styling for this post.';
		$this->field_generator( $post );
	}
	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
			if ( empty( $meta_value ) ) {
				$meta_value = $meta_field['default']; }
			switch ( $meta_field['type'] ) {
				case 'checkbox':
					$input = sprintf(
						'<input %s id=" % s" name="% s" type="checkbox" value="1">',
						$meta_value === '1' ? 'checked' : '',
						$meta_field['id'],
						$meta_field['id']
						);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}
	public function format_rows( $label, $input ) {
		return '<tr><th>'.$label.'</th><td>'.$input.'</td></tr>';
	}
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['servicesstyling_nonce'] ) )
			return $post_id;
		$nonce = $_POST['servicesstyling_nonce'];
		if ( !wp_verify_nonce( $nonce, 'servicesstyling_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}

	public function load_scripts_styles() {

		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wp-color-picker' );

	}

	public function color_field_js() {

		// Print js only once per page
		if ( did_action( 'Post_Colors_Metabox_color_picker_js' ) >= 1 ) {
			return;
		}

		?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				<?php foreach ( $this->meta_fields as $meta_field ) {
					echo "$('#" . $meta_field['id'] . "').wpColorPicker();";
				} ?>
			});
		</script>
		<?php
		do_action( 'Post_Colors_Metabox_color_picker_js', $this );

	}
}
if (class_exists('Services_Styling_Metabox')) {
	new Services_Styling_Metabox;
};