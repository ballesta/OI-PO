<?php
/**
 * The main function for the add-on
 *
 * @since      2.0
 */
class VFB_Pro_Addon_Display_Entries_Main {
	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		add_shortcode( 'vfbp-display-entries', array( $this, 'display' ) );
		   add_action( 'wp_enqueue_scripts'  , array( $this, 'css'     ) );
		   add_action( 'wp_enqueue_scripts'  , array( $this, 'js'      ) );
	}

	/**
	 * Load public CSS files
	 *
	 * @access public
	 * @return void
	 */
	public function css() {
		$scripts = new VFB_Pro_Addon_Display_Entries_Scripts_Loader();
		$scripts->add_css();
	}

	/**
	 * Load public JS files
	 *
	 * @access public
	 * @return void
	 */
	public function js() {
		$scripts = new VFB_Pro_Addon_Display_Entries_Scripts_Loader();
		$scripts->add_js();
	}

	/**
	 * display function.
	 *
	 * @access public
	 * @static
	 * @param mixed $atts
	 * @param string $output (default: '')
	 * @return void
	 */
	public static function display( $atts, $output = '' ) {
		wp_enqueue_script( 'vfbp-display-entries' );
		wp_enqueue_script( 'jquery-datatables' );
		wp_enqueue_script( 'jquery-datatables-bootstrap' );

		$atts = shortcode_atts(
			array(
				'id'    => '',
				'entry' => '',
			),
			$atts,
			'vfbp-display-entries'
		);

		$form_id  = absint( $atts['id'] );
		$entry_id = absint( $atts['entry'] );

		if ( !empty( $entry_id ) )
			$output .= self::single_entry( $entry_id, $form_id );
		else
			$output .= self::datatable( $form_id );

		return $output;
	}

	/**
	 * datatable function.
	 *
	 * @access public
	 * @static
	 * @param mixed $form_id
	 * @return void
	 */
	public static function datatable( $form_id ) {
		$entries = self::get_entries( $form_id );
		
        //OI::affiche($entries,'Adhésions');
		$vfbdb  = new VFB_Pro_Data();
		$display_settings = $vfbdb->get_addon_settings( $form_id );

		$seq_num    = isset( $display_settings['display-seq-num']    ) ? $display_settings['display-seq-num']    : '';
		$entry_date = isset( $display_settings['display-entry-date'] ) ? $display_settings['display-entry-date'] : '';

		// Assemble headers
		$headers = array();
		foreach ( array_reverse( $entries ) as &$field ) {
			if ( isset( $field['data'] ) && is_array( $field['data'] ) ) {
				foreach ( $field['data'] as $index => $data ) {
					$headers[ $index ] = $data['label'];
				}
			}
		}
        //OI::affiche($entries,'Adhésions 2');

		$output = '<div class="vfbp-display-entries">';
			$output .= '<table class="vfbp-display-entries-table" cellspacing="0" width="100%">';
				$output .= '<thead>';
					$output .= '<tr>';
						// Entry ID
						if ( !empty( $seq_num ) ) {
							$output .= '<th>' . __( 'Entry ID', 'vfbp-display-entries' ) . '</th>';
						}

						// Headers
						foreach ( $headers as $header ) {
							$output .= '<th>' . $header . '</th>';
						}
						// Entry Date
						if ( !empty( $entry_date ) ) {
							$output .= '<th>' . __( 'Entry Date', 'vfbp-display-entries' ) . '</th>';
						}
		                $output .= '<th>' . 'Confirmation'. '</th>';

				$output .= '</tr>';
				$output .= '</thead>';
				$output .= '<tbody>';
					// Entry data
					foreach ( $entries as $field ) {
						$output .= '<tr>';

						// Entry ID
						if ( !empty( $seq_num ) ) {
							$output .= '<td>';
								$output .= $field['seq-num'] . '--';
							$output .= '</td>';
						}

						// All other data
						foreach ( $headers as $index => $header ) {
							if ( isset( $field['data'][ $index ] ) ) {
								$output .= '<td>';
										$output .= !empty( $field['data'][ $index ]['value'] ) ? $field['data'][ $index ]['value'] : '&nbsp;';
								$output .= '</td>';
							}
							else {
								$output .= '<td>&nbsp;</td>';
							}
						}

						// Entry Date
						if ( !empty( $entry_date ) ) {
							$output .= '<td>';
								$output .= $field['date'];
							$output .= '</td>';
						}
						$output .= '<td>';
							$output .= '<a href="confirmation_adhesion?id=' . $field['seq-num'] . '">Confirmation</a>';
						$output .= '</td>';

						$output .= '</tr>';
					}
				$output .= '</tbody>';
			$output .= '</table>';
		$output .= '</div>';

		return $output;
	}

	/**
	 * single_entry function.
	 *
	 * @access public
	 * @static
	 * @param mixed $entry_id
	 * @param mixed $form_id
	 * @return void
	 */
	public static function single_entry( $entry_id, $form_id ) {
		$entry = self::get_entry( $entry_id, $form_id );

		$output = '<table class="vfbp-display-entries-single" cellspacing="0" width="100%">';
			$output .= '<tbody>';
				// Entry data
				foreach ( $entry as $field ) {
					$output .= '<tr>';

					foreach ( $field['data'] as $data ) {
						$output .= '<td>';
							$output .= !empty( $data['label'] ) ? $data['label'] : '';
						$output .= '</td>';

						$output .= '<td>';
							$output .= !empty( $data['value'] ) ? $data['value'] : '';
						$output .= '</td>';
					}

					$output .= '</tr>';
				}
			$output .= '</tbody>';
		$output .= '<table>';

		return $output;
	}

	/**
	 * Get all entries for a form.
	 *
	 * @access public
	 * @static
	 * @param mixed $form_id
	 * @return void
	 */
	public static function get_entries( $form_id ) {
		$vfbdb  = new VFB_Pro_Data();
		$display_settings = $vfbdb->get_addon_settings( $form_id );
		$entry_data       = $vfbdb->get_entries_meta_by_form_id( $form_id, " AND p.post_status = 'publish'" );

		$fields = isset( $display_settings['display-fields'] ) ? $display_settings['display-fields'] : '';

		$entry_meta = $selected = array();
		$x = 0;

		foreach( $entry_data as $entry ) {
			// Get all postmeta for this entry
			$entry_meta = get_post_meta( $entry['ID'] );

			// Get the entry sequence number
			$seq_num = isset( $entry_meta['_vfb_seq_num'][0] ) ? $entry_meta['_vfb_seq_num'][0] : 0;

			// Setup initial selected fields array
			$selected[ $x ] = array(
				'seq-num'  => $seq_num,
				'entry-id' => $entry['ID'],
				'date'     => $entry['post_date'],
			);

			// Loop through postmeta for this entry
			foreach ( $entry_meta as $meta_key => $meta_value ) {
				$field_id = str_replace( '_vfb_field-', '', $meta_key );
				$field    = $vfbdb->get_field_by_id( $field_id );
				$label    = isset( $field['data']['label'] ) ? $field['data']['label'] : '';

				// Add field data to our selected array
				if ( isset( $fields[ $field_id ] ) ) {
					$value = isset( $meta_value[0] ) ? $meta_value[0] : '';

					$selected[ $x ]['data'][ $field_id ] = array(
						'label' => $label,
						'value' => $meta_value[0],
					);
				}
			}

			$x++;
		}

		return $selected;
	}

	/**
	 * Get a single entry based on entry ID and form ID.
	 *
	 * @access public
	 * @static
	 * @param mixed $entry_id
	 * @param mixed $form_id
	 * @return void
	 */
	public static function get_entry( $entry_id, $form_id ) {
		$vfbdb = new VFB_Pro_Data();
		$display_settings = $vfbdb->get_addon_settings( $form_id );
		$entry_data       = $vfbdb->get_entry_by_seq_num( $entry_id, $form_id );

		$fields = isset( $display_settings['display-fields'] ) ? $display_settings['display-fields'] : '';

		$selected = array();
		$x = 0;

		foreach ( $entry_data as $meta_key => $meta_value ) {
			$field_id = str_replace( '_vfb_field-', '', $meta_key );
			$field    = $vfbdb->get_field_by_id( $field_id );
			$label    = isset( $field['data']['label'] ) ? $field['data']['label'] : '';

			// Add field data to our selected array
			if ( isset( $fields[ $field_id ] ) ) {
				$value = isset( $meta_value[0] ) ? $meta_value[0] : '';

				$selected[ $x ]['data'][ $field_id ] = array(
					'label' => $label,
					'value' => $meta_value[0],
				);

				$x++;
			}
		}

		return $selected;
	}
}