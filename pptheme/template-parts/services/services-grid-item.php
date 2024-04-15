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
	<div class="grid-x grid-padding-x service-wrapper">
		<div class="small-4 medium-12 cell">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="image featured">
				<?php the_post_thumbnail('services_thumbnail'); ?>
			</a>
		</div>
		<div class="small-8 medium-12 cell service-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</div>
	</div>
</div>
