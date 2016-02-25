<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Auth controller
 *
 * @package     CodeIgniter 2.2.0
 *
 * @module      auth_module
 * @controller  Auth
 *
 * @ __construct()
 * @ index()
 * @ login()
 * @ logout()
 * @ register()
 * @ forgot_password()
 * @ forgot_username()
 * @ username_sent()
 * @ request_reset_password_sent()
 * @ verify_reset_password()
 * @ reset_password()
 * @ activation()
 * @ set_locale()
 * @ show_404()
 */

class Auth extends MX_Controller {
	/**
	 * Class constructor
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		// Parent class constructor
		parent::__construct();
		
		// Load library
		$this->load->library( 'logtrino_user' );
		$this->load->library( 'auth_validation' );

		// Prepare UI
		$this->logtrino_ui->_is_admin_area( FALSE );
		$this->logtrino_ui->_init_breadcrumb();

	}

	/**
	 * Default action
	 *
	 * @access public
	 * @return mixed
	 */
	function index() {
		// Check user already logged in otherwise, bring to login
		
		redirect( 'auth/login', 302 );
	}

	/**
	 * Log in action
	 * Display log in page
	 *
	 * @access public
	 * @return mixed
	 */
	function login() {
		// Check session for user already logged in
		if( is_user_logged_in() ) {
			// Bring already logged in user to dashboard
			redirect( 'dashboard', 'refresh' );
			return false;
		}

		// Make data as global var
		global $data;
		if( is_form_submit() ) {
			// Get the values from form
			$username = $this->input->post( 'username', true );
			$password = $this->input->post( 'password', true );
			$continue = $this->input->post( 'continue', true );
			// Validate registration form
			$this->auth_validation->validate( 'login' );

			if( $this->form_validation->run() == false ) {
				// Validation failed
				$errors = $this->form_validation->errors_array();
				$errors_text = array_values( $errors );

				// Set form errors
				$data['form'] = array( 'errors' => $errors );

				$this->logtrino_ui->_set_message( 'danger', 
					array( 'Wrong usename or password !!!!' ) 
				);
			} else {
				// Get the user with username
				$user = $this->users_model->get_user_by_username( $username );
               
				// Check user found and user is active
				if( $user ) {
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
                        $this->session->set_userdata( 'username', $user->username );
                        
						// Set welcome message
						$this->session->set_flashdata( 'message', 
							array(
								'success' => array(
									sprintf( 'Welcome back %s' , $user->first_name, $user->last_name )
								)
							)
						);
                        
						// Log this logged out action in activity history
						modules::run( 'activity/_signed_in', $user->id, sprintf( '%s %s', $user->first_name, $user->last_name ) );
						/** delete/insert record when user login
                        modules::run( 'projects/insert_data_from_api', $user->id);
                        modules::run( 'invoices/insert_data_from_api', $user->id);
                        */
                        // continue the page if user was logged out from one page
						if( '' != $continue ) {
							redirect( urldecode( $continue ), 'location' );
							return false;
						}
                        
						// redirect to dashboard
						redirect( 'dashboard', 'location' );
						return false;
					} else {
						// Password not match
						$this->logtrino_ui->_set_message( 'danger', array( 'Username or password does not match.' ) );
					}
				} else {
					// User is not valid
					$this->logtrino_ui->_set_message( 'danger', array( 'This username does not belong to any account.' ) );
				}
			}
		}
		// Set up UI
		$this->logtrino_ui->_set_title(  'Login' );
		$this->logtrino_ui->_set_view( 'auth/login' );
		// Render UI
		$this->logtrino_ui->_render();
	}

	/**
	 * Logout user
	 *
	 * @access public
	 * @return mixed
	 */
	function logout() {
		
		// Check session for user already logged in
		if( is_user_logged_in() ) {
			// Log this logged out action in activity history
			modules::run( 'activity/_signed_out' );
			/** delete record when user logout 
            $this->load->model('projects/projects_model');
            $this->load->model('invoices/invoices_model');
            $this->projects_model->delete_record($this->logtrino_user->get_id());
            $this->invoices_model->delete_record($this->logtrino_user->get_id());
            */
			// Destroy all user data stored in session
			$this->session->sess_destroy();

			// Set message states user has logged out
			$this->logtrino_ui->_set_message( 'info', 
				array( _i18n( 'You are logged out.', 'mod_auth' ) )
			);
		}


		// Set up UI
		$this->logtrino_ui->_set_title( _i18n( 'Log in', 'mod_auth' ) );
		$this->logtrino_ui->_set_view( 'login' );
		// Render UI
		$this->logtrino_ui->_render();
	}

	/**
	 * Register a new user
	 *
	 * @access public
	 * @return mixed
	 */
	function register( $action = '' ) {

		// Check session for user already logged in
		if( is_user_logged_in() ) {
			// Bring already logged in user to dashboard
			redirect( 'dashboard', 'refresh' );
			return false;
		}

		// Make data as global var
		global $data;

		if( $action && $action == 'success' ) {
			// Set up UI
			$this->logtrino_ui->_set_title( 'Create user susscessful!');
			$this->logtrino_ui->_set_view( 'register_success' );
		} else {
			// check form submitted
			if( is_form_submit() ) {
				/**
				 * Get the form values
				 */

				$first_name     = $this->input->post( 'first_name', true );
				$last_name      = $this->input->post( 'last_name', true );
				$username       = $this->input->post( 'username', true );
				$address        = $this->input->post( 'address', true );
                
				$telephone      = $this->input->post( 'telephone', true );
				$email_address  = $this->input->post( 'email_address', true );

				$password       = $this->input->post( 'password', true );
				$re_password    = $this->input->post( 're_password', true );
				$accept_terms   = $this->input->post( 'accept-terms', true );
                
				// Hack, POST var if accept-terms is not check
				// Othewise, validation rule can't run
				if( $accept_terms === FALSE ) {
					$_POST['accept-terms'] = '0';
				}

				// Validate registration form
				$this->auth_validation->validate( 'registration' );

				if( $this->form_validation->run() == false ) {
					// Validation failed
					$errors = $this->form_validation->errors_array();
					$errors_text = array_values( $errors );

					// Set form errors
					$data['form'] = array( 'errors' => $errors );

					// Set error message
					$this->logtrino_ui->_set_message( 'danger', 
						array( _i18n( 'Some errors were encountered. Please check the form and try again.' ) )
					);
				} else {
					// Form is submitted correctly, add the user to system
					// Load encryption library to encrypt password
					$this->load->library( 'phpass' );
					$this->phpass->setup( 8, true );

					// Generate a secure crypted password
					$password = $this->phpass->HashPassword( $password );

					// Get activation code to send to user with email
					$activation_code = get_activation_code( $username );

			
			
					
					// Create a new user
					$user_id = $this->users_model->create_user( $first_name, $last_name, $username, $email_address, $password, '0', $activation_code);
					

					/**
					 * Generate notifications for admininstrator and this user.
					 * This notification will see when they logged into system.
					 * For applicant user, this is the first time and so they'll get 
					 * notification to complete their application.
					 * For admin user, they'll get notification there was a new applicant 
					 * registered into system.
					 */
					modules::run( 'notifications/_register_translator', $user_id, $username, $first_name, $last_name, $email_address, $activation_code );

					// Set success message and redirect to success page
					$this->session->set_flashdata( 'message', 
						array(
							'success' => array( _i18n( 'You\'ve been registered successfully.', 'mod_auth' ) ),
							'info'    => array( _i18n( 'Please check your email to activate your account.', 'mod_auth' ) )
						)
					);

					// redirect to success registration page
					redirect( 'auth/register/success', 'location' );
					return false;
				}
			}

			// Set up UI
			$this->logtrino_ui->_set_title( _i18n( 'Registration', 'mod_auth' ) );
			$this->logtrino_ui->_set_view( 'register' );
		}
		// Render UI
		$this->logtrino_ui->_render();
	}

	/**
	 * Forgot password
	 * Request a new password if user forgot their password
	 *
	 * @access public
	 * @return mixed
	 */
	function forgot_password() {
		/**
		 * Make sure only legitimate request allowed, user already logged in 
		 * should not allow to access.
		 */
		if( is_user_logged_in() ) {
			// redirect to dashboard
            
			redirect( 'dashboard', 'location' );
			return false;
		}

		// Make data as global var
		global $data;

		if( is_form_submit() ) {
			/**
			 * Get email to send password reset link
			 */
			$email_address = $this->input->post( 'email', true );

			// Validate registration form
			$this->auth_validation->validate( 'request_password_reset' );

			if( $this->form_validation->run() == false ) {
				// Validation failed
				$errors = $this->form_validation->errors_array();
				$errors_text = array_values( $errors );

				// Set form errors
				$data['form'] = array( 'errors' => $errors );

				// Set data for UI
				$this->logtrino_ui->_set_data( $data );
			} else {
				// Check that email belongs to system and already exists
				$user = $this->users_model->get_user_by_email( $email_address );

				// Make sure user is activated to request forgot password
				if( $user && (bool) $user->is_activated ) {
					// User is valid, continue
					// Get the password code that will send to user email as a link
					$reset_code = get_password_reset_code( $email_address );

					// Save reset code in database
					if( $this->users_model->create_user_password_reset_code( $user->id, $reset_code ) ) {
						// Send notification email
						modules::run( 'notifications/_request_forgot_password', $user, $email_address, $reset_code );

						// Redirect
						redirect( 'auth/request_reset_password_sent?email=' . urlencode( $email_address ), 'location' );
							return false;
					} else {
						// Cannot set the reset code
						$this->logtrino_ui->_set_message( 'danger', array( _i18n( 'Error encountered. Please try again.' ) ) );
					}
				} else {
					// User is not valid, and sent back message
					$this->logtrino_ui->_set_message( 'danger', 
						array(
							sprintf( _i18n( 'Email <%s> does not belong to any account.' ),  $email_address )
						)
					);
				}
			}
		}

		// Set up UI
		$this->logtrino_ui->_set_title( _i18n( 'Forgot Password', 'mod_auth' ) );
		$this->logtrino_ui->_set_view( 'forgot_password' );

		// Render UI
		$this->logtrino_ui->_render();
	}

	/**
	 * Forgot username
	 * Request username if user forgot their username
	 *
	 * @access public
	 * @return mixed
	 */
	function forgot_username() {
		/**
		 * Make sure only legitimate request allowed, user already logged in 
		 * should not allow to access.
		 */
		if( is_user_logged_in() ) {
			// redirect to dashboard
			redirect( 'dashboard', 'location' );
			return false;
		}

		// Make data as global var
		global $data;

		if( is_form_submit() ) {
			/**
			 * Get email from form to send username
			 */
			$email_address = $this->input->post( 'email', true );

			// Validate registration form
			$this->auth_validation->validate( 'request_username' );

			if( $this->form_validation->run() == false ) {
				// Validation failed
				$errors = $this->form_validation->errors_array();
				$errors_text = array_values( $errors );

				// Set form errors
				$data['form'] = array( 'errors' => $errors );

				// Set data for UI
				$this->logtrino_ui->_set_data( $data );
			} else {
				// First, check email belongs to the system and already exists
				$user = $this->users_model->get_user_by_email( $email_address );

				if( $user && (bool) $user->is_activated ) {					
					// Send notification email to user
					modules::run( 'notifications/_request_forgot_username', $user, $email_address );

					// Redirect
					redirect( 'auth/username_sent?email=' . urlencode( $email_address ), 'location' );
					return false;
				} else {
					// User is not valid, sent back error message
					$this->logtrino_ui->_set_message( 'danger', 
						array( sprintf( _i18n( 'Email <%s> does not exist.' ), $email_address ) )
					);
				}
			}
		}

		// Set up UI
		$this->logtrino_ui->_set_title( _i18n( 'Forgot Username', 'mod_auth' ) );
		$this->logtrino_ui->_set_view( 'forgot_username' );

		// Render UI
		$this->logtrino_ui->_render();
	}

	/**
	 * Display UI about username is sent to email after 
	 * using forgot_username method
	 *
	 * @access public
	 * @return mixed
	 */
	function username_sent() {
		// Set up UI
		$this->logtrino_ui->_set_title( _i18n( 'Username sent', 'mod_auth' ) );
		$this->logtrino_ui->_set_view( 'username_sent' );
		$this->logtrino_ui->_render();
	}

	/**
	 * Display UI about password reset link is sent to email after 
	 * using forgot_password method
	 *
	 * @access public
	 * @return mixed
	 */
	function request_reset_password_sent() {
		// Set up UI
		$this->logtrino_ui->_set_title( _i18n( 'Reset password instructions sent', 'mod_auth' ) );
		$this->logtrino_ui->_set_view( 'reset_password_sent' );
		$this->logtrino_ui->_render();
	}

	/**
	 * Verify request reset password via email
	 * Check reset code is expired or not and it's valid for correct user
	 *
	 * @access public
	 * @return mixed
	 */
	function verify_reset_password() {
		// Get params
		$reset_code = $this->input->get( 'reset_code', true );
		$email      = $this->input->get( 'email', true );
		$user_id    = $this->input->get( 'uid', true );

		// Get the user
		$user = $this->users_model->get_user_by_password_reset_code( $reset_code );

		// If user found
		if( $user && $user->id == $user_id ) {

			// Check that reset code is not expired
			if( is_password_reset_code_expired( $user->password_reset_time ) ) {
				$this->logtrino_ui->_set_title( _i18n( 'Access Not Allow', 'mod_auth' ) );
				$this->logtrino_ui->_set_view( 'forbidden_reset_password' );
			} else {
				// Ok. let me reset my password
				// Generate temporary session token
				$token = get_token( 16 );

				// Set token in session
				$this->session->set_flashdata( 'reset_tok', $token );

				// Redirect to reset page
				redirect( 'auth/reset_password?reset_tok=' . $token . '&email=' . $email . '&uid=' . $user_id  );
				return false;
			}
		} else {
			// Set up UI
			$this->logtrino_ui->_set_title( _i18n( 'Access Not Allow', 'mod_auth' ) );
			$this->logtrino_ui->_set_view( 'forbidden_reset_password' );
		}

		// Set up UI
		$this->logtrino_ui->_set_header( 'templates/request_reset_header' );
		$this->logtrino_ui->_set_footer( 'templates/request_reset_footer' );

		// Render UI
		$this->logtrino_ui->_render( 'request_reset' );
	}

	/**
	 * Reset user password
	 *
	 * @access public
	 * @return mixed
	 */
	function reset_password() {
		// Get the parameters
		$user_id = $this->input->get( 'uid', true );
		$email   = $this->input->get( 'email', true );
		$reset_tok = $this->session->flashdata( 'reset_tok' );
		$user_tok  = $this->input->get( 'reset_tok', true );

		if( $reset_tok && $user_tok && $reset_tok == $user_tok ) {
			// Ok fine, show password reset form

			if( is_form_submit() ) {
				// Get new password
				$password    = $this->input->post( 'password', true );

				// Validate registration form
				$this->auth_validation->validate( 'reset_password' );

				if( $this->form_validation->run() == false ) {
					// Falied validation
					$this->logtrino_ui->_set_message( 'danger', 
						validation_errors()
					);
				} else {
					// Validation passed
					// Load encryption library
					$this->load->library( 'phpass' );

					// Encrypted password
					$this->phpass->setup( 8, true );
					$new_password = $this->phpass->HashPassword( $password );

					// Update password
					if( $this->users_model->update_password( $user_id, $new_password ) ) {
						// redirect to log in
						redirect( 'auth/login', 'location' );
						return false;
					} else {
						// failed to reset password
						$this->logtrino_ui->_set_view( 'reset_password_failed' );
					}
				}
			}

			// Generate new token for next request
			$reset_tok = get_token( 16 );
			$this->session->set_flashdata( 'reset_tok', $reset_tok );

			// Set data for view
			$view_data = array(
				'reset_tok' => $reset_tok,
				'user_id'   => $user_id,
				'email'     => $email
			);

			$this->logtrino_ui->_set_data( $view_data );

			// Set up UI
			$this->logtrino_ui->_set_title( _i18n( 'Reset Password', 'mod_auth' ) );
			$this->logtrino_ui->_set_view( 'reset_password' );

		} else {
			// Not allow to perform
			$this->logtrino_ui->_set_title( _i18n( 'Access Not Allow', 'mod_auth' ) );
			$this->logtrino_ui->_set_view( 'forbidden_reset_password' );
		}

		// Render UI
		$this->logtrino_ui->_render();
	}

	/**
	 * Activate user
	 *
	 * @access public
	 * @return mixed
	 */
	function activation( $action = false ) {
		/**
		 * Make sure only legitimate request allowed, user already logged in 
		 * should not allow to access.
		 */
		if( is_user_logged_in() ) {
			// redirect to dashboard
			redirect( 'dashboard', 'location' );
			return false;
		}

		// Make data global
		global $data;

		if( $action == 'resubmit' ) {
			if( is_form_submit() ) {
				// get the email
				$email = $this->input->post( 'email', true );

				// Validate registration form
				$this->auth_validation->validate( 'request_activation' );

				if( $this->form_validation->run() == false ) {
					// Validation failed
					$errors = $this->form_validation->errors_array();
					$errors_text = array_values( $errors );

					// Set form errors
					$data['form'] = array( 'errors' => $errors );

					// Set data for UI
					$this->logtrino_ui->_set_data( $data );
				} else {
					// Check email exist in system
					$user = $this->users_model->get_user_by_email( $email );

					if( $user ) {

						// Get activation code to send to user with email
						$activation_code = get_activation_code( $email );
						$activation_link = 'activation_code=' . $activation_code;

						// Add activation code for user
						$this->users_model->create_activation_code( $user->id, $activation_code );

						/**
						 * Data pass to email template to send to user
						 */
						$email_data = array( 
							'user' => sprintf( "%s %s", $user->first_name, $user->last_name ), 
							'activation_url' => site_url( '/auth/activation/?' . $activation_link )
						);

						// Load email configurations
						$email_config = get_global_email_config();

						// Get email message from view
						$email_body = $this->load->view( 'emails/activation_request', $email_data, true );

						// Prepare email
						$email = prepare_email( '', $email, 'Activate Your Account', $email_body, false, false, false, $email_config );

						// Send email
						$email->send();
					} else {
						$this->logtrino_ui->_set_message( 'danger', 
							array( _i18n( 'Email doesn\'t belong to any account.', 'mod_auth' ) )
						);
					}
				}
			}
		}

		/**
		 * Get activation code and email from the link
		 */
		$user_activation_code = $this->input->get( 'activation_code', true );

		// Set up view
		$this->logtrino_ui->_set_title( _i18n( 'Activation Failed', 'mod_auth' ) );
		$this->logtrino_ui->_set_view( 'activation_failed' );

		if( $user_activation_code ) {
			// Check that email already exists in system
			$user = $this->users_model->get_user_by_activation_code( $user_activation_code );
			
			if( $user ) {
				if( $this->users_model->activate_user( $user->id, '1', $user_activation_code ) ) {
					// Set success message and redirect to success page
					$this->session->set_flashdata( 'message', 
						array(
							'success' => array( _i18n( 'Activation was succesful, you can now log in to your account.', 'mod_auth' ) )
						)
					);

					// redirect to success registration page
					redirect( 'auth/login', 'location' );
					return false;
				} else {
					$this->logtrino_ui->_set_title( _i18n( 'Activation Failed', 'mod_auth' ) );
					$this->logtrino_ui->_set_view( 'activation_failed' );
				}
			}
		}

		$this->logtrino_ui->_render();
	}

	function set_locale() {
		$selected_lang = $this->input->get( 'lang' );
		$lang_arr = explode( '-', $selected_lang );

		if( count( $lang_arr ) < 2 ) {
			$locale = $lang_arr[0] . '_' . strtoupper( $lang_arr[0] );
		} else {
			$locale = $lang_arr[0] . '_' . $lang_arr[1];
		}

		// Set the language and locale
		$this->session->set_userdata( 'lang', $selected_lang );
		$this->session->set_userdata( 'locale', $locale );

		redirect( 'auth/login', 'location' );
		return false;
	}

	/**
	 * Custom 404 page not found
	 * This method redirect to default action if 404 is occurred and avoiding illegal access.
	 *
	 * @access public
	 * @return void
	 */
	function show_404() {
		redirect( site_url(), 'location' );
		exit();
	}

}

/* End */
/* Location: `application/modules/auth/controllers/auth.php` */