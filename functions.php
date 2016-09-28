<?php
/**
 * The template functions and definitions
 *
 * @package WordPress
 * @subpackage BirdTIPS
 * @since BirdTIPS 1.0
 */
//////////////////////////////////////////
// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 550;

//////////////////////////////////////////
// Set Widgets
function birdtips_widgets_init() {

	if ( function_exists( 'register_sidebar' ) ){

		register_sidebar( array (
			'name'			=> __( 'Widget Area for left sidebar', 'birdtips' ),
			'id'			=> 'widget-area-left',
			'description'	=> __( 'Widget Area for left sidebar', 'birdtips' ),
			'before_widget'	=> '<div class="widget">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3>',
			'after_title'	=> '</h3>',
			) );

		register_sidebar( array (
			'name'			=> __( 'Widget Area for right sidebar', 'birdtips' ),
			'id'			=> 'widget-area-right',
			'description'	=> __( 'Widget Area for right sidebar', 'birdtips' ),
			'before_widget'	=> '<div class="widget">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h3>',
			'after_title'	=> '</h3>',
			) );
	}
}
add_action( 'widgets_init', 'birdtips_widgets_init' );

//////////////////////////////////////////////////////
// Copyright Year
function birdtips_get_copyright_year() {

	$birdtips_copyright_year = date( "Y" );

	$birdtips_first_year = $birdtips_copyright_year;
	$args = array(
		'numberposts'	=> 1,
		'orderby'		=> 'post_date',
		'order'			=> 'ASC',
	);
	$posts = get_posts( $args );

	foreach ( $posts as $post ) {
		$birdtips_first_year = mysql2date( 'Y', $post->post_date, true );
	}

	if( $birdtips_copyright_year <> $birdtips_first_year ){
		$birdtips_copyright_year = $birdtips_first_year .' - ' .$birdtips_copyright_year;
	}

	return $birdtips_copyright_year;
}

//////////////////////////////////////////////////////
// Date
function birdtips_the_date() {

	$birdtips_html = '';
	$birdtips_posted = date( __( 'M. j, Y', 'birdtips' ),  strtotime( get_the_time( "Y-m-d") ) );
	$birdtips_date = explode( ' ', $birdtips_posted );
	foreach( $birdtips_date as $birdtips_d ){
		$birdtips_html .= '<span>' .$birdtips_d .'</span>';
	}

	echo $birdtips_html;
}

