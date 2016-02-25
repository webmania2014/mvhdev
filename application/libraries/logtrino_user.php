<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * This template instantiate user object with it's own properties by 
 * referencing user's ID in constructor when initialize.
 * It also create a user automatically with user's ID stored in session 
 *
 */

class Logtrino_user {
	/**
	 * @var: $username
	 * @access: private
	 * Stored username
	 */
	private $username;

	/**
	 * @var: $first_name
	 * @access: private
	 * Store first name of user
	 */
	private $first_name;

	/**
	 * @var: $last_name
	 * @access: private
	 * Store last name of user
	 */
	private $last_name;

	/**
	 * @var: $id
	 * @access: private
	 * Store user's ID
	 */
	private $id;

	/**
	 * @var: $guid
	 * @access: private
	 * Store GUID of user
	 */
	private $guid;

	/**
	 * @var: $password
	 * @access: private
	 * Store password
	 */
	private $password;

	/**
	 * @var: $role_id
	 * @access: private
	 * Store user role ID
	 */
	private $role_id;
    
    private $is_adminer;

	/**
	 * @var: $role_name
	 * @access: private
	 * Store name of user role
	 */
	private $role_name;

	/**
	 * @var: $role_description
	 * @access: private
	 * Store role description of user
	 */
	private $role_description;

	/**
	 * @var: $primary_email
	 * @access: private
	 * Store primary email address
	 */
	private $primary_email;

	/**
	 * @var: $email
	 * @access: private
	 * Store email
	 */
	private $email;

	/**
	 * @var: $alternative_email
	 * @access: private
	 * Store alternative email
	 */
	private $alternative_email;

	/**
	 * @var: $emails
	 * @access: private
	 * Store all emails
	 */
	private $emails;

	/**
	 * @var: @primary_telephone
	 * @access: private
	 * Store primary telephone number
	 */
	private $primary_telephone;

	/**
	 * @var: $telephone_numbers
	 * @access: private
	 * Store all telephone numbers
	 */
	private $telephone_numbers;

	/**
	 * @var: $primary_address
	 * @access: private
	 * Store primary address
	 */
	private $primary_address;

	/**
	 * @var: $address
	 * @access: private
	 * Store address
	 */
	private $address;

	/**
	 * @var: $addresses
	 * @access: private
	 * Store all addresses
	 */
	private $addresses;

	/**
	 * @var: $telephone_number
	 * @access: private
	 * Store telephone number
	 */
	private $telephone_number;

	/**
	 * @var: $mobile_phone_number
	 * @access: private
	 * Store mobile phone number
	 */
	private $mobile_phone_number;

	/**
	 * @var: $url
	 * @access: private
	 * Store url
	 */
	private $url;

	/**
	 * @var: $social_links
	 * @access: private
	 * Store social links
	 */
	private $social_links;

	/**
	 * @var: $fax_number
	 * @access: private
	 * Store fax number
	 */
	private $legal_form;

	/**
	 * @var: @company_name
	 * @access: private
	 * Store company name
	 */
	private $company_name;

	/**
	 * @var: $status
	 * @access: private
	 * Store status ID
	 */
	private $status;

	/**
	 * @var: $type
	 * @access: private
	 * Store type ID
	 */
	private $type;

	/**
	 * @var: $year_of_graduation
	 * @access: private
	 * Store year of graduation
	 */
	private $year_of_graduation;

	/**
	 * @var: $start_time_as_translator
	 * @access: private
	 * Store start time as translator
	 */
	private $start_time_as_translator;

	/**
	 * @var: $start_time_as_interpreter
	 * @access: private
	 * Store start time as interpreter
	 */
	private $start_time_as_interpreter;

	/**
	 * @var: $minimum_fee
	 * @access: private
	 * Store minimum fee
	 */
	private $minimum_fees;

	/**
	 * @var: $rates
	 * @access: private
	 * Store rates
	 */
	private $rates;

	/**
	 * @var: $certifications
	 * @access: private
	 * Store certifications
	 */
	private $certifications;

