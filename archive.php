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
					<?php
						the_archive_title( '<h1 class="entry-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header>

				<ul>
				<?php while (have_posts()) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>
				</ul>
			</article>

			<?php the_posts_pagination( array( 'mid_size' => 3 ) ); ?>
		<?php else: ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.', 'birdtips' ); ?></p>
		<?php endif; ?>
	</div>

	<?php get_sidebar('left'); ?>
</div>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>
