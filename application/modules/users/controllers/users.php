<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Users controller
 *
 * @package     CodeIgniter 2.2.0
 *
 * @module      users_module
 * @controller  Users
 *
 * @ __construct()
 * @ index()
 * @ create_new_admin()
 * @ edit()
 * @ profile()
 * @ activate_user()
 * @ delete()
 * @ reset_password()
 * @ edit_username()
 * @ search()
 * @ user_not_found()
 * @ show_404()
 */

class Users extends MX_Controller {

	/**
	 * Class constructor
	 * Check authorize access for logged in user to access this private area.
	 * Load helpers, config and models file for users module
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {

		// Parent class constructor
		parent::__construct();
		
		// Check user already logged in
		if( !is_user_logged_in() ) {
			// Redirect back
			redirect( 'auth/login/?continue=' . urlencode( current_url() ), 'location' );
			return false;
		}

		// Load library
		$this->load->library( 'logtrino_user' );
		
		// Setup UAC
		$this->logtrino_uac->_init( 'users' );
		$this->logtrino_uac->_set_rules( 
			array( 
				'create_user', 'edit_user', 'delete_user',
				'create_email', 'edit_email', 'update_primary_email', 'delete_email',
				'create_address', 'edit_address', 'update_primary_address', 'delete_address', 
				'edit_profile_picture', 'change_supplier_status', 'deactivate_user', 'activate_user'
			) 
		);

		// Load config
		$this->load->config( 'io_messages' );

		// Load based stylesheets, scripts for UI
		$this->logtrino_ui->_add_style( 'bootstrap-switch', base_url( 'assets/css/bootstrap-switch.css' ), array( 'media' => 'all' ) );
		$this->logtrino_ui->_add_style( 'datepicker', base_url( 'assets/css/bootstrap-datetimepicker.min.css' ), array( 'media' => 'all' ) );

		$this->logtrino_ui->_add_script( 'datapicker', base_url( 'assets/js/bootstrap-datetimepicker.min.js' ), array() );
		$this->logtrino_ui->_add_script( 'bootstrap-switch', base_url( 'assets/js/bootstrap-switch.min.js' ), array() );
	}

	/**
	 * Default action of controller
	 *
	 * @access public
	 * @return mixed
	 */
	function index() {
		$users = $this->users_model->get_all_users();
        $data = array(
            'users' =>$users
        );
        // Set data
		$this->logtrino_ui->_set_data( $data );

		// Check user role to choose the edit view
		$this->logtrino_ui->_set_view( 'admin/overviews' );
		

		// Display UI
		$this->logtrino_ui->_set_title( 'Overview Users' );
		$this->logtrino_ui->_render();
	}
    function create_new_user(){
        // Make data as global var
		global $data;
        $user_id = $this->session->userdata['user_id'];
        $user = $this->users_model->get_user_by_id($user_id);
        if($user->is_admin != 1){
            // Set error message
				$this->session->set_flashdata( 'message', 
					array( 
						'info' => array(
							'You don\'t have permission to do that.'
						) 
					)
				);

			// Now redirect back
			redirect( 'users', 'location' );
			return false;
        }
		if( is_form_submit() && $user->is_admin == 1 ) {
			/**
			 * Get user data
			 */
			$first_name = $this->input->post( 'first_name', true );
			$last_name  = $this->input->post( 'last_name', true );
			$username   = $this->input->post( 'username', true );
			$email      = $this->input->post( 'email_address', true );
			$active     = $this->input->post( 'active', true );
			$password   = $this->input->post( 'password', true );

			// Make sure active must be 1 or 0, other illegal input will change to original value
			if( $active != '1' && $active != '0' ) {
				$active = (string) intval( $user->is_active() );
			}

			/**
			 * Validate user input to ensure user has entered correct information
			 */
			$this->load->library( 'users_validation' );

			// Run validation
			$this->users_validation->validate( 'create_admin' );

			if( $this->form_validation->run() == FALSE ) {
				// Validation failed
				$errors = $this->form_validation->errors_array();
				$errors_text = array_values( $errors );

				// Set form errors
				$data['form'] = array( 'errors' => $errors );

				// Set data for UI
				$this->logtrino_ui->_set_data( $data );

				// Set message for UI
				$this->logtrino_ui->_set_message( 'danger', _i18n( 'Some errors were encountered. Please check the form and try again.' ) );
			} else {
				// Load I/O Messages
				$io_messages = $this->config->item( 'io_messages' );

				// Validation passed

				// Load encryption library to encrypt password
				$this->load->library( 'phpass' );
				$this->phpass->setup( 8, true );

				// Generate a secure crypted password
				$password = $this->phpass->HashPassword( $password );

				// Create a new user
				$user_id = $this->users_model->create_user( $first_name, $last_name, $username, $email, $password, $active );

				// Assign the new user as admin
				$this->users_model->assign_user_role( $user_id, '0' );

				// Add email for user
				//$this->users_model->create_user_primary_email( $user_id, $email );

				// Log this action in activity history
				$activity_text = $io_messages['activity_log']['add_new_user']['text'];
				$activity_html = $io_messages['activity_log']['add_new_user']['html'];
				$params = site_url( 'users/profile/' . $this->logtrino_user->get_id() . '/' . $this->logtrino_user->get_username() ) . ',' . site_url( 'users/profile/' . $user_id . '/' . $username ) . ',' . $this->logtrino_user->get_name() . ',' . $first_name . ' ' . $last_name;
				
				// Store this action in activity history
				modules::run( 'activity/_log_action', $this->logtrino_user->get_id(), $activity_text, $activity_html, $params );

				// Set success message
				$this->session->set_flashdata( 'message', 
					array( 
						'success' => array(
							'New user successfully created.'
						) 
					)
				);

				// Now redirect back
				redirect( 'users', 'location' );
				return false;
			}
		}

		// Setup UI
		$this->logtrino_ui->_set_title( 'Create New User' );
		$this->logtrino_ui->_set_view( 'admin/create_admin' );
		$this->logtrino_ui->_render();
    }

