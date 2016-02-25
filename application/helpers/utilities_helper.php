<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Helper functions
 * Utilities helper functions for various tasks in application. Generating HTML combo selection 
 * and other UI manipulation required special function will be associated with helper function.
 *
 * @package: CodeIgniter 2.2.0
 *
 * @helper: utilities_helper
 */

if( !function_exists( 'get_countries_dropdown' ) ) {
	/**
	 * Generate HTML combo select for country
	 *
	 * @param:
	 */
	function get_countries_dropdown( $selected = '', $name = '', $id = '', $class = '', $pre_selected = true ) {
		// Get CI object
		$ci = &get_instance();

		// Get the countries
		$countries = $ci->app_model->get_countries();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'country' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			$html .= '<option value="-1">Select Country</option>';
		}

		$selected_text = '';

		foreach( $countries as $country ) {
			if( !$pre_selected ) {
				$selected_text = ( $selected == $country->id ) ? ' selected' : '';
			}

			$html .= '<option value="' . $country->id . '"' . $selected_text . '>' . $country->name . '</option>';
		}

		$html .= '</select>';

		echo $html;
	}

	/**
	 * Generate HTML combo select for languages
	 *
	 * @param:
	 */
	function get_languages_dropdown( $selected = '', $name = '', $id = '', $class = '', $pre_selected = true ) {
		// Get CI object
		$ci = &get_instance();

		// Get the languages
		$languages = $ci->app_model->get_languages();
		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'lang' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';
		$html = '<select name="' . $name . '"' . $id . $class . '>';
		if( $pre_selected ) {
			$html .= '<option value="-1">Select Language</option>';
		}
		$selected_text = '';

		foreach( $languages as $language ) {
			if( !$pre_selected ) {
				$selected_text = ( $selected == $language->id ) ? ' selected' : '';
			}

			$html .= '<option value="' . $language->id . '"' . $selected_text . '>' . $language->name . '</option>';
		}

		$html .= '</select>';

		echo $html;
	}
    
    function get_languages_dropdown_selected_source( $selected = '', $name = '', $id = '', $class = '', $pre_selected = true ) {
		// Get CI object
		$ci = &get_instance();

		// Get the languages
		$languages = $ci->app_model->get_languages();
        
		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'lang' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			$html .= '<option value="-1">Select Language</option>';
		}
        
		$selected_text = '';

		foreach( $languages as $language ) {
		  
			if( $ci->input->post( $name, true ) && $ci->input->post( $name, true ) == $language->id ) {
			 
				$selected_text = ' selected';
			} else {
				$selected_text = '';

				if( !$pre_selected ) {
					$selected_text = ( $selected == $language->id ) ? ' selected' : '';
				}
			}
            
			$html .= '<option value="' . $language->id . '"' . $selected_text . '>' . $language->name . '</option>';
		}

		$html .= '</select>';

		echo $html;
	}
    function get_languages_dropdown_selected_target( $selected = '', $name = '', $id = '', $class = '', $pre_selected = true ) {
		// Get CI object
		$ci = &get_instance();

		// Get the languages
		$languages = $ci->app_model->get_languages();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'lang_target' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			$html .= '<option value="-1">Select Language</option>';
		}

		$selected_text = '';

		foreach( $languages as $language ) {

			if( $ci->input->post( $name, true ) && $ci->input->post( $name, true ) == $language->id ) {
				$selected_text = ' selected';
			} else {
				$selected_text = '';

				if( !$pre_selected ) {
					$selected_text = ( $selected == $language->id ) ? ' selected' : '';
				}
			}

			$html .= '<option value="' . $language->id . '"' . $selected_text . '>' . $language->name . '</option>';
		}

		$html .= '</select>';

		echo $html;
	}
}
    

if( !function_exists( 'is_logged_in' ) ) {
	/**
	 * Check user is logged in
	 * @return: (bool) TRUE if user is logged in, otherwise FALSE
	 */
	function is_logged_in() {
		return false;
	}
}

/* End */
/* Location: `application/helpers/utilities_helper.php` */