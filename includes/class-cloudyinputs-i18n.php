<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://KhaledAlam.net
 * @since      1.0.0
 *
 * @package    Cloudyinputs
 * @subpackage Cloudyinputs/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cloudyinputs
 * @subpackage Cloudyinputs/includes
 * @author     Khaled Alam <khaledalam.net@gmail.com>
 */
class Cloudyinputs_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cloudyinputs',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
