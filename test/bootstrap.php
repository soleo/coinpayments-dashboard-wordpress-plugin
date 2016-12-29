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
class MockData {
	static public function get_balances_response_200() {
		return array(
			'headers'  =>
				array(
					'content-type'   => 'application/json',
					'content-length' => '50',
					'accept-ranges'  => 'bytes',
					'date'           => 'Sun, 11 Oct 2015 22:54:09 GMT',
					'x-varnish'      => '320223782',
					'via'            => '1.1 varnish',
					'connection'     => 'close',
				),
			'body'     => '{
    "error": "ok",
    "result": {
        "BTC": {
            "balance": "10000000",
            "balancef": "1.0000000",
            "status": "available",
            "coin_status": "online"
        },
        "DASH": {
            "balance": "11000000",
            "balancef": "1.1000000",
            "status": "available",
            "coin_status": "online"
        }
    }
}',
			'response' =>
				array(
					'code'    => 200,
					'message' => 'OK',
				),
			'cookies'  =>
				array(),
			'filename' => null,
		);
	}

	static public function get_rates_response_200() {
		return array(
			'headers'  =>
				array(
					'content-type'   => 'application/json',
					'content-length' => '50',
					'accept-ranges'  => 'bytes',
					'date'           => 'Sun, 11 Oct 2015 22:54:09 GMT',
					'x-varnish'      => '320223782',
					'via'            => '1.1 varnish',
					'connection'     => 'close',
				),
			'body'     => '{
    "error": "ok",
    "result": {
        "BTC": {
            "is_fiat": 0,
            "rate_btc": "1.000000000000000000000000",
            "last_update": "1375473661",
            "tx_fee": "0.00010000",
            "status": "online",
            "name": "Bitcoin",
            "confirms": "2",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "transfers",
                "convert"
            ]
        },
        "LTC": {
            "is_fiat": 0,
            "rate_btc": "0.004673468888888900000000",
            "last_update": "1483042261",
            "tx_fee": "0.00100000",
            "status": "online",
            "name": "Litecoin",
            "confirms": "3",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "transfers",
                "convert"
            ]
        },
        "USD": {
            "is_fiat": 1,
            "rate_btc": "0.001047475853672300000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "United States Dollar",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "CAD": {
            "is_fiat": 1,
            "rate_btc": "0.000773291812430620000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "Canadian Dollar",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "EUR": {
            "is_fiat": 1,
            "rate_btc": "0.001089524153109300000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "Euro",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "XRP": {
            "is_fiat": 0,
            "rate_btc": "0.000006800000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00001000",
            "status": "online",
            "name": "Ripple",
            "confirms": "30",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "transfers",
                "dest_tag",
                "convert"
            ]
        },
        "ADCN": {
            "is_fiat": 0,
            "rate_btc": "0.000069303333333333000000",
            "last_update": "1483042261",
            "tx_fee": "0.00100000",
            "status": "online",
            "name": "Asiadigicoin",
            "confirms": "5",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "ADZ": {
            "is_fiat": 0,
            "rate_btc": "0.000015040000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00001000",
            "status": "online",
            "name": "AdzCoin",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "AUD": {
            "is_fiat": 1,
            "rate_btc": "0.000739685514514230000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "Australian Dollar",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "BITB": {
            "is_fiat": 0,
            "rate_btc": "0.000000026666666666667000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "BitBean",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "BLK": {
            "is_fiat": 0,
            "rate_btc": "0.000029760000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00010000",
            "status": "online",
            "name": "BlackCoin",
            "confirms": "6",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "transfers",
                "convert"
            ]
        },
        "BRK": {
            "is_fiat": 0,
            "rate_btc": "0.000018466666666667000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Breakout",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "BRL": {
            "is_fiat": 1,
            "rate_btc": "0.000288240478943790000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "Brazilian Real",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "BTC.Bitstamp": {
            "is_fiat": 0,
            "rate_btc": "1.000000000000000000000000",
            "last_update": "1418877661",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "Bitcoin",
            "confirms": "30",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers",
                "dest_tag"
            ]
        },
        "BTC.SnapSwap": {
            "is_fiat": 0,
            "rate_btc": "1.000000000000000000000000",
            "last_update": "1375473661",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "Bitcoin",
            "confirms": "30",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers",
                "dest_tag"
            ]
        },
        "CAD.RippleUnion": {
            "is_fiat": 0,
            "rate_btc": "0.000773291812430620000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "Canadian Dollar",
            "confirms": "30",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers",
                "dest_tag"
            ]
        },
        "CHF": {
            "is_fiat": 1,
            "rate_btc": "0.001020488978648700000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Swiss Franc",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "CLOAK": {
            "is_fiat": 0,
            "rate_btc": "0.000176156666666670000000",
            "last_update": "1483042261",
            "tx_fee": "0.00010000",
            "status": "online",
            "name": "CloakCoin",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "CNY": {
            "is_fiat": 1,
            "rate_btc": "0.000146762147555630000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Chinese Yuan",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "COP": {
            "is_fiat": 1,
            "rate_btc": "0.000000348841849122430000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Columbian Peso",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "CRBIT": {
            "is_fiat": 0,
            "rate_btc": "0.000001030000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00001000",
            "status": "online",
            "name": "Creditbit",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "CURE": {
            "is_fiat": 0,
            "rate_btc": "0.000041706200000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00010000",
            "status": "online",
            "name": "CureCoin",
            "confirms": "4",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "CZK": {
            "is_fiat": 1,
            "rate_btc": "0.000040544987875270000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "Czech Koruna",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "DASH": {
            "is_fiat": 0,
            "rate_btc": "0.011794678400000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00100000",
            "status": "online",
            "name": "Dash",
            "confirms": "3",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "transfers",
                "convert"
            ]
        },
        "DGC": {
            "is_fiat": 0,
            "rate_btc": "0.000006577142857142900000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "DigitalCoin",
            "confirms": "6",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "DNET": {
            "is_fiat": 0,
            "rate_btc": "0.000007946666666666700000",
            "last_update": "1483042261",
            "tx_fee": "0.00010000",
            "status": "online",
            "name": "Darknet",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "DOGE": {
            "is_fiat": 0,
            "rate_btc": "0.000000240000000000000000",
            "last_update": "1483042261",
            "tx_fee": "1.00000000",
            "status": "online",
            "name": "Dogecoin",
            "confirms": "3",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "transfers",
                "convert"
            ]
        },
        "ETC": {
            "is_fiat": 0,
            "rate_btc": "0.001496500000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00063000",
            "status": "online",
            "name": "Ether Classic",
            "confirms": "5",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "convert"
            ]
        },
        "ETH": {
            "is_fiat": 0,
            "rate_btc": "0.008728356666666700000000",
            "last_update": "1483042261",
            "tx_fee": "0.00063000",
            "status": "online",
            "name": "Ether",
            "confirms": "5",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "convert"
            ]
        },
        "EUR.Bitstamp": {
            "is_fiat": 0,
            "rate_btc": "0.001089524153109300000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "Euro",
            "confirms": "30",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers",
                "dest_tag"
            ]
        },
        "EXP": {
            "is_fiat": 0,
            "rate_btc": "0.000194925000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00063000",
            "status": "online",
            "name": "Expanse",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet"
            ]
        },
        "FTC": {
            "is_fiat": 0,
            "rate_btc": "0.000006386666666666700000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Feathercoin",
            "confirms": "3",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "GAME": {
            "is_fiat": 0,
            "rate_btc": "0.000214250285714290000000",
            "last_update": "1483042261",
            "tx_fee": "0.00010000",
            "status": "online",
            "name": "GameCredits",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "GBP": {
            "is_fiat": 1,
            "rate_btc": "0.001268225083259900000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "British Pound",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "GBP.Bitstamp": {
            "is_fiat": 0,
            "rate_btc": "0.001268225083259900000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "British Pound",
            "confirms": "30",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers",
                "dest_tag"
            ]
        },
        "GCR": {
            "is_fiat": 0,
            "rate_btc": "0.000036706666666667000000",
            "last_update": "1483042261",
            "tx_fee": "0.00010000",
            "status": "online",
            "name": "GCRCoin",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "HKD": {
            "is_fiat": 1,
            "rate_btc": "0.000134740669477150000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Hong Kong Dollar",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "IDR": {
            "is_fiat": 1,
            "rate_btc": "0.000000077072013139951000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Indonesian Rupiah",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "INR": {
            "is_fiat": 1,
            "rate_btc": "0.000015505243662541000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Indian Rupee",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "ISK": {
            "is_fiat": 1,
            "rate_btc": "0.000009179832931750200000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Icelandic Krona",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "JPY": {
            "is_fiat": 1,
            "rate_btc": "0.000008696777498254000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Japanese Yen",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "KRW": {
            "is_fiat": 1,
            "rate_btc": "0.000000847087173408510000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "South Korean Won",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "LAK": {
            "is_fiat": 1,
            "rate_btc": "0.000000127664541422830000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Laotian Kip",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "LEO": {
            "is_fiat": 0,
            "rate_btc": "0.000451296666666670000000",
            "last_update": "1483042261",
            "tx_fee": "0.00100000",
            "status": "online",
            "name": "LeoCoin",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "LSK": {
            "is_fiat": 0,
            "rate_btc": "0.000153065000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.10000000",
            "status": "maintenance",
            "name": "LISK",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet"
            ]
        },
        "MAID": {
            "is_fiat": 0,
            "rate_btc": "0.000111620000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "MaidSafeCoin",
            "confirms": "2",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "convert"
            ]
        },
        "MAX": {
            "is_fiat": 0,
            "rate_btc": "0.000001795000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00010000",
            "status": "online",
            "name": "Maxcoin",
            "confirms": "7",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "MINT": {
            "is_fiat": 0,
            "rate_btc": "0.000000095000000000000000",
            "last_update": "1473124261",
            "tx_fee": "0.00100000",
            "status": "maintenance",
            "name": "MintCoin",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "MUE": {
            "is_fiat": 0,
            "rate_btc": "0.000000904285714285710000",
            "last_update": "1483042261",
            "tx_fee": "0.00100000",
            "status": "online",
            "name": "MonetaryUnit",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "MXN": {
            "is_fiat": 1,
            "rate_btc": "0.000047602104399139000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Mexican Peso",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "MYR": {
            "is_fiat": 0,
            "rate_btc": "0.000000170000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00001000",
            "status": "online",
            "name": "MyriadCoin",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "NAV": {
            "is_fiat": 0,
            "rate_btc": "0.000040115000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00010000",
            "status": "online",
            "name": "NAV Coin",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "NBT": {
            "is_fiat": 0,
            "rate_btc": "0.001043288666666700000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "NuBits",
            "confirms": "10",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "transfers",
                "convert"
            ]
        },
        "NMC": {
            "is_fiat": 0,
            "rate_btc": "0.000242780000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Namecoin",
            "confirms": "3",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "transfers",
                "convert"
            ]
        },
        "NVC": {
            "is_fiat": 0,
            "rate_btc": "0.000483333333333330000000",
            "last_update": "1483042261",
            "tx_fee": "0.02000000",
            "status": "online",
            "name": "Novacoin",
            "confirms": "3",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "transfers",
                "convert"
            ]
        },
        "NXT": {
            "is_fiat": 0,
            "rate_btc": "0.000006239714285714300000",
            "last_update": "1483042261",
            "tx_fee": "1.00000000",
            "status": "online",
            "name": "NXT",
            "confirms": "30",
            "can_convert": 0,
            "capabilities": [
                "wallet"
            ]
        },
        "NZD": {
            "is_fiat": 1,
            "rate_btc": "0.000741164615258760000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "New Zealand Dollar",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "OMNI": {
            "is_fiat": 0,
            "rate_btc": "0.003012270000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "Omni",
            "confirms": "2",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "convert"
            ]
        },
        "PEN": {
            "is_fiat": 1,
            "rate_btc": "0.000311273787363310000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "Peruvian Sol",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "PHP": {
            "is_fiat": 1,
            "rate_btc": "0.000021082357268234000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Philippines Peso",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "PKR": {
            "is_fiat": 1,
            "rate_btc": "0.000009970868683206100000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "Pakistani Rupee",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "PLN": {
            "is_fiat": 1,
            "rate_btc": "0.000248371337731770000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Polska Zloty",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "POT": {
            "is_fiat": 0,
            "rate_btc": "0.000018960000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00100000",
            "status": "online",
            "name": "PotCoin",
            "confirms": "5",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "PPC": {
            "is_fiat": 0,
            "rate_btc": "0.000247408000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Peercoin",
            "confirms": "2",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "transfers",
                "convert"
            ]
        },
        "PSB": {
            "is_fiat": 0,
            "rate_btc": "0.000004987500000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00010000",
            "status": "online",
            "name": "Pesobit",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "QRK": {
            "is_fiat": 0,
            "rate_btc": "0.000003540000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00100000",
            "status": "online",
            "name": "Quark",
            "confirms": "3",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "RBY": {
            "is_fiat": 0,
            "rate_btc": "0.000213895000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00010000",
            "status": "online",
            "name": "Rubycoin",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "REE": {
            "is_fiat": 0,
            "rate_btc": "0.000001168333333333300000",
            "last_update": "1483042261",
            "tx_fee": "0.00200000",
            "status": "maintenance",
            "name": "Reecoin",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "RUB": {
            "is_fiat": 1,
            "rate_btc": "0.000017674199433204000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Russian Ruble",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "SBD": {
            "is_fiat": 0,
            "rate_btc": "0.000742977869652510000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "Steem Dollars",
            "confirms": "30",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers",
                "dest_tag"
            ]
        },
        "SEK": {
            "is_fiat": 1,
            "rate_btc": "0.000111491671282380000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Swedish Krona",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "SGD": {
            "is_fiat": 1,
            "rate_btc": "0.000718809618223840000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Singapore Dollar",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "SLR": {
            "is_fiat": 0,
            "rate_btc": "0.000084004285714286000000",
            "last_update": "1483042261",
            "tx_fee": "0.00100000",
            "status": "online",
            "name": "SolarCoin",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "START": {
            "is_fiat": 0,
            "rate_btc": "0.000007605714285714300000",
            "last_update": "1483042261",
            "tx_fee": "0.00100000",
            "status": "online",
            "name": "StartCOIN",
            "confirms": "10",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "transfers",
                "convert"
            ]
        },
        "STEEM": {
            "is_fiat": 0,
            "rate_btc": "0.000171525000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "STEEM",
            "confirms": "30",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "transfers",
                "dest_tag",
                "convert"
            ]
        },
        "STV": {
            "is_fiat": 0,
            "rate_btc": "0.000002753333333333300000",
            "last_update": "1483042261",
            "tx_fee": "0.00001000",
            "status": "online",
            "name": "SativaCoin",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "SYS": {
            "is_fiat": 0,
            "rate_btc": "0.000008230000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00001000",
            "status": "online",
            "name": "Syscoin",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "THB": {
            "is_fiat": 1,
            "rate_btc": "0.000029103917056595000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "Thai Baht",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "TIT": {
            "is_fiat": 0,
            "rate_btc": "0.000001303333333333300000",
            "last_update": "1481518561",
            "tx_fee": "0.00010000",
            "status": "maintenance",
            "name": "TitCoin",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "TWD": {
            "is_fiat": 1,
            "rate_btc": "0.000032377363760302000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "New Taiwan Dollar",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "TX": {
            "is_fiat": 0,
            "rate_btc": "0.000004886666666666700000",
            "last_update": "1483042261",
            "tx_fee": "0.00010000",
            "status": "online",
            "name": "TransferCoin",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "UNIT": {
            "is_fiat": 0,
            "rate_btc": "0.000002480000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00100000",
            "status": "online",
            "name": "UniversalCurrency",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "USD.Bitstamp": {
            "is_fiat": 0,
            "rate_btc": "0.001047475853672300000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "United States Dollar",
            "confirms": "30",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers",
                "dest_tag"
            ]
        },
        "USD.SnapSwap": {
            "is_fiat": 0,
            "rate_btc": "0.001047475853672300000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "United States Dollar",
            "confirms": "30",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers",
                "dest_tag"
            ]
        },
        "USDT": {
            "is_fiat": 0,
            "rate_btc": "0.001041666666601600000000",
            "last_update": "1483042261",
            "tx_fee": "0.00000000",
            "status": "online",
            "name": "TetherUSD",
            "confirms": "2",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "convert"
            ]
        },
        "VTC": {
            "is_fiat": 0,
            "rate_btc": "0.000033165000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00100000",
            "status": "online",
            "name": "Vertcoin",
            "confirms": "7",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "transfers",
                "convert"
            ]
        },
        "WDC": {
            "is_fiat": 0,
            "rate_btc": "0.000006122500000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.10000000",
            "status": "online",
            "name": "Worldcoin",
            "confirms": "6",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "XMR": {
            "is_fiat": 0,
            "rate_btc": "0.013570345000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.10000000",
            "status": "online",
            "name": "Monero",
            "confirms": "10",
            "can_convert": 1,
            "capabilities": [
                "wallet",
                "transfers",
                "dest_tag",
                "convert"
            ]
        },
        "XPM": {
            "is_fiat": 0,
            "rate_btc": "0.000052595000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "PrimeCoin",
            "confirms": "3",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "XZC": {
            "is_fiat": 0,
            "rate_btc": "0.000495293333333330000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "ZCoin",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "ZAR": {
            "is_fiat": 1,
            "rate_btc": "0.000072227445977448000000",
            "last_update": "1483042261",
            "tx_fee": "0.01000000",
            "status": "online",
            "name": "South African Rand",
            "confirms": "10",
            "can_convert": 0,
            "capabilities": []
        },
        "ZEC": {
            "is_fiat": 0,
            "rate_btc": "0.051950050000000000000000",
            "last_update": "1483042261",
            "tx_fee": "0.00001000",
            "status": "online",
            "name": "ZCash",
            "confirms": "5",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        },
        "LTCT": {
            "is_fiat": 0,
            "rate_btc": "1.000000000000000000000000",
            "last_update": "1375473661",
            "tx_fee": "0.00100000",
            "status": "online",
            "name": "Litecoin Testnet",
            "confirms": "1",
            "can_convert": 0,
            "capabilities": [
                "wallet",
                "transfers"
            ]
        }
    }
}',
			'response' =>
				array(
					'code'    => 200,
					'message' => 'OK',
				),
			'cookies'  =>
				array(),
			'filename' => null,
		);
	}
}
