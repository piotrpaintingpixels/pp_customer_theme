<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="grid-x grid-padding-x grid-padding-y">
	<div class="small-6 cell">
		<?php // Pagination
		if (function_exists("emm_paginate")) {
			emm_paginate();
		} ?>
	</div>
	<div class="small-6 cell">
		<p class="text-right">
			<a href="<?php echo (is_paged() ? '../../' : ''); ?>?showall" class="right">View All</a>
		</p>
	</div>
</div>
