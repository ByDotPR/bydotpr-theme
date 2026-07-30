<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header container">
	<a class="site-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		$logo_image = get_field( 'header_logo_image', 'option' );
		$logo_text  = get_field( 'header_logo_text', 'option' ) ?: 'DOT';

		if ( $logo_image ) :
			?>
			<img src="<?php echo esc_url( $logo_image['url'] ); ?>" alt="<?php echo esc_attr( $logo_image['alt'] ?: get_bloginfo( 'name' ) ); ?>" width="120" height="40">
		<?php else : ?>
			<?php echo esc_html( $logo_text ); ?><span class="site-header__logo-dot" aria-hidden="true"></span>
		<?php endif; ?>
	</a>

	<button class="site-header__toggle" data-menu-toggle aria-expanded="false" aria-controls="primary-menu">
		<span class="sr-only">Menú</span>
		☰
	</button>

	<nav id="primary-menu" data-menu class="site-header__nav">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'container'      => false,
			'fallback_cb'    => false,
		) );
		?>
	</nav>
</header>