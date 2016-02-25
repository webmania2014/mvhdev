<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Helper functions
 * Utilities helper functions for various tasks in application. Generating HTML combo selection 
 * and other UI manipulation required special function will be associated with helper function.
 *
 * @package     CodeIgniter 2.2.0
 *
 * @helper      utilities_helper
 */

if( !function_exists( 'out' ) ) {

	function out($arr, $dump = false)
	{
		echo '<pre>';
		if($dump)
			var_dump($arr);
		else
			print_r($arr);
		echo '</pre>';
	}

}

if( !function_exists( 'get_countries_dropdown' ) ) {
	/**
	 * Generate HTML combo select for country
	 *
	 * @access public
	 * @param  (string) $selected Selected value
	 * @param  (string) $name Field name
	 * @param  (string) $id ID of field
	 * @param  (string) $class Class to use for selector to apply special CSS
	 * @param  (bool) $pre_selected Add pre-selected option as default
	 */
	function get_countries_dropdown( $selected = '', $name = '', $id = '', $class = '', $pre_selected = true, 
										$pre_selected_text = 'Select Language' ) {
		// Get CI object
		$CI = &get_instance();

		// Get the countries
		$countries = $CI->app_model->get_countries();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'country' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= '<option value="">' . $pre_selected_text . '</option>';
			} else {
				$html .= '<option value="" selected>' . $pre_selected_text . '</option>';
			}
		}

		$selected_text = '';

		foreach( $countries as $country ) {
			if( $CI->input->post( $name, true ) && $CI->input->post( $name, true ) == $country->iso_country_code ) {
				$selected_text = ' selected';
			} else {
				$selected_text = '';
				$selected_text = ( $selected == $country->iso_country_code ) ? ' selected' : '';
			}
			
			$html .= '<option value="' . $country->iso_country_code . '"' . $selected_text . '>';
			$html .= htmlspecialchars( $country->name, ENT_QUOTES, 'UTF-8' );

			if( $country->native_name ) {
				$html .= ' (' . htmlspecialchars( $country->native_name, ENT_QUOTES, 'UTF-8' ) . ')';
			}

			$html .= '</option>';
		}

		$html .= '</select>';
		echo $html;
	}
}


if( !function_exists( 'get_languages_dropdown' ) ) {
	/**
	 * Generate HTML combo select for languages
	 *
	 * @access public
	 * @param  (bool) $all Select all languages or only enabled languages
	 * @param  (string) $selected Selected value
	 * @param  (string) $name Field name
	 * @param  (string) $id ID of field
	 * @param  (string) $class Class to use for selector to apply special CSS
	 * @param  (bool) $pre_selected Add pre-selected option as default
	 */
	function get_languages_dropdown( $selected = '', $name = '', $id = '', $class = '', $pre_selected = true, 
										$pre_selected_text = 'Select Language' ) {
		// Get CI object
		$CI = &get_instance();

		// Get the languages
		$languages = $CI->app_model->get_languages();
        
		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'lang' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= '<option value="">' . $pre_selected_text . '</option>';
			} else {
				$html .= '<option value="" selected>' . $pre_selected_text . '</option>';
			}
		}

		$selected_text = '';

		// Set langnage column with language code in cookie
		$lang_name = 'name_' . get_language_from_cookie();

		if( count( $languages ) > 0 ) {
			foreach( $languages as $language ) {
				$selected_text = ( $selected == $language->id ) ? ' selected' : '';
				$html .= '<option value="' . $language->id . '"' . $selected_text . '>' . $language->$lang_name . '</option>';
			}
		}

		$html .= '</select>';
		echo $html;
	}
}

if( !function_exists( 'get_services_dropdown' ) ) {
	function get_services_dropdown( $selected = '', $name = '', $id = '', $class = '', $pre_selected = true, 
										$pre_selected_text = 'Select Service' ) {
		// Get CI object
		$CI = &get_instance();

		// Get the languages
		$services = $CI->app_model->get_services();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'lang' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= '<option value="-1">' . $pre_selected_text . '</option>';
			} else {
				$html .= '<option value="" selected>' . $pre_selected_text . '</option>';
			}
		}

		$selected_text = '';

		// Set langnage column with language code in cookie
		//$lang_name = 'name_' . get_language_from_cookie();;

		if( count( $services ) > 0 ) {
			foreach( $services as $service ) {
				$selected_text = ( $selected == $service->id ) ? ' selected' : '';
				$html .= '<option value="' . $service->id . '"' . $selected_text . '>' . $service->name . '</option>';
			}
		}

		$html .= '</select>';
		echo $html;
	}
}

if( !function_exists( 'get_languages_dropdown_default' ) ) {
	function get_languages_dropdown_default( $selected = '', $name = '', $id = '', $class = '', $pre_selected = true, 
										$pre_selected_text = 'Select Language' ) {
		// Get CI object
		$CI = &get_instance();

		// Get the languages
		$languages = $CI->app_model->get_languages();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'lang' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= '<option value="-1">' . $pre_selected_text . '</option>';
			} else {
				$html .= '<option value="" selected>' . $pre_selected_text . '</option>';
			}
		}

		$selected_text = '';

		// Set langnage column with language code in cookie
		$lang_name = 'name_' . get_language_from_cookie();

		if( count( $languages ) > 0 ) {
			foreach( $languages as $language ) {
				$selected_text = ( $selected == $language->id ) ? ' selected' : '';
				$html .= '<option value="' . $language->id . '"' . $selected_text . '>' . $language->$lang_name . '</option>';
			}
		}

		$html .= '</select>';
		echo $html;
	}
}

