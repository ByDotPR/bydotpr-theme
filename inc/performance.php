<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Quitar el peso muerto que WordPress carga por defecto en el front.
 */
add_action( 'init', function () {

	// Emojis (script + CSS + hooks en TinyMCE).
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// oEmbed discovery/JS que casi nunca se usa en una landing.
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );

	// Metadatos que no aportan y sí generan requests/head bloat.
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );

	// Heartbeat API solo en admin, nunca en front.
	if ( ! is_admin() ) {
		wp_deregister_script( 'heartbeat' );
	}

} );

// Quitar jQuery Migrate (jQuery en sí lo dejamos por compatibilidad de plugins de formulario,
// pero Migrate no se necesita en un theme nuevo).
add_action( 'wp_default_scripts', function ( $scripts ) {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) {
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
} );

// Dejar de cargar el CSS completo de bloques nativos de Gutenberg (wp-block-library);
// nuestras secciones son bloques ACF con su propio CSS, no bloques nativos.
add_action( 'wp_enqueue_scripts', function () {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' ); // por si WooCommerce está activo en la red de sitios
	wp_dequeue_style( 'global-styles' );  // CSS de theme.json que no usamos (no hacemos FSE)
	wp_dequeue_style( 'classic-theme-styles' );
}, 100 );

/**
 * Lazy loading nativo + fetchpriority en imágenes que no sean el hero.
 * El bloque hero marca su <img> manualmente con loading="eager" fetchpriority="high",
 * así que aquí solo garantizamos que TODO lo demás sea lazy por defecto (ya es el default
 * de WP desde 5.5+, esto es un refuerzo explícito).
 */
add_filter( 'wp_img_tag_add_loading_attr', function ( $value, $image, $context ) {
	return $value ? $value : 'lazy';
}, 10, 3 );

/**
 * Self-host de fuentes: preload de la fuente crítica usada en el H1 del hero.
 * Reemplaza 'inter-var.woff2' por el archivo real una vez el diseñador confirme la tipografía.
 */
add_action( 'wp_head', function () {
	$font = BYDOTPR_URI . '/assets/fonts/inter-var.woff2';
	echo '<link rel="preload" href="' . esc_url( $font ) . '" as="font" type="font/woff2" crossorigin>' . "\n";
}, 1 );

/**
 * Quitar la query string de versión en assets propios del theme (mejor cacheo en CDN/proxy).
 * OJO: solo aplica a nuestros propios enqueues via BYDOTPR_VERSION, no rompe cache-busting
 * porque subimos BYDOTPR_VERSION manualmente en cada deploy.
 */
add_filter( 'style_loader_src', 'bydotpr_clean_asset_version', 10, 1 );
add_filter( 'script_loader_src', 'bydotpr_clean_asset_version', 10, 1 );
function bydotpr_clean_asset_version( $src ) {
	if ( strpos( $src, 'bydotpr' ) !== false && strpos( $src, get_template_directory_uri() ) !== false ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
