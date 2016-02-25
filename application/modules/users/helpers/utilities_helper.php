<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Helper functions
 * Utilities helper functions for various tasks in users module. Generating HTML combo selection 
 * and other UI manipulation required special function will be associated with helper function.
 *
 * @package     CodeIgniter 2.2.0

 *
 * @module      users_module
 * @helper      utilities_helper
 */


if( !function_exists( 'is_valid_emails_entry' ) ) {
	/**
	 * Check valid input array format for emails
	 * Emails must be well formed with numeric array
	 * Eg. array( 'email1@example.com', 'email2@example.com' )
	 */
	function is_valid_emails_entry( $emails ) {
		// Make emails is not empty
		if( !is_array( $emails ) || empty( $emails ) || count( $emails ) < 1 ) {
			return false;
		}

		return true;
	}
}

if( !function_exists( 'prepare_emails_entry' ) ) {
	/**
	 */
	function prepare_emails_entry( $emails, $primary_index = 0 ) {
		// Make sure all params are well formed
		if( !is_valid_emails_entry( $emails ) ) {
			// Malformed, do nothing
			return array(
				array( 'email_address' => '', 'is_primary' => '' )
			);
		}

		for( $i = 0; $i < count( $emails ); $i++ ) {
			$email_entry[ $i ] = array(
				'email_address' => $emails[ $i ],
				'is_primary'  => ( $i == $primary_index ) ? TRUE : FALSE
			);
		}

		return $email_entry;
	}
}

if( !function_exists( 'is_valid_telephones_entry' ) ) {
	/**
	 * Check valid input array format for telephones
	 * Telephones must be well formed with numeric array
	 * Eg. array( '123456789', '987654321' )
	 */
	function is_valid_telephones_entry( $telephone_numbers ) {
		// Make telephone numbers is not empty
		if( !is_array( $telephone_numbers ) || empty( $telephone_numbers ) || count( $telephone_numbers ) < 1 ) {
			return false;
		}

		return true;
	}
}

if( !function_exists( 'prepare_telephones_entry' ) ) {
	/**
	 */
	function prepare_telephones_entry( $telephone_numbers, $primary_index = 0 ) {
		// Make sure all params are well formed
		if( !is_valid_telephones_entry( $telephone_numbers ) ) {
			// Malformed, do nothing
			return array(
				array( 'telephone' => '', 'is_primary' => '' )
			);
		}

		for( $i = 0; $i < count( $telephone_numbers ); $i++ ) {
			$telephone_entry[ $i ] = array(
				'telephone'   => $telephone_numbers[ $i ],
				'is_primary'  => ( $i == $primary_index ) ? TRUE : FALSE
			);
		}

		return $telephone_entry;
	}
}

if( !function_exists( 'is_valid_addresses_entry' ) ) {
	/**
	 * Check valid input array format for addresses
	 * Addresses must be well formed for various subjects, such as City, Country, Postal Code
	 * with numeric array format and must contain same array elements
	 */
	function is_valid_addresses_entry( $postal_codes, $cities, $countries, $addresses ) {
		// Make sure the containing array elements for all must be same
		$postal_codes_num = count( $postal_codes );
		$cities_num       = count( $cities );
		$countries_num    = count( $countries );
		$addresses_num    = count( $addresses );

		if( $postal_codes_num > 0 && $cities_num > 0 && $countries_num > 0 && $addresses_num > 0 ) {
			if( ( $postal_codes_num == $cities_num ) && ( $countries_num == $addresses_num ) && ( $countries_num == $postal_codes_num ) ) {
				return true;
			}
		}
		return false;
	}
}

if( !function_exists( 'prepare_addresses_entry' ) ) {
	/**
	 */
	function prepare_addresses_entry( $postal_codes, $cities, $countries, $addresses, $primary_index = 0 ) {
		// Make sure all params are well formed
		if( !is_valid_addresses_entry( $postal_codes, $cities, $countries, $addresses ) ) {
			// Malformed, do nothing
			return array(
				array( 'postal_code' => '', 'city' => '', 'country_code' => '', 'address' => '', 'is_primary' => '' )
			);
		}

		for( $i = 0; $i < count( $postal_codes ); $i++ ) {
			$address_entry[ $i ] = array(
				'postal_code'  => $postal_codes[ $i ],
				'city'         => $cities[ $i ],
				'country_code' => $countries[ $i ],
				'address'      => $addresses[ $i ],
				'is_primary'   => ( $i == $primary_index ) ? TRUE : FALSE
			);
		}

		return $address_entry;
	}
}

