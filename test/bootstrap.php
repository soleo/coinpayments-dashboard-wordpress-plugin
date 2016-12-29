<?php
if ( ! defined( 'COINPAYMENTS_API_ENDPOINT' ) ) {
	define( 'COINPAYMENTS_API_ENDPOINT', 'https://example.org' );
}
if ( ! defined( 'COINPAYMENTS_PUBLIC_KEY' ) ) {
	define( 'COINPAYMENTS_PUBLIC_KEY', 'aaabbbccc111222333' );
}
if ( ! defined( 'COINPAYMENTS_PRIVATE_KEY' ) ) {
	define( 'COINPAYMENTS_PRIVATE_KEY', '000999888zzzxxxyyy' );
}
include __DIR__ . '/../src/config.php';
include __DIR__ . '/../src/utils.php';
include __DIR__ . '/../src/classes/settings.php';
include __DIR__ . '/../src/classes/api.php';

// Bring in the base class
include __DIR__ . '/base.php';
