<?php
/*
	Plugin Name: Neighborhood Map Filter Plugin
	Plugin URI: https://github.com/BrindleDigital/neighborhood-map-filter
	Description: Just another attractions map with filter using  google place API plugin
	Version: 1.1
	Author: Brindle Digital
	Author URI: https://brindledigital.com

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.
	
*/

/* Prevent direct access to the plugin */
if ( !defined( 'ABSPATH' ) ) {
	die( "Sorry, you are not allowed to access this page directly." );
}

// Define the version of the plugin
define( 'NEIGHBORHOOD_ATTRACTIONS_FILTER_VERSION', '1.1' );

// Plugin directory
define( 'NEIGHBORHOOD_ATTRACTIONS_FILTER_URL', plugin_dir_url( __FILE__ ) );
define( 'NEIGHBORHOOD_ATTRACTIONS_FILTER_DIR', dirname( __FILE__ ) );


//* Include everything in /inc
foreach ( glob( NEIGHBORHOOD_ATTRACTIONS_FILTER_DIR . "/inc/*.php", GLOB_NOSORT ) as $filename ){
	require_once $filename;
}

//* Used for debugging
if ( !function_exists( 'console_log' ) ) {
	function console_log( $data ){
		echo '<script>';
		echo 'console.log('. json_encode( $data ) .')';
		echo '</script>';
	}
}