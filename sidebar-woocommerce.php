<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since 1.0
 */
?>
<?php if ( is_active_sidebar( 'woocommerce_sidebar' ) && is_archive() && ! is_search() ) :
	$filter_display_option = esc_attr(get_theme_mod( 'woocommerce_sidebar_display', 'desktop' ));
	if ($filter_display_option == "mobile") {
		$filter_display = " hide-for-medium";
	} else if ($filter_display_option == "tablet") {
		$filter_display = " hide-for-large";
	} else if ($filter_display_option == "desktop") {
		$filter_display = " show-for-large";
	} else {
		$filter_display = "";
	} ?>
	<aside class="small-12 medium-4 large-3 cell sidebar<?php echo $filter_display; ?>">
		<?php do_action( 'cornerstone_before_sidebar' ); ?>
			<?php dynamic_sidebar( 'woocommerce_sidebar' ); ?>
		<?php do_action( 'cornerstone_after_sidebar' ); ?>
	</aside>
<?php endif; ?>