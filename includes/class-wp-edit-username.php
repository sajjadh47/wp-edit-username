<?php
/**
 * This file contains the definition of the WP_Edit_Username class, which
 * is used to begin the plugin's functionality.
 *
 * @package       WP_Edit_Username
 * @subpackage    WP_Edit_Username/includes
 * @author        Sajjad Hossain Sagor <sagorh672@gmail.com>
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since    2.0.0
 */
class WP_Edit_Username {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since     2.0.0
	 * @access    protected
	 * @var       WP_Edit_Username_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since     2.0.0
	 * @access    protected
	 * @var       string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since     2.0.0
	 * @access    protected
	 * @var       string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function __construct() {
		if ( defined( 'WP_EDIT_USERNAME_VERSION' ) ) {
			$this->version = WP_EDIT_USERNAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}

		$this->plugin_name = 'wp-edit-username';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - WP_Edit_Username_Loader. Orchestrates the hooks of the plugin.
	 * - WP_Edit_Username_i18n.   Defines internationalization functionality.
	 * - Sajjad_Dev_Settings_API. Provides an interface for interacting with the WordPress Options API.
	 * - WP_Edit_Username_Admin.  Defines all hooks for the admin area.
	 * - WP_Edit_Username_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since     2.0.0
	 * @access    private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once WP_EDIT_USERNAME_PLUGIN_PATH . 'includes/class-wp-edit-username-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once WP_EDIT_USERNAME_PLUGIN_PATH . 'includes/class-wp-edit-username-i18n.php';

		/**
		 * The class responsible for defining an interface for interacting with the WordPress Options API.
		 */
		require_once WP_EDIT_USERNAME_PLUGIN_PATH . 'includes/class-sajjad-dev-settings-api.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once WP_EDIT_USERNAME_PLUGIN_PATH . 'admin/class-wp-edit-username-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once WP_EDIT_USERNAME_PLUGIN_PATH . 'public/class-wp-edit-username-public.php';

		$this->loader = new WP_Edit_Username_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the WP_Edit_Username_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since     2.0.0
	 * @access    private
	 */
	private function set_locale() {
		$plugin_i18n = new WP_Edit_Username_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since     2.0.0
	 * @access    private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new WP_Edit_Username_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'plugin_action_links_' . WP_EDIT_USERNAME_PLUGIN_BASENAME, $plugin_admin, 'add_plugin_action_links' );

		$this->loader->add_action( 'admin_footer', $plugin_admin, 'show_edit_modal' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'admin_init' );

		$this->loader->add_action( 'wp_ajax_wpeu_update_user_name', $plugin_admin, 'update_user_name' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since     2.0.0
	 * @access    private
	 */
	private function define_public_hooks() {
		$plugin_public = new WP_Edit_Username_Public( $this->get_plugin_name(), $this->get_version() );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since     2.0.0
	 * @access    public
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @return    string The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @return    WP_Edit_Username_Loader Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @return    string The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieves the value of a specific settings field.
	 *
	 * This method fetches the value of a settings field from the WordPress options database.
	 * It retrieves the entire option group for the given section and then extracts the
	 * value for the specified field.
	 *
	 * @since     2.0.0
	 * @access    public
	 * @param     string $option        The name of the settings field.
	 * @param     string $section       The name of the section this field belongs to. This corresponds
	 *                                  to the option name used in `register_setting()`.
	 * @param     string $default_value Optional. The default value to return if the field's value
	 *                                  is not found in the database. Default is an empty string.
	 * @return    string|mixed          The value of the settings field, or the default value if not found.
	 */
	public static function get_option( $option, $section, $default_value = '' ) {
		$options = get_option( $section ); // Get all options for the section.

		// Check if the option exists within the section's options array.
		if ( isset( $options[ $option ] ) ) {
			return $options[ $option ]; // Return the option value.
		}

		return $default_value; // Return the default value if the option is not found.
	}
}
