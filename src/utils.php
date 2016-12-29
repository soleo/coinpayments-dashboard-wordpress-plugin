<?php

/**
 * Sanitize a CoinPayments API Key.
 *
 * Restricts a value to only a-z, A-Z, and 0-9.
 *
 * @param  string $key Unsantizied key.
 * @return string      Sanitized key.
 */
function coinpayments_sanitize_key( $key ) {
	return preg_replace( '/[^a-zA-Z0-9]/', '', $key );
}
