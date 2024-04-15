<?php
/**
 * Starter content
 */

// Overriding/supplementing a predefined item plus a custom definition
add_theme_support( 'starter-content', array(
    'attachments' => array(
        'featured-image-logo' => array(
            'post_title' => 'Featured Logo',
            'post_content' => 'Attachment Description',
            'post_excerpt' => 'Attachment Caption',
            'file' => 'assets/images/featured-logo.jpg',
        ),
    ),
    'posts' => array(
        'about' => array(
            // Use the above featured image with the predefined about page
            'thumbnail' => '{{featured-image-logo}}',
        ),
    ),
);