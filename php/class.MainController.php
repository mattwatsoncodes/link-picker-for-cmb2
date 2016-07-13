<?php

namespace mkdo\link_picker_for_cmb2;

/**
 * Class MainController
 *
 * The main loader for this plugin
 *
 * @package mkdo\link_picker_for_cmb2
 */
class MainController {

	private $assets_controller;
	private $render_meta_box;

	/**
	 * Constructor
	 *
	 * @param Options            $options              Object defining the options page
	 * @param AssetsController   $assets_controller    Object to load the assets
	 * @param RenderMetaBoxes    $render_meta_boxes    Object to render the meta boxes
	 */
	public function __construct( AssetsController $assets_controller, RenderMetaBox $render_meta_box ) {
        $this->assets_controller = $assets_controller;
        $this->render_meta_box   = $render_meta_box;
	}

	/**
	 * Do Work
	 */
	public function run() {
		load_plugin_textdomain( MKDO_LPFC_TEXT_DOMAIN, false, MKDO_LPFC_ROOT . '\languages' );

		$this->assets_controller->run();
		$this->render_meta_box->run();
	}
}
