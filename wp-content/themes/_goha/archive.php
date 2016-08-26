 <?php

 /* Template Name: trang chủ */

$context = Timber::get_context();

$context['title'] = 'Archive';
if ( is_day() ) {
	$context['title'] = 'Archive: '.get_the_date( 'D M Y' );
} else if ( is_month() ) {
	$context['title'] = 'Archive: '.get_the_date( 'M Y' );
} else if ( is_year() ) {
	$context['title'] = 'Archive: '.get_the_date( 'Y' );
} else if ( is_tag() ) {
	$context['title'] = single_tag_title( '', false );
} else if ( is_category() ) {
	$context['title'] = single_cat_title( '', false ); 
} else if ( is_post_type_archive() ) {
	$context['title'] = post_type_archive_title( '', false ); 
}

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
