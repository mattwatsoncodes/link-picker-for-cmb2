<?php
namespace mkdo\link_picker_for_cmb2;
/**
 * Class RenderMetaBox
 *
 * Renders the meta box
 *
 * @package mkdo\link_picker_for_cmb2
 */
class RenderMetaBox {

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
		add_action( 'edit_form_advanced', array( $this, 'render_placeholder_wysiwyg' ), 99 );
	}

	/**
	 * Render 'link_picker' custom field type
	 *
	 * @param array  $field              The passed in `CMB2_Field` object
	 * @param mixed  $value              The value of this field escaped.
	 *                                   It defaults to `sanitize_text_field`.
	 *                                   If you need the unescaped value, you can access it
	 *                                   via `$field->value()`
	 * @param int    $object_id          The ID of the current object
	 * @param string $object_type        The type of object you are working with.
	 *                                   Most commonly, `post` (this applies to all post-types),
	 *                                   but could also be `comment`, `user` or `options-page`.
	 * @param object $field_type_object  The `CMB2_Types` object
	 */
	public function cmb2_render_link_picker( $field, $value, $object_id, $object_type, $field_type_object ) {

		$value = wp_parse_args( $value, array(
			'text'  => '',
			'url'   => '',
			'blank' => 'false',
		) );

		$blank_options = '';
		$blank_options .= '<option value="false" '. selected( $value['blank'], 'false', false ) .'>Opens in same</option>';
		$blank_options .= '<option value="true" '. selected( $value['blank'], 'true', false ) .'>Opens in new</option>';
		?>
		<div class="link-picker">
			<div class="text"><p><label for="<?php echo $field_type_object->_id( '_text' ); ?>'"><?php echo esc_html( $field_type_object->_text( 'link_picker_text', 'Text' ) ); ?></label></p>
				<?php echo $field_type_object->input( array(
					'class' => 'cmb_text',
					'name'  => $field_type_object->_name( '[text]' ),
					'id'    => $field_type_object->_id( '_text' ),
					'value' => $value['text'],
					'desc'  => '',
				) ); ?>
			</div>
			<div class="url"><p><label for="<?php echo $field_type_object->_id( '_url' ); ?>'"><?php echo esc_html( $field_type_object->_text( 'link_picker_url', 'URL' ) ); ?></label></p>
				<?php echo $field_type_object->input( array(
					'class' => 'cmb_text_url',
					'name'  => $field_type_object->_name( '[url]' ),
					'id'    => $field_type_object->_id( '_url' ),
					'value' => $value['url'],
					'type'  => 'url',
					'desc'  => '',
				) ); ?>
			</div>
			<div class="blank"><p><label for="<?php echo $field_type_object->_id( '_blank' ); ?>'"><?php echo esc_html( $field_type_object->_text( 'link_picker_blank', 'Window' ) ); ?></label></p>
				<?php echo $field_type_object->select( array(
					'class'   => 'cmb_checkbox',
					'name'    => $field_type_object->_name( '[blank]' ),
					'id'      => $field_type_object->_id( '_blank' ),
					'options' => $blank_options,
					'desc'    => '',
				) ); ?>
			</div>
			<div class="choose">
				<p><label>Choose</label></p>
				<button class="dashicons dashicons-admin-links js-insert-link button button-primary" title="<?php esc_html_e( 'Insert Link', 'cmb' ); ?>">
	 				<span class="screen-reader-text"><?php esc_html_e( 'Choose Link', 'cmb' ); ?></span>
	 			</button>
			</div>
		</div>
		<p class="clear">
			<?php echo $field_type_object->_desc();?>
		</p>

		<?php
	}


	/**
	 * Optionally save the Link Picker values into separate fields
	 */
	public function cmb2_sanitize_link_picker_split( $override_value, $value, $object_id, $field_args ) {
		if ( ! isset( $field_args['split_values'] ) || ! $field_args['split_values'] ) {
			// Don't do the override
			return $override_value;
		}
		$link_picker_keys = array(
			'text',
			'url',
			'blank',
		);
		foreach ( $link_picker_keys as $key ) {
			if ( ! empty( $value[ $key ] ) ) {
				update_post_meta( $object_id, $field_args['id'] . '_'. $key, $value[ $key ] );
			}
		}

		// Tell CMB2 we already did the update
		// return true;
	}

	/**
	 * The following snippets are required for allowing the address field
	 * to work as a repeatable field, or in a repeatable group
	 */
	public function cmb2_sanitize_link_picker( $check, $meta_value, $object_id, $field_args, $sanitize_object ) {

		// if not repeatable, bail out.
		if ( ! is_array( $meta_value ) || ! $field_args['repeatable'] ) {
			return $check;
		}
		foreach ( $meta_value as $key => $val ) {
			$meta_value[ $key ] =  null;
			if( ! empty( $val['url'] ) ) {
				$meta_value[ $key ] = array_map( 'sanitize_text_field', $val );
			}
		}

		return $meta_value;
	}

	public function cmb2_types_esc_link_picker( $check, $meta_value, $field_args, $field_object ) {

		// if not repeatable, bail out.
		if ( ! is_array( $meta_value ) || ! $field_args['repeatable'] ) {
			return $check;
		}
		foreach ( $meta_value as $key => $val ) {
			$meta_value[ $key ] =  null;
			if( ! empty( $val['url'] ) ) {
				$meta_value[ $key ] = array_map( 'esc_attr', $val );
			}
		}
		return $meta_value;
	}

	/**
	 * Render a placeholder wysiwyg box to allow dialogs to fire
	 * @return string		A TinyMCE wysiwyg editor
	 */
	function render_placeholder_wysiwyg() {

		global $post;

		echo '<div class="hidden">';
		wp_editor( '', 'placeholder' );
		echo '</div>';

	}
}
