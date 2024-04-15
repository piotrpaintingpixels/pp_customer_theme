<?php
/**
 * The default template for displaying card content. Used for index/archive/search.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since Cornerstone 5.0.0
 */


$post_classes[] = 'card';

$blog_layout_card_style = get_theme_mod('blog_layout_card_style', 'material');
if ( $blog_layout_card_style == 'material' ) {
	$post_classes[] = 'card-material';
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?> data-equalizer-watch="cards">
	<?php if ( has_post_thumbnail( get_the_ID() ) ) : ?>
		<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
	<?php endif; ?>

	<div class="card-section">
		<header class="entry-header">
			<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
			<div class="entry-meta-header">
				<?php do_action( 'cornerstone_entry_meta_header' ); ?>
			</div>
		</header>

		<?php do_action( 'cornerstone_page_before_entry_content' ); ?>
		<div class="entry-content">
			<?php echo wp_trim_words(get_the_excerpt(), get_theme_mod( 'blog_layout_excerpt_words', 20 ), null); ?>
		</div>
		<?php do_action( 'cornerstone_page_after_entry_content' ); ?>

		<footer class="entry-meta-footer">
			<?php do_action( 'cornerstone_entry_meta_footer' ); ?>
		</footer>
	</div>

</article>
