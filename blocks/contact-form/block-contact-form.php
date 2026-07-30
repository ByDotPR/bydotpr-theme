<?php
/**
 * Bloque: Formulario de contacto
 * Sin columna de imagen — formulario centrado, ancho limitado (~33% del
 * contenedor en desktop) usando el shortcode de Contact Form 7.
 */
bydotpr_enqueue_block_asset( 'contact-form' );

$title     = get_field( 'contact_title' );
$shortcode = get_field( 'contact_cf7_shortcode' );

$anchor_id = ! empty( $block['anchor'] ) ? $block['anchor'] : 'contact';
?>
<section class="b-contact" id="<?php echo esc_attr( $anchor_id ); ?>">

	<div class="b-contact__form-col">
		<?php if ( $title ) : ?>
			<h2 class="b-contact__title"><?php echo esc_html( $title ); ?></h2>
		<?php endif; ?>

		<?php if ( $shortcode ) : ?>
			<div class="b-contact__cf7">
				<?php echo do_shortcode( $shortcode ); ?>
			</div>
		<?php else : ?>
			<p class="b-contact__missing">Pega el shortcode de Contact Form 7 en los campos del bloque.</p>
		<?php endif; ?>
	</div>

</section>