	/**
	 * Create a new admin user
	 *
	 * @access public
	 * @return void
	 */
	function create_new_admin() {
		// Make data as global var
		global $data;
        $user_id = $this->session->userdata['user_id'];
        $user = $this->users_model->get_user_by_id($user_id);
        if($user->is_admin != 1){
            // Set error message
				$this->session->set_flashdata( 'message', 
					array( 
						'info' => array(
							'You don\'t have permission to do that.'
						) 
					)
				);

			// Now redirect back
			redirect( 'users', 'location' );
			return false;
        }
		if( is_form_submit() && $user->is_admin == 1 ) {
			/**
			 * Get user data
			 */
			$first_name = $this->input->post( 'first_name', true );
			$last_name  = $this->input->post( 'last_name', true );
			$username   = $this->input->post( 'username', true );
			$email      = $this->input->post( 'email_address', true );
			$active     = $this->input->post( 'active', true );
			$password   = $this->input->post( 'password', true );

			// Make sure active must be 1 or 0, other illegal input will change to original value
			if( $active != '1' && $active != '0' ) {
				$active = (string) intval( $user->is_active() );
			}

			/**
			 * Validate user input to ensure user has entered correct information
			 */
			$this->load->library( 'users_validation' );

			// Run validation
			$this->users_validation->validate( 'create_admin' );

			if( $this->form_validation->run() == FALSE ) {
				// Validation failed
				$errors = $this->form_validation->errors_array();
				$errors_text = array_values( $errors );

				// Set form errors
				$data['form'] = array( 'errors' => $errors );

				// Set data for UI
				$this->logtrino_ui->_set_data( $data );

				// Set message for UI
				$this->logtrino_ui->_set_message( 'danger', _i18n( 'Some errors were encountered. Please check the form and try again.' ) );
			} else {
				// Load I/O Messages
				$io_messages = $this->config->item( 'io_messages' );

				// Validation passed

				// Load encryption library to encrypt password
				$this->load->library( 'phpass' );
				$this->phpass->setup( 8, true );

				// Generate a secure crypted password
				$password = $this->phpass->HashPassword( $password );

				// Create a new user
				$user_id = $this->users_model->create_user( $first_name, $last_name, $username, $email, $password, $active );

				// Assign the new user as admin
				$this->users_model->assign_user_role( $user_id, '1' );

				// Add email for user
				//$this->users_model->create_user_primary_email( $user_id, $email );

				// Log this action in activity history
				$activity_text = $io_messages['activity_log']['add_new_admin']['text'];
				$activity_html = $io_messages['activity_log']['add_new_admin']['html'];
				$params = site_url( 'users/profile/' . $this->logtrino_user->get_id() . '/' . $this->logtrino_user->get_username() ) . ',' . site_url( 'users/profile/' . $user_id . '/' . $username ) . ',' . $this->logtrino_user->get_name() . ',' . $first_name . ' ' . $last_name;
				
				// Store this action in activity history
				modules::run( 'activity/_log_action', $this->logtrino_user->get_id(), $activity_text, $activity_html, $params );

				// Set success message
				$this->session->set_flashdata( 'message', 
					array( 
						'success' => array(
							'New admin user successfully created.'
						) 
					)
				);

				// Now redirect back
				redirect( 'users', 'location' );
				return false;
			}
		}

		// Setup UI
		$this->logtrino_ui->_set_title( 'Create New Admin' );
		$this->logtrino_ui->_set_view( 'admin/create_admin' );
		$this->logtrino_ui->_render();
	}

