<?php
function wpa_register_menu(): void
{
add_menu_page(
    page_title: 'مدیریت محصولات',menu_title: 'مدیریت محصولات',capability: 'manage_options',menu_slug: 'wpa_product_homepage',callback: 'wpa_product_handler'
);
}
add_action('admin_menu','wpa_register_menu');
function wpa_product_handler(): void
{
    include WPA_PLUGIN_VIEW."/admin/product-list.php";
}