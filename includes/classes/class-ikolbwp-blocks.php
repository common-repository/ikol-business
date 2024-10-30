<?php

class Ikolbwp_Blocks {

	private $plugin_name;

	public static $blocks = array(
		'contact'  => 'ikolbwp/contact',
		'services' => 'ikolbwp/services',
	);

	public function __construct( $plugin_name ) {
		$this->plugin_name = $plugin_name;
	}

	public function load_all_editor_blocks_assets() {
		$this->load_contact_editor_block_assets();
		$this->load_services_editor_block_assets();
	}

	public function load_all_blocks_assets() {
		if ( has_block( self::$blocks['contact'] ) ) {
			$this->load_contact_block_assets();
		}
		if ( has_block( self::$blocks['services'] ) ) {
			$this->load_services_block_assets();
		}
	}

	private function load_contact_editor_block_assets() {
		wp_enqueue_script(
			self::$blocks['contact'],
			plugin_dir_url( path_join( IKOLBWP_PLUGIN_ROOT, 'blocks/contact/js/ikolbwp_contact.js' ) ) . 'ikolbwp_contact.js',
			array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n' ),
			true,
			false
		);
		wp_set_script_translations( self::$blocks['contact'], 'ikolbwp', IKOLBWP_PLUGIN_ROOT . 'languages' );
	}

	private function load_services_editor_block_assets() {
		wp_enqueue_script(
			self::$blocks['services'],
			plugin_dir_url( path_join( IKOLBWP_PLUGIN_ROOT, 'blocks/services/js/ikolbwp_services.js' ) ) . 'ikolbwp_services.js',
			array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n' ),
			true,
			false
		);
		wp_set_script_translations( self::$blocks['services'], 'ikolbwp', IKOLBWP_PLUGIN_ROOT . 'languages' );
	}

	private function load_contact_block_assets() {
		$settings = Ikolbwp_Admin::get_settings();

		wp_enqueue_script( $this->plugin_name . '/contact', IKOLBWP_PLUGIN_CONTACT_SCRIPT_URL, array(), IKOLBWP_PLUGIN_VERSION, true );
		wp_script_add_data( $this->plugin_name . '/contact', 'data-customer', $settings['customer'] );
	}

	private function load_services_block_assets() {
		$settings = Ikolbwp_Admin::get_settings();

		wp_enqueue_script( $this->plugin_name . '/services', IKOLBWP_PLUGIN_SERVICES_SCRIPT_URL, array(), IKOLBWP_PLUGIN_VERSION, true, false );
		wp_script_add_data( $this->plugin_name . '/services', 'data-customer', $settings['customer'] );
	}
}