if( !function_exists( 'get_system_languages_dropdown' ) ) {
	/**
	 * Generate HTML combo select for languages
	 *
	 * @access public
	 * @param  (bool) $all Select all languages or only enabled languages
	 * @param  (string) $selected Selected value
	 * @param  (string) $name Field name
	 * @param  (string) $id ID of field
	 * @param  (string) $class Class to use for selector to apply special CSS
	 * @param  (bool) $pre_selected Add pre-selected option as default
	 */
	function get_system_languages_dropdown( $active = TRUE, $selected = '', $name = '', $id = '', 
											$class = '', $pre_selected = true, $pre_selected_text = 'Select Language' ) {
		// Get CI object
		$CI = &get_instance();

		// Get the languages
		$languages = $CI->app_model->get_system_languages( $active );

		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'lang' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= '<option value="">' . $pre_selected_text . '</option>';
			} else {
				$html .= '<option value="" selected>' . $pre_selected_text . '</option>';
			}
		}

		$selected_text = '';

		if( count( $languages ) > 0 ) {
			foreach( $languages as $language ) {
				$selected_text = ( $selected == $language->locale ) ? ' selected' : '';
				$html .= '<option value="' . $language->locale . '"' . $selected_text . '>' . $language->name . '</option>';
			}
		}

		$html .= '</select>';
		echo $html;
	}
}

if( !function_exists( 'get_country' ) ) {
	/**
	 * Get a country info from database with it's ID
	 *
	 * @access public
	 * @param  (int) $country_id Country ID
	 * @return Country object
	 */
	function get_country( $country_id ) {
		$CI =& get_instance();

		// Get from database
		$country = $CI->app_model->get_country_by_id( $country_id );

		return $country;
	}
}

if( !function_exists( 'country_by_iso' ) ) {
	/**
	 * Get a country info from database with it's ISO prefix code
	 *
	 * @access public
	 * @param  (string) $iso_country_code ISO prefix code of country
	 * @return Country object
	 */
	function country_by_iso( $iso_country_code ) {
		// Load CI object
		$CI =& get_instance();

		// Get country name with iso code
		$country = $CI->app_model->get_country_by_iso( $iso_country_code );

		return $country;
	}
}

if( !function_exists( 'get_current_lang' ) ) {
	/**
	 * Get the current language that user selected.
	 * User selected langauge will be stored in session data
	 *
	 * @access public
	 * @return (string) Current language
	 */
	function get_current_lang() {
		$CI =& get_instance();

		// language
		$lang = $CI->session->userdata( 'lang' );
		
		return ( $lang ) ? $lang : 'en';
	}
}

if( !function_exists( 'get_current_locale' ) ) {
	/**
	 * Get the current locale stored in session
	 *
	 * @access public
	 * @return (string) Current locale stored in session
	 */
	function get_current_locale() {
		$CI =& get_instance();

		// language
		$lang = $CI->session->userdata( 'locale' );
		
		return ( $lang ) ? $lang : 'en';
	}
}

if( !function_exists( 'get_language_active' ) ) {
	/**
	 * Get the current language that user selected.
	 * User selected langauge will be stored in session data
	 *
	 * @access public
	 * @return (string) Current language
	 */
	function get_language_active($language_active) {
		$CI =& get_instance();
		return $language_active;
	}
}

if (!function_exists('cut_text')) {

    function cut_text($text = null, $numb_chars = 50) {
        if (!empty($text)) {
            $text = strip_tags($text);
            if (strlen($text) >= $numb_chars) {
                for ($i = 0; $i < 20; $i++) {
                    if (substr($text, $numb_chars, 1) != ' ') {
                        $numb_chars++;
                    } else {
                        break;
                    }
                }
                return substr($text, 0, $numb_chars) . '...';
            }
            return $text;
        }
    }

}

if( !function_exists( 'get_option' ) ) {
	/**
	 * Get options value from settings table
	 *
	 * @access public
	 * @param  (string) $option_key Option key to find in settings
	 * @param  (string) $default Default string to use if option does not exist or empty
	 * @return (string) Option value or default value if it's provided and option does not exist or empty
	 */
	function get_option( $option_key, $default = '' ) {
		// Get CI object
		$CI =& get_instance();

		// Get value from db
		$option = $CI->db->select( 'setting_value' )->where( 'setting_key', $option_key )->get( $CI->db->dbprefix( 'settings' ) )->row();

		if( !$option || $option->setting_value == '' ) { return htmlspecialchars( $default, ENT_QUOTES, 'UTF-8' ); }

		return htmlspecialchars( $option->setting_value, ENT_QUOTES, 'UTF-8' );
	}
}

if( !function_exists( 'get_pages_dropdown' ) ) {
	/**
	 * Generate HTML combo select for pages
	 *
	 * @access public
	 * @param  (bool) $all Select all languages or only enabled languages
	 * @param  (string) $selected Selected value
	 * @param  (string) $name Field name
	 * @param  (string) $id ID of field
	 * @param  (string) $class Class to use for selector to apply special CSS
	 * @param  (bool) $pre_selected Add pre-selected option as default
	 */
	function get_pages_dropdown( $active = TRUE, $selected = '', $name = '', $id = '', $class = '', $pre_selected = true, 
									$pre_selected_text = 'Select Page' ) {
		// Get CI object
		$CI = &get_instance();

		// Get pages from db
		$pages = $CI->db->select( 'id, slug, title' )->from( $CI->db->dbprefix( 'pages' ) )->get()->result();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'option-pages' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= '<option value="">' . $pre_selected_text . '</option>';
			} else {
				$html .= '<option value="" selected>' . $pre_selected_text . '</option>';
			}
		}

		$selected_text = '';

		if( count( $pages ) > 0 ) {
			foreach( $pages as $page ) {
				$selected_text = ( $selected == $page->id ) ? ' selected' : '';
				$html .= '<option value="' . $page->id . '"' . $selected_text . '>' . $page->title . '</option>';
			}
		}

		$html .= '</select>';
		echo $html;
	}
}

if( !function_exists( '_e' ) ) {
	/**
	 * Echo text safely. No html specialchars allow. Escape single and double quotes.
	 * 
	 * @access public
	 * @param  (string) $text Text to echo
	 * @param  (bool)   $echo Output text if it's TRUE. Return string if it's FALSE
	 * @return void
	 */
	function _e( $text, $echo = true ) {
		$text = mb_convert_encoding( $text, 'UTF-8' );
		$text = htmlspecialchars( $text );

		if( !$echo ) {
			return $text;
		}

		echo $text;
	}
}

