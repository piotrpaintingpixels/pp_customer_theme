<?php

/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Varia
 */
/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function ppsystem_woocommerce_setup()
{
  /* add_theme_support('woocommerce', apply_filters('varia_woocommerce_args', array(
    'single_image_width'    => 750,
    'thumbnail_image_width' => 350,
    'product_grid'          => array(
      'default_columns' => 3,
      'default_rows'    => 6,
      'min_columns'     => 1,
      'max_columns'     => 6,
      'min_rows'        => 1
    )
  ))); */
  add_theme_support('wc-product-gallery-zoom');
  add_theme_support('wc-product-gallery-lightbox');
  add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'ppsystem_woocommerce_setup');


/**
 * WooCommerce Sidebar
 * Use custom widget area (sidebar-woocommerce.php) which is added via ppsystem_wrapper_end().
 */
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

/**
 * Add a custom wrapper for WooCommerce content
 */
function ppsystem_wrapper_start()
{
  echo '<div id="container" class="grid-container"><div class="grid-x grid-padding-x"><main id="content" class="auto cell medium-order-2 site-content">';
}
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
add_action('woocommerce_before_main_content', 'ppsystem_wrapper_start', 10);

function ppsystem_wrapper_end()
{
  echo '</main>';
  get_sidebar('woocommerce');
  echo '</div></div>';
}
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_after_main_content', 'ppsystem_wrapper_end', 0);


/**
 * Add a custom wrapper for woocommerce_before_shop_loop
 */
function ppsystem_wrapper_woocommerce_before_shop_loop_start()
{
  echo '<div class="grid-x grid-padding-x">';
}
add_action('woocommerce_before_shop_loop', 'ppsystem_wrapper_woocommerce_before_shop_loop_start', 15);

function ppsystem_wrapper_woocommerce_before_shop_loop_end()
{
  echo '</div>';
}
add_action('woocommerce_before_shop_loop', 'ppsystem_wrapper_woocommerce_before_shop_loop_end', 100);


/**
 * Display category image on category archive
 */
function ppsystem_category_image()
{
  if (is_shop()) {
    // Shop main page (category 0)
    if (class_exists('MultiPostThumbnails')) {
      $shopPageId = get_option('woocommerce_shop_page_id');
      if (MultiPostThumbnails::has_post_thumbnail('page', 'banner-image', $shopPageId)) {
        echo '<div class="grid-container"><div class="grid-x grid-padding-x"><div class="cell">';
        //echo '<img src="' . $image . '" alt="' . $cat->name . '" />';
        MultiPostThumbnails::the_post_thumbnail(
          'page',
          'banner-image',
          $shopPageId,
          'banner'
        );
        echo '</div></div></div>';
      }
    }
  } else if (is_product_category()) {
    // Shop category page
    global $wp_query;
    $cat = $wp_query->get_queried_object();
    $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
    //$image = wp_get_attachment_url($thumbnail_id);
    $image = wp_get_attachment_image($thumbnail_id, 'banner');
    if ($image) {
      echo '<div class="grid-container"><div class="grid-x grid-padding-x"><div class="cell">';
      //echo '<img src="' . $image . '" alt="' . $cat->name . '" />';
      echo $image;
      echo '</div></div></div>';
    }
  }
}
add_action('woocommerce_before_main_content', 'ppsystem_category_image', 2);


/**
 * Display filter widget area on mobile
 */
