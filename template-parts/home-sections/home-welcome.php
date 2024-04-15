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

		<?php while ( have_posts() ) : the_post();

			the_content();

		endwhile; wp_reset_query(); ?>

	</div>
</div>