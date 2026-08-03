<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require BYDOTPR_DIR . '/inc/vendor/plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

add_action( 'init', function () {

	$update_checker = PucFactory::buildUpdateChecker(
		'https://github.com/TU-USUARIO-O-ORG/bydotpr-theme/', // <-- CAMBIA esto por la URL real
		BYDOTPR_DIR . '/style.css',
		'bydotpr' // debe coincidir con el nombre de la carpeta del theme
	);

	// Repo público -> no necesita token de autenticación.
	// Revisa la rama "main": cualquier push ahí con la versión subida en
	// style.css dispara el aviso de actualización en el admin de WordPress.
	$update_checker->setBranch( 'main' );

} );
