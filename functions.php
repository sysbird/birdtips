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

//////////////////////////////////////////
// SinglePage Comment callback
function birdtips_custom_comments( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

	<?php if( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ):
		$birstips_url = get_comment_author_url();
		$birstips_author = get_comment_author();
	 ?>

		<div class="posted"><strong><?php _e( 'Pingback', 'birdtips' ); ?> : </strong><a href="<?php echo $birstips_url; ?>" target="_blank"><?php echo $birstips_author ?></a><?php edit_comment_link( __('(Edit)', 'birdtips'), ' ' ); ?></div>

	<?php else: ?>

		<div class="comment_meta">
			<?php echo get_avatar( $comment, 40 ); ?>
			<span class="author"><?php comment_author(); ?></span>
			<span class="time"><?php echo get_comment_time(get_option( 'date_format' ) .' ' .get_option( 'time_format' ) ); ?></span>
			<span class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
		</div>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'birdtips' ); ?></em><br>
		<?php endif; ?>

		<div class="comment_text">
			<?php comment_text(); ?>

			<?php $birdtips_web = get_comment_author_url(); ?>
			<?php if( !empty( $birdtips_web ) ): ?>
				<p class="web"><a href="<?php echo $birdtips_web; ?>" target="_blank"><?php echo $birdtips_web; ?></a></p>
			<?php endif; ?>
		</div>

	<?php endif; ?>
<?php
	// no "</li>" conform WORDPRESS
}

//////////////////////////////////////////////////////
// Pagenation
function birdtips_the_pagenation() {

	global $wp_query, $paged;
	$birdtips_big = 999999999;

	$birdtips_pages = $wp_query -> max_num_pages;
	if ( empty( $paged ) ) $paged = 1;

	if ( 1 < $birdtips_pages ) {
		echo '	<div class="tablenav">' ."\n";
		echo paginate_links( array(
			'base'		=> str_replace( $birdtips_big, '%#%', get_pagenum_link( $birdtips_big ) ),
			'format'	=> '?paged=%#%',
			'current'	=> max( 1, get_query_var( 'paged' ) ),
			'total'		=> $wp_query -> max_num_pages,
			'mid_size'	=> 3,
			'prev_text'	=> __( 'Previous', 'birdtips' ),
			'next_text'	=> __( 'Next', 'birdtips' )
			) );
		echo '</div>' ."\n";
	}
}

//////////////////////////////////////////
// Archive PageTitle
function birdtips_the_archivetitle() {

	if(is_category()) {
		printf( __( 'Category Archives: %s', 'birdtips'), single_cat_title('', false ) );
	}
	elseif( is_tag() ) {
		printf( __( 'Tag Archives: %s', 'birdtips' ), single_tag_title( '', false ) );
	}
	elseif (is_day()) {
		printf( __('Daily Archives: %s', 'birdtips'), get_post_time( get_option('date_format' ) ) );
	}
	elseif ( is_month() ) {
		printf( __( 'Monthly Archives: %s', 'birdtips'), get_post_time( __( 'F, Y', 'birdtips' ) ) );
	}
	elseif (is_year()) {
		printf( __( 'Yearly Archives: %s', 'birdtips' ), get_post_time( __( 'Y', 'birdtips' ) ) );
	}
	elseif ( is_author() ) {
		printf( __('Author Archives: %s', 'birdtips' ), get_the_author_meta( 'display_name', get_query_var( 'author' ) ) );
	}
	elseif ( isset($_GET['paged'] ) && !empty( $_GET['paged'] ) ) {
		_e( 'Blog Archives', 'birdtips' );
	}
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
// Header Style
function birdtips_header_style() {

?>

<style type="text/css">

<?php
	//Theme Option
	$header_textcolor = get_header_textcolor();
	$text_color = esc_attr( get_theme_mod( 'birdtips_text_color', '#555' ) );
	$link_color = esc_attr( get_theme_mod( 'birdtips_link_color', '#06A' ) );
	$article_title_color = esc_attr( get_theme_mod( 'birdtips_article_title_color', '#D63' ) );
	$navigation_color = esc_attr( get_theme_mod( 'birdtips_navigation_color', '#DDD' ) );

	if ( 'blank' == $header_textcolor ) { ?>
	<?php } else { ?>
		#header h1 a,
		#header #site-title a,
		#header p {
			color: #<?php echo $header_textcolor; ?>;
		}
		<?php } ?>

	body,
	.archive #content ul li a,
	.error404 #content ul li a,
	#menu-wrapper .menu ul#menu-primary-items li ul li a,
	.widget ul li,
	.widget ul li a {
		color: <?php echo $text_color; ?>;
	}

	a,
	#content .hentry.sticky .entry-header .entry-title a,
	#content .tablenav a,
	#content .hentry .page-link,
	#content .hentry .page-link a span {
		color: <?php echo $link_color; ?>;
	}

	#content .hentry.sticky .entry-header .postdate,
	#content .tablenav .current,
	#content .hentry .page-link span,
	.widget #wp-calendar tbody td a {
		background: <?php echo $link_color; ?>;
	}

	#content a,
	#content a:hover,
	#content .hentry .page-link span,
	#content .tablenav a,
	#content .tablenav .current {
		border-color: <?php echo $link_color; ?>;
	}

	#content .hentry .entry-header .entry-title,
	#content .hentry .entry-header .entry-title a,
	#content #comments li.bypostauthor .comment_meta .author {
		color: <?php echo $article_title_color; ?>;
	}

	#content .hentry .entry-header .postdate,
	#footer {
		background: <?php echo $article_title_color; ?>;
	}

	#menu-wrapper .menu ul li a {
		color: <?php echo $navigation_color; ?>;
		border-left-color: <?php echo $navigation_color; ?>;
	}

	@media screen and (max-width: 650px) {
		#menu-wrapper .menu #small-menu,
		#menu-wrapper .menu ul#menu-primary-items {
			background: <?php echo $article_title_color; ?>;
		}

		#menu-wrapper .menu ul#menu-primary-items li ul li a {
			color: #FFF;
		}

		#content .hentry .entry-header .postdate {
			color: <?php echo $article_title_color; ?>;
		}

		#content .hentry.sticky .entry-header .postdate {
			color: <?php echo $link_color; ?>;
		}
	}

