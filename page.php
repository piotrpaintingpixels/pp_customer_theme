<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since Cornerstone 1.0
 */

get_header();

get_template_part( 'template-parts/banner-image' ); ?>

<div class="grid-container">
	<div class="grid-x grid-padding-x">
		<div id="primary" class="site-content cell">
			<main id="content">

				<?php while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; ?>

			</main>
		</div>

	</div>
</div>

<?php get_footer(); ?>