if( !function_exists( 'get_image_size' ) ) {
	/**
	 * Get the dimension of image
	 *
	 * @access public
	 * @param  (string) $source Path to the image. It must be relative or absolute server path, not a URL.
	 * @param  (string) $dimension Dimension of image to return. 'width' or 'height' must be provided.
	 * @return (int) Dimension of image provided in $dimension argument
	 */
	function get_image_size( $source, $dimension = 'both' ) {
		// Check file exists
		if( !file_exists( $source ) ) {
			return false;
		}

		// Get the image size
		$image_size = getimagesize( $source );

		if( $dimension == 'width' ) { return $image_size[0]; }
		if( $dimension == 'height' ) { return $image_size[1]; }

		return $image_size;
	}
}

if( !function_exists( 'get_collapse_menu_title' ) ) {
	/**
	 * Return title for collapse menu dynamically due to the configuration value store in cookie.
	 *
	 * @access public
	 * @return (string) Returns 'Expand menu' if cookie '_sidebar_collapsed' item exists, otherwise returns 'Collapse menu'
	 */
	function get_collapse_menu_title() {
		if( function_exists( 'get_cookie' ) ) {
			$_sidebar_collapsed = get_cookie( '_sidebar_collapsed' );
			if( $_sidebar_collapsed != null || $_sidebar_collapsed == 1 ) {
				return 'Expand menu';
			}

			return 'Collapse menu';
		}

		return '';
	}
}

if( !function_exists( 'get_ui_class' ) ) {
	/**
	 * Return class append in <body> element if sidebar is collapsed and stored in cookie.
	 *
	 * @access public
	 * @return (string) Returns 'collapsed' for class append into <body> tag if '_sidebar_collapsed' cookie exists.
	 */
	function get_ui_class() {
		if( function_exists( 'get_cookie' ) ) {
			if( get_cookie( '_sidebar_collapsed' ) == 1 ) {
				_e( ' collapsed' );
			}
		}
	}
}

if( !function_exists( 'get_years_dropdown' ) ) {
	/**
	 * Generate HTML combo select for years
	 *
	 * @access public
	 * @param  (bool) $all Select all languages or only enabled languages
	 * @param  (string) $selected Selected value
	 * @param  (string) $name Field name
	 * @param  (string) $id ID of field
	 * @param  (string) $class Class to use for selector to apply special CSS
	 * @param  (bool) $pre_selected Add pre-selected option as default
	 */
	function get_years_dropdown( $start_year, $end_year, $selected = '', $name = '', $id = '', $class = '', $pre_selected = true, 
									$pre_selected_text = 'Select Year' ) {
		// Get CI object
		$CI = &get_instance();

		// if start and end year is provided
		if( $start_year ) {
			// Make sure it's valid year format
			if( preg_match( '/[0-9]{4}/i', $start_year ) !== FALSE ) {
				$start_year = $start_year;
			} else {
				$start_year = '1900';
			}
		}

		if( $end_year ) {
			// Make sure it's valid year format
			if( preg_match( '/[0-9]{4}/i', $end_year ) !== FALSE ) {
				$end_year = $end_year;
			} else {
				$end_year = date( 'Y' );
			}
		}

		// Make sure start year is less than end year
		if( $start_year >= $end_year ) {
			$start_year = '1900';
		}

		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'year' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= '<option value="">' . $pre_selected_text . '</option>';
			} else {
				$html .= '<option value="" selected>' . $pre_selected_text . '</option>';
			}
		}

		$selected_text = '';

		// Looping and generate years combo
		for( $year = $start_year; $year <= $end_year; $year++ ) {
			$selected_text = ( $selected == $year ) ? ' selected' : '';
			$html .= '<option value="' . $year . '"' . $selected_text . '>' . $year . '</option>';
		}

		$html .= '</select>';
		echo $html;
	}
}

if( !function_exists( 'get_language_name' ) ) {
	/**
	 * Get language name by it's ID
	 *
	 * @access public
	 * @param  (int) $lang_id ID of language
	 * @param  (string) $lang Language to display the language name
	 * @return Language object
	 */
	function get_language_name( $lang_id, $lang = 'de' ) {
		// Load CI object
		$CI =& get_instance();

		// Get language name with locale
		$language = $CI->app_model->get_language_by_id( intval( $lang_id ) );
		
		if( !empty( $language ) ) {
			$language_name = 'name_' . $lang;
			return $language->$language_name;
		}

		return '';
		//return ( $language ) ? $language->name : '';
	}
}

if( !function_exists( 'get_language_from_cookie' ) ) {
	/**
	 * Return selected language.
	 *
	 * @access public
	 * @return string Returns language.
	 */
	function get_language_from_cookie() {
		if( function_exists( 'get_cookie' ) ) {
			$language = get_cookie('_language');
			$language = ($language)? $language : 'de';
			return $language;
		}
	}
}

if( !function_exists( 'get_softwares_dropdown' ) ) {
	/**
	 * Generate HTML combo select for softwares
	 *
	 * @access public
	 * @param  (string) $selected Selected value
	 * @param  (string) $name Field name
	 * @param  (string) $id ID of field
	 * @param  (string) $class Class to use for selector to apply special CSS
	 * @param  (bool) $pre_selected Add pre-selected option as default
	 */
	function get_softwares_dropdown( $selected = '', $name = '', $id = '', $class = '', $pre_selected = true, 
										$pre_selected_text = 'Softwares' ) {
		// Get CI object
		$CI = &get_instance();

		// Get softwares
		$softwares = $CI->app_model->get_softwares();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'software' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= '<option value="">' . $pre_selected_text . '</option>';
			} else {
				$html .= '<option value="" selected>' . $pre_selected_text . '</option>';
			}
		}

		$selected_text = '';

		if( count( $softwares['results'] ) > 0 ) {
			foreach( $softwares['results'] as $software ) {
				$selected_text = ( $selected == $software->id ) ? ' selected' : '';
				$html .= '<option value="' . $software->id . '"' . $selected_text . '>' . $software->name . '</option>';
			}
		}

		$html .= '</select>';
		echo $html;
	}
}

