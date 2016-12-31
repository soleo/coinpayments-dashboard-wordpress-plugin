<?php
/**
 * Singleton for setting up CoinPayments settings.
 */
class Coinpayments_Settings_Page {
	/**
	 * The one instance of Coinpayments_Settings_Page.
	 *
	 * @since 1.0.0.
	 *
	 * @var Coinpayments_Settings_Page
	 */
	private static $instance;

	/**
	 * Instantiate or return the one Coinpayments_Settings_Page instance.
	 *
	 * @since 1.0.0.
	 *
	 * @return Coinpayments_Settings_Page
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
	 * @since 1.0.0.
	 *
	 * @return Purgely_Settings_Page
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'settings_init' ) );
	}

	/**
	 * Setup the configuration screen for the plugin.
	 *
	 * @since 1.0.0.
	 *
	 * @return void
	 */
	function add_admin_menu() {
		add_submenu_page(
			'options-general.php',
			__( 'Coinpayments', 'stats-dashboard-for-coinpayments' ),
			__( 'Coinpayments', 'stats-dashboard-for-coinpayments' ),
			'manage_options',
			'stats-dashboard-for-coinpayments',
			array( $this, 'options_page' )
		);
	}

	/**
	 * Initialize all of the settings.
	 *
	 * @since 1.0.0.
	 *
	 * @return void
	 */
	function settings_init() {
		// Set up the option name, "coinpayments-settings". All values will be in this array.
		register_setting(
			'coinpayments-settings',
			'coinpayments-settings',
			array( $this, 'sanitize_settings' )
		);

		// Set up the settings section.
		add_settings_section(
			'coinpayments_settings',
			__( 'Coinpayments Settings', 'stats-dashboard-for-coinpayments' ),
			array( $this, 'coinpayments_settings_callback' ),
			'coinpayments-settings'
		);

		// Register all of the individual settings.
		add_settings_field(
			'coinpayments_public_key',
			__( 'API Public Key', 'stats-dashboard-for-coinpayments' ),
			array( $this, 'coinpayments_public_key_render' ),
			'coinpayments-settings',
			'coinpayments_settings'
		);

		add_settings_field(
			'coinpayments_private_key',
			__( 'API Private Key', 'stats-dashboard-for-coinpayments' ),
			array( $this, 'coinpayments_private_key_render' ),
			'coinpayments-settings',
			'coinpayments_settings'
		);

	}

	/**
	 * Print the description for the settings page.
	 *
	 * @since 1.0.0.
	 *
	 * @return void
	 */
	public function coinpayments_settings_callback() {
		esc_html_e( 'Please enter details related to your CoinPayment.net account. A CoinPayment.net API public and private key are required for all operations.', 'stats-dashboard-for-coinpayments' );
	}

	/**
	 * Render the public key input.
	 *
	 * @since 1.0.0.
	 *
	 * @return void
	 */
	public function coinpayments_public_key_render() {
		$options = Coinpayments_Settings::get_settings();
		?>
		<input type='text' class='regular-text code' name='coinpayments-settings[coinpayments_public_key]' value='<?php echo esc_attr( $options['coinpayments_public_key'] ); ?>'>

		<p class="description">
			<?php esc_html_e( 'API Public key for the Coinpayments.net account associated with this site.', 'stats-dashboard-for-coinpayments' ); ?>
		</p>
		<?php
	}

	 /**
	  * Render the private key input.
	  *
	  * @since 1.0.0.
	  *
	  * @return void
	  */
	public function coinpayments_private_key_render() {
		$options = Coinpayments_Settings::get_settings();
		?>
		<input type='text' class='regular-text code' name='coinpayments-settings[coinpayments_private_key]' value='<?php echo esc_attr( $options['coinpayments_private_key'] ); ?>'>

		<p class="description">
			<?php esc_html_e( 'API Private key for the Coinpayments.net account associated with this site.', 'stats-dashboard-for-coinpayments' ); ?>
		</p>
		<?php
	}

	/**
	 * Print the settings page.
	 *
	 * @since 1.0.0.
	 *
	 * @return void
	 */
	public function options_page() {
		?>
		<div class="wrap">
			<form action='options.php' method='post'>

				<h1>
					<?php esc_html_e( 'Coinpayments Settings', 'stats-dashboard-for-coinpayments' ); ?>
				</h1>

				<?php
				settings_fields( 'coinpayments-settings' );
				do_settings_sections( 'coinpayments-settings' );
				submit_button();
				?>

			</form>
		</div>
		<?php
	}

	/**
	 * Sanitize all of the setting.
	 *
	 * @since 1.0.0.
	 *
	 * @param  array $settings The unsanitized settings.
	 * @return array           The sanitized settings.
	 */
	public function sanitize_settings( $settings ) {
		$clean_settings = array();
		$registered_settings = Coinpayments_Settings::get_registered_settings();

		foreach ( $settings as $key => $value ) {
			if ( isset( $registered_settings[ $key ] ) ) {
				$clean_settings[ $key ] = call_user_func( $registered_settings[ $key ]['sanitize_callback'], $value );
			}
		}

		return $settings;
	}
}

/**
 * Instantiate or return the one Coinpayments_Settings_Page instance.
 *
 * @since 1.0.0.
 *
 * @return Coinpayments_Settings_Page
 */
function get_coinpayments_settings_page_instance() {
	return Coinpayments_Settings_Page::instance();
}

get_coinpayments_settings_page_instance();
