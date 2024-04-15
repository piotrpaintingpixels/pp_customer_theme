<?php
/**
 * Shortcodes
 */

/**
 * [cpt_display_shortcode description]
 * @param  [type] $atts [description]
 * @return [type]       [description]
 */
function cpt_display_shortcode( $atts ) {
	// normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
	$args = shortcode_atts(
		array(
			'post_type' => null,
			'posts_per_page' => null,
			'loop_wrap_tag' => null,
			'loop_wrap_class' => null,
			'post_wrap_tag' => null,
			'post_wrap_class' => null,
			'show_title' => 'true',
			'title_tag' => null,
			'the_content' => 'true',
			'image' => null,
			'image_position' => null
		), $atts,
		'displayposts'
	);

	$post_type = $atts['post_type'];
	$loop_wrap_tag = $atts['loop_wrap_tag'];
	$loop_wrap_class = $atts['loop_wrap_class'];
	$post_wrap_tag = $atts['post_wrap_tag'];
	$post_wrap_class = $atts['post_wrap_class'];
	$show_title = filter_var( $args['show_title'], FILTER_VALIDATE_BOOLEAN );
	$title_tag = $atts['title_tag'];
	//$the_content = filter_var( $args['the_content'], FILTER_VALIDATE_BOOLEAN );
	$the_content = $args['the_content'];
	$image = filter_var( $args['image'], FILTER_VALIDATE_BOOLEAN );
	$image_position = $atts['image_position'];

	$output .= (empty($loop_wrap_tag)) ? '' : '<' . $loop_wrap_tag . ((empty($loop_wrap_class)) ? '' : ' class="' . $loop_wrap_class . '"') . '>';

	$loopArgs = array(
		'post_type' => (empty($post_type)) ? null : $post_type,
		'posts_per_page' => (empty($atts['posts_per_page'])) ? '-1' : $atts['posts_per_page'],
		'no_found_rows' => true, // counts posts, remove if pagination required
		'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
		'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
		);
	$loop = new WP_Query($loopArgs);
	while ($loop->have_posts()) : $loop->the_post();
		$thumbnail = (!empty($image)) ? '' : get_the_post_thumbnail($post->ID, $image);
		$output .= (empty($post_wrap_tag)) ? '' : '<' . $post_wrap_tag . ((empty($post_wrap_class)) ? '' : ' class="' . $post_wrap_class . '"') . '>';
		$output .= ($image_position == "above_title") ? $thumbnail : '';
		$output .= ($show_title ? (empty($title_tag) ? '' : '<' . $title_tag . '>') . get_the_title() . (empty($title_tag) ? '' : '</' . $title_tag . '>') : '');

		$output .= ($image_position == "below_title") ? $thumbnail : '';
		$output .= ($the_content == 'true') ? get_the_content() : '';
		$output .= ($the_content == 'excerpt') ? get_the_excerpt() : '';
		$output .= ($image_position == "below_content") ? $thumbnail : '';
		$output .= (empty($post_wrap_tag)) ? '' : '</' . $post_wrap_tag . '>';
	endwhile; wp_reset_query(); // End the loop

	$output .= (empty($loop_wrap_tag)) ? '' : '</' . $loop_wrap_tag . '>';

	return $output;
}
add_shortcode( 'displayposts', 'cpt_display_shortcode' );


/**
 * [cpt_testimonial_shortcode description]
 * @param  [type] $atts [description]
 * @return [type]       [description]
 */
function cpt_testimonial_shortcode( $atts ) {
	// normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
	$args = shortcode_atts(
		array(
			'posts_per_page' => null,
			'loop_wrap_tag' => null,
			'loop_wrap_class' => null,
			'post_wrap_tag' => null,
			'post_wrap_class' => null,
			'the_content' => 'true',
			'grid' => 'true',
			'post_order' => null
		), $atts,
		'testimonials'
	);

	$loop_wrap_tag = $args['loop_wrap_tag'];
	$loop_wrap_class = $args['loop_wrap_class'];
	$post_wrap_tag = $args['post_wrap_tag'];
	$post_wrap_class = $args['post_wrap_class'];
	$show_title = filter_var( $args['show_title'], FILTER_VALIDATE_BOOLEAN );
	$title_tag = $args['title_tag'];
	$the_content = $args['the_content'];
	$grid = $args['grid'];
	$image = filter_var( $args['image'], FILTER_VALIDATE_BOOLEAN );
	$image_position = $atts['image_position'];

	$output .= (empty($loop_wrap_tag)) ? '' : '<' . $loop_wrap_tag . ((empty($loop_wrap_class)) ? '' : ' class="' . $loop_wrap_class . '"') . '>';

	$loopArgs = array(
		'post_type' => 'testimonials',
		'posts_per_page' => (empty($atts['posts_per_page'])) ? '-1' : $atts['posts_per_page'],
		'no_found_rows' => true, // counts posts, remove if pagination required
		'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
		'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
		);
	$loop = new WP_Query($loopArgs);
	$output .= '<div class="testimonials">';
	$output .= ($grid == 'true') ? '<div class="grid-x grid-padding-x grid-padding-y small-up-1 medium-up-2">' : '';
	while ($loop->have_posts()) : $loop->the_post();
		$output .= ($grid == 'true') ? '<div class="cell">' : '';
		$output .= (empty($post_wrap_tag)) ? '' : '<' . $post_wrap_tag . ((empty($post_wrap_class)) ? '' : ' class="' . $post_wrap_class . '"') . '>';
		$output .= '<blockquote>';
		$output .= ($the_content == 'true') ? get_the_content() : '';
		$output .= ($the_content == 'excerpt') ? get_the_excerpt() : '';
		$output .= '</blockquote>';
		$output .= (empty($post_wrap_tag)) ? '' : '</' . $post_wrap_tag . '>';
		$output .= ($grid == 'true') ? '</div>' : '';
	endwhile; wp_reset_query(); // End the loop

	$output .= ($grid == 'true') ? '</div>' : '';
	$output .= '</div>';

	$output .= (empty($loop_wrap_tag)) ? '' : '</' . $loop_wrap_tag . '>';

	return $output;
}
if ( true == get_theme_mod( 'cpt_testimonials', true ) ) {
	add_shortcode( 'testimonials', 'cpt_testimonial_shortcode' );
}



