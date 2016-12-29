<?php
/**
 * Class to control the registration and handling of all settings values.
 */
class Coinpayments_Settings {
	/**
	 * The settings values for the plugin.
	 *
	 * @since 1.0.0.
	 *
	 * @var array Holds all of the individual settings for the plugin.
	 */
	public static $settings = array();

	/**
	 * Get the valid settings for the plugin.
	 *
	 * @since 1.0.0.
	 *
	 * @return array The valid settings including default values and sanitize callback.
	 */
	public static function get_registered_settings() {
		return array(
			'coinpayments_public_key' => array(
				'sanitize_callback' => 'coinpayments_sanitize_key',
				'default'           => COINPAYMENTS_PUBLIC_KEY,
			),
			'coinpayments_private_key' => array(
				'sanitize_callback' => 'coinpayments_sanitize_key',
				'default'           => COINPAYMENTS_PRIVATE_KEY,
			),
			'api_endpoint' => array(
				'sanitize_callback' => 'esc_url',
				'default'           => COINPAYMENTS_API_ENDPOINT,
			),

		);
	}

	/**
	 * Get an array of settings values.
	 *
	 * This method negotiates the database values and the constant values to determine what the current value should be.
	 * The database value takes precedence over the constant value.
	 *
	 * @since 1.0.0.
	 *
	 * @return array The current settings values.
	 */
	public static function get_settings() {
		$negotiated_settings = self::$settings;

		if ( empty( $negotiated_settings ) ) {
			$registered_settings = self::get_registered_settings();
			$saved_settings      = get_option( 'coinpayments-settings', array() );
			$negotiated_settings = array();

			foreach ( $registered_settings as $key => $values ) {
				$value = '';

				if ( isset( $saved_settings[ $key ] ) ) {
					$value = $saved_settings[ $key ];
				} elseif ( isset( $values['default'] ) ) {
					$value = $values['default'];
				}

				if ( isset( $values['sanitize_callback'] ) ) {
					$value = call_user_func( $values['sanitize_callback'], $value );
				}

				$negotiated_settings[ $key ] = $value;
			}

			self::set_settings( $negotiated_settings );
		}

		return $negotiated_settings;
	}

	/**
	 * Get the value of an individual setting.
	 *
	 * @since 1.0.0.
	 *
	 * @param  string $setting The setting name.
	 * @return mixed           The setting value.
	 */
	public static function get_setting( $setting ) {
		$value = '';

		$negotiated_settings = self::get_settings();
		$registered_settings = self::get_registered_settings();

		if ( isset( $negotiated_settings[ $setting ] ) ) {
			$value = $negotiated_settings[ $setting ];
		} elseif ( isset( $registered_settings[ $setting ]['default'] ) ) {
			$value = $registered_settings[ $setting ]['default'];
		}

		return $value;
	}

	/**
	 * Set the settings values.
	 *
	 * @since 1.0.0.
	 *
	 * @param  array $settings The current settings values.
	 * @return void
	 */
	public static function set_settings( array $settings ) {
		self::$settings = $settings;
	}
}