if( !function_exists( 'get_subject_areas_dropdown' ) ) {
	/**
	 * Generate HTML combo select for subject areas
	 *
	 * @access public
	 * @param  (string) $selected Selected value
	 * @param  (string) $name Field name
	 * @param  (string) $id ID of field
	 * @param  (string) $class Class to use for selector to apply special CSS
	 * @param  (bool) $pre_selected Add pre-selected option as default
	 */
	function get_subject_areas_dropdown( $selected = '', $name = '', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Subject Area' ) {
		// Get CI object
		$CI = &get_instance();

		// Get subject areas
		$subject_areas = $CI->app_model->get_subjects();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'subject-area' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= '<option value="">' . $pre_selected_text . '</option>';
			} else {
				$html .= '<option value="" selected>' . $pre_selected_text . '</option>';
			}
		}

		$selected_text = '';

		// Get the language for title
		$title = 'title_' . get_language_from_cookie();

		if( count( $subject_areas['results'] ) > 0 ) {
			foreach( $subject_areas['results'] as $subject_area ) {
				$selected_text = ( $selected == $subject_area->id ) ? ' selected' : '';
                /*Ted-added 27_3 . Fixing bug for showing empty items*/
                if(!empty($subject_area->$title))
                {
                    $html .= '<option value="' . $subject_area->id . '"' . $selected_text . '>' . $subject_area->$title . '</option>';		
                }
            }
		}

		$html .= '</select>';
		echo $html;
	}
}

if( !function_exists( 'get_worker_types_dropdown' ) ) {
	/**
	 * Generate HTML combo select for worker types
	 *
	 * @access public
	 * @param  (string) $selected Selected value
	 * @param  (string) $name Field name
	 * @param  (string) $id ID of field
	 * @param  (string) $class Class to use for selector to apply special CSS
	 * @param  (bool) $pre_selected Add pre-selected option as default
	 */
	function get_worker_types_dropdown( $selected = '', $name = '', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Type of worker' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$workers_types = $CI->app_model->get_worker_types();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'type_of_work' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . ' class="form-control" id="source">';

		if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= '<option value="">' . $pre_selected_text . '</option>';
			} else {
				$html .= '<option value="" selected>' . $pre_selected_text . '</option>';
			}
		}

		$selected_text = '';

		if( count( $workers_types ) > 0 ) {
			foreach( $workers_types as $workers_type ) {
				$selected_text = ( $selected == $workers_type->id ) ? ' selected' : '';
				$html .= '<option value="' . $workers_type->id . '"' . $selected_text . '>' . $workers_type->title . '</option>';
			}
		}

		$html .= '</select>';
		echo $html;
	}
}


if( !function_exists( 'get_absence_types_dropdown' ) ) {
	/**
	 * Generate HTML combo select for absence types
	 *
	 * @access public
	 * @param  (string) $selected Selected value
	 * @param  (string) $name Field name
	 * @param  (string) $id ID of field
	 * @param  (string) $class Class to use for selector to apply special CSS
	 * @param  (bool) $pre_selected Add pre-selected option as default
	 */
	function get_absence_types_dropdown( $selected = '', $name = '', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Type' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$absence_types = $CI->app_model->get_absence_types();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? 'absence-type' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . '>';

		if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= '<option value="">' . $pre_selected_text . '</option>';
			} else {
				$html .= '<option value="" selected>' . $pre_selected_text . '</option>';
			}
		}

		$selected_text = '';

		if( count( $absence_types ) > 0 ) {
			foreach( $absence_types as $absence_type ) {
				$selected_text = ( $selected == $absence_type->id ) ? ' selected' : '';
				$html .= '<option value="' . $absence_type->id . '"' . $selected_text . '>' . $absence_type->title . '</option>';
			}
		}

		$html .= '</select>';
		echo $html;
	}
}

if( !function_exists( 'setup_localization' ) ) {
	/**
	 * Get language and locale from cookie and bind text domain for localization
	 *
	 * @access public
	 * @param  (string) $text_domain Text domain to use
	 * @param  (string) $path Catalog path where PO and MO file of the localized text stored
	 * @return void
	 */
	function setup_localization( $text_domain, $path ) {
		// Localization
		$lang   = get_cookie( '_language' );
		$locale = get_cookie( '_locale' );

		if( $lang == false ) { $lang = 'en'; }
		if( $locale == false ) { $locale = 'en_US'; }
		
		bindtextdomain( $text_domain, $path );
		bind_textdomain_codeset( $locale, 'UTF-8' );
	}
}

if( !function_exists( '_i18n' ) ) {
	/**
	 * Internationalizing interface string using 'dgettext'
	 * The textdomain must be loaded before in particular controller of module.
	 *
	 * @access public
	 * @param  (string) $domain Text domain to find the string. Default domain is system.
	 * @param  (string) $msgid Text to be translated from the text domain
	 * @return (string) Returns the translated string from specific text domain
	 */
	function _i18n( $msgid, $domain = 'system', $plural = false, $plural_number = 0 ) {
		if( $plural !== false ) {
			return utf8_encode( sprintf( dngettext( $domain, $msgid, $plural, $plural_number ), $plural_number ) );
		}

		return utf8_encode( dgettext( $domain, $msgid ) );
	}
}

