<?php
/**
 * The default template part for displaying header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 */

// off-canvas title bar for 'small' and 'medium' screen ?>
<div class="title-bar" data-responsive-toggle="widemenu" data-hide-for="large">
	<div class="title-bar-left">
		<?php if ( has_nav_menu( 'offCanvasLeft' ) ) { ?>
			<button class="menu-icon" type="button" data-open="offCanvasLeft"></button>
		<?php } ?>
		<span class="title-bar-title" itemscope itemtype="http://schema.org/Organization">
		<?php if ( function_exists( 'the_custom_logo' ) ) {
			$logo = get_custom_logo();
			if(!empty($logo)) {
				echo $logo;
			} else { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" itemprop="url" tabindex="0"><?php bloginfo( 'name' ); ?></a>
			<?php }
		} ?>
		</span>
	</div>
	<?php if ( has_nav_menu( 'offCanvasRight' ) ) { ?>
	<div class="title-bar-right">
		<div class="title-bar-title" data-open="offCanvasRight"><?php esc_attr_e( get_theme_mod( 'header_hamburger_menu_text_right', '' ) ); ?></div>
		<button class="menu-icon" type="button" data-open="offCanvasRight"></button>
	</div>
	<?php } ?>
</div>

<?php // off-canvas left menu
if ( has_nav_menu( 'offCanvasLeft' ) ) { ?>
<div class="off-canvas position-left" id="offCanvasLeft" data-off-canvas>
	<?php wp_nav_menu( array(
	'theme_location' => 'offCanvasLeft',
	'container' => false,
	'depth' => 0,
	'items_wrap' => '<ul class="vertical menu accordion-menu" data-accordion-menu>%3$s</ul>',
	'fallback_cb' => false,
	'walker' => new Foundation_Accordion_Menu_Walker(),
)); ?>
</div>
<?php } ?>

<?php // off-canvas right menu
if ( has_nav_menu( 'offCanvasRight' ) ) { ?>
<div class="off-canvas position-right" id="offCanvasRight" data-off-canvas data-position="right">
	<?php wp_nav_menu( array(
		'theme_location' => 'offCanvasRight',
		'container' => false,
		'depth' => 0,
		'items_wrap' => '<ul class="vertical menu accordion-menu" data-accordion-menu>%3$s</ul>',
		'fallback_cb' => false,
		'walker' => new Foundation_Accordion_Menu_Walker(),
	)); ?>
</div>
<?php }