	/**
	 * Edit a user with specific users' ID
	 * Users' ID must be provided from URL. The last segment from URL will be taken as user's ID
	 * If user's ID is not provided. The current user will be editable
	 *
	 * @access public
	 * @return mixed
	 */
	function edit() {
		// Get the user's ID from URL
		$user_id = $this->uri->segment( 3 );

		// Convert type to interger to avoid raising db error when passing incorrect data type
		$user_id = intval( $user_id );
        $user_current = $this->users_model->get_user_by_id($this->session->userdata['user_id']);
        $user = $this->users_model->get_user_by_id($user_id);
        
		// Only admin user can edit
		if( $user_current->is_admin == 0 ) {
			redirect( 'users/profile', 'location' );
			return false;
		}
		// Make data as global var
		global $data;

		// Prepare data
		$data = array( 'user' => $user );

		/**
		 * Check form submit to update
		 */
		if( is_form_submit() ) {
			/**
			 * Get the new data
			 */
			$first_name = $this->input->post( 'first_name', true );
			$last_name  = $this->input->post( 'last_name', true );
			$email      = $this->input->post( 'email_address', true );
			$username   = $this->input->post( 'username', true );
			$job_title  = $this->input->post( 'job_title', true );
			$active     = $this->input->post( 'active', true );
			$password   = $this->input->post( 'password', true );
            $applicant_status = $this->input->post('applicant_status', true);

			// Make sure active must be 1 or 0, other illegal input will change to original value
			if( $active != '1' && $active != '0' ) {
				$active = (string) intval( $user->is_active );
			}

			// user's editing himself, and there's no active option in form
			if( $active === FALSE ) { $active = '1'; }
			
			/**
			 * Validate user input to ensure user has entered correct information
			 */
			$this->load->library( 'users_validation' );

			// Run validation
			$this->users_validation->validate( 'edit_admin' );

			// If password entered, run validation before updating password
			if( strlen( $password ) > 0 ) {
				$this->users_validation->validate( 'edit_admin_pass' );
			}

			// Username changed ?
			if( $username != $user->username ) {
				$this->users_validation->validate( 'admin_edit_username' );
			}

			if( $this->form_validation->run() == FALSE ) {
				// Validation failed
				$errors = $this->form_validation->errors_array();
				$errors_text = array_values( $errors );

				// Set form errors
				$data['form'] = array( 'errors' => $errors );

				// Set data for UI
				$this->logtrino_ui->_set_data( $data );

				// Set message for UI
				$this->logtrino_ui->_set_message( 'danger', _i18n( 'Some errors were encountered. Please check the form and try again.' ) );
			} else {
				// Load I/O Messages
				$io_messages = $this->config->item( 'io_messages' );

				// Validation success
				if( strlen( $password ) > 0 ) {
					// Load encryption library to encrypt password
					$this->load->library( 'phpass' );
					$this->phpass->setup( 8, true );

					// Generate a secure crypted password
					$password = $this->phpass->HashPassword( $password );
				} else {
					$password = '';
				}

				// Update user
				$this->users_model->update_user( $user->id, $first_name, $last_name, $username, $email, $job_title, $active, $password, $applicant_status );
				
				// Log this action in activity history
				if( $user->id == $user_current->id ) {
					$activity_text = $io_messages['activity_log']['update_profile']['text'];
					$activity_html = $io_messages['activity_log']['update_profile']['text'];
					$params = site_url( 'users/profile/' . $user_current->id . '/' . $user_current->username );
				} else {
					$activity_text = $io_messages['activity_log']['update_user_profile']['text'];
					$activity_html = $io_messages['activity_log']['update_user_profile']['html'];
					$params = site_url( 'users/profile/' . $user_current->id . '/' . $user_current->username ) . ',' . $user_current->last_name() . ',' . site_url( 'users/profile/' . $user->id . '/' . $username ) . ',' . sprintf( '%s %s', $first_name, $last_name );
				}
				
				// Store this action in activity history
				modules::run( 'activity/_log_action', $user_current->id, $activity_text, $activity_html, $params );

				// Sent back success message
				$this->logtrino_ui->_set_message( 'success', 
					array(
						'User successfully updated.'
					) 
				);
			}

		}

		// Set data
		$this->logtrino_ui->_set_data( $data );

		// Check user role to choose the edit view
		$this->logtrino_ui->_set_view( 'admin/edit_admin' );
		
		// Display UI
		$this->logtrino_ui->_set_title( 'Edit User' );
		$this->logtrino_ui->_render();
	}

	/**
	 * View a user profile
	 *
	 * @access public
	 * @return mixed
	 */
	function profile() {
		// Get from URI
		$user_id = $this->session->userdata['user_id'];

		// Convert type to interger to avoid raising db error when passing incorrect data type
		$user_id = intval( $user_id );

		$user = $this->users_model->get_user_by_id($user_id);
		// Set data for UI
		$data = array( 'user' => $user );
		$this->logtrino_ui->_set_data( $data );
		// Set up UI<br />
		$this->logtrino_ui->_set_title( 'Profile Details' );
		// Set view for UI
		if( $user->is_admin == 1 ) {
			$this->logtrino_ui->_set_view( 'admin/profile' );
		} else {
			$this->logtrino_ui->_set_view( 'supplier/profile' );
		}		

		// Render view
		$this->logtrino_ui->_render();
	}