	/**
	 * @var: $notes
	 * @access: private
	 * Store notes
	 */
	private $notes;

	/**
	 * @var: $accepted_date
	 * @access: private
	 * Store accepted date
	 */
	private $accepted_date;

	/**
	 * @var: $applicant_status
	 * @access: private
	 * Store applicant status
	 */
	private $applicant_status;

	/**
	 * @var: $applicant_type
	 * @access: private
	 * Store applicant type
	 */
	private $applicant_type;

	/**
	 * @var: $tax_number
	 * @access: private
	 * Store tax number
	 */
	private $tax_number;

	/**
	 * @var: $foundation_year
	 * @access: private
	 * Store foundation year
	 */
	private $foundation_year;

	/**
	 * @var: $iso_9001
	 * @access: private
	 * Store ISO 9001 standard
	 */
	private $iso_9001;

	/**
	 * @var: $sworn_translations
	 * @access: private
	 * Store sworn translations status
	 */
	private $sworn_translations;

	/**
	 * @var: $translation_reviews
	 * @access: private
	 * Store translation reviews status
	 */
	private $translation_reviews;

	/**
	 * @var: $small_business
	 * @access: private
	 * Store small business status
	 */
	private $small_business;

	/**
	 * @var: $third_party_insurance
	 * @access: private
	 * Store third party insurance status
	 */
	private $third_party_insurance;

	/**
	 * @var: $registered_date
	 * @access: private
	 * Store registered date
	 */
	private $registered_date;

	/**
	 * @var: $updated_date
	 * @access: private
	 * Store updated date
	 */
	private $updated_date;

	/**
	 * @var: $last_logged_in_time
	 * @access: private
	 * Store last logged in time
	 */
	private $last_logged_in_time;

	/**
	 * @var: $is_activated
	 * @access: private
	 * Store activation status
	 */
	private $is_activated;

	/**
	 * @var: $language
	 * @access: private
	 * Store language
	 */
	private $language;

	/**
	 * @var: $sex
	 * @access: private
	 * Store sex
	 */
	private $sex;

	/**
	 * @var: $title
	 * @access: private
	 * Store title
	 */
	private $title;

	/**
	 * @var: $job_title
	 * @access: private
	 * Store job title
	 */
	private $job_title;

	/**
	 * @var: $bank_information
	 * @access: private
	 * Store bank information
	 */
	private $bank_information;

	/**
	 * @var: $softwares
	 * @access: private
	 * Store supplier softwares
	 */
	private $softwares;

	/**
	 * @var: $bio_summary
	 * @access: private
	 * Store bio summary content of supplier
	 */
	private $bio_summary;

	/**
	 * @var: $profile_picture
	 * @access: private
	 * Store profile picture of a user
	 */
	private $profile_picture;

	/**
	 * @var: $company_information
	 * @access: private
	 * Store company information of a user
	 */
	private $company_information;

	/**
	 * @var: $CI
	 * @access: protected
	 * Instantiate CI Object
	 */
	protected $CI;

	/**
	 * Constructor
	 * Create a new user automatically when user logged in or 
	 * create a new user by referencing ID pass into the constructor
	 *
	 * @param: (int) / (object) / NULL $user_data
	 *         User data can be ID of user or user object.
	 * @return: (object) User object
	 */
	function __construct( $user_data = null ) {
		// Load CI object in this class
		$this->CI =& get_instance();
		$user_id = null;

		if( is_object( $user_data ) ) {
			$this->__init( $user_data );
		} else {
			// No user's ID or object
			if( null !== $user_data ) {
				$user_id = $user_data;
			} else {
				if( $this->CI->session->userdata( 'user_id' ) ) {
					$user_id = $this->CI->session->userdata( 'user_id' );
				}
			}

			if( $user_id ) {
				$this->CI->load->model( 'users/users_model' );
				$user = $this->CI->users_model->get_user_by_id( $user_id );

				if( $user ) {
					// Initialize user
					$this->__init( $user );

					// Set password for user
					$password = $this->CI->users_model->get_user_password( $user_id );
					$this->set_password( $password );
				}
			}
		}
	}

