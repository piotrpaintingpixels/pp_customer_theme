<?php

/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and top navigation menus
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Cornerstone
 * @since 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" <?php language_attributes(); ?> > <![endif]-->
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open();

    get_template_part('template-parts/headers/header-mobile', get_theme_mod('header_layout_mobile', 'default'));
    get_template_part( 'template-parts/headers/header', get_theme_mod('header_layout', 'default') );
    ?>

    <div class="off-canvas-content" data-off-canvas-content>