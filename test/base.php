<?php
class CoinpaymentsBase extends PHPUnit_Framework_TestCase {
	public function setUp() {
		\WP_Mock::setUp();
		// Ensure that the settings are in a default state
		Coinpayments_Settings::set_settings( array() );
	}
	public function tearDown() {
		\WP_Mock::tearDown();
	}
}
