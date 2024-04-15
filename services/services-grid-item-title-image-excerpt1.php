<?php
/**
 * The default template for displaying service grid content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage PPTheme
 */
?>

<div class="cell">
	<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'grid-x', 'grid-padding-x', 'grid-padding-y', 'service-wrapper', 'service-style-title-image-excerpt1' ), null ); ?> >
		<div class="small-12 medium-12 cell service-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</div>
		<div class="small-12 medium-12 cell service-image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="image featured">
				<?php the_post_thumbnail('services_thumbnail'); ?>
			</a>
		</div>
		<div class="small-12 cell service-excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
</div>
