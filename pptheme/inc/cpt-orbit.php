<?php
/**
 * Orbit Custom Post Type
 */

/**
 * Orbit
 *
 * Orbit is an easy, powerful, responsive image slider that allows users to
 * swipe on touch-enabled devices.
 *
 * Orbit has been deprecated, meaning that it is no longer supported.
 * There's no need to worry though as Zurb decided to leave it in Foundation.
 *
 * @link http://foundation.zurb.com/docs/components/orbit.html
 */

/**
 * Orbit custom post type
 */
add_action('init', 'Orbit');
if ( ! function_exists( 'Orbit' ) ) {
	function Orbit() {
		$Orbit_args = array(
			'label'	=> __('Orbit Slider'),
			'singular_label' =>	__('Orbit'),
			'public'	=>	true,
			'show_ui'	=>	true,
			'capability_type'	=>	'post',
			'hierarchical'	=>	false,
			'rewrite'	=>	true,
			'supports'	=>	array('title', 'editor','page-attributes','thumbnail','custom-fields'),
			'taxonomies' => array('category','post_tag')
			);
			register_post_type('orbit', $Orbit_args);
	}
}

/**
 * Meta box
 */
add_action( 'add_meta_boxes', 'orbit_meta_box_add' );
if ( ! function_exists( 'orbit_meta_box_add' ) ) {
	function orbit_meta_box_add() {
		add_meta_box( 'orbit-meta-box-id', 'Additional Orbit slider options', 'orbit_meta_box', 'Orbit', 'normal', 'high' );
	}
}

if ( ! function_exists( 'orbit_meta_box' ) ) {
	function orbit_meta_box( $post ) {
		$values = get_post_custom( $post->ID );
		$caption = isset( $values['_orbit_meta_box_caption_text'] ) ? esc_attr( $values['_orbit_meta_box_caption_text'][0] ) : '';
		$link = isset( $values['_orbit_meta_box_link_text'] ) ? esc_attr( $values['_orbit_meta_box_link_text'][0] ) : '';
		wp_nonce_field( 'orbit_meta_box_nonce', 'meta_box_nonce' );
		?>
		<p>
			<label for="_orbit_meta_box_caption_text">Caption</label>
			<textarea id="orbit_meta_box_caption_text" class="widefat" name="_orbit_meta_box_caption_text"><?php echo esc_attr( $caption ); ?></textarea>
		</p>
		<p>
			<label for="_orbit_meta_box_link_text">Link</label>
			<input type="text" id="orbit_meta_box_link_text" class="widefat" name="_orbit_meta_box_link_text" value="<?php echo $link; ?>" />
		</p>
		<?php
	}
}

add_action( 'save_post', 'orbit_meta_box_save' );
if ( ! function_exists( 'orbit_meta_box_save' ) ) {
	function orbit_meta_box_save( $post_id ) {
		// Bail if we're doing an auto save
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

		// if our nonce isn't there, or we can't verify it, bail
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'orbit_meta_box_nonce' ) ) return;

		// if our current user can't edit this post, bail
		if( !current_user_can( 'edit_post' ) ) return;

		// now we can actually save the data
		$allowed = array(
			'a' => array( // on allow a tags
				'href' => array() // and those anchords can only have href attribute
			)
		);

		// Probably a good idea to make sure your data is set
		if( isset( $_POST['_orbit_meta_box_caption_text'] ) )
			update_post_meta( $post_id, '_orbit_meta_box_caption_text', wp_kses( $_POST['_orbit_meta_box_caption_text'], $allowed ) );
		if( isset( $_POST['_orbit_meta_box_link_text'] ) )
			update_post_meta( $post_id, '_orbit_meta_box_link_text', wp_kses( $_POST['_orbit_meta_box_link_text'], $allowed ) );
	}
}

/**
 * Display Orbit Slider
 * Simple: <?php OrbitSlider(); ?>
 * Advanced: <?php OrbitSlider($orbitparam, $orbitsize); ?>
 * Advanced example: <?php OrbitSlider("animInFromLeft:fade-in; animInFromRight:fade-in; animOutToLeft:fade-out; animOutToRight:fade-out;", "large", "Aria label", true); ?>
 */
