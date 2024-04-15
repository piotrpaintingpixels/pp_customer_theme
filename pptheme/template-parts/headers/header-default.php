<?php
/**
 * The default template part for displaying header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 */

// "wider" top-bar menu for 'large' and up ?>
<div id="header" class="show-for-large">
	<div id="widemenu" class="top-bar grid-container">
		<div class="top-bar-left">
			<ul class="dropdown menu" data-dropdown-menu>
				<li class="menu-text" itemscope itemtype="http://schema.org/Organization">
					<?php if ( function_exists( 'the_custom_logo' ) ) {
						$logo = get_custom_logo();
						if(!empty($logo)) {
							echo $logo;
						} else { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" itemprop="url" tabindex="0"><?php bloginfo( 'name' ); ?></a>
						<?php }
					} ?>
				</li>
				<?php if ( has_nav_menu( 'header-menu-left' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'header-menu-left',
						'container' => false,
						'depth' => 0,
						'items_wrap' => '%3$s',
						'fallback_cb' => false,
						'walker' => new Foundation_Dropdown_Menu_Walker(),
					));
				} ?>
			</ul>
		</div>
		<div class="top-bar-right">
			<?php if ( has_nav_menu( 'header-menu-right' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'header-menu-right',
					'container' => false,
					'depth' => 0,
					'items_wrap' => '<ul class="dropdown menu" data-dropdown-menu>%3$s</ul>',
					'fallback_cb' => false,
					'walker' => new Foundation_Dropdown_Menu_Walker(),
				));
			}
			if ( has_nav_menu( 'header-megamenu-right' ) ) { ?>
				<div class="megamenu-container">
					<div class="megamenu">
						<?php wp_nav_menu( array(
							'theme_location' => 'header-megamenu-right',
							'container' => false,
							'depth' => 0,
							'fallback_cb' => false,
						)); ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>