<?php
/**
 * The template for displaying archive pages
 *
 * @package WordPress
 * @subpackage birdTIPS
 * @since birdTIPS 1.0
 */
get_header(); ?>

<div id="main">
	<div id="content">

		<?php if (have_posts()) : ?>
			<article class="hentry">
				<header class="entry-header">
					<h1 class="entry-title"><?php birdtips_the_archivetitle(); ?></h1>
				</header>

				<ul>
				<?php while (have_posts()) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>
				</ul>
			</article>

			<?php birdtips_the_pagenation(); ?>
		<?php else: ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.', 'birdtips' ); ?></p>
		<?php endif; ?>
	</div>

	<?php get_sidebar('left'); ?>
</div>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>
