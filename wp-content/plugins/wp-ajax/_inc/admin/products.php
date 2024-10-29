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