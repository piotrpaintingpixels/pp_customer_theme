<?php
/**
 * The default template for displaying grid content. Used for index/archive/search.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since Cornerstone 5.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-equalizer-watch>
	<?php the_post_thumbnail('thumbnail'); ?>

	<header class="entry-header">
		<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta-header">
				<?php do_action( 'cornerstone_entry_meta_header' ); ?>
			</div>
		<?php endif; ?>
	</header>

	<?php do_action( 'cornerstone_page_before_entry_content' ); ?>
	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div>
	<?php do_action( 'cornerstone_page_after_entry_content' ); ?>

	<footer class="entry-meta-footer">
		<?php if ( 'post' === get_post_type() ) :
			do_action( 'cornerstone_entry_meta_footer' );
		endif; ?>
	</footer>

</article>
