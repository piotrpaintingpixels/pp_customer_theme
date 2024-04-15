<?php
/**
 * The template for displaying Tag pages.
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since Cornerstone 3.0.0
 */

get_header();

/**
 * Get the blog layout (e.g 'classic', 'grid', 'cards')
 */
get_template_part( 'template-parts/loop', get_theme_mod('blog_layout', 'classic') );

get_footer();