<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'acf/init', function () {

	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	acf_add_options_page( array(
		'page_title' => 'Ajustes del sitio',
		'menu_title' => 'Ajustes del sitio',
		'menu_slug'  => 'ajustes-del-sitio',
		'capability' => 'edit_theme_options',
		'redirect'   => true,
	) );

	acf_add_options_sub_page( array(
		'page_title'  => 'Header',
		'menu_title'  => 'Header',
		'parent_slug' => 'ajustes-del-sitio',
		'menu_slug'   => 'ajustes-header',
	) );

	acf_add_options_sub_page( array(
		'page_title'  => 'Footer',
		'menu_title'  => 'Footer',
		'parent_slug' => 'ajustes-del-sitio',
		'menu_slug'   => 'ajustes-footer',
	) );

} );