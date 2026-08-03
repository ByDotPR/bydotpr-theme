<?php
/**
 * Bloque: Últimos blogs
 * Trae automáticamente las 3 entradas más recientes (WP_Query nativo, sin
 * plugin extra) + botón "Ver más" hacia el archivo del blog.
 */
bydotpr_enqueue_block_asset( 'blog-posts' );

$title       = get_field( 'blog_posts_title' );
$button_text = get_field( 'blog_posts_button_text' ) ?: 'View More';
$button_link = get_field( 'blog_posts_button_link' );

// Fallback: si no se define un link manual, usa la página de blog configurada
// en Ajustes > Lectura (o el home si no hay una página de posts dedicada).
if ( ! $button_link ) {
	$posts_page_id = (int) get_option( 'page_for_posts' );
	$button_link   = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/' );
}

$anchor_id = ! empty( $block['anchor'] ) ? $block['anchor'] : 'blog';

$query = new WP_Query( array(
	'post_type'              => 'post',
	'posts_per_page'         => 3,
	'post_status'            => 'publish',
	'ignore_sticky_posts'    => true,
	'no_found_rows'          => true,       // no necesitamos paginación aquí, ahorra una query
	'update_post_meta_cache' => false,      // no usamos meta custom en la tarjeta, ahorra queries
) );

if ( ! $query->have_posts() ) {
	return;
}
?>
<section class="b-blog" id="<?php echo esc_attr( $anchor_id ); ?>">

	<?php if ( $title ) : ?>
		<h2 class="b-blog__title"><?php echo esc_html( $title ); ?></h2>
	<?php endif; ?>

	<div class="b-blog__grid">
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			<article class="b-blog__card">
				<a class="b-blog__card-link" href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="b-blog__image-wrap">
							<?php echo get_the_post_thumbnail( get_the_ID(), 'blog-card', array(
								'class'   => 'b-blog__image',
								'loading' => 'lazy',
								'decoding'=> 'async',
							) ); ?>
						</div>
					<?php endif; ?>

					<p class="b-blog__date"><?php echo esc_html( get_the_date() ); ?></p>
					<h3 class="b-blog__card-title"><?php the_title(); ?></h3>
					<p class="b-blog__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
				</a>
			</article>
		<?php endwhile; wp_reset_postdata(); ?>
	</div>

	<div class="b-blog__cta-row">
		<a class="b-blog__cta" href="<?php echo esc_url( $button_link ); ?>"><?php echo esc_html( $button_text ); ?></a>
	</div>

</section>