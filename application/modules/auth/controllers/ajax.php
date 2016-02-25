<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Ajax controller
 *
 * @package     CodeIgniter 2.2.0
 *
 * @module      auth_module
 * @controller  Ajax
 *
 * @ __construct()
 * @ login()
 */

class Ajax extends MX_Controller {

	/**
	 * Class constructor
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {

		// Parent class constructor
		parent::__construct();
	}

	function login() {
		// Make data as global var
		global $data;

		if( is_form_submit() ) {
			// Get the values from form
			$username = $this->input->post( 'username', true );
			$password = $this->input->post( 'password', true );
			$continue = $this->input->post( 'continue', true );

			// Validate registration form
			$this->load->library( 'auth_validation' );
			$this->auth_validation->validate( 'login' );

			if( $this->form_validation->run() == false ) {
				// Validation failed
				$res = array(
					'status'      => 'failed',
					'fieldErrors' => $this->form_validation->errors_array(),
				);
			} else {
				// Get the user with username
				$user = $this->users_model->get_user_by_username( $username );

				// Check user found and user is active
				if( $user && (bool) $user->is_activated ) {
					// Found user in system, now check with the password
					$stored_password = $this->users_model->get_user_password( $user->id );

					// Load encryption library
					$this->load->library( 'phpass' );
					$this->phpass->setup( 8, true );
					
					// Check password match
					if( $this->phpass->checkPassword( $password, $stored_password ) ) {
						// User has logged in
						session_regenerate_id();
						$this->session->set_userdata( 'logged_in', 1 );
						$this->session->set_userdata( 'user_id', $user->id );

						// Set welcome message
						$this->session->set_flashdata( 'message', 
							array(
								'success' => array(
									sprintf( _i18n( 'Welcome back %s' ), $user->first_name, $user->last_name )
								)
							)
						);

						// Log this logged out action in activity history
						modules::run( 'activity/_signed_in', $user->id, sprintf( '%s %s', $user->first_name, $user->last_name ) );

						$res = array( 'status' => 'success' );

					} else {
						// Password not match
						$res = array( 'status' => 'failed', 'message' => _i18n( 'Username or password does not match.', 'mod_auth' ) );
					}
				} else {
					// User is not valid
					$res = array( 'status' => 'failed', 'message' => _i18n( 'This username does not belong to any account.', 'mod_auth' ) );
				}
			}

			// Send back response
			$this->output->set_content_type( 'application/json' );
			echo json_encode( $res );
			die();
		}
	}

}

/* End */
/* Location: `application/modules/auth/controllers/ajax.php` */