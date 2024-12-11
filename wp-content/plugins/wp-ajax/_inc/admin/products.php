<?php
add_action('wp_ajax_add_product', 'add_product');
add_action('wp_ajax_delete_product', 'delete_product');
add_action('wp_ajax_select_product_by_id', 'select_product_by_id');
add_action('wp_ajax_update_product', 'update_product');


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

function delete_product()
{
    global $wpdb;
    $table = $wpdb->prefix . 'products';
    $ID = (int)$_POST['product_ID'];
    $where = ['ID' => $ID];
    $where_format = ['%d'];
    $wpdb->delete($table,$where, $where_format);
}

function select_product_by_id(){
    global $wpdb;
    $table = $wpdb->prefix . 'products';
    $ID = (int)$_POST['product_ID'];
    $stmt = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE ID='%d'",$ID));
    $output = [
        'ID' => $stmt->ID,
        'p_name' => $stmt->p_name,
        'p_brand' => $stmt->p_brand,
        'p_model' => $stmt->p_model,
        'p_price' => $stmt->p_price,
        'p_status' => $stmt->p_status
    ];
    echo json_encode($output);
    wp_die();
}

function update_product()
{
    global $wpdb;
    $table = $wpdb->prefix . 'products';
    $p_ID = intval($_POST['p_ID']);
    $p_name = sanitize_text_field($_POST['p_name']);
    $p_brand = sanitize_text_field($_POST['p_brand']);
    $p_model = sanitize_text_field($_POST['p_model']);
    $p_price = sanitize_text_field($_POST['p_price']);
    $p_status = intval($_POST['p_status']);
    $data = [
        'p_name' => $p_name,
        'p_brand' => $p_brand,
        'p_model' => $p_model,
        'p_price' => $p_price,
        'p_status' => $p_status
    ];
    $where = ['ID' => $p_ID];
    $where_format = ['%d'];
    $format = ['%s','%s','%s','%s','%d'];
    $wpdb->update($table,$data,$where,$format,$where_format);
}