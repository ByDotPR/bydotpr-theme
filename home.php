<?php
/**
 * Página de posts (ej. /news/) — la que configuraste en Ajustes > Lectura.
 * WordPress usa ESTE archivo para esa página, no archive.php.
 * El contenido real vive en template-parts/blog-listing.php (compartido).
 */
get_header();
get_template_part( 'template-parts/blog-listing' );
get_footer();