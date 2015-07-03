<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage BirdTIPS
 * @since BirdTIPS 1.0
 */
get_header(); ?>

<div id="main">
	<div id="content">

		<article class="hentry">
			<header class="entry-header">
				<h1 class="entry-title"><?php printf(__('Search Results: %s', 'birdtips'), esc_html($s) ); ?></h1>
			</header>

			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>

				<?php birdtips_the_pagenation(); ?>
			<?php else: ?>
				<p><?php printf(__('Sorry, no posts matched &#8216;%s&#8217;', 'birdtips'), esc_html($s) ); ?>
			<?php endif; ?>
		</article>

	</div>

	<?php get_sidebar('left'); ?>
</div>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>