//////////////////////////////////////////////////////
// Setup Theme
if ( ! function_exists( 'birdtips_setup' ) ) :
function birdtips_setup() {

	// Set languages
	load_theme_textdomain( 'birdtips', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Set feed
	add_theme_support( 'automatic-feed-links' );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	/* This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	$birdtips_default_colors = birdtips_get_default_colors();
	$birdtips_color = trim( $birdtips_default_colors[ 'background_color' ], '#' );
	add_theme_support( 'custom-background', array(
		'default-color' => $birdtips_color,
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'birdtips' ),
	) );

	// Add support for title tag.
	add_theme_support( 'title-tag' );

	// Add support for custom headers.
	$birdtips_color = trim( $birdtips_default_colors[ 'navigation_color' ], '#' );
	add_theme_support( 'custom-header', array(
		'default-text-color'	=> $birdtips_color,
		'default-image'			=> '%s/images/headers/green.jpg',
		'width'					=> 1075,
		'height'				=> 200,
		'random-default'		=> true
	) );

	register_default_headers( array(
		'green'	=> array(
			'url'			=> '%s/images/headers/green.jpg',
			'thumbnail_url'	=> '%s/images/headers/green-thumbnail.jpg',
			'description'	=> 'Green'
		)
	) );
}
endif; // birdtips_setup
add_action( 'after_setup_theme', 'birdtips_setup' );

//////////////////////////////////////////////////////
// Enqueue Acripts
function birdtips_scripts() {

	wp_enqueue_script( 'birdtips-html5', get_template_directory_uri() . '/js/html5shiv.js', array(), '3.7.2' );
	wp_script_add_data( 'birdtips-html5', 'conditional', 'lt IE 9' );

	if ( is_singular() && comments_open() && get_option('thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'birdtips', get_template_directory_uri() .'/js/birdtips.js',array( 'jquery' ), '1.09' );
	wp_enqueue_style( 'birdtips-google-font', '//fonts.googleapis.com/css?family=Lato', false, null, 'all' );
	wp_enqueue_style( 'birdtips', get_stylesheet_uri() );

	if ( strtoupper( get_locale() ) == 'JA' ) {
		wp_enqueue_style( 'birdtips_ja', get_template_directory_uri().'/css/ja.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'birdtips_scripts' );

//////////////////////////////////////////////////////
// Excerpt More
function birdtips_excerpt_more() {
	global $post;

	return ' <a href="'. esc_url( get_permalink() ) . '" class="more-link">' . __( 'Continue reading', 'birdtips' ) .'</a>';
}
add_filter('excerpt_more', 'birdtips_excerpt_more' );

//////////////////////////////////////////////////////
// Theme Customizer
function birdtips_customize($wp_customize) {

	// Remove the core header textcolor control, as it shares the main text color.
	$wp_customize->remove_control( 'header_textcolor' );

	// defaut colors
	$birdtips_default_colors = birdtips_get_default_colors();

	// Text Color
	$wp_customize->add_setting( 'birdtips_text_color', array(
		'default'			=> $birdtips_default_colors[ 'text_color' ],
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdtips_text_color', array(
		'label'		=> __( 'Text Color', 'birdtips' ),
		'section'	=> 'colors',
		'settings'	=> 'birdtips_text_color',
	) ) );

	// Link Color
	$wp_customize->add_setting( 'birdtips_link_color', array(
		'default'			=> $birdtips_default_colors[ 'link_color' ],
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdtips_link_color', array(
		'label'		=> __( 'Link Color', 'birdtips' ),
		'section'	=> 'colors',
		'settings'	=> 'birdtips_link_color',
	) ) );

	// Aticle Titler Color
	$wp_customize->add_setting( 'birdtips_article_title_color', array(
		'default'			=> $birdtips_default_colors[ 'article_title_color' ],
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdtips_article_title_color', array(
		'label'		=> __( 'Article Title Color', 'birdtips' ),
		'section'	=> 'colors',
		'settings'	=> 'birdtips_article_title_color',
	) ) );

	// Navigation Color
	$wp_customize->add_setting( 'birdtips_navigation_color', array(
		'default'			=> $birdtips_default_colors[ 'navigation_color' ],
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdtips_navigation_color', array(
		'label'		=> __( 'Navigation Text Color', 'birdtips' ),
		'section'	=> 'colors',
		'settings'	=> 'birdtips_navigation_color',
	) ) );

	// Footer Section
	$wp_customize->add_section( 'birdtips_footer', array(
		'title'		=> __( 'Footer', 'birdtips' ),
		'priority'	=> 999,
	) );

	// Display Copyright
	$wp_customize->add_setting( 'birdtips_copyright', array(
		'default'			=> true,
		'sanitize_callback'	=> 'birdtips_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'birdtips_copyright', array(
		'label'		=> __( 'Display Copyright', 'birdtips' ),
		'section'	=> 'birdtips_footer',
		'type'		=> 'checkbox',
		'settings'	=> 'birdtips_copyright',
	) );

	// Display Credit
	$wp_customize->add_setting( 'birdtips_credit', array(
		'default'			=> true,
		'sanitize_callback'	=> 'birdtips_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'birdtips_credit', array(
		'label'		=> __( 'Display Credit', 'birdtips' ),
		'section'	=> 'birdtips_footer',
		'type'		=> 'checkbox',
		'settings'	=> 'birdtips_credit',
	) );
}
add_action('customize_register', 'birdtips_customize');

//////////////////////////////////////////////////////
// Santize a checkbox
function birdtips_sanitize_checkbox( $input ) {

	if ( $input == true ) {
		return true;
	} else {
		return false;
	}
}

//////////////////////////////////////////////////////
// Get default colors
function birdtips_get_default_colors() {
	return array( 'background_color'		=> '#F5F5F5',
					'text_color'			=> '#555555',
					'link_color'			=> '#0066AA',
					'navigation_color'		=> '#DDDDDD',
					'article_title_color'	=> '#DD6633' );
}

//////////////////////////////////////////////////////
// Enqueues front-end CSS for the Theme Customizer.
function birdtips_color_css() {

	// default color
	$birdtips_default_colors = birdtips_get_default_colors();

	// Custom Text Color
	$birdtips_text_color = get_theme_mod( 'birdtips_text_color', $birdtips_default_colors[ 'text_color' ] );
	if( strcasecmp( $birdtips_text_color, $birdtips_default_colors[ 'text_color' ] )) {
		$birdtips_css = "
			/* Custom Text Color */
			body,
			.archive #content ul li a,
			.error404 #content ul li a,
			.widget ul li a {
				color: {$birdtips_text_color};
			}
		";

		wp_add_inline_style( 'birdtips', $birdtips_css );
	}

	// Custom Link Color
	$birdtips_link_color = get_theme_mod( 'birdtips_link_color', $birdtips_default_colors[ 'link_color' ] );
	if( strcasecmp( $birdtips_link_color, $birdtips_default_colors[ 'link_color' ] )) {
		$birdtips_css = "
			/* Custom Link Color */
			a,
			#content .hentry.sticky .entry-header .entry-title a,
			#content .tablenav a,
			#content .hentry .page-link,
			#content .hentry .page-link a span {
				color: {$birdtips_link_color};
			}

			#content .hentry.sticky .entry-header .postdate,
			#content .tablenav .current,
			#content .hentry .page-link span,
			.widget #wp-calendar tbody td a {
				background: {$birdtips_link_color};
			}

			#content a,
			#content a:hover,
			#content .hentry .page-link span,
			#content .tablenav a,
			#content .tablenav .current {
				border-color: {$birdtips_link_color};
			}

			@media screen and (max-width: 650px) {
				#content .hentry.sticky .entry-header .postdate {
					color: {$birdtips_link_color};
				}
			}
		";

		wp_add_inline_style( 'birdtips', $birdtips_css );
	}

	// Custom Aticle Title Color
	$birdtips_article_title_color = get_theme_mod( 'birdtips_article_title_color', $birdtips_default_colors[ 'article_title_color' ] );
	if( strcasecmp( $birdtips_article_title_color, $birdtips_default_colors[ 'article_title_color' ] )) {
		$birdtips_css = "
			/* Custom Aticle Title Color */
			#content .hentry .entry-header .entry-title,
			#content .hentry .entry-header .entry-title a,
			#content #comments ol.commentlist li.pingback.bypostauthor .comment-author .fn,
			#content #comments ol.commentlist li.comment.bypostauthor .comment-author .fn {
				color: {$birdtips_article_title_color};
			}

			#content .hentry .entry-header .postdate,
			#footer {
				background: {$birdtips_article_title_color};
			}

			@media screen and (max-width: 650px) {
				#content .hentry .entry-header .postdate {
					color: {$birdtips_article_title_color};
				}
			}
		";

		wp_add_inline_style( 'birdtips', $birdtips_css );
	}

	// Navigation Color
	$birdtips_navigation_color = get_theme_mod( 'birdtips_navigation_color', $birdtips_default_colors[ 'navigation_color' ] );
	if( strcasecmp( $birdtips_navigation_color, $birdtips_default_colors[ 'navigation_color' ] )) {
		$birdtips_css = "
			/* Custom Navigation Color */
			#header h1 a,
			#header #branding #site-title a,
			#header #branding #site-description,
			#menu-wrapper .menu ul#menu-primary-items > li > a {
				color: {$birdtips_navigation_color};
				border-left-color: {$birdtips_navigation_color};
			}
		";

		wp_add_inline_style( 'birdtips', $birdtips_css );
	}

}
add_action( 'wp_enqueue_scripts', 'birdtips_color_css', 11 );

//////////////////////////////////////////////////////
// Removing the default gallery style
function birdtips_gallery_atts( $out, $pairs, $atts ) {

	$atts = shortcode_atts( array( 'size' => 'medium', ), $atts );
	$out['size'] = $atts['size'];

	return $out;
}
add_filter( 'shortcode_atts_gallery', 'birdtips_gallery_atts', 10, 3 );
add_filter( 'use_default_gallery_style', '__return_false' );
