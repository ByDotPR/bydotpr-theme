<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'acf/init', function () {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	/* ---------------- HERO ---------------- */
	acf_add_local_field_group( array(
		'key'      => 'group_hero',
		'title'    => 'Bloque: Hero',
		'fields'   => array(
			array(
				'key'   => 'field_hero_title_line1',
				'label' => 'Título — línea 1',
				'name'  => 'hero_title_line1',
				'type'  => 'text',
				'default_value' => 'PUBLIC RELATIONS',
			),
			array(
				'key'   => 'field_hero_title_line2',
				'label' => 'Título — línea 2 (con tabulación, más grande)',
				'name'  => 'hero_title_line2',
				'type'  => 'text',
				'default_value' => 'AGENCY THROUGH A',
			),
			array(
				'key'   => 'field_hero_title_accent',
				'label' => 'Título — línea 3 (itálica/acento, alineada con línea 1)',
				'name'  => 'hero_title_accent',
				'type'  => 'text',
				'default_value' => 'MARKETING LENS',
				'instructions' => 'Se muestra en itálica, más pequeña, con el verde DOT Lime.',
			),
			array(
				'key'   => 'field_hero_subtitle',
				'label' => 'Subtítulo',
				'name'  => 'hero_subtitle',
				'type'  => 'textarea',
				'rows'  => 2,
				'default_value' => 'A specialized data-driven agency turning insights into strategies, and strategies into measurable results.',
			),
			array(
				'key'   => 'field_hero_cta_text',
				'label' => 'Texto del CTA',
				'name'  => 'hero_cta_text',
				'type'  => 'text',
				'default_value' => 'Contact us',
			),
			array(
				'key'   => 'field_hero_cta_link',
				'label' => 'Link del CTA',
				'name'  => 'hero_cta_link',
				'type'  => 'url',
			),
			array(
				'key'      => 'field_hero_image',
				'label'    => 'Imagen / poster de video (1200×840px)',
				'name'     => 'hero_image',
				'type'     => 'image',
				'return_format' => 'array',
				'preview_size'  => 'hero-desktop',
			),
			array(
				'key'   => 'field_hero_video',
				'label' => 'Video de fondo (opcional, mp4)',
				'name'  => 'hero_video',
				'type'  => 'file',
				'mime_types' => 'mp4',
			),
		),
		'location' => array( array( array( 'param' => 'block', 'operator' => '==', 'value' => 'acf/hero' ) ) ),
	) );

	/* ---------------- ABOUT ---------------- */
	acf_add_local_field_group( array(
		'key'    => 'group_about',
		'title'  => 'Bloque: About (párrafo 360°)',
		'fields' => array(
			array(
				'key'   => 'field_about_prefix',
				'label' => 'Texto pequeño previo',
				'name'  => 'about_prefix',
				'type'  => 'text',
				'default_value' => 'DOT is a',
			),
			array(
				'key'   => 'field_about_number',
				'label' => 'Número grande',
				'name'  => 'about_number',
				'type'  => 'text',
				'default_value' => '360°',
			),
			array(
				'key'   => 'field_about_tagline',
				'label' => 'Frase itálica (junto al número)',
				'name'  => 'about_tagline',
				'type'  => 'text',
				'default_value' => 'public relations agency',
			),
			array(
				'key'   => 'field_about_text',
				'label' => 'Párrafo completo (desktop/tablet)',
				'name'  => 'about_text',
				'type'  => 'textarea',
				'rows'  => 6,
				'instructions' => 'La letra gigante de fondo se genera automáticamente con la PRIMERA letra de este párrafo — no es una imagen ni un campo aparte.',
				'default_value' => 'Specialized in strategic communications and public relations. We help brands build meaningful connections with their audiences through integrated strategies that combine public relations, media relations, influencer marketing, digital communications, brand positioning, events, and reputation management. By approaching communications through a marketing lens, we ensure every initiative aligns with business objectives, strengthens brand equity, and delivers measurable results. Our team blends creativity, data, and innovation to create impactful campaigns that elevate visibility, foster engagement, and drive long-term growth.',
			),
			array(
				'key'   => 'field_about_text_mobile',
				'label' => 'Versión corta (mobile)',
				'name'  => 'about_text_mobile',
				'type'  => 'textarea',
				'rows'  => 3,
				'instructions' => 'Se muestra solo en mobile en vez del párrafo completo.',
			),
		),
		'location' => array( array( array( 'param' => 'block', 'operator' => '==', 'value' => 'acf/about' ) ) ),
	) );

	/* ---------------- CLIENTS ---------------- */
	acf_add_local_field_group( array(
		'key'    => 'group_clients',
		'title'  => 'Bloque: Barra de clientes',
		'fields' => array(
			array(
				'key'   => 'field_clients_line_bottom_height',
				'label' => 'Altura línea inferior (px)',
				'name'  => 'clients_line_bottom_height',
				'type'  => 'number',
				'default_value' => 2,
			),
			array(
				'key'          => 'field_clients_repeater',
				'label'        => 'Logos de clientes',
				'name'         => 'clients',
				'type'         => 'repeater',
				'layout'       => 'table',
				'button_label' => 'Agregar cliente',
				'sub_fields'   => array(
					array(
						'key'    => 'field_client_logo',
						'label'  => 'Logo (SVG o PNG transparente, 160×56px)',
						'name'   => 'logo',
						'type'   => 'image',
						'return_format' => 'array',
						'preview_size'  => 'client-logo',
					),
					array(
						'key'   => 'field_client_name',
						'label' => 'Nombre (alt text)',
						'name'  => 'name',
						'type'  => 'text',
					),
				),
			),
		),
		'location' => array( array( array( 'param' => 'block', 'operator' => '==', 'value' => 'acf/clients' ) ) ),
	) );

	/* ---------------- SERVICES ---------------- */
	acf_add_local_field_group( array(
		'key'    => 'group_services',
		'title'  => 'Bloque: Servicios (slider)',
		'fields' => array(
			array(
				'key'   => 'field_services_title',
				'label' => 'Título de sección',
				'name'  => 'services_title',
				'type'  => 'text',
				'default_value' => 'Our services',
			),
			array(
				'key'          => 'field_services_repeater',
				'label'        => 'Servicios',
				'name'         => 'services',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Agregar servicio',
				'min'          => 1,
				/* Sin 'max' -> el cliente puede agregar los que necesite, el slider se ajusta solo */
				'sub_fields'   => array(
					array(
						'key'   => 'field_service_icon',
						'label' => 'Ícono (SVG)',
						'name'  => 'icon',
						'type'  => 'image',
						'return_format' => 'array',
						'mime_types'    => 'svg',
					),
					array(
						'key'   => 'field_service_image',
						'label' => 'Imagen (600×400px)',
						'name'  => 'image',
						'type'  => 'image',
						'return_format' => 'array',
						'preview_size'  => 'service-card',
					),
					array(
						'key'   => 'field_service_title',
						'label' => 'Título',
						'name'  => 'title',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_service_description',
						'label' => 'Descripción corta',
						'name'  => 'description',
						'type'  => 'textarea',
						'rows'  => 3,
					),
					array(
						'key'   => 'field_service_link',
						'label' => 'Link (opcional)',
						'name'  => 'link',
						'type'  => 'url',
					),
				),
			),
		),
		'location' => array( array( array( 'param' => 'block', 'operator' => '==', 'value' => 'acf/services' ) ) ),
	) );

	/* ---------------- WHY US ---------------- */
	acf_add_local_field_group( array(
		'key'    => 'group_why_us',
		'title'  => 'Bloque: Por qué nosotros',
		'fields' => array(
			array(
				'key'   => 'field_why_title',
				'label' => 'Título de sección',
				'name'  => 'why_title',
				'type'  => 'text',
				'default_value' => 'Por qué nosotros',
			),
			array(
				'key'   => 'field_why_title_size',
				'label' => 'Tamaño del título (rem)',
				'name'  => 'why_title_size',
				'type'  => 'number',
				'step'  => 0.1,
				'default_value' => 3,
			),
			array(
				'key'   => 'field_why_bg_image',
				'label' => 'Imagen de fondo (el "DOT" grande)',
				'name'  => 'why_bg_image',
				'type'  => 'image',
				'return_format' => 'array',
			),
			array(
				'key'   => 'field_why_bg_opacity',
				'label' => 'Opacidad del fondo (%)',
				'name'  => 'why_bg_opacity',
				'type'  => 'number',
				'min'   => 0,
				'max'   => 100,
				'default_value' => 15,
			),
			array(
				'key'   => 'field_why_person_image',
				'label' => 'Imagen de la persona (va delante del fondo)',
				'name'  => 'why_person_image',
				'type'  => 'image',
				'return_format' => 'array',
			),
			array(
				'key'   => 'field_why_accent_image',
				'label' => 'Imagen del adorno (el detalle de puntos)',
				'name'  => 'why_accent_image',
				'type'  => 'image',
				'return_format' => 'array',
				'instructions' => 'Sube el asset del adorno que ya tienes diseñado.',
			),
			array(
				'key'   => 'field_why_accent_width',
				'label' => 'Ancho del adorno — desktop (px)',
				'name'  => 'why_accent_width',
				'type'  => 'number',
				'default_value' => 140,
			),
			array(
				'key'   => 'field_why_accent_top',
				'label' => 'Posición del adorno — arriba, desktop (%)',
				'name'  => 'why_accent_top',
				'type'  => 'number',
				'default_value' => 55,
			),
			array(
				'key'   => 'field_why_accent_left',
				'label' => 'Posición del adorno — izquierda, desktop (%)',
				'name'  => 'why_accent_left',
				'type'  => 'number',
				'default_value' => 78,
			),
			array(
				'key'   => 'field_why_accent_width_mobile',
				'label' => 'Ancho del adorno — mobile (px)',
				'name'  => 'why_accent_width_mobile',
				'type'  => 'number',
				'default_value' => 80,
				'instructions' => 'Se usa debajo de 640px de ancho de pantalla.',
			),
			array(
				'key'   => 'field_why_accent_top_mobile',
				'label' => 'Posición del adorno — arriba, mobile (%)',
				'name'  => 'why_accent_top_mobile',
				'type'  => 'number',
				'default_value' => 8,
			),
			array(
				'key'   => 'field_why_accent_left_mobile',
				'label' => 'Posición del adorno — izquierda, mobile (%)',
				'name'  => 'why_accent_left_mobile',
				'type'  => 'number',
				'default_value' => 82,
			),
			array(
				'key'   => 'field_why_line_top_height',
				'label' => 'Altura línea superior (px)',
				'name'  => 'why_line_top_height',
				'type'  => 'number',
				'default_value' => 2,
			),
			array(
				'key'   => 'field_why_line_bottom_height',
				'label' => 'Altura línea inferior (px)',
				'name'  => 'why_line_bottom_height',
				'type'  => 'number',
				'default_value' => 2,
			),
			array(
				'key'          => 'field_why_columns',
				'label'        => 'Columnas de texto',
				'name'         => 'why_columns',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Agregar columna',
				'min'          => 1,
				'sub_fields'   => array(
					array(
						'key'   => 'field_why_column_text',
						'label' => 'Párrafo',
						'name'  => 'paragraph',
						'type'  => 'textarea',
						'rows'  => 4,
						'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.',
					),
				),
			),
		),
		'location' => array( array( array( 'param' => 'block', 'operator' => '==', 'value' => 'acf/why-us' ) ) ),
	) );

	/* ---------------- SOCIAL ---------------- */
	acf_add_local_field_group( array(
		'key'    => 'group_social',
		'title'  => 'Bloque: RRSS',
		'fields' => array(
			array(
				'key'   => 'field_social_title',
				'label' => 'Texto de invitación',
				'name'  => 'social_title',
				'type'  => 'text',
				'default_value' => 'Follow us',
			),
			array(
				'key'          => 'field_social_repeater',
				'label'        => 'Redes',
				'name'         => 'social_links',
				'type'         => 'repeater',
				'layout'       => 'table',
				'button_label' => 'Agregar red',
				'sub_fields'   => array(
					array(
						'key'     => 'field_social_platform',
						'label'   => 'Plataforma',
						'name'    => 'platform',
						'type'    => 'select',
						'choices' => array(
							'instagram' => 'Instagram',
							'linkedin'  => 'LinkedIn',
							'facebook'  => 'Facebook',
							'tiktok'    => 'TikTok',
							'x'         => 'X / Twitter',
						),
					),
					array(
						'key'   => 'field_social_url',
						'label' => 'URL',
						'name'  => 'url',
						'type'  => 'url',
					),
				),
			),
		),
		'location' => array( array( array( 'param' => 'block', 'operator' => '==', 'value' => 'acf/social' ) ) ),
	) );

	/* ---------------- CONTACT FORM ---------------- */
	acf_add_local_field_group( array(
		'key'    => 'group_contact_form',
		'title'  => 'Bloque: Formulario de contacto',
		'fields' => array(
			array(
				'key'   => 'field_contact_title',
				'label' => 'Título de sección',
				'name'  => 'contact_title',
				'type'  => 'text',
				'default_value' => 'Formulario de contacto',
			),
			array(
				'key'   => 'field_contact_cf7_shortcode',
				'label' => 'Shortcode de Contact Form 7',
				'name'  => 'contact_cf7_shortcode',
				'type'  => 'text',
				'instructions' => 'Pega aquí el shortcode que te da CF7, ej: [contact-form-7 id="a1b2c3" title="Contacto"]',
			),
			array(
				'key'   => 'field_contact_side_image',
				'label' => 'Imagen al lado del formulario',
				'name'  => 'contact_side_image',
				'type'  => 'image',
				'return_format' => 'array',
			),
		),
		'location' => array( array( array( 'param' => 'block', 'operator' => '==', 'value' => 'acf/contact-form' ) ) ),
	) );

	/* ---------------- OPTIONS: HEADER ---------------- */
	acf_add_local_field_group( array(
		'key'    => 'group_options_header',
		'title'  => 'Header',
		'fields' => array(
			array(
				'key'   => 'field_opt_header_logo_text',
				'label' => 'Texto del logo',
				'name'  => 'header_logo_text',
				'type'  => 'text',
				'default_value' => 'DOT',
				'instructions' => 'Se usa si no subes una imagen de logo abajo.',
			),
			array(
				'key'   => 'field_opt_header_logo_image',
				'label' => 'Logo (imagen/SVG, opcional)',
				'name'  => 'header_logo_image',
				'type'  => 'image',
				'return_format' => 'array',
				'instructions' => 'Si se sube, reemplaza el texto de arriba.',
			),
		),
		'location' => array( array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'ajustes-header' ) ) ),
	) );

	/* ---------------- OPTIONS: FOOTER ---------------- */
	acf_add_local_field_group( array(
		'key'    => 'group_options_footer',
		'title'  => 'Footer',
		'fields' => array(
			array(
				'key'   => 'field_opt_footer_logo_text',
				'label' => 'Texto del logo',
				'name'  => 'footer_logo_text',
				'type'  => 'text',
				'default_value' => 'DOT',
			),
			array(
				'key'   => 'field_opt_footer_logo_image',
				'label' => 'Logo (imagen/SVG, opcional)',
				'name'  => 'footer_logo_image',
				'type'  => 'image',
				'return_format' => 'array',
			),
			array(
				'key'          => 'field_opt_footer_social',
				'label'        => 'Redes sociales',
				'name'         => 'footer_social',
				'type'         => 'repeater',
				'layout'       => 'table',
				'button_label' => 'Agregar red',
				'sub_fields'   => array(
					array(
						'key'     => 'field_opt_footer_social_platform',
						'label'   => 'Plataforma',
						'name'    => 'platform',
						'type'    => 'select',
						'choices' => bydotpr_social_platforms(),
					),
					array(
						'key'   => 'field_opt_footer_social_url',
						'label' => 'URL (o mailto:/tel: si es email/teléfono)',
						'name'  => 'url',
						'type'  => 'text',
					),
				),
			),
			array(
				'key'   => 'field_opt_footer_copyright',
				'label' => 'Texto de copyright',
				'name'  => 'footer_copyright',
				'type'  => 'text',
				'default_value' => 'All rights reserved.',
				'instructions' => 'El año y el nombre del sitio se agregan automáticamente antes de este texto.',
			),
		),
		'location' => array( array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'ajustes-footer' ) ) ),
	) );

	/* ---------------- BLOG POSTS ---------------- */
	acf_add_local_field_group( array(
		'key'    => 'group_blog_posts',
		'title'  => 'Bloque: Últimos blogs',
		'fields' => array(
			array(
				'key'   => 'field_blog_posts_title',
				'label' => 'Título de sección',
				'name'  => 'blog_posts_title',
				'type'  => 'text',
				'default_value' => 'From the blog',
			),
			array(
				'key'   => 'field_blog_posts_button_text',
				'label' => 'Texto del botón',
				'name'  => 'blog_posts_button_text',
				'type'  => 'text',
				'default_value' => 'View More',
			),
			array(
				'key'   => 'field_blog_posts_button_link',
				'label' => 'Link del botón (opcional)',
				'name'  => 'blog_posts_button_link',
				'type'  => 'url',
				'instructions' => 'Si se deja vacío, usa automáticamente la página de blog configurada en Ajustes > Lectura.',
			),
		),
		'location' => array( array( array( 'param' => 'block', 'operator' => '==', 'value' => 'acf/blog-posts' ) ) ),
	) );

} );