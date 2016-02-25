<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Extended library of core Exceptions
 *
 * @package     CodeIgniter 2.2.0
 */

class LTNO_Exceptions extends CI_Exceptions {

	/**
	 * Dispaly custom 404 with show_404 if controller has it's own
	 * show_404 method. Otherwise, use show_404 from parent class as 
	 * fallback solution
	 */
    public function show_404() {
    	
        if( class_exists( 'CI_Controller' ) ) {
            // Get CI object
            $CI =& get_instance();

            // Check if controller exists
            if( '' != $CI->router->class ) {
                // Check controller has it's own show_404 method
                if( method_exists( $CI->router->class, 'show_404' ) ) {
                    // Run show_404 from the controller
                    call_user_func_array( array( $CI->router->class, 'show_404' ), array() );
                    echo $CI->output->get_output();
                    exit();
                }
            }
        }
        
        // Fallback to parent show_404 method
        parent::show_404();

    }
}

/* End */
/* Location: `application/core/LTNO_Exceptions.php` */