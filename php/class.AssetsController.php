<?php
namespace mkdo\link_picker_for_cmb2;
/**
 * Class AssetsController
 *
 * Sets up the JS and CSS needed for this plugin
 *
 * @package mkdo\link_picker_for_cmb2
 */
class AssetsController {

	/**
	 * Constructor
	 */
	function __construct() {
	}

	/**
	 * Do Work
	 */
	public function run() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Enqeue Scripts
	 */
	public function admin_enqueue_scripts() {

		global $post_id;

		/* CSS */
		$plugin_css_url = plugins_url( 'css/plugin.css', MKDO_LPFC_ROOT );
		wp_enqueue_style( MKDO_LPFC_TEXT_DOMAIN, $plugin_css_url );

		/* Media */
		if ( isset( $post_id ) ) {
			wp_enqueue_media( array( 'post' => $post_id ) );
		}

		/* JS */
		$plugin_js_url  = plugins_url( 'js/plugin.js', MKDO_LPFC_ROOT );
		wp_enqueue_script( MKDO_LPFC_TEXT_DOMAIN, $plugin_js_url, array( 'jquery', 'jquery-ui-core', 'jquery-ui-draggable', 'jquery-ui-droppable', 'thickbox', 'wpdialogs', 'wplink' ), '1.0.4', true );
	}
}
