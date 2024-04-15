<?php
/**
 * Custom admin
 *
 */

function pp_admin_login_logo() {
$image = get_theme_mod( 'admin_login_logo', '' );
if (!empty($image)) : ?>
<style type="text/css">
body.login div#login h1 a {
background-image: url(<?php echo $image; ?>);
}
</style>
<?php
endif;
}
add_action( 'login_enqueue_scripts', 'pp_admin_login_logo' );


function pp_login_logo_url_title() {
     return esc_attr( get_bloginfo( 'name', 'display' ) );
}
add_filter( 'login_headertitle', 'pp_login_logo_url_title' );


function pp_login_logo_url() {
     return home_url();
}
add_filter( 'login_headerurl', 'pp_login_logo_url' );