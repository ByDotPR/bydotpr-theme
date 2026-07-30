<?php
/**
 * Bloque: Por qué nosotros
 * - Título centrado, tamaño ajustable desde ACF
 * - "DOT" es la imagen de fondo, con opacidad ajustable (why_bg_opacity)
 * - La persona va delante del fondo, superpuesta
 * - El adorno de puntos es una IMAGEN subible (why_accent_image), no CSS
 * - Línea arriba y línea abajo, ancho fijo 90% centrado, altura ajustable
 * - N columnas de texto (repeater, sin límite)
 */
bydotpr_enqueue_block_asset( 'why-us' );

$title         = get_field( 'why_title' );
$title_size    = get_field( 'why_title_size' ) ?: 3;
$bg_image      = get_field( 'why_bg_image' );
$bg_opacity    = get_field( 'why_bg_opacity' );
$bg_opacity    = ( $bg_opacity === '' || $bg_opacity === null ) ? 15 : $bg_opacity;
$person_image  = get_field( 'why_person_image' );
$accent_image  = get_field( 'why_accent_image' );
$accent_width  = get_field( 'why_accent_width' );
$accent_width  = ( $accent_width === '' || $accent_width === null ) ? 140 : $accent_width;
$accent_top    = get_field( 'why_accent_top' );
$accent_top    = ( $accent_top === '' || $accent_top === null ) ? 55 : $accent_top;
$accent_left   = get_field( 'why_accent_left' );
$accent_left   = ( $accent_left === '' || $accent_left === null ) ? 78 : $accent_left;

$accent_width_m = get_field( 'why_accent_width_mobile' );
$accent_width_m = ( $accent_width_m === '' || $accent_width_m === null ) ? 80 : $accent_width_m;
$accent_top_m   = get_field( 'why_accent_top_mobile' );
$accent_top_m   = ( $accent_top_m === '' || $accent_top_m === null ) ? 8 : $accent_top_m;
$accent_left_m  = get_field( 'why_accent_left_mobile' );
$accent_left_m  = ( $accent_left_m === '' || $accent_left_m === null ) ? 82 : $accent_left_m;
$line_top_h    = get_field( 'why_line_top_height' ) ?: 2;
$line_bottom_h = get_field( 'why_line_bottom_height' ) ?: 2;
$columns       = get_field( 'why_columns' );
?>
<section class="b-why">

	<div class="b-why__line b-why__line--top" style="height:<?php echo esc_attr( $line_top_h ); ?>px;"></div>

	<div class="b-why__inner container">

		<?php if ( $title ) : ?>
			<h2 class="b-why__title" style="font-size:<?php echo esc_attr( $title_size ); ?>rem;">
				<?php echo esc_html( $title ); ?>
			</h2>
		<?php endif; ?>

		<div class="b-why__visual-wrap">

			<?php if ( $accent_image ) : ?>
				<img
					class="b-why__accent"
					src="<?php echo esc_url( $accent_image['url'] ); ?>"
					alt=""
					loading="lazy"
					decoding="async"
					aria-hidden="true"
					style="
						--accent-w: <?php echo esc_attr( $accent_width ); ?>px;
						--accent-top: <?php echo esc_attr( $accent_top ); ?>%;
						--accent-left: <?php echo esc_attr( $accent_left ); ?>%;
						--accent-w-m: <?php echo esc_attr( $accent_width_m ); ?>px;
						--accent-top-m: <?php echo esc_attr( $accent_top_m ); ?>%;
						--accent-left-m: <?php echo esc_attr( $accent_left_m ); ?>%;
					"
				>
			<?php endif; ?>

			<div class="b-why__visual">
				<?php if ( $bg_image ) : ?>
					<img
						class="b-why__bg"
						src="<?php echo esc_url( $bg_image['url'] ); ?>"
						alt=""
						loading="lazy"
						decoding="async"
						aria-hidden="true"
						style="opacity:<?php echo esc_attr( $bg_opacity / 100 ); ?>;"
					>
				<?php endif; ?>

				<?php if ( $person_image ) : ?>
					<img
						class="b-why__person"
						src="<?php echo esc_url( $person_image['url'] ); ?>"
						alt="<?php echo esc_attr( $person_image['alt'] ); ?>"
						loading="lazy"
						decoding="async"
					>
				<?php endif; ?>
			</div>

		</div>

		<?php if ( $columns ) : ?>
			<div class="b-why__columns">
				<?php foreach ( $columns as $col ) : ?>
					<p class="b-why__column-text"><?php echo esc_html( $col['paragraph'] ); ?></p>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</div>

	<div class="b-why__line b-why__line--bottom" style="height:<?php echo esc_attr( $line_bottom_h ); ?>px;"></div>

</section>