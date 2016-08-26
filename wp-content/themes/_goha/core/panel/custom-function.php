<?php 
define('asset_url',get_template_directory_uri().'/asset');

/*================================================*/
/* Làm sạch header */
/*================================================*/
remove_action( 'wp_head', 'wp_generator');
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'edituri_link');

add_action('init', 'remheadlink');
function remheadlink() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}
function hide_admin_bar_from_front_end(){
  if (is_blog_admin()) {
    return true;
  }
  return false;
}
add_filter( 'show_admin_bar', 'hide_admin_bar_from_front_end' );

/*================================================*/
/* Block tiếp theo */
/*================================================*/