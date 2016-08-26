<?php
add_action('wp_ajax_nopriv_send_order','send_order');
add_action('wp_ajax_send_order','send_order');

function send_order(){
    $p_row = 'position: relative; margin: auto; padding: 10px; border-bottom: 1px solid #f1f1f1; min-height: 20px;';
    $wrap_css = 'width: 600px; font-family: \'Arial\'; font-size: 14px; padding: 10px; margin: auto; border: 1px solid #d7d7d7; border-radius: 4px;';
    $title_css = 'border-bottom: 1px solid #2AA047; padding-bottom: 5px; font-size: 15px; color: #FF8660; text-transform: uppercase; font-weight: bold;';

    global $phpmailer;

    $post = $_POST;
    ob_start(); ?>
    <div  style="<?php echo $wrap_css ?>">

        <div style="<?php echo $title_css ?>">
            Thông tin đơn hàng
        </div>
            <?php echo stripslashes($post['order-html']) ?>

        <div style="<?php echo $title_css ?> margin-bottom: 5px; margin-top: 20px;">
            Thông tin khách hàng
        </div>
            <p style="<?php echo $p_row ?>">
                Họ và tên: <b><?php echo $post['name'] ?></b>
            </p>

            <p style="<?php echo $p_row ?>">
                Số điện thoại: <b><a href="tel:<?php echo $post['phone'] ?>"><?php echo $post['phone'] ?></a></b>
            </p>

            <p style="<?php echo $p_row ?>">
                Email: <b><a href="mailto:<?php echo $post['email'] ?>"><?php echo $post['email'] ?></a></b>
            </p>

            <p style="<?php echo $p_row ?> margin-bottom: 0; border-bottom: 0;">
                Ghi chú:  <?php echo $post['note'] ?>
            </p>
    </div>
<?php
    function set_html_mail_content_type() {
        return 'text/html';
    }
    add_filter( 'wp_mail_content_type', 'set_html_mail_content_type' );

    $to = $post['email'];
    $subject = 'Thông tin đơn hàng từ ' . 'Trang sức';
    $message = ob_get_clean();
    $result = wp_mail($to, $subject, $message);

    $phpmailer->ClearAllRecipients();
    $phpmailer->ClearAttachments();
    $phpmailer->ClearCustomHeaders();
    $phpmailer->ClearReplyTos();

    $to = tie_get_option('email_order');
    $subject = 'Thông tin đơn hàng từ ' . $post['name'];
    $headers = array();
    if (tie_get_option('email_order_cc')) {
        $headers = array(
            'CC: ' . tie_get_option('email_order_cc')
        );
    }
    $result = wp_mail($to, $subject, $message, $headers);

    remove_filter( 'wp_mail_content_type', 'set_html_mail_content_type' );
    if ($result == 1 || $result == 'true') {
        $response = array('status' => '200');
    } else {
        $response = array('status' => '400');
    }
    header('Content-Type: application/json');
    echo json_encode($response);

    die;
}


add_action('wp_ajax_deteleCache','deteleCache');

function deteleCache(){
    if (file_exists(get_template_directory() . '/datacache/data_page_build.json')) {
        @unlink(get_template_directory() . '/datacache/data_page_build.json');
        echo 'Xóa dữ liệu tạm thành công';
        echo '<script> close(); </script>';
    } else {
        echo 'Không tồn tại file dữ liệu tạm';
    }
    exit;
}



add_action('wp_ajax_nopriv_order_from','order_from');
add_action('wp_ajax_order_from','order_from');

function order_from(){
    $id = $_GET['id'];
    $post = get_post($id);
?>
<div id="cart-order">
    <form action="" class="info-cusomer" method="post">
        <div class="title-order">Chi tiết đơn hàng</div>
        <div class="detail-order single-order">
            <div style="position: relative; padding: 10px; padding-right: 105px; border-bottom: 1px solid #f1f1f1;" class="item">
                <div class="text">
                    <b><?php echo $post->post_title ?></b>
                    <span style="font-style:italic;font-size:12px;font-weight:bold;color:#2AA047; display:inline-block" class="qty-product">(x 1)</span>
                </div>
                <div style="position:absolute;right:10px;bottom:5px;color:red;font-weight:bold;" class="price">
                    <?php
                        echo get_field('gia', $post->ID) ? number_format(get_field('gia', $post->ID)) : 'Liên hệ';
                    ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="pull-right" style="width: 130px;">
            <input type="number" id="change-qty" data-price="<?php echo get_field('gia', $post->ID); ?>" class="form-control" min="1" placeholder="Số lượng" value="1">
        </div>
        <div class="clearfix"></div>
        <input type="hidden" value="send_order" name="action">
            <textarea name="order-html" id="order-html" style="display:none">
                <div class="detail-order">
                    <div style="position: relative; padding: 10px; padding-right: 105px; border-bottom: 1px solid #f1f1f1;" class="item">
                        <div class="text">
                            <?php echo $post->post_title ?>
                            <span style="font-style:italic;font-size:12px;font-weight:bold;color:#2AA047; display:inline-block" class="qty-product">(x 1)</span>
                        </div>
                        <div style="position:absolute;right:10px;bottom:5px;color:red;font-weight:bold;" class="price">
                            <?php
                                echo get_field('gia', $post->ID) ? number_format(get_field('gia', $post->ID)) : 'Liên hệ';
                            ?>
                        </div>
                    </div>
                    <div class="total-price-order" style="padding: 10px;text-align: right;">
                        Tổng cộng
                        <span style="font-size: 16px;font-weight: bold; margin-right: 10px;">
                            <?php
                                echo get_field('gia', $post->ID) ? number_format(get_field('gia', $post->ID)) : 'Liên hệ';
                            ?>
                        <span>
                    </div>
                </div>
            </textarea>
        <div class="title-order">Thông tin nhận hàng</div>
        <div class="form-group m-t-15">
            <label for="inputEmail3" class="control-label">Họ và tên</label>
            <div class="">
                <input name="name" type="text" required="" class="form-control" placeholder="Nhập đầy đủ họ và tên">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="control-label">Số điện thoại</label>
            <div class="">
                <input name="phone" type="number" required="" class="form-control" placeholder="Số điện thoại xác minh đơn hàng">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="control-label">Email</label>
            <div class="">
                <input name="email" type="email" required="" class="form-control" placeholder="Email nhận thông tin đơn hàng">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="control-label">Ghi chú</label>
            <div class="">
                <textarea class="form-control" placeholder="Thời gian giao hàng, cách thức giao hàng, các vấn đề khác ..." name="note" id="" rows="5"></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="text-right">
                <button class="btn btn-success">Đặt hàng ngay</button>
            </div>
        </div>
    </form>
</div>

<?php
die;
}