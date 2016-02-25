<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Helper functions
 * Email helper functions to manage email sending and processes in system.
 *
 * @package     CodeIgniter 2.2.0
 *
 * @helper      email_helper
 */

if( !function_exists( 'get_global_email_config' ) ) {
	/**
	 * Get email configurations from config file
	 * The global configurations were declared in 'logtrino' associative arrays
	 * For more details, check `application/config/logtrino.php`
	 */
	function get_global_email_config() {
		// Load CI object
		$CI =& get_instance();

		// Load configurations
		$config = $CI->load->config( 'logtrino' );

		return $config['email_config'];
	}
}

if( !function_exists( 'prepare_email' ) ) {
	/**
	 * Prepare an email with config
	 * Set subject, from address, to addresses and message body for ready to 
	 * send email
	 *
	 * @param: (string) $from Email address where this email send from
	 * @param: (string) $to Email address where this email send to
	 * @param: (string) $subject Subject of email
	 * @param: (string) $message Message of email to send
	 * @return: Email object instatiated by CI object
	 */
	function prepare_email( $from, $to, $subject, $message, $cc = false, $bcc = false, $clear = false, $config = array() ) {
		$CI =& get_instance();

		// Load email library
		$CI->load->library( 'email' );

		// Clear email variables defined previous used ?
		if( $clear ) {
			// Clear previous email variables and initialize as empty state
			// Clear attachments as well with TRUE parameter
			$CI->email->clear( TRUE );
		}

		// If config passed ? Use it when initialize email class
		if( !empty( $config ) && count( $config ) > 0 ) {
			// Make sure the config is correctly set up
			if( isset( $config['settings'] ) ) {
				$CI->email->initialize( $config['settings'] );
			}
		}

		// Setup email
		$CI->email->to( $to );

		// CC is used
		if( $cc ) {
			$CI->email->cc( $cc );
		}

		// BCC is used
		if( $bcc ) {
			$CI->email->bcc( $bcc );
		}

		if( '' == $from && $config && $config['from_email'] && $config['from_name'] ) {
			$CI->email->from( $config['from_email'] );
			$CI->email->reply_to( $CI->config->item( 'from_email' ), $CI->config->item( 'from_name' ) );
		} else {
			$CI->email->from( $from );
		}
		
		// Add subject and message
		$CI->email->subject( $subject );
		$CI->email->message( $message );

		// Return email object already set up
		return $CI->email;
	}
}

if( !function_exists( 'get_email_link' ) ) {
	/**
	 */
	function get_email_link( $email_address = '' ) {
		/**
		 * Define available third party email services
		 */
		$email_services = array(
			'gmail.com'    => 'https://mail.google.com',
			'hotmail.com'  => 'https://mail.live.com',
			'outlook.com'  => 'https://outlook.com',
			'aol.com'      => 'https://aol.com',
			'yahoo.com'    => 'https://mail.yahoo.com'
		);

		if( valid_email( $email_address ) ) {
			$email_domain = explode( '@', $email_address );
			$email_domain = $email_domain[1];
			
			if( isset( $email_services[ $email_domain ] ) ) {
				return $email_services[ $email_domain ];
			}

			return '';
		}

		return '';
	}
}

/* End */
/* Location: `application/helpers/email_helper.php` */