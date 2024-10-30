<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 */

class Ikolbwp_Admin {

	private $plugin_name;
	private $version;

	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	public function setup_menu() {
		add_menu_page(
			__( 'IKOL Business', 'ikolbwp' ),
			__( 'IKOL Business', 'ikolbwp' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'render' )
		);
	}

	public function render() {
		require_once IKOLBWP_PLUGIN_ROOT . '/admin/index.php';
	}

	public static function update_settings( $payload ) {
		$settings = array(
			'customer'     => trim( (string) ( isset( $payload['code'] ) ? $payload['code'] : '' ) ),
			'chat_enabled' => (bool) ( isset( $payload['chat_enabled'] ) ? $payload['chat_enabled'] : false ),
		);

		return update_option( 'ikolbwp_settings', $settings );
	}

	public static function get_settings( $key = null ) {
		$settings = wp_parse_args(
			get_option( 'ikolbwp_settings' ),
			array(
				'customer'     => '',
				'chat_enabled' => false,
			)
		);

		if ( isset( $key ) ) {
			return isset( $settings[ $key ] ) ? $settings[ $key ] : null;
		} else {
			return $settings;
		}
	}

	/**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles() {
		// no styles
	}

	/**
	 * Register the JavaScript for the admin area.
	 */
	public function enqueue_scripts() {
		// no scripts
	}
}
