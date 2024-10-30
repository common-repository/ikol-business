<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 */
class Ikolbwp_Public {

	private $additional_script_attrs = array(
		'data-customer',
		'data-lang',
		'data-dev',
	);

	private $plugin_name;
	private $version;

	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function enqueue_styles() {
		// no styles
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 */
	public function enqueue_scripts() {
		$settings = Ikolbwp_Admin::get_settings();

		if ( $settings['chat_enabled'] && $settings['customer'] ) {
			wp_enqueue_script( $this->plugin_name . '/chat', IKOLBWP_PLUGIN_CHAT_SCRIPT_URL, array(), IKOLBWP_PLUGIN_VERSION, true );
			wp_script_add_data( $this->plugin_name . '/chat', 'data-customer', $settings['customer'] );
		}
	}

	public function transform_script_tags( $tag, $handle = '' ) {
		if ( strpos( $handle, $this->plugin_name ) !== false ) {
			foreach ( $this->additional_script_attrs as $attr ) {
				$value = wp_scripts()->get_data( $handle, $attr );

				if ( $value ) {
					$tag = str_replace( '></', ' ' . $attr . '="' . esc_attr( $value ) . '"></', $tag );
				}
			}
		}
		return $tag;
	}
}
