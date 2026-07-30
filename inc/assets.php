<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_enqueue_scripts', function () {

	// Un solo CSS global mínimo (reset + layout + design tokens). Cada bloque agrega
	// su propio CSS solo si el bloque está presente en la página (ver acf-blocks.php).
	wp_enqueue_style(
		'bydotpr-main',
		BYDOTPR_URI . '/assets/css/main.css',
		array(),
		BYDOTPR_VERSION
	);

	// JS vanilla, sin jQuery, cargado en <footer> con defer.
	wp_enqueue_script(
		'bydotpr-main',
		BYDOTPR_URI . '/assets/js/main.js',
		array(),
		BYDOTPR_VERSION,
		true
	);
	wp_script_add_data( 'bydotpr-main', 'defer', true );

} );

/**
 * Helper para que cada bloque encole su propio CSS/JS solo cuando el bloque
 * realmente se está renderizando (evita cargar CSS de "servicios" en una página
 * que no lo usa). Se llama desde cada block-*.php.
 */
function bydotpr_enqueue_block_asset( $slug ) {
	$css_path = BYDOTPR_DIR . "/blocks/{$slug}/style.css";
	if ( file_exists( $css_path ) ) {
		wp_enqueue_style(
			"bydotpr-block-{$slug}",
			BYDOTPR_URI . "/blocks/{$slug}/style.css",
			array( 'bydotpr-main' ),
			BYDOTPR_VERSION
		);
	}
}
