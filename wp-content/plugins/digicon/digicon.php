<?php

/**
 * @package Digicon
 */
/*
Plugin Name: Digicon
Description: Testing Digicon plugin
Version: 4.0.2
Author: Aaron Tolentino
License: MIT
*/


defined( 'ABSPATH' ) or die();

define( 'DIGICON_EVENTS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

define( 'DIGICON_EVENTS_INIT_FILE', __FILE__);

require DIGICON_EVENTS_PLUGIN_DIR . 'vendor/autoload.php';

require DIGICON_EVENTS_PLUGIN_DIR . 'bootstrap.php';