<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugins que el theme requiere para funcionar.
 * IMPORTANTE: este archivo NUNCA activa ni desactiva plugins automáticamente.
 * Solo muestra un aviso informativo en el admin — cualquier plugin existente
 * en el sitio (con o sin licencia) queda intacto, sin importar cuál sea.
 */
function bydotpr_required_plugins() {
	return array(
		'advanced-custom-fields-pro/acf.php'   => 'Advanced Custom Fields PRO',
		'contact-form-7/wp-contact-form-7.php' => 'Contact Form 7',
	);
}

/**
 * Aviso persistente en el admin si falta ACF Pro o Contact Form 7 —
 * es solo informativo, no toca ningún plugin existente.
 */
add_action( 'admin_notices', function () {

	$active_plugins = (array) get_option( 'active_plugins', array() );
	if ( is_multisite() ) {
		$active_plugins = array_merge( $active_plugins, array_keys( (array) get_site_option( 'active_sitewide_plugins', array() ) ) );
	}

	$missing = array();
	foreach ( bydotpr_required_plugins() as $path => $name ) {
		if ( ! in_array( $path, $active_plugins, true ) ) {
			$missing[] = $name;
		}
	}

	if ( $missing ) {
		echo '<div class="notice notice-warning"><p><strong>By DOT PR theme:</strong> faltan activar estos plugins requeridos: ' . esc_html( implode( ', ', $missing ) ) . '.</p></div>';
	}

} );