	/**
	 * Initialize user with it's data
	 * @return: void
	 */
	private function __init( $user_obj ) {
		$this->id                  = $user_obj->id;

		$this->username            = $user_obj->username;
		$this->first_name          = $user_obj->first_name;
		$this->last_name           = $user_obj->last_name;
        
	}
    function is_user_admin(){
        $user_id = $this->CI->session->userdata( 'user_id' );
        if($this->CI->users_model->check_user_is_admin( $user_id )){
            return true;
        }
        return false;
    }

	/**
	 * Get translator data from database
	 * @return: void
	 */
	private function __get_translator_data( $user_obj ) {
		// Get basic data
		$this->company_name          = isset( $user_obj->company ) ? $user_obj->company : '';
		$this->primary_telephone     = isset( $user_obj->telephone ) ? $user_obj->telephone : '';
		$this->telephone_number      = isset( $user_obj->telephone_number ) ? $user_obj->telephone_number : '';
		$this->mobile_phone_number   = isset( $user_obj->mobile_phone_number ) ? $user_obj->mobile_phone_number : '';
		$this->fax_number            = isset( $user_obj->fax_number ) ? $user_obj->fax_number : '';
		$this->url                   = isset( $user_obj->url ) ? $user_obj->url : '';
		$this->social_links          = isset( $user_obj->social_links ) ? $user_obj->social_links : '';
		$this->legal_form            = isset( $user_obj->legal_form ) ? $user_obj->legal_form : '';
		$this->tax_number            = isset( $user_obj->tax_number ) ? $user_obj->tax_number : '';
		$this->foundation_year       = isset( $user_obj->foundation_year ) ? $user_obj->foundation_year : '';
		$this->iso_9001              = isset( $user_obj->iso_9001 ) ? $user_obj->iso_9001 : '';
		$this->certifications        = isset( $user_obj->certifications ) ? $user_obj->certifications : '';
		$this->sworn_translations    = isset( $user_obj->sworn_translations ) ? $user_obj->sworn_translations : FALSE;
		$this->translation_reviews   = isset( $user_obj->reviews ) ? $user_obj->reviews : FALSE;
		$this->small_business        = isset( $user_obj->small_business ) ? (bool) $user_obj->small_business : TRUE;
		$this->third_party_insurance = isset( $user_obj->third_party_insurance ) ? (bool) $user_obj->third_party_insurance : FALSE;
		$this->bio_summary           = isset( $user_obj->bio_summary ) ? $user_obj->bio_summary : '';

		// Company information
		$company_info = new stdClass;
		$company_info->name                  = $this->company_name;
		$company_info->tax_number            = $this->tax_number;
		$company_info->legal_form            = $this->legal_form;
		$company_info->small_business        = $this->small_business;
		$company_info->third_party_insurance = $this->third_party_insurance;

		$this->company_information = $company_info;

		// Native Language
		$language_locale  = isset( $user_obj->native_lang ) ? $user_obj->native_lang : 'de';
		$language_name    = isset( $user_obj->lang ) ? $user_obj->lang : 'German';

		$native_lang = new stdClass;
		$native_lang->locale = $language_locale;
		$native_lang->name   = $language_name;

		$this->native_lang   = $native_lang;

		// Address
		$address_obj = new stdClass;
		$address_obj->postal_code         = $user_obj->postal_code;
		$address_obj->city                = $user_obj->city;
		$address_obj->country_code        = $user_obj->country_code;
		$address_obj->country_name        = $user_obj->country_name;
		$address_obj->country_native_name = $user_obj->country_native_name;
		$address_obj->address             = $user_obj->address;

		$this->primary_address     = $address_obj;
		$this->address             = $address_obj;
		
		// Applicant status
		$applicant_status           = new stdClass;
		$applicant_status->id       = 2;
		$applicant_status->title    = 'Applicant';

		if( $user_obj->status_id ) {
			$applicant_status->id    = $user_obj->status_id;
			$applicant_status->title = $user_obj->applicant_status;
		}

		$this->applicant_status = $applicant_status;

		// Applicant type
		$applicant_type        = new stdClass;
		$applicant_type->id    = 1;
		$applicant_type->title = 'Individual Translator';

		if( $user_obj->type_id ) {
			$applicant_type->id    = $user_obj->type_id;
			$applicant_type->title = $user_obj->applicant_type;
		}

		$this->applicant_type = $applicant_type;

		$this->year_of_graduation        = isset( $user_obj->year_of_graduation ) ? $user_obj->year_of_graduation : '';
		$this->start_time_as_translator  = isset( $user_obj->start_time_as_translator ) ? $user_obj->start_time_as_translator : '';
		$this->start_time_as_interpreter = isset( $user_obj->start_time_as_interpreter ) ? $user_obj->start_time_as_interpreter : '';

		$this->minimum_fee   = isset( $user_obj->minimum_fee ) ? $user_obj->minimum_fee : '';
		$this->rates         = isset( $user_obj->rates ) ? $user_obj->rates : '';

		$this->notes         = isset( $user_obj->notes ) ? $user_obj->notes : '';
		$this->accepted_date = isset( $user_obj->accepted_date ) ? $user_obj->accepted_date : '';

		// Get bank information
		$bank_account = new stdClass;
		$bank_account->bank_account_owner  = isset( $user_obj->bank_account_owner ) ? $user_obj->bank_account_owner : '';
		$bank_account->bank_name           = isset( $user_obj->bank_name ) ? $user_obj->bank_name : '';
		$bank_account->bank_account_number = isset( $user_obj->bank_account_number ) ? $user_obj->bank_account_number : '';
		$bank_account->sort                = isset( $user_obj->sort ) ? $user_obj->sort : '';
		$bank_account->iban                = isset( $user_obj->iban ) ? $user_obj->iban : '';
		$bank_account->bic_swift           = isset( $user_obj->bic_swift ) ? $user_obj->bic_swift : '';
		$bank_account->paypal_account      = isset( $user_obj->paypal_account ) ? $user_obj->paypal_account : '';

		$this->bank_information = $bank_account;

		// Get softwares
		$this->softwares = $this->get_softwares();

		// Get emails
		$this->emails = $this->CI->users_model->get_user_emails( $this->id );

		// Get addresses
		$this->addresses = $this->CI->users_model->get_user_addresses( $this->id );
	}

