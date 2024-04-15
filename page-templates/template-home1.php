<?php
/**
 * Template Name: Home 1
 *
 * Description: Home 1
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since Cornerstone 1.0
 */

get_header(); ?>

<section id="slider">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell">
				<?php if ( function_exists( 'OrbitSlider' ) ) { OrbitSlider(null, 'orbit', null, true); } ?>
			</div>
		</div>
	</div>
</section>


<?php if ( class_exists( 'Kirki' ) ) {
	$homepage_sections = get_theme_mod( 'frontpage_sections', array() );
	$homepage_widget_areas = get_theme_mod( 'frontpage_widget_areas', array() );
	foreach ($homepage_sections as $key=>$section) { ?>
		<section id="section<?php echo $key; ?>" class="<?php echo $section['template']; ?>" style="background: <?php echo $section['background_color']; ?>; color: <?php echo $section['text_color']; ?>;">
			<div class="grid-container">
				<?php if ( ! empty($section['title']) ) :
					if ( $section['title_style'] == 'line_on_sides' ) {
						$header_style = 'style="' . htmlspecialchars('background-image: url(\'data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" width=\"1px\" height=\"1px\" viewBox=\"0 0 1 1\" enable-background=\"new 0 0 1 1\" fill=\"' . ($section['title_line_on_sides_color'] ? $section['title_line_on_sides_color'] : '#ff6600') . '\" xml:space=\"preserve\"><rect width=\"1\" height=\"1\"/></svg>\');', ENT_QUOTES, 'UTF-8') . '" class="title-line-sides"';
					} else {
						$header_style = '';
					}
					echo '<header ' . $header_style . '><h2 class="text-center" style="background-color: ' . ($section['background_color'] ? $section['background_color'] : '#ffffff') . '; color: ' . ($section['title_color'] ? $section['title_color'] : '#000') . ';">' . $section['title'] . '</h2></header>';
				endif;

				if ( ! empty($section['text_before_content']) ) :
					echo '<div class="grid-container"><div class="grid-x grid-padding-x"><div class="cell">' . apply_filters('the_content', $section['text_before_content']) . '</div></div></div>';
				endif;

				if ($section['template'] == 'services') {
					get_template_part( 'template-parts/home-sections/home', 'services' );
				} elseif ($section['template'] == 'welcome') {
					get_template_part( 'template-parts/home-sections/home', 'welcome' );
				} elseif ($section['template'] == 'blog') {
					get_template_part( 'template-parts/home-sections/home', 'blog' );
				} elseif ( $section['template'] == 'featured_products' && class_exists( 'WooCommerce' ) ) {
					get_template_part( 'template-parts/home-sections/home', 'featured-products' );
				} elseif ($section['template'] == 'product_categories' && class_exists( 'WooCommerce' )) {
					get_template_part( 'template-parts/home-sections/home', 'product-categories' );
				} elseif ($section['template'] == 'recent_products' && class_exists( 'WooCommerce' )) {
					get_template_part( 'template-parts/home-sections/home', 'recent-products' );
				} elseif ($section['template'] == 'popular_products' && class_exists( 'WooCommerce' )) {
					get_template_part( 'template-parts/home-sections/home', 'popular-products' );
				} elseif ($section['template'] == 'on_sale_products' && class_exists( 'WooCommerce' )) {
					get_template_part( 'template-parts/home-sections/home', 'on-sale-products' );
				} else {
					foreach ($homepage_widget_areas as $key=>$widget_area) {
						$title_lowercase = strtolower( $widget_area['title'] );
						if ( array_key_exists('wrapper_css_class', $widget_area) ) {
							$widget_area_wrapper_css_class = $widget_area['wrapper_css_class'];
						} else {
							$widget_area_wrapper_css_class = 'grid-x grid-padding-x grid-padding-y small-up-1 medium-up-3 large-up-3';
						}
						if ( $section['template'] == $title_lowercase ) {
							$widget_id = str_replace( " ", "_", $title_lowercase );
							if ( is_active_sidebar( $widget_id ) ) { ?>
								<div class="<?php echo $widget_area_wrapper_css_class; ?> frontpage_widget_area_<?php echo $key; ?>" data-equalizer data-equalize-on="medium">
									<?php dynamic_sidebar( $widget_id ); ?>
								</div>
							<?php }
						}
					};
				}

				if ( ! empty($section['text_after_content']) ) :
					echo '<div class="grid-container"><div class="grid-x grid-padding-x"><div class="cell">' . apply_filters('the_content', $section['text_after_content']) . '</div></div></div>';
				endif;
				?>
			</div><?php // grid container ?>
		</section>
	<?php }
} ?>

<?php if (is_active_sidebar('frontpage_widgets')) { ?>
	<section id="frontpage_widgets">
		<div class="grid-container">
			<div class="grid-x grid-padding-x small-up-1 medium-up-3 large-up-3" data-equalizer data-equalize-on="medium">
				<?php dynamic_sidebar('frontpage_widgets'); ?>
			</div>
		</div>
	</section>
<?php } ?>


<?php get_footer(); ?>