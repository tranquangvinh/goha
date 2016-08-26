<?php
// Register Custom Post Type
function san_pham() {

    $labels = array(
        'name' => _x('Sản phẩm', '', 'sweetday'),
        'singular_name' => _x('Sản phẩm', 'Post Type Singular Name', 'sweetday'),
        'menu_name' => __('Sản phẩm', 'sweetday'),
        'name_admin_bar' => __('Sản phẩm', 'sweetday'),
        'parent_item_colon' => __('Sản phẩm cha:', 'sweetday'),
        'all_items' => __('Tất cả sản phẩm', 'sweetday'),
        'add_new_item' => __('Thêm sản phẩm', 'sweetday'),
        'add_new' => __('Thêm mới sản phẩm', 'sweetday'),
        'new_item' => __('Sản phẩm mới', 'sweetday'),
        'edit_item' => __('Sửa sản phẩm', 'sweetday'),
        'update_item' => __('Cập nhật sản phẩm', 'sweetday'),
        'view_item' => __('Xem sản phẩm', 'sweetday'),
        'search_items' => __('Tìm kiếm sản phẩm', 'sweetday'),
        'not_found' => __('Not found', 'sweetday'),
        'not_found_in_trash' => __('Not found in Trash', 'sweetday'),
    );
    $args = array(
        'label' => __('san-pham', 'sweetday'),
        'labels' => $labels,
        'supports' => array('title', 'thumbnail', 'editor'),
        'taxonomies' => array(''),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('san-pham', $args);
}

// Hook into the 'init' action
add_action('init', 'san_pham', 0);


// Register Custom Taxonomy
function danh_muc() {

    $labels = array(
        'name' => _x('Danh mục', 'Custom Tax', 'swd'),
        'singular_name' => _x('Danh mục', 'Taxonomy Singular Name', 'swd'),
        'menu_name' => __('Danh mục', 'swd'),
        'all_items' => __('All Danh mục', 'swd'),
        'parent_item' => __('Parent Danh mục', 'swd'),
        'parent_item_colon' => __('Parent Danh mục:', 'swd'),
        'new_item_name' => __('New Danh mục Name', 'swd'),
        'add_new_item' => __('Add New Danh mục', 'swd'),
        'edit_item' => __('Edit Danh mục', 'swd'),
        'update_item' => __('Update Danh mục', 'swd'),
        'view_item' => __('View Danh mục', 'swd'),
        'separate_items_with_commas' => __('Separate items with commas', 'swd'),
        'add_or_remove_items' => __('Add or remove items', 'swd'),
        'choose_from_most_used' => __('Choose from the most used', 'swd'),
        'popular_items' => __('Popular Items', 'swd'),
        'search_items' => __('Search Items', 'swd'),
        'not_found' => __('Not Found', 'swd'),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('danh-muc', array('san-pham'), $args);
}

// Hook into the 'init' action
add_action('init', 'danh_muc', 0);

// Register Custom Taxonomy
function tu_khoa() {
    $labels = array(
        'name' => _x('Từ khóa', 'Custom Tax', 'swd'),
        'singular_name' => _x('Từ khóa', 'Taxonomy Singular Name', 'swd'),
        'menu_name' => __('Từ khóa', 'swd'),
        'all_items' => __('Tất cả Từ khóa', 'swd'),
        'parent_item' => __('Từ khóa', 'swd'),
        'parent_item_colon' => __('Từ khóa cha:', 'swd'),
        'new_item_name' => __(' Tên Từ khóa mới', 'swd'),
        'add_new_item' => __('Thêm mới Từ khóa', 'swd'),
        'edit_item' => __('Sửa Từ khóa', 'swd'),
        'update_item' => __('Cập nhật Từ khóa', 'swd'),
        'view_item' => __('xem Từ khóa', 'swd'),
        'separate_items_with_commas' => __('Separate items with commas', 'swd'),
        'add_or_remove_items' => __('Add or remove items', 'swd'),
        'choose_from_most_used' => __('Choose from the most used', 'swd'),
        'popular_items' => __('Popular Items', 'swd'),
        'search_items' => __('Search Items', 'swd'),
        'not_found' => __('Not Found', 'swd'),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('tu-khoa', array('san-pham'), $args);
}
add_action('init', 'tu_khoa', 0);


function tags_support_all() {
    register_taxonomy_for_object_type('tu-khoa', 'page');
}
add_action('init', 'tags_support_all');
