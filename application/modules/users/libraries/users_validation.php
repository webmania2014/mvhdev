<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Form validation library inside module
 * Set validation rules to validate with form validation class for module
 *
 * @package     CodeIgniter 2.2.0
 *
 * @module      users_module
 * @class       Users_validation
 */

class Users_validation {
	/**
	 * Class constructor
	 * Load CI object to access CI class and vars within this class
	 *
	 * @access private
	 * @return void
	 */
	function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->library( 'form_validation' );
		$this->ci->form_validation->set_error_delimiters( '', '' );

		$this->ci->form_validation->set_message( 'required', '%s is required.' );
		$this->ci->form_validation->set_message( 'min_length', '%s must be at least %d characters in length.' );
		$this->ci->form_validation->set_message( 'valid_email', 'Email you provided is not valid.' );
		$this->ci->form_validation->set_message( 'is_email_taken', 'Email already used.' );
	}
	
	/**
	 * Check validation methods exist and run if exists, otherwise, throw error
	 *
	 * @access private
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
	 * Set validation rules for create user form
	 *
	 * @access private
	 * @return void
	 */
	private function _create_admin() { 
		$this->ci->form_validation->set_rules( 'first_name', 'First name', 'htmlspecialchars|required|string' );
		$this->ci->form_validation->set_rules( 'last_name','Last name', 'htmlspecialchars|required|string' );
		$this->ci->form_validation->set_rules( 'username', 'Username', 'htmlspecialchars|required|string|min_length[8]|is_username_taken' );
		$this->ci->form_validation->set_rules( 'email_address', 'Email', 'htmlspecialchars|required|valid_email|is_email_taken' );
		$this->ci->form_validation->set_rules( 'password', 'Password', 'required|min_length[8]' );
		$this->ci->form_validation->set_rules( 're_password', 'Password', 'matches[password]' );
	}

	/**
	 * Set validation rules for admin edit form
	 *
	 * @access private
	 * @return void
	 */
	private function _edit_admin() { 
		$this->ci->form_validation->set_rules( 'first_name', 'First name', 'htmlspecialchars|required|string' );
		$this->ci->form_validation->set_rules( 'last_name','Last name', 'htmlspecialchars|required|string' );
		$this->ci->form_validation->set_rules( 'email_address', 'Email', 'required|valid_email|is_email_taken' );
	}

	/**
	 * Set validation rules for admin edit form
	 *
	 * @access private
	 * @return void
	 */
	private function _edit_admin_pass() {
		$this->ci->form_validation->set_rules( 'password', 'Password', 'required|min_length[8]' );
		$this->ci->form_validation->set_rules( 're_password', 'Password', 'matches[password]' );
	}

	/**
	 * Set validation rules for reset password from admin form
	 *
	 * @access private
	 * @return void
	 */
	private function _admin_reset_password() {
		$this->ci->form_validation->set_rules( 'current_password', 'Enter your current password.', 'required|min_length[8]|reset_password' );
		$this->ci->form_validation->set_rules( 'password', 'Enter your new password.', 'required|min_length[8]|new_password' );
		$this->ci->form_validation->set_rules( 're_password', 'Password', 'matches[password]' );

		$this->ci->form_validation->set_message( 'required', '%s' );
	}

	/**
	 * Set validation rules for editing username
	 *
	 * @access private
	 * @return void
	 */
	private function _admin_edit_username() {
		$this->ci->form_validation->set_rules( 'username', 'Username', 'required|min_length[8]|is_username_taken|htmlspecialchars' );

		$this->ci->form_validation->set_message( 'required', 'Please enter your new username.' );
	}

	/**
	 * Set validation rules for reset password form
	 *
	 * @access private
	 * @return void
	 */
	private function _reset_password() { 
		$this->ci->form_validation->set_rules( 'password', 'Password', 'required|min_length[8]' );
		$this->ci->form_validation->set_rules( 're_password', 'Re-enter Password', 'matches[password]' );
	}

	/**
	 * Set validation rules for update supplier's personal information
	 *
	 * @access private
	 * @return void
	 */
	private function _update_personal_information() {
		$this->ci->form_validation->set_rules( 'personal_title', 'Title', 'required' );
		$this->ci->form_validation->set_rules( 'first_name', 'First name', 'htmlspecialchars|required|string' );
		$this->ci->form_validation->set_rules( 'surname','Surname', 'htmlspecialchars|required|string' );
		$this->ci->form_validation->set_rules( 'applicant_type', 'Applicant Type', 'int|required|applicant_type' );
	}

	/**
	 * Set validation rules for update supplier's contact information
	 *
	 * @access private
	 * @return void
	 */
	private function _update_contact_information() {
		$this->ci->form_validation->set_rules( 'email', 'Email', 'required|valid_email|is_email_taken' );
		$this->ci->form_validation->set_rules( 'email2', 'Alternative Email Address', 'is_email_taken|valid_email' );
		$this->ci->form_validation->set_rules( 'telephone_num', 'Telephone', 'required|string' );
		$this->ci->form_validation->set_rules( 'mobile_phone_num', 'Mobile Phone Number', 'string' );
		$this->ci->form_validation->set_rules( 'fax_num', 'Fax Number', 'string' );
		$this->ci->form_validation->set_rules( 'url', 'Website', 'string' );
	}

	/**
	 * Set validation rules for update supplier's address information
	 *
	 * @access private
	 * @return void
	 */
	private function _update_address_information() {
		$this->ci->form_validation->set_rules( 'country', 'Country', 'int|required|country' );
		$this->ci->form_validation->set_rules( 'address', 'Address', 'required' );
		$this->ci->form_validation->set_rules( 'postal_code', 'Postal Code', 'required' );
		$this->ci->form_validation->set_rules( 'city', 'City', 'required' );
	}

	/**
	 * Set validation rules for translation charge
	 *
	 * @access private
	 * @return void
	 */
	private function _add_supplier_charge() {
		$this->ci->form_validation->set_rules( 'source_language', 'Source language', 'required' );
		$this->ci->form_validation->set_rules( 'target_language', 'Target language', 'required|match_with_source_language' );
		$this->ci->form_validation->set_rules( 'charge_per_word', 'Charge per word', 'required|numeric' );
		$this->ci->form_validation->set_rules( 'charge_per_line', 'Charge per line', 'required|numeric' );
		$this->ci->form_validation->set_rules( 'charge_per_hour', 'Charge per hour', 'required|numeric' );
		$this->ci->form_validation->set_rules( 'minimum_charge', 'Minimum charge', 'required|numeric' );
		$this->ci->form_validation->set_message( 'numeric', 'This field must contain only numbers and period.' );
	}

	/**
	 * Set validation rules for translation charge
	 *
	 * @access private
	 * @return void
	 */
	private function _add_interpreting_charge() {
		$this->ci->form_validation->set_rules( 'language', 'Language', 'required' );
		$this->ci->form_validation->set_rules( 'type', 'Type', 'required' );
		$this->ci->form_validation->set_rules( 'hours', 'Hours', 'required' );
		$this->ci->form_validation->set_rules( 'flat_rate', 'Flat rate', 'required|numeric' );
		$this->ci->form_validation->set_rules( 'days', 'Days', 'required' );
		$this->ci->form_validation->set_message( 'numeric', 'Flat rate must be number or float number.' );
	}

	/**
	 * Set validation rules for supplier absence
	 *
	 * @access private
	 * @return void
	 */
	private function _add_supplier_absence() {
		$this->ci->form_validation->set_rules( 'absence_from_date', 'From date', 'required' );
		$this->ci->form_validation->set_rules( 'absence_to_date', 'To date', 'required|valid_absence_to_date' );
		$this->ci->form_validation->set_rules( 'absence_type', 'Absence type', 'required' );
		if( $this->ci->input->post( 'absence_type', true ) == '3' ) {
			$this->ci->form_validation->set_rules( 'limited_capacity', 'Limited capacity', 'required|numeric' );
		}
	}

	/**
	 * Set validation rules for supplier softwares
	 *
	 * @access private
	 * @return void
	 */
	private function _update_supplier_softwares() {
		$this->ci->form_validation->set_rules( 'sfw', 'Software', 'required' );
		$this->ci->form_validation->set_message( 'required', 'Please select at least one item.', 'sfw' );
	}

	/**
	 * Set validation rules for supplier bio summary
	 *
	 * @access private
	 * @return void
	 */
	private function _update_supplier_bio() {
		$this->ci->form_validation->set_rules( 'bio_summary', 'string' );
	}	

	/**
	 * Set validation rules for update supplier fields of expertise
	 *
	 * @access private
	 * @return void
	 */
	private function _update_supplier_expertise_fields() {
		$this->ci->form_validation->set_rules( 'exp_ref', 'References', 'valid_expertise_reference' );
		$this->ci->form_validation->set_message( 'valid_expertise_reference', 'Please give references for your main field of expertise.' );


		// Get the fields
		/*$exp_field_refs  = $this->ci->input->post( 'exp_ref', true );
		$main_exp_fields = $this->ci->input->post( 'mf_exp', true );
		$sec_exp_fields  = $this->ci->input->post( 'sf_exp', true );
		$exp_fields      = $this->ci->input->post( 'expf', true );

		$error_fields = array();

		foreach( $exp_field_refs as $key => $value ) {
			$field = '';

			if( isset( $main_exp_fields[ $key ] ) || isset( $sec_exp_fields[ $key ] ) ) {
				$main_field = ( isset( $main_exp_fields[ $key ] ) ) ? '1' : '0';
				$sec_field  = ( isset( $sec_exp_fields[ $key ] ) ) ? '1' : '0';				

				if( $main_field == 1 && $value == '' ) {
					$this->ci->form_validation->set_rules( 'exp_ref', 'valid_expertise_reference' );
					$error_fields[] = array( 'exp_ref_' . $key => 'Please give references for your main field of expertise.' );
				}
			}
		}*/
		/*
		foreach( $exp_field_refs as $key => $value ) {
			$field = '';

			if( isset( $main_exp_fields[ $key ] ) || isset( $sec_exp_fields[ $key ] ) ) {
				$main_field = ( isset( $main_exp_fields[ $key ] ) ) ? '1' : '0';
				$sec_field  = ( isset( $sec_exp_fields[ $key ] ) ) ? '1' : '0';				

				if( $main_field == 1 && $value == '' ) {
					$error_fields[] = array( 'exp_ref_' . $key => 'Please give references for your main field of expertise.' );
				}

				$exps[ $key ] = array(
					'main_field'      => $main_field,
					'secondary_field' => $sec_field,
					'references'      => $value,
					'title'           => $exp_fields[ $key ]
				);
			}
		}

		if( !empty( $error_fields ) && count( $error_fields ) > 0 ) {
			return $error_fields;
		}

		return true;*/
	}

	/**
	 * Set validation rules for application form step 1
	 *
	 * @access private
	 * @return void
	 */
	private function _submit_application_step_one() {
		$this->ci->form_validation->set_rules( 'first_name', 'First name', 'htmlspecialchars|required|string' );
		$this->ci->form_validation->set_rules( 'last_name','Last name', 'htmlspecialchars|required|string' );
		$this->ci->form_validation->set_rules( 'email', 'Email', 'htmlspecialchars|required|valid_email|is_email_taken' );
		$this->ci->form_validation->set_rules( 'tax_number', 'Tax ID', 'htmlspecialchars|required|string' );
	}

	/**
	 * Set validation rules for application form step 2
	 *
	 * @access private
	 * @return void
	 */
	private function _submit_application_step_two() {
		$this->ci->form_validation->set_rules( 'native_lang', 'Mother tongue', 'required' );
		$this->ci->form_validation->set_rules( 'translation_source_lang', 'Source language', 'valid_translation_info' );
		$this->ci->form_validation->set_rules( 'interpreting_lang', 'Interpreting Language', 'valid_interpreting_info' );
	}

	/**
	 * Set validation rules for application form step 3
	 *
	 * @access private
	 * @return void
	 */
	private function _submit_application_step_three() {
		$this->validate( 'update_supplier_expertise_fields' );
	}

	/**
	 * Set validation rules for application form step 3
	 *
	 * @access private
	 * @return void
	 */
	private function _update_native_language() {
		$this->ci->form_validation->set_rules( 'native_lang', 'Language', 'required|valid_lang' );
	}
}

/* End */
/* Location: `application/modules/users/libraries/users_validation.php` */