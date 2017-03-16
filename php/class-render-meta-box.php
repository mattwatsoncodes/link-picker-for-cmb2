<?php
/**
 * Class Render_Meta_Box
 *
 * @package mkdo\link_picker_for_cmb2
 */

namespace mkdo\link_picker_for_cmb2;

/**
 * Renders the meta box
 */
class Render_Meta_Box {

	/**
	 * Constructor
	 */
	function __construct() {
	}

	/**
	 * Do Work
	 */
	public function run() {
		add_action( 'cmb2_render_link_picker', array( $this, 'cmb2_render_link_picker' ), 10, 5 );
		add_filter( 'cmb2_sanitize_link_picker', array( $this, 'cmb2_sanitize_link_picker_split' ), 12, 4 );
		add_filter( 'cmb2_sanitize_link_picker', array( $this, 'cmb2_sanitize_link_picker' ), 10, 5 );
		add_filter( 'cmb2_types_esc_link_picker', array( $this, 'cmb2_types_esc_link_picker' ), 10, 4 );
		add_action( 'edit_form_after_editor', array( $this, 'render_placeholder_wysiwyg' ), 0 );
	}

	/**
	 * Render 'link_picker' custom field type
	 *
	 * @param array  $field              The passed in `CMB2_Field` object.
	 * @param mixed  $value              The value of this field escaped.
	 *                                   It defaults to `sanitize_text_field`.
	 *                                   If you need the unescaped value, you can access it
	 *                                   via `$field->value()`.
	 * @param int    $object_id          The ID of the current object.
	 * @param string $object_type        The type of object you are working with.
	 *                                   Most commonly, `post` (this applies to all post-types),
	 *                                   but could also be `comment`, `user` or `options-page`.
	 * @param object $field_type_object  The `CMB2_Types` object.
	 */
	public function cmb2_render_link_picker( $field, $value, $object_id, $object_type, $field_type_object ) {

		$value = wp_parse_args( $value, array(
			'text'  => '',
			'url'   => '',
			'blank' => 'false',
		) );

		$blank_options  = '';
		$blank_options .= '<option value="false" ' . selected( $value['blank'], 'false', false ) . '>' . esc_html__( 'Opens in same', 'link-picker-for-cmb2' ) . '</option>';
		$blank_options .= '<option value="true" ' . selected( $value['blank'], 'true', false ) . '>' . esc_html__( 'Opens in new', 'link-picker-for-cmb2' ) . '</option>';
		?>
		<div class="link-picker">
			<div class="text">
				<p>
					<label for="<?php echo esc_attr( $field_type_object->_id( '_text' ) ); ?>'">
						<?php echo esc_html( $field_type_object->_text( 'link_picker_text', 'Text' ) ); ?>
					</label>
				</p>
				<?php
				echo wp_kses(
					$field_type_object->input(
						array(
							'class' => 'cmb_text',
							'name'  => esc_attr( $field_type_object->_name( '[text]' ) ),
							'id'    => esc_attr( $field_type_object->_id( '_text' ) ),
							'value' => esc_attr( $value['text'] ),
							'desc'  => '',
						)
					),
					array(
						'input' => array(
							'type'     => array(),
							'class'    => array(),
							'name'     => array(),
							'id'       => array(),
							'value'    => array(),
							'disabled' => array(),
							'readonly' => array(),
						),
					)
				);
				?>
			</div>
			<div class="url">
				<p>
					<label for="<?php echo esc_attr( $field_type_object->_id( '_url' ) ); ?>'">
						<?php echo esc_html( $field_type_object->_text( 'link_picker_url', 'URL' ) ); ?>
					</label>
				</p>
				<?php
				echo wp_kses(
					$field_type_object->input(
						array(
							'class' => 'cmb_text_url',
							'name'  => esc_attr( $field_type_object->_name( '[url]' ) ),
							'id'    => esc_attr( $field_type_object->_id( '_url' ) ),
							'value' => esc_attr( $value['url'] ),
							'type'  => 'url',
							'desc'  => '',
						)
					),
					array(
						'input' => array(
							'type'     => array(),
							'class'    => array(),
							'name'     => array(),
							'id'       => array(),
							'value'    => array(),
							'disabled' => array(),
							'readonly' => array(),
						),
					)
				);
				?>
			</div>
			<div class="blank">
				<p>
					<label for="<?php echo esc_attr( $field_type_object->_id( '_blank' ) ); ?>'">
						<?php echo esc_html( $field_type_object->_text( 'link_picker_blank', 'Window' ) ); ?>
					</label>
				</p>
				<?php
				echo wp_kses(
					$field_type_object->select(
						array(
							'class'   => 'cmb_checkbox',
							'name'    => esc_attr( $field_type_object->_name( '[blank]' ) ),
							'id'      => esc_attr( $field_type_object->_id( '_blank' ) ),
							'options' => wp_kses(
								$blank_options,
								array(
									'option' => array(
										'selected' => array(),
										'value'    => array(),
									),
								)
							),
							'desc'    => '',
						)
					),
					array(
						'select' => array(
							'class'    => array(),
							'name'     => array(),
							'id'       => array(),
							'disabled' => array(),
						),
						'option' => array(
							'selected' => array(),
							'value'    => array(),
						),
					)
				);
				?>
			</div>
			<div class="choose">
				<p>
					<label><?php esc_html_e( 'Choose', 'link-picker-for-cmb2' );?></label>
				</p>
				<button class="dashicons dashicons-admin-links js-insert-link button button-primary" title="<?php esc_html_e( 'Insert Link', 'link-picker-for-cmb2' ); ?>">
	 				<span class="screen-reader-text">
						<?php esc_html_e( 'Choose Link', 'link-picker-for-cmb2' ); ?>
					</span>
	 			</button>
			</div>
		</div>
		<p class="clear">
			<?php
			echo wp_kses(
				$field_type_object->_desc(),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			);
			?>
		</p>

		<?php
	}


