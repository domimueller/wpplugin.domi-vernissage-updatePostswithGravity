<?php

/**
* Plugin Name: Gravity Hooks für Update von Inseraten
* Plugin URI: 
* Description: Funktionalität für Gravity Forms Population basierend auf Postdaten. Darstellung im Theme
* Version: 1.0
* Author: Dominique Müller
* Author URI: 
**/







$plugin_url = WP_PLUGIN_DIR . '/' . basename(dirname(__FILE__));

/* include Scripts*/
function domi_custom_customcss() {
    wp_enqueue_style( 'customcss',  plugin_dir_url( __FILE__ ) . '/css/custom.css' );                      
}
add_action( 'wp_enqueue_scripts', 'domi_custom_customcss');



/* INCLUDE FILES */
include $plugin_url . '/includes/gform_populate_custom_fields.php';
include $plugin_url . '/includes/gform_populate_technik_term.php';
include $plugin_url . '/includes/gform_populate_stile_term.php';
include $plugin_url . '/includes/gform_populate_formate_term.php';
include $plugin_url . '/includes/gform_populate_stueckelung_term.php';
include $plugin_url . '/includes/gform_populate_malgrund_term.php';
include $plugin_url . '/includes/gform_after_submission.php';
include $plugin_url . '/includes/gform_disable_post_creation.php';
include $plugin_url . '/includes/customFunctions.php';
include $plugin_url . '/includes/gformConfiguration.php';



?>