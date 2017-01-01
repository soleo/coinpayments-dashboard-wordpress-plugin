=== Stats Dashboard for Coinpayments ===
Contributors: soleo
Donate link: https://www.xinjiangshao.com
Tags: coinpayments, bitcoin, payment gateway, BTC, DASH
Requires at least: 4.2.0
Tested up to: trunk
Stable tag: 1.0.0
License: MIT
License URI: https://opensource.org/licenses/MIT

A plugin to display stats from coinpayment.net

== Description ==

CoinPayments Dashboard displays balance, rates information from coinpayments.net for your account.
This enable the coinpayments user to see some basic stats from WordPress without login Coinpayment.net
.

== Installation ==

### Manual installation

1. Upload the plugin directory to `/wp-content/plugins/`
1. Activate the plugin through the 'Plugins' menu in WordPress


### Configuration

CoinPayments Dashboard provides a number of constants that can be used to grab information from
coinpayments.net . Users who wish to change these values should define the constants in `wp-config.php`.

After installing, you should define `COINPAYMENTS_PUBLIC_KEY` and `COINPAYMENTS_PRIVATE_KEY` in `wp-config.php`. The plugin will work without them; however, you will still need to configure these options if you don't define them in `wp-config.php`. To define them copy the following code to your `wp-config.php` file, update the key to use your public key, and private to match coinpayments.net account you're using:

```
define( 'COINPAYMENTS_PUBLIC_KEY', '39c4820390d8f050giweda50268c7583' );
define( 'COINPAYMENTS_PRIVATE_KEY', 'abcdefghijklmn1234567890' );
```

Configuring other constants is similarly done by defining the constant in `wp-config.php`. All constants are explained
below.

**COINPAYMENTS_API_ENDPOINT**

Defines the API endpoint for Coinpayments.net. This should not usually need to be changed, but is added in the event that Coinpayments
decides to use a different API endpoint, or if there is a need for a user to have a special endpoint.

*default: (string) 'https://www.coinpayments.net/api.php'*

== Frequently Asked Questions ==

= What kind of permission should I assign to the key pair? =

The plugins requires at least `balances` and `rates` read permission.


== Screenshots ==

1. Admin Dashboard Widget
2. Setting View
3. Configuration View

== Changelog ==

= 1.0.0 =
Initial release.

== Upgrade Notice ==

= 1.0.0 =
Initial release.
