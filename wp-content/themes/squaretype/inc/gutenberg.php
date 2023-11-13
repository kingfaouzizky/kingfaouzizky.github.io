<?php
/**
 * Gutenberg compatibility functions.
 *
 * @package Squaretype
 */

/**
 * Enqueue editor scripts
 */
function csco_block_editor_scripts() {
	wp_enqueue_script(
		'csco-editor-scripts',
		get_template_directory_uri() . '/jsx/editor-scripts.js',
		array(
			'wp-editor',
			'wp-element',
			'wp-compose',
			'wp-data',
			'wp-plugins',
		),
		csco_get_theme_data( 'Version' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'csco_block_editor_scripts' );

/**
 * Adds classes to <div class="editor-styles-wrapper"> tag
 */
function csco_block_editor_wrapper() {
	$post_id = get_the_ID();

	if ( ! $post_id ) {
		return;
	}

	// Set post type.
	$post_type = sprintf( 'post-type-%s', get_post_type( $post_id ) );

	// Set page layout.
	$default_layout = csco_get_page_sidebar( $post_id, 'default' );
	$page_layout    = csco_get_page_sidebar( $post_id, false );

	if ( 'disabled' === $default_layout ) {
		$default_layout = 'sidebar-disabled';
	} else {
		$default_layout = 'sidebar-enabled';
	}

	if ( 'disabled' === $page_layout ) {
		$page_layout = 'sidebar-disabled';
	} else {
		$page_layout = 'sidebar-enabled';
	}

	// Post Sidebar.
	if ( 'post' === get_post_type( $post_id ) && csco_powerkit_module_enabled( 'share_buttons' ) && powerkit_share_buttons_exists( 'post_sidebar' ) ) {
		$post_sidebar = 'post-sidebar-enabled';
	} else {
		$post_sidebar = 'post-sidebar-disabled';
	}

	wp_enqueue_script(
		'csco-editor-wrapper',
		get_template_directory_uri() . '/jsx/gutenberg-wrapper.js',
		array(
			'wp-editor',
			'wp-element',
			'wp-compose',
			'wp-data',
			'wp-plugins',
		),
		csco_get_theme_data( 'Version' ),
		true
	);

	wp_localize_script(
		'csco-editor-wrapper',
		'cscoGWrapper',
		array(
			'post_type'      => $post_type,
			'default_layout' => $default_layout,
			'page_layout'    => $page_layout,
			'post_sidebar'   => $post_sidebar,
		)
	);
}
add_action( 'enqueue_block_editor_assets', 'csco_block_editor_wrapper' );

/**
 * Change canvas breakpoints
 */
function csco_canvas_register_breakpoints() {
	return array(
		'mobile'  => 599,  // <= 599
		'tablet'  => 1019, // <= 1019
		'desktop' => 1020, // >= 1020
	);
}
add_filter( 'canvas_register_breakpoints', 'csco_canvas_register_breakpoints' );

/**
 * Change editor color palette.
 */
function csco_change_editor_color_palette() {
	// Editor Color Palette.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => esc_html__( 'Black', 'squaretype' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
			array(
				'name'  => esc_html__( 'Cyan bluish gray', 'squaretype' ),
				'slug'  => 'cyan-bluish-gray',
				'color' => '#abb8c3',
			),
			array(
				'name'  => esc_html__( 'White', 'squaretype' ),
				'slug'  => 'white',
				'color' => '#FFFFFF',
			),
			array(
				'name'  => esc_html__( 'Secondary', 'squaretype' ),
				'slug'  => 'secondary',
				'color' => '#f8f8f8',
			),
			array(
				'name'  => esc_html__( 'Pale pink', 'squaretype' ),
				'slug'  => 'pale-pink',
				'color' => '#f78da7',
			),
			array(
				'name'  => esc_html__( 'Vivid red', 'squaretype' ),
				'slug'  => 'vivid-red',
				'color' => '#ce2e2e',
			),
			array(
				'name'  => esc_html__( 'Luminous vivid orange', 'squaretype' ),
				'slug'  => 'luminous-vivid-orange',
				'color' => '#ff6900',
			),
			array(
				'name'  => esc_html__( 'Luminous vivid amber', 'squaretype' ),
				'slug'  => 'luminous-vivid-amber',
				'color' => '#fcb902',
			),
			array(
				'name'  => esc_html__( 'Light green cyan', 'squaretype' ),
				'slug'  => 'light-green-cyan',
				'color' => '#7bdcb5',
			),
			array(
				'name'  => esc_html__( 'Vivid green cyan', 'squaretype' ),
				'slug'  => 'vivid-green-cyan',
				'color' => '#01d083',
			),
			array(
				'name'  => esc_html__( 'Pale cyan blue', 'squaretype' ),
				'slug'  => 'pale-cyan-blue',
				'color' => '#8ed1fc',
			),
			array(
				'name'  => esc_html__( 'Vivid cyan blue', 'squaretype' ),
				'slug'  => 'vivid-cyan-blue',
				'color' => '#0693e3',
			),
			array(
				'name'  => esc_html__( 'Vivid purple', 'squaretype' ),
				'slug'  => 'vivid-purple',
				'color' => '#9b51e0',
			),
			array(
				'name'  => esc_html__( 'Gray 50', 'squaretype' ),
				'slug'  => 'gray-50',
				'color' => '#f8f9fa',
			),
			array(
				'name'  => esc_html__( 'Gray 100', 'squaretype' ),
				'slug'  => 'gray-100',
				'color' => '#f8f9fb',
			),
			array(
				'name'  => esc_html__( 'Gray 200', 'squaretype' ),
				'slug'  => 'gray-200',
				'color' => '#e9ecef',
			),
			array(
				'name'  => esc_html__( 'Secondary', 'squaretype' ),
				'slug'  => 'secondary',
				'color' => get_theme_mod( 'color_secondary', '#818181' ),
			),
		)
	);
}
add_action( 'after_setup_theme', 'csco_change_editor_color_palette' );


