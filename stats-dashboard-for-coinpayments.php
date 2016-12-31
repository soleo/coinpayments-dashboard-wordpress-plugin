<?php
/**
 * Plugin Name: Stats Dashboard for Coinpayments
 * Description: A plugin to display stats from coinpayments.net .
 * Author: soleo
 * Version: 1.0.0
 * Text Domain: stats-dashboard-for-coinpayments
 * Domain Path: /languages
 * GitHub Plugin URI: https://github.com/soleo/coinpayments-dashboard-wordpress-plugin
 */

/**
 * Singleton for kicking off functionality for this plugin.
 */
class CoinpaymentsDashboard {
	/**
	 * The one instance of CoinpaymentsDashboard.
	 *
	 * @var CoinpaymentsDashboard
	 */
	private static $instance;

	/**
	 * Current plugin version.
	 *
	 * @since 1.0.0
	 *
	 * @var   string    The semantically versioned plugin version number.
	 */
	var $version = '1.0.0';

	/**
	 * File path to the plugin dir (e.g., /var/www/mysite/wp-content/plugins/stats-dashboard-for-coinpayments).
	 *
	 * @since 1.0.0.
	 *
	 * @var   string    Path to the root of this plugin.
	 */
	var $root_dir = '';

	/**
	 * File path to the plugin src files (e.g., /var/www/mysite/wp-content/plugins/stats-dashboard-for-coinpayments/src).
	 *
	 * @since 1.0.0.
	 *
	 * @var   string    Path to the root of this plugin.
	 */
	var $src_dir = '';

	/**
	 * File path to the plugin main file (e.g., /var/www/mysite/wp-content/plugins/stats-dashboard-for-coinpayments/stats-dashboard-for-coinpayments.php).
	 *
	 * @since 1.0.0.
	 *
	 * @var   string    Path to the plugin's main file.
	 */
	var $file_path = '';

	/**
	 * The URI base for the plugin (e.g., http://domain.com/wp-content/plugins/stats-dashboard-for-coinpayments).
	 *
	 * @since 1.0.0.
	 *
	 * @var   string    The URI base for the plugin.
	 */
	var $url_base = '';

	/**
	 * Instantiate or return the one CoinpaymentDashboard instance.
	 *
	 * @return CoinpaymentDashboard
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Initiate actions.
	 *
	 * @return CoinpaymentDashboard
	 */
	public function __construct() {
		// Set the main paths for the plugin.
		$this->root_dir  = dirname( __FILE__ );
		$this->src_dir   = $this->root_dir . '/src';
		$this->file_path = $this->root_dir . '/' . basename( __FILE__ );
		$this->url_base  = untrailingslashit( plugins_url( '/', __FILE__ ) );

		// Include dependent files.
		include $this->src_dir . '/config.php';
		include $this->src_dir . '/utils.php';
		include $this->src_dir . '/classes/settings.php';
		include $this->src_dir . '/classes/api.php';

		if ( is_admin() ) {
			include $this->src_dir . '/settings-page.php';
		}
		// Hook into the 'wp_dashboard_setup' action to register our function.
		add_action( 'wp_dashboard_setup', array( $this, 'add_coinpayment_dashboard_widget' ), 100 );

		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
	}

	/**
	 * Add an widget to show stats from CoinPayment.net
	 *
	 * @return void
	 */
	public function add_coinpayment_dashboard_widget() {
		wp_add_dashboard_widget(
			'coinpayment_dashboard_widget',
			'Coinpayments Stats Dashboard',
			array( $this, 'display_coinpayments_dashboard_widget' )
		);

		global $wp_meta_boxes;
		$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
		$coinpayment_dashboard_widget_backup = array( 'coinpayment_dashboard_widget' => $normal_dashboard['coinpayment_dashboard_widget'] );
		unset( $normal_dashboard['coinpayment_dashboard_widget'] );
		$sorted_dashboard = array_merge( $coinpayment_dashboard_widget_backup, $normal_dashboard );
		$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
	}

	/**
	 * Display widget to show stats
	 *
	 * @return void
	 */
	public function display_coinpayments_dashboard_widget() {
		$options = Coinpayments_Settings::get_settings();
		if ( empty( $options['coinpayments_public_key'] ) || empty( $options['coinpayments_private_key'] ) ) {
			echo 'Please setup public/private keys first in Settings > Coinpayments';
			return ;
		}
		$api_instance = Coinpayments_API::instance();
		$api_instance->set_options( $options );
		$balance = $api_instance->get_balance();
		$total_in_usd = 0;
		$total_in_btc = 0;
		$rates = $api_instance->get_rates();

		if ( isset( $rates['USD']['rate_btc'] ) ) {
			$btc_to_usd_rate = 1 / $rates['USD']['rate_btc'];
			foreach ( $balance as $c => $b ) {
				$total_in_btc += $b['balancef'] * $rates[ $c ]['rate_btc'];
			}
			$total_in_btc = round( $total_in_btc, 8 );
			$total_in_usd = round( $btc_to_usd_rate * $total_in_btc, 2 );
		}
		?>
		<div class="coinpayments-container">
			<ul>
			<?php foreach ( $balance as $coin_name => $b ) : ?>
				<li>
					<strong><?php echo esc_html( $coin_name ); ?> Balance:</strong>
					<span style="float:right;"><?php echo esc_html( $b['balancef'] ); ?></span>
				</li>
			<?php endforeach; ?>
			</ul>
			<hr>
			<ul>
				<li>
					<strong>Total in BTC: </strong>
					<span style="float:right;">฿ <?php echo esc_html( $total_in_btc ); ?></span>
				</li>
				<li>
					<strong>Total in USD: </strong>
					<span style="float:right;">$ <?php echo esc_html( $total_in_usd ); ?></span>
				</li>
			</ul>
		</div>
		<?php
	}

	/**
	 * Load the plugin text domain.
	 *
	 * @since 1.0.0.
	 *
	 * @return void
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'stats-dashboard-for-coinpayments', false, basename( dirname( __FILE__ ) ) . '/languages/' );
	}
}

/**
 * Instantiate or return the one CoinPaymentsDashboard instance.
 *
 * @return CoinPaymentsDashboard
 */
function get_coinpayments_dashboard_instance() {
	return CoinpaymentsDashboard::instance();
}

get_coinpayments_dashboard_instance();
