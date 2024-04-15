<?php
/**
 * The default template for displaying banner image.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

if (class_exists('MultiPostThumbnails')) :
	if ( MultiPostThumbnails::has_post_thumbnail(get_post_type(), 'banner-image') ) : ?>
		<div class="grid-container">
			<div class="grid-x grid-padding-x">
				<div class="cell">
				    <?php MultiPostThumbnails::the_post_thumbnail(
				        get_post_type(),
				        'banner-image',
				        null,
				        'banner'
				    ); ?>
			    </div>
			</div>
		</div>
    <?php endif;
endif;