/**
 * Change settings of canvas sections
 *
 * @param array $blocks All registered blocks.
 */
function csco_change_settings_canvas_sections( $blocks ) {

	foreach ( $blocks as $key => $block ) {

		if ( 'canvas/section' === $block['name'] ) {
			$blocks[ $key ] = array_merge(
				$blocks[ $key ],
				array(
					'style'        => null,
					'editor_style' => null,
				)
			);
		}
	}

	return $blocks;
}
add_filter( 'canvas_register_block_type', 'csco_change_settings_canvas_sections', 999 );

/**
 * Add css selectors to output of kirki.
 */
add_filter(
	'csco_font_base',
	function( $rules ) {
		array_push(
			$rules,
			array(
				'element' => csco_implode(
					array(
						'.editor-styles-wrapper.cs-editor-styles-wrapper',
					)
				),
				'context' => array( 'editor' ),
			)
		);
		return $rules;
	}
);

add_filter(
	'csco_font_secondary',
	function( $rules ) {
		array_push(
			$rules,
			array(
				'element' => csco_implode(
					array(
						'.editor-styles-wrapper.cs-editor-styles-wrapper .post-meta',
						'.editor-styles-wrapper.cs-editor-styles-wrapper input[type="text"]',
						'.editor-styles-wrapper.cs-editor-styles-wrapper input[type="email"]',
						'.editor-styles-wrapper.cs-editor-styles-wrapper input[type="url"]',
						'.editor-styles-wrapper.cs-editor-styles-wrapper input[type="password"]',
						'.editor-styles-wrapper.cs-editor-styles-wrapper input[type="search"]',
						'.editor-styles-wrapper.cs-editor-styles-wrapper input[type="number"]',
						'.editor-styles-wrapper.cs-editor-styles-wrapper input[type="tel"]',
						'.editor-styles-wrapper.cs-editor-styles-wrapper input[type="range"]',
						'.editor-styles-wrapper.cs-editor-styles-wrapper input[type="date"]',
						'.editor-styles-wrapper.cs-editor-styles-wrapper input[type="month"]',
						'.editor-styles-wrapper.cs-editor-styles-wrapper input[type="week"]',
						'.editor-styles-wrapper.cs-editor-styles-wrapper input[type="time"]',
						'.editor-styles-wrapper.cs-editor-styles-wrapper input[type="datetime"]',
						'.editor-styles-wrapper.cs-editor-styles-wrapper input[type="datetime-local"]',
						'.editor-styles-wrapper.cs-editor-styles-wrapper input[type="color"]',
						'.editor-styles-wrapper.cs-editor-styles-wrapper select',
						'.editor-styles-wrapper.cs-editor-styles-wrapper textarea',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-quote cite',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-quote__citation',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-image figcaption',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-audio figcaption',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-embed figcaption',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-pullquote cite',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-pullquote footer',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-pullquote .wp-block-pullquote__citation',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .pk-font-secondary',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .abr-badge-primary',
					)
				),
				'context' => array( 'editor' ),
			)
		);
		return $rules;
	}
);