if ( ! function_exists( 'OrbitSlider' ) ) {
	function OrbitSlider($orbitparam = null, $orbitsize = null, $orbitaria = null, $motionui = null, $bullets = null, $post_type = null, $posts_per_page = null, $hide_title = null) {

		$args = array(
			'post_type' => (isset($post_type) ? $post_type : 'orbit'),
			'posts_per_page' => (isset($posts_per_page) ? $posts_per_page : '-1'),
			'no_found_rows' => true, // Optimize query for no paging
			'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
			);
		$loop = new WP_Query( $args );

		echo '<div class="orbit" role="region"' .
			(isset($orbitaria) ? ' aria-label="' . $orbitaria . '"' : '' ) .
			' data-orbit' . (isset($orbitparam) ? ' data-options="' . $orbitparam . '"' : '' ) .
			(isset($motionui) ? ' data-use-m-u-i="true"' : ' data-use-m-u-i="false"' ) .'>';

		?>
		<ul class="orbit-container">
		<button class="orbit-previous" aria-label="<?php _e('previous','cornerstone'); ?>"><span class="show-for-sr"><?php _e('Previous Slide','cornerstone'); ?></span>&#10094;</button>
    	<button class="orbit-next" aria-label="<?php _e('next','cornerstone'); ?>"><span class="show-for-sr"><?php _e('Next Slide','cornerstone'); ?></span>&#10095;</button>
    	<?php
    		global $post;
			while ( $loop->have_posts() ) : $loop->the_post();

				if(has_post_thumbnail()) {

					echo '<li class="' . ($loop->current_post == 0 && !is_paged() ? 'is-active ' : '' ) . 'orbit-slide">';
					$orbitlink = get_post_meta( $post->ID, '_orbit_meta_box_link_text', true );
					if(!empty($orbitlink)) {echo '<a href="' . $orbitlink . '">';}
					if(isset($orbitsize)) {
						the_post_thumbnail($orbitsize, array('class' => 'orbit-image'));
					} else {
						the_post_thumbnail('full', array('class' => 'orbit-image'));
					}
					$orbitcaption = get_post_meta( $post->ID, '_orbit_meta_box_caption_text', true );
					if(!empty($orbitcaption)) {echo '<figcaption class="orbit-caption">' . $orbitcaption . '</figcaption>';}
					if(!empty($orbitlink)) {echo '</a>';}
					echo '</li>';

				} else {

					echo '<li class="orbit-slide">';
					echo ($hide_title ? '' : '<h3>' . get_the_title() . '</h3>');
					the_content();
					echo '</li>';

				}

			endwhile;

		echo '</ul>';
		if($bullets == 'true') {
			rewind_posts();
			echo '<nav class="orbit-bullets">';
				while ( $loop->have_posts() ) : $loop->the_post();
					echo '<button class="' . ($loop->current_post == 0 && !is_paged() ? 'is-active ' : '' ) . '" data-slide="' . $loop->current_post .'"><span class="show-for-sr">slide' . $loop->current_post . 'details.</span></button>';
				endwhile; // End the loop
			echo '</nav>';
		}
		wp_reset_query();
		echo '</div>';
	}
}

/**
 * Orbit shortcode
 * Example usage: [orbitslider orbitparam="animInFromLeft:fade-in; animInFromRight:fade-in; animOutToLeft:fade-out; animOutToRight:fade-out;" orbitsize="medium" orbitaria="Orbit image slider" motionui=true]
 */
function orbitslider_shortcode( $atts ) {
	$args = shortcode_atts(
		array(
			'orbitparam' => null,
			'orbitsize' => null,
			'orbitaria' => null,
			'motionui' => 'false',
			'bullets' => 'false',
			'post_type' => null,
			'posts_per_page' => null,
			'hide_title' => 'false'
		), $atts,
		'orbitslider'
	);
	$args['motionui'] = filter_var( $args['motionui'], FILTER_VALIDATE_BOOLEAN );
	$args['bullets'] = filter_var( $args['bullets'], FILTER_VALIDATE_BOOLEAN );
	$args['hide_title'] = filter_var( $args['hide_title'], FILTER_VALIDATE_BOOLEAN );
	return OrbitSlider($atts['orbitparam'], $atts['orbitsize'], $atts['orbitaria'], $atts['motionui'], $atts['bullets'], $atts['post_type'], $atts['posts_per_page'], $atts['hide_title']);
}
add_shortcode( 'orbitslider', 'orbitslider_shortcode' );