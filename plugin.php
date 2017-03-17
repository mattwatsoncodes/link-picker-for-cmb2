<?php
/**
 * Link Picker for CMB2
 *
 * @link              https://github.com/mkdo/link-picker-for-cmb2
 * @package           mkdo\link_picker_for_cmb2
 *
 * Plugin Name:       Link Picker for CMB2
 * Plugin URI:        https://github.com/mkdo/link-picker-for-cmb2
 * Description:       Link Picker control designed to work with CMB2
 * Version:           1.2.1
 * Author:            Make Do <hello@makedo.net>
 * Author URI:        http://www.makedo.in
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       link-picker-for-cmb2
 * Domain Path:       /languages
 */

// Constants.
define( 'MKDO_LPFC_ROOT', __FILE__ );

// Load Classes.
require_once 'php/class-controller-main.php';
require_once 'php/class-controller-assets.php';
require_once 'php/class-render-meta-box.php';

// Use Namespaces.
use mkdo\link_picker_for_cmb2\Controller_Main;
use mkdo\link_picker_for_cmb2\Controller_Assets;
use mkdo\link_picker_for_cmb2\Render_Meta_Box;

// Initialize Classes.
$controller_assets = new Controller_Assets();
$render_meta_box   = new Render_Meta_Box();
$controller        = new Controller_Main( $controller_assets, $render_meta_box );

// Run the Plugin.
$controller->run();