	/**
	 * Activate a user
	 *
	 * @access public
	 * @return void
	 */
	function activate_user( $user_id = null ) {
		// Check user can activate user
		if( !$this->logtrino_uac->_run( 'activate_user' ) || $user_id == null ) {
			redirect( 'users/profile', 'location' );
			exit();
		}

		if( $user_id == $this->logtrino_user->get_id() ) {
			// Cannot activate / deactivate current logged in user
			$this->session->set_flashdata( 'message', 
				array( 'danger' => array( _i18n( 'Failed to process your request.' ) ) )
			);

			// Redirect back
			if( $this->input->get( 'redirect', true ) ) {
				$url = urldecode( $this->input->get( 'redirect', true ) );

				redirect( $url, 'location' );
				return false;
			}

			redirect( 'users/profile', 'location' );
			return false;
		}

		// Activate user
		if( $this->users_model->activate_user( intval( $user_id ), '1' ) ) {
			$this->session->set_flashdata( 'message', 
				array( 'success' => array( _i18n( 'User is successfully activated.' ) )
			) );
		} else {
			$this->session->set_flashdata( 'message', 
				array( 'danger' => array( _i18n( 'Couldn\'t activate user.' ) )
			) );
		}

		// redirect back
		if( $this->input->get( 'redirect', true ) ) {
			$url = urldecode( $this->input->get( 'redirect', true ) );

			redirect( $url, 'location' );
			return false;
		}

		redirect( 'users/profile', 'location' );
		return false;
	}

	/**
	 * Deactivate a user
	 *
	 * @access public
	 * @return void
	 */
	function deactivate_user( $user_id = null ) {
		// Check user can deactivate user
		if( !$this->logtrino_uac->_run( 'deactivate_user' ) || $user_id == null ) {
			redirect( 'users/profile', 'location' );
			exit();
		}

		if( $user_id == $this->logtrino_user->get_id() ) {
			// Cannot activate / deactivate current logged in user
			$this->session->set_flashdata( 'message', 
				array( 'danger' => array( _i18n( 'Failed to process your request.' ) ) )
			);

			// Redirect back
			if( $this->input->get( 'redirect', true ) ) {
				$url = urldecode( $this->input->get( 'redirect', true ) );

				redirect( $url, 'location' );
				return false;
			}

			redirect( 'users/profile', 'location' );
			return false;
		}

		// Deactivate user
		if( $this->users_model->activate_user( intval( $user_id ), '0' ) ) {
			$this->session->set_flashdata( 'message', 
				array( 'success' => array( _i18n( 'User is successfully deactivated.' ) )
			) );
		} else {
			$this->session->set_flashdata( 'message', 
				array( 'danger' => array( _i18n( 'User couldn\'t be deactivated.' ) )
			) );
		}

		// redirect back
		if( $this->input->get( 'redirect', true ) ) {
			$url = urldecode( $this->input->get( 'redirect', true ) );

			redirect( $url, 'location' );
			return false;
		}

		redirect( 'users/profile', 'location' );
		return false;
	}

	/**
	 * Delete a user
	 *
	 * @access public
	 * @return mixed
	 */
	function delete( $user_id = null ) {
		// Only admin user can do that and can't delete himself
        $user = $this->users_model->get_user_by_id($user_id);
        
		if( $user_id == $this->session->userdata['user_id'] && $user->is_admin == 0 ) {
			redirect( 'users/profile/' . $user->id . '/' . $user->username);
			return false;
		}

		// Need user's ID to delete
		if( !$user_id ) {
			redirect( 'users/profile', 'location' );
			return false;
		}

		// User doesn't exit
		if( !$user) {
			show_404();
			return false;
		}
		
		if( $user ) {
			// User found
			$data['user'] = $user;

			if( is_form_submit() ) {
				// Delete user
				$id = $this->input->post( 'user', true );

				if( $id == $user->id ) {
					// Load I/O Messages
					$io_messages = $this->config->item( 'io_messages' );

					// Delete user
					if( $this->users_model->delete_user( $id ) ) {
						// Log this action in activity history
						$activity_text = $io_messages['activity_log']['delete_user']['text'];
						$activity_html = $io_messages['activity_log']['delete_user']['html'];
						$params = site_url( 'users/profile/' . $user->id . '/' . $user->username ) ;

						// Store this action in activity history
						modules::run( 'activity/_log_action', $user->id, $activity_text, $activity_html, $params );

						$this->session->set_flashdata( 'message', 
							array( 
								'success' => array(
									'User successfully deleted.'
								) 
							)
						);
					} else {
						$this->session->set_flashdata( 'message', 
							array( 
								'success' => array(
									'User is not deleted.'
								) 
							)
						);
					}

					// redirect back
					if( $this->input->post( 'redirect', true ) ) {
						redirect( urldecode( $this->input->post( 'redirect', true ) ) );
						return false;
					}

					redirect( 'users' );
					return false;
				}
			}

			// Prepare data for UI
			$this->logtrino_ui->_set_data( $data );
		} else {
			// No user found
			redirect( 'users' );
			return false;
		}

		// Set up UI
		$this->logtrino_ui->_set_title( 'Delete User' );
		$this->logtrino_ui->_set_view( 'admin/delete' );
		$this->logtrino_ui->_render();

	}