	/**
	 * Get user's ID
	 * @return: (int) User's ID
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Get user's GUID
	 * @return: (string) User's GUID
	 */
	public function get_guid() {
		return $this->guid;
	}

	/**
	 * Get user name
	 * @return: (string) $this->username
	 */
	public function get_username() {
		return $this->username;
	}

	/**
	 * Get first name of user
	 * @return: (string) Return first name
	 */
	public function get_first_name() {
		return $this->first_name;
	}

	/**
	 * Get last name of user
	 * @return: (string) Return last name
	 */
	public function get_last_name() {
		return $this->last_name;
	}

	/**
	 * Get name of user
	 * @return: (string) First name and last name
	 */
	public function get_name() {
		return sprintf( '%s %s', $this->first_name, $this->last_name );
	}

	/**
	 * Get role ID of user
	 * @return (int) ID of role
	 */
	public function get_role_id() {
		return $this->role_id;
	}

	/**
	 * Get primary email
	 * @return: (string) Primary email address
	 */
	public function get_primary_email() {
		return $this->primary_email;
	}

	/**
	 * Get primary telephone number
	 * @return: (string) Primary telephone number
	 */
	public function get_primary_telephone() {
		return $this->primary_telephone;
	}

	/**
	 * Get password
	 * @return: (string) Encrypted password
	 */
	public function get_password() {
		return $this->password;
	}