if( !function_exists( 'get_clients_dropdown' ) ) {
	/**
	 * Generate HTML combo select for worker types
	 *
	 * @access public
	 * @param  (string) $selected Selected value
	 * @param  (string) $name Field name
	 * @param  (string) $id ID of field
	 * @param  (string) $class Class to use for selector to apply special CSS
	 * @param  (bool) $pre_selected Add pre-selected option as default
	 */
	function get_clients_dropdown( $selected = '', $name = 'client_id', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Choose Client' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$clients = $CI->app_model->get_clients();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . ' class="form-control" id="client_id">';

		if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= '<option value="">' . $pre_selected_text . '</option>';
			} else {
				$html .= '<option value="" selected>' . $pre_selected_text . '</option>';
			}
		}

		$selected_text = '';

		if( count( $clients ) > 0 ) {
			foreach( $clients as $client ) {
				$selected_text = ( $selected == $client->id ) ? ' selected' : '';
				$html .= '<option value="' . $client->id . '"' . $selected_text . '>' . $client->client_name . '</option>';
			}
		}

		$html .= '</select>';
		echo $html;
	}
}

if( !function_exists( 'get_users_dropdown' ) ) {
	/**
	 * Generate HTML combo select for worker types
	 *
	 * @access public
	 * @param  (string) $selected Selected value
	 * @param  (string) $name Field name
	 * @param  (string) $id ID of field
	 * @param  (string) $class Class to use for selector to apply special CSS
	 * @param  (bool) $pre_selected Add pre-selected option as default
	 */
	function get_users_dropdown( $selected = '', $name = 'user_id', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Choose Seller' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$users = $CI->app_model->get_users();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . ' class="form-control" id="user_id">';

		if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= '<option value="">' . $pre_selected_text . '</option>';
			} else {
				$html .= '<option value="" selected>' . $pre_selected_text . '</option>';
			}
		}

		$selected_text = '';

		if( count( $users ) > 0 ) {
			foreach( $users as $user ) {
				$selected_text = ( $selected == $user->id ) ? ' selected' : '';
				$html .= '<option value="' . $user->id . '"' . $selected_text . '>' . $user->first_name .' '.$user->last_name . '</option>';
			}
		}

		$html .= '</select>';
		echo $html;
	}
}

if( !function_exists( 'get_offers_dropdown' ) ) {
	/**
	 * Generate HTML combo select for worker types
	 *
	 * @access public
	 * @param  (string) $selected Selected value
	 * @param  (string) $name Field name
	 * @param  (string) $id ID of field
	 * @param  (string) $class Class to use for selector to apply special CSS
	 * @param  (bool) $pre_selected Add pre-selected option as default
	 */
	function get_offers_dropdown( $selected = '', $name = 'offer_id', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Choose Offer' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$offers = $CI->app_model->get_offers();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . ' class="form-control" id="offer_id">';

		if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= '<option value="">' . $pre_selected_text . '</option>';
			} else {
				$html .= '<option value="" selected>' . $pre_selected_text . '</option>';
			}
		}

		$selected_text = '';

		if( count( $offers ) > 0 ) {
			foreach( $offers as $offer ) {
				$selected_text = ( $selected == $offer->id ) ? ' selected' : '';
				$html .= '<option value="' . $offer->id . '"' . $selected_text . '>' . $offer->offer_number . '</option>';
			}
		}

		$html .= '</select>';
		echo $html;
	}
}

if( !function_exists( 'get_type_work_dropdown' ) ) {
	/**
	 * Generate HTML combo select for worker types
	 *
	 * @access public
	 * @param  (string) $selected Selected value
	 * @param  (string) $name Field name
	 * @param  (string) $id ID of field
	 * @param  (string) $class Class to use for selector to apply special CSS
	 * @param  (bool) $pre_selected Add pre-selected option as default
	 */
	function get_type_work_dropdown( $selected = '', $name = 'work_type', $id = '', $class = '', $pre_selected = true 
											 ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$work_types = $CI->app_model->get_type_works();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . ' class="form-control" id="work_type">';
        
		$selected_text = '';

		if( count( $work_types ) > 0 ) {
			foreach( $work_types as $work_type ) {
				$selected_text = ( $selected == $work_type->id ) ? ' selected' : '';
				$html .= '<option value="' . $work_type->id . '"' . $selected_text . '>' . $work_type->title . '</option>';
			}
		}

		$html .= '</select>';
		echo $html;
}
}
if( !function_exists( 'get_area_dropdown' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function get_area_dropdown( $selected = '', $name = 'area_name', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Select' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$areas = $CI->app_model->get_areas();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . ' class="form-control" id="area_name">';

		$selected_text = '';

		if( count( $areas ) > 0 ) {
			foreach( $areas as $area ) {
				$selected_text = ( $selected == $area->id ) ? ' selected' : '';
				$html .= '<option value="' . $area->id . '"' . $selected_text . '>' . $area->area . '</option>';
			}
		}

		$html .= '</select>';
		echo $html;
	}
}

if( !function_exists( 'get_workers_dropdown' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function get_workers_dropdown( $selected = '', $name = 'worker[]', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Select worker' ) {
		// Get CI object
		$CI = &get_instance();
        
		// Get absence types
		$workers = $CI->app_model->get_all_workers();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = "<select name= '$name' class='form-control' id=''>";

		if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= "<option value=''>" . $pre_selected_text . "</option>";
			} else {
				$html .= "<option value='' selected>" . $pre_selected_text . "</option>";
			}
		}

		$selected_text = '';

		if( count( $workers ) > 0 ) {
			foreach( $workers as $worker ) {
				$selected_text = ( $selected == $worker->id ) ? ' selected' : '';
				$html .= "<option value='$worker->id' $selected_text >" . $worker->first_name . " ". $worker->last_name . "</option>";
			}
		}

		$html .= "</select>";
		echo $html;
	}
}

if( !function_exists( 'get_subcontractor_drop_down' ) ) {
	/**
	 * Generate HTML combo select for worker types
	 *
	 * @access public
	 * @param  (string) $selected Selected value
	 * @param  (string) $name Field name
	 * @param  (string) $id ID of field
	 * @param  (string) $class Class to use for selector to apply special CSS
	 * @param  (bool) $pre_selected Add pre-selected option as default
	 */
	function get_work_multiple( $offer_id, $selected = '', $name = 'work_multiple', $id = '', $class = '', $pre_selected = true 
											 ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$works = $CI->app_model->get_works($offer_id);

		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . ' class="form-control" id="work_multiple" multiple=""> ';
        
		$selected_text = '';

		if( count( $works ) > 0 ) {
			foreach( $works as $work ) {
				$selected_text = ( $selected == $work->id ) ? ' selected' : '';
				$html .= '<option value="' . $work->id . '"' . $selected_text . '>' . $work->name . '</option>';
			}
		}

		$html .= '</select>';
		echo $html;
    }
}

