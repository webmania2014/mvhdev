<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Users Model
 * Business model of users module to manage CRUD operations between application layer and business layer
 *
 * @package     CodeIgniter 2.2.0
 
 * @module      users_module
 * @model       users_model
 *
 * @ create_user()
 * @ assign_user_role()
 * @ create_translator()
 * @ update_user()
 * @ delete_user()
 * @ get_user_by_id()
 * @ get_user_by_username()
 * @ get_user_password()
 * @ get_user_activation_code()
 * @ get_user_password_reset_code()
 * @ get_user_by_email()
 * @ get_user_by_activation_code()
 * @ get_user_by_password_reset_code()
 * @ get_users()
 * @ get_admin_users()
 * @ get_user_roles()
 * @ get_applicant_types()
 * @ get_applicant_type_by_id()
 * @ get_applicant_type_ids()
 * @ get_applicant_statuses()
 * @ get_applicant_status_by_id()
 * @ get_applicant_status_ids()
 * @ update_username()
 * @ update_password()
 * @ activate_user()
 * @ get_users_by_role()
 * @ get_users_by_type()
 * @ get_users_by_status()
 * @ update_translator()
 * @ update_translator_status()
 * @ update_translator_type()
 * @ update_contact_type()
 * @ get_translators()
 * @ get_translators_by_type()
 * @ get_translators_by_status()
 * @ get_translator_search_results()
 * @ get_users_search_result()
 * @ get_user_search_results()
 * @ create_user_emails()
 * @ create_user_primary_email()
 * @ update_user_emails()
 * @ change_user_primary_email()
 * @ update_user_primary_email()
 * @ get_user_primary_email()
 * @ get_user_emails()
 * @ delete_user_email()
 * @ create_user_addresses()
 * @ create_user_primary_address()
 * @ update_user_addresses()
 * @ change_user_primary_address()
 * @ update_user_primary_address()
 * @ get_user_primary_address()
 * @ get_user_addresses()
 * @ delete_user_address()
 * @ create_user_primary_telephone()
 * @ update_user_telephones()
 * @ change_user_primary_telephone()
 * @ update_user_primary_telephone()
 * @ get_user_primary_telephone()
 * @ get_user_telephones()
 * @ delete_user_telephone()
 * @ create_user_password_reset_code()
 * @ create_activation_code()
 * @ change_translator_status()
 * @ update_personal_info()
 * @ create_user_contact()
 * @ update_user_contact()
 * @ update_company_info()
 * @ update_translation_info()
 * @ update_bank_information()
 * @ create_translation_charge()
 * @ get_translation_charge_by_id()
 * @ get_translation_charges()
 * @ delete_translation_charge()
 * @ create_interpreting_charge()
 * @ get_interpreting_charge_by_id()
 * @ get_interpreting_charges()
 * @ delete_interpreting_charge()
 * @ create_post_editing_charge()
 * @ get_post_editing_charge_by_id()
 * @ get_post_editing_charges()
 * @ delete_post_editing_charge()
 * @ create_proof_reading_charge()
 * @ get_proof_reading_charge_by_id()
 * @ get_proof_reading_charges()
 * @ delete_proof_reading_charge()
 * @ create_absence()
 * @ get_absence_by_id()
 * @ get_absences()
 * @ delete_absence()
 * @ update_supplier_softwares()
 * @ update_supplier_bio()
 * @ update_profile_picture()
 * @ update_translator_info()
 * @ create_batch_translation_info()
 * @ create_batch_interpreting_info()
 * @ update_user_display_name()
 * @ update_translator_fields_of_expertise()
 * @ get_supplier_projects()
 * @ get_supplier_project()
 * @ search_supplier_projects()
 * @ get_supplier_invoices()
 * @ get_supplier_invoice()
 */

class Users_model extends CI_Model {

	public $table = 'users';

	/**
	 * Create a new user
	 *
	 * @access public
	 * @param  (string) $first_name First name of user
	 * @param  (string) $last_name Last name of user
	 * @param  (string) $username Username of user
	 * @param  (string) $email Email address of user
	 * @param  (string) $password User's password. *** Do not store as plain text
	 * @param  (string) $activation_code Activation code for user to activate account
	 * @return (bool) TRUE if user created successfully, otherwise FALSE
	 */
	function create_user( $first_name, $last_name, $username, $email, $password, $active = '0', $activation_code = null) {
		// Prepare data for columns
		$data = array(
			'first_name'      => $first_name,
			'last_name'       => $last_name,
			'username'        => $username,
			'password'        => $password,
			'is_activated'    => $active,
			'activation_code' => $activation_code,
			'registered_date' => date('Y-m-d H:i:s', time() ),

			'guid'            => generate_guid()
		);
	
		// Insert new user
		$this->db->insert( $this->db->dbprefix( 'users' ), $data );

		// New user's ID
		$user_id = $this->db->insert_id();

		// Insert email for new user
		$this->db->insert( $this->db->dbprefix( 'user_contact' ), array( 'email_address' => $email, 'user_id' => $user_id ) );
		
		// Check data is entered correctly
		return $user_id;
		//return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Assign role to a user
	 *
	 * @access public
	 * @param  (int) $user_id User's ID to assign role
	 * @param  (int) $role_id Role's ID to assign to user
	 *         System currently has two roles: 1. Administrator 2. Supplier
	 * @return (bool) TRUE if user assigned role successfully, otherwise FALSE
	 */
	function assign_user_role( $user_id, $role_id = 1 ) {
		// Prepare data
		$data = array(
			'user_id' => $user_id,
			'role_id' => $role_id
		);

		// Assign user role
		$this->db->insert( $this->db->dbprefix( 'user_role'), $data );

		// Check user role assigned
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0; 
	}
    
    function get_all_users(){
        $sql = 'select * from ltno_users where is_activated = 1';
        $result = $this->db->query($sql);
        return $result->result();
    }

	/**
	 * Create a translator
	 *
	 * @access public
	 * @param  (id) $user_id Users' ID who works as translator
	 * @param  (int) $status Translator's status. Translator has four different status:
	 *               1. Accepted 2. Applicant 3. Potential 4. Rejected
	 * @param  (int) $type Translator's type. Translator has four different types:
	 *               1. Individual Translator 2. Translation Company 3. DTP Specialist 4. Other
	 * @param  (string) $company Company name that translator belongs to
	 * @param  (int) $native_lang Language ID
	 * @return (bool) TRUE if translator created successfully, otherwise FALSE
	 */
	function create_translator( $user_id, $status, $type, $company = '', $native_lang = 1 ) {
		// Prepare data for columns
		$data = array(
			'user_id'      	=> $user_id,
			'status'       	=> $status,
			'type'         	=> $type,
			'company'      	=> $company,
			'native_lang'   => $native_lang
		);
		
		// Insert new user
		$this->db->insert( $this->db->dbprefix( 'translators' ), $data );
		
		// Check data is entered correctly
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update a translator
	 *
	 * @access public
	 * @param  (id) $user_id Users' ID of translator to update
	 * @param  (string) $fist_name First name of translator
	 * @param  (string) $last_name Last name of translator
	 * @param  (int) $status Status of translator. Translator have four differen status:
	 *               1. Accepted 2. Applicant 3. Potential 4. Rejected
	 * @param  (int) $type Translator's type. Translator have four different types:
	 *               1. Individual Translator 2. Translation Company 3. DTP Specialist 4. Other
	 * @param  (string) $company Company name that translator belongs to
	 * @param  (string) $year_of_graduation The yeare of translator graduation. Only year will be stored as ISO date format
	 *                  Eg. 2014
	 * @param  (string) $start_time_as_translator The date when the translator start his translation
	 * @param  (string) $start_time_as_interpreter The date when the translator start his interpretion
	 * @param  (float) $minimum_fee Minimum fee translator earn
	 * @param  (string) $rates Rate of translator. Eg. Hourly
	 * @param  (int) $certifications Translator got certifications
	 * @param  (string) $native_lang Language that translator uses
	 * @param  (text) $notes Notes for translator
	 * @return (bool) TRUE if translator updated successfully, otherwise FALSE
	 */
	function update_translator( $user_id, $status, $type, $company_name, 
								$year_of_graduation, $start_time_as_translator, $start_time_as_interpreter, 
								$minimum_fee, $rates, $certifications, $software, $native_lang, $notes ) {

		// Update user first
		if( $this->update_user( $user_id, $first_name, $last_name ) ) {
			// Prepare data
			$data = array(
				'user_id'      				=> $user_id,
				'status'       				=> $status,
				'type'         				=> $type,
				'company'      				=> $company_name,
				'year_of_graduation' 		=> $year_of_graduation,
				'start_time_as_translator' 	=> $start_time_as_translator,
				'start_time_as_interpreter'	=> $start_time_as_interpreter,
				'minimum_fee'				=> $minimum_fee,
				'rates'						=> $rates,
				'certifications'		    => $certifications,
				'native_lang'				=> $native_lang,
				'notes'						=> $notes
			);

			// Update data
			$this->db->where( 'user_id', $user_id );
			$this->db->update( $this->db->dbprefix( 'translators' ), $data );

			// Check data is updated or not
			return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
		}

		return false;
	}

	/**
	 * Update a user
	 * 
	 * @access public
	 * @param  (int) $user_id ID of user to update
	 * @param  (string) $first_name New first name of user
	 * @param  (string) $last_name New last name of user
	 * @param  (string) $username Username of user
	 * @param  (string) $email Email address
	 * @param  (string) $job_title Job title of user
	 * @param  (int) $active Status code of user determine user is active or inactive
	 * @param  (string) $password (Optional) Users' password. *** Do not store as plain text.
	 * @return (bool) TRUE if user updated successfully, otherwise FALSE
	 */
	function update_user( $user_id, $first_name, $last_name, $username, $email, $job_title = '', $active = '1', $password = '', $application_status ) {
		// Prepare data for columns
		$data = array(
			'first_name'	 => $first_name,
			'last_name'	     => $last_name,
			'username'       => $username,
			'job_title'      => $job_title,
			'is_activated'   => $active,
			'updated_date'   => date( 'Y-m-d H:i:s', time() ),
		);

		// If password provided, update as well
		if( '' != $password ) {
			$data['password'] = $password;
		}
		/*
		$status = array(
            'status' => $application_status,
        );*/

		// Find and update user data        
		$this->db->where( 'id', $user_id );
		$this->db->update( $this->db->dbprefix( 'users' ), $data );
        //$this->db->where( 'id', $user_id );
        //$this->db->update( $this->db->dbprefix( 'translators' ), $status );

        // Update email address
        $this->db->where( 'user_id', $user_id );
        $this->db->update( $this->db->dbprefix( 'user_contact' ), array( 'email_address' => $email ) );

		// Check user is updated successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Delete a user
	 * 
	 * @access public
	 * @param  (int) $user_id ID of user to update
	 * @return (bool) TRUE if user deleted successfully, otherwise FALSE
	 */
	function delete_user( $user_id ) {
		// Find and update user data
		$this->db->where( 'id', $user_id );
		$this->db->delete( $this->db->dbprefix( 'users' ) );

		// Check user is deleted successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Get a user by user's ID
	 *
	 * @access public
	 * @param  (int) $user_id User's ID to find the user
	 * @return (object) Users' object
	 */
	function get_user_by_id( $user_id ) {
		// Prepare query
		$sel = "u.id, u.guid, u.first_name, u.last_name, u.username, 
				u.password_reset_time, u.is_activated, 
				u.registered_date, u.updated_date, u.last_logged_in_time, u.is_admin, u.job_title,
			
				e.email_address,";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'users' ) . ' AS u' );
		//$this->db->join( $this->db->dbprefix( 'user_role' ) . ' AS o', 'o.user_id = u.id', 'left' );
		//$this->db->join( $this->db->dbprefix( 'user_roles' ) . ' AS r', 'r.id = o.role_id', 'left' );
		//$this->db->join( $this->db->dbprefix( 'user_emails' ) . ' AS e', 'e.user_id = u.id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_contact' ) . ' AS e', 'e.user_id = u.id', 'left' );
		//$this->db->join( $this->db->dbprefix( 'user_addresses' ) . ' AS a', 'a.user_id = u.id AND a.is_primary = true', 'left' );
		//$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS l', 'l.id = u.language', 'left' );
		$this->db->select( $sel, false );
		$this->db->where( 'u.id', $user_id );
		$this->db->limit( 1 );

		$query = $this->db->get();

		return $query->row();
	}

    /**
	 * check a user is admin
	 *
	 * @access public
	 * @param  (string) $user_id 
	 * @return (object) Users' object
	 */
     function check_user_is_admin($user_id){
        $sel = "u.id, u.is_admin";
        $this->db->select( $sel, false );
		$this->db->from(  'ltno_users'  . ' AS u' );
        $this->db->where( 'u.id', $user_id );
        $query = $this->db->get();
		$user = $query->row();
        if($user->is_admin == 1){
            return true;
        }else{
            return false;
        }
     }
	/**
	 * Get a user by username
	 *
	 * @access public
	 * @param  (string) $username Username to find the user
	 * @return (object) Users' object
	 */
	function get_user_by_username( $username ) {
		// Prepare query
		$sel = "u.id, u.first_name, u.last_name, u.username, u.is_admin";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'users' ) . ' AS u' );

		$this->db->where( 'u.username', $username );
		$this->db->limit( 1 );

		$query = $this->db->get();
	
		return $query->row();
	}

	/**
	 * Get password of user
	 *
	 * @access public
	 * @param  (int) $user_id User's ID to find the password
	 * @return (string) Encrypted password of a user 
	 */
	function get_user_password( $user_id ) {
		// Prepare query
		$sel = "u.password";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'users' ) . ' AS u' );
		$this->db->where( 'u.id', $user_id );
		$this->db->limit( 1 );

		$query = $this->db->get();
		
		$user_data = $query->row();

		// Return password
		return $user_data->password;
	}

	/**
	 * Get activation code of user
	 *
	 * @access public
	 * @param  (int) $user_id Users' ID to get the activation code
	 * @return (string) Encrypted string of activation code if exists, otherwise null
	 */
	function get_user_activation_code( $user_id ) {
		// Prepare query
		$this->db->where( 'id', $user_id );
		$this->db->limit( 1 );

		// Get the result
		$query = $this->db->get( $this->db->dbprefix( 'users' ) );

		$row = $query->row();

		return ( $row->activation_code ) ? $row->activation_code : null;
	}

	/**
	 * Get password reset code of user
	 *
	 * @access public
	 * @param  (int) $user_id Users' ID to get the activation code
	 * @return (string) Encrypted string of password reset code if exists, otherwise null
	 */
	function get_user_password_reset_code( $user_id ) {
		// Prepare query
		$this->db->where( 'id', $user_id );
		$this->db->limit( 1 );

		// Get the result
		$query = $this->db->get( $this->db->dbprefix( 'users' ) );

		$row = $query->row();

		return ( $row->password_reset_code ) ? $row->password_reset_code : null;
	}

	/**
	 * Get a user by email address
	 *
	 * @access public
	 * @param  (string) $email Email address to find the user
	 * @return (object) Users' object
	 */
	function get_user_by_email( $email ) {
		// Prepare query
		$sel = "u.id, u.guid, u.first_name, u.last_name, u.username, 
				u.password_reset_time, u.is_activated, 
				u.registered_date, u.updated_date, u.last_logged_in_time, 
			
				e.email_address,";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'users' ) . ' AS u' );
		//$this->db->join( $this->db->dbprefix( 'user_role' ) . ' AS o', 'o.user_id = u.id', 'left' );
		//$this->db->join( $this->db->dbprefix( 'user_roles' ) . ' AS r', 'r.id = o.role_id', 'left' );
		//$this->db->join( $this->db->dbprefix( 'user_emails' ) . ' AS e', 'e.user_id = u.id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_contact' ) . ' AS e', 'e.user_id = u.id', 'left' );
		//$this->db->join( $this->db->dbprefix( 'user_addresses' ) . ' AS a', 'a.user_id = u.id AND a.is_primary = true', 'left' );
		//$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS l', 'l.id = u.language', 'left' );

		$this->db->where( 'e.email_address', $email );
		$this->db->limit( 1 );

		$query = $this->db->get();

		return $query->row();
	}

