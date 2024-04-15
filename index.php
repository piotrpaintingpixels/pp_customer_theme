<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since Cornerstone 1.0
 */

get_header(); ?>

<div class="grid-container">
			<div class="grid-x grid-padding-x">
				<div class="cell">
<?php if (is_home() && get_option('page_for_posts') ) {
	$blog_home_id = get_option( 'page_for_posts' );
   echo '<img src="' . get_the_post_thumbnail_url($blog_home_id, 'full') . '"/>';
} ?>
</div>
			</div>
		</div>
<?php
/**
 * Get the blog layout (e.g 'classic', 'grid', 'cards')
 */
get_template_part( 'template-parts/loop', get_theme_mod('blog_layout', 'classic') );

get_footer();