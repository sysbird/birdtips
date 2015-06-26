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

		<?php the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array(
					'before'		=> '<div class="page-link">' . __( 'Pages:', 'birdtips' ),
					'after'			=> '</div>',
					'link_before'	=> '<span>',
					'link_after'	=> '</span>'
					) ); ?>
			</div>
		</article>

		<?php comments_template( '', true ); ?>

	</div>

	<?php get_sidebar('left'); ?>
</div>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>
