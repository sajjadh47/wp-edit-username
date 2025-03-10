<?php

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      2.0.0
 * @package    WP_Edit_Username
 * @subpackage WP_Edit_Username/includes
 * @author     Sajjad Hossain Sagor <sagorh672@gmail.com>
 */
class WP_Edit_Username_i18n
{
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    2.0.0
	 */
	public function load_plugin_textdomain()
	{
		load_plugin_textdomain(
			'wp-edit-username',
			false,
			dirname( WP_EDIT_USERNAME_PLUGIN_BASENAME ) . '/languages/'
		);
	}
}
