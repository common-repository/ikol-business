<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( 'POST' === $_SERVER['REQUEST_METHOD'] ) {
	if (
		check_admin_referer( 'update-ikol-settings' ) &&
		current_user_can( 'manage_options' )
	) {
		Ikolbwp_Admin::update_settings(
			array(
				// sanitize form input
				'code'         => sanitize_text_field( $_POST['code'] ),
				'chat_enabled' => (int) $_POST['chat_enabled'],
			)
		);
	}
}

?>

<div class="wrap">
	<h1 class="wp-heading-inline"><?php esc_html_e( 'IKOL Business Settings', 'ikolbwp' ); ?></h1>
	<p class="description"><?php esc_html_e( 'WordPress plugin that allows embedding IKOL Business functionality into WordPress pages.', 'ikolbwp' ); ?></p>

	<form method="post" action="admin.php?page=ikol-business-wp" novalidate="novalidate">
		<?php wp_nonce_field( 'update-ikol-settings' ); ?>
		<table class="form-table" role="presentation">
			<tbody>
			<tr>
				<th scope="row">
					<label for="code"><?php esc_html_e( 'Your customer code', 'ikolbwp' ); ?></label>
				</th>
				<td>
					<input name="code"
							type="text"
							id="code"
							value="<?php echo esc_attr( Ikolbwp_Admin::get_settings( 'customer' ) ); ?>"
							class="regular-text">
					<p class="description">
						<?php esc_html_e( 'Don\'t have customer code yet? Sign up to IKOL Business app at', 'ikolbwp' ); ?>
						<a href="https://business.ikol.com" target="_blank">business.ikol.com</a>
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="chat_enabled"><?php esc_html_e( 'Enable chat', 'ikolbwp' ); ?></label>
				</th>
				<td>
					<label for="chat_enabled">
						<input name="chat_enabled"
								type="checkbox"
								id="chat_enabled"
								value="1"
								<?php checked( '1', (bool) Ikolbwp_Admin::get_settings( 'chat_enabled' ) ); ?>>
					</label>
					<p class="description"><?php esc_html_e( 'Check this field to show chat widget on your page', 'ikolbwp' ); ?></p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label><?php esc_html_e( 'Embed service list', 'ikolbwp' ); ?></label>
				</th>
				<td>
					<p class="description">
						<?php esc_html_e( 'You can add IKOL service list and reservation form to your page using "IKOL Service List" block.', 'ikolbwp' ); ?><br/>
						<?php esc_html_e( 'The block is available in the widget section of the WordPress editor.', 'ikolbwp' ); ?><br/>
						<?php esc_html_e( 'Place it in a right place and adjust settings if necessary.', 'ikolbwp' ); ?>
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label><?php esc_html_e( 'Embed contact form', 'ikolbwp' ); ?></label>
				</th>
				<td>
					<p class="description">
						<?php esc_html_e( 'You can add IKOL contact form to your page using "IKOL Contact Form" block.', 'ikolbwp' ); ?><br/>
						<?php esc_html_e( 'The block is available in the widget section of the WordPress editor.', 'ikolbwp' ); ?><br/>
						<?php esc_html_e( 'Place it in a right place and adjust settings if necessary.', 'ikolbwp' ); ?>
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label><?php esc_html_e( 'Configure', 'ikolbwp' ); ?></label>
				</th>
				<td>
					<p class="description">
						<?php esc_html_e( 'You can customize your chat, services and contact widgets at', 'ikolbwp' ); ?>
						<a href="https://business.ikol.com/portal#/" target="_blank">business.ikol.com/portal</a>
					</p>
				</td>
			</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" name="submit"
					id="submit"
					class="button button-primary"
					value="<?php esc_attr_e( 'Save Changes', 'ikolbwp' ); ?>">
		</p>
	</form>
</div>
