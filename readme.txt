=== WP Edit Username ===
Tags: user-profile, profile-edit, ajax, change-username, username
Contributors: sajjad67
Author: Sajjad Hossain Sagor
Tested up to: 6.8
Requires at least: 5.6
Stable tag: 2.0.3
Requires PHP: 8.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Easily Edit User Profile Username clicking a button.

== Description ==
This plugin adds feature to edit/change user username.

= Features: =
- Edit Username: Allows editing of usernames.
- Only users with the `edit_other_users()` capability can change usernames.
- If the “Send Email” option is enabled, the user will receive a notification email when their username is changed.
- You can customize the email subject and body text in the admin dashboard or via filter hooks.
- Modify the email subject using the filter: `wp_username_changed_email_subject`.
- Adjust the email body content using the filter `wp_username_changed_email_body`. (Note: `$new_username` and `$old_username` are automatically prepended to the email content).
= Hooks Usage: =

`<?php

add_filter( 'wp_username_changed_email_subject', 'change_email_subject' );
		
function change_email_subject( $subject )
{
	$subject = 'Your customized subject';
	
	return $subject;
}

add_filter( 'wp_username_changed_email_body', 'change_email_body' );

function change_email_body( $old_username, $new_username )
{
	$email_body = "Your custom email text body.";
	
	return $email_body;
}

?>`

== Installation ==
To add a WordPress Plugin using the built-in plugin installer:

Go to Plugins > Add New.

1. Type in the name "WP Edit Username" in Search Plugins box
2. Find the "WP Edit Username" Plugin to install.
3. Click Install Now to begin the plugin installation.
4. The resulting installation screen will list the installation as successful or note any problems during the install.
If successful, click Activate Plugin to activate it, or Return to Plugin Installer for further actions.

To add a WordPress Plugin from GitHub repo / plugin zip file :
1. Go to WordPress plugin page
2. Click Add New & Upload Plugin
3. Drag / Click upload the plugin zip file
4. The resulting installation screen will list the installation as successful or note any problems during the install.
If successful, click Activate Plugin to activate it, or Return to Plugin Installer for further actions.

== Frequently Asked Questions ==
= How to use this plugin? =
Just after installing WP Edit Username plugin, Go to user profile and edit user username by clicking Edit button.

Update inputs according to your requirement and you are good to go.

== Screenshots ==
1. Settings panel for WP Edit Username plugin.
2. Username Edit Button.
3. New Username Input Field.
4. After Username Changed Message.

== Changelog ==
= 2.0.3 =
- Applied security patch and added more html tags to the allowed html list
= 2.0.2 =
- Checked for latest wp version 6.8
= 2.0.1 =
- Minor changes in codebase only.
= 2.0.0 =
- Major changes in codebase. Compatibility checkup for latest wp version 6.7, updated bootstrap to latest, removed unused css and added confirmation before submitting username change form. 
= 1.0.8 =
- Updated button type from default 'submit' to 'button'
= 1.0.7 =
- Checked for latest wp version 6.6
= 1.0.6 =
- Fixed Plugin settings XSS vulnerability.
= 1.0.5 =
- Added additional email sender : User Only. Added bunch of shortcodes to use in the subject and email body.
= 1.0.4 =
- Checked for latest wp version 6.3
= 1.0.3 =
- Checked for latest wp version & updated coding styles... major changes nothing
= 1.0.2 =
- Checked for latest wp version & updated coding styles... major changes nothing
= 1.0.1 =
- Checked for latest wp version & updated coding styles... major changes nothing
= 1.0.0 =
- Initial release.

== Upgrade Notice ==
Always try to keep your plugin update so that you can get the improved and additional features added to this plugin up to date.