	/**
	 * Get addresses
	 * @return: (array) Associative array contains postal_code, city, country and address details
	 */
	public function get_addresses() {

		if( $this->addresses && count( $this->addresses ) > 0 ) {
			return $this->addresses;
		}
		
		return array();
	}

	/**
	 * Get primary address
	 * @return: (object) Primary address object
	 */
	public function get_primary_address( $item = '' ) {
		if( '' != $item ) {
			$address = $this->primary_address;

			if( isset( $address->$item ) ) {
				return ( $address->$item ) ? $address->$item : '';
			} else {
				return '';
			}
		}

		return $this->primary_address;
	}

	/**
	 * Get registered date of user
	 * @param   (string) $format Date format. Same as using date format in PHP date function.
	 * @return: (string) Registered date of user
	 */
	public function get_registered_date( $format = 'Y-m-d' ) {
		if( '' != $this->registered_date ) {
			return date( $format, strtotime( $this->registered_date ) );
		}
		
		return '';
	}

	/**
	 * Get last logged in time of user
	 * @param   (string) $format Date format. Same as using date format in PHP date function.
	 * @return: (string) Last logged in time of user
	 */
	public function get_last_logged_in_time( $format = 'Y-m-d' ) {
		if( '' != $this->last_logged_in_time ) {
			return date( $format, strtotime( $this->last_logged_in_time ) );
		}
		
		return '';
	}

	/**
	 * Check user is active or not.
	 * @return: (bool) TRUE if user is active, otherwise FALSE
	 */
	public function is_active() {
		return $this->is_activated == TRUE;
	}

	/**
	 * Set a password of a user
	 * @return: void
	 */
	private function set_password( $password ) {
		$this->password = $password;
	}

	/**
	 * Check user is admin
	 */
	public function is_admin() {
		return intval( $this->is_admin ) === 1;
	}


	/**
	 * Get status
	 *
	 * @param   (string) $haystack ID or title of status
	 * @return: (string) Return the status of user
	 */
	public function get_status( $haystack = '' ) {
		// Only for translator
		if( $this->is_translator() ) {
			if( $haystack == 'id' ) {
				return $this->applicant_status->id;
			}

			if( $haystack == 'title' ) {
				return $this->applicant_status->title;
			}

			return $this->applicant_status;
		}

		return '';
	}

	/**
	 * Get applicant type
	 *
	 * @param   (string) $haystack ID or title of type
	 * @return: (string) Return the type of translator
	 */
	public function get_type( $haystack = '' ) {
		// Only for translator
		if( $this->is_translator() ) {
			if( $haystack == 'id' ) {
				return $this->applicant_type->id;
			}

			if( $haystack == 'title' ) {
				return $this->applicant_type->title;
			}

			return $this->applicant_type;
		}

		return '';
	}

	/**
	 * Get company name
	 * @return: (string) Return the company name of translator
	 */
	public function get_company_name() {
		// Only for translator
		if( $this->is_translator() ) {
			return $this->company_name;
		}

		return '';
	}

	/**
	 * Get year of graduation
	 * @return: (string) Return the year of graduation of translator
	 */
	public function get_year_of_graduation() {
		// Only for translator
		if( $this->is_translator() ) {
			if( '' != $this->year_of_graduation ) {
				return $this->year_of_graduation;
				//return date( $format, strtotime( $this->year_of_graduation ) );	
			}

			return '';
		}

		return '';
	}

	/**
	 * Get start time of translator
	 * @return: (string) Return the start time work as translator
	 */
	public function get_start_time_of_translator() {
		// Only for translator
		if( $this->is_translator() ) {
			if( '' != $this->start_time_as_translator ) {
				return $this->start_time_as_translator;
			}

			return '';
		}

		return '';
	}

	/**
	 * Get start time of interpreter
	 * @return: (string) Return the start time work as interpreter
	 */
	public function get_start_time_of_interpreter() {
		// Only for translator
		if( $this->is_translator() ) {
			if( '' != $this->start_time_as_interpreter ) {
				return $this->start_time_as_interpreter;
			}

			return '';
		}

		return '';
	}

