<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage birdTIPS
 * @since birdTIPS 1.0
 */
get_header(); ?>
<div id="main">
	<div id="content">

		<article class="hentry">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e('Error 404 - Not Found', 'birdtips'); ?></h1>
			</header>

			<?php get_search_form(); ?>
		</article>
	</div>

	<?php get_sidebar('left'); ?>
</div>

<?php get_sidebar('right'); ?>
<?php get_footer(); ?>
