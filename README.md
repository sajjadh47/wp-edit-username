# WP Edit Username

[![Plugin Banner](https://ps.w.org/wp-edit-username/assets/banner-772x250.png)](https://wordpress.org/plugins/wp-edit-username/)

**Tags:** user, user-profile, profile-edit, edit, ajax, update, change-username, username \
**Tested up to:** 6.8 \
**Requires PHP:** 8.0

Easily Edit User Profile Username clicking a button.

## Description

This plugin adds feature to edit/change user username.

### Features:

- Edit Username: Allows editing of usernames.
- Only users with the `edit_other_users()` capability can change usernames.
- If the “Send Email” option is enabled, the user will receive a notification email when their username is changed.
- You can customize the email subject and body text in the admin dashboard or via filter hooks.
- Modify the email subject using the filter: `wpeu_email_subject`.
- Modify the email headers using the filter: `wpeu_email_headers`.
- Adjust the email body content using the filter `wpeu_email_body`. (Note: `$new_username` and `$old_username` are automatically prepended to the email content).
### Hooks Usage:

`
	
	<?php
	
	add_filter( "wp_username_changed_email_subject", "change_email_subject" );
	
	function change_email_subject( $subject )
	{
		$subject = 'Your customized subject';
		
		return $subject;
	}
	
	add_filter( "wp_username_changed_email_body", "change_email_body" );
	
	function change_email_body( $old_username, $new_username )
	{
		$email_body = "Your custom email text body.";
		
		return $email_body;
	}
	
	?>
`

## Installation

To add a WordPress Plugin using the built-in plugin installer:

Go to Plugins > Add New.

1. Type in the name "WP Edit Username" in Search Plugins box
2. Find the "WP Edit Username" Plugin to install.
3. Click Install Now to begin the plugin installation.
4. The resulting installation screen will list the installation as successful or note any problems during the install.
If successful, click Activate Plugin to activate it, or Return to Plugin Installer for further actions.

To add a WordPress Plugin from github repo / plugin zip file :
1. Go to wordpress plugin page
2. Click Add New & Upload Plugin
3. Drag / Click upload the plugin zip file
4. The resulting installation screen will list the installation as successful or note any problems during the install.
If successful, click Activate Plugin to activate it, or Return to Plugin Installer for further actions.

## Frequently Asked Questions

### How to use this plugin?

Just after installing WP Edit Username plugin, Go to user profile and edit user username by clicking Edit button.

Update inputs according to your requirement and you are good to go.

## Screenshots

### 1. Settings panel for WP Edit Username Plugin.

![Settings panel for WP Edit Username Plugin.](https://ps.w.org/wp-edit-username/assets/screenshot-1.png)

### 2. Username Edit Button.

![Username Edit Button.](https://ps.w.org/wp-edit-username/assets/screenshot-2.png)

### 3. New Username Input Field.

![New Username Input Field.](https://ps.w.org/wp-edit-username/assets/screenshot-3.png)

### 4. After Username Changed Message.

![After Username Changed Message.](https://ps.w.org/wp-edit-username/assets/screenshot-4.png)

## Changelog

### 2.0.3
* Fixed issue: typo giving fatal error

### 2.0.2
- Checked for latest wp version 6.8

### 2.0.1
- Minor changes in codebase only.

### 1.0.7
- Checked for latest wp version & updated coding styles... major changes nothing

### 1.0.6
- Checked for latest wp version & updated coding styles... major changes nothing

### 1.0.5
- Checked for latest wp version & updated coding styles... major changes nothing

### 1.0.4
- Checked for latest wp version & updated coding styles... major changes nothing

### 1.0.3
- Checked for latest wp version & updated coding styles... major changes nothing

### 1.0.2
- Checked for latest wp version & updated coding styles... major changes nothing

### 1.0.1
- Checked for latest wp version & updated coding styles... major changes nothing

### 1.0.0
- Initial release.

## Upgrade Notice

Always try to keep your plugin update so that you can get the improved and additional features added to this plugin up to date.