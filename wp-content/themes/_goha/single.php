 <?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;


$args = array(
	'posts_per_page' => 4,
	'orderby' => 'id',
);

$context['posts_All'] = Timber::get_posts($args);

$b =  bcn_display_list(true, true, false);
$context['bc'] = $b;


$context['cat'] = $post->terms; 

$idCat = array();

foreach ($context['cat'] as $item ) {
	$idCat = $item->id;
}
$argsPost = array(
	'post__not_in' => array($post->ID),
	'posts_per_page' => 4,
	'tax_query' => array(
		array(
			'taxonomy' => 'category',
			'field' => 'id',
			'terms' => $idCat,
)));

$context['postss'] = Timber::get_posts($argsPost);

Timber::render( 'desktop/single.twig', $context );
?>