if( !function_exists( 'get_subcontractor_drop_down' ) ) {
	/**
	 * Generate HTML combo select for worker types
	 *
	 * @access public
	 * @param  (string) $selected Selected value
	 * @param  (string) $name Field name
	 * @param  (string) $id ID of field
	 * @param  (string) $class Class to use for selector to apply special CSS
	 * @param  (bool) $pre_selected Add pre-selected option as default
	 */
	function get_subcontractor_drop_down( $selected = '', $name = 'sub_contractor', $id = '', $class = '', $pre_selected = true 
											 ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$sub_contractors = $CI->app_model->get_sub_contractors();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . ' class="form-control" id="sub_contractor">';
        
		$selected_text = '';

		if( count( $sub_contractors ) > 0 ) {
			foreach( $sub_contractors as $sub_contractor ) {
				$selected_text = ( $selected == $sub_contractor->id ) ? ' selected' : '';
				$html .= '<option value="' . $sub_contractor->id . '"' . $selected_text . '>' . $sub_contractor->name . '</option>';
			}
		}

		$html .= '</select>';
		echo $html;
    }
}

if( !function_exists( 'get_project_drop_down' ) ) {
	/**
	 * Generate HTML combo select for worker types
	 *
	 * @access public
	 * @param  (string) $selected Selected value
	 * @param  (string) $name Field name
	 * @param  (string) $id ID of field
	 * @param  (string) $class Class to use for selector to apply special CSS
	 * @param  (bool) $pre_selected Add pre-selected option as default
	 */
	function get_project_drop_down( $selected = '', $name = 'project_number', $id = '', $class = '', $pre_selected = true 
											 ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$projects = $CI->app_model->get_projects();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = '<select name="' . $name . '"' . $id . $class . ' class="form-control" id="project_number">';
        
		$selected_text = '';

		if( count( $projects ) > 0 ) {
			foreach( $projects as $project ) {
				$selected_text = ( $selected == $project->id ) ? ' selected' : '';
				$html .= '<option value="' . $project->id . '"' . $selected_text . '>' . $project->project_number . '</option>';
			}
		}

		$html .= '</select>';
		echo $html;
    }
}

if( !function_exists( 'get_suppervisors_dropdown' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function get_suppervisors_dropdown( $selected = '', $name = 'suppervisor', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Select suppervisor' ) {
		// Get CI object
		$CI = &get_instance();
        
		// Get absence types
		$suppervisors = $CI->app_model->get_all_suppervisors();

		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = "<select name= '$name' class='form-control' id='suppervisor_drop'>";

		if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= "<option value=''>" . $pre_selected_text . "</option>";
			} else {
				$html .= "<option value='' selected>" . $pre_selected_text . "</option>";
			}
		}

		$selected_text = '';

		if( count( $suppervisors ) > 0 ) {
			foreach( $suppervisors as $suppervisor ) {
				$selected_text = ( $selected == $suppervisor->id ) ? ' selected' : '';
				$html .= "<option value='$suppervisor->id'  $selected_text > " . $suppervisor->first_name . " ". $suppervisor->last_name . "</option>";
			}
		}
		$html .= "</select>";
		echo $html;
	}
}
if( !function_exists( 'get_rental_scaffold_type_dropdown' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function get_rental_scaffold_type_dropdown( $selected = '', $name = 'rental_scaffold_type[]', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Select Type' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$rental_scaffold_types = $CI->app_model->get_all_rental_scaffold_types();
        
		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = "<select name= '$name' class='rental_scaffold_type' onclick='change_rental_scaffold_type();'>";

        if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= "<option value='' >" . $pre_selected_text . "</option>";
			} else {
				$html .= "<option value='' selected>" . $pre_selected_text . "</option>";
			}
		}
		$selected_text = '';

		if( count( $rental_scaffold_types ) > 0 ) {
			foreach( $rental_scaffold_types as $rental_scaffold_type ) {
				$selected_text = ( $selected == $rental_scaffold_type->id ) ? ' selected' : '';
				$html .= "<option value='$rental_scaffold_type->id' onclick='change_rental_scaffold_type();' ".$selected_text.">" . $rental_scaffold_type->name . "</option>";
			}
		}
		$html .= "</select>";
		echo $html;
	}
}

if( !function_exists( 'get_material_dropdown' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function get_material_dropdown( $selected = '', $name = 'name_material[]', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Select Type' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$materials = $CI->app_model->get_all_material();
        
		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = "<select name= '$name' class='select_name_material'>";
		$selected_text = '';

		if( count( $materials ) > 0 ) {
			foreach( $materials as $material ) {
				$selected_text = ( $selected == $material->id ) ? ' selected' : '';
				$html .= "<option value='$material->id' ".$selected_text.">" . $material->name . "</option>";
			}
		}
		$html .= "</select>";
		echo $html;
	}
}

if( !function_exists( 'get_work_scaffold_type_dropdown' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function get_work_scaffold_type_dropdown( $selected = '', $name = 'work_scaffold_type[]', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Select Type' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$rental_scaffold_types = $CI->app_model->get_all_rental_scaffold_types();
        
		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = "<select name= '$name' class='work_scaffold_type'>";

        if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= "<option value='' >" . $pre_selected_text . "</option>";
			} else {
				$html .= "<option value='' selected>" . $pre_selected_text . "</option>";
			}
		}
		$selected_text = '';

		if( count( $rental_scaffold_types ) > 0 ) {
			foreach( $rental_scaffold_types as $rental_scaffold_type ) {
				$selected_text = ( $selected == $rental_scaffold_type->id ) ? ' selected' : '';
				$html .= "<option value='$rental_scaffold_type->id' ".$selected_text.">" . $rental_scaffold_type->name . "</option>";
			}
		}
		$html .= "</select>";
		echo $html;
	}
}

