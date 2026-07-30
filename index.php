<?php
get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
else :
	echo '<p class="container">No hay contenido.</p>';
endif;

get_footer();
