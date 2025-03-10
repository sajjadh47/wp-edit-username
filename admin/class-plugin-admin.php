<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, other methods and
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WP_Edit_Username
 * @subpackage WP_Edit_Username/admin
 * @author     Sajjad Hossain Sagor <sagorh672@gmail.com>
 */
class WP_Edit_Username_Admin
{
	/**
	 * The ID of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The plugin options.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      array    $options    Holds saved/default value of plugin options.
	 */
	private $options;

	/**
	 * The plugin options api wrapper object.
	 *
	 * @since    2.0.0
	 * @access   private
	 * @var      array    $settings_api    Holds the plugin settings api wrapper class object.
	 */
	private $settings_api;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.0.0
	 * @param    string    $plugin_name       The name of this plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version )
	{
		$this->plugin_name 	= $plugin_name;
		
		$this->version 		= $version;
		
		$this->options 		= get_option( 'wpeu_register_settings_fields', [] );
		
		$this->settings_api = new Sajjad_Dev_Settings_API;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_styles()
	{
		global $pagenow;
		
		// check if current page is edit user page and current user can edit user information
		if( in_array( $pagenow, array( 'profile.php', 'user-edit.php' ) ) && current_user_can( 'edit_users' ) )
		{
			wp_enqueue_style( $this->plugin_name, WP_EDIT_USERNAME_PLUGIN_URL . 'admin/css/admin.css', [], $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_scripts()
	{
		global $pagenow;
		
		// check if current page is edit user page and current user can edit user information
		if( in_array( $pagenow, array( 'profile.php', 'user-edit.php' ) ) && current_user_can( 'edit_users' ) )
		{
			wp_enqueue_script( $this->plugin_name, WP_EDIT_USERNAME_PLUGIN_URL . 'admin/js/admin.js', array( 'jquery' ), $this->version, false );
			
			wp_localize_script( $this->plugin_name, 'WP_Edit_Username',
				array( 
					'user_edit_txt_i18n' => __( 'Are you sure you want to update the username? This action cannot be undone.', 'wp-edit-username' ),
				)
			);
		}
	}

	/**
	 * Show edit username form modal.
	 *
	 * @since    2.0.0
	 */
	public function show_edit_modal()
	{
		global $pagenow;
		
		// check if current page is edit user page and current user can edit user information
		if( in_array( $pagenow, array( 'profile.php', 'user-edit.php' ) ) && current_user_can( 'edit_users' ) )
		{
			require_once WP_EDIT_USERNAME_PLUGIN_PATH . 'admin/partials/edit-username-form-modal.php';
		}
	}

	/**
	 * Adds a settings link to the plugin's action links on the plugin list table.
	 *
	 * @since    2.0.0
	 *
	 * @param    array $links The existing array of plugin action links.
	 * @return   array The updated array of plugin action links, including the settings link.
	 */
	public function add_plugin_action_links( $links )
	{
		$links[] = sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php?page=wp-edit-username' ), __( 'Settings', 'wp-edit-username' ) );
		
		return $links;
	}

	/**
	 * Adds the plugin settings page to the WordPress dashboard menu.
	 *
	 * @since    2.0.0
	 */
	public function admin_menu()
	{
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
	 * @since    2.0.0
	 */
	public function menu_page()
	{
		$this->settings_api->show_forms();
	}

	/**
	 * Register Plugin Options Via Settings API
	 *
	 * @since    2.0.0
	 */
	public function admin_init()
	{
		//set the settings
		$this->settings_api->set_sections( $this->get_settings_sections() );
		
		$this->settings_api->set_fields( $this->get_settings_fields() );

		//initialize settings
		$this->settings_api->admin_init();
	}

	/**
	 * Returns the settings sections for the plugin settings page.
	 *
	 * @since 2.0.0
	 *
	 * @return array An array of settings sections, where each section is an array
	 *               with 'id' and 'title' keys.
	 */
	public function get_settings_sections()
	{
		$sections = array(
			array(
				'id'    => 'wpeu_register_settings_fields',
				'title' => __( 'Notifications Settings', 'wp-edit-username' )
			)
		);
		
		return $sections;
	}

	/**
	 * Returns all the settings fields for the plugin settings page.
	 *
	 * @since 2.0.0
	 *
	 * @return array An array of settings fields, organized by section ID.  Each
	 *               section ID is a key in the array, and the value is an array
	 *               of settings fields for that section. Each settings field is
	 *               an array with 'name', 'label', 'type', 'desc', and other keys
	 *               depending on the field type.
	 */
	public function get_settings_fields()
	{
		$settings_fields = array(
			'wpeu_register_settings_fields' => array(
				array(
					'name'    => 'wpeu_send_email_field',
					'label'   => __( 'Send Email', 'wp-edit-username' ),
					'type'    => 'checkbox',
					'desc'    => __( 'Checking this box will enable sending emails to respective recipients when username change action happens.', 'wp-edit-username' )
				),
				array(
					'name'    => 'wpeu_email_receiver_field',
					'label'   => __( 'Send Emails To', 'wp-edit-username' ),
					'type'    => 'radio',
					'options' => array(
						'admin_only'  	=> __( 'Admins Only', 'wp-edit-username' ),
						'user_only' 	=> __( 'User Only', 'wp-edit-username' ),
						'admin_user' 	=> __( 'Admins & User', 'wp-edit-username' ),
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
					'type'    => 'textarea',
					'default' => __( 'Your Username has been changed', 'wp-edit-username' ),
					'desc'    => __( '<p>Available shortcodes are : <code>{{first_name}}</code> <code>{{last_name}}</code> <code>{{display_name}}</code> <code>{{full_name}}</code> <code>{{old_username}}</code> <code>{{new_username}}</code></p>', 'wp-edit-username' ),
				),
			)
		);

		return $settings_fields;
	}

	/**
	 * Handles the AJAX request to update the username.
	 *
	 * @since    2.0.0
	 * 
	 * @return   void Sends a JSON response indicating success or failure.
	 */
	public function update_user_name()
	{
		$response 								= array();

		$to 									= array();
		
		if( ! current_user_can( 'edit_users' ) )
		{
			$response['alert_msg'] 				= __( 'Permission denied!', 'wp-edit-username' );
				
			wp_send_json( $response ); die();
		}

		if ( ! isset( $_POST['new_username'] ) && ! isset( $_POST['current_username'] ) )
		{
			$response['alert_msg'] 				= __( 'Invalid fields!', 'wp-edit-username' );
				
			wp_send_json( $response ); die();
		}

		if ( isset( $_POST['wp_edit_username_nonce'] ) && wp_verify_nonce( $_POST['wp_edit_username_nonce'], 'wp_edit_username_action' ) )
		{
			$new_username 						= sanitize_user( $_POST['new_username'] );
			
			$current_username 					= sanitize_user( $_POST['current_username'] );

			// ---------------------------------------------------------
			// check if new_username is empty
			// ---------------------------------------------------------
			if( empty( $new_username ) || empty( $current_username ) )
			{
				$response['alert_msg'] 			= __( 'Username can not be empty!', 'wp-edit-username' );
				
				wp_send_json( $response ); die();
			}

			// ---------------------------------------------------------
			// Check if username consists invalid illegal character
			// ---------------------------------------------------------
			if( ! validate_username( $new_username ) )
			{
				$response['alert_msg'] 			= __( 'Username can not have illegal characters', 'wp-edit-username' );
				
				wp_send_json( $response ); die();
			}

			// ---------------------------------------------------------
			// Filters the list of blacklisted usernames.
			//
			// @https://developer.wordpress.org/reference/hooks/illegal_user_logins/
			// ---------------------------------------------------------
			$illegal_user_logins 				= array_map( 'strtolower', (array) apply_filters( 'illegal_user_logins', array() ) );

			if ( in_array( $new_username, $illegal_user_logins ) )
			{
				$response['alert_msg'] 			=  __( 'Sorry, that username is not allowed.', 'wp-edit-username' );
				
				wp_send_json( $response ); die();
			}

			// ---------------------------------------------------------
			// If $new_username already registered
			// ---------------------------------------------------------
			if( username_exists( $new_username ) )
			{
				$response['alert_msg'] 			=  __( 'Sorry, that username already exists and not available.', 'wp-edit-username' );
				
				wp_send_json( $response ); die();
			}

			global $wpdb;

			// ---------------------------------------------------------
			// Change / Update Username With old one
			// ---------------------------------------------------------
			$query  							= $wpdb->prepare( "UPDATE $wpdb->users SET user_login = %s WHERE user_login = %s", $new_username, $current_username );
			
			$result 							= $wpdb->query( $query );

			if ( $result > 0 )
			{
				$response['success_msg'] 		=  sprintf( 'Username updated from <code>%s</code> to <code>%s</code>.', $current_username, $new_username );

				if ( isset( $this->options['wpeu_send_email_field'] ) && $this->options['wpeu_send_email_field'] == 'on' )
				{
					$user_email 				= $wpdb->get_var( $wpdb->prepare( "SELECT user_email FROM $wpdb->users WHERE user_login = %s", $new_username ) );

					if ( isset( $this->options['wpeu_email_receiver_field'] ) )
					{						
						if ( $this->options['wpeu_email_receiver_field'] == 'user_only' )
						{    
							$to 				= array( sanitize_email( $user_email ) );
						}
						elseif ( $this->options['wpeu_email_receiver_field'] == 'admin_only' )
						{    
							$to 				= array();
							
							$admins 			= get_users( 'role=Administrator' );
							
							foreach ( $admins as $admin )
							{
								$to[] 			= sanitize_email( $admin->user_email );
							}
						}
						elseif ( $this->options['wpeu_email_receiver_field'] == 'admin_user' )
						{
							$to 				= array( sanitize_email( $user_email ) );
							
							$admins 			= get_users( 'role=Administrator' );
							
							foreach ( $admins as $admin )
							{
								$to[] 			= sanitize_email( $admin->user_email );
							}
						}
					}

					$subject 					= apply_filters( 'wp_username_changed_email_subject', $subject = $this->options['wpeu_email_subject_field'], $old_username, $new_username );

					$body 	 					= apply_filters( 'wp_username_changed_email_body', $body = $this->options['wpeu_email_body_field'], $old_username, $new_username );

					$user 	 					= get_user_by( 'login', $new_username );
			
					if( $user )
					{
						$body 					= str_replace( [ '{{first_name}}', '{{last_name}}', '{{display_name}}', '{{full_name}}', '{{old_username}}', '{{new_username}}' ], [ $user->first_name, $user->last_name, $user->display_name, $user->first_name . ' ' . $user->last_name, $current_username, $new_username ], $body );
					}

					$headers 					= array( 'Content-Type: text/html; charset=UTF-8' );

					foreach ( $to as $email )
					{
						wp_mail( $email, $subject, $body, $headers );
					}
				}
			}

			// ---------------------------------------------------------
			// Change / Update nicename if == username
			// ---------------------------------------------------------
			$query 								= $wpdb->prepare( "UPDATE $wpdb->users SET user_nicename = %s WHERE user_login = %s AND user_nicename = %s", $new_username, $new_username, $current_username );
			
			$wpdb->query( $query );

			// ---------------------------------------------------------
			// Change / Update display name if == username
			// ---------------------------------------------------------
			$query  							= $wpdb->prepare( "UPDATE $wpdb->users SET display_name = %s WHERE user_login = %s AND display_name = %s", $new_username, $new_username, $current_username );
			
			$wpdb->query( $query );

			// ---------------------------------------------------------
			// Update Username on Multisite
			// ---------------------------------------------------------
			if( is_multisite() )
			{
				$super_admins 					= (array) get_site_option( 'site_admins', array( 'admin' ) );
				
				$array_key 						= array_search( $current_username, $super_admins );

				if( $array_key )
				{
					$super_admins[ $array_key ] = $new_username;
				}
				
				update_site_option( 'site_admins' , $super_admins );
			}
		}
		else
		{
			$response['alert_message'] 			=  __( 'Nonce verification failed.', 'wp-edit-username' );
		}

		wp_send_json( $response ); die();
	}
}
