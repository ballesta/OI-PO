<?php
/**
 * Class that handles all AJAX calls and admin settings
 *
 * This is called directly from vfb-pro/admin/class-addons.php and
 * vfb-pro/admin/class-ajax.php
 *
 * @since 3.0
 */
class VFB_Pro_Addon_Payments_Admin_Settings {
	/**
	 * settings function.
	 *
	 * @access public
	 * @param mixed $data
	 * @return void
	 */
	public function settings( $data, $form_id ) {
		$payments_enable = isset( $data['payments-enable']        ) ? $data['payments-enable']        : '';
		$merchant_type   = isset( $data['payments-merchant']      ) ? $data['payments-merchant']      : '';
		$running_total   = isset( $data['payments-running-total'] ) ? $data['payments-running-total'] : '';
		$price_fields    = isset( $data['payments-fields']        ) ? $data['payments-fields']        : '';

		// PayPal
		$paypal_email             = isset( $data['payments-paypal']['email']            ) ? $data['payments-paypal']['email']            : '';
		$paypal_language          = isset( $data['payments-paypal']['language']         ) ? $data['payments-paypal']['language']         : '';
		$paypal_currency          = isset( $data['payments-paypal']['currency']         ) ? $data['payments-paypal']['currency']         : '';
		$paypal_shipping          = isset( $data['payments-paypal']['shipping']         ) ? $data['payments-paypal']['shipping']         : '';
		$paypal_prepop_billing    = isset( $data['payments-paypal']['prepop-billing']   ) ? $data['payments-paypal']['prepop-billing']   : '';
		$paypal_billing_name      = isset( $data['payments-paypal']['billing-name']     ) ? $data['payments-paypal']['billing-name']     : '';
		$paypal_billing_addr      = isset( $data['payments-paypal']['billing-address']  ) ? $data['payments-paypal']['billing-address']  : '';
		$paypal_billing_email     = isset( $data['payments-paypal']['billing-email']    ) ? $data['payments-paypal']['billing-email']    : '';
		$paypal_recurring         = isset( $data['payments-paypal']['recurring']        ) ? $data['payments-paypal']['recurring']        : '';
		$paypal_recurring_period  = isset( $data['payments-paypal']['recurring-period'] ) ? $data['payments-paypal']['recurring-period'] : '';
		$paypal_recurring_type    = isset( $data['payments-paypal']['recurring-type']   ) ? $data['payments-paypal']['recurring-type']   : '';
		$paypal_recurring_desc    = isset( $data['payments-paypal']['recurring-desc']   ) ? $data['payments-paypal']['recurring-desc']   : '';
		$paypal_return_url        = isset( $data['payments-paypal']['return-url']       ) ? $data['payments-paypal']['return-url']       : '';
		$paypal_cancel_url        = isset( $data['payments-paypal']['cancel-url']       ) ? $data['payments-paypal']['cancel-url']       : '';

		// Prices
		$base_price_name = isset( $data['payments-base-price-name'] ) ? $data['payments-base-price-name'] : __( 'Base Price', 'vfbp-payments' );
		$base_price      = isset( $data['payments-base-price']      ) ? $data['payments-base-price']      : '0.00';

		$vfbdb        = new VFB_Pro_Data();
		$all_fields   = $vfbdb->get_fields( $form_id );
		$name_fields  = $vfbdb->get_fields( $form_id, "AND field_type = 'name' ORDER BY field_order ASC" );
		$addr_fields  = $vfbdb->get_fields( $form_id, "AND field_type = 'address' ORDER BY field_order ASC" );
		$email_fields = $vfbdb->get_fields( $form_id, "AND field_type = 'email' ORDER BY field_order ASC" );

	?>
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row">
					<label for="payments-enable"><?php _e( 'Enable Payments' , 'vfbp-payments'); ?></label>
				</th>
				<td>
					<fieldset>
						<label>
							<input type="hidden" name="settings[payments-enable]" value="0" /> <!-- This sends an unchecked value to the meta table -->
							<input type="checkbox" name="settings[payments-enable]" id="payments-enable" value="1"<?php checked( $payments_enable, 1 ); ?> /> <?php _e( "Enable payments for this form.", 'vfbp-payments' ); ?>
						</label>
					</fieldset>
				</td>
			</tr>
		</tbody>
		<tbody class="vfb-payments-settings<?php echo !empty( $payments_enable ) ? ' active' : ''; ?>">
			<tr valign="top">
				<th scope="row">
					<label for="payments-merchant"><?php _e( 'Select a Merchant' , 'vfbp-payments'); ?></label>
				</th>
				<td>
					<select name="settings[payments-merchant]" id="payments-merchant">
						<option value=""<?php selected( $merchant_type, '' ); ?>></option>
						<option value="paypal"<?php selected( $merchant_type, 'paypal' ); ?>><?php _e( 'PayPal Standard', 'vfbp-payments' ); ?></option>
					</select>
				</td>
			</tr>
		</tbody>
		<tbody class="vfb-paypal-settings<?php echo 'paypal' == $merchant_type && !empty( $payments_enable ) ? ' active' : ''; ?>">
			<tr valign="top">
				<th scope="row">
					<label for="paypal-email"><?php _e( 'Email Address' , 'vfbp-payments'); ?></label>
				</th>
				<td>
					<input type="email" name="settings[payments-paypal][email]" id="paypal-email" value="<?php esc_html_e( $paypal_email ); ?>" class="regular-text" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="paypal-language"><?php _e( 'Language' , 'vfbp-payments'); ?></label>
				</th>
				<td>
					<select name="settings[payments-paypal][language]" id="paypal-language">
						<option value="US"<?php selected( $paypal_language, 'US' ); ?>><?php _e( 'English (American)', 'vfbp-payments' ); ?></option>
						<option value="AU"<?php selected( $paypal_language, 'AU' ); ?>><?php _e( 'English (Australian)', 'vfbp-payments' ); ?></option>
						<option value="GB"<?php selected( $paypal_language, 'GB' ); ?>><?php _e( 'English (Great Britain)', 'vfbp-payments' ); ?></option>
						<option value="FR"<?php selected( $paypal_language, 'FR' ); ?>><?php _e( 'French', 'vfbp-payments' ); ?></option>
						<option value="DE"<?php selected( $paypal_language, 'DE' ); ?>><?php _e( 'German', 'vfbp-payments' ); ?></option>
						<option value="CH"<?php selected( $paypal_language, 'CH' ); ?>><?php _e( 'Swiss German', 'vfbp-payments' ); ?></option>
						<option value="IT"<?php selected( $paypal_language, 'IT' ); ?>><?php _e( 'Italian', 'vfbp-payments' ); ?></option>
						<option value="ES"<?php selected( $paypal_language, 'ES' ); ?>><?php _e( 'Spanish', 'vfbp-payments' ); ?></option>
						<option value="PT"<?php selected( $paypal_language, 'PT' ); ?>><?php _e( 'Portuguese', 'vfbp-payments' ); ?></option>
						<option value="CN"<?php selected( $paypal_language, 'CN' ); ?>><?php _e( 'Chinese', 'vfbp-payments' ); ?></option>
						<option value="NO"<?php selected( $paypal_language, 'NO' ); ?>><?php _e( 'Norwegian', 'vfbp-payments' ); ?></option>
						<option value="DK"<?php selected( $paypal_language, 'DK' ); ?>><?php _e( 'Danish', 'vfbp-payments' ); ?></option>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="paypal-currency"><?php _e( 'Currency' , 'vfbp-payments'); ?></label>
				</th>
				<td>
					<select name="settings[payments-paypal][currency]" id ="paypal-currency">
						<option value="USD"<?php selected( $paypal_currency, 'USD' ); ?>><?php _e( '&#36; - U.S. Dollar', 'vfbp-payments' ); ?></option>
						<option value="AUD"<?php selected( $paypal_currency, 'AUD' ); ?>><?php _e( 'A&#36; - Australian Dollar', 'vfbp-payments' ); ?></option>
						<option value="BRL"<?php selected( $paypal_currency, 'BRL' ); ?>><?php _e( 'R&#36; - Brazilian Real', 'vfbp-payments' ); ?></option>
						<option value="CAD"<?php selected( $paypal_currency, 'CAD' ); ?>><?php _e( 'C&#36; - Canadaian Dollar', 'vfbp-payments' ); ?></option>
						<option value="CZK"<?php selected( $paypal_currency, 'CZK' ); ?>><?php _e( '&#75;&#269; - Czech Koruna', 'vfbp-payments' ); ?></option>
						<option value="DKK"<?php selected( $paypal_currency, 'DKK' ); ?>><?php _e( '&#107;&#114; - Danish Krone', 'vfbp-payments' ); ?></option>
						<option value="EUR"<?php selected( $paypal_currency, 'EUR' ); ?>><?php _e( '&#8364; - Euro', 'vfbp-payments' ); ?></option>
						<option value="HKD"<?php selected( $paypal_currency, 'HKD' ); ?>><?php _e( 'HK&#36; - Hong Kong Dollar', 'vfbp-payments' ); ?></option>
						<option value="HUF"<?php selected( $paypal_currency, 'HUF' ); ?>><?php _e( '&#70;&#116; - Hungarian Forint', 'vfbp-payments' ); ?></option>
						<option value="ILS"<?php selected( $paypal_currency, 'ILS' ); ?>><?php _e( '&#8362; - Israeli New Sheqel', 'vfbp-payments' ); ?></option>
						<option value="JPY"<?php selected( $paypal_currency, 'JPY' ); ?>><?php _e( '&#165; - Japanese Yen', 'vfbp-payments' ); ?></option>
						<option value="MYR"<?php selected( $paypal_currency, 'MYR' ); ?>><?php _e( '&#82;&#77; - Malaysian Ringgit', 'vfbp-payments' ); ?></option>
						<option value="MXN"<?php selected( $paypal_currency, 'MXN' ); ?>><?php _e( '&#36; - Mexican Peso', 'vfbp-payments' ); ?></option>
						<option value="NOK"<?php selected( $paypal_currency, 'NOK' ); ?>><?php _e( '&#107;&#114; - Norwegian Krone', 'vfbp-payments' ); ?></option>
						<option value="NZD"<?php selected( $paypal_currency, 'NZD' ); ?>><?php _e( 'NZ&#36; - New Zealand Dollar', 'vfbp-payments' ); ?></option>
						<option value="PHP"<?php selected( $paypal_currency, 'PHP' ); ?>><?php _e( '&#80;&#104;&#11; - Philippine Peso', 'vfbp-payments' ); ?></option>
						<option value="PLN"<?php selected( $paypal_currency, 'PLN' ); ?>><?php _e( '&#122;&#322; - Polish Zloty', 'vfbp-payments' ); ?></option>
						<option value="GBP"<?php selected( $paypal_currency, 'GBP' ); ?>><?php _e( '&#163; - Pound Sterling', 'vfbp-payments' ); ?></option>
						<option value="RUB"<?php selected( $paypal_currency, 'RUB' ); ?>><?php _e( 'RUB - Russian Ruble', 'vfbp-payments' ); ?></option>
						<option value="SGD"<?php selected( $paypal_currency, 'SGD' ); ?>><?php _e( 'S&#36; - Singapore Dollar', 'vfbp-payments' ); ?></option>
						<option value="SEK"<?php selected( $paypal_currency, 'SEK' ); ?>><?php _e( '&#107;&#114; - Swedish Krona', 'vfbp-payments' ); ?></option>
						<option value="CHF"<?php selected( $paypal_currency, 'CHF' ); ?>><?php _e( '&#67;&#72;&#70; - Swiss Franc', 'vfbp-payments' ); ?></option>
						<option value="TWD"<?php selected( $paypal_currency, 'TWD' ); ?>><?php _e( 'NT&#36; - Taiwan New Dollar', 'vfbp-payments' ); ?></option>
						<option value="THB"<?php selected( $paypal_currency, 'THB' ); ?>><?php _e( '&#3647; - Thai Baht', 'vfbp-payments' ); ?></option>
						<option value="TRY"<?php selected( $paypal_currency, 'TRY' ); ?>><?php _e( '&#8378; - Turkish Lira', 'vfbp-payments' ); ?></option>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="paypal-shipping"><?php _e( 'Shipping Address' , 'vfbp-payments'); ?></label>
				</th>
				<td>
					<fieldset>
						<label>
							<input type="hidden" name="settings[payments-paypal][shipping]" value="0" /> <!-- This sends an unchecked value to the meta table -->
							<input type="checkbox" name="settings[payments-paypal][shipping]" id="paypal-shipping" value="1"<?php checked( $paypal_shipping, 1 ); ?> /> <?php _e( "Collect Shipping Address.", 'vfbp-payments' ); ?>
						</label>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="paypal-prepop-billing"><?php _e( 'Billing Info' , 'vfbp-payments'); ?></label>
				</th>
				<td>
					<fieldset>
						<label>
							<input type="hidden" name="settings[payments-paypal][prepop-billing]" value="0" /> <!-- This sends an unchecked value to the meta table -->
							<input type="checkbox" name="settings[payments-paypal][prepop-billing]" id="paypal-prepop-billing" value="1"<?php checked( $paypal_prepop_billing, 1 ); ?> /> <?php _e( "Pre-populate Billing Info.", 'vfbp-payments' ); ?>
						</label>
					</fieldset>
				</td>
			</tr>
			<tr valign="top" class="vfb-paypal-billing<?php echo 'paypal' == $merchant_type && !empty( $paypal_prepop_billing ) ? ' active' : ''; ?>">
				<th scope="row">
				</th>
				<td>
					<p>
						<label for="paypal-billing-name"><?php _e( 'Name Field' , 'vfbp-payments'); ?></label>

						<br />
						<select name="settings[payments-paypal][billing-name]" id ="paypal-billing-name">
							<option value=""<?php selected( '', $paypal_billing_name ); ?>></option>
							<?php
								if ( is_array( $name_fields ) && !empty( $name_fields ) ) {
									foreach ( $name_fields as $field ) {
										$label    = isset( $field['data']['label'] ) ? $field['data']['label'] : '';
										$field_id = $field['id'];

										printf( '<option value="%1$d"%3$s>%1$d - %2$s</option>', $field_id, $label, selected( $field_id, $paypal_billing_name, false ) );
									}
								}
								else {
									printf( '<option>(%s)</option>', __( 'No Name Field Found', 'vfbp-payments' ) );
								}
							?>
						</select>
					</p>

					<p>
						<label for="paypal-billing-address"><?php _e( 'Address Field' , 'vfbp-payments'); ?></label>

						<br />
						<select name="settings[payments-paypal][billing-address]" id ="paypal-billing-address">
							<option value=""<?php selected( '', $paypal_billing_addr ); ?>></option>
							<?php
								if ( is_array( $addr_fields ) && !empty( $addr_fields ) ) {
									foreach ( $addr_fields as $field ) {
										$label    = isset( $field['data']['label'] ) ? $field['data']['label'] : '';
										$field_id = $field['id'];

										printf( '<option value="%1$d"%3$s>%1$d - %2$s</option>', $field_id, $label, selected( $field_id, $paypal_billing_addr, false ) );
									}
								}
								else {
									printf( '<option>(%s)</option>', __( 'No Address Field Found', 'vfbp-payments' ) );
								}
							?>
						</select>
					</p>


					<p>
						<label for="paypal-billing-email"><?php _e( 'Email Field' , 'vfbp-payments'); ?></label>

						<br />
						<select name="settings[payments-paypal][billing-email]" id ="paypal-billing-email">
							<option value=""<?php selected( '', $paypal_billing_email ); ?>></option>
							<?php
								if ( is_array( $email_fields ) && !empty( $email_fields ) ) {
									foreach ( $email_fields as $field ) {
										$label    = isset( $field['data']['label'] ) ? $field['data']['label'] : '';
										$field_id = $field['id'];

										printf( '<option value="%1$d"%3$s>%1$d - %2$s</option>', $field_id, $label, selected( $field_id, $paypal_billing_email, false ) );
									}
								}
								else {
									printf( '<option>(%s)</option>', __( 'No Email Field Found', 'vfbp-payments' ) );
								}
							?>
						</select>
					</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="paypal-recurring"><?php _e( 'Recurring Billing' , 'vfbp-payments'); ?></label>
				</th>
				<td>
					<fieldset>
						<label>
							<input type="hidden" name="settings[payments-paypal][recurring]" value="0" /> <!-- This sends an unchecked value to the meta table -->
							<input type="checkbox" name="settings[payments-paypal][recurring]" id="paypal-recurring" value="1"<?php checked( $paypal_recurring, 1 ); ?> /> <?php _e( "Setup Recurring Billing.", 'vfbp-payments' ); ?>
						</label>
					</fieldset>
				</td>
			</tr>
			<tr valign="top" class="vfb-paypal-recurring<?php echo 'paypal' == $merchant_type && !empty( $paypal_recurring ) ? ' active' : ''; ?>">
				<th scope="row">
				</th>
				<td>
					<p>
						<?php _e( 'Request Payment Every' , 'vfbp-payments'); ?>

						<br />
						<select name="settings[payments-paypal][recurring-period]" id ="paypal-recurring-period">
							<option value="1"<?php selected( '1', $paypal_recurring_period ); ?>>1</option>
							<option value="2"<?php selected( '2', $paypal_recurring_period ); ?>>2</option>
							<option value="3"<?php selected( '3', $paypal_recurring_period ); ?>>3</option>
							<option value="4"<?php selected( '4', $paypal_recurring_period ); ?>>4</option>
							<option value="5"<?php selected( '5', $paypal_recurring_period ); ?>>5</option>
							<option value="6"<?php selected( '6', $paypal_recurring_period ); ?>>6</option>
							<option value="7"<?php selected( '7', $paypal_recurring_period ); ?>>7</option>
							<option value="8"<?php selected( '8', $paypal_recurring_period ); ?>>8</option>
							<option value="9"<?php selected( '9', $paypal_recurring_period ); ?>>9</option>
							<option value="10"<?php selected( '10', $paypal_recurring_period ); ?>>10</option>
						</select>
						<select name="settings[payments-paypal][recurring-type]" id ="paypal-recurring-type">
							<option value="D"<?php selected( 'D', $paypal_recurring_type ); ?>><?php _e( 'Day(s)', 'vfbp-payments' ); ?></option>
							<option value="W"<?php selected( 'W', $paypal_recurring_type ); ?>><?php _e( 'Week(s)', 'vfbp-payments' ); ?></option>
							<option value="M"<?php selected( 'M', $paypal_recurring_type ); ?>><?php _e( 'Month(s)', 'vfbp-payments' ); ?></option>
							<option value="Y"<?php selected( 'Y', $paypal_recurring_type ); ?>><?php _e( 'Year(s)', 'vfbp-payments' ); ?></option>
						</select>
					</p>

					<p>
						<label for="paypal-recurring-desc"><?php _e( 'Description', 'vfbp-payments' ); ?></label>

						<br />
						<input type="text" name="settings[payments-paypal][recurring-desc]" id="paypal-recurring-desc" value="<?php esc_html_e( $paypal_recurring_desc ); ?>" class="regular-text" maxlength="127" />
					</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="paypal-return-url"><?php _e( 'Return URL' , 'vfbp-payments'); ?></label>
				</th>
				<td>
					<input type="url" name="settings[payments-paypal][return-url]" id="paypal-return-url" value="<?php esc_html_e( $paypal_return_url ); ?>" class="regular-text" />
					<p class="description"><?php _e( "The URL to which PayPal redirects buyers' browser after they complete their payments. If empty, PayPal redirects the browser to a PayPal webpage.", 'vfbp-payments' ); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="paypal-cancel-url"><?php _e( 'Cancel Return URL' , 'vfbp-payments'); ?></label>
				</th>
				<td>
					<input type="url" name="settings[payments-paypal][cancel-url]" id="paypal-cancel-url" value="<?php esc_html_e( $paypal_cancel_url ); ?>" class="regular-text" />
					<p class="description"><?php _e( "A URL to which PayPal redirects the buyers' browsers if they cancel checkout before completing their payments. If empty, PayPal redirects the browser to a PayPal webpage.", 'vfbp-payments' ); ?></p>
				</td>
			</tr>
		</tbody>
		<tbody class="vfb-payments-settings<?php echo !empty( $payments_enable ) ? ' active' : ''; ?>">
			<tr valign="top">
				<th scope="row">
					<label for="payments-running-total"><?php _e( 'Show Running Total' , 'vfbp-payments'); ?></label>
				</th>
				<td>
					<fieldset>
						<label>
							<input type="hidden" name="settings[payments-running-total]" value="0" /> <!-- This sends an unchecked value to the meta table -->
							<input type="checkbox" name="settings[payments-running-total]" id="payments-running-total" value="1"<?php checked( $running_total, 1 ); ?> /> <?php _e( "Show price amounts and total costs as user fills out form.", 'vfbp-payments' ); ?>
						</label>
					</fieldset>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="base-price-name"><?php _e( 'Fixed Amount' , 'vfbp-payments'); ?></label>
				</th>
				<td>
					<input type="text" name="settings[payments-base-price-name]" id="base-price-name" value="<?php esc_html_e( $base_price_name ); ?>" class="regular-text" />
					$
					<input type="text" name="settings[payments-base-price]" id="base-price" value="<?php esc_html_e( $base_price ); ?>" class="medium-text" />
					<p class="description"><?php _e( 'This is the base amount charged to your users on every submission. Set this to 0 if you want to charge based on choices selected on your forms.', 'vfbp-payments' ); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="assign-prices"><?php _e( 'Assign Prices' , 'vfbp-payments'); ?></label>
				</th>
				<td>
					<input type="hidden" name="settings[payments-fields]" value="" /> <!-- Send an empty value if all fields deleted -->
					<?php
						$existing = array();

						if ( !empty( $price_fields ) ) {
							foreach ( $price_fields as $field_id => $prices ) {
								$this->price_fields_options( $field_id, $prices );
								$existing[] = $field_id;

								// Used in JS to determine if options exist, don't add to Assign Prices dropdown
								printf( '<input type="hidden" class="vfb-payment-field-ids" name="vfb-payment-field-ids[]" value="%d" />', $field_id );
							}
						}
					?>
					<h4 class="vfb-payment-assign-prices-header">
						<?php _e( 'Assign Prices to a Field' , 'vfb-pro-payments' ); ?>
					</h4>

					<select id="vfb-payment-fields" name="">
						<?php $this->price_fields( $form_id, $existing ); ?>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
	}

