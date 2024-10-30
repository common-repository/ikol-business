<?php

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 */

class Ikolbwp_Translations {


	/**
	 * Load the plugin text domain for translation.
	 */
	public function load_plugin_textdomain() {
		$result = load_plugin_textdomain(
			'ikolbwp',
			false,
			IKOLBWP_PLUGIN_ROOT_FOLDER_NAME . '/languages/'
		);
	}
}
