<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage BirdTIPS
 * @since BirdTIPS 1.08
 */
?>

<?php if(is_singular()): // Display for Single/Page ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php if( is_single() ): // Only Display for Single ?>
				<time class="postdate" datetime="<?php echo get_the_time('Y-m-d') ?>" pubdate><?php birdtips_the_date(); ?></time>
			<?php endif; ?>
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

		<?php if( is_single() ): // Only Display for Single ?>
			<footer class="entry-meta">
				<span class="author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span><span class="category"><?php the_category(', ') ?></span><?php the_tags('<span class="tag">', ', ', '</span>') ?>
			</footer>
		<?php endif; ?>
	</article>

<?php elseif( is_archive() ): // Display for Archive ?>
	<li><a href="<?php the_permalink() ?>" rel="bookmark">
		<span><?php the_title(); ?></span><em><?php echo get_post_time( get_option('date_format' ) ); ?></em></a>
	</li>
<?php elseif( is_search() ): // Display for Search ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'birdtips' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'birdtips' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"></a>
			</header>

			<div class="entry-content">
				<?php if(has_post_thumbnail()): ?>
					<a href="<?php the_permalink(); ?>" class="thumbnail"><?php the_post_thumbnail('thumbnail'); ?></a>
				<?php endif; ?>
				<?php the_excerpt( ); ?>
			</div>
		</article>
<?php else: // Display for default ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'birdtips' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'birdtips' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><time class="postdate" datetime="<?php echo get_the_time('Y-m-d') ?>" pubdate><?php birdtips_the_date(); ?></time></a>
		</header>

		<div class="entry-content">
			<?php if(has_post_thumbnail()): ?>
				<a href="<?php the_permalink(); ?>" class="thumbnail"><?php the_post_thumbnail('medium'); ?></a>
			<?php endif; ?>
			<?php the_content( __( 'Continue reading', 'birdtips' ) ); ?>
			<?php wp_link_pages( array(
				'before'		=> '<div class="page-link">' . __( 'Pages:', 'birdtips' ),
				'after'			=> '</div>',
				'link_before'	=> '<span>',
				'link_after'	=> '</span>'
				) ); ?>
		</div>

		<footer class="entry-meta">
			<span  class="author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span><span class="category"><?php the_category(', ') ?></span>
			<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
				<span class="comment"><?php comments_popup_link(__('No Comments', 'birdtips'), __('1 Comment', 'birdtips'), __('% Comments', 'birdtips'), '', __('Comments Closed', 'birdtips') ); ?></span>
			<?php endif; ?>
		</footer>
	</article>
<?php endif; ?>
