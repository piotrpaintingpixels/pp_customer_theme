<?php
/**
 * Theme Customizer
 *
 */

class pptheme_Theme_Customizer {

    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'init', array( $this, 'setup_options' ) );
    }

    /**
     * Add our custom fields to the Customizer
     */
    public function setup_options() {

        PP_Theme_Kirki::add_config( 'pp_theme', array(
            'capability'    => 'edit_theme_options',
            'option_type'   => 'theme_mod',
        ) );


        /* Colour Scheme */

        PP_Theme_Kirki::add_panel( 'panel_colour_scheme', array(
		    'priority'    => 10,
		    'title'       => __( 'Colour Scheme', 'paintingpixels' ),
		    'description' => __( 'My Colour Scheme', 'paintingpixels' ),
		) );

        PP_Theme_Kirki::add_section( 'section_colours_general', array(
            'title'          => __( 'Colour Scheme (general)' ),
            'panel'          => 'panel_colour_scheme',
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_page_background_colour',
            'label'       => __( 'Page Background Colour', 'paintingpixels' ),
            'section'     => 'section_colours_general',
            'default'     => '#fff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => 'body',
                    'property' => 'background-color',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'multicolor',
            'settings'    => 'paintingpixels_link_colours',
            'label'       => __( 'Link Colour', 'paintingpixels' ),
            'section'     => 'section_colours_general',
            'priority'    => 10,
            'choices'     => array(
                'link'    => __( 'Color', 'paintingpixels' ),
                'hover'   => __( 'Hover', 'paintingpixels' ),
                'active'  => __( 'Active', 'paintingpixels' ),
            ),
            'default'     => array(
                'link'    => '#29abe2',
                'hover'   => '#29abe2',
                'active'  => '#29abe2',
            ),
            'output' => array(
                array(
                    'choice'   => 'link',
                    'element'  => 'a',
                    'property' => 'color',
                ),
                array(
                    'choice'   => 'hover',
                    'element'  => 'a:hover',
                    'property' => 'color',
                ),
                array(
                    'choice'   => 'active',
                    'element'  => 'a:active',
                    'property' => 'color',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'multicolor',
            'settings'    => 'paintingpixels_button_colour',
            'label'       => __( 'Button Colour', 'paintingpixels' ),
            'section'     => 'section_colours_general',
            'priority'    => 10,
            'choices'     => array(
                'text'    => __( 'Button Colour', 'paintingpixels' ),
                'background'   => __( 'Background', 'paintingpixels' ),
                'bg_disabled'  => __( 'Background (disabled)', 'paintingpixels' ),
            ),
            'default'     => array(
                'text'         => '#fff',
                'background'   => '#000',
                'bg_disabled'  => '#000'
            ),
            'output' => array(
                array(
                    'choice'   => 'text',
                    'element'  => '.button, button:not(.menu-icon):not(.orbit-previous):not(.orbit-next):not(.button-search):not(.close-button), .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt',
                    'property' => 'color',
                ),
                array(
                    'choice'   => 'background',
                    'element'  => '.button, button:not(.menu-icon):not(.orbit-previous):not(.orbit-next):not(.button-search):not(.close-button), .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt',
                    'property' => 'background',
                ),
                array(
                    'choice'   => 'bg_disabled',
                    'element'  => '.button.disabled, button.disabled',
                    'property' => 'background',
                )
            ),
        ) );


        PP_Theme_Kirki::add_section( 'section_colours_header', array(
            'title'          => __( 'Colour Scheme (header)' ),
            'panel'          => 'panel_colour_scheme',
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_header_background_colour',
            'label'       => __( 'Header Background Colour', 'paintingpixels' ),
            'section'     => 'section_colours_header',
            'default'     => '#ffffff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '#header, .title-bar',
                    'property' => 'background',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_menu_background_colour',
            'label'       => __( 'Menu Background Colour', 'paintingpixels' ),
            'section'     => 'section_colours_header',
            'default'     => '#ffffff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.header-menu, .top-bar',
                    'property' => 'background',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_menu_text_colour',
            'label'       => __( 'Menu Text Colour', 'paintingpixels' ),
            'section'     => 'section_colours_header',
            'default'     => '#000000',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.top-bar a, .top-bar .menu .is-active>a',
                    'property' => 'color',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'multicolor',
            'settings'    => 'paintingpixels_menu_hover_colour',
            'label'       => __( 'Menu Hover Colour', 'paintingpixels' ),
            'section'     => 'section_colours_header',
            'priority'    => 10,
            'choices'     => array(
                'text'         => __( 'Text', 'paintingpixels' ),
                'background'   => __( 'Background', 'paintingpixels' )
            ),
            'default'     => array(
                'text'         => '#000000',
                'background'   => '#f0f0f0',
            ),
            'output' => array(
                array(
                    'choice'   => 'text',
                    'element'  => '.top-bar .menu-item a:hover, .top-bar .menu-item .is-active>a:hover, .top-bar .menu-item:hover>a',
                    'property' => 'color',
                ),
                array(
                    'choice'   => 'background',
                    'element'  => '.top-bar .menu-item:hover',
                    'property' => 'background',
                )
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_menu_active_page_text_colour',
            'label'       => __( 'Menu Active Page Text Colour', 'paintingpixels' ),
            'section'     => 'section_colours_header',
            'default'     => '#ffffff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.top-bar .menu>li.active>a',
                    'property' => 'color',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_menu_active_page_background_colour',
            'label'       => __( 'Menu Active Page Background Colour', 'paintingpixels' ),
            'section'     => 'section_colours_header',
            'default'     => '#29abe2',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.top-bar .menu>li.active',
                    'property' => 'background',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'multicolor',
            'settings'    => 'paintingpixels_menu_dropdown_colours',
            'label'       => __( 'Menu Dropdown Colour', 'paintingpixels' ),
            'section'     => 'section_colours_header',
            'priority'    => 10,
            'choices'     => array(
                'text'         => __( 'Text', 'paintingpixels' ),
                'background'   => __( 'Background', 'paintingpixels' ),
                'border'       => __( 'Border', 'paintingpixels' ),
            ),
            'default'     => array(
                'text'         => '#000000',
                'background'   => '#fefefe',
                'border'       => '#fefefe',
            ),
            'output' => array(
                array(
                    'choice'   => 'text',
                    'element'  => '.top-bar .is-dropdown-submenu a, .megamenu .sub-menu a',
                    'property' => 'color',
                ),
                array(
                    'choice'   => 'background',
                    'element'  => '.top-bar .is-dropdown-submenu, .megamenu .sub-menu',
                    'property' => 'background',
                ),
                array(
                    'choice'   => 'border',
                    'element'  => '.top-bar .is-dropdown-submenu, .megamenu .sub-menu',
                    'property' => 'border',
                    'prefix'   => '1px solid '
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_top_menu_background_colour',
            'label'       => __( 'Top Menu Background Colour', 'paintingpixels' ),
            'section'     => 'section_colours_header',
            'default'     => '#000000',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.header-menu-top',
                    'property' => 'background',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_top_menu_text_colour',
            'label'       => __( 'Top Menu Text Colour', 'paintingpixels' ),
            'section'     => 'section_colours_header',
            'default'     => '#ffffff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.header-menu-top a, .header-menu-top .menu .active>a',
                    'property' => 'color',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_top_menu_text_hover_colour',
            'label'       => __( 'Top Menu Text Hover Colour', 'paintingpixels' ),
            'section'     => 'section_colours_header',
            'default'     => '#ffffff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.header-menu-top a:hover, .header-menu-top .menu .active>a:hover',
                    'property' => 'color',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_mobile_header_background_colour',
            'label'       => __( 'Mobile Header Background Colour', 'paintingpixels' ),
            'section'     => 'section_colours_header',
            'default'     => '#ffffff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.title-bar',
                    'property' => 'background',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_mobile_header_text_colour',
            'label'       => __( 'Mobile Header Text Colour', 'paintingpixels' ),
            'section'     => 'section_colours_header',
            'default'     => '#29abe2',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.title-bar, .title-bar a',
                    'property' => 'color',
                ),
                array(
                    'element'  => '.title-bar .menu-icon:after',
                    'property' => 'background',
                ),
                array(
                    'element'  => '.title-bar .menu-icon:after',
                    'property' => 'box-shadow',
                    'value_pattern'   => '0 7px 0 $,0 14px 0 $'
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_mobile_menu_background_colour',
            'label'       => __( 'Off Canvas Menu Background Colour', 'paintingpixels' ),
            'section'     => 'section_colours_header',
            'default'     => '#29abe2',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.off-canvas',
                    'property' => 'background',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_mobile_menu_text_colour',
            'label'       => __( 'Mobile Menu Text Colour', 'paintingpixels' ),
            'section'     => 'section_colours_header',
            'default'     => '#fff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.off-canvas .menu a',
                    'property' => 'color',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_mobile_menu_text_hover_colour',
            'label'       => __( 'Mobile Menu Text Hover Colour', 'paintingpixels' ),
            'section'     => 'section_colours_header',
            'default'     => '#fff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.off-canvas .menu a:hover',
                    'property' => 'color',
                ),
                array(
                    'element'  => '.accordion-menu .is-accordion-submenu-parent:not(.has-submenu-toggle)>a::after',
                    'property' => 'border-color',
                    'suffix'   => ' transparent transparent'
                )
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'multicolor',
            'settings'    => 'paintingpixels_woocommerce_header_cart_link_colours',
            'label'       => __( 'Woocommerce Cart/Checkout/Account Colour', 'paintingpixels' ),
            'section'     => 'section_colours_general',
            'priority'    => 10,
            'choices'     => array(
                'link'    => __( 'Color', 'paintingpixels' ),
                'hover'   => __( 'Hover', 'paintingpixels' ),
                'active'  => __( 'Active', 'paintingpixels' ),
            ),
            'default'     => array(
                'link'    => '#29abe2',
                'hover'   => '#29abe2',
                'active'  => '#29abe2',
            ),
            'output' => array(
                array(
                    'choice'   => 'link',
                    'element'  => '.header-account-wrapper a',
                    'property' => 'color',
                ),
                array(
                    'choice'   => 'hover',
                    'element'  => '.header-account-wrapper a:hover',
                    'property' => 'color',
                ),
                array(
                    'choice'   => 'active',
                    'element'  => '.header-account-wrapper a:active',
                    'property' => 'color',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_section( 'section_colours_footer', array(
            'title'          => __( 'Colour Scheme (footer)' ),
            'panel'          => 'panel_colour_scheme',
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_footer_background_colour',
            'label'       => __( 'Footer Background Colour', 'paintingpixels' ),
            'section'     => 'section_colours_footer',
            'default'     => '#363636',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '#footer',
                    'property' => 'background',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_footer_widget_divider_colour',
            'label'       => __( 'Footer Widget Divider Colour', 'paintingpixels' ),
            'section'     => 'section_colours_footer',
            'default'     => '#363636',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'media_query' => '@media screen and (max-width: 39.9375em)',
                    'element'  => '#footer footer>div>.cell:not(:last-child)',
                    'property' => 'border-bottom',
                    'prefix'   => '1px solid '
                ),
                array(
                    'media_query' => '@media screen and (min-width: 40em) and (max-width: 63.9375em)',
                    'element'  => '#footer footer>div>.cell:not(:nth-last-child(-n+2))',
                    'property' => 'border-bottom',
                    'prefix'   => '1px solid '
                ),
                array(
                    'media_query' => '@media screen and (min-width: 64em)',
                    'element'  => '#footer footer>div>.cell:not(:nth-child(4n))',
                    'property' => 'border-right',
                    'prefix'   => '1px solid '
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_footer_bottom_background_colour',
            'label'       => __( 'Footer Bottom Background Colour', 'paintingpixels' ),
            'section'     => 'section_colours_footer',
            'default'     => '#363636',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.footer2',
                    'property' => 'background',
                ),
                array(
                    'element'  => '#footer',
                    'property' => 'box-shadow',
                    'prefix'   => '0px 500px 0px 500px '
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_footer_bottom_divider_colour',
            'label'       => __( 'Footer Bottom Divider Colour', 'paintingpixels' ),
            'section'     => 'section_colours_footer',
            'default'     => '#363636',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.footer2',
                    'property' => 'border-top',
                    'prefix'   => '1px solid '
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_footer_text_colour',
            'label'       => __( 'Footer Text Colour', 'paintingpixels' ),
            'section'     => 'section_colours_footer',
            'default'     => '#fff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '#footer, #footer p',
                    'property' => 'color',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_footer_link_colour',
            'label'       => __( 'Footer Link Colour', 'paintingpixels' ),
            'section'     => 'section_colours_footer',
            'default'     => '#fff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '#footer a',
                    'property' => 'color',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_footer_link_hover_colour',
            'label'       => __( 'Footer Text Hover Colour', 'paintingpixels' ),
            'section'     => 'section_colours_footer',
            'default'     => '#fff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '#footer a:hover',
                    'property' => 'color',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_footer_widget_title_colour',
            'label'       => __( 'Footer Widget Title Colour', 'paintingpixels' ),
            'section'     => 'section_colours_footer',
            'default'     => '#fff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '#footer h4, #footer h4 a',
                    'property' => 'color',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'multicolor',
            'settings'    => 'paintingpixels_designedby_colours',
            'label'       => __( 'Designed By Link Colour', 'paintingpixels' ),
            'section'     => 'section_colours_footer',
            'priority'    => 10,
            'choices'     => array(
                'link'    => __( 'Color', 'paintingpixels' ),
                'hover'   => __( 'Hover', 'paintingpixels' ),
                'active'  => __( 'Active', 'paintingpixels' ),
            ),
            'default'     => array(
                'link'    => '#fff',
                'hover'   => '#fff',
                'active'  => '#fff',
            ),
            'output' => array(
                array(
                    'choice'   => 'link',
                    'element'  => '#footer .footer-designedby, #footer .footer-designedby a',
                    'property' => 'color',
                ),
                array(
                    'choice'   => 'hover',
                    'element'  => '#footer .footer-designedby a:hover',
                    'property' => 'color',
                ),
                array(
                    'choice'   => 'active',
                    'element'  => '#footer .footer-designedby a:active',
                    'property' => 'color',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_footer_top_background_colour',
            'label'       => __( 'Footer (top) Background Colour', 'paintingpixels' ),
            'section'     => 'section_colours_footer',
            'default'     => '#363636',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '#footer-top',
                    'property' => 'background',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_section( 'section_colours_widgets', array(
            'title'          => __( 'Colour Scheme (widgets)' ),
            'panel'          => 'panel_colour_scheme',
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_sidebar_widget_title_colour',
            'label'       => __( 'Sidebar Widget Title Colour', 'paintingpixels' ),
            'section'     => 'section_colours_widgets',
            'default'     => '#fff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.sidebar .widgettitle, .sidebar .widgettitle a, .home section .widgettitle, .home section .widgettitle a',
                    'property' => 'color',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_sidebar_widget_title_background_colour',
            'label'       => __( 'Sidebar Widget Title Background Colour', 'paintingpixels' ),
            'section'     => 'section_colours_widgets',
            'default'     => '#777',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.sidebar .widgettitle, .home section .widgettitle',
                    'property' => 'background',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_sidebar_widget_background_colour',
            'label'       => __( 'Sidebar Widget Background Colour', 'paintingpixels' ),
            'section'     => 'section_colours_widgets',
            'default'     => '#f1f1f1',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.sidebar .widget, .home section .widget',
                    'property' => 'background',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_sidebar_widget_text_colour',
            'label'       => __( 'Sidebar Widget Text Colour', 'paintingpixels' ),
            'section'     => 'section_colours_widgets',
            'default'     => '#000',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'  => '.sidebar .widget, .home section .widget',
                    'property' => 'color',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_section( 'section_colours_services', array(
            'title'          => __( 'Colour Scheme (services)' ),
            'panel'          => 'panel_colour_scheme',
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_services_title_background',
            'label'       => __( 'Services Title Background', 'paintingpixels' ),
            'section'     => 'section_colours_services',
            'default'     => 'rgba(119, 119, 119, 0.9)',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'media_query' => '@media screen and (min-width: 40em)',
                    'element'     => '.service-title a',
                    'property'    => 'background',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_services_title_colour',
            'label'       => __( 'Services Title Colour', 'paintingpixels' ),
            'section'     => 'section_colours_services',
            'default'     => '#fff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'media_query' => '@media screen and (min-width: 40em)',
                    'element'     => '.service-title a',
                    'property'    => 'color',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_services_title_colour',
            'label'       => __( 'Services Title Hover Colour', 'paintingpixels' ),
            'section'     => 'section_colours_services',
            'default'     => '#fff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'media_query' => '@media screen and (min-width: 40em)',
                    'element'     => '.service-title a:hover',
                    'property'    => 'color',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_services_row_background',
            'label'       => __( 'Service Row Background (mobile)', 'paintingpixels' ),
            'section'     => 'section_colours_services',
            'default'     => '#f1f1f1',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'media_query' => '@media screen and (max-width: 39.9375em)',
                    'element'     => '.service-wrapper',
                    'property'    => 'background',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_services_title_colour_mobile',
            'label'       => __( 'Services Title Colour (mobile)', 'paintingpixels' ),
            'section'     => 'section_colours_services',
            'default'     => '#000',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'media_query' => '@media screen and (max-width: 39.9375em)',
                    'element'     => '.service-title a',
                    'property'    => 'color',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_services_widget_row_background',
            'label'       => __( 'Service Widget Row Background', 'paintingpixels' ),
            'section'     => 'section_colours_services',
            'default'     => '#ddd',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'     => '.widget_services .row',
                    'property'    => 'background',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_services_widget_title_colour',
            'label'       => __( 'Services Widget Title Colour', 'paintingpixels' ),
            'section'     => 'section_colours_services',
            'default'     => '#000',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'     => '.widget_services .row a',
                    'property'    => 'color',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_services_widget_title_hover_colour',
            'label'       => __( 'Services Widget Title Hover Colour', 'paintingpixels' ),
            'section'     => 'section_colours_services',
            'default'     => '#000',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'     => '.widget_services .row a:hover',
                    'property'    => 'color',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_section( 'section_colours_ecommerce', array(
            'title'          => __( 'Colour Scheme (ecommerce' ),
            'panel'          => 'panel_colour_scheme',
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );

        PP_Theme_Kirki::add_section( 'section_colours_homepage', array(
            'title'          => __( 'Colour Scheme (home page)' ),
            'panel'          => 'panel_colour_scheme',
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'color',
            'settings'    => 'paintingpixels_slider_background',
            'label'       => __( 'Slider Background', 'paintingpixels' ),
            'section'     => 'section_colours_homepage',
            'default'     => '#fff',
            'priority'    => 10,
            'alpha'       => 'true',
            'transport'   => 'auto',
            'output' => array(
                array(
                    'element'     => '#slider',
                    'property'    => 'background',
                ),
            ),
        ) );


		/* Typography */

        PP_Theme_Kirki::add_section( 'section_typography', array(
            'title'          => __( 'Typography' ),
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );

		PP_Theme_Kirki::add_field( 'pp_theme', array(
			'type'        => 'typography',
			'settings'    => 'typography_body',
			'label'       => esc_attr__( 'Body', 'paintingpixels' ),
			'section'     => 'section_typography',
			'default'     => array(
				'font-family'    => 'Open Sans',
				'variant'        => 'regular',
				'font-size'      => '1rem',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#000',
				//'text-transform' => 'none',
				//'text-align'     => 'left'
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => 'body, body p',
				),
			),
		) );

		PP_Theme_Kirki::add_field( 'pp_theme', array(
			'type'        => 'typography',
			'settings'    => 'typography_page_title',
			'label'       => esc_attr__( 'Page Title', 'paintingpixels' ),
			'section'     => 'section_typography',
			'default'     => array(
				'font-family'    => 'Open Sans',
				'variant'        => 'regular',
				'font-size'      => '1.6rem',
				'line-height'    => '1.5',
				'letter-spacing' => '0',
				'color'          => '#000',
				'text-transform' => 'none',
				'text-align'     => 'left'
			),
			'priority' => 10,
			'output'  => array(
				array(
					'element' => '.entry-title',
				),
			),
		) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'typography',
            'settings'    => 'typography_homepage_title',
            'label'       => esc_attr__( 'Home Page Titles', 'paintingpixels' ),
            'section'     => 'section_typography',
            'default'     => array(
                'font-family'    => 'Open Sans',
                'variant'        => 'regular',
                'font-size'      => '1.6rem',
                'line-height'    => '1.5',
                'letter-spacing' => '0',
                'color'          => '#000',
                'text-transform' => 'none',
                'text-align'     => 'center'
            ),
            'priority'    => 10,
            'output'      => array(
                array(
                    'element' => '.home section>div>header h2',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'typography',
            'settings'    => 'typography_header_menu',
            'label'       => esc_attr__( 'Header menu', 'paintingpixels' ),
            'section'     => 'section_typography',
            'default'     => array(
                'font-family'    => 'Open Sans',
                'variant'        => 'regular',
                'font-size'      => '0.9rem',
                'line-height'    => '1',
                'letter-spacing' => '0',
                'text-transform' => 'none'
            ),
            'priority'    => 10,
            'output'      => array(
                array(
                    'element' => '.top-bar .menu a, .header-menu-top a',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'typography',
            'settings'    => 'typography_mobile_menu',
            'label'       => esc_attr__( 'Mobile menu', 'paintingpixels' ),
            'section'     => 'section_typography',
            'default'     => array(
                'font-family'    => 'Open Sans',
                'variant'        => 'regular',
                'font-size'      => '0.9rem',
                'line-height'    => '1',
                'letter-spacing' => '0',
                'text-transform' => 'none'
            ),
            'priority'    => 10,
            'output'      => array(
                array(
                    'element' => '.off-canvas .menu a',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'typography',
            'settings'    => 'typography_services_grid_title',
            'label'       => esc_attr__( 'Services grid titles', 'paintingpixels' ),
            'section'     => 'section_typography',
            'default'     => array(
                'font-family'    => 'Open Sans',
                'variant'        => 'regular',
                'font-size'      => '1rem',
                'line-height'    => '1',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'text-align' => 'center'
            ),
            'priority'    => 10,
            'output'      => array(
                array(
                    'element' => '.service-title a',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'typography',
            'settings'    => 'typography_services_widget_title',
            'label'       => esc_attr__( 'Widget titles', 'paintingpixels' ),
            'section'     => 'section_typography',
            'default'     => array(
                'font-family'    => 'Open Sans',
                'variant'        => 'regular',
                'font-size'      => '1.2rem',
                'line-height'    => '1',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'text-align' => 'left'
            ),
            'priority'    => 10,
            'output'      => array(
                array(
                    'element' => '.sidebar .widgettitle, .home section .widgettitle',
                ),
            ),
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'typography',
            'settings'    => 'typography_footer_widget_title',
            'label'       => esc_attr__( 'Footer widget titles', 'paintingpixels' ),
            'section'     => 'section_typography',
            'default'     => array(
                'font-family'    => 'Open Sans',
                'variant'        => 'regular',
                'font-size'      => '1.2rem',
                'line-height'    => '1.2',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'text-align' => 'left'
            ),
            'priority'    => 10,
            'output'      => array(
                array(
                    'element' => '#footer h4',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'typography',
            'settings'    => 'typography_footer_text',
            'label'       => esc_attr__( 'Footer text', 'paintingpixels' ),
            'section'     => 'section_typography',
            'default'     => array(
                'font-family'    => 'Open Sans',
                'variant'        => 'regular',
                'font-size'      => '1rem',
                'line-height'    => '1',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'text-align' => 'left'
            ),
            'priority'    => 10,
            'output'      => array(
                array(
                    'element' => '#footer, #footer p',
                ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'typography',
            'settings'    => 'typography_footer_bottom_text',
            'label'       => esc_attr__( 'Footer bottom text', 'paintingpixels' ),
            'description'       => esc_attr__( 'Text underneath widgets', 'paintingpixels' ),
            'section'     => 'section_typography',
            'default'     => array(
                'font-family'    => 'Open Sans',
                'variant'        => 'regular',
                'font-size'      => '1rem',
                'line-height'    => '1',
                'letter-spacing' => '0',
                'text-transform' => 'none',
                'text-align' => 'left'
            ),
            'priority'    => 10,
            'output'      => array(
                array(
                    'element' => '#footer .footer2, #footer .footer2 p',
                ),
            ),
        ) );


        /**
         * Layout
         */

        PP_Theme_Kirki::add_panel( 'panel_layout', array(
		    'priority'    => 10,
		    'title'       => __( 'Layout', 'paintingpixels' ),
		    'description' => __( 'Website layout', 'paintingpixels' ),
		) );


		PP_Theme_Kirki::add_section( 'section_layout_header', array(
            'title'          => __( 'Header Layout' ),
            'panel'          => 'panel_layout',
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'select',
            'settings'    => 'header_layout',
            'label'       => __( 'Header layout', 'paintingpixels' ),
            'section'     => 'section_layout_header',
            'default'     => 'default',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => array(
                'default'      => esc_attr__( 'Default', 'paintingpixels' ),
                'woocommerce1' => esc_attr__( 'WooCommerce 1', 'paintingpixels' ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'select',
            'settings'    => 'header_layout_mobile',
            'label'       => __( 'Header layout (mobile)', 'paintingpixels' ),
            'section'     => 'section_layout_header',
            'default'     => 'default',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => array(
                'default'      => esc_attr__( 'Default', 'paintingpixels' ),
                'woocommerce1' => esc_attr__( 'WooCommerce 1', 'paintingpixels' ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'     => 'text',
            'settings' => 'header_hamburger_menu_text_right',
            'label'    => __( 'Menu Button Text', 'paintingpixels' ),
            'description'    => __( 'Next to hamburger menu', 'paintingpixels' ),
            'section'  => 'section_layout_header',
            'default'  => esc_attr__( 'MENU', 'paintingpixels' ),
            'priority' => 10,
        ) );

        /* Blog layout */

        PP_Theme_Kirki::add_section( 'section_layout_blog', array(
            'title'          => __( 'Blog Layout' ),
            'panel'          => 'panel_layout',
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'select',
            'settings'    => 'blog_layout',
            'label'       => __( 'Blog layout', 'paintingpixels' ),
            'section'     => 'section_layout_blog',
            'default'     => 'classic',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => array(
                'classic'                      => esc_attr__( 'Classic', 'paintingpixels' ),
                'grid'                         => esc_attr__( 'Grid', 'paintingpixels' ),
                'grid-full-width'              => esc_attr__( 'Grid (full width)', 'paintingpixels' ),
                'cards'                        => esc_attr__( 'Cards', 'paintingpixels' ),
                'cards-full-width'             => esc_attr__( 'Cards (full width)', 'paintingpixels' ),
                'list-medium-image'            => esc_attr__( 'List medium image', 'paintingpixels' ),
                'list-medium-image-full-width' => esc_attr__( 'List medium image (full width)', 'paintingpixels' ),
                'list-large-image'             => esc_attr__( 'List large image', 'paintingpixels' ),
                'list-large-image-full-width'  => esc_attr__( 'List large image (full width)', 'paintingpixels' ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'select',
            'settings'    => 'blog_layout_card_style',
            'label'       => __( 'Blog layout', 'paintingpixels' ),
            'section'     => 'section_layout_blog',
            'default'     => 'material',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => array(
                'material' => esc_attr__( 'Material', 'paintingpixels' ),
                'flat' => esc_attr__( 'Flat', 'paintingpixels' )
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'select',
            'settings'    => 'home_blog_layout',
            'label'       => __( 'Blog layout on Home Page', 'paintingpixels' ),
            'section'     => 'section_layout_blog',
            'default'     => 'grid',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => array(
                'grid' => esc_attr__( 'Grid', 'paintingpixels' ),
                'cards' => esc_attr__( 'Cards', 'paintingpixels' )
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'repeater',
            'label'       => esc_attr__( 'Entry meta header', 'paintingpixels' ),
            'section'     => 'section_layout_blog',
            'priority'    => 10,
            'row_label' => array(
                'type'  => 'field',
                'value' => esc_attr__('Entry Meta', 'paintingpixels' ),
                'field' => 'entry_meta'
            ),
            'settings'    => 'entry_meta_header',
            'default'     => array(
                array(
                    'entry_meta' => 'date',
                    'prefix'  => '',
                ),
                array(
                    'entry_meta' => 'author',
                    'link_url'  => '',
                ),
            ),
            'fields' => array(
                'entry_meta' => array(
                    'type'        => 'select',
                    'label'       => esc_attr__( 'Entry Meta', 'paintingpixels' ),
                    'choices'     => array(
                        'date' => esc_attr__( 'Date', 'paintingpixels' ),
                        'author' => esc_attr__( 'Author', 'paintingpixels' ),
                        'categories' => esc_attr__( 'Categories', 'paintingpixels' ),
                        'tags' => esc_attr__( 'Tags', 'paintingpixels' )
                        )
                ),
                'prefix' => array(
                    'type'        => 'text',
                    'label'       => esc_attr__( 'Prefix', 'paintingpixels' ),
                    'default'     => '',
                ),
                'sufix' => array(
                    'type'        => 'text',
                    'label'       => esc_attr__( 'Sufix', 'paintingpixels' ),
                    'default'     => '',
                ),
            )
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'repeater',
            'label'       => esc_attr__( 'Entry meta footer', 'paintingpixels' ),
            'section'     => 'section_layout_blog',
            'priority'    => 10,
            'row_label' => array(
                'type'  => 'field',
                'value' => esc_attr__('Entry Meta', 'paintingpixels' ),
                'field' => 'entry_meta'
            ),
            'settings'    => 'entry_meta_footer',
            'default'     => array(
                array(
                    'entry_meta' => 'categories',
                    'prefix' => '',
                    'suffix' => ''
                ),
                array(
                    'entry_meta' => 'tags',
                    'prefix' => '',
                    'suffix' => ''
                ),
            ),
            'fields' => array(
                'entry_meta' => array(
                    'type'        => 'select',
                    'label'       => esc_attr__( 'Entry Meta', 'paintingpixels' ),
                    'choices'     => array(
                        'date' => esc_attr__( 'Date', 'paintingpixels' ),
                        'author' => esc_attr__( 'Author', 'paintingpixels' ),
                        'categories' => esc_attr__( 'Categories', 'paintingpixels' ),
                        'tags' => esc_attr__( 'Tags', 'paintingpixels' )
                        )
                ),
                'prefix' => array(
                    'type'        => 'text',
                    'label'       => esc_attr__( 'Prefix', 'paintingpixels' ),
                    'default'     => '',
                ),
                'sufix' => array(
                    'type'        => 'text',
                    'label'       => esc_attr__( 'Suffix', 'paintingpixels' ),
                    'default'     => '',
                ),
            )
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'number',
            'settings'    => 'blog_layout_excerpt_words',
            'label'       => esc_attr__( 'No of words to show in excerpt', 'paintingpixels' ),
            'section'     => 'section_layout_blog',
            'default'     => '20',
            'choice'      => array(
                'min'   =>  1,
                'max'   =>  100,
                'step'  =>  1
                )
        ) );


        /* Home page */

        PP_Theme_Kirki::add_section( 'homepage_sections', array(
            'title'          => __( 'Home page layout' ),
            'panel'          => 'panel_layout',
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'repeater',
            'label'       => esc_attr__( 'Homepage sections', 'paintingpixels' ),
            'section'     => 'homepage_sections',
            'priority'    => 10,
            'row_label' => array(
                'type'  => 'field',
                'value' => esc_attr__('template', 'paintingpixels' ),
                'field' => 'title'
            ),
            'settings'    => 'frontpage_sections',
            'default'     => array(),
            'fields' => array(
                'title' => array(
                    'type'        => 'text',
                    'label'       => esc_attr__( 'Section title', 'paintingpixels' ),
                    'description' => esc_attr__( '', 'paintingpixels' ),
                    'default'     => '',
                ),
                'template' => array(
                    'type'        => 'select',
                    'label'       => esc_attr__( 'Section template', 'paintingpixels' ),
                    'description' => esc_attr__( '', 'paintingpixels' ),
                    'default'     => '',
                    'choices'     => $this->homepage_sections_template_choices()
                ),
                'text_before_content' => array(
                    'type'        => 'textarea',
                    'label'       => esc_attr__( 'Text before content', 'paintingpixels' ),
                    'description' => esc_attr__( '', 'paintingpixels' ),
                    'default'     => '',
                ),
                'text_after_content' => array(
                    'type'        => 'textarea',
                    'label'       => esc_attr__( 'Text after content', 'paintingpixels' ),
                    'description' => esc_attr__( '', 'paintingpixels' ),
                    'default'     => '',
                ),
                'background_color' => array(
                    'type'        => 'color',
                    'label'       => esc_attr__( 'Background colour', 'paintingpixels' ),
                    'description' => esc_attr__( '', 'paintingpixels' ),
                    'default'     => '#ffffff',
                    'alpha'       => 'true',
                    'transport'   => 'auto',
                    /*'output' => array(
                        array(
                            'element'  => '#section' . esc_attr__('template', 'paintingpixels' ),
                            'property' => 'background',
                        ),
                    ),*/
                ),
                'title_color' => array(
                    'type'        => 'color',
                    'label'       => esc_attr__( 'Title colour', 'paintingpixels' ),
                    'description' => esc_attr__( '', 'paintingpixels' ),
                    'default'     => '#000000',
                    'alpha'       => 'true',
                    'transport'   => 'auto',
                    /*'output' => array(
                        array(
                            'element'  => '#section' . esc_attr__('template', 'paintingpixels' ) . ' header h2',
                            'property' => 'color',
                        ),
                    ),*/
                ),
                'text_color' => array(
                    'type'        => 'color',
                    'label'       => esc_attr__( 'Text colour', 'paintingpixels' ),
                    'description' => esc_attr__( '', 'paintingpixels' ),
                    'default'     => '#000000',
                    'alpha'       => 'true',
                    'transport'   => 'auto',
                ),
                'title_style' => array(
                    'type'        => 'select',
                    'label'       => esc_attr__( 'Title style', 'paintingpixels' ),
                    'description' => esc_attr__( '', 'paintingpixels' ),
                    'default'     => '',
                    'choices'     => array(
                        'normal' => esc_attr__( 'Normal', 'paintingpixels' ),
                        'line_on_sides' => esc_attr__( 'Line on sides', 'paintingpixels' )
                    ),
                ),
                'title_line_on_sides_color' => array(
                    'type'        => 'color',
                    'label'       => esc_attr__( 'Line on sides of title colour', 'paintingpixels' ),
                    'description' => esc_attr__( '', 'paintingpixels' ),
                    'default'     => '#ffffff',
                    'alpha'       => 'true',
                    'transport'   => 'auto',
                    'output' => array(
                        array(
                            'element'  => '#section' . esc_attr__('template', 'paintingpixels' ) . ' header h2:before',
                            'property' => 'background',
                        ),
                    ),
                ),
            )
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'number',
            'settings'    => 'homepage_services_no',
            'label'       => esc_attr__( 'No of services to show in Services section', 'paintingpixels' ),
            'section'     => 'homepage_sections',
            'default'     => '4',
            'choice'      => array(
                'min'   =>  1,
                'max'   =>  100,
                'step'  =>  1
                )
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'number',
            'settings'    => 'homepage_services_per_line_mobile',
            'label'       => esc_attr__( 'No of services to show per line in Services section (Mobile screens)', 'paintingpixels' ),
            'section'     => 'homepage_sections',
            'default'     => '1',
            'choice'      => array(
                'min'   =>  1,
                'max'   =>  100,
                'step'  =>  1
                )
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'number',
            'settings'    => 'homepage_services_per_line_tablet',
            'label'       => esc_attr__( 'No of services to show per line in Services section (Tablet screens)', 'paintingpixels' ),
            'section'     => 'homepage_sections',
            'default'     => '2',
            'choice'      => array(
                'min'   =>  1,
                'max'   =>  100,
                'step'  =>  1
                )
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'number',
            'settings'    => 'homepage_services_per_line_desktop',
            'label'       => esc_attr__( 'No of services to show per line in Services section (Desktop screens)', 'paintingpixels' ),
            'section'     => 'homepage_sections',
            'default'     => '4',
            'choice'      => array(
                'min'   =>  1,
                'max'   =>  100,
                'step'  =>  1
                )
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'number',
            'settings'    => 'homepage_blog_posts_no',
            'label'       => esc_attr__( 'Total number of posts to show in Blog section', 'paintingpixels' ),
            'section'     => 'homepage_sections',
            'default'     => '6',
            'choice'      => array(
                'min'   =>  1,
                'max'   =>  100,
                'step'  =>  1
                ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'number',
            'settings'    => 'homepage_blog_posts_per_line_mobile',
            'label'       => esc_attr__( 'No of posts to show per line in Blog section (Mobile screens)', 'paintingpixels' ),
            'section'     => 'homepage_sections',
            'default'     => '1',
            'choice'      => array(
                'min'   =>  1,
                'max'   =>  100,
                'step'  =>  1
                )
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'number',
            'settings'    => 'homepage_blog_posts_per_line_tablet',
            'label'       => esc_attr__( 'No of posts to show per line in Blog section (Tablet screens)', 'paintingpixels' ),
            'section'     => 'homepage_sections',
            'default'     => '2',
            'choice'      => array(
                'min'   =>  1,
                'max'   =>  100,
                'step'  =>  1
                )
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'number',
            'settings'    => 'homepage_blog_posts_per_line_desktop',
            'label'       => esc_attr__( 'No of posts to show per line in Blog section (Desktop screens)', 'paintingpixels' ),
            'section'     => 'homepage_sections',
            'default'     => '3',
            'choice'      => array(
                'min'   =>  1,
                'max'   =>  100,
                'step'  =>  1
                )
        ) );


        PP_Theme_Kirki::add_section( 'homepage_widget_areas', array(
            'title'          => __( 'Home page widget areas' ),
            'panel'          => 'panel_layout',
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );


        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'repeater',
            'label'       => esc_attr__( 'Homepage widget areas', 'paintingpixels' ),
            'section'     => 'homepage_widget_areas',
            'priority'    => 10,
            'row_label' => array(
                'type'  => 'field',
                'value' => esc_attr__('widget_area', 'paintingpixels' ),
                'field' => 'title'
            ),
            'settings'    => 'frontpage_widget_areas',
            'default'     => array(),
            'fields' => array(
                'title' => array(
                    'type'        => 'text',
                    'label'       => esc_attr__( 'Widget area title', 'paintingpixels' ),
                    'description' => esc_attr__( '', 'paintingpixels' ),
                    'default'     => 'Widget Area',
                ),
                'wrapper_css_class' => array(
                    'type'        => 'text',
                    'label'       => esc_attr__( 'Widget area CSS class', 'paintingpixels' ),
                    'description' => esc_attr__( '', 'paintingpixels' ),
                    'default'     => 'grid-x grid-padding-x grid-padding-y small-up-1 medium-up-3 large-up-3',
                ),
            )
        ) );


        /* Services */

        PP_Theme_Kirki::add_section( 'section_layout_services', array(
            'title'          => __( 'Services Layout' ),
            'panel'          => 'panel_layout',
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'select',
            'settings'    => 'services_layout',
            'label'       => __( 'Services layout', 'paintingpixels' ),
            'section'     => 'section_layout_services',
            'default'     => 'title-overlay-image',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => array(
                'title-overlay-image' => esc_attr__( 'Title Overlay Image', 'paintingpixels' ),
                'title-image-excerpt1' => esc_attr__( 'Title, Image, Excerpt 1', 'paintingpixels' ),
                'title-image-excerpt2' => esc_attr__( 'Title, Image, Excerpt 2', 'paintingpixels' )
            ),
        ) );

        /* Footer */

        PP_Theme_Kirki::add_section( 'section_footer', array(
            'title'          => __( 'Footer' ),
            'panel'          => 'panel_layout',
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'     => 'text',
            'settings' => 'footer_copyright',
            'label'    => __( 'Copyright', 'paintingpixels' ),
            'section'  => 'section_footer',
            'default'  => esc_attr__( '', 'paintingpixels' ),
            'priority' => 10,
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'     => 'text',
            'settings' => 'footer_tel',
            'label'    => __( 'Phone', 'paintingpixels' ),
            'section'  => 'section_footer',
            'default'  => esc_attr__( '', 'paintingpixels' ),
            'priority' => 10,
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'     => 'text',
            'settings' => 'footer_email',
            'label'    => __( 'Email', 'paintingpixels' ),
            'section'  => 'section_footer',
            'default'  => esc_attr__( '', 'paintingpixels' ),
            'priority' => 10,
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'editor',
            'settings'    => 'footer_additional_info',
            'label'       => __( 'Additional Information', 'paintingpixels' ),
            'description' => __( 'For example: VAT number and/or company number', 'paintingpixels' ),
            'section'     => 'section_footer',
            'default'     => esc_html__( '', 'paintingpixels' ),
            'priority'    => 10,
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
			'type'        => 'repeater',
			'label'       => esc_attr__( 'Footer social icons', 'paintingpixels' ),
			'section'     => 'section_footer',
			'priority'    => 10,
			'row_label' => array(
				'type'  => 'field',
				'value' => esc_attr__('social network icon', 'paintingpixels' ),
				'field' => 'social_network'
			),
			'settings'    => 'section_footer_social_icons',
			'default'     => array(
				array(
					'social_network' => esc_attr__( 'Facebook', 'paintingpixels' ),
					'link_url'  => 'https://facebook.com',
				),
				array(
					'social_network' => esc_attr__( 'Twitter', 'paintingpixels' ),
					'link_url'  => 'https://twitter.com',
				),
			),
			'fields' => array(
				'social_network' => array(
					'type'        => 'select',
					'label'       => esc_attr__( 'Social Network', 'paintingpixels' ),
					'description' => esc_attr__( 'This will be the label for your link', 'my_textdomain' ),
					//'default'     => 'facebook',
					//'multiple'    => 1,
					'choices'     => array(
						'facebook' => esc_attr__( 'Facebook', 'paintingpixels' ),
						'twitter' => esc_attr__( 'Twitter', 'paintingpixels' ),
						'googleplus' => esc_attr__( 'Google+', 'paintingpixels' ),
						'linkedin' => esc_attr__( 'LinkedIn', 'paintingpixels' ),
						'instagram' => esc_attr__( 'Instagram', 'paintingpixels' ),
						'pinterest' => esc_attr__( 'Pinterest', 'paintingpixels' ),
						)
				),
				'link_url' => array(
					'type'        => 'text',
					'label'       => esc_attr__( 'Link URL', 'paintingpixels' ),
					'description' => esc_attr__( 'Add link to social media profile', 'paintingpixels' ),
					'default'     => '',
				),
			)
		) );

			/* Images */

			PP_Theme_Kirki::add_section( 'section_images', array(
            'title'          => __( 'Images' ),
            'description'		=>	esc_attr__( 'Note: Existing media library images are not automatically resized. You will need to use an image resizer plugin to regenerate the images to the new sizes.' ),
            'panel'          => 'panel_layout',
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );

			PP_Theme_Kirki::add_field( 'pp_theme', array(
				'type'        => 'number',
				'settings'    => 'services_thumbnail_width',
				'label'       => esc_attr__( 'Services thumbnail width', 'paintingpixels' ),
				'section'     => 'section_images',
				'default'     => 370,
				'choices'     => array(
					'min'  => 0,
					'max'  => 10000,
					'step' => 1,
				),
			) );

			PP_Theme_Kirki::add_field( 'pp_theme', array(
				'type'        => 'number',
				'settings'    => 'services_thumbnail_height',
				'label'       => esc_attr__( 'Services thumbnail height', 'paintingpixels' ),
				'section'     => 'section_images',
				'default'     => 250,
				'choices'     => array(
					'min'  => 0,
					'max'  => 10000,
					'step' => 1,
				),
			) );

			PP_Theme_Kirki::add_field( 'pp_theme', array(
				'type'        => 'checkbox',
				'settings'    => 'services_thumbnail_cropped',
				'label'       => esc_attr__( 'Crop services thumbnail to exact dimensions (normally thumbnails are proportional)', 'paintingpixels' ),
				'section'     => 'section_images',
				'default'     => '1',
				'priority'    => 10,
			) );


			PP_Theme_Kirki::add_field( 'pp_theme', array(
				'type'        => 'number',
				'settings'    => 'banner_image_width',
				'label'       => esc_attr__( 'Banner image width', 'paintingpixels' ),
				'section'     => 'section_images',
				'default'     => 1200,
				'choices'     => array(
					'min'  => 0,
					'max'  => 10000,
					'step' => 1,
				),
			) );

			PP_Theme_Kirki::add_field( 'pp_theme', array(
				'type'        => 'number',
				'settings'    => 'banner_image_height',
				'label'       => esc_attr__( 'Banner image height', 'paintingpixels' ),
				'section'     => 'section_images',
				'default'     => 400,
				'choices'     => array(
					'min'  => 0,
					'max'  => 10000,
					'step' => 1,
				),
			) );

			PP_Theme_Kirki::add_field( 'pp_theme', array(
				'type'        => 'checkbox',
				'settings'    => 'banner_image_cropped',
				'label'       => esc_attr__( 'Crop banner image to exact dimensions (normally images are proportional)', 'paintingpixels' ),
				'section'     => 'section_images',
				'default'     => '1',
				'priority'    => 10,
			) );

			PP_Theme_Kirki::add_field( 'pp_theme', array(
				'type'        => 'number',
				'settings'    => 'orbit_image_width',
				'label'       => esc_attr__( 'Orbit Slider image width', 'paintingpixels' ),
				'section'     => 'section_images',
				'default'     => 1200,
				'choices'     => array(
					'min'  => 0,
					'max'  => 10000,
					'step' => 1,
				),
			) );

			PP_Theme_Kirki::add_field( 'pp_theme', array(
				'type'        => 'number',
				'settings'    => 'orbit_image_height',
				'label'       => esc_attr__( 'Orbit Slider image height', 'paintingpixels' ),
				'section'     => 'section_images',
				'default'     => 400,
				'choices'     => array(
					'min'  => 0,
					'max'  => 10000,
					'step' => 1,
				),
			) );

			PP_Theme_Kirki::add_field( 'pp_theme', array(
				'type'        => 'checkbox',
				'settings'    => 'orbit_image_cropped',
				'label'       => esc_attr__( 'Crop Orbit Slider image to exact dimensions (normally images are proportional)', 'paintingpixels' ),
				'section'     => 'section_images',
				'default'     => '1',
				'priority'    => 10,
			) );

			PP_Theme_Kirki::add_field( 'pp_theme', array(
				'type'        => 'number',
				'settings'    => 'teammember_thumbnail_width',
				'label'       => esc_attr__( 'Team Member thumbnail width', 'paintingpixels' ),
				'section'     => 'section_images',
				'default'     => 370,
				'choices'     => array(
					'min'  => 0,
					'max'  => 10000,
					'step' => 1,
				),
			) );

			PP_Theme_Kirki::add_field( 'pp_theme', array(
				'type'        => 'number',
				'settings'    => 'teammember_thumbnail_height',
				'label'       => esc_attr__( 'Team Member thumbnail height', 'paintingpixels' ),
				'section'     => 'section_images',
				'default'     => 250,
				'choices'     => array(
					'min'  => 0,
					'max'  => 10000,
					'step' => 1,
				),
			) );

			PP_Theme_Kirki::add_field( 'pp_theme', array(
				'type'        => 'checkbox',
				'settings'    => 'teammember_thumbnail_cropped',
				'label'       => esc_attr__( 'Crop Team Member thumbnail to exact dimensions (normally thumbnails are proportional)', 'paintingpixels' ),
				'section'     => 'section_images',
				'default'     => '1',
				'priority'    => 10,
			) );

        /* Enable/Disable features */

        PP_Theme_Kirki::add_section( 'section_features', array(
            'title'          => __( 'Enable/Disable Features' ),
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'switch',
            'settings'    => 'cpt_orbit',
            'label'       => __( 'Orbit Slider', 'paintingpixels' ),
            'section'     => 'section_features',
            'default'     => '1',
            'priority'    => 10,
            'choices'     => array(
                'on'  => esc_attr__( 'Enabled', 'paintingpixels' ),
                'off' => esc_attr__( 'Disabled', 'paintingpixels' ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'switch',
            'settings'    => 'cpt_services',
            'label'       => __( 'Services', 'paintingpixels' ),
            'section'     => 'section_features',
            'default'     => '1',
            'priority'    => 10,
            'choices'     => array(
                'on'  => esc_attr__( 'Enabled', 'paintingpixels' ),
                'off' => esc_attr__( 'Disabled', 'paintingpixels' ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'switch',
            'settings'    => 'cpt_testimonials',
            'label'       => __( 'Testimonials', 'paintingpixels' ),
            'section'     => 'section_features',
            'default'     => '1',
            'priority'    => 10,
            'choices'     => array(
                'on'  => esc_attr__( 'Enabled', 'paintingpixels' ),
                'off' => esc_attr__( 'Disabled', 'paintingpixels' ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'switch',
            'settings'    => 'cpt_team',
            'label'       => __( 'Team Members', 'paintingpixels' ),
            'section'     => 'section_features',
            'default'     => '1',
            'priority'    => 10,
            'choices'     => array(
                'on'  => esc_attr__( 'Enabled', 'paintingpixels' ),
                'off' => esc_attr__( 'Disabled', 'paintingpixels' ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'switch',
            'settings'    => 'cpt_videos',
            'label'       => __( 'Videos', 'paintingpixels' ),
            'section'     => 'section_features',
            'default'     => '1',
            'priority'    => 10,
            'choices'     => array(
                'on'  => esc_attr__( 'Enabled', 'paintingpixels' ),
                'off' => esc_attr__( 'Disabled', 'paintingpixels' ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'switch',
            'settings'    => 'responsive_embed',
            'label'       => __( 'Responsive Embed', 'paintingpixels' ),
            'section'     => 'section_features',
            'default'     => '1',
            'priority'    => 10,
            'choices'     => array(
                'on'  => esc_attr__( 'Enabled', 'paintingpixels' ),
                'off' => esc_attr__( 'Disabled', 'paintingpixels' ),
            ),
        ) );


        /* Analytics */

        PP_Theme_Kirki::add_section( 'section_analytics', array(
            'title'          => __( 'Analytics' ),
            'description'    => __( 'Add analytics tracking codes' ),
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'     => 'text',
            'settings' => 'google_analytics',
            'label'    => __( 'Google Analytics tracking code', 'paintingpixels' ),
            'description' => 'e.g. UA-xxxxxxxx-1',
            'section'  => 'section_analytics',
            'default'  => esc_attr__( '', 'paintingpixels' ),
            'priority' => 10,
        ) );

        /* WooCommerce */

        PP_Theme_Kirki::add_section( 'section_woocommerce_misc', array(
            'title'          => __( 'Miscellaneous' ),
            'panel' => 'woocommerce',
            'priority'       => 160,
            'capability'     => 'edit_theme_options',
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'checkbox',
            'settings'    => 'woocommerce_display_sku',
            'label'       => __( 'Display SKU', 'paintingpixels' ),
            'section'     => 'section_woocommerce_misc',
            'default'     => '1',
            'priority'    => 10,
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'select',
            'settings'    => 'woocommerce_filter_display',
            'label'       => __( 'Display filter', 'my_textdomain' ),
            'section'     => 'section_woocommerce_misc',
            'default'     => 'tablet',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => array(
                'mobile' => esc_attr__( 'Show for mobile only', 'paintingpixels' ),
                'tablet' => esc_attr__( 'Show for mobiles and tablets only', 'paintingpixels' ),
                'desktop' => esc_attr__( 'Show for desktop only', 'paintingpixels' ),
                'all' => esc_attr__( 'Show for all screen sizes', 'paintingpixels' ),
            ),
        ) );

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'select',
            'settings'    => 'woocommerce_sidebar_display',
            'label'       => __( 'Display sidebar', 'my_textdomain' ),
            'section'     => 'section_woocommerce_misc',
            'default'     => 'tablet',
            'priority'    => 10,
            'multiple'    => 1,
            'choices'     => array(
                'mobile' => esc_attr__( 'Show for mobile only', 'paintingpixels' ),
                'tablet' => esc_attr__( 'Show for mobiles and tablets only', 'paintingpixels' ),
                'desktop' => esc_attr__( 'Show for desktop only', 'paintingpixels' ),
                'all' => esc_attr__( 'Show for all screen sizes', 'paintingpixels' ),
            ),
        ) );


        /* Custom admin  */

        PP_Theme_Kirki::add_field( 'pp_theme', array(
            'type'        => 'image',
            'settings'    => 'admin_login_logo',
            'label'       => __( 'Custom Admin logo', 'paintingpixels' ),
            'description' => __( 'Displayed when user logs in', 'paintingpixels' ),
            'section'     => 'title_tagline',
            'default'     => '',
            'priority'    => 10,
        ) );

    }

    private function homepage_sections_template_choices() {
        $choices = array (
            '' => esc_attr__( 'None', 'paintingpixels' ),
            'welcome' => esc_attr__( 'Welcome', 'paintingpixels' ),
            'services' => esc_attr__( 'Services', 'paintingpixels' ),
            'blog' => esc_attr__( 'Blog', 'paintingpixels' ),
        );
        if ( class_exists( 'WooCommerce' ) ) {
            $choices = array_merge($choices, array(
                'featured_products' => esc_attr__( 'Featured products', 'paintingpixels' ),
                'product_categories' => esc_attr__( 'Product categories', 'paintingpixels' ),
                'recent_products' => esc_attr__( 'Recent products', 'paintingpixels' ),
                'popular_products' => esc_attr__( 'Popular products', 'paintingpixels' ),
                'on_sale_products' => esc_attr__( 'On sale products', 'paintingpixels' )
                )
            );
        }
        $homepage_widget_areas = get_theme_mod( 'frontpage_widget_areas', array() );
        foreach ($homepage_widget_areas as $key=>$widget_area) {
            $widget_id = str_replace("_", " ", strtolower( $widget_area['title'] ));
            $choices = array_merge($choices, array(
                $widget_id => $widget_area['title']
                )
            );
        };
        return $choices;
    }

}
new pptheme_Theme_Customizer();