	/**
	 * price_fields function.
	 *
	 * @access public
	 * @param mixed $form_id
	 * @param array $existing (default: array())
	 * @return void
	 */
	public function price_fields( $form_id = 0, $existing = array() ) {
		$output = $where = '';


		if ( isset( $_POST['fields'] ) || !empty( $existing ) ) {
			$field    = isset( $_POST['fields'] ) ? $_POST['fields'] : $existing;
			$field_id = implode( ',', array_map( 'absint', $field ) );

			$where    = "AND id NOT IN($field_id)";
		}

		if ( isset( $_POST['form'] ) )
			$form_id = absint( $_POST['form'] );

		$vfbdb        = new VFB_Pro_Data();
		$price_fields = $vfbdb->get_fields( $form_id, "AND field_type IN('select','radio','checkbox','currency') $where ORDER BY field_order ASC" );

		foreach ( $price_fields as $field ) {
			$label    = isset( $field['data']['label'] ) ? $field['data']['label'] : '';
			$field_id = $field['id'];

			$output .= sprintf( '<option value="%1$d">%2$s</option>', $field_id, $label );
		}

		$output = '<option value="" selected="selected"></option>' . $output;

		echo $output;

		if ( defined('DOING_AJAX') && DOING_AJAX )
	      die(1);
	}

