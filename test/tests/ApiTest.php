<?php

class ApiTest extends CoinpaymentsBase {
	public function setUp() {
		parent::setUp();
		\WP_Mock::setUp();
	}

	public function tearDown() {
		\WP_Mock::tearDown();
	}

	public function test_if_options_can_be_configured() {
		$api_object = Coinpayments_API::instance();
		$options = $this->get_default_options();
		$api_object->set_options($options);
		$this->assertEquals($api_object->get_options(), $options);
	}

	private function get_default_options() {
		return array(
			'coinpayments_public_key'       => '1234567890',
			'coinpayments_private_key'      => '0987654321',
			'api_endpoint'                  => 'https://www.coinpayments.net/api.php',
		);
	}
}
