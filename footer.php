	</div>

	<footer id="footer">

		<div class="site-title"><span class="home"><a href="<?php echo esc_url( home_url( '/' ) ) ; ?>"><?php bloginfo( 'name' ); ?></a></span>

			<?php if( get_theme_mod( 'birdtips_copyright', true ) ): ?>
				<?php printf(__( 'Copyright &copy; %s All Rights Reserved.', 'birdtips' ), birdtips_get_copyright_year() ); ?>
			<?php endif; ?>

			<?php if( get_theme_mod( 'birdtips_credit', true ) ): ?>
				<br>
				<span class="generator"><a href="<?php echo esc_url('http://wordpress.org/'); ?>" target="_blank"><?php _e( 'Proudly powered by WordPress', 'birdtips' ); ?></a></span>
			<?php printf(__( 'BirdTIPS theme by %sSysbird%s', 'birdtips' ), '<a href="' .esc_url('https://www.sysbird.jp') .'" target="_blank">', '</a>' ); ?>
			<?php endif; ?>
		</div>

		<p id="back-top"><a href="#top"><span><?php _e( 'Go Top', 'birdtips'); ?></span></a></p>

	</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>