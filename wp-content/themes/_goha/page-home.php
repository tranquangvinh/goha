<?php

 /* Template Name: trang chủ */

$context = \Timber\Timber::get_context();
$context['post'] = \Timber\Timber::query_post();

$context['dataSlider'] = component::getImageByFolder('slider-home');
$context['dataSliderDoiTac'] = component::getImageByFolder('slider-doi-tac');

$args_k3 = array(
	'posts_per_page' => 3,
	'cat' => get_field('project'),
);
$context['link_poject'] =  get_category_link(get_field('project'));
$context['posts_k3'] = Timber::get_posts($args_k3);

$args_k4 = array(
	'posts_per_page' => 3,
	'cat' => get_field('team'),
);
$context['posts_k4'] = Timber::get_posts($args_k4);

$args_k5 = array(
	'posts_per_page' => 3,
	'cat' => get_field('marketing'),
);
$context['posts_k5'] = Timber::get_posts($args_k5);

\Timber\Timber::render('desktop/index.twig', $context); 
?>
