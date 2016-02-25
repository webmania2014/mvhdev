<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Dashboard controller
 *
 * @package     CodeIgniter 2.2.0
 *
 * @module      dashboard_module
 * @controller  Dashboard
 *
 * @ __construct()
 * @ index()
 * @ show_404()
 */

class Dashboard extends MX_Controller {

	/**
	 * Class constructor
	 * Check authorize access for logged in user to access this private area.
	 * Load helpers, config and models file for dashboard module
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {

		// Parent class constructor
		parent::__construct();

		// Check user already logged in
		if( !is_user_logged_in() ) {
			// Redirect back
			redirect( 'auth/login/?continue=' . urlencode( current_url() ), 'location' );
			return false;
		}
        
		// Load library
		$this->load->library( 'logtrino_user' );
		// Do not add this controller in breadcrumb
		$this->logtrino_ui->_init_breadcrumb();
       
	}

	/**
	 * Default action
	 *
	 * @access public
	 * @return mixed
	 */
	function index() {
		// Set up UI
		$this->logtrino_ui->_set_title(  'Dashboard' );
		$this->logtrino_ui->_set_view( 'overview' );
		$this->logtrino_ui->_render();
	}

	/**
	 * Custom 404 page not found
	 * This method redirect to default action if 404 is occurred and avoiding illegal access.
	 *
	 * @access public
	 * @return void
	 */
	function show_404() {
		redirect( 'dashboard', 'location' );
		exit();
	}
}

/* End */
/* Location: `application/modules/dashboard/controllers/dashboard.php` */