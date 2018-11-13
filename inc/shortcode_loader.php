<?php

/**
 * The shortcodes loader Class
 *
 * @since 1.0
 */

// Do not allow directly accessing this file.
defined( 'ABSPATH' ) OR die( esc_html__( 'This script cannot be accessed directly.', 'codexin' ) );

/**
 * Main class for the Codexin Shortcode Loader
 * 
 * @since v1.0
 */
class CodexinShortcodeloader {

	// Building an array that holds all the custom shortcode names
	public static function cx_sc_names() {

		$shortcode_names = array();
		$cx_shortcode_names = glob( CODEXIN_CORE_SC_DIR . "/*.php", GLOB_BRACE );

		foreach( $cx_shortcode_names as $cx_shortcode_name ) {
			$shortcode_name = sanitize_text_field( str_replace( '.php', '', $cx_shortcode_name ) );
		   	$shortcode_names[] =  basename( $shortcode_name );
		}

		return $shortcode_names;

	}

	// Registering all the custom shortcodes
	public function codexin_shortcodes() {

		$shortcodes = self::cx_sc_names();
		foreach( $shortcodes as $shortcode ) {
			add_shortcode( $shortcode, $shortcode . '_shortcode' );
		}
			
	}

	// Integrating all the shortcodes in king composer
	public function cx_kc_mapper() {

		$cx_names = self::cx_sc_names();
		foreach( $cx_names as $cx_name ) {
			add_action( 'init', $cx_name . '_kc' , 99 );
		}

	}

	// Hooking the registered custom shortcodes in init
	public function cx_shortcodes() {

		add_action( 'init', array( $this, 'codexin_shortcodes' ) );

	}

}

// Instantiaing the class
$shortcode_loader = new CodexinShortcodeloader;

// Executing the desired methods
$shortcode_loader->cx_shortcodes();
$shortcode_loader->cx_kc_mapper();
