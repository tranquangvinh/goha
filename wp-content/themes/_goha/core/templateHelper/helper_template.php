<?php
function get_option_tax($id){
    $tax = get_term_by( 'id', $id, 'danh-muc', 'OBJECT', 'raw' ) ;
    $args = array(
        'posts_per_page' => 1000,
        'post_type' => 'san-pham',
        'danh-muc' => $tax->slug,
        'orderby' => 'title',
        'order' => 'ASC'
    );
    $the_query = new WP_Query( $args );
    $listArticle = array();
    if( $the_query->have_posts() ){
        while ( $the_query->have_posts() ) : $the_query->the_post();
            $listArticle[] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'price' => get_field('gia', get_the_ID())
            );
        endwhile;
    }
    $output = array(
        'seft' => (array)$tax,
        'articles' => $listArticle
    );

    return $output;
}

function pagination($template = 0) {
    global $wp_query;
    $big = 999999999;
    if ($template == 1) {
        $pa = paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'before_page_number' => '<span class="screen-reader-text"></span>',
            'prev_next' => true,
            "next_text" => 'Xem thêm'
        ));
    } else {
        $pa = paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'before_page_number' => '<span class="screen-reader-text"></span>',
            'prev_next' => true
        ));
    }
    return $pa;
}

class component
{
    public static function getImageByFolder($slug, $size = 'thumbnail')
    {
        $output = array();
        $args = array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'tax_query' => array(
                array(
                    'taxonomy' => 'media_category',
                    'field' => 'slug',
                    'include_children'=> false,
                    'terms' => $slug
                )
            )
        );
        $the_query = new WP_Query($args);

        $attachment = $the_query->get_posts();
        if ($attachment) {
            foreach ($attachment as $item) {
                $fullImage = $item->guid;
                $fullImage = explode('/', $fullImage);
                unset($fullImage[count($fullImage) - 1]);
                $fullPath = implode('/', $fullImage) . '/';

                $output[] = array(
                    'path' => $fullPath,
                    'full_image' => $item->guid,
                    'meta' => wp_get_attachment_metadata($item->ID),
                    'attr' => array(
                        'title' => $item->post_title,
                        'description' => $item->post_content,
                        'background' => get_field('background', $item->ID),
                        'textLink' => get_field('text_link', $item->ID),
                        'lienKet' => get_field('link', $item->ID)
                    ),
                );
            }
        }

        wp_reset_query();

        return $output;
    }

    public function currencyFormat($number)
    {
        return number_format($number, 0, ',', '.');
    }
}

function getDatePost($gtmTime)
{
    return gmdate('d',strtotime($gtmTime));
}

function getMonthPost($gtmTime)
{
    $time = gmdate('m',strtotime($gtmTime));
    $label = array(
        '01' => 'Tháng một',
        '02' => 'Tháng hai',
        '03' => 'Tháng ba',
        '04' => 'Tháng bốn',
        '05' => 'Tháng năm',
        '06' => 'Tháng sáu',
        '07' => 'Tháng bảy',
        '08' => 'Tháng tám',
        '09' => 'Tháng chín',
        '10' => 'Tháng mười',
        '11' => 'Tháng mười một',
        '12' => 'Tháng mười hai',
    );

    return $label[$time];
}



