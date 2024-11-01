<?php

function admin_theme_style() {
	wp_enqueue_style('admin-theme', plugins_url('../css/tabs.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'admin_theme_style');

function admin_js_script() {
	wp_enqueue_script('admin-js', plugins_url('../js/tabs.js', __FILE__));
}
add_action('admin_enqueue_scripts', 'admin_js_script');

?>