	/**
	 * Reset user password
	 *
	 * @access public
	 * @return mixed
	 */
	function reset_password( $user_id = null ) {
		// User's ID must provide
		if( !$user_id || $user_id == $this->logtrino_user->get_id() ) {
			$user = $this->logtrino_user;
		} else {
			// Make sure user's ID match with current user's ID except for admin
			if( !$this->logtrino_user->is_admin() ) {
				// Illegal request
				redirect( 'users/reset_password/' . $this->logtrino_user->get_id(), 'location' );
				return false;
				//$user = $this->logtrino_user;
			} else {
				// Fine
				$user = new logtrino_user( intval( $user_id ) );
			}
		}

		// User doesn't exit
		if( !$user->get_id() ) {
			$user = $this->logtrino_user;
		}

		// Make data as global var
		global $data;

		// Prepare data
		$data = array( 'user' => $user );

		// Form submit
		if( is_form_submit() ) {
			// Check user's ID exist in form and match
			if( $this->input->post( 'user', true ) && $this->input->post( 'user', true ) == $user->get_id() ) {
				// Get data
				$current_password = $this->input->post( 'current_password', true );
				$new_password     = $this->input->post( 'password', true );

				/**
				 * Validate user input to ensure user has entered correct information
				 */
				$this->load->library( 'users_validation' );

				// Run validation
				$this->users_validation->validate( 'admin_reset_password' );

				if( $this->form_validation->run() == FALSE ) {
					// Validation failed
					$errors = $this->form_validation->errors_array();
					$errors_text = array_values( $errors );

					// Set form errors
					$data['form'] = array( 'errors' => $errors );

					$this->logtrino_ui->_set_message( 'danger', _i18n( 'Some errors were encountered. Please check the form and try again.' ) );
				} else {
					// Load I/O Messages
					$io_messages = $this->config->item( 'io_messages' );

					// Validation success, update password
					// Load encryption library
					$this->load->library( 'phpass' );
					$this->phpass->setup( 8, true );

					// Generate a secure crypted password
					$password = $this->phpass->HashPassword( $new_password );

					// update password
					if( $this->users_model->update_password( $user->get_id(), $password ) ) {
						// Log this action in activity history
						$activity_text = $io_messages['activity_log']['update_password']['text'];
						$activity_html = $io_messages['activity_log']['update_password']['html'];
						$params = site_url( 'users/profile/' . $this->logtrino_user->get_id() . '/' . $this->logtrino_user->get_username() ) . ',' . $this->logtrino_user->get_name();

						// Store this action in activity history
						modules::run( 'activity/_log_action', $this->logtrino_user->get_id(), $activity_text, $activity_html, $params );

						// Password successfully changed
						$this->session->set_flashdata( 'message', 
							array(
								'success' => array(
									'Password successfully updated.'
									)
							)
						);
					} else {
						$this->session->set_flashdata( 'message', 
							array(
								'danger' => array(
									_i18n( 'Password couldn\'t be updated.' )
									)
							)
						);
					}

					// redirect
					redirect( 'users/profile/' . $user->get_id() . '/' . $user->get_username(), 'location' );
					return false;
				}
			}
		}

		// Set up UI
		$this->logtrino_ui->_set_data( $data );
		$this->logtrino_ui->_set_title( 'Change Password - ' . $user->get_name() );
		$this->logtrino_ui->_set_view( 'reset_password' );

		$this->logtrino_ui->_render();
	}

