<?php
add_action('wp_ajax_add_product', 'add_product');

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

function add_product()
{
    error_log(print_r($_POST, true));
    global $wpdb;
    $table = $wpdb->prefix . 'products';
    var_dump($_POST);
    var_dump($table);
    $p_name = sanitize_text_field($_POST['name']);
    $p_brand = sanitize_text_field($_POST['brand']);
    $p_model = sanitize_text_field($_POST['model']);
    $p_price = sanitize_text_field($_POST['price']);
    $p_status = intval($_POST['status']);
    $data = [
        'p_name' => $p_name,
        'p_brand' => $p_brand,
        'p_model' => $p_model,
        'p_price' => $p_price,
        'p_status' => $p_status
    ];
    $format = ['%s','%s','%s','%s','%d'];
    $wpdb->insert($table,$data,$format);
}