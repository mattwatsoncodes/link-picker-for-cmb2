<?php

/**
 * @link              https://github.com/mkdo/link-picker-for-cmb2
 * @package           mkdo\link_picker_for_cmb2
 *
 * Plugin Name:       Link Picker for CMB2
 * Plugin URI:        https://github.com/mkdo/link-picker-for-cmb2
 * Description:       Link Picker control designed to work with CMB2
 * Version:           1.0.3
 * Author:            Make Do <hello@makedo.net>
 * Author URI:        http://www.makedo.in
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       link-picker-for-cmb2
 * Domain Path:       /languages
 */

// Constants
define( 'MKDO_LPFC_ROOT', __FILE__ );
define( 'MKDO_LPFC_TEXT_DOMAIN', 'link-picker-for-cmb2' );

// Load Classes
require_once "php/class.MainController.php";
require_once "php/class.AssetsController.php";
require_once "php/class.RenderMetaBox.php";

// Use Namespaces
use mkdo\link_picker_for_cmb2\MainController;
use mkdo\link_picker_for_cmb2\AssetsController;
use mkdo\link_picker_for_cmb2\RenderMetaBox;

// Initialize Classes
$assets_controller = new AssetsController();
$render_meta_box   = new RenderMetaBox();
$controller        = new MainController( $assets_controller, $render_meta_box );

// Run the Plugin
$controller->run();
