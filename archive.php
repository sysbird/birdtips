<?php get_header(); ?>

<div id="main">
	<div id="content">

		<?php if (have_posts()) : ?>

			<article class="hentry">
				<header class="entry-header">
					<h1 class="entry-title"><?php birdtips_the_archivetitle(); ?></h1>
				</header>

				<ul>
				<?php while (have_posts()) : the_post(); ?>
					<li><a href="<?php the_permalink() ?>" rel="bookmark"><span><?php the_title(); ?></span> <em><?php echo get_post_time(get_option('date_format')); ?></em></a></li>

				<?php endwhile; ?>
				</ul>

			</article>
		<?php else: ?>

		<p><?php _e( 'Sorry, no posts matched your criteria.', 'birdtips' ); ?></p><?php endif; ?>
		<?php birdtips_the_pagenation(); ?>

	</div>

	<?php get_sidebar('left'); ?>
</div>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>
