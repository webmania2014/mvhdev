<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Application Initializer
 *
 * Initialize all require staffs before executing specific modules.
 *
 * @package     CodeIgniter 2.2.0
 * @hook        LTNO_Initializer
 */

class LTNO_Initializer {
	function __construct() {
		$this->CI =& get_instance();
        $this->CI->session->userdata('user_id');
	}
	/**
	 * Initialize all require staffs
	 */
	function init() {
		// Set the default language
	
	}

	/**
	 * Set up localization in system
	 *
	 * @param (string) $locale Locale character
	 * @return void
	 */
	function setup_localization( $locale ) {
		// Trim any white space
		$locale = trim( $locale );
		
		// Put locale environment
		putenv( "LANG=" . $locale );
		putenv( "LANGUAGE=" . $locale );
		putenv( "LC_ALL=" . $locale );
		putenv( "LC_MESSAGES=" . $locale );

		// Set locale for all
		setlocale( LC_ALL, $locale );
		//setlocale( LC_MESSAGES, $locale );

		// Bind text domain
		bindtextdomain( 'system', APPPATH . 'locale' );
		bind_textdomain_codeset( $locale, 'UTF-8' );
		textdomain( 'system' ); // Default text domain

		// Configure messages for localization
		bindtextdomain( 'messages', APPPATH . 'locale' );
		bind_textdomain_codeset( $locale, 'UTF-8' );
	}
}

/* End */
/* Location: `application/hooks/LTNO_Initializer.php` */