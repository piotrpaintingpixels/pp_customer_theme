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

			<?php do_action( 'cornerstone_before_content' );

				while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<header class="entry-header">
							<?php $job_title = team_member_details_get_meta( 'team_member_details_job_title' );
							the_title( '<h1 class="entry-title">', ((!empty($job_title)) ? '<br/><small>' . $job_title . '</small></h1>' : '') . '</h1>' ); ?>
						</header>

						<?php do_action( 'cornerstone_page_before_entry_content' ); ?>
						<div class="entry-content">
							<?php
								$facebook = team_member_details_get_meta( 'team_member_details_facebook' );
								$twitter = team_member_details_get_meta( 'team_member_details_twitter' );
								$linkedin = team_member_details_get_meta( 'team_member_details_linkedin' );

								if ( (!empty($facebook)) || (!empty($twitter)) || (!empty($linkedin)) ) :
									echo '<p>';
									echo (empty($facebook)) ? '' : '<span class="teammember-facebook"><a href="' . $facebook . '"><i class="fa fa-facebook"> </i></a></span>&nbsp;';
									echo (empty($twitter)) ? '' : '<span class="teammember-twitter"><a href="' . $twitter . '"><i class="fa fa-twitter"> </i></a></span>&nbsp;';
									echo (empty($linkedin)) ? '' : '<span class="teammember-linkedin"><a href="' . $linkedin . '"><i class="fa fa-linkedin"> </i></a></span>';
									echo '</p>';
								endif;
							the_content(); ?>
						</div>
						<?php do_action( 'cornerstone_page_after_entry_content' ); ?>

						<?php if ( get_edit_post_link() ) : ?>
							<footer class="entry-meta-footer">
								<?php edit_post_link(
										sprintf(
											/* translators: %s: Name of current post */
											esc_html__( 'Edit %s', 'cornerstone' ),
											the_title( '<span class="screen-reader-text">"', '"</span>', false )
										),
										'<span class="edit-link">',
										'</span>'
									); ?>
							</footer>
						<?php endif; ?>

					</article>

				<?php endwhile;

				do_action( 'cornerstone_after_content' ); ?>

			</main>
		</div>

	</div>
</div>

<?php get_footer(); ?>