if( !function_exists( 'is_valid_contact_type' ) ) {
	/**
	 * Check contact type is valid and exists in system
	 * @param: (int) $contact_type Integer number representings one of contact type to check
	 */
	function is_valid_contact_type( $type_id ) {
		// Get the contact types from system
		$ci = &get_instance();

		if( !isset( $ci->users_model ) ) {
			$ci->load->model( 'users/users' );
		}

		// Get the contact types
		$contact_types = $ci->users_model->get_applicant_types();

		foreach( $contact_types as $type ) {
			$type_ids[] = $type->id;
		}

		// Check type exists
		return in_array( $type_id, $type_ids );
	}
}

if( !function_exists( 'is_valid_contact_status' ) ) {
	/**
	 * Check contact status is valid and exists in system
	 * @param: (int) $contact_status Integer number representings one of contact status to check
	 */
	function is_valid_contact_status( $status_id ) {
		// Get the contact types from system
		$ci = &get_instance();

		if( !isset( $ci->users_model ) ) {
			$ci->load->model( 'users/users' );
		}

		// Get the contact types
		$contact_statuses = $ci->users_model->get_applicant_statuses();

		foreach( $contact_statuses as $status ) {
			$status_ids[] = $status->id;
		}

		// Check status exists
		return in_array( $status_id, $status_ids );
	}
}

if( !function_exists( 'get_user_roles_dropdown' ) ) {
	/**
	 * Generate HTML combo select for user roles
	 *
	 * @param:
	 */
	function get_user_roles_dropdown( $selected = '', $name = '', $id = '', $class = '', $pre_selected = true, 
										$pre_selected_text = 'Select Role' ) {
		// Get CI object
		$ci = &get_instance();

		// Check users model already loaded, if not load it
		if( !isset( $ci->users_model ) ) {
			$ci->load->model( 'users/users' );
		}

		// Get the user roles
		$user_roles = $ci->users_model->get_user_roles();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'user-role' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			$html .= '<option value="-1">' . $pre_selected_text . '</option>';
		}

		$selected_text = '';

		foreach( $user_roles as $user_role ) {
			if( !$pre_selected ) {
				$selected_text = ( $selected == $user_role->id ) ? ' selected' : '';
			}

			$html .= '<option value="' . $user_role->id . '"' . $selected_text . '>' . $user_role->role_title . '</option>';
		}

		$html .= '</select>';

		echo $html;
	}
}

if( !function_exists( 'get_applicant_types_dropdown' ) ) {
	/**
	 * Generate HTML combo select for applicant types
	 *
	 * @param:
	 */
	function get_applicant_types_dropdown( $selected = '', $name = '', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Select Applicant Type' ) {
		// Get CI object
		$ci = &get_instance();

		// Check users model already loaded, if not load it
		if( !isset( $ci->users_model ) ) {
			$ci->load->model( 'users/users' );
		}

		// Get the applicant types
		$applicant_types = $ci->users_model->get_applicant_types();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'applicant-type' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			$html .= '<option value="-1">' . $pre_selected_text . '</option>';
		}

		$selected_text = '';

		foreach( $applicant_types as $applicant_type ) {

			if( $ci->input->get( $name, true ) && $ci->input->get( $name, true ) == $applicant_type->id ) {
				$selected_text = ' selected';
			} else {
				$selected_text = '';

				if( !$pre_selected ) {
					$selected_text = ( $selected == $applicant_type->id ) ? ' selected' : '';
				}
			}

			$html .= '<option value="' . $applicant_type->id . '"' . $selected_text . '>' . $applicant_type->type . '</option>';
		}

		$html .= '</select>';

		echo $html;
	}
}

if( !function_exists( 'get_applicant_statuses_dropdown' ) ) {
	/**
	 * Generate HTML combo select for applicant statueses
	 *
	 * @param:
	 */
	function get_applicant_statuses_dropdown( $selected = '', $name = '', $id = '', $class = '', $pre_selected = true, 
												$pre_selected_text = 'Select Applicant Status' ) {
		// Get CI object
		$ci = &get_instance();

		// Check users model already loaded, if not load it
		if( !isset( $ci->users_model ) ) {
			$ci->load->model( 'users/users' );
		}

		// Get the applicant statuses
		$applicant_statuses = $ci->users_model->get_applicant_statuses();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'applicant-status' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			$html .= '<option value="-1">' . $pre_selected_text . '</option>';
		}

		$selected_text = '';

		foreach( $applicant_statuses as $applicant_status ) {
			if( !$pre_selected ) {
				$selected_text = ( $selected == $applicant_status->id ) ? ' selected' : '';
			}

			$html .= '<option value="' . $applicant_status->id . '"' . $selected_text . '>' . $applicant_status->status . '</option>';
		}

		$html .= '</select>';

		echo $html;
	}
}

