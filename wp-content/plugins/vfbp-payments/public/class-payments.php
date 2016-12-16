<?php
/**
 * The main function for the add-on
 *
 * @since      2.0
 */
class VFB_Pro_Addon_Payments_Main {
	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		add_action( 'vfbp_after_email', array( $this, 'process_payments' ), 10, 2 );

		add_action( 'wp_enqueue_scripts', array( $this, 'css' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'js' ) );
	}

	/**
	 * Load public CSS files
	 *
	 * @access public
	 * @return void
	 */
	public function css() {
		$scripts = new VFB_Pro_Addon_Payments_Scripts_Loader();
		$scripts->add_css();
	}

	/**
	 * Load public JS files
	 *
	 * @access public
	 * @return void
	 */
	public function js() {
		$scripts = new VFB_Pro_Addon_Payments_Scripts_Loader();
		$scripts->add_js();
	}

	/**
	 * init function.
	 *
	 * @access public
	 * @return void
	 */
	public function init( $form_id ) {
		$vfbdb    = new VFB_Pro_Data();
		$settings = $vfbdb->get_addon_settings( $form_id );

		$payments_enable = isset( $settings['payments-enable']        ) ? $settings['payments-enable']        : '';
		$merchant_type   = isset( $settings['payments-merchant']      ) ? $settings['payments-merchant']      : '';
		$running_total   = isset( $settings['payments-running-total'] ) ? $settings['payments-running-total'] : '';
		$price_fields    = isset( $settings['payments-fields']        ) ? $settings['payments-fields']        : '';

		if ( empty( $payments_enable ) || 0 == $payments_enable )
			return;

		// Prices
		$base_price_name = isset( $settings['payments-base-price-name'] ) ? $settings['payments-base-price-name'] : __( 'Base Price', 'vfbp-payments' );
		$base_price      = isset( $settings['payments-base-price']      ) ? $settings['payments-base-price']      : '0.00';

		$currency_code = $this->currency_code( $form_id, $settings );

		$json = array(
			'running-total'   => $running_total,
			'base-price-name' => $base_price_name,
			'base-price'      => $base_price,
			'currency'        => $currency_code,
			'decimals'        => 2,
			'total-text'      => __( 'Total', 'vfbp-payments' ),
			'price-fields'    => $price_fields,
		);

		$json = json_encode( $json );

		wp_enqueue_script( 'vfbp-payments' );
		wp_localize_script( 'vfbp-js', 'vfbp_prices', array( 'prices' => $json ) );
	}

	/**
	 * Return the currency code to be used in the running total.
	 *
	 * @access public
	 * @param mixed $form_id
	 * @param mixed $settings
	 * @return void
	 */
	public function currency_code( $form_id, $settings ) {
		$payments_enable = isset( $settings['payments-enable']   ) ? $settings['payments-enable']   : '';
		$merchant_type   = isset( $settings['payments-merchant'] ) ? $settings['payments-merchant'] : '';

		if ( empty( $payments_enable ) || 0 == $payments_enable )
			return;

		if ( empty( $merchant_type ) )
			return;

		$codes = array(
			'USD' => '&#36;', 				// U.S. Dollar
			'AUD' => 'A&#36;', 				// Australian Dollar
			'BRL' => 'R&#36;', 				// Brazilian Real
			'CAD' => 'C&#36;', 				// Canadaian Dollar
			'CZK' => '&#75;&#269;', 		// Czech Koruna
			'DKK' => '&#107;&#114;', 		// Danish Krone
			'EUR' => '&#8364;', 			// Euro
			'HKD' => 'HK&#36;', 			// Hong Kong Dollar
			'HUF' => '&#70;&#116;', 		// Hungarian Forint
			'ILS' => '&#8362;', 			// Israeli New Sheqel
			'JPY' => '&#165;', 				// Japanese Yen
			'MYR' => '&#82;&#77;', 			// Malaysian Ringgit
			'MXN' => '&#36;', 				// Mexican Peso
			'NOK' => '&#107;&#114;', 		// Norwegian Krone
			'NZD' => 'NZ&#36;', 			// New Zealand Dollar
			'PHP' => '&#80;&#104;&#11;',	// Philippine Peso
			'PLN' => '&#122;&#322;', 		// Polish Zloty
			'GBP' => '&#163;', 				// Pound Sterling
			'RUB' => 'RUB', 				// Russian Ruble
			'SGD' => 'S&#36;', 				// Singapore Dollar
			'SEK' => '&#107;&#114;', 		// Swedish Krona
			'CHF' => '&#67;&#72;&#70;', 	// Swiss Franc
			'TWD' => 'NT&#36;', 			// Taiwan New Dollar
			'THB' => '&#3647;', 			// Thai Baht
			'TRY' => '&#8378;', 			// Turkish Lira
		);

		switch ( $merchant_type ) {
			case 'paypal' :
				$currency = isset( $settings['payments-paypal']['currency'] ) ? $settings['payments-paypal']['currency'] : 'USD';

				return $codes[ $currency ];

				break;
		}
	}

	/**
	 * running_total function.
	 *
	 * @access public
	 * @return void
	 */
	public function running_total( $form_id ) {
		$vfbdb    = new VFB_Pro_Data();
		$settings = $vfbdb->get_addon_settings( $form_id );

		$payments_enable = isset( $settings['payments-enable']        ) ? $settings['payments-enable']        : '';
		$running_total   = isset( $settings['payments-running-total'] ) ? $settings['payments-running-total'] : '';

		if ( empty( $payments_enable ) || 0 == $payments_enable )
			return;

		if ( empty( $running_total ) || 0 == $running_total )
			return;

		return '<div id="vfbp-running-total-box"><div id="vfbp-running-total"></div></div>';
	}

	/**
	 * process_payments function.
	 *
	 * @access public
	 * @param mixed $entry_id
	 * @param mixed $form_id
	 * @return void
	 */
	public function process_payments( $entry_id, $form_id ) {
		$vfbdb    = new VFB_Pro_Data();
		$settings = $vfbdb->get_addon_settings( $form_id );

		$payments_enable = isset( $settings['payments-enable']   ) ? $settings['payments-enable']   : '';
		$merchant_type   = isset( $settings['payments-merchant'] ) ? $settings['payments-merchant'] : '';

		if ( empty( $payments_enable ) || 0 == $payments_enable )
			return;

		if ( empty( $merchant_type ) )
			return;

		switch ( $merchant_type ) {
			case 'paypal' :
				$this->process_paypal( $entry_id, $form_id, $settings );
				break;
		}
	}

	/**
	 * process_paypal function.
	 *
	 * @access public
	 * @param mixed $entry_id
	 * @param mixed $form_id
	 * @param mixed $settings
	 * @return void
	 */
	public function process_paypal( $entry_id, $form_id, $settings ) {
		$vfbdb = new VFB_Pro_Data();

		// PayPal
		$email             = isset( $settings['payments-paypal']['email']            ) ? $settings['payments-paypal']['email']            : '';
		$language          = isset( $settings['payments-paypal']['language']         ) ? $settings['payments-paypal']['language']         : '';
		$currency          = isset( $settings['payments-paypal']['currency']         ) ? $settings['payments-paypal']['currency']         : '';
		$shipping          = isset( $settings['payments-paypal']['shipping']         ) ? $settings['payments-paypal']['shipping']         : 1;
		$prepop_billing    = isset( $settings['payments-paypal']['prepop-billing']   ) ? $settings['payments-paypal']['prepop-billing']   : '';
		$billing_name      = isset( $settings['payments-paypal']['billing-name']     ) ? $settings['payments-paypal']['billing-name']     : '';
		$billing_addr      = isset( $settings['payments-paypal']['billing-address']  ) ? $settings['payments-paypal']['billing-address']  : '';
		$billing_email     = isset( $settings['payments-paypal']['billing-email']    ) ? $settings['payments-paypal']['billing-email']    : '';
		$recurring         = isset( $settings['payments-paypal']['recurring']        ) ? $settings['payments-paypal']['recurring']        : '';
		$recurring_period  = isset( $settings['payments-paypal']['recurring-period'] ) ? $settings['payments-paypal']['recurring-period'] : 1;
		$recurring_type    = isset( $settings['payments-paypal']['recurring-type']   ) ? $settings['payments-paypal']['recurring-type']   : 'D';
		$recurring_desc    = isset( $settings['payments-paypal']['recurring-desc']   ) ? $settings['payments-paypal']['recurring-desc']   : '';
		$return_url        = isset( $settings['payments-paypal']['return-url']       ) ? $settings['payments-paypal']['return-url']       : '';
		$cancel_url        = isset( $settings['payments-paypal']['cancel-url']       ) ? $settings['payments-paypal']['cancel-url']       : '';

		// Prices
		$base_price_name = isset( $settings['payments-base-price-name'] ) ? $settings['payments-base-price-name'] : __( 'Base Price', 'vfbp-payments' );
		$base_price      = isset( $settings['payments-base-price']      ) ? $settings['payments-base-price']      : 0;
		$price_fields    = isset( $settings['payments-fields']          ) ? $settings['payments-fields']          : '';

		$paypal_url   = 'https://www.paypal.com/cgi-bin/webscr';
		$paypal_cmd   = '_cart';
		$total        = 0;
		$items        = 1;
		$query_string = '';

		$data = array(
			'cmd'            => $paypal_cmd,
			'business'       => $email,
			'currency_code'  => $currency,
			'lc'             => $language,
			'no_shipping'	 => $shipping,
			'upload'         => 1,
		);

		// Base Price
		if ( !empty( $base_price ) && $base_price > 0 ) {
			$data['item_name_1'] = $base_price_name;
			$data['amount_1']    = $base_price;

			$total += $base_price;
			$items++;
		}

		// Price Fields
		if ( !empty( $price_fields ) ) {
			foreach ( $price_fields as $field_id => $prices ) {
				$field   = $vfbdb->get_field_by_id( $field_id );
				$type    = $field['field_type'];
				$options = isset( $field['data']['options'] ) ? $field['data']['options'] : '';

				if ( 'currency' == $type ) {
					$label = isset( $field['data']['label'] ) ? $field['data']['label'] : '';

					if ( isset( $_POST[ 'vfb-field-' . $field_id ] ) ) {
						$price = !empty( $_POST[ 'vfb-field-' . $field_id ] ) ? $_POST[ 'vfb-field-' . $field_id ] : 0;

						$data[ "amount_$items" ]    = $price;
						$data[ "item_name_$items" ] = $label;

						$total += $price;

						$items++;
					}
				}
				elseif ( 'radio' == $type || 'select' == $type ) {
					$count = 0;
					if ( is_array( $options ) && !empty( $options ) ) {
						foreach( $options as $option ) {
							$label = $option['label'];
							$price = isset( $prices[ $count ]['price'] ) ? $prices[ $count ]['price'] : 0;

							if ( isset( $_POST[ 'vfb-field-' . $field_id ] ) && $label == $_POST[ 'vfb-field-' . $field_id ] ) {
								if ( empty( $label ) )
									$label = isset( $field['data']['label'] ) ? $field['data']['label'] : __( '(no item name)', 'vfb-pro' );

								$data[ "amount_$items" ]    = $price;
								$data[ "item_name_$items" ] = $label;

								$total += $price;

								$items++;
							}

							++$count;
						}
					}
				}
				elseif ( 'checkbox' == $type ) {
					$count = 0;
					if ( is_array( $options ) && !empty( $options ) ) {
						foreach( $options as $option ) {
							$label = $option['label'];
							$price = isset( $prices[ $count ]['price'] ) ? $prices[ $count ]['price'] : 0;

							if ( isset( $_POST[ 'vfb-field-' . $field_id ][ $count ] ) ) {
								$data[ "amount_$items" ]    = $price;
								$data[ "item_name_$items" ] = $label;

								$total += $price;
								$items++;
							}

							++$count;
						}
					}
				}
			}
		}

		// Recurring Payments
		if ( !empty( $recurring ) ) {
			$data['a3']  = $total;
			$data['p3']  = $recurring_period;
			$data['t3']  = $recurring_type;
			$data['src'] = 1;

			if ( !empty( $recurring_desc ) )
				$data['item_name'] = $recurring_desc;
		}

		// Billing
		if ( !empty( $prepop_billing ) ) {
			$name     = 'vfb-field-' . $billing_name;
			$address  = 'vfb-field-' . $billing_addr;
			$email    = 'vfb-field-' . $billing_email;

			$name_field  = isset( $_POST[ $name ]    ) ? $_POST[ $name ]    : '';
			$addr_field  = isset( $_POST[ $address ] ) ? $_POST[ $address ] : '';
			$email_field = isset( $_POST[ $email ]   ) ? $_POST[ $email ]   : '';

			// Name
			if ( is_array( $name_field ) ) {
				$data['first_name']  = $name_field['first'];
				$data['last_name']   = $name_field['last'];
			}

			// Email
			$data['email']       = sanitize_email( $email );

			// Address
			if ( is_array( $addr_field ) ) {
				$data['address1']    = $addr_field['address-1'];
				$data['address2']    = $addr_field['address-2'];
				$data['city']        = $addr_field['city'];
				$data['state']       = $addr_field['province'];
				$data['zip']         = $addr_field['zip'];
				$data['country']     = $addr_field['country'];
			}

			$data['address_override'] = 1;
		}

		// Return URL
		if ( !empty( $return_url ) )
			$data['return'] = $return_url;

		// Cancel URL
		if ( !empty( $cancel_url ) )
			$data['cancel_return'] = $cancel_url;

		// Build query string for PayPal URL
		foreach ( array_keys( $data ) as $k ) {
			$query_string .= $k . '=' . urlencode( $data[ $k ] ) . '&';
		}

		wp_redirect( "$paypal_url?$query_string" );
		exit();
	}
}