<?php

class SettingsTest extends CoinpaymentsBase {
	public function setUp() {
		parent::setUp();
		\WP_Mock::setUp();
		\WP_Mock::wpPassthruFunction( 'esc_url' );
	}

	public function tearDown() {
		\WP_Mock::tearDown();
	}

	public function test_get_settings_returns_correct_object() {
		$settings = Coinpayments_Settings::get_registered_settings();
		$this->assertTrue( is_array( $settings ) );

		foreach ( $settings as $key => $setting ) {
			$this->assertTrue( is_string( $key ) );
			$this->assertTrue( isset( $setting['sanitize_callback'] ) );
			$this->assertTrue( isset( $setting['default'] ) );
		}
	}

	public function test_database_value_is_preferred() {

		\WP_Mock::wpFunction( 'get_option', array(
			'args'   => array(
				'coinpayments-settings',
				array()
			),
			'times'  => 1,
			'return' => array_merge( $this->get_defaults_in_option_form(), array(
				'coinpayments_public_key' => 'test' // Override the "coinpayments_public_key" value
			) )
		) );

		$settings = Coinpayments_Settings::get_settings();
		$this->assertEquals( 'test', $settings['coinpayments_public_key'] );
	}

	public function test_constants_are_used_when_database_options_are_empty() {
		\WP_Mock::wpFunction( 'get_option', array(
			'args'   => array(
				'coinpayments-settings',
				array()
			),
			'times'  => 1,
			'return' => array()
		) );

		$settings = Coinpayments_Settings::get_settings();
		$this->assertEquals( COINPAYMENTS_PUBLIC_KEY, $settings['coinpayments_public_key'] );
	}

	public function test_database_value_is_preferred_when_getting_individual_setting() {
		\WP_Mock::wpFunction( 'get_option', array(
			'args'   => array(
				'coinpayments-settings',
				array()
			),
			'times'  => 1,
			'return' => array_merge( $this->get_defaults_in_option_form(), array(
				'coinpayments_public_key' => 'test' // Override the "coinpayments_public_key" value
			) )
		) );

		$coinpayments_public_key = Coinpayments_Settings::get_setting( 'coinpayments_public_key' );
		$this->assertEquals( 'test', $coinpayments_public_key );
	}

	public function test_constants_are_used_when_database_options_are_empty_when_getting_individual_setting() {
		\WP_Mock::wpFunction( 'get_option', array(
			'args'   => array(
				'coinpayments-settings',
				array()
			),
			'times'  => 1,
			'return' => array()
		) );

		$coinpayments_public_key = Coinpayments_Settings::get_setting( 'coinpayments_public_key' );
		$this->assertEquals( COINPAYMENTS_PUBLIC_KEY, $coinpayments_public_key );
	}

	private function get_defaults_in_option_form() {
		return array(
			'coinpayments_public_key'       => '',
			'coinpayments_private_key'      => '',
			'api_endpoint'                  => 'https://www.coinpayments.net/api.php',
		);
	}
}
