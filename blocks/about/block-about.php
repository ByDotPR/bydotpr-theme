<?php
/**
 * Bloque: About (párrafo 360°)
 * "public relations agency" comparte fila con "360°" (align-items: flex-end,
 * pegado a la parte baja del número) — NO es una línea separada.
 * El párrafo sí va aparte, debajo, indentado.
 */
bydotpr_enqueue_block_asset( 'about' );

$prefix      = get_field( 'about_prefix' );
$number      = get_field( 'about_number' );
$tagline     = get_field( 'about_tagline' );
$text        = get_field( 'about_text' );
$text_mobile = get_field( 'about_text_mobile' );

$watermark_letter = $text ? mb_strtoupper( mb_substr( trim( $text ), 0, 1, 'UTF-8' ), 'UTF-8' ) : '';

$anchor_id = ! empty( $block['anchor'] ) ? $block['anchor'] : 'about-us';
?>
<section class="b-about" id="<?php echo esc_attr( $anchor_id ); ?>">

	<?php if ( $watermark_letter ) : ?>
		<span class="b-about__watermark" aria-hidden="true"><?php echo esc_html( $watermark_letter ); ?></span>
	<?php endif; ?>

	<div class="b-about__inner">

		<?php if ( $prefix ) : ?>
			<p class="b-about__prefix"><?php echo esc_html( $prefix ); ?></p>
		<?php endif; ?>

		<?php if ( $number || $tagline ) : ?>
			<div class="b-about__number-row">
				<?php if ( $number ) : ?>
					<span class="b-about__number"><?php echo esc_html( $number ); ?></span>
				<?php endif; ?>
				<?php if ( $tagline ) : ?>
					<span class="b-about__tagline"><?php echo esc_html( $tagline ); ?></span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $text ) : ?>
			<p class="b-about__text b-about__text--full"><?php echo esc_html( $text ); ?></p>
		<?php endif; ?>

		<?php if ( $text_mobile ) : ?>
			<p class="b-about__text b-about__text--mobile"><?php echo esc_html( $text_mobile ); ?></p>
		<?php endif; ?>

	</div>

</section>