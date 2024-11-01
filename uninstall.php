<?php
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
 
$option_name = 'wp_ehilapp_options';
$option_cat_name = 'wp_ehilapp_options_cat';
$option_cat_name_inv = 'wp_ehilapp_options_cat_inv';
$option_tag_name = 'wp_ehilapp_options_tag';
$option_tag_name_inv = 'wp_ehilapp_options_tag_inv';
 
delete_option($option_name);
delete_option($option_cat_name);
delete_option($option_cat_name_inv);
delete_option($option_tag_name);
delete_option($option_tag_name_inv);
 
// for site options in Multisite
delete_site_option($option_name);
delete_site_option($option_cat_name);
delete_site_option($option_cat_name_inv);
delete_site_option($option_tag_name);
delete_site_option($option_tag_name_inv);


// delete pages
$pageJ = get_page_by_title( 'Pagina Json Ehilapp' );
$pageC = get_page_by_title( 'Pagina Categorie Ehilapp' );
$pageT = get_page_by_title( 'Pagina Tags Ehilapp' );
wp_delete_post( $pageJ->ID, true); 
wp_delete_post( $pageC->ID, true); 
wp_delete_post( $pageT->ID, true); 
 
// drop a custom database table
global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}wp_ehilapp");

?>
