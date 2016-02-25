<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Form validation library inside module
 * Set validation rules to validate with form validation class for module
 *
 * @package     CodeIgniter 2.2.0
 * @subpackage  Logtrino Business Solution
 *
 * @author      Ko Ko Zin
 * @email       kozin@mvhnetworks.com
 * @url         http://www.mvhnetworks.com
 *
 * @module      auth_module
 * @class       Auth_validation
 */

class auth_validation {
	/**
	 * Class constructor
	 * Load CI object to access CI class and vars within this class
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		$this->ci = &get_instance();
		$this->ci->load->library( 'form_validation' );
		$this->ci->form_validation->set_error_delimiters( '', '' );

		$this->ci->form_validation->set_message( 'required', '%s is required.' );
		$this->ci->form_validation->set_message( 'min_length', '%s must be at least %d characters in length.' );
		$this->ci->form_validation->set_message( 'valid_email', 'Email you provided is not valid.' );
		$this->ci->form_validation->set_message( 'numeric', '%s must contain only numbers' );
	}
	
	/**
	 * Check validation methods exist and run if exists, otherwise, throw error
	 *
	 * @access public
	 * @return void
	 */
	public function validate( $action ) {
		$method = '_' . $action;

		if( method_exists( $this, $method ) ) {
			return $this->$method();
		}
		
		throw new Exception( 'Validation Error: Unknown validation action name "' . $action . '".' );
	}
	
	/**
	 * Set validation rules for registration form
	 *
	 * @access public
	 * @return void
	 */
	private function _registration() {
	


		$this->ci->form_validation->set_rules( 'first_name', 'First name', 'htmlspecialchars|required|string' );
		$this->ci->form_validation->set_rules( 'last_name','Last name', 'htmlspecialchars|required|string' );
		$this->ci->form_validation->set_rules( 'username', 'Username', 'htmlspecialchars|required|string|min_length[8]|is_username_taken' );
	
		$this->ci->form_validation->set_rules( 'email_address', 'Email', 'required|valid_email|is_email_taken' );
		$this->ci->form_validation->set_rules( 'address', 'Address', 'required' );
	
		$this->ci->form_validation->set_rules( 'telephone', 'Telephone', 'required|numeric' );
	
		$this->ci->form_validation->set_rules( 'password', 'Password', 'required|min_length[8]|matches[re_password]' );
		$this->ci->form_validation->set_message( 'password', 'Password' );
		$this->ci->form_validation->set_rules( 're_password', 'Password', 'required|matches[password]' );
		$this->ci->form_validation->set_message( 'matches', 'Password doesn\'t match.' );

		$this->ci->form_validation->set_rules( 'accept-terms', 'Agree terms and conditions', 'accept_terms' );
		
	}

	/**
	 * Set validation rules for login form
	 *
	 * @access public
	 * @return void
	 */
	private function _login() { 
		$this->ci->form_validation->set_rules( 'username', 'Username', 'required|min_length[6]' );
		$this->ci->form_validation->set_rules( 'password', 'Password', 'required|min_length[8]' );
		
	}

	/**
	 * Set validation rules for request password reset form
	 *
	 * @access public
	 * @return void
	 */
	private function _request_password_reset() { 
		$this->ci->form_validation->set_rules( 'email', 'Email', 'required|valid_email' );
	}

	/**
	 * Set validation rules for request username form
	 * 
	 * @access public
	 * @return void
	 */
	private function _request_username() { 
		$this->ci->form_validation->set_rules( 'email', 'Email', 'htmlspecialchars|required|valid_email' );
	}

	/**
	 * Set validation rules for request activation account
	 *
	 * @access public
	 * @return void
	 */
	private function _request_activation() { 
		$this->ci->form_validation->set_rules( 'email', 'Email', 'required|valid_email' );
	}

	/**
	 * Set validation rules for reset password form
	 *
	 * @access public
	 * @return void
	 */
	private function _reset_password() { 
		$this->ci->form_validation->set_rules( 'password', 'Password', 'required|min_length[8]' );
		$this->ci->form_validation->set_rules( 're_password', 'Password', 'matches[password]' );
		$this->ci->form_validation->set_message( 'required', 'Please enter your new password.' );
		$this->ci->form_validation->set_message( 'matches', 'Password does not match.' );
	}
}

/* End */
/* Location: `application/modules/auth/libraries/auth_validation.php` */