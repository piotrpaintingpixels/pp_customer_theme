<?php
/**
 * Advanced Menu Widget
 */

if ( ! class_exists( 'advanced_menu_widget' ) ) {

	// Load the widget
	add_action( 'widgets_init', 'load_advanced_menu_widget' );

	// Register the widget
	function load_advanced_menu_widget() {
		register_widget( 'advanced_menu_widget' );
	}

	/**
	 * advanced Menu Widget class
	 */
	class advanced_menu_widget extends WP_Widget {

		function __construct() {
			load_plugin_textdomain( 'advanced-menu-widget', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
			$widget_ops  = array(
				'classname'   => 'advanced-menu-widget',
				'description' => __( 'Add one of your custom menus as a widget.', 'paintingpixels' )
			);
			$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'advanced-menu-widget' );
			parent::__construct( 'advanced-menu-widget', __( 'Advanced Custom Menu', 'advanced-menu-widget' ), $widget_ops, $control_ops );
		}

		/**
		 *
		 * Widget display.
		 *
		 * Display widget on front-end.
		 *
		 * @param array $args
		 * @param array $instance
		 *
		 */

		public function widget( $args, $instance ) {
			$nav_menu = wp_get_nav_menu_object( $instance['nav_menu'] );

			if ( ! $nav_menu ) {
				return;
			}

			$instance['title'] = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

			echo $args['before_widget'];

			if ( ! empty( $instance['title'] ) && ! empty( $instance['title_url'] ) ) {
				echo $args['before_title'] . '<a href="' . esc_url( $instance['title_url'] ) . '">' . esc_html( $instance['title'] ) . '</a>' . $args['after_title'];
			}

			if ( ! empty( $instance['title'] ) && empty( $instance['title_url'] ) ) {
				echo $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title'];
			}

			$nav_menu_attr = '';

			if ( ! empty( $instance['menu_attr'] ) ) {
				$nav_menu_attr = ' ' . esc_html( $instance['menu_attr'] );
			}

			wp_nav_menu( array(
				'fallback_cb' => '',
				'menu'        => $nav_menu,
				'menu_class'  => esc_attr( $instance['menu_class'] ),
				'container'   => false,
				'items_wrap'  => '<ul class="%2$s"' . $nav_menu_attr . '>%3$s</ul>',
			) );

			echo $args['after_widget'];
		}

		/**
		 *
		 * Update options.
		 *
		 * Update widget options.
		 *
		 * @param array $new_instance
		 * @param array $old_instance
		 *
		 * @return mixed
		 *
		 */

		public function update( $new_instance, $old_instance ) {
			$instance['title']      = sanitize_text_field( $new_instance['title'] );
			$instance['nav_menu']   = (int) $new_instance['nav_menu'];
			$instance['title_url']  = esc_html( $new_instance['title_url'] );
			$instance['menu_class'] = $this->update_classes( $new_instance );
			$instance['menu_attr']  = sanitize_text_field( $new_instance['menu_attr'] );

			return $instance;
		}

		/**
		 *
		 * Update classes.
		 *
		 * Update menu classes and sanitizes them.
		 *
		 * @param $new_instance
		 *
		 * @return string
		 *
		 */

		public function update_classes( $new_instance ) {
			$output  = '';
			$classes = explode( " ", preg_replace( '/\s\s+/', ' ', $new_instance['menu_class'] ) );
			foreach ( $classes as $class ) {
				$output .= sanitize_html_class( $class ) . ' ';
			}
			// In some cases an extra space can occur if a bad style is stripped out by sanitize_html_class
			$output                 = trim( preg_replace( '/\s\s+/', ' ', $output ), ' ' );
			$instance['menu_class'] = $output;

			return $output;
		}

		/**
		 *
		 * Admin form.
		 *
		 * Create widget admin form.
		 *
		 * @param array $instance
		 *
		 * @return mixed
		 */

		public function form( $instance ) {
			$title      = isset( $instance['title'] ) ? $instance['title'] : '';
			$nav_menu   = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
			$title_url  = isset( $instance['title_url'] ) ? $instance['title_url'] : '';
			$menu_class = isset( $instance['menu_class'] ) ? $instance['menu_class'] : 'menu vertical';
			$menu_attr = isset( $instance['menu_attr'] ) ? $instance['menu_attr'] : '';

			// Get menus list
			$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

			// If no menu exists, direct the user to create some.
			if ( ! $menus ) {
				echo '<p>' . sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.', 'paintingpixels' ), admin_url( 'nav-menus.php' ) ) . '</p>';

				return;
			}

			?>

			<p><label
					for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'paintingpixels' ) ?></label><input
					type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
					name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_html( $title ); ?>"/>
			</p>
			<p><label
					for="<?php echo $this->get_field_id( 'title_url' ); ?>"><?php _e( 'Title URL:', 'paintingpixels' ) ?></label><input
					type="text" class="widefat" id="<?php echo $this->get_field_id( 'title_url' ); ?>"
					name="<?php echo $this->get_field_name( 'title_url' ); ?>"
					value="<?php echo esc_url( $title_url ); ?>"/></p>
			<p><label
					for="<?php echo $this->get_field_id( 'nav_menu' ); ?>"><?php _e( 'Select Menu:', 'paintingpixels' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'nav_menu' ); ?>"
				        name="<?php echo $this->get_field_name( 'nav_menu' ); ?>">
					<?php
					foreach ( $menus as $menu ) {
						$selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
						echo '<option' . $selected . ' value="' . $menu->term_id . '">' . $menu->name . '</option>';
					}
					?>
				</select></p>
			<p><label
					for="<?php echo $this->get_field_id( 'menu_class' ); ?>"><?php _e( 'Menu Classes:', 'paintingpixels' ) ?></label><input
					type="text" class="widefat" id="<?php echo $this->get_field_id( 'menu_class' ); ?>"
					name="<?php echo $this->get_field_name( 'menu_class' ); ?>"
					value="<?php echo esc_attr( $menu_class ); ?>"/>
				<small><?php _e( 'CSS classes to use for the ul menu element. Separate classes by a space.', 'paintingpixels' ); ?></small>
			</p>
			<p><label
					for="<?php echo $this->get_field_id( 'menu_attr' ); ?>"><?php _e( 'Menu Attributes:', 'paintingpixels' ) ?></label><input
					type="text" class="widefat" id="<?php echo $this->get_field_id( 'menu_attr' ); ?>"
					name="<?php echo $this->get_field_name( 'menu_attr' ); ?>"
					value="<?php echo esc_attr( $menu_attr ); ?>"/>
				<small><?php _e( 'Attributes to use for the ul menu element. Separate attributes by a space.', 'paintingpixels' ); ?></small>
			</p>

			<?php
		}

	}

}
?>