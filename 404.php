<?php get_header(); ?>

<div id="main">
	<div id="content">

		<article class="hentry">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e('Error 404 - Not Found', 'birdtips'); ?></h1>
			</header>

		   <h2><?php _e( 'Recent Articles', 'birdtips' ); ?></h2>
		   <?php query_posts('cat=&showposts=10'); ?>
				<ul>
				<?php while (have_posts()) : the_post(); ?>
					<li><a href="<?php the_permalink() ?>" rel="bookmark"><span><?php the_title(); ?></span> <em><?php echo get_post_time(get_option('date_format')); ?></em></a></li>

				<?php endwhile; ?>
				</ul>
		</article>

	</div>

	<?php get_sidebar('left'); ?>
</div>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>