	/**
	 * Edit user name
	 *
	 * @access public
	 * @return mixed
	 */
	function edit_username( $user_id = null ) {
		// User's ID must provide
		if( !$user_id || $user_id == $this->logtrino_user->get_id() ) {
			$user = $this->logtrino_user;
		} else {
			// Make sure user's ID match with current user's ID except for admin
			if( !$this->logtrino_user->is_admin() ) {
				// Illegal request
				redirect( 'users/edit_username/' . $this->logtrino_user->get_id(), 'location' );
				return false;
			} else {
				// Fine
				$user = new logtrino_user( intval( $user_id ) );
			}
		}

		// User doesn't exit
		if( !$user->get_id() ) {
			$user = $this->logtrino_user;
		}

		// Make data as global var
		global $data;

		// Prepare data
		$data = array( 'user' => $user );

		// Form submit
		if( is_form_submit() ) {
			// Check user's ID exist in form and match
			if( $this->input->post( 'user', true ) && $this->input->post( 'user', true ) == $user->get_id() ) {
				// Get data
				$username = $this->input->post( 'username', true );

				/**
				 * Validate user input to ensure user has entered correct information
				 */
				$this->load->library( 'users_validation' );

				// Run validation
				$this->users_validation->validate( 'admin_edit_username' );

				if( $this->form_validation->run() == FALSE ) {
					// Validation failed
					$errors = $this->form_validation->errors_array();
					$errors_text = array_values( $errors );

					// Set form errors
					$data['form'] = array( 'errors' => $errors );

					$this->logtrino_ui->_set_message( 'danger', _i18n( 'Some errors were encountered. Please check the form and try again.' ) );
				} else {
					// Load I/O Messages
					$io_messages = $this->config->item( 'io_messages' );

					// Validation success, update password

					// update username
					if( $this->users_model->update_username( $user->get_id(), $username ) ) {
						// Log this action in activity history
						if( $user->get_id() == $this->logtrino_user->get_id() ) {
							$activity_text = $io_messages['activity_log']['update_username']['text'];
							$activity_html = $io_messages['activity_log']['update_username']['html'];
							$params = site_url( 'users/profile/' . $this->logtrino_user->get_id() . '/' . $this->logtrino_user->get_username() ) . ',' . $this->logtrino_user->get_name();
						} else {
							$activity_text = $io_messages['activity_log']['update_user_username']['text'];
							$activity_html = $io_messages['activity_log']['update_user_username']['html'];
							$params        = site_url( 'users/profile/' . $this->logtrino_user->get_id() . '/' . $this->logtrino_user->get_username() ) . ',' . $this->logtrino_user->get_name() . ',' . site_url( 'users/profile/' . $user->get_id() . '/' . $user->get_username() ) . ',' . $user->get_name();
						}
						// Store this action in activity history
						modules::run( 'activity/_log_action', $this->logtrino_user->get_id(), $activity_text, $activity_html, $params );

						// Username successfully changed
						$this->session->set_flashdata( 'message', 
							array(
								'success' => array(
									'Username successfully updated.'
									)
							)
						);
					} else {
						$this->session->set_flashdata( 'message', 
							array(
								'danger' => array(
									_i18n( 'Username couldn\'t be updated.' )
									)
							)
						);
					}

					// redirect
					redirect( 'users/profile/' . $user->get_id() . '/' . $user->get_username(), 'location' );
					return false;
				}
			}
		}

		// Set up UI
		$this->logtrino_ui->_set_data( $data );
		$this->logtrino_ui->_set_title( 'Edit Username - ' . $user->get_name() );
		$this->logtrino_ui->_set_view( 'edit_username' );

		$this->logtrino_ui->_render();
	}

	/**
	 * Edit profile picture of user
	 *
	 * @access public
	 * @return mixed
	 */
	function edit_profile_picture() {
		global $data;

		if( is_form_submit() ) {
			// Load configuration for file upload
			$this->config->load( 'users_file' );

			// Get configurations
			$upload_config = $this->config->item( 'profile_picture_upload' );

			// Check image width
			$pic_width = get_image_size( $_FILES['profile_picture']['tmp_name'], 'width' );

			// User upload photo, set a upload path for profile picture
			$profile_path = 'uploads/avatars/' . $this->logtrino_user->get_id();

			// Make sure folder exists
			if( !is_dir( $profile_path ) ) {
				mkdir( $profile_path, 0755 );
			}

			// Give filename for profile picture
			$profile_pic_name = $this->logtrino_user->get_username() . '-' . $this->logtrino_user->get_id();
			$profile_pic_name = $profile_pic_name . '-' . time();

			// Add configurations for upload
			$upload_config['upload_path'] = $profile_path;
			$upload_config['file_name']   = $profile_pic_name;

			$this->load->library( 'upload', $upload_config );

			if ( !$this->upload->do_upload( 'profile_picture' ) ) {
				// Set error message display in UI
				$this->logtrino_ui->_set_message( 'danger', $this->upload->display_errors() );
			} else {
				// Load I/O Messages
				$io_messages = $this->config->item( 'io_messages' );

				// Get uploaded file name
				$upload_data = $this->upload->data();
				
				// Adjust profile picture size
				$resize_config = $this->config->item( 'profile_picture_resize' );
				$resize_config['source_image'] = $upload_data['full_path'];

				// Resize image
				$this->load->library( 'image_lib', $resize_config );
				if( $pic_width < 280 ) {
					$this->image_lib->resize();
				} else {
					$this->image_lib->crop();
				}
				
				// Photo uploaded, store path in database
				$this->users_model->update_profile_picture( $this->logtrino_user->get_id(), $profile_path . '/' . $upload_data['file_name'] );

				// Set message display in UI
				$this->logtrino_ui->_set_message( 'success', 'Profile picture successfully updated.' );

				// Log this action in activity history
				$activity_text = $io_messages['activity_log']['update_profile_picture']['text'];
				$activity_html = $io_messages['activity_log']['update_profile_picture']['html'];
				$params = site_url( 'users/profile/' . $this->logtrino_user->get_id() . '/' . $this->logtrino_user->get_username() ) . ',' . $this->logtrino_user->get_name();
				
				// Store this action in activity history
				modules::run( 'activity/_log_action', $this->logtrino_user->get_id(), $activity_text, $activity_html, $params );

				// Set message
				$this->session->set_flashdata( 'message', 
					array(
						'success' => array( 'Your profile has successfully updated.' )
					) 
				);
				// redirect back to profile page
				redirect( 'users/profile', 'location' );
				exit();
			}			
		}

		// Set up UI
		$this->logtrino_ui->_set_data( $data );
		$this->logtrino_ui->_set_title( 'Edit Profile Picture' );
		$this->logtrino_ui->_set_view( 'edit_profile_picture' );

		$this->logtrino_ui->_render();
	}

