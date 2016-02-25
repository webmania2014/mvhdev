<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * User Access Control ( UAC )
 * Control user access in system for specific tasks and actions
 *
 * Each module has it's own library for UAC to define actions and rules which were set from this
 * class.
 */

class Logtrino_UAC {
	/**
	 * (array) Store all rules for UAC
	 */
	protected static $rules;

	/**
	 * (string) Module name belongs to UAC
	 * Module name will use to load it's own UAC library from library folder.
	 */
	protected static $module;

	/**
	 * Class constructor
	 * Call require functions at class instantiate
	 */
	function __construct() {
		/**
		 * Get CI object to access CI object and methods part of this class
		 */
		$this->ci = &get_instance();
	}

	/**
	 * Initilize UAC for module
	 * @param: (string) $module_name Module name that UAC belongs to
	 */
	function _init( $module_name ) {
		if( !$module_name ) {
			throw new Exception( "Logtrino UAC: You must provide module name to set UAC." );
		}

		// Assign module name of UAC
		$this->module = $module_name;
	}

	/**
	 * Set UAC rules of module
	 * @param: (array) $rules_set Numeric array consists rules of UAC
	 */
	function _set_rules( $rules_set = array() ) {

		if( !is_array( $rules_set ) || count( $rules_set ) < 1 || empty( $rules_set ) ) {
			throw new Exception( "Logtrino UAC: Invalid UAC rules. Rules must be numeric array and not empty array." );
		} else {
			// Store rules for UAC, ensure no duplicate rule exist
			$this->rules = array_unique( $rules_set );
		}
	}

	/**
	 * Run UAC rule
	 * This method only call function from module's UAC class. The result was determind by it's own
	 * module UAC method and return by this method.
	 *
	 * @param: (string) $rule Rule name to run specific action from module UAC library
	 * @return: (bool) true if action is allowed, otherwise false
	 */
	function _run( $rule, $params = array() ) {
		
		if( false === array_search( $rule, $this->rules ) ) {
			throw new Exception( $this->module . " does not suppose to call " . $rule . "." );
		} else {
			$lib_name = $this->module . '_uac';

			$this->ci->load->library( $lib_name );

			$result = $this->ci->$lib_name->$rule( $params );

			return $result;
		}

		return false;
	}
}