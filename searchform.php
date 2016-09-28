<?php
/**
 * The template for displaying search form.
 *
 * @package WordPress
 * @subpackage BirdTIPS
 * @since BirdTIPS 1.07
 */
?>
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<div><label class="screen-reader-text" for="s">Search for:</label>
		<input type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s" placeholder="<?php _e( 'Search...', 'birdtips' ) ?>">
		<button type="submit" value="Search" id="searchsubmit" class="submit"><span class="screen-reader-text">Search</span></button>
	</div>
</form>