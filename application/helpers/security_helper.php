<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Helper functions
 * Security helper functions to handle various security processes.
 *
 * @package     CodeIgniter 2.2.0
 *
 * @helper      security_helper
 */

if( !function_exists( 'get_token' ) ) {
	/**
	 * Generate a security token with random string for 
	 * specific length.
	 * 
	 * @param: (int) $length Length of token
	 * @return: (string) Random encrypted string for security token
	 */
	function get_token( $length = 32 ) {
		// Alphanumeric array
		$chars = array(
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
			'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
			'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 
			'0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
		);

		// Make characters random
		shuffle( $chars );

		// Total characters we use
		$num_chars = count( $chars ) - 1;

		// Token string to store
		$token = '';

		for($i = 0; $i < $length; $i++)
		{
			$token .= $chars[ mt_rand( 0, $num_chars ) ];
		}
		
		// Append token with salt to make stronger
		$token = "$2a$07$" . $token . "$";

		// Return a secure token
		return $token;
	}
}

if( !function_exists( 'get_activation_code' ) ) {
	/**
	 * Generate activate code encrypted with sha1 cipher
	 * @param: (string) $key Use as a key to encrypt. Eg. Email ID or username
	 * @return: (string) Encrypted string uses for activation code
	 */
	function get_activation_code( $key )
	{
		return sha1( mt_rand() . uniqid( $key, true ) );
	}
}


if( !function_exists( 'get_password_reset_code' ) ) {
	/**
	 * Generate activate code encrypted with sha1 cipher
	 * @param: (string) $key Use as a key to encrypt. Eg. Email ID or username
	 * @return: (string) Encrypted string uses as password reset code
	 */
	function get_password_reset_code( $key )
	{
		return sha1( mt_rand() . uniqid( $key, true ) );
	}
}

if( !function_exists( 'is_password_reset_code_expired' ) ) {
	/**
	 * Check password code is expired or not
	 * Normally, we'll check with current time and the specific destination time when 
	 * the password reset code will be expired. If the current time is greater than the 
	 * the time when the password reset code requested. The reset code is expired.
	 *
	 * @param: (string) $password_reset_time Time of password reset code requested
	 * @param: (int) $estimate_time Estimate time of password reset code will be expired.
	 *         Eg., 24 hours, 1 day, 1 week etc. Native PHP time flag can be used.
	 *         Default is 24 hours or 1 day
	 */
	function is_password_reset_code_expired( $reset_time, $estimate_time = '24 hours' ) {
		// Calculate expired time
		$expired_time = strtotime( $reset_time . ' + ' . $estimate_time );

		// get the current time
		$current_time = time();

		// Compare current time is after expired time, and return it
		return $current_time > $expired_time; 
	}
}

if( !function_exists( 'get_security_question' ) ) {
	/**
	 * Generate two random number to ask user for answer to prevent 
	 * submitting a form by bots
	 *
	 * @access public
	 * @return (array) Array contains first number, second number and sum of these two numbers
	 */
	function get_security_question() {
		$CI =& get_instance();

		// Generate numbers
		$first_num = rand( 1, 10 );
		$second_num = rand( 11, 20 );

		// Sum two numbers
		$sum = $first_num + $second_num;

		// Store in session
		$CI->session->set_flashdata( 'seq', $sum );

		return array( 'first_num' => $first_num, 'second_num' => $second_num, 'sum' => $sum );
	}
}

if( !function_exists( 'is_user_logged_in' ) ) {
	/**
	 * Check user is already logged in to system. Or redirect back to log in
	 */
	function is_user_logged_in() {
		// Get CI object
        
		$CI =& get_instance();
		// Check user data in session
		return $CI->session->userdata( 'logged_in' ) === 1 && $CI->session->userdata( 'user_id' );
	}
    function set_language(){
        
    }
}

if( !function_exists( 'is_admin' ) ) {
	/**
	 * Check user is admin user or not
	 */
	function is_admin( $user_id = false ) {}
}


/* End */
/* Location: `application/helpers/security_helper.php` */