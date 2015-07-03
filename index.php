<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage BirdTIPS
 * @since BirdTIPS 1.0
 */
get_header(); ?>

<div id="main">
	<div id="content">
		<?php if( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php birdtips_the_pagenation(); ?>
		<?php endif; ?>
	</div>

	<?php get_sidebar('left'); ?>
</div>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>
