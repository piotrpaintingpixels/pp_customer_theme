<?php
/**
 * The default template for displaying blog layout.
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since Cornerstone 4.2.4.1
 */
?>

<div class="grid-x grid-padding-x grid-padding-y small-up-<?php echo get_theme_mod( 'homepage_blog_posts_per_line_mobile', '1'); ?> medium-up-<?php echo get_theme_mod( 'homepage_blog_posts_per_line_tablet', '2'); ?> large-up-<?php echo get_theme_mod( 'homepage_blog_posts_per_line_desktop', '3'); ?>" data-equalizer data-equalize-on="medium">
	<?php $wp_query_args = array(
		'posts_per_page' => get_theme_mod( 'homepage_blog_posts_no', '6' ),
		'post__not_in' => get_option('sticky_posts'),
		'no_found_rows' => true, // counts posts, remove if pagination required
		'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
		'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
		);
	$wp_query_loop = new WP_Query($wp_query_args);?>
	<?php while ( $wp_query_loop->have_posts() ) : $wp_query_loop->the_post(); ?>
	<div class="cell">
		<?php get_template_part( 'template-parts/' . get_theme_mod('home_blog_layout', 'grid') . '/content', get_post_format() ); ?>
	</div>
	<?php endwhile; wp_reset_query(); // End the loop ?>
</div>
<div class="grid-x grid-padding-x">
	<div class="auto cell">
		<a href="blog" class="button radius more">View more blog posts</a>
	</div>
</div>
