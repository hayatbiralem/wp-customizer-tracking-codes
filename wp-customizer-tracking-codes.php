<?php

/*
Plugin Name: WP Customizer Tracking Codes
Description: Add option panels for tracking codes to the WordPress Customizer.
Author: Ömür Yanıkoğlu
Version: 1.0.0
Author URI: https://hayatbiralem.com/
*/



/**
 * Defines
 */

if (!defined('WP_CUSTOMIZER_TRACKING_CODES_DIR')) {
    define('WP_CUSTOMIZER_TRACKING_CODES_DIR', plugin_dir_path(__FILE__));
}

if (!defined('WP_CUSTOMIZER_TRACKING_CODES_URL')) {
    define('WP_CUSTOMIZER_TRACKING_CODES_URL', plugin_dir_url(__FILE__));
}



/**
 * Includes
 */

require_once WP_CUSTOMIZER_TRACKING_CODES_DIR . '/inc/WP_Customizer_Tracking_Codes.php';


/**
 * Run
 */

WP_Customizer_Tracking_Codes::get_instance();
