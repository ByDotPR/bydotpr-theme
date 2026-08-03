<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registrar cada bloque leyendo su block.json (ACF 6 soporta esto nativamente).
 * Para agregar un bloque nuevo: crear /blocks/nombre/block.json + block-nombre.php
 * y sumar la carpeta al array de abajo.
 */
add_filter( 'block_categories_all', function ( $categories ) {
	array_unshift( $categories, array(
		'slug'  => 'bydotpr',
		'title' => 'By DOT PR — Secciones',
	) );
	return $categories;
} );

add_action( 'init', function () {

	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return; // ACF Pro no está activo, ya se avisó en functions.php
	}

	$blocks = array( 'hero', 'about', 'clients', 'services', 'why-us', 'social', 'contact-form', 'blog-posts' );

	foreach ( $blocks as $block ) {
		$path = BYDOTPR_DIR . "/blocks/{$block}/block.json";
		if ( file_exists( $path ) ) {
			register_block_type( $path );
		}
	}

} );

/**
 * Restringir el editor de bloques (para el contenido de las páginas que usan este theme)
 * a únicamente nuestros bloques ACF + los básicos de texto. Evita que alguien meta un
 * bloque nativo pesado (galería, embeds) sin querer en una landing pensada para performance.
 */
add_filter( 'allowed_block_types_all', function ( $allowed, $context ) {
	return array(
		'core/paragraph',
		'core/heading',
		'core/list',
		'acf/hero',
		'acf/about',
		'acf/clients',
		'acf/services',
		'acf/why-us',
		'acf/social',
		'acf/contact-form',
		'acf/blog-posts',
	);
}, 10, 2 );

require BYDOTPR_DIR . '/inc/acf-fields.php';
