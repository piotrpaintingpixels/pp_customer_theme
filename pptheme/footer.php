<?php
/**
 * The template for displaying the footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since 1.0
 */
?>
<?php if ( is_active_sidebar('footer_top_widgets') && is_front_page() ) { ?>
	<div id="footer-top">
		<div class="grid-container">
			<div class="grid-x grid-padding-x grid-padding-y small-up-1 medium-up-2" data-equalizer data-equalize-on="medium">
				<?php dynamic_sidebar('footer_top_widgets'); ?>
			</div>
		</div>
	</div>
<?php } ?>
	<div id="footer">
		<footer class="grid-container site-footer">
			<?php do_action( 'cornerstone_before_footer' );
			if (is_active_sidebar('footer_widgets')) { ?>
				<div class="grid-x grid-padding-x grid-padding-y small-up-1 medium-up-2 large-up-4">
					<?php dynamic_sidebar('footer_widgets'); ?>
				</div>
			<?php }
			if ( has_nav_menu( 'footer-menu' ) ) {
				wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'menu align-center', 'container' => false ) );
			} ?>
		</footer>
		<div class="footer2">
			<?php $footer_copy = esc_attr(get_theme_mod( 'footer_copyright', '' ));
			$footer_tel = esc_attr(get_theme_mod( 'footer_tel', '' ));
			$socialNetworks = get_theme_mod( 'section_footer_social_icons', array() );
			if ( !empty($footer_copy) || !empty($footer_tel) || !empty($socialNetworks) ) { ?>
				<div class="grid-container">
					<div class="grid-x grid-padding-x footer-bottom">
						<div class="small-12 medium-3 large-2 cell">
							<p class="footer-copyright">
								&copy; <?php echo $footer_copy . ' ' . date(Y);?></p>
						</div>
						<div class="small-12 medium-7 large-8 cell footer-bottom-contact">
							<?php $footer_email = get_theme_mod( 'footer_email', '' ); ?>
							<p><?php echo (empty($footer_tel)) ? '' : '<a href="tel:' . $footer_tel . '">' . $footer_tel . '</a>'; ?>&nbsp;&nbsp;&nbsp;<?php echo (empty($footer_email)) ? '' : '<a href="mailto:' . $footer_email . '">' . $footer_email . '</a>'; ?></p>
							<?php $additional_info = get_theme_mod( 'footer_additional_info', '' );
							if (! empty($additional_info)) : ?>
								<p class="footer-additional-info"><?php echo $additional_info; ?></p>
							<?php endif; ?>
						</div>
						<div class="small-12 medium-2 cell">
							<p class="footer-social">
								<?php foreach($socialNetworks as $socialNetwork ) :
									$link_url = esc_url($socialNetwork['link_url'], null, 'display' );
									if ( ! empty($link_url) ) { ?>
								        <a href="<?php echo $link_url; ?>" target="_blank">
								            <?php if ($socialNetwork['social_network'] == "facebook") {
								            	get_template_part('images/inline', 'facebook.svg');
								            } else if ($socialNetwork['social_network'] == "twitter") {
								            	get_template_part('images/inline', 'twitter.svg');
								            } else if ($socialNetwork['social_network'] == "googleplus") {
								            	get_template_part('images/inline', 'google-plus.svg');
								            } if ($socialNetwork['social_network'] == "linkedin") {
								            	get_template_part('images/inline', 'linkedin.svg');
								            } else if ($socialNetwork['social_network'] == "instagram") {
								            	get_template_part('images/inline', 'instagram.svg');
								            } else if ($socialNetwork['social_network'] == "pinterest") {
								            	get_template_part('images/inline', 'pinterest.svg');
								            } ?>
								        </a>
								    <?php } ?>
							    <?php endforeach; ?>
							</p>
						</div>
					</div>
				</div>
			<?php }
			if ( has_nav_menu( 'footer-menu-bottom' ) ) {
				wp_nav_menu( array( 'theme_location' => 'footer-menu-bottom', 'menu_class' => 'menu align-center', 'container' => false ) );
			} ?>
			<div class="grid-container">
				<div class="grid-x grid-padding-x align-right">
					<div class="shrink cell">
						<p class="footer-designedby"><small>A <a href="https://www.paintingpixels.co.uk" <?php echo ( ! is_front_page() ? 'rel="nofollow"' : ''); ?>>Painting Pixels</a> product</small></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> <?php // close .off-canvas-content ?>
<?php wp_footer(); ?>
<script>
	jQuery(document).ready(function ($) {
		jQuery.noConflict();
		jQuery(document).foundation();
	});
</script>
</body>
</html>