	/**
	 * Delete profile picture
	 *
	 * @access public
	 * @return void
	 */
	function delete_profile_picture() {
		// Load I/O Messages
		$io_messages = $this->config->item( 'io_messages' );
		
		// Check profile picture really exists
		if( file_exists( $this->logtrino_user->get_profile_picture() ) ) {
			// Remove file
			if( unlink( $this->logtrino_user->get_profile_picture() ) ) {
				// File successfully remove, update in database
				$this->users_model->update_profile_picture( $this->logtrino_user->get_id(), '' );

				// Log this action in activity history
				$activity_text = $io_messages['activity_log']['update_profile_picture']['text'];
				$activity_html = $io_messages['activity_log']['update_profile_picture']['html'];
				$params = site_url( 'users/profile/' . $this->logtrino_user->get_id() . '/' . $this->logtrino_user->get_username() ) . ',' . $this->logtrino_user->get_name();
				
				// Store this action in activity history
				modules::run( 'activity/_log_action', $this->logtrino_user->get_id(), $activity_text, $activity_html );

				$this->session->set_flashdata( 'message', 
					array(
						'success' => array( _i18n( 'Your profile picture has removed.' ) )
					) 
				);
			} else {
				// Couldn't delete picture
				$this->session->set_flashdata( 'message', 
					array( 
						'danger' => array( _i18n( 'Your profile picture couldn\'t be deleted.' ) ) 
					) 
				);
			}
		} else {
			// File not exists or something wrong
			$this->session->set_flashdata( 'message', 
				array( 
					'danger' => array( _i18n( 'Your profile picture couldn\'t be deleted.' ) ) 
				) 
			);
		}

		// redirect back
		redirect( 'users/profile', 'location' );
		exit();

		/*
		if( $this->users_model->update_profile_picture( $this->logtrino_user->get_id(), '' ) ) {
			// Remove profile picture successfully
			$this->logtrino_ui->_set_message( 'success', 'Profile picture ' );
		}*/
	}

	/**
	 * Accept a supplier
	 *
	 * @access public
	 * @return void
	 */
	function accept_supplier( $supplier_id ) {
		// Check user can do that action
		if( !$this->logtrino_uac->_run( 'change_supplier_status' ) ) {
			redirect( 'users/profile/' . $this->logtrino_user->get_id() . '/' . $this->logtrino_user->get_username() );
			return false;
		}

		// Get the user
		$user = new logtrino_user( intval( $supplier_id ) );

		if( empty( $user ) || $user->get_id() == null || $user->get_role_id() == 1 ) {
			// Not allow to do that
			redirect( 'users/profile/' . $this->logtrino_user->get_id() . '/' . $this->logtrino_user->get_username() );
			return false;
		}

		// Update the supplier status
		$this->users_model->change_translator_status( intval( $supplier_id ), 1 );

		// Notify user
		echo modules::run( 'notifications/_accept_supplier', $user );

		// Load I/O message
		$io_messages = $this->config->item( 'io_messages' );

		// Log this action in user activity log
		$io_messages = $this->config->item( 'io_messages' );
		$activity_text = $io_messages['activity_log']['accepted_supplier']['text'];
		$activity_html = $io_messages['activity_log']['accepted_supplier']['html'];

		$params = site_url( 'users/profile/' . $this->logtrino_user->get_id() . '/' 
					. $this->logtrino_user->get_username() ) 
					. ',' 
					. sprintf( '%s %s', $this->logtrino_user->get_first_name(), $this->logtrino_user->get_last_name() ) 
					. ',' 
					. site_url( 'users/profile/' . $user->get_id() . '/' . $user->get_username() )
					. ',' . sprintf( '%s %s', $user->get_first_name(), $user->get_last_name() );
		
		// Store this action in activity history
		modules::run( 'activity/_log_action', $this->logtrino_user->get_id(), $activity_text, $activity_html, $params );

		// Redirect back
		redirect( 'users/profile/' . $user->get_id() . '/' . $user->get_username() );
		exit();
	}

