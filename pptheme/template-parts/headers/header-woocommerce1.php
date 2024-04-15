<?php
/**
 * The WooCommerce template part for displaying header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 */

// "wider" top-bar menu for 'large' and up ?>
<div id="header" class="show-for-large header-woocommerce1">
	<?php if ( has_nav_menu( 'header-menu-top' ) ) { ?>
		<div class="header-menu-top">
			<div class="grid-container">
				<?php wp_nav_menu( array(
					'theme_location' => 'header-menu-top',
					'container' => false,
					'depth' => 0,
					'items_wrap' => '<ul class="dropdown menu align-right" data-dropdown-menu>%3$s</ul>',
					'fallback_cb' => false,
					'walker' => new Foundation_Dropdown_Menu_Walker(),
				)); ?>
			</div>
		</div>
	<?php } ?>
	<div class="grid-container">
		<div class="grid-x grid-padding-x align-middle">
			<div class="shrink cell">
				<?php if ( function_exists( 'the_custom_logo' ) ) {
				$logo = get_custom_logo();
				if(!empty($logo)) {
					echo $logo;
				} else { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" itemprop="url" tabindex="0"><?php bloginfo( 'name' ); ?></a>
				<?php }
			} ?>
			</div>
			<?php if ( class_exists( 'woocommerce' ) ) { ?>
				<div class="auto cell">
					<div class="grid-x grid-padding-x align-middle">
						<div class="auto cell large-offset-2">
							<form role="search" method="get" id="search" class="header-search" action="<?php echo home_url('/'); ?>">
								<input type="hidden" name="post_type" value="product" />
								<label for="s" class="show-for-sr">Search for:</label>
								<input type="search" id="s" class="search-field" placeholder="<?php esc_attr_e('Search', 'cornerstone'); ?>" name="s" required>
								<button class="button-search"><i class="fa fa-search"></i><span class="show-for-sr">Search</span></button>
							</form>
						</div>
						<div class="small-12 medium-4 cell header-account-wrapper">
							<div class="grid-x small-up-2">
								<?php if ( is_user_logged_in() ) {
								echo '<div class="cell"><a href="' . wp_logout_url( home_url() ) . '"><i class="fa fa-sign-out" aria-hidden="true"></i> ' . __( 'Log Out' ) . '</a></div>';
								?><div class="cell text-right"><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account',''); ?>"><i class="fa fa-user-o" aria-hidden="true"></i> <?php _e('My Account',''); ?></a></div>
								<?php } else {
									echo '<div class="cell"><a href="' . get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) . '"><i class="fa fa-sign-in" aria-hidden="true"></i> ' . __( 'Login In' ) . '</a></div>';
									echo '<div class="cell text-right"><a href="' . get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) . '"><i class="fa fa-user-o" aria-hidden="true"></i> ' . __( 'Register' ) . '</a></div>';
								} ?>
								<div class="cell"><a class="header-cart-contents" href="<?php echo wc_get_checkout_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a></div>
								<?php global $woocommerce;
								//if ( sizeof( $woocommerce->cart->cart_contents) > 0 ) :
								echo '<div class="cell text-right"><a href="' . wc_get_checkout_url() . '" title="' . __( 'Checkout' ) . '"><i class="fa fa-check" aria-hidden="true"></i> ' . __( 'Checkout' ) . '</a></div>';
								// endif; ?>
							</div>
							<p class="header-cart-wrapper"></p>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>

	<div class="header-menu">
		<div id="widemenu" class="top-bar grid-container">
			<div class="top-bar-left">
				<?php if ( has_nav_menu( 'header-menu-left' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'header-menu-left',
						'container' => false,
						'depth' => 0,
						'items_wrap' => '<ul class="dropdown menu" data-dropdown-menu>%3$s</ul>',
						'fallback_cb' => false,
						'walker' => new Foundation_Dropdown_Menu_Walker(),
					));
				}
				if ( has_nav_menu( 'header-megamenu-left' ) ) { ?>
					<div class="megamenu-container">
						<div class="megamenu">
							<?php wp_nav_menu( array(
								'theme_location' => 'header-megamenu-left',
								'container' => false,
								'depth' => 0,
								'fallback_cb' => false,
							)); ?>
						</div>
					</div>
				<?php } ?>
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
</div>