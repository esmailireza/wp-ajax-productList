<?php
/*
Plugin Name:  wp ajax
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: اجکس در وردپرس
Author: reza
Version: 1.0.0
License: GPLv2 or later
Author URI: http://develop-wp.local
*/

defined('ABSPATH') || exit;
define('WPA_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WPA_PLUGIN_URL', plugin_dir_url(__FILE__));
const WPA_PLUGIN_INC = WPA_PLUGIN_DIR . '_inc/';
const WPA_PLUGIN_VIEW = WPA_PLUGIN_DIR . 'view/';
const WPA_PLUGIN_ASSETS_DIR = WPA_PLUGIN_DIR . 'assets/';
const WPA_PLUGIN_ASSETS_URL = WPA_PLUGIN_URL . 'assets/';
//echo plugins_url();
function wpa_register_styles()
{
//    STYLE REGISTER
    wp_register_style('bootstrap-5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.rtl.min.css', '', '5.2.0');
    wp_register_style('main-style', plugins_url('wp-ajax/assets/css/main-style.css'), '1.0.0');
    wp_register_style('bootstrap-icon', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css', '', '5.2.0');
    wp_register_style('fontawesome-icon', 'https://use.fontawesome.com/releases/v5.15.4/css/all.css', '', '5.15.0');
    wp_enqueue_style('bootstrap-5');
    wp_enqueue_style('main-style');
    wp_enqueue_style('bootstrap-icon');
    wp_enqueue_style('fontawesome-icon');

//    JS REGISTER
    if (is_admin()) {
        wp_register_script('dashboard-js', WPA_PLUGIN_ASSETS_URL . 'js/dashboard-js.js', ['jquery'], '1.0.0', '');
        wp_enqueue_script('dashboard-js');
        wp_register_script('dashboard-ajax-js', WPA_PLUGIN_ASSETS_URL . 'js/dashboard-ajax.js', ['jquery'], '1.0.0', '');
        wp_enqueue_script('dashboard-ajax-js');
        wp_register_script('sweet-alert-js', 'https://cdn.jsdelivr.net/npm/sweetalert2@11', '', '2.0.0', '');
        wp_enqueue_script('sweet-alert-js');
    } else {
        wp_register_script('main-js', WPA_PLUGIN_ASSETS_URL . 'js/main-js.js', ['jquery'], '1.0.0', '');
        wp_enqueue_script('main-js');
    }
    wp_register_script('bootstrap-5-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js', '', '5.2.0', '');
    wp_enqueue_script('bootstrap-5-js');
}

add_action('wp_enqueue_scripts', 'wpa_register_styles');
add_action('admin_enqueue_scripts', 'wpa_register_styles');

if(is_admin()){
    include WPA_PLUGIN_INC.'admin/menu.php';
    include WPA_PLUGIN_INC.'admin/products.php';
}