function cpt_teammembers_shortcode( $atts ) {
	// normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
	$args = shortcode_atts(
		array(
			'posts_per_page' => null,
			'loop_wrap_tag' => null,
			'loop_wrap_class' => null,
			'post_wrap_tag' => null,
			'post_wrap_class' => null,
			'show_title' => 'true',
			'title_tag' => 'h3',
			'the_content' => 'true',
			'grid' => 'true',
			'post_order' => null,
			'link_to_full' => 'false',
		), $atts,
		'teammembers'
	);

	$loop_wrap_tag = $args['loop_wrap_tag'];
	$loop_wrap_class = $args['loop_wrap_class'];
	$post_wrap_tag = $args['post_wrap_tag'];
	$post_wrap_class = $args['post_wrap_class'];
	$show_title = filter_var( $args['show_title'], FILTER_VALIDATE_BOOLEAN );
	$title_tag = $args['title_tag'];
	$the_content = $args['the_content'];
	$grid = $args['grid'];
	$link_to_full = $args['link_to_full'];

	global $post;
	$output = "";

	$output .= (empty($loop_wrap_tag)) ? '' : '<' . $loop_wrap_tag . ((empty($loop_wrap_class)) ? '' : ' class="' . $loop_wrap_class . '"') . '>';

	$loopArgs = array(
		'post_type' => 'team_member',
		'posts_per_page' => (empty($atts['posts_per_page'])) ? '-1' : $atts['posts_per_page'],
		'no_found_rows' => true, // counts posts, remove if pagination required
		'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
		'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
		);
	$loop = new WP_Query($loopArgs);
	$output .= '<div class="teammembers">';
	$output .= ($grid == 'true') ? '<div class="grid-x grid-padding-x grid-padding-y small-up-1 medium-up-2 large-up-4">' : '';
	while ($loop->have_posts()) : $loop->the_post();
		$job_title = team_member_details_get_meta( 'team_member_details_job_title' );
		$facebook = team_member_details_get_meta( 'team_member_details_facebook' );
		$twitter = team_member_details_get_meta( 'team_member_details_twitter' );
		$linkedin = team_member_details_get_meta( 'team_member_details_linkedin' );

		$output .= ($grid == 'true') ? '<div class="cell">' : '';
		$output .= (empty($post_wrap_tag)) ? '' : '<' . $post_wrap_tag . ((empty($post_wrap_class)) ? '' : ' class="' . $post_wrap_class . '"') . '>';

		/* Thumbnail */
		$output .= ($link_to_full == 'true') ? '<a href="' . get_permalink( $post, false ) . '">' : '';
		$output .= get_the_post_thumbnail($post->ID, 'teammember_thumbnail');
		$output .= ($link_to_full == 'true') ? '</a>' : '';
		/* Name and job title */
		$output .= (empty($title_tag)) ? '' : '<' . $title_tag . ' class="teammember-name">';
		$output .= ($link_to_full == 'true') ? '<a href="' . get_permalink( $post, false ) . '">' : '';
		$output .= get_the_title();
		$output .= ($link_to_full == 'true') ? '</a>' : '';
		$output .= '<br/>';
		$output .= (empty($job_title)) ? '' : '<small class="teammember-jobtitle">' . $job_title . '</small>';
		$output .= (empty($title_tag)) ? '' : '</' . $title_tag . '>';

		/* Social media */
		if ( (!empty($facebook)) || (!empty($twitter)) || (!empty($linkedin)) ) :
			$output .= '<p>';
			$output .= (empty($facebook)) ? '' : '<span class="teammember-facebook"><a href="' . $facebook . '"><i class="fa fa-facebook"> </i></a></span>&nbsp;';
			$output .= (empty($twitter)) ? '' : '<span class="teammember-twitter"><a href="' . $twitter . '"><i class="fa fa-twitter"> </i></a></span>&nbsp;';
			$output .= (empty($linkedin)) ? '' : '<span class="teammember-linkedin"><a href="' . $linkedin . '"><i class="fa fa-linkedin"> </i></a></span>';
			$output .= '</p>';
		endif;

		$output .= ($the_content == 'true') ? get_the_content() : '';
		$output .= ($the_content == 'excerpt') ? get_the_excerpt() : '';
		$output .= (empty($post_wrap_tag)) ? '' : '</' . $post_wrap_tag . '>';
		$output .= ($grid == 'true') ? '</div>' : '';
	endwhile; wp_reset_query(); // End the loop

	$output .= ($grid == 'true') ? '</div>' : '';
	$output .= '</div>';

	$output .= (empty($loop_wrap_tag)) ? '' : '</' . $loop_wrap_tag . '>';

	return $output;
}
if ( true == get_theme_mod( 'cpt_team', true ) ) {
	add_shortcode( 'teammembers', 'cpt_teammembers_shortcode' );
}