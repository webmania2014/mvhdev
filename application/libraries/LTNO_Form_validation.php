<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * Form validation extend library
 * Extends CI form validation class with integrated validation methods
 * @package     CodeIgniter 2.2.0
 */

class LTNO_Form_validation extends CI_Form_validation {
	public function __construct() {
		parent::__construct();

		$this->CI =& get_instance();

		// Load language file where validation message declared, we can use multi-lingual purpose
		//$this->CI->lang->load( 'LTNO_Form_validation' );
	}

	/**
	 * Get the value from a form
	 *
	 * Permits you to repopulate a form field with the value it was submitted
	 * with, or, if that value doesn't exist, with the default
	 *
	 * @access	public
	 * @param	string	the field name
	 * @param	string
	 * @return	void
	 */
	public function set_value($field = '', $default = '')
	{
		if ( ! isset($this->_field_data[$field]))
		{
			if( $this->CI->input->post( $field ) === FALSE ) {
				return $default;
			} else {
				return $this->CI->input->post( $field, true );
			}
		}

		// If the data is an array output them one at a time.
		//     E.g: form_input('name[]', set_value('name[]');
		if (is_array($this->_field_data[$field]['postdata']))
		{
			return array_shift($this->_field_data[$field]['postdata']);
		}

		return $this->_field_data[$field]['postdata'];
	}

	/**
	 * Get the validation errorsarray from parent class
	 */
	public function errors_array() {
		return $this->_error_array;
	}

	/**
	 * Validate country from form input
	 */
	function country( $country_code ) {
		if( $country_code < 0 || !$country_code ) {
			$this->set_message( 'country', 'Please select your country.' );
		} else {
			$this->set_message( 'country', 'Country is not valid.' );
		}

		// Get countries list from database and check it
		$country_codes = $this->CI->app_model->get_country_codes();

		// Check countries exist in system
		return ( in_array( $country_code, $country_codes ) ) ? TRUE : FALSE;
	}

	/**
	 * Validate applicant tye from form input
	 * @param: (int) $type_id Applicant type ID to check
	 * @return: (bool) TRUE if applicant type ID match with one of applicant type exists in system.
	 *           Otherwise, FALSE will return
	 */
	function applicant_type( $type_id ) {
		if( $type_id < 0 ) {
			$this->set_message( 'applicant_type', 'Please select applicant type.' );
		} else {
			$this->set_message( 'applicant_type', 'Applicant type does\'t exists.' );
		}

		// Get applicant types from database
		$applicant_type_ids = $this->CI->users_model->get_applicant_type_ids();

		// Check applicant type ID exists in system
		return ( in_array( $type_id, $applicant_type_ids ) ) ? TRUE : FALSE;
	}

