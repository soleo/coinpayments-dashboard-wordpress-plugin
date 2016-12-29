<?php

class Coinpayments_API {
    /**
     * The one instance of Coinpayments_API.
     *
     * @since 1.0.0.
     *
     * @var Coinpayments_API
     */
    private static $instance;

    /**
    * The API Endpoint for CoinPayments
    *
    * @since 1.0.0.
    *
    * @var Coinpayments_API
    */
    private static $api_endpoint;

    /**
     * The private key Endpoint for CoinPayments
     *
     * @since 1.0.0.
     *
     * @var Coinpayments_API
     */
    private static $private_key;

    /**
     * The public key for CoinPayments
     *
     * @since 1.0.0.
     *
     * @var Coinpayments_API
     */
    private static $public_key;

    /**
     * Instantiate or return the one Coinpayments_API instance.
     *
     * @since 1.0.0.
     *
     * @return Coinpayments_API
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Set key and endpoints options
     *
     * @since 1.0.0.
     *
     * @var Coinpayments_API
     */
    public function set_options($options) {
        self::$private_key = $options['coinpayments_private_key'];
        self::$public_key = $options['coinpayments_public_key'];
        self::$api_endpoint = $options['api_endpoint'];
    }

    /**
     * get balance from coinpayments
     *
     * @since 1.0.0.
     *
     * @var Coinpayments_API
     */
    public function get_balance() {
        $balance = self::make_api_call('balances');
        if( $balance['error'] == 'ok' ) {
            return $balance['result'];
        }
        return array();
    }

    /**
     * get real-time conversation rates between different currencies to BTC
     *
     * @since 1.0.0.
     *
     * @var Coinpayments_API
     */
    public function get_rates() {
        $rates = self::make_api_call('rates');
        if( $rates['error'] == 'ok') {
            return $rates['result'];
        }
        return array();
    }

    /**
     * Util function for making API calls to coinpayments.net
     *
     * @since 1.0.0.
     *
     * @var Coinpayments_API
     */
    private static function make_api_call($cmd, $req = array()) {
        // Set the API command and required fields
        $req['version'] = 1;
        $req['cmd'] = $cmd;
        $req['key'] = self::$public_key;
        $req['format'] = 'json'; //supported values are json and xml

        // Generate the query string
        $post_data = http_build_query($req, '', '&');

        // Calculate the HMAC signature on the POST data
        $hmac = hash_hmac('sha512', $post_data, self::$private_key);

        // Create cURL handle and initialize (if needed)
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init(self::$api_endpoint);
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: '.$hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        // Execute the call and close cURL handle
        $data = curl_exec($ch);
        // Parse and return data if successful.
        if ($data !== FALSE) {
            if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {
                // We are on 32-bit PHP, so use the bigint as string option. If you are using any API calls with Satoshis it is highly NOT recommended to use 32-bit PHP
                $dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
            } else {
                $dec = json_decode($data, TRUE);
            }
            if ($dec !== NULL && count($dec)) {
                return $dec;
            } else {
                // If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message
                return array('error' => 'Unable to parse JSON result ('.json_last_error().')');
            }
        } else {
            return array('error' => 'cURL error: '.curl_error($ch));
        }
    }
}
