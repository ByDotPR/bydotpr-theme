<?php
/**
 * By DOT PR — functions.php
 * Mantener este archivo como orquestador. Toda la lógica real vive en /inc.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BYDOTPR_VERSION', '1.2.3' );
define( 'BYDOTPR_DIR', get_template_directory() );
define( 'BYDOTPR_URI', get_template_directory_uri() );

// Aviso si ACF Pro no está activo (los bloques dependen de él).
add_action( 'admin_notices', function () {
	if ( ! class_exists( 'ACF' ) ) {
		echo '<div class="notice notice-error"><p><strong>By DOT PR theme:</strong> este theme requiere Advanced Custom Fields PRO activo para que los bloques funcionen.</p></div>';
	}
} );

require BYDOTPR_DIR . '/inc/setup.php';       // soporte de theme, menús, imágenes
require BYDOTPR_DIR . '/inc/performance.php'; // quitar bloat de WP, lazy loading, fonts
require BYDOTPR_DIR . '/inc/assets.php';      // enqueue de CSS/JS
require BYDOTPR_DIR . '/inc/helpers.php';     // funciones compartidas (íconos RRSS, etc.)
require BYDOTPR_DIR . '/inc/options-pages.php'; // ACF Options Page: Header / Footer
require BYDOTPR_DIR . '/inc/plugin-management.php'; // control de plugins al activar el theme
require BYDOTPR_DIR . '/inc/updates.php'; // chequeo de actualizaciones vía GitHub
require BYDOTPR_DIR . '/inc/acf-blocks.php';  // registro de bloques ACF
