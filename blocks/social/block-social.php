<?php
bydotpr_enqueue_block_asset( 'social' );

$title = get_field( 'social_title' );
$links = get_field( 'social_links' );
if ( ! $links ) {
	return;
}

// Íconos inline mínimos (SVG puro, sin cargar una librería de iconos completa).
$icons = array(
	'instagram' => '<svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path fill="currentColor" d="M12 2c2.7 0 3.05.01 4.12.06 1.07.05 1.8.22 2.43.47.66.26 1.22.6 1.77 1.15.55.55.89 1.11 1.15 1.77.25.63.42 1.36.47 2.43.05 1.07.06 1.42.06 4.12s-.01 3.05-.06 4.12c-.05 1.07-.22 1.8-.47 2.43-.26.66-.6 1.22-1.15 1.77-.55.55-1.11.89-1.77 1.15-.63.25-1.36.42-2.43.47-1.07.05-1.42.06-4.12.06s-3.05-.01-4.12-.06c-1.07-.05-1.8-.22-2.43-.47-.66-.26-1.22-.6-1.77-1.15-.55-.55-.89-1.11-1.15-1.77-.25-.63-.42-1.36-.47-2.43C2.01 15.05 2 14.7 2 12s.01-3.05.06-4.12c.05-1.07.22-1.8.47-2.43.26-.66.6-1.22 1.15-1.77.55-.55 1.11-.89 1.77-1.15.63-.25 1.36-.42 2.43-.47C8.95 2.01 9.3 2 12 2zm0 5a5 5 0 100 10 5 5 0 000-10zm0 8.2a3.2 3.2 0 110-6.4 3.2 3.2 0 010 6.4zm5.4-8.4a1.2 1.2 0 100 2.4 1.2 1.2 0 000-2.4z"/></svg>',
	'linkedin'  => '<svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path fill="currentColor" d="M4.98 3.5a2.5 2.5 0 11-.02 5 2.5 2.5 0 01.02-5zM3 9h4v12H3V9zm7 0h3.8v1.7h.05c.53-.95 1.83-1.95 3.77-1.95 4.03 0 4.78 2.5 4.78 5.75V21h-4v-5.6c0-1.34-.02-3.06-1.87-3.06-1.87 0-2.16 1.46-2.16 2.97V21h-4V9z"/></svg>',
	'facebook'  => '<svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path fill="currentColor" d="M22 12a10 10 0 10-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.5-3.89 3.8-3.89 1.1 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.89h-2.34v6.99A10 10 0 0022 12z"/></svg>',
	'tiktok'    => '<svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path fill="currentColor" d="M14.5 2h2.9c.2 1.5 1.05 2.9 2.5 3.7.8.45 1.7.7 2.6.75v3c-1.7-.03-3.35-.55-4.7-1.5v7.1c0 3.4-2.75 6.15-6.15 6.15S5.5 18.4 5.5 15c0-3.3 2.6-6 5.85-6.15v3.05a3.1 3.1 0 102.55 3.05V2h.6z"/></svg>',
	'x'         => '<svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true"><path fill="currentColor" d="M3 3h4.3l4.1 5.6L16.1 3H21l-6.9 8.9L21.4 21H17l-4.5-6.1L7.2 21H2.5l7.3-9.4L3 3z"/></svg>',
);
?>
<section class="b-social">
	<?php if ( $title ) : ?>
		<p class="b-social__title"><?php echo esc_html( $title ); ?></p>
	<?php endif; ?>
	<div class="b-social__links">
		<?php foreach ( $links as $link ) :
			$platform = $link['platform'];
			if ( empty( $link['url'] ) || ! isset( $icons[ $platform ] ) ) { continue; }
			?>
			<a class="b-social__icon" href="<?php echo esc_url( $link['url'] ); ?>" aria-label="<?php echo esc_attr( ucfirst( $platform ) ); ?>" target="_blank" rel="noopener">
				<?php echo $icons[ $platform ]; // SVG de confianza, definido arriba en el theme. ?>
			</a>
		<?php endforeach; ?>
	</div>
</section>
