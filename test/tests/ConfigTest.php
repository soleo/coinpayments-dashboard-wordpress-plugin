<?php
class ConfigTest extends CoinpaymentsBase {
	public function test_constants_are_set() {
		$this->assertTrue( defined( 'COINPAYMENTS_API_ENDPOINT' ) );
		$this->assertTrue( defined( 'COINPAYMENTS_PUBLIC_KEY' ) );
		$this->assertTrue( defined( 'COINPAYMENTS_PRIVATE_KEY' ) );
	}
}
