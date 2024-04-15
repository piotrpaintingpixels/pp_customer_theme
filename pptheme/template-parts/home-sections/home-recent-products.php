<?php
/**
 * The default template for displaying blog layout.
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since Cornerstone 4.2.4.1
 */
?>

<div class="grid-x grid-padding-x grid-padding-y">
	<div class="cell">
		<?php if ( class_exists( 'woocommerce' ) ) {
			echo do_shortcode( '[recent_products]', false );
		} ?>
	</div>
</div>