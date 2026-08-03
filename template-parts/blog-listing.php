<?php
/**
 * Listado de blog compartido — lo usan archive.php (categorías/tags) Y
 * home.php (la página de posts, ej. /news/). WordPress NO usa archive.php
 * para la página de posts configurada en Ajustes > Lectura, por eso este
 * archivo existe separado y ambos templates lo incluyen.
 */
wp_enqueue_style( 'bydotpr-blog-card', BYDOTPR_URI . '/assets/css/blog-card.css', array( 'bydotpr-main' ), BYDOTPR_VERSION );
wp_enqueue_style( 'bydotpr-blog-archive', BYDOTPR_URI . '/assets/css/blog-archive.css', array( 'bydotpr-main', 'bydotpr-blog-card' ), BYDOTPR_VERSION );

$categories    = get_categories( array( 'hide_empty' => true ) );
$current_cat   = get_query_var( 'cat' );
$is_first_page = ! is_paged();
?>

<header class="blog-archive__head container">
	<h1 class="blog-archive__title">Journal</h1>

	<?php if ( $categories ) : ?>
		<nav class="blog-archive__filters" aria-label="Filtrar por categoría">
			<a class="blog-archive__pill <?php echo ! $current_cat ? 'is-active' : ''; ?>" href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ?: home_url( '/news/' ) ); ?>">Todos</a>
			<?php foreach ( $categories as $cat ) : ?>
				<a class="blog-archive__pill <?php echo ( (int) $current_cat === $cat->term_id ) ? 'is-active' : ''; ?>" href="<?php echo esc_url( get_category_link( $cat ) ); ?>">
					<?php echo esc_html( $cat->name ); ?>
				</a>
			<?php endforeach; ?>
		</nav>
	<?php endif; ?>
</header>

<?php if ( have_posts() ) : ?>

	<div class="container">
		<?php
		$post_index = 0;
		while ( have_posts() ) :
			the_post();
			$post_index++;

			if ( $post_index === 1 && $is_first_page ) :
				?>
				<article class="blog-featured">
					<a class="blog-featured__link" href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="blog-featured__media">
								<?php the_post_thumbnail( 'hero-desktop', array(
									'class'   => 'blog-featured__image',
									'loading' => 'eager',
									'fetchpriority' => 'high',
									'decoding' => 'async',
								) ); ?>
								<div class="blog-featured__overlay" aria-hidden="true"></div>
							</div>
						<?php endif; ?>
						<div class="blog-featured__copy">
							<p class="blog-featured__date">
								<?php echo esc_html( get_the_date() ); ?> · <?php echo esc_html( bydotpr_reading_time() ); ?> min de lectura
							</p>
							<h2 class="blog-featured__title"><?php the_title(); ?></h2>
							<p class="blog-featured__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 32 ) ); ?></p>
						</div>
					</a>
				</article>

				<div class="blog-archive__grid">
				<?php
				continue;
			endif;
			?>
			<?php bydotpr_blog_card(); ?>

		<?php endwhile; ?>
		</div>
	</div>

	<div class="blog-archive__pagination container">
		<?php
		echo paginate_links( array(
			'prev_text' => '‹',
			'next_text' => '›',
		) );
		?>
	</div>

<?php else : ?>

	<div class="container">
		<p class="blog-archive__empty">Todavía no hay artículos publicados.</p>
	</div>

<?php endif; ?>