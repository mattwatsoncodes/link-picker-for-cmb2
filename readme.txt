=== Link Picker for CMB2 ===
Contributors: mkdo, mwtsn, sagetopia
Donate link:
Tags: link, link picker, cmb2
Requires at least: 4.5
Tested up to: 4.7.2
Stable tag: 1.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Link Picker control designed to work with CMB2

== Description ==

Using the Link Picker for [CMB2](https://wordpress.org/plugins/cmb2/) control, you can choose a link from your WordPress site, or manually enter a link. You can also identify if the link should open in a new window, or not.

Features:

* Easy to integrate with [CMB2](https://wordpress.org/plugins/cmb2/), just add a type of `link_picker`
* Works with repeatable groups
* Works as a repeatable field when `repeatable` is set to `true`
* Outputs an array of `text`, `url` and `blank` when using `get_post_meta`
* You are able to split the values of the field into individual parts by setting `split_values` to `true`. You can retrieve the split values by using the ID of the field and appending `_text`, `_url` and `_blank` to the ID when using `get_post_meta` (not compatible if using a repeatable field)

== Installation ==

1. Backup your WordPress install
2. Upload the plugin folder to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Configure the plugin via the 'Link Picker for CMB2' options page under the WordPress 'Settings' Menu

== Screenshots ==

1. The Link Picker Control
2. Choose a link from your WordPress install
3. Responsive design
4. Setting a field as repeatable
5. The Link Picker as a repeatable field
6. Setting a field to have split values

== Changelog ==

= 1.0.0 =
* First stable release

= 1.0.1 =
* Media assets error message fix

= 1.0.2 =
* Updated responsiveness of control

= 1.0.3 =
* Fixed JS issues (with thanks to [sagetopia](https://profiles.wordpress.org/sagetopia/))

= 1.0.4 =
* Control now works if editor not supported by post type

= 1.0.5 =
* Fixed a bug where the link was getting added to the main content editor

= 1.1.0 =
* JS Error free for 2017! - Squashed all those nasty JS console bugs

= 1.2.0 =
* WP Coding Standards, We got em! - Now passes those pesky WP Coding Standards

= 1.2.1 =
* Added new artwork
