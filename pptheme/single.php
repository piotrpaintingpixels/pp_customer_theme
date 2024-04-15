<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since Cornerstone 1.0
 */

get_header();

get_template_part( 'template-parts/banner-image' ); ?>

<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div id="primary" class="auto cell site-content">
			<main id="content">

				<?php while (have_posts()) : the_post();

					get_template_part( 'template-parts/content', get_post_format() );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; ?>

			</main>
		</div>

		<?php get_sidebar(); ?>

	</div>
</div>

<?php get_footer(); ?>