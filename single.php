<?php
/**
 * Post individual:
 * - Barra de progreso de lectura (vanilla JS, ~15 líneas, ver blog-single.js)
 * - Imagen destacada completa (sin recorte) con el título debajo
 * - Drop cap editorial en el primer párrafo (CSS ::first-letter, sin JS)
 * - 3 posts relacionados al final, reutilizando bydotpr_blog_card()
 */
get_header();

wp_enqueue_style( 'bydotpr-blog-card', BYDOTPR_URI . '/assets/css/blog-card.css', array( 'bydotpr-main' ), BYDOTPR_VERSION );
wp_enqueue_style( 'bydotpr-blog-single', BYDOTPR_URI . '/assets/css/blog-single.css', array( 'bydotpr-main', 'bydotpr-blog-card' ), BYDOTPR_VERSION );
wp_enqueue_script( 'bydotpr-blog-single', BYDOTPR_URI . '/assets/js/blog-single.js', array(), BYDOTPR_VERSION, true );

while ( have_posts() ) : the_post();
	?>

	<div class="blog-progress" aria-hidden="true"><div class="blog-progress__bar" data-reading-progress></div></div>

	<article <?php post_class( 'blog-single' ); ?>>

		<?php if ( has_post_thumbnail() ) : ?>
			<?php // Imagen completa (full, sin recorte) y título debajo, para no tapar el arte. ?>
			<div class="blog-single__hero container">
				<?php the_post_thumbnail( 'full', array(
					'class'   => 'blog-single__hero-image',
					'sizes'   => '(max-width: 1440px) 100vw, 1440px',
					'loading' => 'eager',
					'fetchpriority' => 'high',
					'decoding' => 'async',
				) ); ?>
			</div>
		<?php endif; ?>

		<header class="blog-single__head container<?php echo has_post_thumbnail() ? ' blog-single__head--after-image' : ''; ?>">
			<p class="blog-single__date">
				<?php echo esc_html( get_the_date() ); ?> · <?php echo esc_html( bydotpr_reading_time() ); ?> min de lectura
			</p>
			<h1 class="blog-single__title blog-single__title--no-image"><?php the_title(); ?></h1>
		</header>

		<div class="blog-single__content container">
			<?php the_content(); ?>
		</div>

	</article>

	<?php
	// Relacionados: últimos 3 posts, excluyendo el actual.
	$related = new WP_Query( array(
		'post_type'              => 'post',
		'posts_per_page'         => 3,
		'post__not_in'           => array( get_the_ID() ),
		'ignore_sticky_posts'    => true,
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
	) );

	if ( $related->have_posts() ) :
		?>
		<section class="blog-related container">
			<h2 class="blog-related__title">Más artículos</h2>
			<div class="blog-related__grid">
				<?php while ( $related->have_posts() ) : $related->the_post(); ?>
					<?php bydotpr_blog_card(); ?>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</section>
	<?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>