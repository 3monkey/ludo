<?php
/**
 * @package ludoteca_table
 */
/*
Plugin Name: Ludoteca Table
Plugin URI: 
Description: Plugin que gestiona una lista de juegos de mesa .
Version: 0.0.1
Author: Bmokey
Author URI: 
License: GPL2
Text Domain: ludoteca_table
*/

if ( ! defined( 'ABSPATH' ) ) exit;

// Load plugin class files
require_once( 'includes/class_ludoteca_table.php' );
require_once( 'includes/class_ludoteca_table_settings.php' );

// Load plugin libraries
require_once( 'includes/lib/class_ludoteca_table_admin_api.php' );
require_once( 'includes/lib/class_ludoteca_table_post_type.php' );
require_once( 'includes/lib/class_ludoteca_table_taxonomy.php' );

/**
 * Returns the main instance of WordPress_Plugin_Template to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object WordPress_Plugin_Template
 */
function WordPress_Ludoteca_Table () {
	$instance = WordPress_Ludoteca_Table::instance( __FILE__, '1.0.0' );

	if ( is_null( $instance->settings ) ) {
		$instance->settings = WordPress_Ludoteca_Table_Settings::instance( $instance );
	}

	return $instance;
}

WordPress_Ludoteca_Table();

/*
	wp_register_script('test', get_theme_file_uri('/assets/js/ludoteca.js'), array('jquery'), '1', true );
	//wp_register_script('test', get_template_directory_uri(). '/assets/js/script.js', array('jquery'), '1', true );
	//wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );
	//wp_enqueue_script('test');

	wp_localize_script('test','dcms_vars',['ajaxurl'=>admin_url('admin-ajax.php')]);
}

add_action('wp_enqueue_scripts','ludotecaScript');*/

function ajax_scripts(){
	wp_enqueue_script('test', get_theme_file_uri('/assets/js/ludoteca.js'), array('jquery'), '1.0', true );
	wp_localize_script('test','dcms_vars',['ajaxurl'=>admin_url('admin-ajax.php')]);
}

//add_action('wp_enqueue_scripts', 'ajax_scripts');

//add_action('wp_ajax_nopriv_editLine','editLine');
//add_action('wp_ajax_editLine','editLine');

function editLine()
{

	$content = 'hola';
	echo $content;

	wp_die();
}