add_filter(
	'csco_font_primary',
	function( $rules ) {
		array_push(
			$rules,
			array(
				'element' => csco_implode(
					array(
						'.editor-styles-wrapper.cs-editor-styles-wrapper .button-primary',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .pk-font-primary',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-button .wp-block-button__link',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-button .abr-review-item .abr-review-name',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .cs-author-button',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .pk-subscribe-submit',
					)
				),
				'context' => array( 'editor' ),
			)
		);
		return $rules;
	}
);

add_filter(
	'csco_font_post_content',
	function( $rules ) {
		array_push(
			$rules,
			array(
				'element' => csco_implode(
					array(
						'.editor-styles-wrapper .block-editor-block-list__layout',
						'.editor-styles-wrapper .block-editor-block-list__layout p',
					)
				),
				'context' => array( 'editor' ),
			)
		);
		return $rules;
	}
);

add_filter(
	'csco_font_headings',
	function( $rules ) {
		array_push(
			$rules,
			array(
				'element' => csco_implode(
					array(
						'.editor-styles-wrapper.cs-editor-styles-wrapper h1',
						'.editor-styles-wrapper.cs-editor-styles-wrapper h2',
						'.editor-styles-wrapper.cs-editor-styles-wrapper h3',
						'.editor-styles-wrapper.cs-editor-styles-wrapper h4',
						'.editor-styles-wrapper.cs-editor-styles-wrapper h5',
						'.editor-styles-wrapper.cs-editor-styles-wrapper h6',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .h1',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .h2',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .h3',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .h4',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .h5',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .h6',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .editor-post-title__input',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-quote',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-quote p',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-pullquote p',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-freeform blockquote p:first-child',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-cover .wp-block-cover-image-text',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-cover .wp-block-cover-text',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-cover-image .wp-block-cover-image-text',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-cover-image .wp-block-cover-text',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-cover-image h2',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-cover h2',
						'.editor-styles-wrapper.cs-editor-styles-wrapper p.has-drop-cap:not(:focus):first-letter',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .cnvs-block-tabs .cnvs-block-tabs-button',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .cnvs-block-tabs .cnvs-block-tabs-button a',
					)
				),
				'context' => array( 'editor' ),
			)
		);
		return $rules;
	}
);

add_filter(
	'csco_font_title_block',
	function( $rules ) {
		array_push(
			$rules,
			array(
				'element' => csco_implode(
					array(
						'.editor-styles-wrapper.cs-editor-styles-wrapper .title-block',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .pk-font-block',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .pk-widget-contributors .pk-author-posts > h6',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .cnvs-block-section-heading',
					)
				),
				'context' => array( 'editor' ),
			)
		);
		return $rules;
	}
);

add_filter(
	'csco_design_border_radius',
	function( $rules ) {
		array_push(
			$rules,
			array(
				'element'  => csco_implode(
					array(
						'.editor-styles-wrapper.cs-editor-styles-wrapper .button-primary',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .wp-block-button:not(.is-style-squared) .wp-block-button__link',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .cs-author-button',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .pk-subscribe-submit',
					)
				),
				'property' => 'border-radius',
				'context'  => array( 'editor' ),
			)
		);
		return $rules;
	}
);

add_filter(
	'csco_design_border_radius',
	function( $rules ) {
		array_push(
			$rules,
			array(
				'element'     => csco_implode(
					array(
						'.editor-styles-wrapper.cs-editor-styles-wrapper .pk-subscribe-with-name input[type="text"]',
						'.editor-styles-wrapper.cs-editor-styles-wrapper .pk-subscribe-with-bg input[type="text"]',
					)
				),
				'property'    => 'border-radius',
				'media_query' => '@media (max-width: 599px)',
				'context'     => array( 'editor' ),
			)
		);
		return $rules;
	}
);

add_filter(
	'csco_design_border_radius',
	function( $rules ) {
		array_push(
			$rules,
			array(
				'element'  => csco_implode(
					array(
						'.editor-styles-wrapper.cs-editor-styles-wrapper .pk-subscribe-form-wrap input[type="text"]:first-child',
					)
				),
				'property' => 'border-radius',
				'property' => 'border-top-left-radius',
				'context'  => array( 'editor' ),
			)
		);
		return $rules;
	}
);

add_filter(
	'csco_design_border_radius',
	function( $rules ) {
		array_push(
			$rules,
			array(
				'element'  => csco_implode(
					array(
						'.editor-styles-wrapper.cs-editor-styles-wrapper .pk-subscribe-form-wrap input[type="text"]:first-child',
					)
				),
				'property' => 'border-radius',
				'property' => 'border-bottom-left-radius',
				'context'  => array( 'editor' ),
			)
		);
		return $rules;
	}
);
