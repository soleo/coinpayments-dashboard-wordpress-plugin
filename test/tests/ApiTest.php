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

	public function test_get_balance() {
		$options = $this->get_default_options();
		$url = $options['api_endpoint'];
		$body = 'version=1&cmd=balances&key='.$options['coinpayments_public_key'].'&format=json';
		$hmac = hash_hmac( 'sha512', $body, $options['coinpayments_private_key'] );

		$expected_result = MockData::get_balances_response_200();
		// Mock the remote POST.
		\WP_Mock::wpFunction( 'wp_remote_post', array(
			'args' => array(
				$url,
				array(
					'user-agent' => 'curl',
					'sslverify' => false,
					'method' => 'POST',
					'body' => $body,
					'headers' => array(
						'HMAC' => $hmac
					)
				)
			),
			'times'  => 1,
			'return' => MockData::get_balances_response_200(),
		) );

		\WP_Mock::wpFunction( 'is_wp_error', array(
			'args'   => array( $expected_result ),
			'times'  => 1,
			'return' => false,
		) );
		\WP_Mock::wpFunction( 'wp_remote_retrieve_body', array(
			'args'   => array( $expected_result ),
			'times'  => 1,
			'return' => $expected_result['body'],
		) );
		$api_object = Coinpayments_API::instance();
		$api_object->set_options($options);
		$current_balance = $api_object->get_balance();
		$this->assertTrue(isset($current_balance['BTC']));
	}

	public function test_get_rates() {
		$options = $this->get_default_options();
		$url = $options['api_endpoint'];
		$body = 'version=1&cmd=rates&key='.$options['coinpayments_public_key'].'&format=json';
		$hmac = hash_hmac( 'sha512', $body, $options['coinpayments_private_key'] );

		$expected_result = MockData::get_rates_response_200();
		// Mock the remote POST.
		\WP_Mock::wpFunction( 'wp_remote_post', array(
			'args' => array(
				$url,
				array(
					'user-agent' => 'curl',
					'sslverify' => false,
					'method' => 'POST',
					'body' => $body,
					'headers' => array(
						'HMAC' => $hmac
					)
				)
			),
			'times'  => 1,
			'return' => MockData::get_rates_response_200(),
		) );

		\WP_Mock::wpFunction( 'is_wp_error', array(
			'args'   => array( $expected_result ),
			'times'  => 1,
			'return' => false,
		) );
		\WP_Mock::wpFunction( 'wp_remote_retrieve_body', array(
			'args'   => array( $expected_result ),
			'times'  => 1,
			'return' => $expected_result['body'],
		) );

		$api_object = Coinpayments_API::instance();
		$api_object->set_options($options);
		$current_rates = $api_object->get_rates();
		$this->assertTrue(isset($current_rates['BTC']));
		$this->assertEquals($current_rates['BTC']['rate_btc'], '1.000000000000000000000000');
	}

	public function test_when_api_requests_failed() {
		\WP_Mock::wpFunction( 'wp_remote_post', array(
			'args' => array(
				\WP_Mock\Functions::type( 'string' ),
				\WP_Mock\Functions::type( 'array' ),
			),
			'times'  => 2,
			'return' => '',
		) );

		\WP_Mock::wpFunction( 'is_wp_error', array(
			'args'   => '*',
			'times'  => 2,
			'return' => true,
		) );
		\WP_Mock::wpFunction( 'wp_remote_retrieve_body', array(
			'args'   => '*',
			'times'  => 2,
			'return' => '',
		) );

		$api_object = Coinpayments_API::instance();
		$options = $this->get_default_options();
		$api_object->set_options($options);

		$current_rates = $api_object->get_rates();
		$this->assertEquals($current_rates, array());

		$current_balance = $api_object->get_balance();
		$this->assertEquals($current_balance, array());
	}

	public function test_when_api_json_reponse_is_malformed() {
		\WP_Mock::wpFunction( 'wp_remote_post', array(
			'args' => array(
				\WP_Mock\Functions::type( 'string' ),
				\WP_Mock\Functions::type( 'array' ),
			),
			'times'  => 1,
			'return' => '',
		) );

		\WP_Mock::wpFunction( 'is_wp_error', array(
			'args'   => '*',
			'times'  => 1,
			'return' => false,
		) );

		\WP_Mock::wpFunction( 'wp_remote_retrieve_body', array(
			'args'   => '*',
			'times'  => 1,
			'return' => '{',
		) );

		$api_object = Coinpayments_API::instance();
		$options = $this->get_default_options();
		$api_object->set_options($options);

		$command_response = $api_object->make_api_call('some-valid-command');
		$this->assertEquals($command_response['error'], 'Unable to parse JSON result (Syntax error)');
	}

	private function get_default_options() {
		return array(
			'coinpayments_public_key'       => uniqid(),
			'coinpayments_private_key'      => uniqid(),
			'api_endpoint'                  => 'https://www.coinpayments.net/api.php',
		);
	}
}