	/**
	 * Optionally save the Link Picker values into separate fields
	 *
	 * @param  null   $override_value Sanitization override value to return.
	 *                                It is passed in as null, and is what we
	 *                                will modify to short-circuit
	 *                                CMB2's saving mechanism.
	 * @param  string $value          The actual field value.
	 * @param  int    $object_id      The id of the object you are working with. Most commonly, the post id.
	 * @param  array  $field_args     The field arguments.
	 * @return null                   The override value
	 */
	public function cmb2_sanitize_link_picker_split( $override_value, $value, $object_id, $field_args ) {
		if ( ! isset( $field_args['split_values'] ) || ! $field_args['split_values'] ) {
			// Don't do the override.
			return $override_value;
		}
		$link_picker_keys = array(
			'text',
			'url',
			'blank',
		);
		foreach ( $link_picker_keys as $key ) {
			if ( ! empty( $value[ $key ] ) ) {
				update_post_meta( $object_id, $field_args['id'] . '_' . $key, $value[ $key ] );
			}
		}
	}

	/**
	 * The following snippets are required for allowing the address field
	 * to work as a repeatable field, or in a repeatable group
	 *
	 * @param  null   $check           Sanitization override value to return.
	 *                                 It is passed in as null, and is what we
	 *                                 will modify to short-circuit
	 *                                 CMB2's saving mechanism.
	 * @param  string $meta_value      The actual field value.
	 * @param  int    $object_id       The id of the object you are working with.
	 *                                 Most commonly, the post id.
	 * @param  array  $field_args      The field arguments.
	 * @param  object $sanitize_object This is an instance of the CMB2_Sanitize
	 *                                 object and gives you access to all of the
	 *                                 methods that CMB2 uses to sanitize its
	 *                                 field values.
	 * @return string                  The override value
	 */
	public function cmb2_sanitize_link_picker( $check, $meta_value, $object_id, $field_args, $sanitize_object ) {

		// if not repeatable, bail out.
		if ( ! is_array( $meta_value ) || ! $field_args['repeatable'] ) {
			return $check;
		}
		foreach ( $meta_value as $key => $val ) {
			$meta_value[ $key ] = null;
			if ( ! empty( $val['url'] ) ) {
				$meta_value[ $key ] = array_map( 'sanitize_text_field', $val );
			}
		}

		return $meta_value;
	}

	/**
	 * [cmb2_types_esc_link_picker description]
	 *
	 * @param  null   $check        Sanitization override value to return.
	 *                              It is passed in as null, and is what we
	 *                              will modify to short-circuit
	 *                              CMB2's saving mechanism.
	 * @param  string $meta_value   The actual field value.
	 * @param  array  $field_args   The field arguments.
	 * @param  object $field_object The field object.
	 * @return string               The override value
	 */
	public function cmb2_types_esc_link_picker( $check, $meta_value, $field_args, $field_object ) {

		// if not repeatable, bail out.
		if ( ! is_array( $meta_value ) || ! $field_args['repeatable'] ) {
			return $check;
		}
		foreach ( $meta_value as $key => $val ) {
			$meta_value[ $key ] = null;
			if ( ! empty( $val['url'] ) ) {
				$meta_value[ $key ] = array_map( 'esc_attr', $val );
			}
		}
		return $meta_value;
	}

	/**
	 * Render a placeholder wysiwyg box to allow dialogs to fire
	 */
	function render_placeholder_wysiwyg() {

		global $post;

		echo '<div class="hidden">';
		wp_editor( '', 'mkdo_lpfc_placeholder' );
		echo '</div>';

	}
}
