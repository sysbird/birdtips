<?php
/**
 * The template for displaying pages
 *
 * @package WordPress
 * @subpackage BirdTIPS
 * @since BirdTIPS 1.0
 */
get_header(); ?>

<div id="main">
	<div id="content">

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', get_post_format() ); ?>
		<?php if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif; ?>

	<?php endwhile; ?>

	</div>

	<?php get_sidebar('left'); ?>
</div>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>