	/**
	 * Get the user by activation code
	 * It's for activating user account after registration
	 * 
	 * @access public
	 * @param  (string) $activation_code Activation code which user has
	 * @return (object) User object
	 */
	function get_user_by_activation_code( $activation_code ) {
		// Prepare query
		$sel = "u.id, u.guid, u.first_name, u.last_name, u.username, 
				u.password_reset_time, u.is_activated, 
				u.registered_date, u.updated_date, u.last_logged_in_time, 
				l.id AS language_id, l.name_en AS language_en, l.name_de AS language_de, 
				u.sex, u.title, u.job_title, 
				r.id AS role_id, r.role_title, r.role_description, 
				e.email_address, a.postal_code, a.city, a.country_code, a.address";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'users' ) . ' AS u' );
		$this->db->join( $this->db->dbprefix( 'user_role' ) . ' AS o', 'o.user_id = u.id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_roles' ) . ' AS r', 'r.id = o.role_id', 'left' );
		//$this->db->join( $this->db->dbprefix( 'user_emails' ) . ' AS e', 'e.user_id = u.id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_contact' ) . ' AS e', 'e.user_id = u.id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_addresses' ) . ' AS a', 'a.user_id = u.id AND a.is_primary = true', 'left' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS l', 'l.id = u.language', 'left' );

		$this->db->where( 'u.activation_code', $activation_code );
		$this->db->limit( 1 );

		$query = $this->db->get();