if( !function_exists( 'print_applicant_status_label' ) ) {
	/**
	 * Generate HTML to display applicant status with nice label format
	 *
	 * @access public
	 * @param  (int) $status_id ID of status
	 * @param  (string) $label Text to display
	 * @return mixed
	 */
	function print_applicant_status( $status_id = '2', $label = '' ) {
		/**
		 * Define applicant statuses in system
		 */
		$status = array(
			'1' => array(
				'label' => 'Accepted',
				'meta'  => 'success'
			),
			'2' => array(
				'label' => 'Applicant',
				'meta'  => 'warning'
			),
			'3' => array(
				'label' => 'Potential',
				'meta'  => 'info'
			),
			'4' => array(
				'label' => 'Rejected',
				'meta'  => 'important'
			)
		);

		// Get the status
		$ret = $status[ $status_id ];

		$label = ( $label ) ? $label : $ret['label'];

		echo '<span class="label label-' . $ret['meta'] . '">' . $label . '</span>';
	}
}

if( !function_exists( 'get_applicant_statuses_dropdown_selected' ) ) {
	/**
	 * Generate HTML combo select for applicant statueses
	 *
	 * @param:
	 */
	function get_applicant_statuses_dropdown_selected( $selected = '', $name = '', $id = '', $class = '', $pre_selected = true, 
												$pre_selected_text = 'Select Applicant Status' ) {
		// Get CI object
		$ci = &get_instance();

		// Check users model already loaded, if not load it
		if( !isset( $ci->users_model ) ) {
			$ci->load->model( 'users/users' );
		}

		// Get the applicant statuses
		$applicant_statuses = $ci->users_model->get_applicant_statuses();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'applicant-status' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			$html .= '<option value="-1">' . $pre_selected_text . '</option>';
		}

		$selected_text = '';
        foreach( $applicant_statuses as $applicant_status ) {

			if( $ci->input->get( $name, true ) && $ci->input->get( $name, true ) == $applicant_status->id ) {
				$selected_text = ' selected';
			} else {
				$selected_text = '';

				if( !$pre_selected ) {
					$selected_text = ( $selected == $applicant_status->id ) ? ' selected' : '';
				}
			}

			$html .= '<option value="' . $applicant_status->id . '"' . $selected_text . '>' . $applicant_status->status . '</option>';
		}

		$html .= '</select>';

		echo $html;
    }
}


if( !function_exists( 'filter_translations_info' ) ) {
	/**
	 * Filter translation information from application form and prepare 
	 * for the entry with appropriate array format before passing to model. 
	 * Data will be formatted as multi-dimensional array with associative 
	 * key and value pair.
	 *
	 * @access public
	 * @param  (array) $translation_source_langs Source languages array
	 * @param  (array) $translation_target_langs Target languages array
	 * @param  (array) $words Words array
	 * @param  (array) $lines Lines array
	 * @param  (array) $hours Hours array
	 * @param  (array) $minimum_charges Minimum charges array
	 * @return (array) Associative array of translations information
	 */
	function filter_translations_info( $translation_source_langs, $translation_target_langs, 
										$words, $lines, $hours, $minimum_charges ) {
		// Make sure entry is array
		if( !is_array( $translation_source_langs ) || !is_array( $translation_target_langs ) 
			|| !is_array( $words ) || !is_array( $lines ) || !is_array( $hours ) || !is_array( $minimum_charges ) ) {
			return array();
		}

		// Data array
		$translation_data = array();

		foreach( $translation_source_langs as $key => $value ) {
			if( '' != $value ) {
				$translation_data[] = array(
					'source_language'   => $value,
					'target_language'   => $translation_target_langs[ $key ],
					'charge_per_word'   => $words[ $key ],
					'charge_per_line'   => $lines[ $key ],
					'charge_per_hour'   => $hours[ $key ],
					'minimum_charge'    => $minimum_charges[ $key ]
				);
			}
		}

		return $translation_data;
	}
}

if( !function_exists( 'filter_interpreting_info' ) ) {
	/**
	 * Filter interpreting information from application form and prepare 
	 * for the entry with appropriate array format before passing to model. 
	 * Data will be formatted as multi-dimensional array with associative 
	 * key and value pair.
	 *
	 * @access public
	 * @param  (array) $interpreting_types Interpreting types array
	 * @param  (array) $interpreting_langs Interpreting languages array
	 * @param  (array) $interpreting_hours Interpreting hours array
	 * @param  (array) $interpreting_rates Interpreting flat rates array
	 * @param  (array) $interpreting_days Interpreting days array
	 * @return (array) Associative array of interpreting information
	 */
	function filter_interpreting_info( $interpreting_types, $interpreting_langs, $interpreting_hours, 
										$interpreting_rates, $interpreting_days ) {
		// Make sure entry is array
		if( !is_array( $interpreting_types ) || !is_array( $interpreting_langs ) 
			|| !is_array( $interpreting_hours ) || !is_array( $interpreting_rates ) 
			|| !is_array( $interpreting_days ) ) {
			return array();
		}

		// Data array
		$interpreting_data = array();

		foreach( $interpreting_langs as $key => $value ) {
			if( '' != $value ) {
				$interpreting_data[] = array(
					'type'              => $interpreting_types[ $key ],
					'language'          => $value,
					'hours'             => $interpreting_hours[ $key ],
					'flat_rate'         => $interpreting_rates[ $key ],
					'days'              => $interpreting_days[ $key ]
				);
			}
		}

		return $interpreting_data;
	}
}

