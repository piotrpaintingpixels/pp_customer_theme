<?php
/**
 * The default template for displaying service grid content.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage PPTheme
 */

$override_default_styling = get_post_meta( get_the_ID(), 'override_default_styling', false );
if ( $override_default_styling[0] ) {
	$card_background = 'background: ' . sanitize_hex_color( get_post_meta( get_the_id(), 'card_background', true ) ) . ';';
	$title_colour = 'color: ' . sanitize_hex_color( get_post_meta( get_the_id(), 'title_colour', true ) ) . ';';
	$title_background_colour = 'background: ' . sanitize_hex_color( get_post_meta( get_the_id(), 'title_background_colour', true ) ) . ';';
	$image_background_colour = sanitize_hex_color( get_post_meta( get_the_id(), 'image_background_colour', true ) );
	$text_colour = sanitize_hex_color( get_post_meta( get_the_id(), 'text_colour', true ) );
}
?>

<div class="cell">
	<div id="post-<?php the_ID(); ?>" <?php post_class( array( 'service-wrapper', 'service-style-title-image-excerpt2' ), null ); ?> style="<?php echo $card_background; ?>">
		<div class="service-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" style="<?php echo $title_background_colour . $title_colour; ?>"><?php the_title(); ?>
				<hr style="width: 90%; margin-left: -2.5rem; margin-top: 0; margin-bottom: 0; border-bottom: 1px solid #fff;">
			</a>
		</div>
		<div class="service-image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="image featured">
				<?php the_post_thumbnail('services_thumbnail'); ?>
			</a>
		</div>
		<div class="service-excerpt">
			<?php the_excerpt(); ?>
		</div>
	</div>
</div>
