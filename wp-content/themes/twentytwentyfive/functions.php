<?php
/**
 * Theme functions and definitions
 *
 * Child theme: Hagerty Digital
 */

// ------------------------------
// 1) IMPORTANT: Disable FSE / Block templates
// ------------------------------
add_action( 'after_setup_theme', function () {
	// Forces WordPress to use classic PHP template hierarchy:
	// header.php, footer.php, front-page.php etc.
	remove_theme_support( 'block-templates' );
}, 0 );


// ------------------------------
// 2) (Optional) Keep Twenty Twenty-Five post formats support
// ------------------------------
if ( ! function_exists( 'twentytwentyfive_post_format_setup' ) ) :
	function twentytwentyfive_post_format_setup() {
		add_theme_support(
			'post-formats',
			array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' )
		);
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_post_format_setup' );


// ------------------------------
// 3) (Optional) Editor styles
// ------------------------------
if ( ! function_exists( 'twentytwentyfive_editor_style' ) ) :
	function twentytwentyfive_editor_style() {
		add_editor_style( 'assets/css/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_editor_style' );


// ------------------------------
// 4) Enqueue your child theme CSS + JS (ONLY ONCE)
// ------------------------------
add_action( 'wp_enqueue_scripts', function () {
	// Child theme stylesheet (style.css in your child theme)
	wp_enqueue_style(
		'hd-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);

	// Child theme JS (script.js in your child theme root)
	wp_enqueue_script(
		'hd-script',
		get_stylesheet_directory_uri() . '/script.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}, 20 );


// ------------------------------
// 5) (Optional) Custom block style example kept from TT5
// ------------------------------
if ( ! function_exists( 'twentytwentyfive_block_styles' ) ) :
	function twentytwentyfive_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfive' ),
				'inline_style' => '
				ul.is-style-checkmark-list { list-style-type: "\2713"; }
				ul.is-style-checkmark-list li { padding-inline-start: 1ch; }',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_block_styles' );


// ------------------------------
// 6) (Optional) Pattern categories kept from TT5
// ------------------------------
if ( ! function_exists( 'twentytwentyfive_pattern_categories' ) ) :
	function twentytwentyfive_pattern_categories() {
		register_block_pattern_category(
			'twentytwentyfive_page',
			array(
				'label'       => __( 'Pages', 'twentytwentyfive' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfive' ),
			)
		);

		register_block_pattern_category(
			'twentytwentyfive_post-format',
			array(
				'label'       => __( 'Post formats', 'twentytwentyfive' ),
				'description' => __( 'A collection of post format patterns.', 'twentytwentyfive' ),
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_pattern_categories' );


// ------------------------------
// 7) (Optional) Block bindings kept from TT5
// ------------------------------
if ( ! function_exists( 'twentytwentyfive_register_block_bindings' ) ) :
	function twentytwentyfive_register_block_bindings() {
		register_block_bindings_source(
			'twentytwentyfive/format',
			array(
				'label'              => _x( 'Post format name', 'Block binding label', 'twentytwentyfive' ),
				'get_value_callback' => 'twentytwentyfive_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_register_block_bindings' );

if ( ! function_exists( 'twentytwentyfive_format_binding' ) ) :
	function twentytwentyfive_format_binding() {
		$post_format_slug = get_post_format();
		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;