if( !function_exists( 'get_rental_scaffold_type_dropdown_fee' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function get_rental_scaffold_type_dropdown_fee( $selected = '', $name = 'rental_scaffold_type_fee[]', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Select Type' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$rental_scaffold_types = $CI->app_model->get_all_rental_scaffold_types();
        
		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = "<select name= '$name' class='form-control rental_fee' >";

        if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= "<option value='' >" . $pre_selected_text . "</option>";
			} else {
				$html .= "<option value='' selected>" . $pre_selected_text . "</option>";
			}
		}
		$selected_text = '';

		if( count( $rental_scaffold_types ) > 0 ) {
			foreach( $rental_scaffold_types as $rental_scaffold_type ) {
				$selected_text = ( $selected == $rental_scaffold_type->id ) ? ' selected' : '';
				$html .= "<option value='$rental_scaffold_type->id' ".$selected_text.">" . $rental_scaffold_type->name . "</option>";
			}
		}
		$html .= "</select>";
		echo $html;
	}
}

if( !function_exists( 'get_house_dropdown' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function get_house_dropdown( $selected = '', $name = 'house', $id = 'house', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Select House' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$houses = $CI->app_model->get_all_house();
        
		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = "<select name= '$name' class='form-control' id='house'>";

        if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= "<option value='' >" . $pre_selected_text . "</option>";
			} else {
				$html .= "<option value='' selected>" . $pre_selected_text . "</option>";
			}
		}
		$selected_text = '';

		if( count( $houses ) > 0 ) {
			foreach( $houses as $house ) {
				$selected_text = ( $selected == $house->id ) ? ' selected' : '';
				$html .= "<option value='$house->id' ".$selected_text.">" . $house->name . "</option>";
			}
		}
		$html .= "</select>";
		echo $html;
	}
}

if( !function_exists( 'get_kind_dropdown' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function get_kind_dropdown( $selected = '', $name = 'kind[]', $id = 'kind', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Select Type Cost' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$kinds = $CI->app_model->get_all_kinds();
        
		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = "<select name= '$name' class='form-control kind_cost' >";

       
		$selected_text = '';

		if( count( $kinds ) > 0 ) {
			foreach( $kinds as $kind ) {
				$selected_text = ( $selected == $kind->id ) ? ' selected' : '';
				$html .= "<option value='$kind->id' ".$selected_text.">" . $kind->name_kind . "</option>";
			}
		}
		$html .= "</select>";
		echo $html;
	}
}

if( !function_exists( 'step_dropdown' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function step_dropdown( ) {
		// Get CI object
		$CI = &get_instance();
		$html = "<select name= 'step_offer[]' class='step_offer'>";
        $html.= "<option value='1'>Step 1</option>";  
        $html.= "<option value='2'>Step 2</option>";
        $html.= "<option value='3'>Step 3</option>";
        $html.= "<option value='4'>Step 4</option>";
        $html.= "<option value='5'>Step 5</option>"; 
		$html .= "</select>";
		echo $html;
	}
}

if( !function_exists( 'step_dropdown_unit_matrial' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function step_dropdown_unit_matrial( ) {
		// Get CI object
		$CI = &get_instance();
		$html = "<select name= 'per_unit_material[]' class='per_unit_material'>";
        $html.= "<option value='1'>m</option>";  
        $html.= "<option value='2'>m2</option>";
        $html.= "<option value='3'>pcs</option>";
        $html.= "<option value='4'>rolls</option>";
        $html.= "<option value='5'>pack</option>"; 
        $html.= "<option value='6'>L</option>"; 
		$html .= "</select>";
		echo $html;
	}
}
if( !function_exists( 'step_dropdown_work' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function step_dropdown_work( ) {
		// Get CI object
		$CI = &get_instance();
		$html = "<select name= 'step_offer_work[]' class='step_offer'>";
        $html.= "<option value='1'>Step 1</option>";  
        $html.= "<option value='2'>Step 2</option>";
        $html.= "<option value='3'>Step 3</option>";
        $html.= "<option value='4'>Step 4</option>";
        $html.= "<option value='5'>Step 5</option>"; 
		$html .= "</select>";
		echo $html;
	}
}

if( !function_exists( 'get_contact_person_dropdown' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function get_contact_person_dropdown( $selected = '', $name = 'contact_person_id', $id = 'contact_person', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Select contact person' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$contact_persons = $CI->app_model->get_all_workers();
        
		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = "<select name= '$name' class='form-control contact_person' id='contact_person_id'>";

        if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= "<option value='' >" . $pre_selected_text . "</option>";
			} else {
				$html .= "<option value='' selected>" . $pre_selected_text . "</option>";
			}
		}
		$selected_text = '';

		if( count( $contact_persons ) > 0 ) {
			foreach( $contact_persons as $contact_person ) {
				$selected_text = ( $selected == $contact_person->id ) ? ' selected' : '';
				$html .= "<option value='$contact_person->id' ".$selected_text.">" . $contact_person->first_name ." ".$contact_person->last_name." </option>";
			}
		}
		$html .= "</select>";
		echo $html;
	}
}

if( !function_exists( 'get_seller_dropdown' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function get_seller_dropdown( $selected = '', $name = 'seller_id', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Select seller' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$sellers = $CI->app_model->get_all_workers();
        
		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = "<select name= '$name' class='form-control seller_id' id='seller_id' >";

        if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= "<option value='' >" . $pre_selected_text . "</option>";
			} else {
				$html .= "<option value='' selected>" . $pre_selected_text . "</option>";
			}
		}
		$selected_text = '';

		if( count( $sellers ) > 0 ) {
			foreach( $sellers as $seller ) {
				$selected_text = ( $selected == $seller->id ) ? ' selected' : '';
				$html .= "<option value='$seller->id' ".$selected_text.">" . $seller->first_name ." ".$seller->last_name." </option>";
			}
		}
		$html .= "</select>";
		echo $html;
	}
}

if( !function_exists( 'get_all_responsive_sv_dropdown' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function get_all_responsive_sv_dropdown( $selected = '', $name = 'responsible_sv_id', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = '' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$sellers = $CI->app_model->get_all_responsive_sv();
        
		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = "<select name= '$name' class='form-control responsible_sv_id' id='responsible_sv_id' >";

        if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= "<option value='' >" . $pre_selected_text . "</option>";
			} else {
				$html .= "<option value='' selected>" . $pre_selected_text . "</option>";
			}
		}
		$selected_text = '';

		if( count( $sellers ) > 0 ) {
			foreach( $sellers as $seller ) {
				$selected_text = ( $selected == $seller->id ) ? ' selected' : '';
				$html .= "<option value='$seller->id' ".$selected_text.">" . $seller->first_name ." ".$seller->last_name." </option>";
			}
		}
		$html .= "</select>";
		echo $html;
	}
}

if( !function_exists( 'get_all_foreman_dropdown' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function get_all_foreman_dropdown( $selected = '', $name = 'foreman_id', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Select foreman' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$sellers = $CI->app_model->get_all_foremans();
        
		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = "<select name= '$name' class='form-control foreman_id' id='foreman_id'>";

        if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= "<option value='' >" . $pre_selected_text . "</option>";
			} else {
				$html .= "<option value='' selected>" . $pre_selected_text . "</option>";
			}
		}
		$selected_text = '';

		if( count( $sellers ) > 0 ) {
			foreach( $sellers as $seller ) {
				$selected_text = ( $selected == $seller->id ) ? ' selected' : '';
				$html .= "<option value='$seller->id' ".$selected_text.">" . $seller->first_name ." ".$seller->last_name." </option>";
			}
		}
		$html .= "</select>";
		echo $html;
	}
}