	/**
	 * Reject a supplier
	 *
	 * @access public
	 * @return void
	 */
	function reject_supplier( $supplier_id ) {
		// Check user can do that action
		if( !$this->logtrino_uac->_run( 'change_supplier_status' ) ) {
			redirect( 'users/profile/' . $this->logtrino_user->get_id() . '/' . $this->logtrino_user->get_username() );
			return false;
		}

		// Get the user
		$user = new logtrino_user( intval( $supplier_id ) );

		if( empty( $user ) || $user->get_id() == null || $user->get_role_id() == 1 ) {
			// Not allow to do that
			redirect( 'users/profile/' . $this->logtrino_user->get_id() . '/' . $this->logtrino_user->get_username() );
			return false;
		}

		// Update the supplier status
		$this->users_model->change_translator_status( intval( $supplier_id ), 4 );

		// Notify user
		echo modules::run( 'notifications/_reject_supplier', $user );

		// Load I/O message
		$io_messages = $this->config->item( 'io_messages' );

		// Log this action in user activity log
		$io_messages = $this->config->item( 'io_messages' );
		$activity_text = $io_messages['activity_log']['rejected_supplier']['text'];
		$activity_html = $io_messages['activity_log']['rejected_supplier']['html'];

		$params = site_url( 'users/profile/' . $this->logtrino_user->get_id() . '/' 
					. $this->logtrino_user->get_username() ) 
					. ',' 
					. sprintf( '%s %s', $this->logtrino_user->get_first_name(), $this->logtrino_user->get_last_name() ) 
					. ',' 
					. site_url( 'users/profile/' . $user->get_id() . '/' . $user->get_username() )
					. ',' . sprintf( '%s %s', $user->get_first_name(), $user->get_last_name() );
		
		// Store this action in activity history
		modules::run( 'activity/_log_action', $this->logtrino_user->get_id(), $activity_text, $activity_html, $params );

		// Redirect back
		redirect( 'users/profile/' . $user->get_id() . '/' . $user->get_username() );
		exit();
	}

	/**
	 * Change a supplier as potential supplier
	 *
	 * @access public
	 * @return void
	 */
	function potential_supplier( $supplier_id ) {
		// Check user can do that action
		if( !$this->logtrino_uac->_run( 'change_supplier_status' ) ) {
			redirect( 'users/profile/' . $this->logtrino_user->get_id() . '/' . $this->logtrino_user->get_username() );
			return false;
		}

		// Get the user
		$user = new logtrino_user( intval( $supplier_id ) );

		if( empty( $user ) || $user->get_id() == null || $user->get_role_id() == 1 ) {
			// Not allow to do that
			redirect( 'users/profile/' . $this->logtrino_user->get_id() . '/' . $this->logtrino_user->get_username() );
			return false;
		}

		// Update the supplier status
		$this->users_model->change_translator_status( intval( $supplier_id ), 3 );

		// Notify user
		echo modules::run( 'notifications/_potential_supplier', $user );

		// Log this action in user activity log
		$io_messages = $this->config->item( 'io_messages' );
		$activity_text = $io_messages['activity_log']['potential_supplier']['text'];
		$activity_html = $io_messages['activity_log']['potential_supplier']['html'];

		$params = site_url( 'users/profile/' . $this->logtrino_user->get_id() . '/' 
					. $this->logtrino_user->get_username() ) 
					. ',' 
					. sprintf( '%s %s', $this->logtrino_user->get_first_name(), $this->logtrino_user->get_last_name() ) 
					. ',' 
					. site_url( 'users/profile/' . $user->get_id() . '/' . $user->get_username() )
					. ',' . sprintf( '%s %s', $user->get_first_name(), $user->get_last_name() );
		
		// Store this action in activity history
		modules::run( 'activity/_log_action', $this->logtrino_user->get_id(), $activity_text, $activity_html, $params );

		// Redirect back
		redirect( 'users/profile/' . $user->get_id() . '/' . $user->get_username() );
		exit();
	}

	/**
	 * Display 404 page of users
	 *
	 * @access public
	 * @return mixed
	 */
	function user_not_found() {
		$this->logtrino_ui->_set_title( 'Error: 404 - User not found');
		$this->logtrino_ui->_set_view( 'admin/404' );
		$this->logtrino_ui->_render();
	}

	/**
	 * Custom 404 page not found
	 * This method redirect to default action if 404 is occurred and avoiding illegal access.
	 *
	 * @access public
	 * @return void
	 */
	function show_404( $title = '', $message_header = '' ) {
		$CI =& get_instance();
		
		// Set header
		$CI->output->set_header( '404' );
		$CI->output->set_status_header( '404' );

		// Prepare data
		if( '' == $title ) { 
			$title = 'Page Not Found'; 
		}

		if( '' == $message_header ) {
			$message_header = 'The page you requested not found.';
		}

		$data = array(
			'message_header' => $message_header
		);

		// Prepare UI
		$CI->logtrino_ui->_set_title( $title );
		$CI->logtrino_ui->_set_view( '404' );
		$CI->logtrino_ui->_set_data( $data );

		// Render UI
		$CI->logtrino_ui->_render();
	}
}

/* End */
/* Location: `application/modules/users/controllers/users.php` */