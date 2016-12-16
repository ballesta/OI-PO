<?php
/**
 * Class that handles all AJAX calls and admin settings
 *
 * This is called directly from vfb-pro/admin/class-addons.php and
 * vfb-pro/admin/class-ajax.php
 *
 * @since 3.0
 */
class VFB_Pro_Addon_Display_Entries_Admin_Settings {

	/**
	 * settings function.
	 *
	 * @access public
	 * @param mixed $data
	 * @return void
	 */
	public function settings( $data, $form_id ) {
		$display_fields = isset( $data['display-fields']     ) ? $data['display-fields']     : '';
		$seq_num        = isset( $data['display-seq-num']    ) ? $data['display-seq-num']    : '';
		$entry_date     = isset( $data['display-entry-date'] ) ? $data['display-entry-date'] : '';
	?>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row">
					<label for="display-fields"><?php _e( 'Fields to Display' , 'vfbp-display-entries' ); ?></label>
				</th>
				<td>
					<div id="vfb-export-entries-fields">
		    			<?php $this->fields_list( $form_id, $display_fields ); ?>
	    			</div> <!-- #vfb-export-entries-fields -->
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="display-seq-num"><?php _e( 'Entry ID' , 'vfbp-display-entries'); ?></label>
				</th>
				<td>
					<fieldset>
						<label>
							<input type="hidden" name="settings[display-seq-num]" value="0" /> <!-- This sends an unchecked value to the meta table -->
							<input type="checkbox" name="settings[display-seq-num]" id="display-seq-num" value="1"<?php checked( $seq_num, 1 ); ?> /> <?php _e( "Display the Entry ID (will be placed at the beginning of the row).", 'vfbp-display-entries' ); ?>
						</label>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="display-entry-date"><?php _e( 'Entry Date' , 'vfbp-display-entries'); ?></label>
				</th>
				<td>
					<fieldset>
						<label>
							<input type="hidden" name="settings[display-entry-date]" value="0" /> <!-- This sends an unchecked value to the meta table -->
							<input type="checkbox" name="settings[display-entry-date]" id="display-entry-date" value="1"<?php checked( $entry_date, 1 ); ?> /> <?php _e( "Display the Entry Date (will be placed at the end of the row).", 'vfbp-display-entries' ); ?>
						</label>
					</fieldset>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
	}

	/**
	 * Field checklist for Display Entries.
	 *
	 * @access public
	 * @param mixed $form_id
	 * @return void
	 */
	public function fields_list( $form_id, $selected ) {
		$vfbdb  = new VFB_Pro_Data();
		$fields = $vfbdb->get_fields( $form_id, "AND field_type NOT IN ('heading','instructions','page-break','captcha','submit') ORDER BY field_order ASC" );

		$entries_count = $vfbdb->get_entries_count( $form_id );
		if ( 0 == $entries_count )
			return _e( 'No entries.', 'vfbp-display-entries' );

		if ( is_array( $fields ) && !empty( $fields ) ) {
			foreach ( $fields as $field ) {
				$checked = isset( $selected[ $field['id'] ] ) ? $selected[ $field['id'] ] : '';
			?>
			<label for="vfb-export-fields-val-<?php echo $field['id']; ?>">
				<input name="settings[display-fields][<?php echo $field['id']; ?>]" class="vfb-export-fields-vals" id="vfb-export-fields-val-<?php echo $field['id']; ?>" type="checkbox" value="<?php echo $field['id']; ?>"<?php checked( $checked, $field['id'] ); ?> /> <?php echo $field['data']['label']; ?>
			</label>
			<br />
			<?php
			}
		}
	}
}