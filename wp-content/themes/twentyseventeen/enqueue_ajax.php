<?php
add_action('wp_enqueue_scripts', 'dcms_insertar_js');

function dcms_insertar_js(){

	if (!is_home()) return;


	wp_localize_script('dcms_miscript','dcms_vars',['ajaxurl'=>admin_url('admin-ajax.php')]);
}
?>