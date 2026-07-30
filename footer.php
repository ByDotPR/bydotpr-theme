<footer class="site-footer container">
		<a class="site-footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php
			$f_logo_image = get_field( 'footer_logo_image', 'option' );
			$f_logo_text  = get_field( 'footer_logo_text', 'option' ) ?: 'DOT';

			if ( $f_logo_image ) :
				?>
				<img src="<?php echo esc_url( $f_logo_image['url'] ); ?>" alt="<?php echo esc_attr( $f_logo_image['alt'] ?: get_bloginfo( 'name' ) ); ?>" width="90" height="30">
			<?php else : ?>
				<?php echo esc_html( $f_logo_text ); ?><span class="site-footer__logo-dot" aria-hidden="true"></span>
			<?php endif; ?>
		</a>

		<nav class="site-footer__nav">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'container'      => false,
				'fallback_cb'    => false,
			) );
			?>
		</nav>

		<?php
		$f_social = get_field( 'footer_social', 'option' );
		if ( $f_social ) :
			?>
			<div class="site-footer__social">
				<?php foreach ( $f_social as $link ) :
					$platform = $link['platform'];
					$url      = $link['url'];
					if ( ! $url || ! $platform ) { continue; }
					?>
					<a class="site-footer__social-icon" href="<?php echo esc_url( $url ); ?>" aria-label="<?php echo esc_attr( ucfirst( $platform ) ); ?>" target="_blank" rel="noopener">
						<?php echo bydotpr_social_icon( $platform ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<p class="site-footer__copy">
			&copy; 2003 - <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
			<?php echo esc_html( get_field( 'footer_copyright', 'option' ) ?: 'Todos los derechos reservados.' ); ?>
		</p>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>