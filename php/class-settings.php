<?php
/**
 * Class Settings
 *
 * @since	1.3.0
 *
 * @package mkdo\ground_control
 */

namespace mkdo\link_picker_for_cmb2;

/**
 * The main plugin settings page
 */
class Settings {

	/**
	 * Constructor.
	 *
	 * @since	1.3.0
	 */
	public function __construct() {}

	/**
	 * Do Work
	 *
	 * @since	1.3.0
	 */
	public function run() {
		add_action( 'admin_init', array( $this, 'init_settings_page' ) );
		add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
		add_action( 'plugin_action_links_' . plugin_basename( MKDO_LPFC_ROOT ) , array( $this, 'add_setings_link' ) );
	}

	/**
	 * Initialise the Settings Page.
	 *
	 * @since	1.3.0
	 */
	public function init_settings_page() {

		// Register settings.
		register_setting( MKDO_LPFC_PREFIX . '_settings_group', MKDO_LPFC_PREFIX . '_example_setting' );

		// Add sections.
		add_settings_section( MKDO_LPFC_PREFIX . '_example_section',
			esc_html__( 'Example Section Heading', 'link-picker-for-cmb2' ),
			array( $this, MKDO_LPFC_PREFIX . '_example_section_cb' ),
			MKDO_LPFC_PREFIX . '_settings'
		);

		// Add fields to a section.
		add_settings_field( MKDO_LPFC_PREFIX . '_example_field',
			esc_html__( 'Example Field Label:', 'link-picker-for-cmb2' ),
			array( $this, MKDO_LPFC_PREFIX . '_example_field_cb' ),
			MKDO_LPFC_PREFIX . '_settings',
			MKDO_LPFC_PREFIX . '_example_section'
		);
	}

	/**
	 * Call back for the example section.
	 *
	 * @since	1.3.0
	 */
	public function mkdo_LPFC_example_section_cb() {
		echo '<p>' . esc_html( 'Example description for this section.', 'link-picker-for-cmb2' ) . '</p>';
	}

	/**
	 * Call back for the example field.
	 *
	 * @since	1.3.0
	 */
	public function mkdo_LPFC_example_field_cb() {
		$example_option = get_option( MKDO_LPFC_PREFIX . '_example_option', 'Default text...' );
		?>

		<div class="field field-example">
			<p class="field-description">
				<?php esc_html_e( 'This is an example field.', 'link-picker-for-cmb2' );?>
			</p>
			<ul class="field-input">
				<li>
					<label>
						<input type="text" name="<?php echo esc_attr( MKDO_LPFC_PREFIX . '_example_field' ); ?>" value="<?php echo esc_attr( $example_option ); ?>" />
					</label>
				</li>
			</ul>
		</div>

		<?php
	}

	/**
	 * Add the settings page.
	 *
	 * @since	1.3.0
	 */
	public function add_settings_page() {
		add_submenu_page( 'options-general.php',
			esc_html__( 'Link Picker for CMB2', 'link-picker-for-cmb2' ),
			esc_html__( 'Link Picker for CMB2', 'link-picker-for-cmb2' ),
			'manage_options',
			MKDO_LPFC_PREFIX,
			array( $this, 'render_settings_page' )
		);
	}

	/**
	 * Render the settings page.
	 *
	 * @since	1.3.0
	 */
	public function render_settings_page() {
		?>
		<div class="wrap">
			<h2><?php esc_html_e( 'Link Picker for CMB2', 'link-picker-for-cmb2' );?></h2>

			<form action="settings.php" method="POST">
				<?php settings_fields( MKDO_LPFC_PREFIX . '_settings_group' ); ?>
				<?php do_settings_sections( MKDO_LPFC_PREFIX . '_settings' ); ?>
				<?php submit_button(); ?>
			</form>
		</div>
	<?php
	}

	/**
	 * Add 'Settings' action on installed plugin list.
	 *
	 * @param array $links An array of plugin action links.
	 *
	 * @since	1.3.0
	 */
	function add_setings_link( $links ) {
		array_unshift( $links, '<a href="options-general.php?page=' . esc_attr( MKDO_LPFC_PREFIX ) . '">' . esc_html__( 'Settings', 'link-picker-for-cmb2' ) . '</a>' );

		return $links;
	}
}