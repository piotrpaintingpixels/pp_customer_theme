<?php
/**
 * The WooCommerce template part for displaying header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 */

// off-canvas title bar for 'small' and 'medium' screen ?>
	<div class="title-bar title-bar-woocommerce1 d-flex flex-column" data-responsive-toggle="widemenu" data-hide-for="large">
		<div class="head_menu d-flex">
			<div class="title-bar-left">
				<?php if ( has_nav_menu( 'offCanvasLeft' ) ) { ?>
					<!--			<button class="menu-icon" type="button" data-open="offCanvasLeft"></button>-->
					<button class="menu-icon" type="button" data-open="offCanvasRight" aria-expanded="false" aria-controls="offCanvasRight"></button>
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

				<div class="arv-shop-bar d-flex">
					<ul class="arv-cell">

						<?php if (is_user_logged_in()) : ?>
							<li class="arv-menu"> <a href="<?php echo wp_logout_url(get_permalink()); ?>"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a></li>
							<li class="arv-menu"><a href="<?php echo esc_url( home_url( '/' ) ); ?>my-account/"><i class="fa fa-user-o" aria-hidden="true"></i> My Account</a></li>
						<?php else : ?>
							<li class="arv-menu"><a href="<?php echo wp_login_url(get_permalink()); ?>"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
							<li class="arv-menu">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>my-account/"><i class="fa fa-user-o" aria-hidden="true"></i> Register</a>
							</li>
						<?php endif;?>

						<!--  <li class="arv-menu"><a href="<?php //echo esc_url( home_url( '/' ) ); ?>my-account/"> <i class="fa fa-sign-in" aria-hidden="true"></i> Login In</a></li>
                            <li class="arv-menu"><a href="<?php //echo esc_url( home_url( '/' ) ); ?>my-account/"><i class="fa fa-user-o" aria-hidden="true"></i> Register</a></li>-->
						<li class="cell">
							<a class="header-cart-contents" href="<?php echo wc_get_checkout_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
								<i class="fa fa-shopping-cart" aria-hidden="true"></i>
								<?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?>
							</a>
						</li>

					</ul>
					<div class="title-bar-right">
						<div class="title-bar-title ddd" data-open="offCanvasRight"><?php esc_attr_e( get_theme_mod( 'header_hamburger_menu_text_right', '' ) ); ?></div>
						<button class="menu-icon" type="button" data-open="offCanvasRight"></button>
					</div>

				</div>

			<?php } ?>
		</div>
		<form role="search" method="get" id="search-mobile" class="mobile-search" action="<?php echo home_url('/'); ?>">
			<label for="s" class="show-for-sr">Search for:</label>
			<input type="search" id="s" class="search-field" placeholder="<?php esc_attr_e('Search', 'cornerstone'); ?>" name="s" required>
			<button class="button-search"><i class="fa fa-search"></i><span class="show-for-sr">Search</span></button>
		</form>
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
