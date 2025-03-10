<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @since      2.0.0
 * @package    WP_Edit_Username
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) die;

/**
 * Remove plugin options on uninstall/delete
 */
delete_option( 'wpeu_register_settings_fields' );
