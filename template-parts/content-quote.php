<?php
/**
 * The template for displaying posts in the Quote post format.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since Cornerstone 2.2.2
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'cornerstone_page_before_entry_content' ); ?>
	<div class="entry-content">
		<?php the_content( sprintf(
				/* translators: %s: Name of current post. */
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'cornerstone' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) ); ?>
	</div>
	<?php do_action( 'cornerstone_page_after_entry_content' ); ?>

	<footer class="entry-meta-footer">
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'cornerstone' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo get_the_date(); ?></a>
		<?php if ( comments_open() ) : ?>
		<div class="comments-link">
			<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'cornerstone' ) . '</span>', __( '1 Reply', 'cornerstone' ), __( '% Replies', 'cornerstone' ) ); ?>
		</div>
		<?php endif; // comments_open() ?>
		<?php edit_post_link( __( 'Edit', 'cornerstone' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>
</article>