	/**
	 * Check username is already taken by someone
	 * @param: (string) $username User name to check valid or not
	 * @return: (bool) TRUE if username is not taken by other user, otherwise FALSE
	 */
	function is_username_taken( $username ) {
		// Check username already exist in system
		$user = $this->CI->users_model->get_user_by_username( $username );

		if( $user ) {
			// Username already exists
			$this->set_message( 'is_username_taken', 'Username is already taken.' );
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * Check email is already taken by someone
	 * @param: (string) $email Email address to check valid or not
	 * @return: (bool) TRUE if email is not taken by other user, otherwise FALSE
	 */
	function is_email_taken( $email ) {
		// Check if there is user's ID in form
		$user_id = $this->CI->input->post( 'user', true );

		// Get user with email
		$user = $this->CI->users_model->get_user_by_email( $email );

		if( $user && $user->id != $user_id ) {
			return FALSE;
		}
		
		return TRUE;
	}

	/**
	 * Check current password is correct when trying to change new password
	 * @access public
	 * @param  (string) $password Password to check with current user's password
	 * @return (bool) TRUE if password match, otherwise FALSE
	 */
	function reset_password( $password ) {
		// User's ID must provide in form with hidden field
		$user_id = $this->CI->input->post( 'user', true );

		// Find the password with user's ID
		$stored_password = $this->CI->users_model->get_user_password( $user_id );

		// Load encryption library
		$this->CI->load->library( 'phpass' );
		$this->CI->phpass->setup( 8, true );
		
		// Check password match
		if( !$this->CI->phpass->checkPassword( $password, $stored_password ) ) {
			$this->set_message( 'reset_password', 'Password is not correct.' );
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * Check new password is match with old password. New password should not same with old one.
	 * @access public
	 * @param  (string) $password Password to check with current user's password
	 * @return (bool) TRUE if password match, otherwise FALSE
	 */
	function new_password( $password ) {
		// User's ID must provide in form with hidden field
		$user_id = $this->CI->input->post( 'user', true );

		// Find the password with user's ID
		$stored_password = $this->CI->users_model->get_user_password( $user_id );

		// Load encryption library
		$this->CI->load->library( 'phpass' );
		$this->CI->phpass->setup( 8, true );
		
		// Check password match
		if( $this->CI->phpass->checkPassword( $password, $stored_password ) ) {
			$this->set_message( 'new_password', 'New password should not same with old one. Please choose a different password.' );
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * Check user check the box to agree terms and conditions
	 *
	 * @access public
	 * @return (bool) TRUE if user check to agree terms and conditions, otherwise FALSE
	 */
	function accept_terms( $val ) {
		if( $val === FALSE || $val != 1 || $val != '1' ) {
			$this->set_message( 'accept_terms', 'You\'ve to agree our terms and conditions.' );
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * Check security question is valid and correct
	 *
	 * @access public
	 * @return (bool) TRUE if it's correct, otherwise FALSE
	 */
	function security_question( $answer ) {
		if( $answer == '' || empty( $answer ) ) {
			$this->set_message( 'seq', 'Please answer the question.' );
			return FALSE;
		}

		// Get the security question stored in session flash data
		$seq = $this->CI->session->flashdata( 'seq' );
		
		if( $answer != $seq ) {
			$this->set_message( 'security_question', 'Please provide valid answer.' );
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * Check same company name for same country already exists in system
	 *
	 * @access public
	 * @return (bool) FALSE if it does exist already, otherwise TRUE
	 */
	function company_name( $company_name ) {
		// Check in db
		$this->CI->db->select( 'ARRAY_AGG(user_id) AS user_ids', false );
		$this->CI->db->from( $this->CI->db->dbprefix( 'translators' ) );
		$this->CI->db->where( 'company', $company_name );
		$this->CI->db->group_by( 'company' );

		$query = $this->CI->db->get();
		
		if( $query->num_rows() > 0 ) {
			// There is also same company name exist in system
			$user_ids = $query->row()->user_ids;
			$user_ids = explode( ',', str_replace( array( '{', '}' ), '', $user_ids ) );
			
			$this->CI->db->select( 'u.country_code, c.name' );
			$this->CI->db->from( $this->CI->db->dbprefix( 'user_addresses' ) . ' AS u' );
			$this->CI->db->join( $this->CI->db->dbprefix( 'countries' ) . ' AS c', 'c.iso_country_code = u.country_code', 'left' );
			$this->CI->db->where_in( 'u.user_id', $user_ids );

			$query = $this->CI->db->get();

			foreach( $query->result() as $row ) {
				$countries[ $row->country_code ] = $row->name;
			}

			// Check user selected country is already exists in system
			if( isset( $countries[ $this->CI->input->post( 'country', true ) ] ) ) {
				$this->set_message( 'company_name', 'There is same company for ' . $countries[ $this->CI->input->post( 'country', true ) ] . ' already registered.' );
				return FALSE;
			}
			
			return TRUE;
			
		}

		return TRUE;
	}

	/**
	 * Check slug is already exists
	 * @param: (string) $slug
	 * @return: (bool) TRUE if slug is not exists, otherwise FALSE
	 */
	function is_pages_slug_taken( $slug ) {
		// Check if there is slug in form
		$slug = $this->CI->input->post( 'slug', true );

		if( $slug ) {

			$row = $this->CI->pages_model->find( array( 'where' => array( 'slug' => $slug ) ) );

			// If slug is same with page slug
			if( (!empty($row) && $slug == $row->slug)
				|| (!empty($row) && $slug != $row->slug)
				|| empty($row) ) {
				return TRUE;
			} else {
				$this->set_message( 'is_pages_slug_taken', 'The Slug field must contain a unique value.' );
				return FALSE;
			}

		} else {
			return FALSE;	
		}

	}

	/**
	 * Check slug is already exists
	 * @param: (string) $slug
	 * @return: (bool) TRUE if slug is not exists, otherwise FALSE
	 */
	function is_news_slug_taken( $slug ) {
		// Check if there is slug in form
		$slug = $this->CI->input->post( 'slug', true );

		if( $slug ) {

			$row = $this->CI->news_model->find( array( 'where' => array( 'slug' => $slug ) ) );

			// If slug is same with page slug
			if( (!empty($row) && $slug == $row->slug)
				|| (!empty($row) && $slug != $row->slug)
				|| empty($row) ) {
				return TRUE;
			} else {
				$this->set_message( 'is_news_slug_taken', 'The Slug field must contain a unique value.' );
				return FALSE;
			}

		} else {
			return FALSE;	
		}

	}
    
    function valid_email_non_english($email){
       
        $email_temp =  explode( '@', $email );  
        $email_temp[0] = $email_temp[0].'@';
        //var_dump($email_temp[1]);exit;
        $pattern_name_email = '/(^[\pL\pN\s._-{8,30}]++[@])/u';        
        $pattern_domain_email = '/(^[\pL\pN\s._-{8,30}])/u';
        if(preg_match($pattern_domain_email, $email_temp[1],$match)){
            if ( strlen(strstr($email_temp[1],'.')) > 0 ) {
            //found character '.' in string
                $pattern_domain_email_first = '/(^[\pL\pN\s._-{2,10}])/u';
                $pattern_domain_email_second = '/(^[\pL\pN\s._-{2,4}])/u';
                $temp = explode('.',$email_temp[1]);
                return ( !((preg_match($pattern_name_email, $email_temp[0],$match))&&(preg_match($pattern_domain_email_first, $temp[0],$match))&&(preg_match($pattern_domain_email_second, $temp[1],$match)))) ? FALSE : TRUE;
            }
            return false;
        }
        return false;
    }
       // return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
    
    /**
     * Check target language selection is same with source language
     *
     * @access public
     * @param  (string) $target_language Target language value
     * @return (bool) TRUE if target language is not matching with source language. Otherwise, FALSE
     */
    function match_with_source_language( $target_language ) {
    	if( $this->CI->input->post( 'source_language' ) == $target_language ) {
    		$this->set_message( 'match_with_source_language', 'Source and target language should not be same.' );
    		return FALSE;
    	}

    	return TRUE;
    }

    /**
     * Check absence to date is valid and not smaller than from date
     *
     * @access public
     * @param  (string) $absence_to_date Absence to date
     * @return (bool) TRUE if absence to date is not smaller than from date. Otherwise, FALSE
     */
    function valid_absence_to_date( $absence_to_date ) {
    	// Get absence from date
    	$absence_from_date = $this->CI->input->post( 'absence_from_date', true );
    	$absence_from_date = strtotime( $absence_from_date );

    	$absence_to_date = strtotime( $absence_to_date );

    	if( $absence_to_date < $absence_from_date ) {
    		$this->set_message( 'valid_absence_to_date', 'End date shouldn\'t be smaller than start date.' );
    		return false;
    	}

    	return true;
    }

    /**
     * Check selection for supplier fields of expertise form.
     * 
     * @access public
     * @param  (string) $fields Input fields to check
     * @return (bool) TRUE if input is valid, otherwise FALSE.
     */
    function valid_expertise_reference( $fields ) {
    	// Get the expertise fields
    	$main_fields = $this->CI->input->post( 'mf_exp', true );
    	$sec_fields  = $this->CI->input->post( 'sf_exp', true );

    	/**
    	 * At least one field must be checked from fields of expertise combo array regardless 
    	 * of main field of expertise or secondary field of expertise. If main field of expertise is checked, 
    	 * the reference is required
    	 */
    	if( !isset( $_POST['mf_exp'] ) && !isset( $_POST['sf_exp'] ) ) {
    		// Error message
    		$error_msg = 'Please select your fields of expertise.';
    		$this->set_message( 'valid_expertise_reference', $error_msg );
    		
    		// Add error
			$this->_error_array[ 'expf' ] = $error_msg;
    		return false;
    	}

    	// Errors array
    	$errors = array();

    	// Check only fields are not empty
    	if( !empty( $fields ) && count( $fields ) ) {
    		// Loop fields to check
    		foreach( $fields as $key => $value ) {
    			/**
    			 * Main field of expertise is checked, but no refernece information provided
    			 * Reference is required for main field of expertise
    			 */
    			if( isset( $main_fields[ $key ] ) && '' == $value ) {
    				// Error message
    				$error_msg = 'Please give references for your main field of expertise.';

    				// Set error message for current field
    				$errors[] = array(
    					'exp_ref_' . $key => $error_msg
    				);

    				// Add error
    				$this->_error_array[ 'exp_ref_' . $key ] = $error_msg;
    			}
    		}

    		// If any errors occurred
    		if( isset( $errors ) && !empty( $errors ) && count( $errors ) > 0 ) {
    			return false;
    		}
    	}

    	return true;    	
    }

    /**
     * Validate dropdown value is not default value 
    */
    function valid_translations_dropdown( $default ) {
      
    	if($default == 'Select translator'){
    	  
            $this->set_message( 'valid_translations_dropdown', 'Please select translator.' );
            return false;
        }      
        return true;
    }
    
    function valid_softwares_dropdown( $default ) {
        if($default == 'Select software'){
            $this->set_message( 'valid_softwares_dropdown', 'Please select software.' );
            return false;
        }
        return true;
    }
    
    function valid_field_expertise_dropdown( $default ) {
        if($default == 'Select field of expertise'){
            $this->set_message( 'valid_field_expertise_dropdown', 'Please select field of expertise.' );
            return false;
        }
        return true;
    }
    
    function valid_subject_dropdown( $default ) {
        if($default == 'Select subject'){
            $this->set_message( 'valid_subject_dropdown', 'Please select subject.' );
            return false;
        }
        return true;
    }
    
    function valid_language_dropdown( $default ) {
        if($default == 'Select Language'){
            $this->set_message( 'valid_language_dropdown', 'Please select language.' );
            return false;
        }
        return true;
    }
    
    function valid_templates_dropdown( $default ) {
        if($default == 'Select template'){
            $this->set_message( 'valid_templates_dropdown', 'Please select template.' );
            return false;
        }
        return true;
    }
    
    public function date_valid($date) {
    $a =  str_replace('/','-',$date);
    $timestamp = strtotime($a);
        if(($timestamp > time())){
            return true;
        }
        $this->set_message('date_valid', 'Delivery date is invalid, Delivery date shouldn\'t be smaller than current date.');
        return false;
    }
    
    function check_valid_unique_order($order_number){
        // Check order number already exist in system
		$order = $this->CI->translations_model->get_order_number( $order_number );

		if( $order ) {
			// Order number already exists
			$this->set_message( 'check_valid_unique_order', 'Order number is already taken.' );
			return FALSE;
		}

		return TRUE;
    }

    /**
     * Check selection for translation info in application form.
     * 
     * @access public
     * @param  (string) $fields Input fields to check
     * @return (bool) TRUE if input is valid, otherwise FALSE.
     */
    function valid_translation_info( $fields ) {
    	// Get the expertise fields
    	$target_langs = $this->CI->input->post( 'translation_target_lang', true );
    	$words        = $this->CI->input->post( 'translation_word', true );
    	$hours        = $this->CI->input->post( 'translation_hour', true );
    	$lines        = $this->CI->input->post( 'translation_line', true );
    	$charges      = $this->CI->input->post( 'translation_charge', true );

    	// Errors array
    	$errors = array();
    	
    	// Check only fields are not empty
    	if( !empty( $fields ) && count( $fields ) ) {
    		// If there's no selection
    		if( '' == implode( '', array_values( $fields ) ) ) {
    			// Error message
				$error_msg = 'Required one language combinations at least.';

				// Set error message for current field
				array_push( $errors, array( 'translation_source_lang1' => $error_msg ) );

				// Add error
				$this->_error_array['translation_source_lang1'] = $error_msg;
    		} else {
    			// Loop fields to check
	    		foreach( $fields as $key => $value ) {
	    			if( '' == $value && '' == $target_langs[ $key ] ) continue;

	    			// Source and target language same
	    			if( $value == $target_langs[ $key ] ) {
	    				// Error message
						$error_msg = 'Source and target must not be same.';

						// Set error message for current field
						array_push( $errors, array( 'translation_target_lang' . $key => $error_msg ) );

						// Add error
						$this->_error_array[ 'translation_target_lang' . $key ] = $error_msg;
	    			} else {
	    				// Check target language
	    				if( '' == $target_langs[ $key ] ) {
	    					// Error message
							$error_msg = 'Please provide target language.';

							// Set error message for current field
							array_push( $errors, array( 'translation_target_lang' . $key => $error_msg ) );

							// Add error
							$this->_error_array[ 'translation_target_lang' . $key ] = $error_msg;
	    				}

	    				// Check word, line, hour and minimum charge fields
	    				if( '' == $words[ $key ] || !is_numeric( $words[ $key ] ) ) {
	    					$error_msg = 'Please provide valid value for words.';
	    					
	    					// Add into errors array
	    					array_push( $errors, array( 'translation_word' . $key => $error_msg ) );
	    					
	    					// Add error into validation object
							$this->_error_array[ 'translation_word' . $key ] = $error_msg;
	    				}
	    				if( '' == $hours[ $key ] || !is_numeric( $hours[ $key ] ) ) {
	    					$error_msg = 'Please provide valid value for hours.';
	    					
	    					// Add into errors array
	    					array_push( $errors, array( 'translation_hour' . $key => $error_msg ) );
	    					
	    					// Add error into validation object
							$this->_error_array[ 'translation_hour' . $key ] = $error_msg;
	    				}
	    				if( !is_numeric( $lines[ $key ] ) ) {
	    					$error_msg = 'Please provide valid value for line.';

	    					// Add into errors array
    						array_push( $errors, array( 'translation_line' . $key => $error_msg ) );

    						// Add error into validation object
    						$this->_error_array[ 'translation_line' . $key ] = $error_msg;
	    				}
	    				if( !is_numeric( $charges[ $key ] ) ) {
	    					$error_msg = 'Please provide valid value for minimum charge.';
	    					
	    					// Add into errors array
    						array_push( $errors, array( 'translation_charge' . $key => $error_msg ) );

    						// Add error into validation object
    						$this->_error_array[ 'translation_charge' . $key ] = $error_msg;
	    				}
	    			}
	    		}
    		}

    		// If any errors occurred
    		if( isset( $errors ) && !empty( $errors ) && count( $errors ) > 0 ) {
    			return false;
    		}
    	}

    	return true;
    }

    /**
     * Check selection for interpreting info in application form.
     * 
     * @access public
     * @param  (string) $fields Input fields to check
     * @return (bool) TRUE if input is valid, otherwise FALSE.
     */
    function valid_interpreting_info( $fields ) {
    	// Get the expertise fields
    	$interpreting_types = $this->CI->input->post( 'interpreting_type', true );
    	$hours              = $this->CI->input->post( 'interpreting_hour', true );
    	$flat_rates         = $this->CI->input->post( 'interpreting_rate', true );
    	$days               = $this->CI->input->post( 'interpreting_day', true );

    	// Errors array
    	$errors = array();
    	
    	// Check only fields are not empty
    	if( !empty( $fields ) && count( $fields ) ) {
    		// Loop fields to check
    		foreach( $fields as $key => $value ) {
    			if( '' == $value && '' == $interpreting_types[ $key ] ) continue;

    			// Check language
    			if( '' == $value ) {
    				// Error message
    				$error_msg = 'Please select language.';

    				// Set error message for current field
    				array_push( $errors, array( 'interpreting_lang' . $key => $error_msg ) );

    				// Add error
					$this->_error_array[ 'interpreting_lang' . $key ] = $error_msg;
    			}

    			// Check interpreting type
				if( '' == $interpreting_types[ $key ] ) {
					// Error message
					$error_msg = 'Please add interpreting type.';

					// Set error message for current field
					array_push( $errors, array( 'interpreting_type' . $key => $error_msg ) );

					// Add error
					$this->_error_array[ 'interpreting_type' . $key ] = $error_msg;
				}

				// Check word and hour fields
				if( '' == $hours[ $key ] ) {
					$error_msg = 'Please provide valid value for hours.';
					
					// Add into errors array
					array_push( $errors, array( 'interpreting_hour' . $key => $error_msg ) );
					
					// Add error into validation object
					$this->_error_array[ 'interpreting_hour' . $key ] = $error_msg;
				}

				// Check for flat rate
				if( '' == $flat_rates[ $key ] || !is_numeric( $flat_rates[ $key ] ) ) {
					$error_msg = 'Please provide valid value for flat rate.';
					
					// Add into errors array
					array_push( $errors, array( 'interpreting_rate' . $key => $error_msg ) );
					
					// Add error into validation object
					$this->_error_array[ 'interpreting_rate' . $key ] = $error_msg;
				}

    			// Check for day
    			if( '' == $days[ $key ] ) {
    				// Error message
					$error_msg = 'Please provide valid value for day.';

					// Set error message for current field
					array_push( $errors, array( 'interpreting_day' . $key => $error_msg ) );

					// Add error
					$this->_error_array[ 'interpreting_day' . $key ] = $error_msg;
    			}

	    		// If any errors occurred
	    		if( isset( $errors ) && !empty( $errors ) && count( $errors ) > 0 ) {
	    			return false;
	    		}
	    	}
    	}

    	return true;
    }

    /**
     * Check application URL is valid
     *
     * @access public
     * @param  (string) $url Application URL
     * @return (bool) TRUE if application URL is valid URL. Otherwise, FALSE
     */
    function valid_application_url( $url ) {
    	// Check URL is valid format
    	if( !function_exists( 'filter_var' ) ) {
    		// filter_var function doesn't support, use preg_match
    		$pattern = '/^(?:[;\/?:@&=+$,]|(?:[^\W_]|[-_.!~*\()\[\] ])|(?:%[\da-fA-F]{2}))*$/';

    		if( preg_match( $pattern, $url ) === false ) {
    			$this->set_message( 'valid_application_url', 'The URL is not valid.' );
    			return false;
    		}
    	} else {
    		if( filter_var( $url, FILTER_VALIDATE_URL ) === false ) {
    			$this->set_message( 'valid_application_url', 'The URL is not valid.' );
    			return false;
    		}
    	}
    	
    	// Application ID sent from Form
    	$application_id = $this->CI->input->post( 'application_id', true );

    	// Check URL already exists in system
    	$q = $this->CI->db->select( 'id, url', false )->from( $this->CI->db->dbprefix( 'applications' ) )
    	->where( 'url', $url )->limit( 1 )->get();

		if( $application_id !== $q->row()->id && $q->num_rows() > 0 ) {
			$this->set_message( 'valid_application_url', 'The URL is already exist.' );
			return false;
		}

    	return true;
    }

    /**
     * Check language name is valid, and avoid duplication.
     *
     * @access public
     * @param  (string) $lang_name Name of language
     * @return (bool) TRUE if language name is available, otherwise FALSE
     */
    function valid_language_name( $lang_name ) {
    	// Find in system languages with the language name
    	$q = $this->CI->db->select( 'id' )
    	        ->from( $this->CI->db->dbprefix( 'system_languages' ) )
    			->where( 'name', $lang_name )
    			->limit( 1 )
    			->get();

    	$this->set_message( 'valid_language_name', 'The language with same name already exists.' );

    	if( $this->CI->input->post( 'lang_id', true ) != false && $q->num_rows() > 0 ) {
    		return ( $q->row()->id == intval( $this->CI->input->post( 'lang_id', true ) ) ) ? TRUE : FALSE;
    	}

    	return ( $q->num_rows() > 0 ) ? FALSE : TRUE;
    }

    /**
     * Check language locale is valid, and avoid duplication.
     *
     * @access public
     * @param  (string) $lang_locale Language locale
     * @return (bool) TRUE if locale is available, otherwise FALSE
     */
    function valid_language_locale( $lang_locale ) {
    	// Find in system languages with the language name
    	$q = $this->CI->db->select( 'id' )
    	        ->from( $this->CI->db->dbprefix( 'system_languages' ) )
    			->where( 'locale', $lang_locale )
    			->limit( 1 )
    			->get();

    	$this->set_message( 'valid_language_locale', 'The language with same locale already exists.' );

    	if( $this->CI->input->post( 'lang_id', true ) != false && $q->num_rows() > 0 ) {
    		return ( $q->row()->id == intval( $this->CI->input->post( 'lang_id', true ) ) ) ? TRUE : FALSE;
    	}

    	return ( $q->num_rows() > 0 ) ? FALSE : TRUE;
    }

    /**
     * Check language regional code is valid, and avoid duplication.
     *
     * @access public
     * @param  (string) $lang_regional_code Regional code of language
     * @return (bool) TRUE if regional code is available, otherwise FALSE
     */
    function valid_language_regional_code( $lang_regional_code ) {
    	// Find in system languages with the language name
    	$q = $this->CI->db->select( 'id' )
    	        ->from( $this->CI->db->dbprefix( 'system_languages' ) )
    			->where( 'region', $lang_regional_code )
    			->limit( 1 )
    			->get();

    	$this->set_message( 'valid_language_regional_code', 'The language with same regional code already exists.' );

    	if( $this->CI->input->post( 'lang_id', true ) != false && $q->num_rows() > 0 ) {
    		return ( $q->row()->id == intval( $this->CI->input->post( 'lang_id', true ) ) ) ? TRUE : FALSE;
    	}

    	return ( $q->num_rows() > 0 ) ? FALSE : TRUE;
    }

    /**
     * Check language is valid
     *
     * @access public
     * @param  (int) $lang_id ID of language
     * @return (bool) TRUE if language is valid, otherwise FALSE.
     */
    function valid_lang( $lang_id ) {
    	// Find the language with ID
    	$q = $this->CI->db->select( 'id' )
    				->from( $this->CI->db->dbprefix( 'languages' ) )
    				->where( 'id', $lang_id )
    				->limit( 1 )
    				->get();

    	if( $q->num_rows() == 0 ) {
    		$this->set_message( 'valid_lang', 'Invalid language.' );
    		return false;
    	}

    	return true;
    }
}


/* End */
/* Location: `application/libraries/LTNO_Form_validation.php` */