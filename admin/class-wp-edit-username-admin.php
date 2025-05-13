<?php
/**
 * This file contains the definition of the WP_Edit_Username_Admin class, which
 * is used to load the plugin's admin-specific functionality.
 *
 * @package       WP_Edit_Username
 * @subpackage    WP_Edit_Username/admin
 * @author        Sajjad Hossain Sagor <sagorh672@gmail.com>
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version and other methods.
 *
 * @since    2.0.0
 */
class WP_Edit_Username_Admin {
	/**
	 * The ID of this plugin.
	 *
	 * @since     2.0.0
	 * @access    private
	 * @var       string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since     2.0.0
	 * @access    private
	 * @var       string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * The plugin options api wrapper object.
	 *
	 * @since     2.0.0
	 * @access    private
	 * @var       array $settings_api Holds the plugin options api wrapper class object.
	 */
	private $settings_api;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @param     string $plugin_name The name of this plugin.
	 * @param     string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name  = $plugin_name;
		$this->version      = $version;
		$this->settings_api = new Sajjad_Dev_Settings_API();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function enqueue_styles() {
		global $pagenow;

		// check if current page is edit user page and current user can edit user information.
		if ( in_array( $pagenow, array( 'profile.php', 'user-edit.php' ), true ) && current_user_can( 'edit_users' ) ) {
			wp_enqueue_style( $this->plugin_name, WP_EDIT_USERNAME_PLUGIN_URL . 'admin/css/admin.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function enqueue_scripts() {
		global $pagenow;

		// check if current page is edit user page and current user can edit user information.
		if ( in_array( $pagenow, array( 'profile.php', 'user-edit.php' ), true ) && current_user_can( 'edit_users' ) ) {
			wp_enqueue_script( $this->plugin_name, WP_EDIT_USERNAME_PLUGIN_URL . 'admin/js/admin.js', array( 'jquery' ), $this->version, false );

			wp_localize_script(
				$this->plugin_name,
				'WPEditUsername',
				array(
					'userEditTxtI18n'             => __( 'Edit', 'wp-edit-username' ),
					'userEditConfirmationTxtI18n' => __( 'Are you sure you want to update the username? This action cannot be undone.', 'wp-edit-username' ),
				)
			);
		}
	}

	/**
	 * Adds a settings link to the plugin's action links on the plugin list table.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @param     array $links The existing array of plugin action links.
	 * @return    array $links The updated array of plugin action links, including the settings link.
	 */
	public function add_plugin_action_links( $links ) {
		$links[] = sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=wp-edit-username' ), __( 'Settings', 'wp-edit-username' ) );

		return $links;
	}

	/**
	 * Show edit username form modal.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function show_edit_modal() {
		global $pagenow;

		// check if current page is edit user page and current user can edit user information.
		if ( in_array( $pagenow, array( 'profile.php', 'user-edit.php' ), true ) && current_user_can( 'edit_users' ) ) {
			require WP_EDIT_USERNAME_PLUGIN_PATH . 'admin/views/edit-username-form-modal.php';
		}
	}

	/**
	 * Adds the plugin settings page to the WordPress dashboard menu.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function admin_menu() {
		add_menu_page(
			__( 'Edit Username', 'wp-edit-username' ),
			__( 'Edit Username', 'wp-edit-username' ),
			'edit_users',
			'wp-edit-username',
			array( $this, 'menu_page' ),
			'dashicons-edit'
		);
	}

	/**
	 * Renders the plugin settings page form.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function menu_page() {
		$this->settings_api->show_forms();
	}

	/**
	 * Register Plugin Options Via Settings API
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function admin_init() {
		// set the settings.
		$this->settings_api->set_sections( $this->get_settings_sections() );

		$this->settings_api->set_fields( $this->get_settings_fields() );

		// initialize settings.
		$this->settings_api->admin_init();
	}

	/**
	 * Returns the settings sections for the plugin settings page.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @return    array An array of settings sections, where each section is an array
	 *                  with 'id' and 'title' keys.
	 */
	public function get_settings_sections() {
		$sections = array(
			array(
				'id'    => 'wpeu_register_settings_fields',
				'title' => __( 'Notifications Settings', 'wp-edit-username' ),
			),
		);

		/**
		 * Filters the plugin settings sections.
		 *
		 * This filter allows you to modify the plugin settings sections.
		 * You can use this filter to add/remove/edit any settings section.
		 *
		 * @since    2.0.3
		 * @param    array $settings_sections Default settings sections.
		 * @return   array $settings_sections Modified settings sections.
		 */
		return apply_filters( 'wpeu_settings_sections', $sections );
	}

	/**
	 * Returns all the settings fields for the plugin settings page.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @return    array An array of settings fields, organized by section ID.  Each
	 *                  section ID is a key in the array, and the value is an array
	 *                  of settings fields for that section. Each settings field is
	 *                  an array with 'name', 'label', 'type', 'desc', and other keys
	 *                  depending on the field type.
	 */
	public function get_settings_fields() {
		$settings_fields = array(
			'wpeu_register_settings_fields' => array(
				array(
					'name'  => 'wpeu_send_email_field',
					'label' => __( 'Send Email', 'wp-edit-username' ),
					'type'  => 'checkbox',
					'desc'  => __( 'Checking this box will enable sending emails to respective recipients when username change action happens.', 'wp-edit-username' ),
				),
				array(
					'name'    => 'wpeu_email_receiver_field',
					'label'   => __( 'Send Emails To', 'wp-edit-username' ),
					'type'    => 'radio',
					'options' => array(
						'admin_only' => __( 'Admins Only', 'wp-edit-username' ),
						'user_only'  => __( 'User Only', 'wp-edit-username' ),
						'admin_user' => __( 'Admins & User', 'wp-edit-username' ),
					),
					'default' => 'admin_only',
				),
				array(
					'name'    => 'wpeu_email_subject_field',
					'label'   => __( 'Email Subject', 'wp-edit-username' ),
					'type'    => 'text',
					'default' => __( 'Username Changed!', 'wp-edit-username' ),
				),
				array(
					'name'    => 'wpeu_email_body_field',
					'label'   => __( 'Email Body Text', 'wp-edit-username' ),
					'size'    => '700px',
					'type'    => 'wysiwyg',
					'default' => sprintf(
						'<img src="{{gravatar_url}}"><p><strong>%s!!!</strong> %s<p>%s: {{first_name}}</p><p>%s: {{last_name}}</p><p>%s: {{display_name}}</p><p>%s: {{nickname}}</p><p>%s: {{full_name}}</p><p>%s: {{old_username}}</p><p>%s: {{new_username}}</p>',
						__( 'Warning', 'wp-edit-username' ),
						__( 'Your Username has been changed.', 'wp-edit-username' ),
						__( 'First Name', 'wp-edit-username' ),
						__( 'Last Name', 'wp-edit-username' ),
						__( 'Display Name', 'wp-edit-username' ),
						__( 'Nickname', 'wp-edit-username' ),
						__( 'Full Name', 'wp-edit-username' ),
						__( 'Old Username', 'wp-edit-username' ),
						__( 'New Username', 'wp-edit-username' ),
					),
					'desc'    => sprintf(
						'<p>%s : <code>{{first_name}}</code> <code>{{last_name}}</code> <code>{{display_name}}</code> <code>{{nickname}}</code> <code>{{full_name}}</code> <code>{{gravatar_url}}</code> <code>{{old_username}}</code> <code>{{new_username}}</code></p>',
						__( 'Available shortcodes are', 'wp-edit-username' )
					),
				),
			),
		);

		/**
		 * Filters the plugin settings fields.
		 *
		 * This filter allows you to modify the plugin settings fields.
		 * You can use this filter to add/remove/edit any settings field.
		 *
		 * @since    2.0.3
		 * @param    array $settings_fields Default settings fields.
		 * @return   array $settings_fields Modified settings fields.
		 */
		return apply_filters( 'wpeu_settings_fields', $settings_fields );
	}

	/**
	 * Handles the AJAX request to update the username.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @return    void Sends a JSON response indicating success or failure.
	 */
	public function update_username() {
		$response = array();

		if ( ! current_user_can( 'edit_users' ) ) {
			$response['alert_msg'] = __( 'Permission denied!', 'wp-edit-username' );

			wp_send_json( $response );
		}

		if ( ! isset( $_POST['new_username'] ) && ! isset( $_POST['old_username'] ) ) {
			$response['alert_msg'] = __( 'Invalid fields!', 'wp-edit-username' );

			wp_send_json( $response );
		}

		if ( isset( $_POST['wp_edit_username_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wp_edit_username_nonce'] ) ), 'wp_edit_username_action' ) ) {
			$new_username = sanitize_user( wp_unslash( $_POST['new_username'] ) );
			$old_username = sanitize_user( wp_unslash( $_POST['old_username'] ) );

			// ---------------------------------------------------------
			// check if new_username is empty
			// ---------------------------------------------------------
			if ( empty( $new_username ) || empty( $old_username ) ) {
				$response['alert_msg'] = __( 'Username can not be empty!', 'wp-edit-username' );

				wp_send_json( $response );
			}

			// ---------------------------------------------------------
			// Check if username consists invalid illegal character
			// ---------------------------------------------------------
			if ( ! validate_username( $new_username ) ) {
				$response['alert_msg'] = __( 'Username can not have illegal characters', 'wp-edit-username' );

				wp_send_json( $response );
			}

			// ---------------------------------------------------------
			// Filters the list of blacklisted usernames.
			//
			// @https://developer.wordpress.org/reference/hooks/illegal_user_logins/
			// ---------------------------------------------------------
			$illegal_user_logins = array_map( 'strtolower', (array) apply_filters( 'illegal_user_logins', array() ) );

			if ( in_array( $new_username, $illegal_user_logins, true ) ) {
				$response['alert_msg'] = __( 'Sorry, that username is not allowed.', 'wp-edit-username' );

				wp_send_json( $response );
			}

			// ---------------------------------------------------------
			// If $new_username already registered
			// ---------------------------------------------------------
			if ( username_exists( $new_username ) ) {
				$response['alert_msg'] = __( 'Sorry, that username already exists and not available.', 'wp-edit-username' );

				wp_send_json( $response );
			}

			global $wpdb;

			// ---------------------------------------------------------
			// Change / Update Username With old one
			// ---------------------------------------------------------
			// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
			$result = $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->users SET user_login = %s WHERE user_login = %s", $new_username, $old_username ) );

			if ( $result > 0 ) {
				$response['success_msg'] = sprintf(
					'%s <code>%s</code> %s <code>%s</code>.',
					esc_html__( 'Username updated from', 'wp-edit-username' ),
					esc_html( $old_username ),
					esc_html__( 'to', 'wp-edit-username' ),
					esc_html( $new_username )
				);

				if ( 'on' === WP_Edit_Username::get_option( 'wpeu_send_email_field', 'wpeu_register_settings_fields' ) ) {
					// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
					$user_email = $wpdb->get_var( $wpdb->prepare( "SELECT user_email FROM $wpdb->users WHERE user_login = %s", $new_username ) );

					switch ( WP_Edit_Username::get_option( 'wpeu_email_receiver_field', 'wpeu_register_settings_fields', 'admin_only' ) ) {
						case 'user_only':
							$to = array( sanitize_email( $user_email ) );
							break;

						case 'admin_only':
							$to     = array();
							$admins = get_users( 'role=Administrator' );

							foreach ( $admins as $admin ) {
								$to[] = sanitize_email( $admin->user_email );
							}
							break;

						case 'admin_user':
							$to     = array( sanitize_email( $user_email ) );
							$admins = get_users( 'role=Administrator' );

							foreach ( $admins as $admin ) {
								$to[] = sanitize_email( $admin->user_email );
							}
							break;

						default:
							$to = array();
							break;
					}

					$user = get_user_by( 'login', $new_username );

					if ( $user ) {
						/**
						 * Filters the email subject.
						 *
						 * This filter allows you to modify the email subject.
						 * You can use this filter to alter the email subject.
						 *
						 * @since    2.0.3
						 * @param    array $subject Saved email subject.
						 * @return   array $subject Modified email subject.
						 */
						$subject = apply_filters( 'wpeu_email_subject', WP_Edit_Username::get_option( 'wpeu_email_subject_field', 'wpeu_register_settings_fields', __( 'Username Changed!', 'wp-edit-username' ) ), $old_username, $new_username );

						/**
						 * Filters the email body.
						 *
						 * This filter allows you to modify the email body.
						 * You can use this filter to alter the email body.
						 *
						 * @since    2.0.3
						 * @param    array $body Saved email body.
						 * @return   array $body Modified email body.
						 */
						$body = apply_filters( 'wpeu_email_body', WP_Edit_Username::get_option( 'wpeu_email_body_field', 'wpeu_register_settings_fields', __( 'Your Username has been changed!', 'wp-edit-username' ) ), $old_username, $new_username );

						// Get user data with fallbacks for missing data.
						$first_name   = ! empty( $user->first_name ) ? $user->first_name : '';
						$last_name    = ! empty( $user->last_name ) ? $user->last_name : '';
						$display_name = ! empty( $user->display_name ) ? $user->display_name : '';
						$nickname     = ! empty( $user->nickname ) ? $user->nickname : '';
						$full_name    = trim( $first_name . ' ' . $last_name );
						$gravatar_url = get_avatar_url( $user->user_email, array( 'size' => 96 ) );

						// Data mapping for placeholders.
						$placeholders = array(
							'{{first_name}}',
							'{{last_name}}',
							'{{display_name}}',
							'{{nickname}}',
							'{{full_name}}',
							'{{gravatar_url}}',
							'{{old_username}}',
							'{{new_username}}',
						);

						$replacements = array(
							esc_html( $first_name ),
							esc_html( $last_name ),
							esc_html( $display_name ),
							esc_html( $nickname ),
							esc_html( $full_name ),
							esc_url( $gravatar_url ),
							esc_html( $old_username ),
							esc_html( $new_username ),
						);

						// Replace placeholders with actual data.
						$body = str_replace( $placeholders, $replacements, $body );

						/**
						 * Filters the email headers.
						 *
						 * This filter allows you to modify the email subject.
						 * You can use this filter to alter the email subject.
						 *
						 * @since    2.0.3
						 * @param    array $headers Default email headers.
						 * @return   array $headers Modified email headers.
						 */
						$headers = apply_filters( 'wpeu_email_headers', array( 'Content-Type: text/html; charset=UTF-8' ) );

						if ( $to ) {
							foreach ( $to as $email ) {
								wp_mail( $email, $subject, $body, $headers );
							}
						}
					}
				}
			}

			// ---------------------------------------------------------
			// Change / Update nicename if == username
			// ---------------------------------------------------------
			// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->users SET user_nicename = %s WHERE user_login = %s AND user_nicename = %s", $new_username, $new_username, $old_username ) );

			// ---------------------------------------------------------
			// Change / Update display name if == username
			// ---------------------------------------------------------
			// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
			$wpdb->query( $wpdb->prepare( "UPDATE $wpdb->users SET display_name = %s WHERE user_login = %s AND display_name = %s", $new_username, $new_username, $old_username ) );

			// ---------------------------------------------------------
			// Update Username on Multisite
			// ---------------------------------------------------------
			if ( is_multisite() ) {
				$super_admins = (array) get_site_option( 'site_admins', array( 'admin' ) );

				$array_key = array_search( $old_username, $super_admins, true );

				if ( $array_key ) {
					$super_admins[ $array_key ] = $new_username;
				}

				update_site_option( 'site_admins', $super_admins );
			}
		} else {
			$response['alert_message'] = __( 'Nonce verification failed.', 'wp-edit-username' );
		}

		wp_send_json( $response );
	}
}
