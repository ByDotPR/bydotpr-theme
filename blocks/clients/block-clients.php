<?php
/**
 * Bloque: Barra de clientes
 * Línea inferior (90% de ancho, centrada, altura ajustable) — igual estilo
 * que la línea del bloque "Por qué nosotros", pero SOLO abajo, sin línea arriba.
 */
bydotpr_enqueue_block_asset( 'clients' );

$clients = get_field( 'clients' );
$line_bottom_h = get_field( 'clients_line_bottom_height' );
$line_bottom_h = ( $line_bottom_h === '' || $line_bottom_h === null ) ? 2 : $line_bottom_h;

if ( ! $clients ) {
	return;
}
?>
<section class="b-clients">
	<div class="b-clients__track container">
		<?php foreach ( $clients as $client ) :
			$logo = $client['logo'];
			if ( ! $logo ) { continue; }
			?>
			<div class="b-clients__item">
				<img
					src="<?php echo esc_url( $logo['sizes']['client-logo'] ?? $logo['url'] ); ?>"
					alt="<?php echo esc_attr( $client['name'] ?: $logo['alt'] ); ?>"
					loading="lazy"
					decoding="async"
					width="160" height="56"
				>
			</div>
		<?php endforeach; ?>
	</div>

	<div class="b-clients__line" style="height:<?php echo esc_attr( $line_bottom_h ); ?>px;"></div>
</section>