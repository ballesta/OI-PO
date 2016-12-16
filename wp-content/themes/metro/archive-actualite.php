<?php

get_header(); 

echo '<h1>Actualités</h1>';

echo do_shortcode('[search-form id="theme-actualite" showall=1]');
		
get_footer(); 

?>