if( !function_exists( 'filter_fields_of_expertise' ) ) {
	/**
	 * Filter fields of expertise fields from application form and prepare 
	 * for the entry with appropriate array format before passing to model. 
	 * Data will be formatted as multi-dimensional array with associative 
	 * key and value pair.
	 *
	 * @access public
	 * @param  (array) $expf_ids Fields of expertise ID array
	 * @param  (array) $expf_mf Main field of expertise array
	 * @param  (array) $expf_sf Secondary field of expertise array
	 * @param  (array) $expf_ref References array
	 * @return (array) Associative array of fields of expertise
	 */
	function filter_fields_of_expertise( $expf_ids, $expf_mf, $expf_sf, $expf_ref ) {
		// Make sure entry is array
		if( !is_array( $expf_ids ) ) {
			return array();
		}

		// Data array
		$fields_of_expertise_data = array();
		
		foreach( $expf_ids as $key => $value ) {
			if( isset( $expf_mf[ $key ] ) || isset( $expf_sf[ $key ] ) ) {
				$main_field_of_expertise = ( isset( $expf_mf[ $key ] ) && $expf_mf[ $key ] == 1 ) ? 1 : 0;
				$secondary_field_of_expertise = ( isset( $expf_sf[ $key ] ) && $expf_sf[ $key ] == 1 ) ? 1 : 0;
				$references = ( isset( $expf_ref[ $key ] ) ) ? $expf_ref[ $key ] : '';

				$fields_of_expertise_data[ $key ] = array(
					'field_of_expertise_id'        => $key,
					'main_field_of_expertise'      => $main_field_of_expertise,
					'secondary_field_of_expertise' => $secondary_field_of_expertise,
					'references'                   => $references,
					'title'                        => $value
				);
			}
		}

		return $fields_of_expertise_data;
	}
}

if( !function_exists( 'update_application_form_session_data' ) ) {
	/**
	 * Update application form data in session
	 * If no application form data already defined in session, it creats and add into session
	 * or update if session already exists
	 *
	 * @access public
	 * @param  (array) Application form data array. Array must be associative array with key and value.
	 * @return (void)
	 */
	function update_application_form_session_data( $application_form_data ) {
		if( !empty( $application_form_data ) && is_array( $application_form_data ) ) {
			// Get application data from session
			$CI =& get_instance();

			$application_session_data = $CI->session->userdata( 'application_form_data' );

			if( $application_session_data !== false ) {
				$update_application_form_data = array_merge( $application_session_data, $application_form_data );
			} else {
				$update_application_form_data = $application_form_data;
			}

			// Update application form data in session
			$CI->session->set_userdata( 'application_form_data', $update_application_form_data );
		}
	}
}

if( !function_exists( 'get_application_session_data' ) ) {
	/**
	 * Get specific application form data stored in session
	 *
	 * @access public
	 * @param  (string) $name Session name to get
	 * @param  (mixed) $default Default value if there's no data in session or session hasn't already defined
	 * @return (string) Value match with session name stored in application form data or default if no session data found.
	 */
	function get_application_session_data( $name, $default = '' ) {
		$CI =& get_instance();

		// Check if data already exists in session
		$application_session_data = $CI->session->userdata( 'application_form_data' );

		if( $application_session_data !== false ) {
			return ( isset( $application_session_data[ $name ] ) ) ? $application_session_data[ $name ] : $default;
		}

		return $default;
	}
}

if( !function_exists( 'generate_guid' ) ) {
	function generate_guid() {

		mt_srand( (double)microtime() * 10000 ); //optional for php 4.2.0 and up.
        
        // Generate unique ID string
        $random_guid = strtoupper( md5( uniqid( rand(), true ) ) );
        
        // Use hyphen to separate GUID string
        $hyphen = chr(45); // "-"
        
        // Separate GUID with hyphen
        $guid = substr( $random_guid, 0, 8 ) . $hyphen 
              . substr( $random_guid, 8, 4 ) . $hyphen 
              . substr( $random_guid, 12, 4 ) . $hyphen 
              . substr( $random_guid, 16, 4 ) . $hyphen 
              . substr( $random_guid, 20, 12 );

        return $guid;
	}
}

/* End */
/* Location: `application/modules/users/helpers/utilities_helper.php` */