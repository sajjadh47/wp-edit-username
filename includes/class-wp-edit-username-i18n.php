<?php
/**
 * This file contains the definition of the WP_Edit_Username_I18n class, which
 * is used to load the plugin's internationalization.
 *
 * @package       WP_Edit_Username
 * @subpackage    WP_Edit_Username/includes
 * @author        Sajjad Hossain Sagor <sagorh672@gmail.com>
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since    2.0.0
 */
class WP_Edit_Username_I18n {
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'wp-edit-username',
			false,
			dirname( WP_EDIT_USERNAME_PLUGIN_BASENAME ) . '/languages/'
		);
	}
}
