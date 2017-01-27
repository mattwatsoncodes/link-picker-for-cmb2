<?php
/**
 * Class Controller_Main
 *
 * @package mkdo\link_picker_for_cmb2
 */

namespace mkdo\link_picker_for_cmb2;

/**
 * The main loader for this plugin
 */
class Controller_Main {

	/**
	 * Object to load the assets
	 *
	 * @var Object
	 */
	private $controller_assets;

	/**
	 * Object to render the meta boxes
	 *
	 * @var Object
	 */
	private $render_meta_box;

	/**
	 * Constructor
	 *
	 * @param Controller_Assets $controller_assets Object to load the assets.
	 * @param Render_Meta_Box   $render_meta_box   Object to render the meta boxes.
	 */
	public function __construct( Controller_Assets $controller_assets, Render_Meta_Box $render_meta_box ) {
		$this->controller_assets = $controller_assets;
		$this->render_meta_box   = $render_meta_box;
	}

	/**
	 * Do Work
	 */
	public function run() {
		load_plugin_textdomain( 'link-picker-for-cmb2', false, MKDO_LPFC_ROOT . '\languages' );

		$this->controller_assets->run();
		$this->render_meta_box->run();
	}
}
