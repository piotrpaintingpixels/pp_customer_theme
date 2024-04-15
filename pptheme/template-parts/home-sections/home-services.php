<?php
/**
 * The default template for displaying blog layout.
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since Cornerstone 4.2.4.1
 */
?>

<div class="grid-x grid-padding-x grid-padding-y small-up-<?php echo get_theme_mod( 'homepage_services_per_line_mobile', '1'); ?> medium-up-<?php echo get_theme_mod( 'homepage_services_per_line_tablet', '2'); ?> large-up-<?php echo get_theme_mod( 'homepage_services_per_line_desktop', '4'); ?> services-grid" data-equalizer="services" data-equalize-on="medium">
	<?php $wp_query_args = array(
		'post_type'=>'services',
		'posts_per_page' => get_theme_mod( 'homepage_services_no', '4' ),
		'post__not_in' => get_option('sticky_posts'),
		'no_found_rows' => true, // counts posts, remove if pagination required
		'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
		'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
		);
	$wp_query_loop = new WP_Query($wp_query_args);
	while ( $wp_query_loop->have_posts() ) : $wp_query_loop->the_post();
		get_template_part( 'template-parts/services/services-grid-item', get_theme_mod( 'services_layout', 'title-overlay-image' ) );
	endwhile; wp_reset_query(); // End the loop ?>
</div>