<?php
/**
 * The template for displaying the header
 *
 * @package WordPress
 * @subpackage BirdTIPS
 * @since BirdTIPS 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" >
<meta name="viewport" content="width=device-width" >
<?php
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	add_action( 'wp_head', 'birdtips_slug_render_title' );
}
?>
<link rel="profile" href="http://gmpg.org/xfn/11" >
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" >
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri() ?>/js/html5shiv.js" type="text/javascript"></script>
<![endif]-->
<?php
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	add_action( 'wp_head', 'birdtips_slug_render_title' );
}
?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="container">

<?php
	// The header image
	$birdtips_header_image = get_header_image();
	$birdtips_header_image? $birdtips_image_tag = '' : $birdtips_image_tag = 'no-image';

	// The header text
	if ( 'blank' == get_header_textcolor() ) {
		$birdtips_image_tag .= ' no-title';
	}

	$birdtips_has_nav_menu = has_nav_menu( 'primary' );
	if ( !$birdtips_has_nav_menu ) {
		$birdtips_image_tag .= ' no-menu';
	}

	if( $birdtips_image_tag ){
		 $birdtips_image_tag = ' class="' . $birdtips_image_tag .'"';
	}
?>

	<header id="header"<?php echo $birdtips_image_tag; ?>>

		<?php if ( ! empty( $birdtips_header_image ) ) : ?>
				<?php if ( 'blank' == get_header_textcolor() ): ?>
					<a href="<?php echo home_url( '/' ); ?>"><img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" ></a>
				<?php else: ?>
					<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" >
				<?php endif; ?>
			<?php endif; ?>

		<div id="branding">
			<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
			<<?php echo $heading_tag; ?> id="site-title">
				<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</<?php echo $heading_tag; ?>>
			<p id="site-description"><?php bloginfo( 'description' ); ?></p>
		</div>

		<?php if ( $birdtips_has_nav_menu ) : ?>
			<nav id="menu-wrapper">
				<?php wp_nav_menu( array( 'theme_location'	=> 'primary',
								'container_class'	=> 'menu',
								'menu_class'		=> '',
								'menu_id'		=> 'menu-primary-items',
								'items_wrap'		=> '<div id="small-menu"></div><ul id="%1$s" class="%2$s">%3$s</ul>',
								'fallback_cb'		=> '' ) ); ?>
			</nav>
		<?php endif; ?>

	</header>

	<div id="wrapper">
