<?php
get_header();

while ( have_posts() ) :
	the_post();
	the_content(); // Aquí viven los bloques ACF: hero, about, clients, services, why-us, social, contact-form
endwhile;

get_footer();
