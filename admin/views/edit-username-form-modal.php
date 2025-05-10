<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file contains the HTML markup for the plugin's settings modal and related elements.
 *
 * @since         2.0.0
 * @package       WP_Edit_Username
 * @subpackage    WP_Edit_Username/admin/views
 * @author        Sajjad Hossain Sagor <sagorh672@gmail.com>
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

?>
<!-- Modal -->
<div class="modal fade" id="edit_username_modal" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title"><?php esc_html_e( 'Update Username', 'wp-edit-username' ); ?></h2>
			</div>
			<div class="modal-body">
				<div class="alert" role="alert" id="wpeu_message"></div>
				<div class="input-group mt-3 mb-3">
					<span class="input-group-text"><?php esc_html_e( 'From', 'wp-edit-username' ); ?></span>
					<input type="text" readonly disabled class="form-control" id="wpeu_old_username" placeholder="<?php esc_html_e( 'Old username', 'wp-edit-username' ); ?>">
					<span class="input-group-text"><?php esc_html_e( 'To', 'wp-edit-username' ); ?></span>
					<input type="text" class="form-control" id="wpeu_new_username" placeholder="<?php esc_html_e( 'New username', 'wp-edit-username' ); ?>">
					<?php $nonce = wp_create_nonce( 'wp_edit_username_action' ); ?>
					<input type="hidden" name="wp_edit_username_nonce" id="wp_edit_username_nonce" value="<?php echo esc_attr( $nonce ); ?>" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="cancel_button" class="button button-cancel mr-2" data-bs-dismiss="modal"><?php esc_html_e( 'Cancel', 'wp-edit-username' ); ?></button>
				<button type="button" class="button button-primary" id="update_user_name_tigger" disabled><?php esc_html_e( 'Update Username', 'wp-edit-username' ); ?></button>
			</div>
		</div>
	</div>
</div>

<style>.updating::before{ background-image: url("<?php echo esc_url( WP_EDIT_USERNAME_PLUGIN_URL . '/admin/images/loading.gif' ); ?>"); }</style>