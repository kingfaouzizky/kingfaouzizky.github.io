<?php
/**
 * Design
 *
 * @package Squaretype
 */

CSCO_Kirki::add_section(
	'design',
	array(
		'title'    => esc_html__( 'Design', 'squaretype' ),
		'priority' => 20,
	)
);

/**
 * -------------------------------------------------------------------------
 * Colors
 * -------------------------------------------------------------------------
 */

CSCO_Kirki::add_section(
	'design_base',
	array(
		'title'    => esc_html__( 'design', 'squaretype' ),
		'panel'    => 'design',
		'priority' => 10,
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'        => 'collapsible',
		'settings'    => 'design_collapsible_palettes',
		'section'     => 'design',
		'label'       => esc_html__( 'Palettes', 'squaretype' ),
		'priority'    => 10,
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'     => 'presets',
		'settings' => 'theme_presets',
		'label'    => esc_html__( 'Color Palettes', 'squaretype' ),
		'section'  => 'design',
		'priority' => 10,
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'     => 'collapsible',
		'settings' => 'design_collapsible_dark_mode',
		'section'  => 'design',
		'label'    => esc_html__( 'Dark Mode', 'squaretype' ),
		'priority' => 10,
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'     => 'checkbox',
		'settings' => 'color_enable_dark_mode',
		'label'    => esc_html__( 'Enable Dark Mode', 'squaretype' ),
		'section'  => 'design',
		'default'  => false,
		'priority' => 10,
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'            => 'radio',
		'settings'        => 'color_scheme',
		'label'           => esc_html__( 'Site Color Scheme', 'squaretype' ),
		'section'         => 'design',
		'default'         => 'system',
		'choices'         => array(
			'system' => esc_html__( 'User’s system preference', 'squaretype' ),
			'light'  => esc_html__( 'Light', 'squaretype' ),
			'dark'   => esc_html__( 'Dark', 'squaretype' ),
		),
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'color_enable_dark_mode',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'            => 'checkbox',
		'settings'        => 'color_scheme_toggle',
		'label'           => esc_html__( 'Enable dark/light mode toggle', 'squaretype' ),
		'section'         => 'design',
		'default'         => true,
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'color_enable_dark_mode',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'     => 'collapsible',
		'settings' => 'design_collapsible_common',
		'section'  => 'design',
		'label'    => esc_html__( 'Light Scheme', 'squaretype' ),
		'priority' => 10,
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'     => 'color',
		'settings' => 'color_primary',
		'label'    => esc_html__( 'Primary Color', 'squaretype' ),
		'section'  => 'design',
		'priority' => 10,
		'default'  => '#2E073B',
		'choices'  => array(
			'alpha' => true,
		),
		'output'   => array(
			array(
				'element'  => ':root, [data-scheme="default"]',
				'property' => '--cs-color-accent',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'     => 'color',
		'settings' => 'color_link',
		'label'    => esc_html__( 'Link Color', 'squaretype' ),
		'section'  => 'design',
		'priority' => 10,
		'default'  => '#2E073B',
		'choices'  => array(
			'alpha' => true,
		),
		'output'   => array(
			array(
				'element'  => ':root, [data-scheme="default"]',
				'property' => '--cs-color-link',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'      => 'color',
		'settings'  => 'color_overlay',
		'label'     => esc_html__( 'Overlay Color', 'squaretype' ),
		'section'   => 'design',
		'priority'  => 10,
		'default'   => 'rgba(0,0,0,0.25)',
		'transport' => 'auto',
		'choices'   => array(
			'alpha' => true,
		),
		'output'    => apply_filters(
			'csco_color_overlay',
			array(
				array(
					'element'  => ':root, [data-scheme="default"]',
					'property' => '--cs-color-overlay-background',
					'context'  => array( 'editor', 'front' ),
				),
			)
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'            => 'color',
		'settings'        => 'color_large_header_bg',
		'label'           => esc_html__( 'Header Background', 'squaretype' ),
		'section'         => 'design',
		'default'         => '#FFFFFF',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'large',
			),
		),
		'choices'         => array(
			'alpha' => true,
		),
		'output'          => array(
			array(
				'element'  => ':root, [data-site-scheme="default"]',
				'property' => '--cs-color-topbar-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'     => 'color',
		'settings' => 'color_navbar_bg',
		'label'    => esc_html__( 'Navigation Bar Background', 'squaretype' ),
		'section'  => 'design',
		'default'  => '#FFFFFF',
		'priority' => 10,
		'choices'  => array(
			'alpha' => true,
		),
		'output'   => array(
			array(
				'element'  => ':root, [data-site-scheme="default"]',
				'property' => '--cs-color-navbar-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'     => 'color',
		'settings' => 'color_navbar_submenu',
		'label'    => esc_html__( 'Navigation Submenu Background', 'squaretype' ),
		'section'  => 'design',
		'default'  => '#000000',
		'priority' => 10,
		'choices'  => array(
			'alpha' => true,
		),
		'output'   => array(
			array(
				'element'  => ':root, [data-site-scheme="default"]',
				'property' => '--cs-color-submenu-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'            => 'collapsible',
		'settings'        => 'design_collapsible_dark',
		'section'         => 'design',
		'label'           => esc_html__( 'Dark Scheme', 'squaretype' ),
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'color_enable_dark_mode',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'            => 'color',
		'settings'        => 'color_primary_dark',
		'label'           => esc_html__( 'Primary Color', 'squaretype' ),
		'section'         => 'design',
		'priority'        => 10,
		'default'         => '#000000',
		'choices'         => array(
			'alpha' => true,
		),
		'output'          => array(
			array(
				'element'  => '[data-scheme="dark"]',
				'property' => '--cs-color-accent',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_enable_dark_mode',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'            => 'color',
		'settings'        => 'color_link_dark',
		'label'           => esc_html__( 'Link Color', 'squaretype' ),
		'section'         => 'design',
		'priority'        => 10,
		'default'         => '#858585',
		'choices'         => array(
			'alpha' => true,
		),
		'output'          => array(
			array(
				'element'  => '[data-scheme="dark"]',
				'property' => '--cs-color-link',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_enable_dark_mode',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'            => 'color',
		'settings'        => 'color_overlay_dark',
		'label'           => esc_html__( 'Overlay Color', 'squaretype' ),
		'section'         => 'design',
		'priority'        => 10,
		'default'         => 'rgba(0,0,0,0.25)',
		'transport'       => 'auto',
		'choices'         => array(
			'alpha' => true,
		),
		'output'          => apply_filters(
			'csco_color_overlay',
			array(
				array(
					'element'  => '[data-scheme="dark"]',
					'property' => '--cs-color-overlay-background',
					'context'  => array( 'editor', 'front' ),
				),
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_enable_dark_mode',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'            => 'color',
		'settings'        => 'color_large_header_bg_dark',
		'label'           => esc_html__( 'Header Background', 'squaretype' ),
		'section'         => 'design',
		'priority'        => 10,
		'default'         => '#1c1c1c',
		'choices'         => array(
			'alpha' => true,
		),
		'output'          => array(
			array(
				'element'  => '[data-site-scheme="dark"]',
				'property' => '--cs-color-topbar-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_enable_dark_mode',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'large',
			),
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'            => 'color',
		'settings'        => 'color_navbar_bg_dark',
		'label'           => esc_html__( 'Navigation Bar Background', 'squaretype' ),
		'section'         => 'design',
		'priority'        => 10,
		'default'         => '#1c1c1c',
		'choices'         => array(
			'alpha' => true,
		),
		'output'          => array(
			array(
				'element'  => '[data-site-scheme="dark"]',
				'property' => '--cs-color-navbar-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_enable_dark_mode',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'            => 'color',
		'settings'        => 'color_navbar_submenu_dark',
		'label'           => esc_html__( 'Navigation Submenu Background', 'squaretype' ),
		'section'         => 'design',
		'default'         => '#000000',
		'priority'        => 10,
		'choices'         => array(
			'alpha' => true,
		),
		'output'          => array(
			array(
				'element'  => '[data-site-scheme="dark"]',
				'property' => '--cs-color-submenu-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_enable_dark_mode',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'     => 'collapsible',
		'settings' => 'design_collapsible_border_radius',
		'section'  => 'design',
		'label'    => esc_html__( 'Border Radius', 'squaretype' ),
		'priority' => 10,
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'              => 'dimension',
		'settings'          => 'design_border_radius',
		'label'             => esc_html__( 'Common', 'squaretype' ),
		'description'       => esc_html__( 'For example: 30px. If the input is empty, original value will be used.', 'squaretype' ),
		'section'           => 'design',
		'default'           => '0',
		'priority'          => 10,
		'sanitize_callback' => 'esc_html',
		'output'            => apply_filters(
			'csco_design_border_radius',
			array(
				array(
					'element'  => 'button, input[type="button"], input[type="reset"], input[type="submit"], .wp-block-button:not(.is-style-squared) .wp-block-button__link, .button, .pk-button, .pk-scroll-to-top, .cs-overlay .post-categories a, .site-search [type="search"], .subcategories .cs-nav-link, .post-header .pk-share-buttons-wrap .pk-share-buttons-link, .pk-dropcap-borders:first-letter, .pk-dropcap-bg-inverse:first-letter, .pk-dropcap-bg-light:first-letter, .widget-area .pk-subscribe-with-name input[type="text"], .widget-area .pk-subscribe-with-name button, .widget-area .pk-subscribe-with-bg input[type="text"], .widget-area .pk-subscribe-with-bg button, .footer-instagram .instagram-username, .adp-popup-type-notification-box .adp-popup-button, .adp-popup-type-notification-bar .adp-popup-button',
					'property' => 'border-radius',
				),
				array(
					'element'     => '.pk-subscribe-with-name input[type="text"], .pk-subscribe-with-bg input[type="text"]',
					'property'    => 'border-radius',
					'media_query' => '@media (max-width: 599px)',
				),
				array(
					'element'  => '.cs-input-group input[type="search"], .pk-subscribe-form-wrap input[type="text"]:first-child',
					'property' => 'border-top-left-radius',
				),
				array(
					'element'  => '.cs-input-group input[type="search"], .pk-subscribe-form-wrap input[type="text"]:first-child',
					'property' => 'border-bottom-left-radius',
				),
			)
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'              => 'dimension',
		'settings'          => 'design_submenu_border_radius',
		'label'             => esc_html__( 'Submenu', 'squaretype' ),
		'description'       => esc_html__( 'For example: 30px. If the input is empty, original value will be used.', 'squaretype' ),
		'section'           => 'design',
		'default'           => '0',
		'priority'          => 10,
		'sanitize_callback' => 'esc_html',
		'output'            => apply_filters(
			'csco_design_submenu_border_radius',
			array(
				array(
					'element'  => '.navbar-nav .sub-menu',
					'property' => 'border-radius',
				),
			)
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'              => 'dimension',
		'settings'          => 'design_preview_border_radius',
		'label'             => esc_html__( 'Preview Image', 'squaretype' ),
		'description'       => esc_html__( 'For example: 30px. If the input is empty, original value will be used.', 'squaretype' ),
		'section'           => 'design',
		'default'           => '0',
		'priority'          => 10,
		'sanitize_callback' => 'esc_html',
		'output'            => apply_filters(
			'csco_design_preview_border_radius',
			array(
				array(
					'element'  => '.post-media figure, .entry-thumbnail, .cs-post-thumbnail, .pk-overlay-thumbnail, .pk-post-thumbnail, .cs-hero-layout-boxed',
					'property' => 'border-radius',
				),
			)
		),
	)
);

CSCO_Kirki::add_field(
	'csco_theme_mod',
	array(
		'type'              => 'dimension',
		'settings'          => 'design_category_border_radius',
		'label'             => esc_html__( 'Category Label', 'squaretype' ),
		'description'       => esc_html__( 'For example: 30px. If the input is empty, original value will be used.', 'squaretype' ),
		'section'           => 'design',
		'default'           => '0',
		'priority'          => 10,
		'sanitize_callback' => 'esc_html',
		'output'            => apply_filters(
			'csco_design_category_border_radius',
			array(
				array(
					'element'  => '.meta-category .char',
					'property' => 'border-radius',
				),
			)
		),
	)
);