	/**
	 * Get minimum fee of translator
	 * @return: (string) Return minimum fee
	 */
	public function get_minimum_fee() {
		// Only for translator
		if( $this->is_translator() ) {
			return $this->minimum_fee;
		}

		return '';
	}

	/**
	 * Get rates of translator
	 * @return: (string) Return rates
	 */
	public function get_rates() {
		// Only for translator
		if( $this->is_translator() ) {
			return $this->rates;
		}

		return '';
	}


	/**
	 * Get accepted date
	 * @param   (string) $format Date format. Same as using date format in PHP date function.
	 * @return: (string) Return the accepted date of translator
	 */
	public function get_accepted_date( $format = 'Y-m-d' ) {
		// Only for translator
		if( $this->is_translator() ) {
			if( '' != $this->accepted_date ) {
				return date( $format, strtotime( $this->accepted_date ) );
			}

			return '-';
		}

		return '';
	}

	/**
	 * Get notes
	 * @return: (string) Return notes of translator
	 */
	public function get_notes() {
		// Only for translator
		if( $this->is_translator() ) {
			return $this->notes;
		}

		return '';
	}

	/**
	 * Get native language
	 * @return: (string) Return the native language of translator
	 */
	public function get_native_lang( $item = '' ) {
		// Only for translator
		if( $this->is_translator() ) {
			if( '' != $item && isset( $this->native_lang->$item ) ) {
				return $this->native_lang->$item;
			}

			return $this->native_lang;
		}

		return '';
	}

	/**
	 * Get the language
	 *
	 * @access public
	 * @return (string) Language of a user
	 */
	public function get_language( $key = null, $lang = 'de' ) {
		if( $key ) {
			if( $key == 'name' ) {
				if( $lang == 'en' ) {
					return $this->language->name_en;
				}

				return $this->language->name_de;
			}

			return $this->language->id;
		}

		return $this->language;
	}

	/**
	 * Get language name
	 *
	 * @access public
	 * @return (string) Name of language
	 */
	public function get_language_name() {
		$this->CI->db->select( 'name' );
		$this->CI->db->from( $this->CI->db->dbprefix( 'languages' ) );
		$this->CI->db->where( 'locale', $this->get_language() );
		$this->CI->db->limit( 1 );

		$query = $this->CI->db->get();
		return $query->row()->name;
	}

	/**
	 * Get title of user
	 *
	 * @access public
	 * @return (string) Title of user
	 */
	public function get_title() {
		return $this->title;
	}

	/**
	 * Get the job title of a user
	 *
	 * @access public
	 * @return (string) Job title of a user
	 */
	public function get_job_title() {
		return $this->job_title;
	}

	/**
	 * Get alternative email
	 *
	 * @access public
	 * @return (string) Alternative email address
	 */
	public function get_alternative_email_address() {
		return $this->alternative_email;
	}

	/**
	 * Get telephone number
	 *
	 * @access public
	 * @return (string) Telephone number
	 */
	public function get_telephone_number() {
		return $this->telephone_number;
	}

	/**
	 * Get mobile phone number
	 *
	 * @access public
	 * @return (string) Mobile phone number
	 */
	public function get_mobile_phone_number() {
		return $this->mobile_phone_number;
	}
	
	/**
	 * Get fax number
	 *
	 * @access public
	 * @return (string) Fax number
	 */
	public function get_fax_number() {
		return $this->fax_number;
	}

	/**
	 * Get url
	 *
	 * @access public
	 * @return (string) URL address
	 */
	public function get_url() {
		return $this->url;
	}

	/**
	 * Get social links
	 *
	 * @access public
	 * @return (string) Social links
	 */
	public function get_social_links() {
		return unserialize( $this->social_links );
	}

	/**
	 * Get legal form
	 *
	 * @access public
	 * @return (string) Legal form
	 */
	public function get_legal_form() {
		return $this->legal_form;
	}

	/**
	 * Get tax number
	 *
	 * @access public
	 * @return (string) Tax number
	 */
	public function get_tax_number() {
		return $this->tax_number;
	}

