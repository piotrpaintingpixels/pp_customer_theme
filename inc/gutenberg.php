<?php
/**
* Gutenberg scripts and styles
*/
function ppsystem_gutenberg_scripts() {

    wp_enqueue_script(
        'ppsystem-editor',
        get_stylesheet_directory_uri() . '/assets/js/editor.js',
        array( 'wp-blocks', 'wp-dom' ),
        filemtime( get_stylesheet_directory() . '/assets/js/editor.js' ),
        true
    );
}
add_action( 'enqueue_block_editor_assets', 'ppsystem_gutenberg_scripts' );