<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Extend form helper functions
 * Extend base form helper functions with additional functions for using general form across system.
 *
 * @package     CodeIgniter 2.2.0

 *
 * @helper      form_extend_helper
 */

if( !function_exists( 'is_form_submit' ) ) {
	/**
	 * Check form submitted by user
	 * Check request method with provided argument and array length for $_GET or $_POST
	 *
	 * @access public
	 * @param  (string) $method (Optional) Form method, $_GET or $_POST
	 * @return (bool) TRUE if request found with $_GET or $_POST and has value in $_GET or $_POST.
	 *           Otherwise FALSE will return
	 */
	function is_form_submit( $method = 'POST' ) {
		$method = strtoupper( $method );
		if( $_SERVER['REQUEST_METHOD'] == strtoupper( $method ) ) {
		  
			if( $method == 'GET' ) {
				return ( isset( $_GET ) && !empty( $_GET ) && count( $_GET ) > 0 );
			} else {
				return ( isset( $_POST ) ) ? TRUE : FALSE;
			}
		}

		return false;
	}
}

if( !function_exists( 'field_auto_fill' ) ) {
	/**
	 * Auto fill field value when submit form.
	 *
	 * @access public
	 * @param  (string) $field_name Field name to find the value with CI input object
	 * @param  (string) $default Default value if there is not submitted form value
	 * @return (string) Return the default value or user entered form value
	 */
	function field_auto_fill( $field_name = '', $default = '' ) {
		// Get CI object
		$CI =& get_instance();

		// Check field exists
		if( $CI->input->post( $field_name, false ) !== FALSE ) {
			$field_value = $CI->input->post( $field_name, false );
			return htmlspecialchars( $field_value );
		}

		return htmlspecialchars( $default );
	}
}

if( !function_exists( 'field_selected' ) ) {
	/**
	 */
	function field_selected( $field_value, $field_name, $selected = '' ) {
		// Get CI object
		$CI =& get_instance();

		if( is_form_submit() ) {
			$option = (int) $CI->input->post( $field_name, true );

			if( $option == $field_value ) {
				echo ' selected';
			}
		} else {
			if( $field_value == $selected ) {
				echo ' selected';
			}
		}
	}
}

if( !function_exists( 'field_class' ) ) {
	/**
	 * Add CSS class to form field which failed validation.
	 * Check form fields declared in $data variable from controller. $data must be declared 
	 * as global in controller.
	 *
	 * @access public
	 * @param  (string) $field_name Name of field which check from validation errors array.
	 * @param  (string) $field_class Add extra CSS class with this error field
	 * @return (string) Class name to use in field which failed validation
	 */
	function field_class( $field_name, $field_class = '' ) {

		global $data; // Make global pass from controller

		$field_class = $field_class;

		if( isset( $data['form'] ) ) {
			if( isset( $data['form']['errors'][ $field_name ] ) ) {
				$field_class .= ' error';
			}
		}

		return $field_class;
	}
}

if( !function_exists( 'field_error' ) ) {
	/**
	 * Print form validation error for specific error container.
	 * Check form fields declared in $data variable from controller. $data must be declared 
	 * as global in controller.
	 *
	 * @access public
	 * @param  (string) $field_name Name of field which check from validation errors array.
	 * @return (string) Class name to use in field which failed validation
	 */
	function field_error( $field_name ) {

		global $data; // Make global pass from controller

		if( isset( $data['form'] ) ) {
			if( isset( $data['form']['errors'][ $field_name ] ) ) {
				echo $data['form']['errors'][ $field_name ];
			}
		}
	}
}

if( !function_exists( 'get_post_data' ) ) {
	/**
	 * Get value from $_POST data with field name and it's key if field is array
	 * 
	 * @access public
	 * @param  (string) $field_name Name of field
	 * @param  (mixed) $key Key belongs the index of field if field is array. If it's provided as FAULT, it's simple
	 *                 input field. Default is 0
	 * @return (string) Return the value of field. If field doesn't exist, return empty string.
	 */
	function get_post_data( $field_name, $key = 0 ) {
		$CI =& get_instance();

		// Get the field
		$field = $CI->input->post( $field_name );

		if( $field !== false ) {
			if( $key === false ) {
				return $field;
			}

			return ( isset( $field[ $key ] ) ) ? $field[ $key ] : '';
		}

		return '';
	}
}

/* End */
/* Location: `application/helpers/form_extend_helper.php` */