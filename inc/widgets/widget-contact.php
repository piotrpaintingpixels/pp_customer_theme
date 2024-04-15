<?php
/**
 * Recent_Posts_With_Thumbs widget class
 */

// Load the widget
add_action( 'widgets_init', 'load_widget_contact' );

// Register the widget
function load_widget_contact() {
	register_widget( 'paintingpixels_widget_contact' );
}

class paintingpixels_widget_contact extends WP_Widget {

	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'paintingpixels_widget_contact',

			// Widget name will appear in UI
			__('Contact Details Widget', 'paintingpixels'),

			// Widget description
			array( 'description' => __( 'Company name, tel, email', 'paintingpixels' ), )
			);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$telephone = apply_filters( 'widget_title', $instance['telephone'] );
		$email = apply_filters( 'widget_title', $instance['email'] );
		$streetAddress = apply_filters( 'widget_title', $instance['streetAddress'] );
		$addressLocality = apply_filters( 'widget_title', $instance['addressLocality'] );
		$addressRegion = apply_filters( 'widget_title', $instance['addressRegion'] );
		$postCode = apply_filters( 'widget_title', $instance['postCode'] );
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		// This is where you run the code and display the output
		echo __( '<div itemscope itemtype="http://schema.org/LocalBusiness">', 'paintingpixels' );
		echo (empty($telephone) ? '' : '<span itemprop="telephone"><a href="tel:' .$telephone . '">' . $telephone . '</a></span><br/>' );
		echo (empty($email) ? '' : '<span itemprop="email"><a href="mailto:' . $email . '">' . $email . '</a></span><br/>' );
		echo __( '</div>', 'paintingpixels' );

		echo __( '<div itemscope itemtype="http://schema.org/LocalBusiness">', 'paintingpixels' );
		echo __( '<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">', 'paintingpixels' );
		echo (empty($streetAddress) ? '' : '<span itemprop="streetAddress">' . $streetAddress . '</span>, ' );
		echo (empty($addressLocality) ? '' : '<span itemprop="addressLocality">' . $addressLocality . '</span>, ' );
		echo (empty($addressRegion) ? '' : '<span itemprop="addressRegion">' . $addressRegion . '</span>' );
		echo (empty($postCode) ? '' : ', <span itemprop="postalCode">' . $postCode . '</span>' );
		echo __( '</div>', 'paintingpixels' );
		echo __( '</div>', 'paintingpixels' );
		echo $args['after_widget'];

	}

	// Widget Backend
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
			$telephone = $instance[ 'telephone' ];
			$email = $instance[ 'email' ];
			$streetAddress = $instance[ 'streetAddress' ];
			$addressLocality = $instance[ 'addressLocality' ];
			$addressRegion = $instance[ 'addressRegion' ];
			$postCode = $instance[ 'postCode' ];
		}
		else {
			$title = __( '', 'paintingpixels' );
			$telephone = __( '', 'paintingpixels' );
			$email = __( '', 'paintingpixels' );
			$streetAddress = __( '', 'paintingpixels' );
			$addressLocality = __( '', 'paintingpixels' );
			$addressRegion = __( '', 'paintingpixels' );
			$postCode = __( '', 'paintingpixels' );
		}
		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'telephone' ); ?>"><?php _e( 'Telephone:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'telephone' ); ?>" name="<?php echo $this->get_field_name( 'telephone' ); ?>" type="text" value="<?php echo esc_attr( $telephone ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_url( $email, 'mailto' ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'streetAddress' ); ?>"><?php _e( 'Street:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'streetAddress' ); ?>" name="<?php echo $this->get_field_name( 'streetAddress' ); ?>" type="text" value="<?php echo esc_attr( $streetAddress ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'addressLocality' ); ?>"><?php _e( 'Town/City:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'addressLocality' ); ?>" name="<?php echo $this->get_field_name( 'addressLocality' ); ?>" type="text" value="<?php echo esc_attr( $addressLocality ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'addressRegion' ); ?>"><?php _e( 'County:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'addressRegion' ); ?>" name="<?php echo $this->get_field_name( 'addressRegion' ); ?>" type="text" value="<?php echo esc_attr( $addressRegion ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'postCode' ); ?>"><?php _e( 'Post Code:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'postCode' ); ?>" name="<?php echo $this->get_field_name( 'postCode' ); ?>" type="text" value="<?php echo esc_attr( $postCode ); ?>" />
		</p>
		<?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['telephone'] = ( ! empty( $new_instance['telephone'] ) ) ? strip_tags( $new_instance['telephone'] ) : '';
		$instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
		$instance['streetAddress'] = ( ! empty( $new_instance['streetAddress'] ) ) ? strip_tags( $new_instance['streetAddress'] ) : '';
		$instance['addressLocality'] = ( ! empty( $new_instance['addressLocality'] ) ) ? strip_tags( $new_instance['addressLocality'] ) : '';
		$instance['addressRegion'] = ( ! empty( $new_instance['addressRegion'] ) ) ? strip_tags( $new_instance['addressRegion'] ) : '';
		$instance['postCode'] = ( ! empty( $new_instance['postCode'] ) ) ? strip_tags( $new_instance['postCode'] ) : '';
		return $instance;
	}
} // Class paintingpixels ends here
register_widget('WP_Widget_Recent_Posts_With_Thumbs');