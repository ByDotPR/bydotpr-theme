<?php
/**
 * Bloque: Servicios (slider)
 * Full-bleed (ocupa todo el ancho de pantalla, no el --container). Flechas
 * flotando dentro de las imágenes (izquierda/derecha), sin espacio entre tarjetas.
 */
bydotpr_enqueue_block_asset( 'services' );
wp_enqueue_script( 'bydotpr-services-slider', BYDOTPR_URI . '/blocks/services/slider.js', array(), BYDOTPR_VERSION, true );

$title    = get_field( 'services_title' );
$services = get_field( 'services' );
if ( ! $services ) {
	return;
}

$slider_id = 'services-slider-' . wp_unique_id();

// El atributo "anchor" del bloque no se imprime solo en templates PHP manuales
// (solo pasa automático con get_block_wrapper_attributes()) — lo sacamos del
// array $block y lo agregamos a mano. Fallback a "servicios" si no se configuró.
$anchor_id = ! empty( $block['anchor'] ) ? $block['anchor'] : 'services';
?>
<section class="b-services" id="<?php echo esc_attr( $anchor_id ); ?>">

	<?php if ( $title ) : ?>
		<div class="b-services__head container">
			<h2 class="b-services__title"><?php echo esc_html( $title ); ?></h2>
		</div>
	<?php endif; ?>

	<div class="b-services__slider">
		<button type="button" class="b-services__arrow b-services__arrow--prev" data-slider-prev="<?php echo esc_attr( $slider_id ); ?>" aria-label="Anterior">‹</button>

		<div class="b-services__track" id="<?php echo esc_attr( $slider_id ); ?>" data-services-track>
			<?php foreach ( $services as $service ) :
				$image = $service['image'];
				$link  = $service['link'];
				$tag   = $link ? 'a' : 'div';
				?>
				<<?php echo $tag; ?> class="b-services__card" <?php echo $link ? 'href="' . esc_url( $link ) . '"' : ''; ?>>
					<?php if ( $image ) : ?>
						<img
							class="b-services__image"
							src="<?php echo esc_url( $image['sizes']['service-card'] ?? $image['url'] ); ?>"
							alt="<?php echo esc_attr( $image['alt'] ); ?>"
							loading="lazy"
							decoding="async"
							width="600" height="400"
						>
					<?php endif; ?>
					<div class="b-services__overlay" aria-hidden="true"></div>
					<h3 class="b-services__card-title"><?php echo esc_html( $service['title'] ); ?></h3>
				</<?php echo $tag; ?>>
			<?php endforeach; ?>
		</div>
		<button type="button" class="b-services__arrow b-services__arrow--next is-active" data-slider-next="<?php echo esc_attr( $slider_id ); ?>" aria-label="Siguiente">›</button>
	</div>

</section>