function ppsystem_woocommerce_filter()
{
  if (is_product_category()) {
    if (is_active_sidebar('woocommerce_filter')) {
      $filter_display_option = esc_attr(get_theme_mod( 'woocommerce_filter_display', 'tablet' ));
      if ($filter_display_option == "mobile") {
        $filter_display = " hide-for-medium";
      } else if ($filter_display_option == "tablet") {
        $filter_display = " hide-for-large";
      } else if ($filter_display_option == "desktop") {
        $filter_display = " show-for-large";
      } else {
        $filter_display = "";
      }
      echo '<ul class="accordion woocommerce-filter' . $filter_display . '" data-accordion data-allow-all-closed="true">';
        echo '<li class="accordion-item" data-accordion-item>';
          echo '<a href="#" class="accordion-title">Filter</a>';
          echo '<div class="accordion-content" data-tab-content>';
            echo '<div class="grid-x grid-padding-x grid-padding-y small-up-1 medium-up-2 large-up-4">';
              dynamic_sidebar('woocommerce_filter');
            echo '</div>';
          echo '</div>';
        echo '</li>';
      echo '</ul>';
    }
  }
}
add_action('woocommerce_archive_description', 'ppsystem_woocommerce_filter', 30);



// Removes tabs from their original location
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

// Inserts description under the main right product content
//add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 60 );
add_action('woocommerce_single_product_summary','shooz_woocommerce_single_product_desc',60);
function shooz_woocommerce_single_product_desc(){
  the_content();
}

// Related products
function woo_related_products_limit() {
  global $product;

  $args['posts_per_page'] = 4;
  return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
function jk_related_products_args( $args ) {

  $args['posts_per_page'] = 4; // 4 related products
  $args['columns'] = 2; // arranged in 2 columns
  return $args;
}

// Display all if ?showall used on end of category url or 24 products per page
if( isset( $_GET['showall'] ) ){
    add_filter( 'loop_shop_per_page', create_function( '$cols', 'return -1;' ) );
} else {
    add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ) );
}

add_filter( 'woocommerce_variable_free_price_html',  'hide_free_price_notice' );
add_filter( 'woocommerce_free_price_html',           'hide_free_price_notice' );
add_filter( 'woocommerce_variation_free_price_html', 'hide_free_price_notice' );
function hide_free_price_notice( $price, $product ) {
  remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
  return 'Please call to order';
}

//remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );




// Increase WooCommerce Variation Limit
// https://www.warrenchandler.com/2016/11/08/woocommerce-product-unavailable-problem/
function custom_wc_ajax_variation_threshold( $qty, $product ) {
return 100;
}
add_filter( 'woocommerce_ajax_variation_threshold', 'custom_wc_ajax_variation_threshold', 200, 2 );


/**
 * Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php).
 * Used in conjunction with https://gist.github.com/DanielSantoro/1d0dc206e242239624eb71b2636ab148
 * @link https://docs.woocommerce.com/document/show-cart-contents-total/
 */
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start(); ?>
  <a class="header-cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>  <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
  <?php $fragments['a.header-cart-contents'] = ob_get_clean();
  return $fragments;
}

// Move SKU and categories below description
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action('woocommerce_single_product_summary','woocommerce_template_single_meta',60);

// Display or hide SKU
if ( true == get_theme_mod( 'woocommerce_display_sku', true ) ) :
  add_filter( 'wc_product_sku_enabled', '__return_true' );
else :
  add_filter( 'wc_product_sku_enabled', '__return_false' );
endif;

//add_filter( 'post_class', 'prefix_post_class', 21 );
function prefix_post_class( $classes ) {
    if ( 'product' == get_post_type() ) {
        $classes = array_diff( $classes, array( 'first', 'last' ) );
    }
    return $classes;
}


// Move WCB_Category_Banner to a do_action inside the wrapper-start.php template
if ( class_exists( 'WCB_Category_Banner' ) ) :
  global $WCB_Category_Banner;
  remove_action( 'woocommerce_before_main_content', array( $WCB_Category_Banner, 'wcb_show_category_banner'), 30 );
  add_action( 'woocommerce_wrapper_start', function() {echo '<div class="small-12 cell">';}, 1 );
  add_action( 'woocommerce_wrapper_start', array( $WCB_Category_Banner, 'wcb_show_category_banner'), 2 );
  add_action( 'woocommerce_wrapper_start', function() {echo '</div>';}, 3 );
endif;