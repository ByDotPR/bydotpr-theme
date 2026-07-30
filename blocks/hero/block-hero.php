<?php
/**
 * Bloque: Hero
 * Full-bleed: imagen de fondo (LCP candidate -> eager + fetchpriority high) con
 * overlay oscuro para legibilidad. Headline en 3 líneas independientes.
 * Subtítulo y CTA van en la misma fila, alineados (párrafo izquierda, botón derecha).
 */
bydotpr_enqueue_block_asset( 'hero' );

$line1    = get_field( 'hero_title_line1' );
$line2    = get_field( 'hero_title_line2' );
$accent   = get_field( 'hero_title_accent' );
$subtitle = get_field( 'hero_subtitle' );
$cta_text = get_field( 'hero_cta_text' );
$cta_link = get_field( 'hero_cta_link' );
$image    = get_field( 'hero_image' );
$video    = get_field( 'hero_video' );
?>
<section class="b-hero">

	<div class="b-hero__bg">
		<?php if ( $video ) : ?>
			<video class="b-hero__video" autoplay muted loop playsinline
				poster="<?php echo $image ? esc_url( $image['sizes']['hero-desktop'] ) : ''; ?>">
				<source src="<?php echo esc_url( $video['url'] ); ?>" type="video/mp4">
			</video>
		<?php elseif ( $image ) : ?>
			<picture>
				<source media="(max-width: 480px)" srcset="<?php echo esc_url( $image['sizes']['hero-mobile'] ); ?>">
				<source media="(max-width: 900px)" srcset="<?php echo esc_url( $image['sizes']['hero-tablet'] ); ?>">
				<img
					src="<?php echo esc_url( $image['sizes']['hero-desktop'] ); ?>"
					alt="<?php echo esc_attr( $image['alt'] ); ?>"
					width="1200" height="840"
					loading="eager"
					fetchpriority="high"
					decoding="async"
				>
			</picture>
		<?php endif; ?>
		<div class="b-hero__overlay" aria-hidden="true"></div>
	</div>

	<div class="b-hero__inner">

		<?php if ( $line1 || $line2 || $accent ) : ?>
			<h1 class="b-hero__title">
				<?php if ( $line1 ) : ?><span class="b-hero__title-line1"><?php echo esc_html( $line1 ); ?></span><?php endif; ?>
				<?php if ( $line2 ) : ?><span class="b-hero__title-line2"><?php echo esc_html( $line2 ); ?></span><?php endif; ?>
				<?php if ( $accent ) : ?><em class="b-hero__title-accent"><?php echo esc_html( $accent ); ?></em><?php endif; ?>
			</h1>
		<?php endif; ?>

		<div class="b-hero__bottom-row">
			<?php if ( $subtitle ) : ?>
				<p class="b-hero__subtitle"><?php echo esc_html( $subtitle ); ?></p>
			<?php endif; ?>

			<?php if ( $cta_text && $cta_link ) : ?>
				<a class="b-hero__cta" href="<?php echo esc_url( $cta_link ); ?>"><?php echo esc_html( $cta_text ); ?></a>
			<?php endif; ?>
		</div>

	</div>

</section>