</style>

<?php

}

//////////////////////////////////////////////////////
// Setup Theme
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
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	/* This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'F5F5F5',
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'birdtips' ),
	) );

	// Add support for title tag.
	add_theme_support( 'title-tag' );

	// Add support for custom headers.
	add_theme_support( 'custom-header', array(
		'default-text-color'	=> 'CCC',
		'default-image'			=> '%s/images/headers/green.jpg',
		'width'					=> 1075,
		'height'				=> 200,
		'random-default'		=> true,
		'wp-head-callback'		=> 'birdtips_header_style',
	) );

	register_default_headers( array(
		'green'	=> array(
			'url'			=> '%s/images/headers/green.jpg',
			'thumbnail_url'	=> '%s/images/headers/green-thumbnail.jpg',
			'description'	=> 'Green'
		),
		'blue' => array(
			'url'			=> '%s/images/headers/blue.jpg',
			'thumbnail_url'	=> '%s/images/headers/blue-thumbnail.jpg',
			'description'	=> 'Blue'
		),
		'yellow' => array(
			'url'			=> '%s/images/headers/yellow.jpg',
			'thumbnail_url'	=> '%s/images/headers/yellow-thumbnail.jpg',
			'description'	=> 'Yellow'
		),
		'red' => array(
			'url'			=> '%s/images/headers/red.jpg',
			'thumbnail_url'	=> '%s/images/headers/red-thumbnail.jpg',
			'description'	=> 'Red'
		),
		'white' => array(
			'url'			=> '%s/images/headers/white.jpg',
			'thumbnail_url'	=> '%s/images/headers/white-thumbnail.jpg',
			'description'	=> 'White'
		),
		'orange' => array(
			'url'			=> '%s/images/headers/orange.jpg',
			'thumbnail_url'	=> '%s/images/headers/orange-thumbnail.jpg',
			'description'	=> 'Orange'
		),
		'pink' => array(
			'url'			=> '%s/images/headers/pink.jpg',
			'thumbnail_url'	=> '%s/images/headers/pink-thumbnail.jpg',
			'description'	=> 'Pink'
		),
		'purple' => array(
			'url'			=> '%s/images/headers/purple.jpg',
			'thumbnail_url'	=> '%s/images/headers/purple-thumbnail.jpg',
			'description'	=> 'Purple'
		),
	) );
}
add_action( 'after_setup_theme', 'birdtips_setup' );

//////////////////////////////////////////////////////
// Document Title
function birdtips_title( $title ) {
	global $page, $paged;

	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " | $site_description";

	if ( $paged >= 2 || $page >= 2 )
		$title .= ' | ' . sprintf( __( 'Page %s', 'birdtips' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'birdtips_title' );

//////////////////////////////////////////////////////
// Title Tag Backwards Compatibility
function birdtips_slug_render_title() {
	?><title><?php wp_title( '|', true, 'right' ); ?></title><?php
}

//////////////////////////////////////////////////////
// Enqueue Acripts
function birdtips_scripts() {

	if ( is_singular() && comments_open() && get_option('thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'birdtips', get_template_directory_uri() .'/js/birdtips.js', 'jquery', '1.08' );
	wp_enqueue_style( 'birdfield-google-font', '//fonts.googleapis.com/css?family=Lato', false, null, 'all' );
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
add_filter(' excerpt_more', 'birdtips_excerpt_more' );

//////////////////////////////////////////////////////
// Theme Customizer
function birdtips_customize($wp_customize) {

	// Text Color
	$wp_customize->add_setting( 'birdtips_text_color', array(
		'default'			=> '#555',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdtips_text_color', array(
		'label'		=> __( 'Text Color', 'birdtips' ),
		'section'	=> 'colors',
		'settings'	=> 'birdtips_text_color',
	) ) );

	// Link Color
	$wp_customize->add_setting( 'birdtips_link_color', array(
		'default'			=> '#06A',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdtips_link_color', array(
		'label'		=> __( 'Link Color', 'birdtips' ),
		'section'	=> 'colors',
		'settings'	=> 'birdtips_link_color',
	) ) );

	// Aticle Titler Color
	$wp_customize->add_setting( 'birdtips_article_title_color', array(
		'default'			=> '#D63',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'birdtips_article_title_color', array(
		'label'		=> __( 'Article Title Color', 'birdtips' ),
		'section'	=> 'colors',
		'settings'	=> 'birdtips_article_title_color',
	) ) );

	// Navigation Text Color
	$wp_customize->add_setting( 'birdtips_navigation_color', array(
		'default'			=> '#DDD',
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
		'default'		=> true,
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
		'default'		=> true,
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
// Removing the default gallery style
function birdtips_gallery_atts( $out, $pairs, $atts ) {

	$atts = shortcode_atts( array( 'size' => 'medium', ), $atts );
	$out['size'] = $atts['size'];

	return $out;
}
add_filter( 'shortcode_atts_gallery', 'birdtips_gallery_atts', 10, 3 );
add_filter( 'use_default_gallery_style', '__return_false' );
