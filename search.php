<?php get_header(); ?>

<div id="main">
	<div id="content">

		<article class="hentry">
			<header class="entry-header">
				<h1 class="entry-title"><?php printf(__('Search Results: %s', 'birdtips'), esc_html($s) ); ?></h1>
			</header>

				<?php if (have_posts()) : ?>

					<?php while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header">
					<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'birdtips' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'birdtips' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"></a>
				</header>

				<div class="entry-content">
					<?php if(has_post_thumbnail()): ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
					<?php endif; ?>
					<?php the_excerpt( ); ?>
				</div>

			</article>

					<?php endwhile; ?>

				<?php else: ?>

					<p><?php printf(__('Sorry, no posts matched &#8216;%s&#8217;', 'birdtips'), esc_html($s) ); ?><?php endif; ?>

		</article>

		<?php birdtips_the_pagenation(); ?>
	</div>

	<?php get_sidebar('left'); ?>
</div>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>