		return $query->row();
	}

	/**
	 * Get the user by activation code
	 * It's using for resetting user password
	 * 
	 * @access public
	 * @param  (string) $password_reset_code Activation code which user has
	 * @return (object) User object
	 */
	function get_user_by_password_reset_code( $password_reset_code ) {
		// Prepare query
		$sel = "u.id, u.guid, u.first_name, u.last_name, u.username, 
				u.password_reset_time, u.is_activated, 
				u.registered_date, u.updated_date, u.last_logged_in_time";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'users' ) . ' AS u' );

		$this->db->where( 'u.password_reset_code', $password_reset_code );
		$this->db->limit( 1 );

		$query = $this->db->get();

		return $query->row();
	}

	/**
	 * Get users with specific parameters
	 *
	 * @access public
	 * @param  (int) $offset (Optional) Number of row to start read from table
	 * @param  (int) $limit (Optional) Limit of rows to read
	 * @param  (string) $order_by (Optional) Order by with specified column
	 * @param  (string) $order (Optional) Order of reading rows
	 * @return (array) Associative array with overall row numbers and results
	 */
	function get_users( $offset = 0, $limit = 10, $order_by = 'id', $order = 'DESC' ) {
		$sel = "u.id, u.guid, u.first_name, u.last_name, u.username, 
				u.password_reset_time, u.is_activated, 
				u.registered_date, u.updated_date, u.last_logged_in_time, 
				l.id AS language_id, l.name_en AS language_en, l.name_de AS language_de, 
				u.sex, u.title, u.job_title, u.profile_picture, 
				r.id AS role_id, r.role_title, r.role_description, 
				e.email_address, a.postal_code, a.city, a.country_code, a.address";
	
		$this->db->select( $sel, false ); 
		$this->db->from( $this->db->dbprefix( 'users' ) . ' AS u' );
		$this->db->join( $this->db->dbprefix( 'user_role' ) . ' AS o', 'o.user_id = u.id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_roles' ) . ' AS r', 'r.id = o.role_id', 'left' );
		//$this->db->join( $this->db->dbprefix( 'user_emails' ) . ' AS e', 'e.user_id = u.id AND e.is_primary = true', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_contact' ) . ' AS e', 'e.user_id = u.id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_addresses' ) . ' AS a', 'a.user_id = u.id AND a.is_primary = true', 'left' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS l', 'l.id = u.language', 'left' );

		$this->db->order_by( $order_by, $order );
		$this->db->limit( $limit, $offset );
		
		$query = $this->db->get();
		
		// Count all rows and send with result, so pagination can be calculated
		$this->db->select( 'COUNT(id) AS count' );
		$total = $this->db->get( $this->db->dbprefix( 'users' ) );

		// Return results
		$return_results = array( 'total' => $total->row()->count, 'results' => $query->result() );

		return $return_results;
	}

	/**
	 * Get the administrator users of system
	 *
	 * @access public
	 * @param  (int) $offset (Optional) Number of row to start read from table
	 * @param  (int) $limit (Optional) Limit of rows to read
	 * @param  (string) $order_by (Optional) Order by with specified column
	 * @param  (string) $order (Optional) Order of reading rows
	 * @return (array) Associative array with overall row numbers and results
	 */
	function get_admin_users( $offset = 0, $limit = 10, $order_by = 'id', $order = 'DESC' ) {
		$sel = "u.id, u.guid, u.first_name, u.last_name, u.username, 
				u.password_reset_time, u.is_activated, 
				u.registered_date, u.updated_date, u.last_logged_in_time, 
				l.id AS language_id, l.name_en AS language_en, l.name_de AS language_de, 
				u.sex, u.title, u.job_title, u.profile_picture, 
				r.id AS role_id, r.role_title, r.role_description, 
				e.email_address, a.postal_code, a.city, a.country_code, a.address";
	
		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'users' ) . ' AS u' );
		$this->db->join( $this->db->dbprefix( 'user_role' ) . ' AS o', 'o.user_id = u.id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_roles' ) . ' AS r', 'r.id = o.role_id', 'left' );
		//$this->db->join( $this->db->dbprefix( 'user_emails' ) . ' AS e', 'e.user_id = u.id AND e.is_primary = true', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_contact' ) . ' AS e', 'e.user_id = u.id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_addresses' ) . ' AS a', 'a.user_id = u.id AND a.is_primary = true', 'left' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS l', 'l.id = u.language', 'left' );

		$this->db->where_in( 'r.id', '1' );
		$this->db->where_not_in( 'u.id', $this->logtrino_user->get_id() );

		if( $order_by ) {
			if( $order_by == 'status' ) {
				$this->db->order_by( 'aps.status', $order );
			} elseif( $order_by == 'firstname' ) {
				$this->db->order_by( 'u.first_name', $order );
			} elseif( $order_by == 'surname') {
				$this->db->order_by( 'u.last_name', $order );
			} elseif( $order_by == 'company' ) {
				$this->db->order_by( 't.company', $order );
			} elseif( $order_by == 'email' ) {
				$this->db->order_by( 'e.email_address', $order );
			} elseif( $order_by == 'telephone' ) {
				$this->db->order_by( 'p.telephone', $order );
			} elseif( $order_by == 'registered_date') {
				$this->db->order_by( 'u.registered_date', $order );
			} elseif( $order_by == 'logged_out_time' ) {
				$this->db->order_by( 'u.last_logged_in_time', $order );
			} else {
				$this->db->order_by( 'u.id', $order );
			}
		}

		$this->db->limit( $limit, $offset );
		
		$query = $this->db->get();
		
		// Count all rows and send with result, so pagination can be calculated
		$this->db->select( 'COUNT(r.role_id) AS num_rows' );
		$this->db->from(  $this->db->dbprefix( 'user_role' ) . ' AS r' );

		$this->db->where_in( 'r.role_id', '1' );
		$this->db->where_not_in( 'r.user_id', $this->logtrino_user->get_id() );

		$count_query = $this->db->get();

		// Return results
		$return_results = array( 'num_rows' => $count_query->row()->num_rows, 'results' => $query->result() );

		return $return_results;
	}

	/**
	 * Get the administrator users of system
	 *
	 * @access public
	 * @param  (int) $offset (Optional) Number of row to start read from table
	 * @param  (int) $limit (Optional) Limit of rows to read
	 * @param  (string) $order_by (Optional) Order by with specified column
	 * @param  (string) $order (Optional) Order of reading rows
	 * @return (array) Associative array with overall row numbers and results
	 */
	function get_all_admin_ids() {
		$sel = "u.id";
	
		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'users' ) . ' AS u' );
		$this->db->join( $this->db->dbprefix( 'user_role' ) . ' AS o', 'o.user_id = u.id', 'left' );
		$this->db->where_in( 'o.role_id', '1' );

		$this->db->order_by( 'u.id', 'asc' );
		
		$query = $this->db->get();

		return $query->result_array();
	}

	/**
	 * Get user roles defined in system
	 * System currently defined two user roles.
	 * 1) Administrator and 2) Supplier
	 *
	 * @access public
	 * @return (array) Array of user role objects
	 */
	function get_user_roles() {
		// Get user roles from system
		$query = $this->db->get( $this->db->dbprefix( 'user_roles') );

		if( $query->num_rows() > 0 ) {
			foreach( $query->result() as $row ) {
				$user_roles[] = $row;
			}

			return $user_roles;
		}

		return null;
	}

	/**
	 * Get applicant types defined in system
	 * System currently defined 4 different applicant types.
	 * 1) Individual Translator 2) Translation Company 3) DTP Specialist 4) Other
	 *
	 * @access public
	 * @return (array) Array of applicant type objects
	 */
	function get_applicant_types() {
		// Get applicant types
		$query = $this->db->get( $this->db->dbprefix( 'applicant_types' ) );
		return $query->result();
	}

	/**
	 * Get applicant type by it's ID
	 * System currently defined 4 different applicant types.
	 * 1) Individual Translator 2) Translation Company 3) DTP Specialist 4) Other
	 *
	 * @access public
	 * @return (array) Array of applicant type objects
	 */
	function get_applicant_type_by_id( $id = 1 ) {
		// Get applicant types
		$this->db->where( 'id', $id );
		$query = $this->db->get( $this->db->dbprefix( 'applicant_types' ) );
		return $query->row();
	}

	/**
	 * Get ID of applicant types
	 *
	 * @access public
	 * @return (array) Numeric array containing ID of applicant types
	 */
	function get_applicant_type_ids() {
		$this->db->select( 'id' );
		$query = $this->db->get( $this->db->dbprefix( 'applicant_types' ) );

		if( $query->num_rows() > 0 ) {
			foreach( $query->result() as $row ) {
				$applicant_type_ids[] = $row->id;
			}

			return $applicant_type_ids;
		}

		return null;
	}

	/**
	 * Get statues of applicant defined in system
	 * System currently defined 4 different statuses for applicants.
	 * 1) Accepted 2) Applicant 3) Potential 4) Rejected
	 *
	 * @access public
	 * @return (array) Array of applicant status objects
	 */
	function get_applicant_statuses() {
		// Get applicant statuses
		$query = $this->db->get( $this->db->dbprefix( 'applicant_status ') );
		return $query->result();
	}

	/*
	 * Get applicant status by it's ID
	 * System currently defined 4 different statuses for applicants.
	 * 1) Accepted 2) Applicant 3) Potential 4) Rejected
	 *
	 * @access public
	 * @return (array) Array of applicant status objects
	 */
	function get_applicant_status_by_id( $id = 1 ) {
		// Get applicant statuses
		$this->db->where( 'id', $id );
		$query = $this->db->get( $this->db->dbprefix( 'applicant_status ') );
		return $query->row();
	}

	/**
	 * Get ID of applicant statuses
	 * 
	 * @access public
	 * @return (array) Numeric array containing ID of applicant statuses
	 */
	function get_applicant_status_ids() {
		$query = $this->db->get( $this->db->dbprefix( 'applicant_status' ) );

		if( $query->num_rows() > 0 ) {
			foreach( $query->result() as $row ) {
				$applicant_status_ids[] = $row->id;
			}

			return $applicant_status_ids;
		}

		return null;
	}

	/**
	 * Update username for a user
	 * 
	 * @access public
	 * @param  (int) $user_id ID of user whose password to update
	 * @param  (string) $username New username of user
	 * @return TRUE if username updated successfully, otherwise FALSE
	 */
	function update_username( $user_id, $username ) {
		// Prepare data for columns
		$data = array( 'username' => $username );
		
		// Find and update user data
		$this->db->where( 'id', $user_id );
		$this->db->update( $this->db->dbprefix( 'users' ), $data );

		// Check user is updated successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update password of user
	 * 
	 * @access public
	 * @param  (int) $user_id ID of user whose password to update
	 * @param  (string) $password New password of user
	 * @return TRUE if password updated successfully, otherwise FALSE
	 */
	function update_password( $user_id, $password ) {
		// Prepare data for columns
		$data = array( 
			'password'            => $password,
			'password_reset_code' => null
		);
		
		// Find and update user data
		$this->db->where( 'id', $user_id );
		$this->db->update( $this->db->dbprefix( 'users' ), $data );

		// Check user is updated successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Activate user with activation code
	 *
	 * @access public
	 * @param  (int) $user_id Users' ID to activate
	 * @param  (string) $activation_code (Optional) Activation code that user belongs
	 *          If it's not false, and we've to update also where the user has same
	 *          activation code. This is likely user is activating their account
	 *          with activation code from a link provided in the email.
	 * @return (bool) TRUE if process success, otherwise FALSE
	 */
	function activate_user( $user_id, $is_activate = '1', $activation_code = false ) {
		// Prepare data
		$data = array( 
			'is_activated'    => $is_activate,
			'activation_code' => ''
		);

		// Update activate status
		$this->db->where( 'id', $user_id );

		// If user is activating from email with code
		if( $activation_code !== false ) {
			$this->db->where( 'activation_code', $activation_code );	
		}
		
		// Activate a user
		$this->db->update( $this->db->dbprefix( 'users' ), $data );

		// Check updated successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Get the users by specific role.
	 * System currently has two role types. Administrator, represents with ID 1 and 
	 * Supplier represents with ID 2.
	 *
	 * @access public
	 * @param  (int) $role_id (Optional) Role's ID represents the role
	 * @param  (int) $offset (Optional) Number of row to start read from table
	 * @param  (int) $limit (Optional) Limit of rows to read
	 * @param  (string) $order_by (Optional) Order by with specified column
	 * @param  (string) $order (Optional) Order of reading rows
	 * @return (array) Associative array with overall row numbers and results
	 */
	function get_users_by_role( $role_id = 1, $offset = 0, $limit = 10, $order_by = 'id', $order = 'DESC' ) {
		// Prepare query
		$select = "SELECT u.id, u.guid, u.first_name, u.last_name, u.username, 
			 	u.password_reset_time, u.is_activated, 
			 	u.registered_date, u.updated_date, u.last_logged_in_time, 
			 	r.role_title, r.role_description";

		$select2 = "SELECT COUNT(u.id) AS count";

		$from = sprintf( " FROM %s AS u, %s AS o", $this->db->dbprefix( 'users' ), $this->db->dbprefix( 'user_role' ) );

		//$join = sprintf( " LEFT JOIN %s AS o ON o.user_id = u.id", $this->db->dbprefix( 'user_role' ) );
		$join = sprintf( " LEFT JOIN %s AS r ON r.id = o.role_id", $this->db->dbprefix( 'user_roles' ) );

		$where = " WHERE o.role_id = ? AND u.id = o.user_id";

		$order_by = sprintf( " ORDER BY %s %s", $order_by, $order );
		$end = sprintf( " LIMIT %d OFFSET %d", $limit, $offset );

		// Query actual results with limit
		$sql1 = $select . $from . $join . $where . $order_by . $end;
		$query = $this->db->query( $sql1, array( $role_id ) );
		
		// This query get all founded rows to calculate total row numbers
		$sql2 = $select2 . $from . $join . $where;
		$total = $this->db->query( $sql2, array( $role_id ) );

		// Return results
		$return_results = array( 'total' => $total->row()->count, 'results' => array() );

		if( $query->num_rows() > 0 ) {
			$return_results['results'] = $query->result();
		}

		return $return_results;
	}

	/**
	 * Get the users by specific contact type.
	 * System currently four different contact types stores in `applicant_types` table
	 * 1. Individual Translator ( Represents with ID number 1 )
	 * 2. Translation Company ( Represents with ID number 2 )
	 * 3. DTP Specialist ( Represents with ID number 3 )
	 * 4. Other ( Represents with ID number 4 )
	 *
	 * @access public
	 * @param  (int) $type_id (Optional) Contact type's ID to find corrpesponding users
	 * @param  (int) $offset (Optional) Number of row to start read from table
	 * @param  (int) $limit (Optional) Limit of rows to read
	 * @param  (string) $order_by (Optional) Order by with specified column
	 * @param  (string) $order (Optional) Order of reading rows
	 * @return (array) Associative array with overall row numbers and results
	 */
	function get_users_by_type( $type_id = 1, $offset = 0, $limit = 10, $order_by = 'id', $order = 'DESC' ) {
		// Prepare query
		$select = "SELECT u.id, u.guid, u.first_name, u.last_name, u.username, 
			 	u.password_reset_time, u.is_activated, 
			 	u.registered_date, u.updated_date, u.last_logged_in_time";

		$select2 = "SELECT COUNT(u.id) AS count";

		$from = sprintf( " FROM %s AS t, %s AS u", $this->db->dbprefix( 'translators' ), $this->db->dbprefix( 'users' ) );

		$where = " WHERE t.type = ? AND t.user_id = u.id";

		$order_by = sprintf( " ORDER BY %s %s", $order_by, $order );
		$end = sprintf( " LIMIT %d OFFSET %d", $limit, $offset );

		// Query actual results with limit
		$sql1 = $select . $from . $where . $order_by . $end;
		$query = $this->db->query( $sql1, array( $type_id ) );
		
		// This query get all founded rows to calculate total row numbers
		$sql2 = $select2 . $from . $where;
		$total = $this->db->query( $sql2, array( $type_id ) );

		// Return results
		$return_results = array( 'total' => $total->row()->count, 'results' => array() );

		if( $query->num_rows() > 0 ) {
			$return_results['results'] = $query->result();
		}

		return $return_results;
	}

	/**
	 * Get the users by specific status.
	 * System currently four different statuses stores in `applicant_status` table
	 * 1. Accepted ( Represents with ID number 1 )
	 * 2. Applicant ( Represents with ID number 2 )
	 * 3. Potential ( Represents with ID number 3 )
	 * 4. Rejected ( Represents with ID number 4 )
	 *
	 * @access public
	 * @param  (int) $status_id (Optional) Status's ID to find corrpesponding users
	 * @param  (int) $offset (Optional) Number of row to start read from table
	 * @param  (int) $limit (Optional) Limit of rows to read
	 * @param  (string) $order_by (Optional) Order by with specified column
	 * @param  (string) $order (Optional) Order of reading rows
	 * @return (array) Associative array with overall row numbers and results
	 */
	function get_users_by_status( $status_id = 1, $offset = 0, $limit = 10, $order_by = 'id', $order = 'DESC' ) {
		// Prepare query
		$select = "SELECT u.id, u.guid, u.first_name, u.last_name, u.username, 
			 	u.password_reset_time, u.is_activated, 
			 	u.registered_date, u.updated_date, u.last_logged_in_time";

		$select2 = "SELECT COUNT(u.id) AS count";

		$from = sprintf( " FROM %s AS t, %s AS u", $this->db->dbprefix( 'translators' ), $this->db->dbprefix( 'users' ) );

		$where = " WHERE t.status = ? AND t.user_id = u.id";

		$order_by = sprintf( " ORDER BY %s %s", $order_by, $order );
		$end = sprintf( " LIMIT %d OFFSET %d", $limit, $offset );

		// Query actual results with limit
		$sql1 = $select . $from . $where . $order_by . $end;
		$query = $this->db->query( $sql1, array( $status_id ) );
		
		// This query get all founded rows to calculate total row numbers
		$sql2 = $select2 . $from . $where;
		$total = $this->db->query( $sql2, array( $status_id ) );

		// Return results
		$return_results = array( 'total' => $total->row()->count, 'results' => array() );

		if( $query->num_rows() > 0 ) {
			$return_results['results'] = $query->result();
		}

		return $return_results;
	}

	/**
	 * Update a status for a translator
	 * 
	 * @access public
	 * @param  (int) $user_id ID of translator to update
	 * @param  (int) $status_id Status's ID of translator
	 * @return (bool) TRUE if translator's status updated successfully, otherwise FALSE
	 */
	function update_translator_status( $user_id, $status_id ) {
		// Prepare data for columns
		$data = array( 'status'   => $status_id );

		if( $status_id == 1 ) {
			// Status 1 is accepted, accepted data also has to update
			$data['accepted_date'] = date( 'Y-m-d H:i:s', time() );
		}

		// Find and update user data
		$this->db->where( 'user_id', $user_id );
		$this->db->update( $this->db->dbprefix( 'translators' ), $data );

		// Check user is updated successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update a type for a translator
	 * 
	 * @access public
	 * @param  (int) $user_id ID of translator to update
	 * @param  (int) $type_id Type's ID of translator
	 * @return (bool) TRUE if translator's type updated successfully, otherwise FALSE
	 */
	function update_translator_type( $user_id, $type_id ) {
		// Prepare data for columns
		$data = array( 'type'   => $type_id );

		// Find and update user data
		$this->db->where( 'user_id', $user_id );
		$this->db->update( $this->db->dbprefix( 'translators' ), $data );

		// Check user is updated successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update contact type for a user
	 * 
	 * @access public
	 * @param  (int) $user_id ID of user to update
	 * @param  (int) $type_id Contact types's ID
	 * @return (bool) TRUE if contact type updated successfully, otherwise FALSE
	 */
	function update_contact_type( $user_id, $type_id ) {
		// Prepare data for columns
		$data = array( 'type'  => $type_id );

		// Find and update user data
		$this->db->where( 'user_id', $user_id );
		$this->db->update( $this->db->dbprefix( 'translators' ), $data );

		// Check user is updated successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Get the translators searching by specific filter parameters.
	 *
	 * @access public
	 * @param  (int) $type_id Type's ID to find corresponding users
	 * @param  (int) $status_id Status's ID to find corrpesponding users
	 * @param  (int) $offset Number of row to start read from table
	 * @param  (int) $limit (Optional) Limit of rows to read
	 * @param  (string) $order_by (Optional) Order by with specified column
	 * @param  (string) $order (Optional) Order of reading rows
	 * @return (array) Associative array with overall row numbers and results
	 */
	function get_translator_search_results( $type_id, $status_id, $native_lang, $offset = 0, $limit = 10, 
											$order_by = 'id', $order = 'ASC' ) {

	}

	function get_users_search_result( $role = 1, $status = false, $type = false, $filter = 'firstname', $q = '', $offset = 0, $limit = 10, $order_by = 'id', $order = 'DESC' ) {
		// Prepare query
		$sel = "u.id, u.guid, u.first_name, u.last_name, u.username, u.password_reset_time, 
				u.is_activated, u.registered_date, u.updated_date, u.last_logged_in_time";

		$join = " LEFT JOIN " . $this->db->dbprefix( 'user_role' )
				. " AS o ON o.user_id = u.id"
				. " LEFT JOIN " . $this->db->dbprefix( 'user_roles' )
				. " AS r ON r.id = o.role_id"
				. " LEFT JOIN " . $this->db->dbprefix('user_contact' )
				. " AS e ON e.user_id = u.id"
				. " LEFT JOIN " . $this->db->dbprefix( 'user_addresses' )
				. " AS a ON a.user_id = u.id AND a.is_primary::bool = TRUE"
				. " LEFT JOIN " . $this->db->dbprefix( 'countries' )
				. " AS c ON c.iso_country_code = a.country_code"
				. " LEFT JOIN " . $this->db->dbprefix( 'languages' )
				. " AS l ON l.id = u.language";

		$where_concat = '';

		if( $role != 1 ) {
			$sel .= ", t.company, t.year_of_graduation, t.type AS type_id, t.status AS status_id, 
					apt.type AS applicant_type, aps.status AS applicant_status, 
					t.start_time_as_translator, t.start_time_as_interpreter, t.minimum_fee, 
					t.rates, t.certification, t.revision, t.subject_check, t.software, 
					t.native_lang, t.accepted_date, t.notes, t.legal_form, t.tax_number, 
					t.foundation_year, t.iso_9001, t.certifications, t.sworn_translations::int, t.reviews::int";

			$join .= " LEFT JOIN " . $this->db->dbprefix( 'translators' )
					. " AS t on t.user_id = u.id"
					. " LEFT JOIN " . $this->db->dbprefix( 'applicant_status' )
					. " AS aps ON aps.id = t.status"
					. " LEFT JOIN " . $this->db->dbprefix( 'applicant_types' )
					. " AS apt ON apt.id = t.type";

			if( $status !== FALSE && $status != '' ) {
				$where_concat = " AND t.status = " . $status;
			}

			if( $type !== FALSE && $type != '' ) {
				$where_concat = " AND t.type = " . $type;
			}
		}

		$where = " WHERE o.role_id = " . $role;

		$like = '';

		if( '' != $q ) {
			if( $filter == 'firstname' ) {
				$like = " AND u.first_name LIKE '%" . $q . "%'";
			} elseif( $filter == 'lastname') {
				$like = " AND u.last_name LIKE '%" . $q . "%'";
			} elseif( $filter == 'email' ) {
				$like = " AND e.email_address LIKE '%" . $q . "%'";
			} elseif( $filter == 'country' ) {
				$like = " AND c.name LIKE '%" . $q . "%'";
			} elseif( $filter == 'company' ) {
				if( $role != 1 ) {
					$like = " AND t.company LIKE '%" . $q . "%'";
				}
			} else {
				$like = " AND (u.first_name LIKE '%" . $q . "%'"
					. " OR u.last_name LIKE '%" . $q . "%')";
			}
		}

		if( $order_by ) {
			if( $role != 1 && $order_by == 'status' ) {
				$order_by = " ORDER BY aps.status";
			} elseif( $role != 1 && $order_by == 'applicant_type' ) {
				$order_by = " ORDER BY apt.type";
			} elseif( $order_by == 'firstname' ) {
				$order_by = " ORDER BY u.first_name";
			} elseif( $order_by == 'surname') {
				$order_by = " ORDER BY u.last_name";
			} elseif( $order_by == 'company' ) {
				$order_by = " ORDER BY t.company";
			} elseif( $order_by == 'email' ) {
				$order_by = " ORDER BY e.email_address";
			} elseif( $order_by == 'telephone' ) {
				$order_by = " ORDER BY e.telephone_number";
			} elseif( $order_by == 'country') {
				$order_by = " ORDER BY c.name";
			} elseif( $order_by == 'registered_date') {
				$order_by = " ORDER BY u.registered_date";
			} else {
				$order_by = " ORDER BY u.id";
			}
		}
		
		$order_by = $order_by . " " . $order;

		$limit = sprintf( " LIMIT %d OFFSET %d", $limit, $offset );

		// Get actual results
		$select = "SELECT " . $sel . " FROM " . $this->db->dbprefix( $this->table ) . " AS u";

		$select2 = "SELECT COUNT(u.id) AS total FROM " . $this->db->dbprefix( $this->table ) . " AS u";
		
		$query = $this->db->query( $select . $join . $where . $where_concat . $like . $order_by . $limit );

		// To get all results for pagination
		$query2 = $this->db->query( $select2 . $join . $where . $where_concat . $like );
		
		$return = array(
			'results'  => $query->result(),
			'num_rows' => $query2->row()->total
		);

		return $return;
	}

	/**
	 * Get all translators
	 *
	 * @access public
	 * @param  (int) $offset (Optional) Number of row to start read from table
	 * @param  (int) $limit (Optional) Limit of rows to read
	 * @param  (string) $order_by (Optional) Order by with specified column
	 * @param  (string) $order (Optional) Order of reading rows
	 * @return (array) Array of translator objects 
	 */
	function get_translators( $offset = 0, $limit = 10, $order_by = 'id', $order = 'DESC' ) {
		// Prepare query
		$sel = "t.company, t.year_of_graduation, t.type AS type_id, t.status AS status_id, 
				apt.type AS applicant_type, aps.status AS applicant_status,  
				t.start_time_as_translator, t.start_time_as_interpreter, 
				t.minimum_fee, t.rates, t.certification, t.revision, t.subject_check, t.software, 
				t.native_lang, t.accepted_date, t.notes, t.legal_form, t.tax_number, 
				t.foundation_year, t.iso_9001, t.certifications, t.sworn_translations::int, t.reviews::int, 
				u.id, u.guid, u.first_name, u.last_name, u.username, u.is_activated, 
				u.registered_date, u.updated_date, u.last_logged_in_time, 
				l.id AS language_id, l.name_en AS language_en, l.name_de AS language_de, 
				u.sex, u.title, u.job_title, u.profile_picture, 
				e.email_address, e.telephone_number, a.postal_code, a.city, a.country_code, a.address, 
				c.name AS country_name, c.native_name AS country_native_name,  
				r.id AS role_id, r.role_title, r.role_description";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'translators' ) . ' AS t' );
		$this->db->join( $this->db->dbprefix( 'users' ) . ' AS u', 'u.id = t.user_id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_role' ) . ' AS o', 'o.user_id = u.id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_roles' ) . ' AS r', 'r.id = o.role_id', 'left' );
		//$this->db->join( $this->db->dbprefix( 'user_emails' ) . ' AS e', 'e.user_id = u.id AND e.is_primary = true', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_contact' ) . ' AS e', 'e.user_id = u.id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_addresses' ) . ' AS a', 'a.user_id = u.id AND a.is_primary = true', 'left' );
		//$this->db->join( $this->db->dbprefix( 'user_telephones' ) . ' AS p', 'p.user_id = u.id AND p.is_primary = true', 'left' );
		$this->db->join( $this->db->dbprefix( 'countries' ) . ' AS c', 'c.iso_country_code = a.country_code', 'left' );
		$this->db->join( $this->db->dbprefix( 'applicant_types' ) . ' AS apt', 'apt.id = t.type', 'left' );
		$this->db->join( $this->db->dbprefix( 'applicant_status' ) . ' AS aps', 'aps.id = t.status', 'left' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS l', 'l.id = u.language', 'left' );

		$this->db->limit( $limit, $offset );

		if( $order_by ) {
			if( $order_by == 'status' ) {
				$this->db->order_by( 'aps.status', $order );
			} elseif( $order_by == 'firstname' ) {
				$this->db->order_by( 'u.first_name', $order );
			} elseif( $order_by == 'surname') {
				$this->db->order_by( 'u.last_name', $order );
			} elseif( $order_by == 'company' ) {
				$this->db->order_by( 't.company', $order );
			} elseif( $order_by == 'email' ) {
				$this->db->order_by( 'e.email_address', $order );
			} elseif( $order_by == 'telephone' ) {
				$this->db->order_by( 'p.telephone', $order );
			} elseif( $order_by == 'country') {
				$this->db->order_by( 'c.name', $order );
			} elseif( $order_by == 'registered_date') {
				$this->db->order_by( 'u.registered_date', $order );
			} else {
				$this->db->order_by( 'u.id', $order );
			}
		}
		
		// Get the result
		$query = $this->db->get();

		// Select cout all results
		$this->db->select( "COUNT(u.id) AS total", false );
		$this->db->from( $this->db->dbprefix( 'translators' ) . ' AS u' );
		$count_query = $this->db->get();

		// Result
		$result = array( 'results' => $query->result(), 'num_rows' => $count_query->row()->total );

		return $result;
	}

	/**
	 * Get translators by contact type.
	 * System currently has four different contact types.
	 * 1. Individual Translator 2. Translation Company 3. DTP Specialist 4. Other
	 *
	 * @access public
	 * @param  (int) $type_id ID of contact type to find the translators
	 * @param  (int) $offset (Optional) Number of row to start read from table
	 * @param  (int) $limit (Optional) Limit of rows to read
	 * @param  (string) $order_by (Optional) Order by with specified column
	 * @param  (string) $order (Optional) Order of reading rows
	 * @return (array) Array of translator objects
	 */
	function get_translators_by_type( $type_id, $offset = 0, $limit = 10, $order_by = 'id', $order = 'DESC' ) {
		// Prepare query
		$sel = "t.company, t.year_of_graduation, t.type AS type_id, t.status AS status_id, 
				apt.type AS applicant_type, aps.status AS applicant_status,  
				t.start_time_as_translator, t.start_time_as_interpreter, 
				t.minimum_fee, t.rates, t.certification, t.revision, t.subject_check, t.software, 
				t.native_lang, t.accepted_date, t.notes, t.legal_form, t.tax_number, 
				t.foundation_year, t.iso_9001, t.certifications, t.sworn_translations::int, t.reviews::int, 
				u.id, u.guid, u.first_name, u.last_name, u.username, u.is_activated, 
				u.registered_date, u.updated_date, u.last_logged_in_time, 
				l.id AS language_id, l.name_en AS language_en, l.name_de AS language_de, 
				u.sex, u.title, u.job_title, u.profile_picture, 
				e.email_address, e.telephone_number, a.postal_code, a.city, a.country_code, a.address, 
				c.name AS country_name, c.native_name AS country_native_name, 
				r.id AS role_id, r.role_title, r.role_description";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'translators' ) . ' AS t' );
		$this->db->join( $this->db->dbprefix( 'users' ) . ' AS u', 'u.id = t.user_id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_role' ) . ' AS o', 'o.user_id = u.id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_roles' ) . ' AS r', 'r.id = o.role_id', 'left' );
		//$this->db->join( $this->db->dbprefix( 'user_emails' ) . ' AS e', 'e.user_id = u.id AND e.is_primary = true', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_contact' ) . ' AS e', 'e.user_id = u.id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_addresses' ) . ' AS a', 'a.user_id = u.id AND a.is_primary = true', 'left' );
		//$this->db->join( $this->db->dbprefix( 'user_telephones' ) . ' AS p', 'p.user_id = u.id AND p.is_primary = true', 'left' );
		$this->db->join( $this->db->dbprefix( 'countries' ) . ' AS c', 'c.iso_country_code = a.country_code', 'left' );
		$this->db->join( $this->db->dbprefix( 'applicant_types' ) . ' AS apt', 'apt.id = t.type', 'left' );
		$this->db->join( $this->db->dbprefix( 'applicant_status' ) . ' AS aps', 'aps.id = t.status', 'left' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS l', 'l.id = u.language', 'left' );

		$this->db->where( 't.type', $type_id );

		$this->db->limit( $limit, $offset );

		if( $order_by ) {
			if( $order_by == 'status' ) {
				$this->db->order_by( 'aps.status', $order );
			} elseif( $order_by == 'firstname' ) {
				$this->db->order_by( 'u.first_name', $order );
			} elseif( $order_by == 'surname') {
				$this->db->order_by( 'u.last_name', $order );
			} elseif( $order_by == 'company' ) {
				$this->db->order_by( 't.company', $order );
			} elseif( $order_by == 'email' ) {
				$this->db->order_by( 'e.email_address', $order );
			} elseif( $order_by == 'telephone' ) {
				$this->db->order_by( 'e.telephone_number', $order );
			} elseif( $order_by == 'country') {
				$this->db->order_by( 'c.name', $order );
			} elseif( $order_by == 'registered_date') {
				$this->db->order_by( 'u.registered_date', $order );
			} else {
				$this->db->order_by( 'u.id', $order );
			}
		}

		// Get the result
		$query = $this->db->get();

		// Select cout all results
		$this->db->select( "COUNT(u.id) AS total", false );
		$this->db->from( $this->db->dbprefix( 'translators' ) . ' AS u' );
		$this->db->where( 'u.type', $type_id );
		$count_query = $this->db->get();

		// Result
		$result = array( 'results' => $query->result(), 'num_rows' => $count_query->row()->total );

		return $result;
	}

	/**
	 * Get translators by status.
	 * System currently has four different contact types.
	 * 1. Accepted 2. Applicant 3. Potential 4. Rejected
	 *
	 * @access public
	 * @param  (int) $status_id ID of contact type to find the translators
	 * @param  (int) $offset (Optional) Number of row to start read from table
	 * @param  (int) $limit (Optional) Limit of rows to read
	 * @param  (string) $order_by (Optional) Order by with specified column
	 * @param  (string) $order (Optional) Order of reading rows
	 * @return (array) Array of translator objects
	 */
	function get_translators_by_status( $status_id, $offset = 0, $limit = 10, $order_by = 'id', $order = 'DESC' ) {
		// Prepare query
		$sel = "t.company, t.year_of_graduation, t.type AS type_id, t.status AS status_id, 
				apt.type AS applicant_type, aps.status AS applicant_status,  
				t.start_time_as_translator, t.start_time_as_interpreter, 
				t.minimum_fee, t.rates, t.certification, t.revision, t.subject_check, t.software, 
				t.native_lang, t.accepted_date, t.notes, t.legal_form, t.tax_number, 
				t.foundation_year, t.iso_9001, t.certifications, t.sworn_translations::int, t.reviews::int, 
				u.id, u.guid, u.first_name, u.last_name, u.username, u.is_activated, 
				u.registered_date, u.updated_date, u.last_logged_in_time, 
				l.id AS language_id, l.name_en AS language_en, l.name_de AS language_de, 
				u.sex, u.title, u.job_title, u.profile_picture, 
				e.email_address, e.telephone_number, a.postal_code, a.city, a.country_code, a.address,  
				c.name AS country_name, c.native_name AS country_native_name, 
				r.id AS role_id, r.role_title, r.role_description";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'translators' ) . ' AS t' );
		$this->db->join( $this->db->dbprefix( 'users' ) . ' AS u', 'u.id = t.user_id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_role' ) . ' AS o', 'o.user_id = u.id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_roles' ) . ' AS r', 'r.id = o.role_id', 'left' );
		//$this->db->join( $this->db->dbprefix( 'user_emails' ) . ' AS e', 'e.user_id = u.id AND e.is_primary = true', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_contact' ) . ' AS e', 'e.user_id = u.id', 'left' );
		$this->db->join( $this->db->dbprefix( 'user_addresses' ) . ' AS a', 'a.user_id = u.id AND a.is_primary = true', 'left' );
		//$this->db->join( $this->db->dbprefix( 'user_telephones' ) . ' AS p', 'p.user_id = u.id AND p.is_primary = true', 'left' );
		$this->db->join( $this->db->dbprefix( 'countries' ) . ' AS c', 'c.iso_country_code = a.country_code', 'left' );
		$this->db->join( $this->db->dbprefix( 'applicant_types' ) . ' AS apt', 'apt.id = t.type', 'left' );
		$this->db->join( $this->db->dbprefix( 'applicant_status' ) . ' AS aps', 'aps.id = t.status', 'left' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS l', 'l.id = u.language', 'left' );

		$this->db->where( 't.status', $status_id );

		$this->db->limit( $limit, $offset );
		
		if( $order_by ) {
			if( $order_by == 'status' ) {
				$this->db->order_by( 'aps.status', $order );
			} elseif( $order_by == 'applicant_type' ) {
				$this->db->order_by( 'apt.type', $order );
			} elseif( $order_by == 'firstname' ) {
				$this->db->order_by( 'u.first_name', $order );
			} elseif( $order_by == 'surname') {
				$this->db->order_by( 'u.last_name', $order );
			} elseif( $order_by == 'company' ) {
				$this->db->order_by( 't.company', $order );
			} elseif( $order_by == 'email' ) {
				$this->db->order_by( 'e.email_address', $order );
			} elseif( $order_by == 'telephone' ) {
				$this->db->order_by( 'e.telephone_number', $order );
			} elseif( $order_by == 'country') {
				$this->db->order_by( 'c.name', $order );
			} elseif( $order_by == 'registered_date') {
				$this->db->order_by( 'u.registered_date', $order );
			} else {
				$this->db->order_by( 'u.id', $order );
			}
		}

		// Get the result
		$query = $this->db->get();

		// Select cout all results
		$this->db->select( "COUNT(u.id) AS total", false );
		$this->db->from( $this->db->dbprefix( 'translators' ) . ' AS u' );
		$this->db->where( 'u.status', $status_id );
		$count_query = $this->db->get();

		// Result
		$result = array( 'results' => $query->result(), 'num_rows' => $count_query->row()->total );
		
		return $result;
	}

	/**
	 * Get the users searching by specific filter parameters.
	 *
	 * @access public
	 * @param  (int) $role_id Role's ID to find corresponding users
	 * @param  (int) $is_activated Activated / non-activated users
	 * @param  (string) $date Date of user created
	 * @param  (int) $limit (Optional) Limit of rows to read
	 * @param  (string) $order_by (Optional) Order by with specified column
	 * @param  (string) $order (Optional) Order of reading rows
	 * @return (array) Associative array with overall row numbers and results
	 */
	function get_user_search_results( $role, $is_activated, $date, $offset = 0, $limit = 10, $order_by = 'id', $order = 'DESC' ) {

	}

	/**
	 * Create email addresses of user
	 * 
	 * @access public
	 * @param  (int) $user_id ID of user belongs email address
	 * @param  (array) $emails Associative array containing email addresses and primary status.
	 *                 The array must not be empty and well formed. Eg.
	 *                 array( array( 'email' => 'foo@bar.com', 'is_primary' => '1' ) )
	 * @return (bool) TRUE if emails created successfully, otherwise FALSE
	 */
	function create_user_emails( $user_id, $emails ) {
		// Check email is well formed
		if( is_array( $emails ) && !empty( $emails ) && count( $emails ) > 1 ) {
			foreach( $emails as $email ) {
				$entry_data[] = array(
					'email_address' => $email['email_address'],
					'is_primary'    => (string) intval( $email['is_primary'] ),
					'user_id'       => $user_id,
					'created_date'  => date( 'Y-m-d H:i:s', time() )
				);
			}

			$this->db->insert_batch( $this->db->dbprefix( 'user_emails' ), $entry_data );

			// Check emails created successfully or not
			return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
		}

		return false;
	}

	/**
	 * Create a primary email address for user
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs this primary email
	 * @param  (string) $email Email address used as primary
	 * @return (bool) If primary email successfully created, otherwise FALSE
	 */
	function create_user_primary_email( $user_id, $email ) {
		// Prepare query
		$data = array(
			'email_address' => $email,
			'user_id'       => $user_id,
		);

		// Remove any primary email if exists
		//$this->db->where( 'user_id', $user_id );
		$this->db->insert( $this->db->dbprefix( 'user_contact' ), $data );
		//$this->db->where( 'is_primary', '1' );
		//$this->db->delete( $this->db->dbprefix( 'user_emails' ) );

		// Now, add primary email for user
		//$this->db->insert( $this->db->dbprefix( 'user_emails' ), $data );

		// Check primary email created successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update email addresses of user.
	 * Remove current email addresses and add new
	 * 
	 * @access public
	 * @param  (int) $user_id ID of user to update
	 * @param  (array) $emails Associative array containing email addresses and primary status.
	 *                 The array must not be empty and well formed. Eg.
	 *                 array( array( 'email' => 'foo@bar.com', 'is_primary' => '1' ) )
	 * @return (bool) TRUE if emails updated successfully, otherwise FALSE
	 */
	function update_user_emails( $user_id, $emails ) {
		// Check data is valid and well formed
		if( !is_array( $emails ) || empty( $emails ) || count( $emails ) < 1 ) {
			return false;
		}

		foreach( $emails as $email ) {
			$entry_data[] = array(
				'email_address' => $email['email_address'],
				'is_primary'    => (string) intval( $email['is_primary'] ),
				'user_id'       => $user_id,
				'created_date'  => date( 'Y-m-d H:i:s', time() )
			);
		}

		// Remove old email addresses before updating
		$this->db->where( 'user_id', $user_id );
		$this->db->delete( $this->db->dbprefix( 'user_emails' ) );

		// Make sure old email deleted successfully
		if( $this->db->affected_rows() > 0 && $this->db->_error_message() == 0 ) {
			// Update new emails
			$this->db->insert_batch( $this->db->dbprefix( 'user_emails' ), $entry_data );

			// Check emails updated successfully or not
			return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;

		} else {
			// Cannot remove old emails
			return false;
		}
	}

	/**
	 * Change primary email address of user
	 *
	 * @access public
	 * @param  (int) $user_id ID of user to update primary email
	 * @param  (string) $email_id ID of row to update primary email
	 * @return (bool) TRUE if updated successfully, otherwise FALSE
	 */
	function change_user_primary_email( $user_id, $email_id ) {
		// Remove current primary email before updating for given one
		$this->db->where( 'user_id', $user_id );
		$this->db->update( $this->db->dbprefix( 'user_emails' ), array( 'is_primary' => '0' ) );

		// Make sure the current primary email is changed as not primary
		if( $this->db->affected_rows() > 0 && $this->db->_error_message() == 0 ) {
			// Update primary email with given one
			$this->db->where( 'id', $email_id );
			$this->db->where( 'user_id', $user_id );
			$this->db->update( $this->db->dbprefix( 'user_emails' ), array( 'is_primary' => '1' ) );
		}

		// Check emails updated successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update primary email address of user
	 *
	 * @access public
	 * @param  (int) $user_id ID of user to update primary email
	 * @param  (string) $email New email address which will use as primary
	 * @return (bool) TRUE if updated successfully, otherwise FALSE
	 */
	function update_user_primary_email( $user_id, $email ) {
		// update primary email
		$data = array(
			'email_address' => $email,
		);
		// Update primary email with given one
		$this->db->where( 'user_id', $user_id );
		//$this->db->where( 'is_primary', '1' );
		//$this->db->update( $this->db->dbprefix( 'user_emails' ), $data );
		$this->db->update( $this->db->dbprefix( 'user_contact' ), $data );

		// Check emails updated successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Get primary email of user
	 *
	 * @access public
	 * @param  (int) $user_id ID of user to find the primary email
	 * @return (string) Users' primary email address
	 */
	function get_user_primary_email( $user_id ) {
		// Find the primary email address
		$this->db->select( 'email_address' );
		$this->db->where( 'user_id', $user_id );
		//$this->db->where( 'is_primary', 'TRUE' );
		//$this->db->from( $this->db->dbprefix( 'user_emails' ) );
		$this->db->from( $this->db->dbprefix( 'user_contact' ) );
		$this->db->limit( 1 );

		$query = $this->db->get();

		return $query->row()->email_address;
	}

	/**
	 * Get email addresses of user
	 *
	 * @access public
	 * @param  (int) $user_id ID of user to find the primary email
	 * @return (array) Numeric array containing users' email addresses. NULL if no emails found.
	 */
	function get_user_emails( $user_id ) {
		// Find the primary email address
		$this->db->select( 'email_address' );
		$this->db->where( 'user_id', $user_id );
		$this->db->from( $this->db->dbprefix( 'user_emails' ) );

		$query = $this->db->get();

		if( $query->num_rows() > 0 ) {
			foreach( $query->result() as $row ) {
				$user_emails[] = $row->email_address;
			}

			return $user_emails;
		}

		return null;
	}

	/**
	 * Delete an email
	 *
	 * @access public
	 * @param  (int) $user_id ID of user blongs to the email
	 * @param  (int) $email_id ID of row where the email to delete
	 * @return (bool) TRUE if email deleted, otherwise FALSE
	 */
	function delete_user_email( $user_id, $email_id ) {
		// Prepare
		$this->db->where( 'id', $email_id );
		$this->db->where( 'user_id', $user_id );
		$this->db->delete( $this->db->dbprefix( 'user_emails' ) );

		// Check address deleted successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Create contact addresses of user
	 * 
	 * @access public
	 * @param  (int) $user_id ID of user belongs contact address
	 * @param  (array) $addresses Associative array containing addresses and primary status.
	 *                 The array must not be empty and well formed. Eg.
	 *                 array( 
	 *                      array( 'postal_code' => '11', 'city' => 'NY', 'address' => '123 A', 'is_primary' => '1' )
	 *                 )
	 * @return (bool) TRUE if addresses created successfully, otherwise FALSE
	 */
	function create_user_addresses( $user_id, $addresses ) {
		// Check address is well formed
		if( is_array( $addresses ) && !empty( $addresses ) && count( $addresses ) > 1 ) {
			foreach( $addresses as $address ) {
				$entry_data[] = array(
					'postal_code'   => $address['postal_code'],
					'city'          => $address['city'],
					'country_code'  => $address['country_code'],
					'address'       => $address['address'],
					'is_primary'    => (string) intval( $address['is_primary'] ),
					'user_id'       => $user_id,
					'created_date'  => date( 'Y-m-d H:i:s', time() )
				);
			}

			$this->db->insert_batch( $this->db->dbprefix( 'user_addresses' ), $entry_data );

			// Check addresses created successfully or not
			return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
		}

		return false;
	}

	/**
	 * Create a primary address for user
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs this primary email
	 * @param  (string) $postal_code Postal code
	 * @param  (string) $city City name
	 * @param  (string) $country_code ISO county code belongs to country in system
	 * @param  (string) $address Address string
	 * @return (bool) If primary address successfully created, otherwise FALSE
	 */
	function create_user_primary_address( $user_id, $postal_code, $city, $country_code, $address ) {
		// Prepare query
		$data = array(
			'postal_code'   => $postal_code,
			'city'          => $city,
			'country_code'  => $country_code,
			'address'       => $address,
			'is_primary'    => '1',
			'user_id'       => $user_id,
			'created_date'  => date( 'Y-m-d H:i:s', time() )
		);

		// Remove any primary email if exists
		$this->db->where( 'user_id', $user_id );
		$this->db->where( 'is_primary', '1' );
		$this->db->delete( $this->db->dbprefix( 'user_addresses' ) );

		// Now, add primary address for user
		$this->db->insert( $this->db->dbprefix( 'user_addresses' ), $data );

		// Check primary email created successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update contact addresses of user
	 * Remove current addresses and add new
	 * 
	 * @access public
	 * @param  (int) $user_id ID of user to update
	 * @param  (array) $addresses Associative array containing addresses and primary status.
	 *                 The array must not be empty and well formed. Eg.
	 *                 array( 
	 *                      array( 'postal_code' => '11', 'city' => 'NY', 'address' => '123 A', 'is_primary' => '1' )
	 *                 )
	 * @return (bool) TRUE if addresses updated successfully, otherwise FALSE
	 */
	function update_user_addresses( $user_id, $addresses ) {

		if( is_array( $addresses ) && !empty( $addresses ) && count( $addresses ) > 1 ) {
			foreach( $addresses as $address ) {
				$entry_data[] = array(
					'postal_code'   => $address['postal_code'],
					'city'          => $address['city'],
					'country_code'  => $address['country_code'],
					'address'       => $address['address'],
					'is_primary'    => (string) intval( $address['is_primary'] ),
					'user_id'       => $user_id,
					'created_date'  => date( 'Y-m-d H:i:s', time() ),
					'updated_date'  => date( 'Y-m-d H:i:s', time() )
				);
			}

			// Remove old email addresses before updating
			$this->db->where( 'user_id', $user_id );
			$this->db->delete( $this->db->dbprefix( 'user_addresses' ) );

			// Make sure old email deleted successfully
			if( $this->db->affected_rows() > 0 && $this->db->_error_message() == 0 ) {
				// Update new emails
				$this->db->insert_batch( $this->db->dbprefix( 'user_addresses' ), $entry_data );
			}

			// Check emails updated successfully or not
			return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
		}

		return false;
	}

	/**
	 * Change primary address of user
	 *
	 * @access public
	 * @param  (int) $user_id ID of user to update primary email
	 * @param  (string) $address_id ID of row to update primary address
	 * @return (bool) TRUE if updated successfully, otherwise FALSE
	 */
	function change_user_primary_address( $user_id, $address_id ) {
		// Remove current primary address before updating for given one
		$this->db->where( 'user_id', $user_id );
		$this->db->update( $this->db->dbprefix( 'user_addresses' ), array( 'is_primary' => '0' ) );

		// Make sure the current primary address is changed as not primary
		if( $this->db->affected_rows() > 0 && $this->db->_error_message() == 0 ) {
			// Update primary address with given one
			$this->db->where( 'id', $address_id );
			$this->db->where( 'user_id', $user_id );
			$this->db->update( $this->db->dbprefix( 'user_addresses' ), array( 'is_primary' => '1' ) );
		}

		// Check address updated successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update primary address of user
	 *
	 * @access public
	 * @param  (int) $user_id ID of user to update primary email
	 * @param  (string) $postal_code Postal code
	 * @param  (string) $city City name
	 * @param  (string) $country_code ISO country code belongs to country in system
	 * @param  (string) $address Address string
	 * @return (bool) TRUE if updated successfully, otherwise FALSE
	 */
	function update_user_primary_address( $user_id, $postal_code, $city, $country_code, $address ) {
		// prepare new data
		$data = array(
			'postal_code'  => $postal_code,
			'city'         => $city,
			'country_code' => $country_code,
			'address'      => $address,
			'updated_date' => date( 'Y-m-d H:i:s', time() )
		);

		// Update primary address with given one
		$this->db->where( 'user_id', $user_id );
		$this->db->where( 'is_primary', '1' );
		$this->db->update( $this->db->dbprefix( 'user_addresses' ), $data );

		// Check address updated successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Get primary address of user
	 *
	 * @access public
	 * @param  (int) $user_id ID of user to find the primary address
	 * @return (object) User's primary address object with post code, city, country and address
	 */
	function get_user_primary_address( $user_id ) {
		// Find the primary email address
		$this->db->select( 'postal_code, city, country_code, address' );
		$this->db->where( 'user_id', $user_id );
		$this->db->where( 'is_primary', 'TRUE' );
		$this->db->from( $this->db->dbprefix( 'user_addresses' ) );
		$this->db->limit( 1 );

		$query = $this->db->get();

		return $query->row();
	}

	/**
	 * Get addresses of user
	 *
	 * @access public
	 * @param  (int) $user_id ID of user to find the addresses
	 * @return (array) Numeric array containing user's address with post code, city, 
	 *           country and address. NULL if no addresses found.
	 */
	function get_user_addresses( $user_id ) {
		// Find the primary email address
		$this->db->select( 'postal_code, city, country_code, address' );
		$this->db->where( 'user_id', $user_id );
		$this->db->from( $this->db->dbprefix( 'user_addresses' ) );

		$query = $this->db->get();

		if( $query->num_rows() > 0 ) {
			foreach( $query->result() as $row ) {
				$user_addressses[] = array(
					'postal_code'  => $row->postal_code,
					'city'         => $row->city,
					'country_code' => $row->country_code,
					'address'      => $row->address
				);
			}

			return $user_addressses;
		}

		return null;
	}

	/**
	 * Delete an address
	 *
	 * @access public
	 * @param  (int) $user_id ID of user blongs to the address
	 * @param  (int) $address_id ID of row where the address to delete
	 * @return (bool) TRUE if address deleted, otherwise FALSE
	 */
	function delete_user_address( $user_id, $address_id ) {
		// Prepare
		$this->db->where( 'id', $address_id );
		$this->db->where( 'user_id', $user_id );
		$this->db->delete( $this->db->dbprefix( 'user_addresses' ) );

		// Check address deleted successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Create a primary telephone number for user
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs this primary telephone
	 * @param  (string) $telephone Telephone number used as primary
	 * @return (bool) If primary telephone successfully created, otherwise FALSE
	 */
	function create_user_primary_telephone( $user_id, $telephone ) {
		// Prepare query
		$data = array(
			'telephone'     => $telephone,
			'user_id'       => $user_id,
			'is_primary'    => '1',
			'created_date'  => date( 'Y-m-d H:i:s', time() )
		);

		// Remove any primary telephone if exists
		$this->db->where( 'user_id', $user_id );
		$this->db->where( 'is_primary', '1' );
		$this->db->delete( $this->db->dbprefix( 'user_telephones' ) );

		// Now, add primary telephone for user
		$this->db->insert( $this->db->dbprefix( 'user_telephones' ), $data );

		// Check primary telephone created successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update telephone of user.
	 * Remove current telephone and add new
	 * 
	 * @access public
	 * @param  (int) $user_id ID of user to update
	 * @param  (array) $telephones Associative array containing telephone numbers and primary status.
	 *                 The array must not be empty and well formed. Eg.
	 *                 array( array( 'telephone' => '123456789', 'is_primary' => '1' ) )
	 * @return (bool) TRUE if telephones updated successfully, otherwise FALSE
	 */
	function update_user_telephones( $user_id, $telephones ) {
		// Check data is valid and well formed
		if( !is_array( $telephones ) || empty( $telephones ) || count( $telephones ) < 1 ) {
			return false;
		}

		foreach( $telephones as $telephone ) {
			$entry_data[] = array(
				'telephone'     => $telephone['telephone'],
				'is_primary'    => (string) intval( $telephone['is_primary'] ),
				'user_id'       => $user_id,
				'created_date'  => date( 'Y-m-d H:i:s', time() )
			);
		}

		// Remove old telephones before updating
		$this->db->where( 'user_id', $user_id );
		$this->db->delete( $this->db->dbprefix( 'user_telephones' ) );

		// Make sure old email deleted successfully
		if( $this->db->affected_rows() > 0 && $this->db->_error_message() == 0 ) {
			// Update new emails
			$this->db->insert_batch( $this->db->dbprefix( 'user_telephones' ), $entry_data );

			// Check emails updated successfully or not
			return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;

		} else {
			// Cannot remove old emails
			return false;
		}
	}

	/**
	 * Change primary telephone of user
	 *
	 * @access public
	 * @param  (int) $user_id ID of user to update primary email
	 * @param  (string) $telephone_id ID of row to update primary telephone
	 * @return (bool) TRUE if updated successfully, otherwise FALSE
	 */
	function change_user_primary_telephone( $user_id, $telephone_id ) {
		// Remove current primary email before updating for given one
		$this->db->where( 'user_id', $user_id );
		$this->db->update( $this->db->dbprefix( 'user_telephones' ), array( 'is_primary' => '0' ) );

		// Make sure the current primary email is changed as not primary
		if( $this->db->affected_rows() > 0 && $this->db->_error_message() == 0 ) {
			// Update primary email with given one
			$this->db->where( 'id', $telephone_id );
			$this->db->where( 'user_id', $user_id );
			$this->db->update( $this->db->dbprefix( 'user_telephones' ), array( 'is_primary' => '1' ) );
		}

		// Check emails updated successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update primary telephone of user
	 *
	 * @access public
	 * @param  (int) $user_id ID of user to update primary email
	 * @param  (string) $telephone New primary telephone number
	 * @return (bool) TRUE if updated successfully, otherwise FALSE
	 */
	function update_user_primary_telephone( $user_id, $telephone ) {
		// Update primary email with given one
		$this->db->where( 'user_id', $user_id );
		$this->db->where( 'is_primary', '1' );
		$this->db->update( $this->db->dbprefix( 'user_telephones' ), array( 'is_primary' => '1' ) );

		// Check emails updated successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Get primary telephone of user
	 *
	 * @access public
	 * @param  (int) $user_id ID of user to find the primary telephone
	 * @return (string) Users' primary telephone number
	 */
	function get_user_primary_telephone( $user_id ) {
		// Find the primary telephone
		$this->db->select( 'telephone' );
		$this->db->where( 'user_id', $user_id );
		$this->db->where( 'is_primary', 'TRUE' );
		$this->db->from( $this->db->dbprefix( 'user_telephones' ) );
		$this->db->limit( 1 );

		$query = $this->db->get();

		return $query->row()->telephone;
	}

	/**
	 * Get telephone numbers of user
	 *
	 * @access public
	 * @param  (int) $user_id ID of user to find telephone numbers
	 * @return (array) Numeric array containing user's telephones. 
	 *          NULL if no telephone numbers found.
	 */
	function get_user_telephones( $user_id ) {
		// Find the primary email address
		$this->db->select( 'telephone' );
		$this->db->where( 'user_id', $user_id );
		$this->db->from( $this->db->dbprefix( 'user_telephones' ) );

		$query = $this->db->get();

		if( $query->num_rows() > 0 ) {
			foreach( $query->result() as $row ) {
				$user_telephones[] = $row->telephone;
			}

			return $user_telephones;
		}

		return null;
	}

	/**
	 * Delete a telephone number
	 *
	 * @access public
	 * @param  (int) $user_id ID of user blongs to telephone number
	 * @param  (int) $telephone_id ID of row where the telephone number to delete
	 * @return (bool) TRUE if successfully deleted, otherwise FALSE
	 */
	function delete_user_telephone( $user_id, $telephone_id ) {
		// Prepare
		$this->db->where( 'id', $telephone_id );
		$this->db->where( 'user_id', $user_id );
		$this->db->delete( $this->db->dbprefix( 'user_telephones' ) );

		// Check address deleted successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Create a password reset code
	 * The password reset code will also be stored the time that reset requested
	 * and the code will not be able to use after 24 hours
	 *
	 * @access public
	 * @param  (int) $user_id Users' ID that reset code belongs
	 * @param  (string) $reset_code Encrypted cipher with sha256 encryption method
	 * @return (bool) TRUE if reset code created successfully, otherwise FALSE
	 */
	function create_user_password_reset_code( $user_id, $reset_code ) {
		// Prepare data
		$data = array(
			'password_reset_code' => $reset_code,
			'password_reset_time' => date( 'Y-m-d H:i:s', time() )
		);

		// Save reset code
		$this->db->where( 'id', $user_id );
		$this->db->update( $this->db->dbprefix( 'users' ), $data );

		// Check reset code successfully created or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Create activation code for a user
	 *
	 * @access public
	 * @param  (int) $user_id User's ID to create an activation code
	 * @param  (string) $activation_code Activation code
	 * @return (bool) TRUE if successfully created, otherwise FALSE
	 */
	function create_activation_code( $user_id, $activation_code ) {
		// prepare data
		$data = array(
			'activation_code' => $activation_code
		);

		$this->db->where( 'id', $user_id );
		$this->db->update( $this->db->dbprefix( 'users' ), $data );

		// Check reset code successfully created or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update personal information
	 *
	 * @access public
	 * @param  (string) $title Title of user
	 * @param  (string) $surname Surname of user
	 * @param  (int)    $applicant_type Applicant type
	 * @param  (string) $graduate_year Graduate year
	 * @param  (string) $translator_start_time Start time of working as a translator
	 * @param  (string) $interpreter_start_time Start time of working as an interpreter
	 * @param  (int)    $user_id User's ID to update
	 * @return (bool)   TRUE if successfully update, otherwise FALSE
	 */
	function update_personal_info( $title, $first_name, $surname, $applicant_type, $graduate_year, 
									$translator_start_time, $interpreter_start_time, $user_id ) {
		if( $user_id == null ) {
			$user_id = $this->logtrino_user->get_id();
		}

		// Prepare data
		$user_data = array(
			'first_name'   => $first_name,
			'last_name'    => $surname,
			'title'        => $title,
			'updated_date' => date( 'Y-m-d', time() )
		);

		// Update in users table
		$this->db->where( 'id', $user_id );
		$this->db->update( $this->db->dbprefix( $this->table ), $user_data );

		// Update for translator information
		$translator_data = array(
			'type'                      => $applicant_type,
			'year_of_graduation'        => $graduate_year,
			'start_time_as_translator'  => $translator_start_time,
			'start_time_as_interpreter' => $interpreter_start_time
		);

		$this->db->where( 'user_id', $user_id );
		$this->db->update( $this->db->dbprefix( 'translators' ), $translator_data );

		// Check reset code successfully created or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Create user's contact information
	 *
	 * @access public
	 * @param  (string) $telephone_number Telephone number
	 * @param  (string) $mobile_phone_number Mobile phone number
	 * @param  (string) $fax_number Fax number
	 * @param  (string) $email Email address
	 * @param  (string) $alternative_email Alternative email address
	 * @param  (string) $url Url
	 * @param  (string) $socials_data Social network links
	 * @param  (int)    $user_id User's ID belongs to the contact
	 * @return (bool)   TRUE if contact update successfully. Otherwise, FALSE
	 */
	function create_user_contact( $telephone_number, $mobile_phone_number, $fax_number, $email, $alternative_email, $url, 
									$socials_data, $user_id ) {
		// Prepare data
		$data = array(
			'telephone_number'            => $telephone_number,
			'mobile_phone_number'         => $mobile_phone_number,
			'fax_number'                  => $fax_number,
			'email_address'               => $email,
			'alternative_email_address'   => $alternative_email,
			'url'                         => $url,
			'social_links'                => $socials_data,
			'user_id'                     => $user_id,
		);

		// Update data
		$this->db->where( 'user_id', $user_id );
		$this->db->update( $this->db->dbprefix( 'user_contact' ), $data );

		// Check data updated or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update user's contact information
	 *
	 * @access public
	 * @param  (string) $telephone_number Telephone number
	 * @param  (string) $mobile_phone_number Mobile phone number
	 * @param  (string) $fax_number Fax number
	 * @param  (string) $email Email address
	 * @param  (string) $alternative_email Alternative email address
	 * @param  (string) $url Url
	 * @param  (string) $socials_data Social network links
	 * @param  (int)    $user_id User's ID belongs to the contact
	 * @return (bool)   TRUE if contact update successfully. Otherwise, FALSE
	 */
	function update_user_contact( $telephone_number, $mobile_phone_number, $fax_number, $email, $alternative_email, $url, 
									$socials_data, $user_id ) {
		// Prepare data
		$data = array(
			'telephone_number'            => $telephone_number,
			'mobile_phone_number'         => $mobile_phone_number,
			'fax_number'                  => $fax_number,
			'email_address'               => $email,
			'alternative_email_address'   => $alternative_email,
			'url'                         => $url,
			'social_links'                => $socials_data,
			'user_id'                     => $user_id,
		);
		// Update data
		$this->db->where( 'user_id', $user_id );
		$this->db->update( $this->db->dbprefix( 'user_contact' ), $data );
		// Check data updated or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update company information of a translator
	 *
	 * @access public
	 * @param  (string) $company_name Company name
	 * @param  (string) $legal_form Legal form
	 * @param  (string) $tax_number Tax number
	 * @param  (string) $small_business Small business ( Yes / No )
	 * @param  (string) $third_party_insurance ( Yes/ No )
	 * @pram   (string) $foundation_year Foundation year of company
	 * @param  (int) $user_id User's ID to update
	 * @return (bool) TRUE if successfully updated. Otherwise, FALSE
	 */
	function update_company_info( $company_name, $legal_form, $tax_number, $small_business, $third_party_insurance, 
									$foundation_year, $user_id ) {
		// Prepare data
		$data = array(
			'company'               => $company_name,
			'legal_form'            => $legal_form,
			'tax_number'            => $tax_number,
			'small_business'        => ( $small_business == 'Yes' ) ? '1' : '0',
			'third_party_insurance' => ( $third_party_insurance == 'Yes' ) ? '1' : '0',
			'foundation_year'       => $foundation_year
		);
		// Update data
		$this->db->where( 'user_id', $user_id );
		$this->db->update( $this->db->dbprefix( 'translators' ), $data );
		// Check data updated or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update translation information of a translator
	 *
	 * @access public
	 * @param  (string) $minimum_fee Minimum fee of translation
	 * @param  (string) $rates Translation rates
	 * @param  (string) $iso_9001 ISO standard
	 * @param  (string) $certifications Certifications
	 * @param  (bool)   $sworn_translations Does translator or translation company provides sworn translations ?
	 * @param  (bool)   $reviews Does translator or translation company provides reviews ?
	 * @param  (int)    $user_id User's ID to update
	 * @return (bool)   TRUE if successfully updated. Otherwise, FALSE
	 */
	function update_translation_info( $minimum_fee, $rates, $iso_9001, $certifications, $sworn_translations, $reviews, $user_id ) {
		// Prepare data
		$data = array(
			'minimum_fee'          => $minimum_fee,
			'rates'                => $rates,
			'iso_9001'             => $iso_9001,
			'certifications'       => $certifications,
			'sworn_translations'   => ( $sworn_translations == 'Yes' ) ? '1' : '0',
			'reviews'              => ( $reviews == 'Yes' ) ? '1' : '0'
		);

		// Update data
		$this->db->where( 'user_id', $user_id );
		$this->db->update( $this->db->dbprefix( 'translators' ), $data );
		
		// Check data updated or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update bank information
	 *
	 * @access public
	 * @param  (string) $account_owner Account owner name
	 * @param  (string) $bank_name Bank name
	 * @param  (string) $account_number Account number
	 * @param  (string) $sort SORT number
	 * @param  (string) $iban IBAN number
	 * @param  (string) $bic_swift BIC / SWIFT number
	 * @param  (string) $paypal_account Paypal email
	 * @param  (int) $user_id User's ID to update
	 * @return (bool)   TRUE if updated successfully, otherwise FALSE.
	 */
	function update_bank_information( $account_owner, $bank_name, $account_number, $sort, $iban, $bic_swift, $paypal_account, $user_id ) {
		// Prepare data
		$data = array(
			'account_owner' => $account_owner,
			'bank_name'     => $bank_name,
			'account_number' => $account_number,
			'sort'           => $sort,
			'iban'           => $iban,
			'bic_swift'      => $bic_swift,
			'paypal_account' => $paypal_account
		);
		
		// If there's no bank information already exists, insert
		$row = $this->db->select( "COUNT(id) AS total FROM " . $this->db->dbprefix( 'user_bank_information' ) . " WHERE user_id = " . $user_id )->get()->row();
		
		if( $row->total > 0 ) {
			// Row already exists, update it
			$this->db->where( 'user_id', $user_id );
			$this->db->update( $this->db->dbprefix( 'user_bank_information' ), $data );
		} else {
			// No row already exists, insert row
			$data['user_id'] = $user_id;

			$this->db->insert( $this->db->dbprefix( 'user_bank_information' ), $data );
		}

		// Check data updated or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Change translator's status
	 *
	 * @access public
	 * @param  (int) $supplier_id Supplier's ID
	 * @param  (int) $status_id Status's ID to change
	 * @param  (bool) TRUE if status changed, otherwise FALSE
	 */
	function change_translator_status( $supplier_id, $status_id ) {
		// update status
		$data = array( 'status' => $status_id );

		if( $status_id == 4 ) {
			$data['submit_application_form'] = '0';
		}

		$this->db->where( 'user_id', $supplier_id );
		$this->db->update( $this->db->dbprefix( 'translators' ), $data );

		// status successfully updated or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
		/*
		// user's ID same with current user's ID
		if( $user->id == $this->logtrino_user->get_id() ) {
			return false;
		}
	
		// user is not translator
		if( $user->role_id == 1 || ( $status_id < 1 || $status_id > 4 ) ) {
			return false;
		}

		if( $user->status_id > 1 ) {
			// potential user's can be changed as accepted or rejected, but not applicant
			if( $user->status_id == 3 && $status_id == 2 ) {
				return false;
			}

			// update status
			$data = array( 'status' => $status_id );

			$this->db->where( 'user_id', $user->id );
			$this->db->update( $this->db->dbprefix( 'translators' ), $data );

			// status successfully updated or not
			return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
		}

		return false;*/
	}

	/**
	 * Add translation charge for a supplier
	 *
	 * @access public
	 * @param  (string) $source_language Source language
	 * @param  (string) $target_language Traget language
	 * @param  (numeric) $charge_per_word Charge per word
	 * @param  (numeric) $charge_per_line Charge per line
	 * @param  (numeric) $charge_per_hour Charge per hour
	 * @param  (numeric) $minimum_charge Minimum charge
	 * @return (bool) TRUE if translation charge successfully created. Otherwise, FALSE
	 */
	function create_translation_charge( $user_id, $source_language, $target_language, $charge_per_word, $charge_per_line, 
											$charge_per_hour, $minimum_charge ) {
		// Prepare data
		$data = array(
			'source_language' => $source_language,
			'target_language' => $target_language,
			'charge_per_word' => $charge_per_word,
			'charge_per_line' => $charge_per_line,
			'charge_per_hour' => $charge_per_hour,
			'minimum_charge'  => $minimum_charge,
			'user_id'         => $user_id
		);

		// Insert into db
		$this->db->insert( $this->db->dbprefix( 'supplier_translation_charge' ), $data );

		// successfully created or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Get translation charge of a supplier
	 *
	 * @access public
	 * @param  (int) $item_id ID of item to find
	 * @param  (int) $user_id User's ID belongs to the item
	 * @return (object) Founded item
	 */
	function get_translation_charge_by_id( $item_id, $user_id ) {
		$sel = "c.id, c.charge_per_word, c.charge_per_line, c.charge_per_hour, c.minimum_charge, c.user_id, 
				sl.name_en AS source_language_en, sl.name_de AS source_language_de, sl.id AS source_language_id, 
				tl.name_en AS target_language_en, tl.name_de AS target_language_de, tl.id AS target_language_id";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'supplier_translation_charge' ) . ' AS c' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS sl', 'sl.id = c.source_language', 'left' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS tl', 'tl.id = c.target_language', 'left' );

		$this->db->limit( 1 );		
		$this->db->where( 'c.user_id', $user_id );
		$this->db->where( 'c.id', $item_id );

		$query = $this->db->get();

		return $query->row();
	}

	/**
	 * Get translation charges of a supplier
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs to the translation charges
	 * @return (array) Array of founded records
	 */
	function get_translation_charges( $user_id ) {
		$sel = "c.id, c.charge_per_word, c.charge_per_line, c.charge_per_hour, c.minimum_charge, c.user_id, 
				sl.name_en AS source_language_en, sl.name_de AS source_language_de, sl.id AS source_language_id, 
				tl.name_en AS target_language_en, tl.name_de AS target_language_de, tl.id AS target_language_id";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'supplier_translation_charge' ) . ' AS c' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS sl', 'sl.id = c.source_language', 'left' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS tl', 'tl.id = c.target_language', 'left' );

		$this->db->order_by( 'c.id', 'ASC' );		
		$this->db->where( 'c.user_id', $user_id );

		$query = $this->db->get();

		return $query->result();
	}

	/**
	 * Delete translation charge of a supplier
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs to translation charge
	 * @param  (int) $id ID of translation charge row
	 * @return (bool) TRUE if translation charge deleted successfully. Otherwise FALSE
	 */
	function delete_translation_charge( $user_id, $id ) {
		// Delete translation charge of a supplier
		$this->db->where( 'user_id', $user_id );
		$this->db->where( 'id', $id );

		$this->db->delete( $this->db->dbprefix( 'supplier_translation_charge') );

		// successfully deleted or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Add interpreting charge for a supplier
	 *
	 * @access public
	 * @param  (string) $type Interpreting type
	 * @param  (string) $language Interpreting langauge
	 * @param  (numeric) $hours Hours of interpreting
	 * @param  (float) $flat_rate Interpreting flat rate
	 * @param  (numeric) $days Days of interpreting
	 * @return (bool) TRUE if translation charge successfully created. Otherwise, FALSE
	 */
	function create_interpreting_charge( $user_id, $type, $language, $hours, $flat_rate, $days ) {
		// Prepare data
		$data = array(
			'type'      => $type,
			'language'  => $language,
			'hours'     => $hours,
			'flat_rate' => $flat_rate,
			'days'      => $days,
			'user_id'   => $user_id
		);

		// Insert into db
		$this->db->insert( $this->db->dbprefix( 'supplier_interpreting_charge' ), $data );

		// successfully created or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Get interpreting charge of a supplier
	 *
	 * @access public
	 * @param  (int) $item_id ID of item to find
	 * @param  (int) $user_id User's ID belongs to the item
	 * @return (object) Founded item
	 */
	function get_interpreting_charge_by_id( $item_id, $user_id ) {
		$sel = "c.id, c.type, c.hours, c.flat_rate, c.days, c.user_id, 
				l.name_en AS language_en, l.name_de AS language_de, l.id AS language_id";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'supplier_interpreting_charge' ) . ' AS c' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS l', 'l.id = c.language', 'left' );

		$this->db->limit( 1 );		
		$this->db->where( 'c.user_id', $user_id );
		$this->db->where( 'c.id', $item_id );

		$query = $this->db->get();

		return $query->row();
	}

	/**
	 * Get interpreting charges of a supplier
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs to the interpreting charges
	 * @return (array) Array of founded records
	 */
	function get_interpreting_charges( $user_id ) {
		$sel = "c.id, c.type, c.language, c.hours, c.flat_rate, c.days, c.user_id, 
				l.name_en AS language_en, l.name_de AS language_de, l.id AS language_id";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'supplier_interpreting_charge' ) . ' AS c' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS l', 'l.id = c.language', 'left' );

		$this->db->order_by( 'c.id', 'ASC' );		
		$this->db->where( 'c.user_id', $user_id );

		$query = $this->db->get();

		return $query->result();
	}

	/**
	 * Delete interpreting charge of a supplier
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs to interpreting charge
	 * @param  (int) $id ID of interpreting charge row
	 * @return (bool) TRUE if interpreting charge deleted successfully. Otherwise FALSE
	 */
	function delete_interpreting_charge( $user_id, $id ) {
		// Delete interpreting charge of a supplier
		$this->db->where( 'user_id', $user_id );
		$this->db->where( 'id', $id );

		$this->db->delete( $this->db->dbprefix( 'supplier_interpreting_charge') );

		// successfully deleted or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Add post editing charge for a supplier
	 *
	 * @access public
	 * @param  (string) $source_language Source language
	 * @param  (string) $target_language Traget language
	 * @param  (numeric) $charge_per_word Charge per word
	 * @param  (numeric) $charge_per_line Charge per line
	 * @param  (numeric) $charge_per_hour Charge per hour
	 * @param  (numeric) $minimum_charge Minimum charge
	 * @return (bool) TRUE if translation charge successfully created. Otherwise, FALSE
	 */
	function create_post_editing_charge( $user_id, $source_language, $target_language, $charge_per_word, $charge_per_line, 
											$charge_per_hour, $minimum_charge ) {
		// Prepare data
		$data = array(
			'source_language' => $source_language,
			'target_language' => $target_language,
			'charge_per_word' => $charge_per_word,
			'charge_per_line' => $charge_per_line,
			'charge_per_hour' => $charge_per_hour,
			'minimum_charge'  => $minimum_charge,
			'user_id'         => $user_id
		);

		// Insert into db
		$this->db->insert( $this->db->dbprefix( 'supplier_post_editing_charge' ), $data );

		// successfully created or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Get post editing charge of a supplier
	 *
	 * @access public
	 * @param  (int) $item_id ID of item to find
	 * @param  (int) $user_id User's ID belongs to the item
	 * @return (object) Founded item
	 */
	function get_post_editing_charge_by_id( $item_id, $user_id ) {
		$sel = "c.id, c.charge_per_word, c.charge_per_line, c.charge_per_hour, c.minimum_charge, c.user_id, 
				sl.name_en AS source_language_en, sl.name_de AS source_language_de, sl.id AS source_language_id, 
				tl.name_en AS target_language_en, tl.name_de AS target_language_de, tl.id AS target_language_id";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'supplier_post_editing_charge' ) . ' AS c' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS sl', 'sl.id = c.source_language', 'left' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS tl', 'tl.id = c.target_language', 'left' );

		$this->db->limit( 1 );		
		$this->db->where( 'c.user_id', $user_id );
		$this->db->where( 'c.id', $item_id );

		$query = $this->db->get();

		return $query->row();
	}

	/**
	 * Get post editing charges of a supplier
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs to the post editing charges
	 * @return (array) Array of founded records
	 */
	function get_post_editing_charges( $user_id ) {
		$sel = "c.id, c.charge_per_word, c.charge_per_line, c.charge_per_hour, c.minimum_charge, c.user_id, 
				sl.name_en AS source_language_en, sl.name_de AS source_language_de, sl.id AS source_language_id, 
				tl.name_en AS target_language_en, tl.name_de AS target_language_de, tl.id AS target_language_id";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'supplier_post_editing_charge' ) . ' AS c' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS sl', 'sl.id = c.source_language', 'left' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS tl', 'tl.id = c.target_language', 'left' );

		$this->db->order_by( 'c.id', 'ASC' );		
		$this->db->where( 'c.user_id', $user_id );

		$query = $this->db->get();

		return $query->result();
	}

	/**
	 * Delete post editing charge of a supplier
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs to post editing charge
	 * @param  (int) $id ID of post editing charge row
	 * @return (bool) TRUE if post editing charge deleted successfully. Otherwise FALSE
	 */
	function delete_post_editing_charge( $user_id, $id ) {
		// Delete post editing charge of a supplier
		$this->db->where( 'user_id', $user_id );
		$this->db->where( 'id', $id );

		$this->db->delete( $this->db->dbprefix( 'supplier_post_editing_charge') );

		// successfully deleted or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Add proof reading charge for a supplier
	 *
	 * @access public
	 * @param  (string) $source_language Source language
	 * @param  (string) $target_language Traget language
	 * @param  (numeric) $charge_per_word Charge per word
	 * @param  (numeric) $charge_per_line Charge per line
	 * @param  (numeric) $charge_per_hour Charge per hour
	 * @param  (numeric) $minimum_charge Minimum charge
	 * @return (bool) TRUE if translation charge successfully created. Otherwise, FALSE
	 */
	function create_proof_reading_charge( $user_id, $source_language, $target_language, $charge_per_word, $charge_per_line, 
											$charge_per_hour, $minimum_charge ) {
		// Prepare data
		$data = array(
			'source_language' => $source_language,
			'target_language' => $target_language,
			'charge_per_word' => $charge_per_word,
			'charge_per_line' => $charge_per_line,
			'charge_per_hour' => $charge_per_hour,
			'minimum_charge'  => $minimum_charge,
			'user_id'         => $user_id
		);

		// Insert into db
		$this->db->insert( $this->db->dbprefix( 'supplier_proof_reading_charge' ), $data );

		// successfully created or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Get proof reading charge of a supplier
	 *
	 * @access public
	 * @param  (int) $item_id ID of item to find
	 * @param  (int) $user_id User's ID belongs to the item
	 * @return (object) Founded item
	 */
	function get_proof_reading_charge_by_id( $item_id, $user_id ) {
		$sel = "c.id, c.charge_per_word, c.charge_per_line, c.charge_per_hour, c.minimum_charge, c.user_id, 
				sl.name_en AS source_language_en, sl.name_de AS source_language_de, sl.id AS source_language_id, 
				tl.name_en AS target_language_en, tl.name_de AS target_language_de, tl.id AS target_language_id";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'supplier_proof_reading_charge' ) . ' AS c' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS sl', 'sl.id = c.source_language', 'left' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS tl', 'tl.id = c.target_language', 'left' );

		$this->db->limit( 1 );		
		$this->db->where( 'c.user_id', $user_id );
		$this->db->where( 'c.id', $item_id );

		$query = $this->db->get();

		return $query->row();
	}

	/**
	 * Get proof reading charges of a supplier
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs to the proof reading charges
	 * @return (array) Array of founded records
	 */
	function get_proof_reading_charges( $user_id ) {
		$sel = "c.id, c.charge_per_word, c.charge_per_line, c.charge_per_hour, c.minimum_charge, c.user_id, 
				sl.name_en AS source_language_en, sl.name_de AS source_language_de, sl.id AS source_language_id, 
				tl.name_en AS target_language_en, tl.name_de AS target_language_de, tl.id AS target_language_id";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'supplier_proof_reading_charge' ) . ' AS c' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS sl', 'sl.id = c.source_language', 'left' );
		$this->db->join( $this->db->dbprefix( 'languages' ) . ' AS tl', 'tl.id = c.target_language', 'left' );

		$this->db->order_by( 'c.id', 'ASC' );		
		$this->db->where( 'c.user_id', $user_id );

		$query = $this->db->get();

		return $query->result();
	}

	/**
	 * Delete proof reading charge of a supplier
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs to proof reading charge
	 * @param  (int) $id ID of proof reading charge row
	 * @return (bool) TRUE if proof reading charge deleted successfully. Otherwise FALSE
	 */
	function delete_proof_reading_charge( $user_id, $id ) {
		// Delete proof reading charge of a supplier
		$this->db->where( 'user_id', $user_id );
		$this->db->where( 'id', $id );

		$this->db->delete( $this->db->dbprefix( 'supplier_proof_reading_charge') );

		// successfully deleted or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Create an absence of a supplier
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs to an absence
	 * @param  (string) $from_date Start date of absence
	 * @param  (string) $to_date End date of absence
	 * @param  (string) $reason Reason of absence
	 * @return (bool) TRUE if absence created successfully. Otherwise, FALSE
	 */
	function create_absence( $user_id, $from_date, $to_date, $absence_type, $limited_capacity = '0' ) {
		// Prepare data
		$data = array(
			'from_date'        => date( 'Y-m-d H:i:s', strtotime( $from_date ) ),
			'to_date'          => date( 'Y-m-d H:i:s', strtotime( $to_date ) ),
			'type'             => $absence_type,
			'limited_capacity' => $limited_capacity, 
			'user_id'          => $user_id
		);

		// Create absence
		$this->db->insert( $this->db->dbprefix( 'supplier_absences' ), $data );

		// successfully created or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Get absence of a supplier
	 *
	 * @access public
	 * @param  (int) $item_id ID of row to find
	 * @param  (int) $user_id User's ID belongs to the item
	 * @return (object) Founded row
	 */
	function get_absence_by_id( $item_id, $user_id ) {
		$sel = "a.id, a.from_date, a.to_date, a.reason, a.limited_capacity, a.user_id, 
				b.id AS absence_type_id, b.title AS absence_type, b.acronym";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'supplier_absences' ) . ' AS a' );
		$this->db->join( $this->db->dbprefix( 'absence_types' ) . ' AS b', 'b.id = a.type' );

		$this->db->limit( 1 );	
		$this->db->where( 'a.user_id', $user_id );
		$this->db->where( 'a.id', $item_id );

		$query = $this->db->get();

		return $query->row();
	}

	/**
	 * Get absence of a supplier
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs to the absences
	 * @return (array) Array of founded records
	 */
	function get_absences( $user_id ) {
		$sel = "a.id, a.from_date, a.to_date, a.reason, a.limited_capacity, a.user_id, 
				b.id AS absence_type_id, b.title AS absence_type, b.acronym";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'supplier_absences' ) . ' AS a' );
		$this->db->join( $this->db->dbprefix( 'absence_types' ) . ' AS b', 'b.id = a.type' );

		$this->db->order_by( 'a.id', 'ASC' );	
		$this->db->where( 'a.user_id', $user_id );

		$query = $this->db->get();

		return $query->result();
	}

	/**
	 * Delete an absence of a supplier
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs to the absence
	 * @param  (int) $absence_id ID of absence
	 * @return (bool) TRUE if abasence deleted successfully. Otherwise, FALSE
	 */
	function delete_absence( $user_id, $absence_id ) {
		// Delete an absence
		$this->db->where( 'user_id', $user_id );
		$this->db->where( 'id', $absence_id );

		// Delete an absence
		$this->db->delete( $this->db->dbprefix( 'supplier_absences' ) );

		// successfully created or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update softwares list of supplier
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs to softwares
	 * @param  (array) $software_ids Array contains ID of softwares. Example: array( '1', '2', '3' )
	 * @return (bool) TRUE if softwares udpated successfully. Otherwise, FALSE
	 */
	function update_supplier_softwares( $user_id, $software_ids ) {
		// Remove previous data first
		$this->db->where( 'user_id', $user_id );
		$this->db->delete( $this->db->dbprefix( 'supplier_softwares' ) );

		if( !empty( $software_ids ) && count( $software_ids ) > 0 ) {
			for( $i = 0; $i < count( $software_ids ); $i++ ) {
				$data[ $i ] = array(
					'software_id'  => $software_ids[ $i ],
					'user_id'      => $user_id,
					'created_date' => date( 'Y-m-d H:i:s', time() ),
					'updated_date' => date( 'Y-m-d H:i:s', time() )
				);
			}

			// Insert into to database
			$this->db->insert_batch( $this->db->dbprefix( 'supplier_softwares' ), $data );

			return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
		}

		return FALSE;
	}

	/**
	 * Update biography of a supplier
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belong to update
	 * @param  (string) $bio_summary Summary of biography
	 * @return (bool) TRUE if successfully updated. Otherwise, FALSE.
	 */
	function update_supplier_bio( $user_id, $bio_summary ) {
		// Prepare data
		$data = array(
			'bio_summary' => $bio_summary
		);

		// Update data
		$this->db->where( 'user_id', $user_id );
		$this->db->update( $this->db->dbprefix( 'translators' ), $data );

		// Make sure update success
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update profile picture of a user
	 *
	 * @access public
	 * @param  (int) $user_id User's ID to update profile picture
	 * @param  (string) $profile_picture_path Store path of profile picture on server. Path with file name and extension included.
	 * @return (bool) TRUE if profile picture successfully updated. Otherwise, FALSE.
	 */
	function update_profile_picture( $user_id, $profile_picture_path ) {
		// Prepare data
		$data = array(
			'profile_picture' => $profile_picture_path,
			'updated_date'    => date( 'Y-m-d H:i:s', time() )
		);

		$this->db->where( 'id', $user_id );
		$this->db->update( $this->db->dbprefix( $this->table), $data );

		// Make sure update success
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update translator basic information
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belong to the translator
	 * @param  (int) $native_lang ID of language
	 * @param  (string) $graduation_year Graduation year of translator
	 * @param  (string) $translator_start_year Start year working as a translator
	 * @param  (string) $interpreter_start_year Start year working as an interpreter
	 * @param  (string) $notes Supplier's notes
	 * @param  (string) $certification_upload_path Upload path of supplier certification attachment
	 * @param  (string) $softwares Softwares that supplier experienced. Data is stored with JSON format.
	 * @return (bool) TRUE if data updated successfully, otherwise FALSE
	 */
	function update_translator_information( $user_id, $native_lang, $graduation_year, $translator_start_year, 
											$interpreter_start_year, $notes, $certification_upload_path, $softwares ) {
		// Prepare data
		$data  = array(
			'native_lang'               => $native_lang,
			'year_of_graduation'        => $graduation_year,
			'start_time_as_translator'  => $translator_start_year,
			'start_time_as_interpreter' => $interpreter_start_year,
			'notes'                     => $notes,
			'certification_upload_path' => $certification_upload_path
		);

		// Update data for translator
		$this->db->where( 'user_id', $user_id );

		// Update data
		$this->db->update( $this->db->dbprefix( 'translators' ), $data );

		// Make sure update success
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Create multiple records of supplier translation information
	 *
	 * @access public
	 * @param  (array) $translation_data Array contains translation information with multi-dimensional array.
	 *                 Array must be valid and must has valid structure
	 *                 array(
	 *                        array( 'source_language' => '', 'target_language' => '', 
	 *                               'charge_per_word' => '', 'charge_per_line' => '', 
	 *                               'charge_per_hour' => '', 'minimum_charge' => ''
	 *                        ) 
	 *                 )
	 * @param  (int) $user_id User's ID belong to the supplier
	 * @return (bool) TRUE if data created, otherwise FALSE
	 */
	function create_batch_translation_info( $translation_data, $user_id ) {
		// Make sure data is valid
		if( !empty( $translation_data ) && is_array( $translation_data ) ) {
			foreach( $translation_data as $key => $item ) {
				if( isset( $item[ 'source_language' ] ) ) {
					$entry[ 'source_language' ] = $item['source_language'];
				}

				if( isset( $item[ 'target_language'] ) ) {
					$entry['target_language'] = $item['target_language'];
				}

				if( isset( $item['charge_per_word'] ) ) {
					$entry['charge_per_word'] = $item['charge_per_word'];
				}

				if( isset( $item['charge_per_line'] ) ) {
					$entry['charge_per_line'] = $item['charge_per_line'];
				}

				if( isset( $item['charge_per_hour'] ) ) {
					$entry['charge_per_hour'] = $item['charge_per_hour'];
				}

				if( isset( $item['minimum_charge'] ) ) {
					$entry['minimum_charge'] = $item['minimum_charge'];
				}

				// Add user's ID
				$entry['user_id'] = $user_id;

				$data[ $key ] = $entry;
			}

			// Insert data
			$this->db->insert_batch( $this->db->dbprefix( 'supplier_translation_charge' ), $data );

			// Make sure update success
			return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0; 
		}

		return false;
	}

	/**
	 * Create multiple records of supplier interpreting information
	 *
	 * @access public
	 * @param  (array) $interpreting_data Array contains interpreting information with multi-dimensional array.
	 *                 Array must be valid and must has valid structure
	 *                 array(
	 *                        array( 'type' => '', 'language' => '', 'hours' => '', 
	 *                               'flat_rate' => '', 'days' => ''
	 *                        ) 
	 *                 )
	 * @param  (int) $user_id User's ID belong to the supplier
	 * @return (bool) TRUE if data created, otherwise FALSE
	 */
	function create_batch_interpreting_info( $interpreting_data, $user_id ) {
		// Make sure data is valid
		if( !empty( $interpreting_data ) && is_array( $interpreting_data ) ) {
			foreach( $interpreting_data as $key => $item ) {
				if( isset( $item[ 'type' ] ) ) {
					$entry[ 'type' ] = $item['type'];
				}

				if( isset( $item[ 'language'] ) ) {
					$entry['language'] = $item['language'];
				}

				if( isset( $item['hours'] ) ) {
					$entry['hours'] = $item['hours'];
				}

				if( isset( $item['flat_rate'] ) ) {
					$entry['flat_rate'] = $item['flat_rate'];
				}

				if( isset( $item['days'] ) ) {
					$entry['days'] = $item['days'];
				}

				// Add user's ID
				$entry['user_id'] = $user_id;

				$data[ $key ] = $entry;
			}

			// Insert data
			$this->db->insert_batch( $this->db->dbprefix( 'supplier_interpreting_charge' ), $data );

			// Make sure update success
			return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0; 
		}

		return false;
	}

	/**
	 * Update first and last name of user
	 *
	 * @access public
	 * @param  (int) $user_id User's belongs to the user
	 * @param  (string) $first_name First name of user
	 * @param  (string) $last_name Last name of user
	 * @return (bool) TRUE if first and last name updated, otherwise FALSE
	 */
	function update_user_display_name( $user_id, $first_name, $last_name ) {
		// Prepare data
		$data = array(
			'first_name' => $first_name,
			'last_name'  => $last_name
		);

		// Update first and last name
		$this->db->where( 'id', $user_id );
		$this->db->update( $this->db->dbprefix( $this->table ), $data );

		// Make sure update success
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Marked user completed application form. Users have to be sent application form
	 * in 30 days after registration. This will determine which users sent application form 
	 * and the users who haven't sent application in 30 days will be deleted automatically.
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs to the user
	 * @return (void)
	 */
	function complete_application_form( $user_id ) {
		$this->db->where( 'user_id', $user_id );
		$this->db->update( $this->db->dbprefix( 'translators' ), array( 'submit_application_form' => '1' ) );
	}

	/**
	 * Update native language of supplier
	 *
	 * @access public
	 * @param  (int) $user_id ID of user
	 * @param  (int) $lang_id ID of language
	 * @return (bool) TRUE if language successfully updated, otherwise FALSE 
	 */
	function update_supplier_native_language( $user_id, $lang_id ) {
		// Prepare data
		$data = array( 'language' => $lang_id );

		$this->db->where( 'id', $user_id );
		$this->db->update( $this->db->dbprefix( 'users' ), $data );

		// Make sure update success
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Update translator fields of expertise
	 *
	 * @access public
	 * @param  (int) $user_id ID of user
	 * @param  (array) $fields_of_expertise Fields of expertise array. Array must be valid format.
	 *          array(
	 *              array(
	 *                  'field_of_expertise_id'        => '',
	 *                  'main_field_of_expertise'      => '',
	 *                  'secondary_field_of_expertise' => '',
	 *                  'references'                   => '',
	 *                  'user_id'                      => ''
	 *              )
	 *          )
	 */
	function update_translator_fields_of_expertise( $user_id, $fields_of_expertise ) {
		// Prepare data
		if( !empty( $fields_of_expertise ) && is_array( $fields_of_expertise ) ) {
			foreach( $fields_of_expertise as $field_of_expertise ) {
				$data[] = array(
					'field_of_expertise_id'        => $field_of_expertise['field_of_expertise_id'],
					'main_field_of_expertise'      => (string) $field_of_expertise['main_field_of_expertise'],
					'secondary_field_of_expertise' => (string) $field_of_expertise['secondary_field_of_expertise'],
					'references'                   => $field_of_expertise['references'],
					'user_id'                      => $user_id
				);
			}
			
			$this->db->insert_batch( $this->db->dbprefix( 'supplier_fields_of_expertise' ), $data );
			
			// Make sure update success
			return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
		}
	}

	/**
	 * Get fields of expertise of a user
	 *
	 * @access public
	 * @param  (int) $user_id ID of user
	 * @return (array) Array contains the fields of expertise data
	 */
	function get_supplier_fields_of_expertise( $user_id ) {
		// Prepare query
		$sel = "f.id, f.main_field_of_expertise::int, f.secondary_field_of_expertise::int, f.references, f.user_id, 
				e.id AS field_of_expertise_id, title AS field_of_expertise_title";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'supplier_fields_of_expertise' ) . ' AS f' );
		$this->db->join( $this->db->dbprefix( 'field_of_expertise' ) . ' AS e', 'e.id = f.field_of_expertise_id', 'left' );

		$this->db->where( 'f.user_id', $user_id );
		
		$q = $this->db->get();

		return $q->result();
	}

	/**
	 * Delete supplier's fields of expertise
	 *
	 * @access public
	 * @param  (int) $user_id User's ID belongs to the field of expertise
	 * @param  (int) $field_of_expertise_id ID of field of expertise to delete
	 * @return (bool) TRUE if deleted, otherwise FALSE
	 */
	function delete_supplier_fields_of_expertise( $user_id, $field_of_expertise_id ) {
		// Delete fields of expertise
		$this->db->where( 'id', $field_of_expertise_id );
		$this->db->where( 'user_id', $user_id );

		$this->db->delete( $this->db->dbprefix( 'supplier_fields_of_expertise' ) );
		
		// Make sure update success
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Get supplier's projects
	 *
	 * @access public
	 * @param  (int) $supplier_id ID of supplier
	 * @param  (int) $offset Offset row to query
	 * @param  (int) $limit Limit of rows
	 * @param  (string) $order_by Order by specific column
	 * @param  (string) $order Order of column
	 * @return (object) Array contains projects object
	 */
	function get_supplier_projects( $supplier_id, $offset = 0, $limit = 10, $order_by = 'id', $order = 'DESC') {	
        /*Get all projects with removing  */
        $sel = "p.project_number, p.id, p.status AS status_id, p.project_name, p.memo, p.task_type, p.target_language, 
        		p.beo_order_number,	p.volume, p.originalfiletype, p.expectedfiletype, p.terminologyinfo, 
        		p.styleguideinfo, p.refmatinfo, p.project_manager,			 
				sub1.title_en as subject1, sub2.title_en as subject2, soft.name as software,
                p.start_date, p.deadline, l_s.name_en AS source_language, l_t.name_en AS target_language, 
                u.id AS user_id, u.first_name, u.last_name, u.username,  
                e.email_address, t.telephone, s.status";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( 'projects' ) . ' AS p' );
		$this->db->join( $this->db->dbprefix( 'users' ) . ' AS u', 'u.id = p.user_id', 'left' );
        $this->db->join( $this->db->dbprefix( 'project_status' ) . ' AS s', 's.id = p.status', 'left' );
        $this->db->join( $this->db->dbprefix( 'languages' ) . ' AS l_s', 'l_s.id = p.source_language', 'left' );
        $this->db->join( $this->db->dbprefix( 'languages' ) . ' AS l_t', 'l_t.id = p.target_language', 'left' );
        $this->db->join( $this->db->dbprefix( 'subjects' ) . ' AS sub1', 'p.subject1st_id = sub1.id', 'left' );
        $this->db->join( $this->db->dbprefix( 'subjects' ) . ' AS sub2', 'p.subject2nd_id = sub2.id', 'left' );
        $this->db->join( $this->db->dbprefix( 'softwares' ) . ' AS soft', 'p.translation_tool_id = soft.id', 'left' );
        $this->db->join( $this->db->dbprefix( 'user_emails' ) . ' AS e', 'u.id = e.user_id', 'left' );
        $this->db->join( $this->db->dbprefix( 'user_telephones' ) . ' AS t', 'u.id = t.user_id', 'left' );       
        
		/**
		 * Count query for all records
		 */
		$count_sel = "SELECT COUNT(p.id) AS total FROM " . $this->db->dbprefix( 'projects' ) . " AS p";
		$count_where = array();

		/**
		 * Find data with query parameters
		 */
		if( $this->input->get( 'status', true ) && intval( $this->input->get( 'status', true ) ) != '' ) {
			$this->db->where( 'p.status', $this->input->get( 'status', true ) );

			$where_sel = "p.status = " . $this->input->get( 'status', true );
			array_push( $count_where, $where_sel );
		}

		/**
		 * Find with task type
		 */
		if( $this->input->get( 'task_type', true ) && $this->input->get( 'task_type', true ) != '' ) {
			$this->db->where( 'p.task_type', $this->input->get( 'task_type', true ) );

			$where_sel = "p.task_type = '" . $this->input->get( 'task_type', true ) . "'";
			array_push( $count_where, $where_sel );
		}

		$this->db->where( 'p.user_id', $supplier_id );

		$where_sel = "p.user_id = " . $supplier_id;
		array_push( $count_where, $where_sel );

        $this->db->where( "p.status <> 5", NULL, FALSE );
        $this->db->order_by( $order_by, $order );
		$this->db->limit( $limit, $offset );
       
		$query = $this->db->get();
        
		if( !empty( $count_where ) && count( $count_where ) > 0 ) {
			$count_sel .= " WHERE " . implode( ' AND ', $count_where );
		}

		$count_query = $this->db->query( $count_sel );

		// Prepare result
		$result = array( 'results' => $query->result(), 'num_rows' => $count_query->row()->total );

		return $result;
	}

	/**
	 * Get project by ID from database with temporary data 
	 * This is temporary solution for deployment and presentation.
	 * 
	 * @access public
	 * @param  (int) $project_guid Project's GUID 
	 * @return (object) A project object return from database
	 */
	function get_supplier_project( $project_guid ) {
		/**
		 * The query statement is for temporary solution and later this method will 
		 * make API call to beoData for data exchange
		 */
		$sel = "p.*,p.id AS proj_id, u.id AS user_id, u.first_name, u.last_name, u.username, s.status, e.email_address, 
				t.telephone, f.fax_number, o_i.unit_id, o_i.quantity, o_i.unit_price, qa.* , fi.*, 
                sub1.title_en as subject1, sub2.title_en as subject2,
                soft.name as software";
        
        //order_items qa_reports files
		$this->db->select( $sel, false ); 
        $this->db->from( $this->db->dbprefix( 'projects' ) . ' AS p' );
		$this->db->join( $this->db->dbprefix( $this->table ) . ' AS u', 'u.id = p.user_id', 'inner' );
        $this->db->join( $this->db->dbprefix( 'user_emails' ) . ' AS e', 'u.id = e.user_id', 'left' );
        $this->db->join( $this->db->dbprefix( 'user_telephones' ) . ' AS t', 'u.id = t.user_id', 'left' );
        $this->db->join( $this->db->dbprefix( 'user_faxes' ) . ' AS f', 'u.id = f.user_id', 'left' );
        $this->db->join( $this->db->dbprefix( 'order_items' ) . ' AS o_i', 'p.beo_order_number = o_i.beo_order_number', 'left' );
        $this->db->join( $this->db->dbprefix( 'qa_reports' ) . ' AS qa', 'u.id = qa.user_id', 'left' );
        $this->db->join( $this->db->dbprefix( 'subjects' ) . ' AS sub1', 'p.subject1st_id = sub1.id', 'left' );
        $this->db->join( $this->db->dbprefix( 'subjects' ) . ' AS sub2', 'p.subject2nd_id = sub2.id', 'left' );
        $this->db->join( $this->db->dbprefix( 'softwares' ) . ' AS soft', 'p.translation_tool_id = soft.id', 'left' );
        $this->db->join( $this->db->dbprefix( 'files' ) . ' AS fi', 'u.id = fi.user_id OR qa.file_id = fi.id', 'left' );
		$this->db->join( $this->db->dbprefix( 'project_status' ) . ' AS s', 's.id = p.status', 'inner' );
		$this->db->where( 'p.beo_order_number', $project_guid );

		$this->db->limit( 1 );

		$q = $this->db->get();

		return $q->row();
	}

	/**
	 * Search supplier's projects with specific parameters
	 *
	 * @access public
	 * @param  (string) $project_order_date Project's order date with timestamp format
	 * @param  (string) $project_delivery_date Project's delivery date with timestamp format
	 * @return (object) Jobs object return by beoData
	 */
	function search_supplier_projects( $supplier_id, $project_order_date, $project_delivery_date, $offset = 0, $limit = 10, $order_by = 'p.id', $order = 'DESC' ) {
		/**
		 * The query statement is for temporary solution and later this method will 
		 * make API call to beoData for data exchange
		 */
	    
         $sel = "p.project_number, p.id, p.status AS status_id, p.project_name, p.memo, p.task_type, p.target_language, 
         		p.beo_order_number,	p.volume, p.originalfiletype, p.expectedfiletype, p.terminologyinfo, 
         		p.styleguideinfo, p.refmatinfo,			 
				sub1.title_en as subject1, sub2.title_en as subject2, soft.name as software,
                p.start_date, p.deadline, l_s.name_en AS source_language, l_t.name_en AS target_language,
                u.id AS user_id, u.first_name, u.last_name, u.username,  
                e.email_address, t.telephone,s.status";       
                
		$join = " LEFT JOIN " . $this->db->dbprefix( $this->table ) 
				. " AS u ON u.id = p.user_id"
				. " LEFT JOIN " . $this->db->dbprefix( 'project_status' )
				. " AS s ON s.id = p.status"
                . " LEFT JOIN " . $this->db->dbprefix( 'languages' )
				. " AS l_s ON l_s.id = p.source_language"
                . " LEFT JOIN " . $this->db->dbprefix( 'languages' )				
				. " AS l_t ON l_t.id = p.target_language"                
                 . " LEFT JOIN " . $this->db->dbprefix( 'subjects' )
				. " AS sub1 ON p.subject1st_id = sub1.id"
                 . " LEFT JOIN " . $this->db->dbprefix( 'subjects' )
				. " AS sub2 ON p.subject2nd_id = sub2.id"
                 . " LEFT JOIN " . $this->db->dbprefix( 'softwares' )
				. " AS soft ON p.translation_tool_id = soft.id"                
                . " LEFT JOIN " . $this->db->dbprefix( 'user_emails' )
				. " AS e ON u.id = e.user_id"
                . " LEFT JOIN " . $this->db->dbprefix( 'user_telephones' )
				. " AS t ON u.id = t.user_id";       
		$where = " WHERE ";

		// Find with query
		$like = '';

		if( '' != $this->input->get( 'q', true ) ) {
			$q      = $this->input->get( 'q', true );
			$filter = $this->input->get( 'filter', true );

			if( $filter == 'project_number' ) {
				$like .= " AND p.project_number LIKE '%" . $q . "%'";
			} else {
				$like .= " AND p.project_name LIKE '%" . $q . "%'";
			}
		}        
		// Find with status
		if( intval( $this->input->get( 'project_status', true ) ) > 0 ) {
			$where .= " p.status = " . intval( $this->input->get( 'project_status', true ) )." AND";
		}
        // Find with Source Language
		if( intval( $this->input->get( 'p-source-language', true ) ) > 0 ) {
			$where .= " p.source_language = " . intval( $this->input->get( 'p-source-language', true ) )." AND";
		}
        // Find with Target Language
		if( intval( $this->input->get( 'p-target-language', true ) ) > 0 ) {
			$where .= " p.target_language = " . intval( $this->input->get( 'p-target-language', true ) )." AND";
		}
        // Find with task type
        $task_type = $this->input->get( 'p-task-type', true );
        if(  $task_type && $task_type != '-1' ) {
            $where .= " p.task_type = " ."'". $this->input->get( 'p-task-type', true )."'" . " AND";
        }

        // Find between two date
        if( $project_order_date != NULL ) {
            $where .= " p.start_date >= '" . $project_order_date . "'" . " AND";
        }

        if( $project_delivery_date != NULL ) {
            $where .= " p.deadline <= '" . $project_delivery_date . "'" . " AND";
        }

        $where .= " p.status <> 5 AND";
		
        if( $where == " WHERE " && $like == ''){
            $where .= " '1'";
        }elseif( $where == " WHERE " && $like != '' ){
            $like = ltrim($like, ' OR');
        }else{
            $where = rtrim($where, 'AND');
        }

        $like .= " AND p.user_id=" . $supplier_id;
        
		// Order and limit
		$order = " ORDER BY " . $order_by . " " . $order;
		$limit = sprintf( " LIMIT %d OFFSET %d", $limit, $offset );

		// Select result
		$select = "SELECT " . $sel . " FROM " . $this->db->dbprefix( 'projects' ) . " AS p";

		// Count all result rows
		$select2 = "SELECT COUNT(p.id) AS total FROM " . $this->db->dbprefix( 'projects' ) . " AS p";
       
		// Query results       
		$query = $this->db->query( $select . $join . $where . $like . $order . $limit );
	    
		// Query all row count
		$query2 = $this->db->query( $select2 . $join . $where . $like );

		// Prepare result
		$result = array( 'results' => $query->result(), 'num_rows' => $query2->row()->total );

		return $result;
	}

	/**
	 * Get supplier's invoices
	 *
	 * @access public
	 * @param
	 * @return (array) Array contains supplier's invoice objects
	 */
	function get_supplier_invoices( $supplier_id, $offset = 0, $limit = 10, $order_by = 'id', $order = 'DESC' ) {
		$sel = 'i.id, i.posting_date, i.status_invoice, i.beo_invoice_number, i.supplier_invoice_number, i.guid, i.vat';

        $this->db->select( $sel, false );
        $this->db->from( $this->db->dbprefix( 'invoices' ) . ' AS i' );
        $this->db->where( 'i.user_id', $supplier_id );
        $this->db->order_by( $order_by, $order ); 
        $this->db->limit( $limit, $offset );

        $query = $this->db->get();
        
        // Count all results
        $this->db->select( "COUNT(i.id) AS total", false );
        $this->db->from( $this->db->dbprefix( 'invoices' ) . ' AS i' );
        $this->db->where( 'i.user_id', $supplier_id );
        
        $count_query = $this->db->get();

        // Prepare result
        $result = array( 'results' => $query->result(), 'num_rows' => $count_query->row()->total );

        return $result;
	}

	/**
	 * Get supplier's invoice by invoice's GUID
	 *
	 * @access public
	 * @return (object) Invoice object
	 */
	function get_supplier_invoice( $guid ) {
		$sel = "i.id, i.guid, i.posting_date, i.status_invoice, i.beo_invoice_number, i.user_id, i.supplier_invoice_number, i.vat";

        $this->db->select( $sel, false );
        $this->db->from( $this->db->dbprefix( 'invoices' ) . ' AS i' );
        $this->db->where( 'i.guid', $guid );

        $q = $this->db->get();

        return $q->row();
	}

	/**
	 * Search invoices of a supplier
	 *
	 * @access public
	 * @param  (int) $supplier_id Supplier's ID belongs to the invoices
	 * @param  (string) $filter Filter type
	 * @param  (string) $from_date From date to find the invoice
	 * @param  (string) $to_date To date to find the invoice
	 * @param  (int) $offset Row number to start find the records
	 * @param  (int) $limit Limit of records to return
	 * @param  (string) $order_by Order records by the column name
	 * @param  (string) $order Ordering of records
	 * @param  (array) Array contains the invoice objects
	 */
	function search_supplier_invoice( $supplier_id, $filter, $from_date, $to_date, $q = '', $offset = 0, $limit = 10, $order_by = 'i.id', $order = 'DESC' ) {
        $sel = 'i.id, i.posting_date, i.status_invoice, i.beo_invoice_number, i.supplier_invoice_number, i.guid, i.user_id, i.vat';
       
       	$like = ' WHERE i.user_id = ' . $supplier_id;
        
        if( $filter != '' ) {
            if( $filter == 'Settle' ) {
                $like .= " AND i.status_invoice = 2";
            } elseif( $filter == 'Open' ) {
                $like .= " AND i.status_invoice = 1";
            }
        }

        if( '' != $q ) {
            $like .= " AND i.beo_invoice_number LIKE '%" . $q . "%'";
        }

        if( $from_date != NULL ) {
            $like .= " AND '" . $from_date . "' <= i.posting_date";
        }
    
        if( $to_date != NULL ) {
            $like .= " AND i.posting_date <= '" . $to_date . "'";
        } else {
            $to_date = new DateTime('Now');
            $like .= " AND i.posting_date <= '" . $to_date->format( 'Y-m-d' ) . "'";
        }

        if( $order_by ) {
            if( $order_by == 'beo_invoice_number' ) {
                $order_by = " ORDER BY i.beo_invoice_number";
            } elseif( $order_by == 'posting_date' ) {
                $order_by = " ORDER BY i.posting_date";
            } else {
                $order_by = " ORDER BY i.id";
            }
        }

        $order_by = $order_by . " " . $order;

        $limit = sprintf( " LIMIT %d OFFSET %d", $limit, $offset );

        // Get actual results
        $select = "SELECT " . $sel . " FROM " . $this->db->dbprefix( 'invoices' ) . " AS i";

        $select2 = "SELECT COUNT(i.id) AS total FROM " . $this->db->dbprefix( 'invoices' ) . " AS i";
        
        $query = $this->db->query( $select . $like . $order_by . $limit );
        
		// To get all results for pagination
		$query2 = $this->db->query( $select2  . $like );
		
		$return = array(
			'results' => $query->result(),
			'total'   => $query2->row()->total
		);
        
		return $return;
    }
}

/* End */
/* Location: `application/modules/users/models/users_model.php` */