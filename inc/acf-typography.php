<?php
/**
 * Peso tipográfico editable por bloque (Hero, About, Por qué nosotros).
 * Cada peso listado aquí DEBE tener su @font-face en assets/css/main.css.
 */

function bydotpr_title_weights() {
	return array(
		'300' => 'Light (300)',
		'400' => 'Book (400)',
		'500' => 'Medium (500)',
		'600' => 'Demi (600)',
		'700' => 'Bold (700)',
		'800' => 'Extra Bold (800)',
		'900' => 'Heavy (900)',
	);
}

/**
 * Peso elegido para el título de un bloque, validado. Si no es válido, 700.
 */
function bydotpr_title_weight( $field_name ) {
	$value = (string) get_field( $field_name );
	return array_key_exists( $value, bydotpr_title_weights() ) ? $value : '700';
}

/**
 * Peso elegido para un acento. Devuelve '' si es "igual que el título" o no es válido.
 */
function bydotpr_accent_weight( $field_name ) {
	$value = (string) get_field( $field_name );
	return array_key_exists( $value, bydotpr_title_weights() ) ? $value : '';
}

add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$blocks = array(
		'hero'   => 'Hero',
		'about'  => 'About',
		'why-us' => 'Por qué nosotros',
	);

	foreach ( $blocks as $slug => $label ) {
		$id = str_replace( '-', '_', $slug );

		$fields = array(
			array(
				'key'           => "field_{$id}_title_weight",
				'label'         => 'Peso del título',
				'name'          => "{$id}_title_weight",
				'type'          => 'select',
				'instructions'  => 'Grosor de la tipografía de los títulos de este bloque.',
				'choices'       => bydotpr_title_weights(),
				'default_value' => '700',
				'allow_null'    => 0,
				'return_format' => 'value',
			),
		);

		// Solo el Hero tiene una línea de acento con peso propio.
		if ( 'hero' === $slug ) {
			$fields[] = array(
				'key'           => 'field_hero_accent_weight',
				'label'         => 'Peso del acento',
				'name'          => 'hero_accent_weight',
				'type'          => 'select',
				'instructions'  => 'Grosor de la línea de acento (la de color). "Igual que el título" la deja con el mismo peso.',
				'choices'       => array( 'inherit' => 'Igual que el título' ) + bydotpr_title_weights(),
				'default_value' => 'inherit',
				'allow_null'    => 0,
				'return_format' => 'value',
			);
		}

		acf_add_local_field_group( array(
			'key'      => "group_typography_{$id}",
			'title'    => "Tipografía — {$label}",
			'fields'   => $fields,
			'location' => array(
				array(
					array(
						'param'    => 'block',
						'operator' => '==',
						'value'    => "acf/{$slug}",
					),
				),
			),
		) );
	}
} );