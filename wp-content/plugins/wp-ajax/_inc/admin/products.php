<?php

function all_products(){
    global $wpdb;
    $table = $wpdb->prefix . "products";
    $stmt = $wpdb->get_results("SELECT * FROM $table");
    if($stmt){
        return $stmt;
    }else{
        return false;
    }
}
function add_product() {
    error_log(print_r($_POST, true)); // برای دیباگ داده‌های ارسال‌شده

    global $wpdb;
    $table = $wpdb->prefix . "products";
    $p_name = sanitize_text_field($_POST['name']);
    $p_price = sanitize_text_field($_POST['price']);
    $p_brand = sanitize_text_field($_POST['brand']);
    $p_model = sanitize_text_field($_POST['model']);
    $p_status = intval(sanitize_text_field($_POST['status']));

    $data = [
        'name' => $p_name,
        'price' => $p_price,
        'brand' => $p_brand,
        'model' => $p_model,
        'status' => $p_status
    ];
    $format = ['%s', '%s', '%s', '%s', '%d'];

    $result = $wpdb->insert($table, $data, $format);

    if ($result) {
        wp_send_json_success("محصول با موفقیت ثبت شد.");
    } else {
        wp_send_json_error("خطایی در ثبت محصول رخ داده است.");
    }

    wp_die();
}
