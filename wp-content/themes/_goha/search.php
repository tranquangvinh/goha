<?php

 /* Template Name: trang chủ */

$context = Timber::get_context();

$context['title'] = 'Kết quả tìm kiếm';
 

$context['posts'] = Timber::get_posts();

$context['pagination'] = Timber::get_pagination();

$b =  bcn_display_list(true, true, false);
$context['bc'] = $b;

$args = array(
	'posts_per_page' => 4,
	'orderby' => 'id',
);

$context['posts_All'] = Timber::get_posts($args);


\Timber\Timber::render('desktop/archive.twig', $context); 
?>
