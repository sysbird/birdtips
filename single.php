<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage BirdTIPS
 * @since BirdTIPS 1.0
 */
get_header(); ?>

<div id="main">
	<div id="content">

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', get_post_format() ); ?>
		<?php if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif; ?>

		<nav id="nav-below">
			<span class="nav-next"><?php next_post_link('%link', '%title'); ?></span>
			<span class="nav-previous"><?php previous_post_link('%link', '%title'); ?></span>
		</nav>

	<?php endwhile; ?>

	</div>

	<?php get_sidebar('left'); ?>
</div>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>
