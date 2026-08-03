<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_setup_theme', function () {

	// Soportes mínimos — no activar cosas que no vamos a usar (evita CSS/JS extra de WP).
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' ); // por si insertas algún bloque nativo puntual

	// NO agregamos 'editor-styles' ni 'wp-block-styles' completos: este theme no usa FSE,
	// solo bloques ACF a medida, así evitamos cargar el CSS de bloques nativos innecesario.

	register_nav_menus( array(
		'primary' => __( 'Menú principal', 'bydotpr' ),
		'footer'  => __( 'Menú de footer', 'bydotpr' ),
	) );

	// Tamaños de imagen calcados a la hoja de specs del wireframe (evita que WP genere
	// tamaños de más que nunca se usan y pesan en la librería de medios).
	add_image_size( 'hero-desktop', 1200, 840, true );
	add_image_size( 'hero-tablet', 700, 420, true );
	add_image_size( 'hero-mobile', 375, 220, true );
	add_image_size( 'service-card', 600, 400, true );
	add_image_size( 'blog-card', 640, 427, true );
	add_image_size( 'client-logo', 160, 56, false );

} );

// Quitar tamaños de imagen por defecto de WP que no usamos (medium_large, 1536x1536, 2048x2048).
add_filter( 'intermediate_image_sizes_advanced', function ( $sizes ) {
	unset( $sizes['medium_large'] );
	unset( $sizes['1536x1536'] );
	unset( $sizes['2048x2048'] );
	return $sizes;
} );

// Desactivar tamaños nativos que no necesitamos (thumbnail se queda para admin, medium/large fuera).
add_filter( 'intermediate_image_sizes', function ( $sizes ) {
	return array_diff( $sizes, array( 'medium', 'large' ) );
} );