	/**
	 * Get foundation year of translator or translation company
	 *
	 * @access public
	 * @return (string) Foundation year
	 */
	public function get_foundation_year() {
		return $this->foundation_year;
	}

	/**
	 * Get ISO standard of translation
	 *
	 * @access public
	 * @return (string) ISO standard
	 */
	public function get_iso_9001() {
		return $this->iso_9001;
	}

	/**
	 * Get certifications of translator or translation company
	 *
	 * @access public
	 * @return (string) Certifications
	 */
	public function get_certifications() {
		return $this->certifications;
	}

	/**
	 * Get sworn translations
	 *
	 * @access public
	 * @return (string) Sworn translations
	 */
	public function get_sworn_translations() {
		return ( (bool) $this->sworn_translations == true ) ? 'Yes' : 'No';
	}

	/**
	 * Get translation reviews
	 *
	 * @access public
	 * @return (string) Translation reviews
	 */
	public function get_translation_reviews() {
		return ( (bool) $this->translation_reviews == true ) ? 'Yes' : 'No';
	}

	/**
	 * Get bank information
	 *
	 * @access public
	 * @param  (string) $item Item belongs to bank information. Example: paypal account
	 * @return (mixed)  Specific bank information or back informaion object if no item specified.
	 */
	public function get_bank_information( $item = '' ) {
		if( '' != $item && isset( $this->bank_information->$item ) ) {
			return $this->bank_information->$item;
		}

		return $this->bank_information;
	}

	/**
	 * Get softwares of supplier
	 *
	 * @access public
	 * @return 
	 */
	public function get_softwares( $item = null ) {
		if( !$this->softwares || $this->softwares == null ) {
			// Get softwares from database
			$sel = "s.id, s.name";
			$this->CI->db->select( $sel, false );
			$this->CI->db->from( $this->CI->db->dbprefix( 'supplier_softwares' ) . ' AS t' );
			$this->CI->db->join( $this->CI->db->dbprefix( 'softwares' ) . ' AS s', 's.id = t.software_id', 'left' );

			$this->CI->db->where( 't.user_id', $this->get_id() );

			$softwares = $this->CI->db->get();

			$this->softwares = $softwares->result();
		}

		if( $item == 'id' ) {
			$ids = array();

			foreach( $this->softwares as $software ) {
				$ids[] = $software->id;
			}

			return $ids;
		} elseif( $item == 'name' ) {
			$names = array();
			
			foreach( $this->softwares as $software ) {
				$names[] = $software->name;
			}

			return $names;
		}

		return $this->softwares;
	}

	/**
	 * Get bio summary text of supplier
	 *
	 * @access public
	 * @return (string) Bio summary of supplier
	 */
	public function get_bio_summary() {
		return $this->bio_summary;
	}

	/**
	 *
	 * @access public
	 * @return (string) Profile picture of user
	 */
	public function get_profile_picture() {
		return $this->profile_picture;
	}

	/**
	 * Get company information
	 *
	 * @access public
	 * @param  (string) $item Item belongs to company information. Example: company name
	 * @return (mixed)  Specific company information or company informaion object if no item specified.
	 */
	public function get_company_information( $item = '' ) {
		if( '' != $item && isset( $this->company_information->$item ) ) {
			return $this->company_information->$item;
		}

		return $this->company_information;
	}

	/**
	 * Check user sent and completed application form.
	 *
	 * @access public
	 * @return (bool) TRUE if user already submitted application form, otherwise FALSE
	 */
	public function is_submitted_application_form() {
		$this->CI->db->select( 'submit_application_form' );
		$this->CI->db->where( 'user_id', $this->get_id() );
		$this->CI->db->limit( 1 );
		$q = $this->CI->db->get( $this->CI->db->dbprefix( 'translators' ) )->row();

		return ( $q->submit_application_form == 't' ) ? true : false;
	}
}

/* End */
/* Location: `application/libraries/logtrino_user.php` */