if( !function_exists( 'get_work_scaffold_type_dropdown' ) ) {
/**
 * Generate HTML combo select for worker types
 *
 * @access public
 * @param  (string) $selected Selected value
 * @param  (string) $name Field name
 * @param  (string) $id ID of field
 * @param  (string) $class Class to use for selector to apply special CSS
 * @param  (bool) $pre_selected Add pre-selected option as default
 */
	function get_work_scaffold_type_dropdown( $selected = '', $name = 'rental_tent_type[]', $id = '', $class = '', $pre_selected = true, 
											$pre_selected_text = 'Select Type' ) {
		// Get CI object
		$CI = &get_instance();

		// Get absence types
		$work_scaffold_types = $CI->app_model->get_all_work_scaffold_types();
        
		// Prepare combo attributes
		$name   = ( '' == $name ) ? '' : $name;
		$id     = ( '' == $id ) ? '' : ' id="' . $id . '"';
		$class  = ( '' == $class ) ? '' : ' class="' . $class . '"';

		$html = "<select name= '$name' class='form-control rental_tent_type' onclick='change_rental_tent_type();'>";

        if( $pre_selected ) {
			if( '' != $selected ) {
				$html .= "<option value='' >" . $pre_selected_text . "</option>";
			} else {
				$html .= "<option value='' selected>" . $pre_selected_text . "</option>";
			}
		}
		$selected_text = '';

		if( count( $work_scaffold_types ) > 0 ) {
			foreach( $work_scaffold_types as $work_scaffold_type ) {
				$selected_text = ( $selected == $work_scaffold_type->id ) ? ' selected' : '';
				$html .= "<option value='$work_scaffold_type->id' onclick='change_rental_tent_type();' $selected_text>" . $work_scaffold_type->name . "</option>";
			}
		}
		$html .= "</select>";
		echo $html;
	}
}
    function generate_work_number(){
        $CI = &get_instance();
        $year = date("Y");
        $sql = 'SELECT id FROM ltno_works ORDER BY id DESC LIMIT 1';
        $id = $CI->db->query($sql);
        if($id->result() != null){
            $id = $id->row();$id = intval($id->id);
            $id = str_pad($id+1, 6, '0', STR_PAD_LEFT);
            $generate = $year.$id;
            echo $generate;
        }else{
            echo $year.'000001';
        }
    }
    
    function generate_offer_number(){
        $CI = &get_instance();
        $year = date("Y");
        $sql = 'SELECT id FROM ltno_offers ORDER BY id DESC LIMIT 1';
        $id = $CI->db->query($sql);
        if($id->result() != null){
            $id = $id->row();$id = intval($id->id);
            $id = str_pad($id+1, 5, '0', STR_PAD_LEFT);
            $generate = $year.$id;
            echo $generate;
        }else{
            echo $year.'00001';
        }
    }
    function generate_rental_number(){
        $CI = &get_instance();
        $sql = 'SELECT id FROM ltno_works ORDER BY id DESC LIMIT 1';
        $id = $CI->db->query($sql);
        if($id->result() != null){
            $id = $id->row();
            $id = intval($id->id);
            $id = str_pad($id+1, 6, '0', STR_PAD_LEFT);
            echo $id;
        } 
        else{
            echo '000001';
        }
    }
    
    function get_supervisor(){
        $CI = &get_instance();
        $user_id = $CI->session->userdata('user_id');
        if($CI->app_model->check_user_is_supervisor($user_id)){
            $sql = "select * from ltno_workers where type_of_work_id = 1";
            $worker = $CI->db->query($sql);
            return $worker->result();
        }
        return null;
    }
    function display_name_suppervisor(){
        $CI = &get_instance();
        $user_id = $CI->session->userdata('user_id');
        if($CI->app_model->check_user_is_supervisor($user_id)){
            $sql = "select * from ltno_workers where user_id = '$user_id'";
            $worker = $CI->db->query($sql);
            $worker = $worker->row();
            echo $worker->first_name . ' ' . $worker->last_name;
        }
    }


/* End */
/* Location: `application/helpers/utilities_helper.php` */