	/**
	 * price_fields_options function.
	 *
	 * @access public
	 * @param mixed $field_id
	 * @param array $values (default: array())
	 * @return void
	 */
	public function price_fields_options( $field_id = 0, $values = array() ) {
		if ( isset( $_POST['field'] ) )
			$field_id = absint( $_POST['field'] );

		$vfbdb = new VFB_Pro_Data();
		$field = $vfbdb->get_field_by_id( $field_id );

		$label   = isset( $field['data']['label'] ) ? $field['data']['label'] : '';
		$type    = $field['field_type'];
		$options = isset( $field['data']['options'] ) ? $field['data']['options'] : '';

		$delete_url = add_query_arg(
			array(
				'page'       => 'vfb-pro',
				'vfb-action' => 'delete-price-field',
				'field'      => $field_id,
			),
			wp_nonce_url( admin_url( 'admin.php' ), 'vfbp_delete_price_field' )
		);

		$output = '';
		$output .= '<div class="vfb-pricing-fields-container">';
		$output .= sprintf( '<h3>%2$s<a href="%1$s" class="vfb-payment-remove-field" title="%3$s"><span class="dashicons dashicons-no"></span></a></h3>', $delete_url, $label, __( 'Remove', 'vfbp-payments' ) );

		if ( 'currency' == $type ) {
			$output .= __( 'Amount Based on User Input', 'vfbp-payments' );

			// Field ID
			$output .= sprintf( '<input type="hidden" name="settings[payments-fields][%1$d][field-id]" value="%1$d" />', $field_id );
			// Type - has to be done after currenty field ID, otherwise it won't set
			$output .= sprintf( '<input type="hidden" name="settings[payments-fields][%d][type]" value="%s" />', $field_id, $type );
			// Label
			$output .= sprintf( '<input type="hidden" name="settings[payments-fields][%d][title]" value="%s" />', $field_id, $label );

			$output .= '</div>';

			echo $output;

			if ( defined('DOING_AJAX') && DOING_AJAX )
				die(1);

			return;
		}

		// Field ID
		$output .= sprintf( '<input type="hidden" name="settings[payments-fields][%1$d][field-id]" value="%1$d" />', $field_id );

		// Type
		$output .= sprintf( '<input type="hidden" name="settings[payments-fields][%d][type]" value="%s" />', $field_id, $type );

		$count = 0;

		if ( is_array( $options ) && !empty( $options ) ) {
			foreach( $options as $option ) {
				$label = $option['label'];
				$price = isset( $values[ $count ]['price'] ) ? $values[ $count ]['price'] : '0.00';

				$output .= sprintf(
					'<div class="vfb-payment-field-names"><label for="vfb-payment-field-%1$d">%2$s</label>' .
					'<input type="hidden" id="vfb-payment-field-%1$d" name="settings[payments-fields][%3$d][%1$d][choice]" value="%5$s" />' .
					'<input type="text" id="vfb-payment-field-%1$d" name="settings[payments-fields][%3$d][%1$d][price]" value="%4$s" /></div>',
					$count,
					$label,
					$field_id,
					$price,
					esc_attr( $label )
				);

				++$count;
			}
		}

		$output .= '</div>';

		echo $output;

		if ( defined('DOING_AJAX') && DOING_AJAX )
			die(1);
	}
}