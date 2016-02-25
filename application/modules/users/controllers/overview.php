<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Overview controller
 * Admin can see overview of all users and users with specific
 * user types, roles and statuses
 *
 * @package     CodeIgniter 2.2.0
 *
 * @module      users_module
 * @controller  Overview
 *
 * @ __construct()
 * @ index()
 * @ translators()
 * @ admins()
 * @ show_404()
 */

class Overview extends MX_Controller {

	/**
	 * Class constructor
	 * Check authorize access for logged in user to access this private area.
	 * Load helpers, config and models file for users module
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

		// Setup UAC
		$this->logtrino_uac->_init( 'users' );
		$this->logtrino_uac->_set_rules( 
			array( 
				'create_user', 'edit_user', 'delete_user',
				'create_email', 'edit_email', 'update_primary_email', 'delete_email',
				'create_address', 'edit_address', 'update_primary_address', 'delete_address'
			) 
		);

		// Load based stylesheets, scripts for UI
		$this->logtrino_ui->_add_style( 'bootstrap-switch', base_url( 'assets/css/bootstrap-switch.css' ), array( 'media' => 'all' ) );
		$this->logtrino_ui->_add_style( 'datepicker', base_url( 'assets/css/bootstrap-datetimepicker.min.css' ), array( 'media' => 'all' ) );

		$this->logtrino_ui->_add_script( 'datapicker', base_url( 'assets/js/bootstrap-datetimepicker.min.js' ), array() );
		$this->logtrino_ui->_add_script( 'bootstrap-switch', base_url( 'assets/js/bootstrap-switch.min.js' ), array() );

	}

	/**
	 * Default action of controller
	 *
	 * @access public
	 * @return mixed
	 */
	function index() {

		// Show admin overview as default
		$this->admins();
		return false;
	}

	/**
	 * Administrator can see overview of translators by 
	 * different contact types and status
	 *
	 * @access public
	 * @return mixed
	 */
	function translators() {

		/* Only administrator can access */
		if( !$this->logtrino_user->is_admin() ) {
			redirect( 'users/profile', 'refresh' );
			return false;
		}

		// Default params
		$default_params = array(
			'type', 'status'
		);

		// Check URI, request overview by type or status
		$params = $this->uri->uri_to_assoc( 4, $default_params );

		// Check the page number
		$current_page = ( $this->input->get( 'page', true ) ) ? (int) $this->input->get( 'page', true ) : 1;
		$offset       = ( $current_page * 10 ) - 10;

		// Order
		$sort = $this->input->get( 'sort', true );
		$order = strtoupper( $this->input->get( 'order', true ) );

		// Generate base url for pagination
		$query_string = $_SERVER['QUERY_STRING'];
		$query_string = preg_replace( '/(page(=?\d?)&?)/i', '', $query_string );

		if( substr( $query_string, -1 ) == '&' ) {
			$query_string = substr( $query_string, 0, -1 );
		}

		$base_url = '?' . $query_string;

		// Pagination config
		$pagination_config = array(
			'base_url'             => $base_url,
			'first_url'            => $base_url,
			'uri_segment'          => FALSE,
			'page_query_string'    => TRUE,
			'query_string_segment' => 'page',
			'show_inactive'        => TRUE,
			'first_link'           => FALSE,
			'last_link'            => FALSE,
		);

		// Filter options of translators
		$type = '';
		$status = '';

		// List translators with specific type, status
		if( FALSE !== $params['type'] && $params['type'] < 5 ) {
			$translators = $this->users_model->get_translators_by_type( $params['type'], $offset, 10, $sort, $order );
			$applicant_type = $this->users_model->get_applicant_type_by_id( $params['type'] );
			$page_title = $applicant_type->type;
			$type = $params['type'];

		} elseif( FALSE !== $params['status'] && $params['status'] < 5 ) {
			$translators = $this->users_model->get_translators_by_status( $params['status'], $offset, 10, $sort, $order );
			$applicant_status  = $this->users_model->get_applicant_status_by_id( $params['status'] );
			$page_title = $applicant_status->status;
			$status = $params['status'];
		} else {
			$translators = $this->users_model->get_translators( $offset, 10, $sort, $order );
			$data['show_applicant_status'] = TRUE;
			$page_title = 'Translators';
		}

		// Give total rows for pagination
		$pagination_config['total_rows'] = $translators['num_rows'];

		// Load pagination library
		$this->logtrino_ui->_set_up_pagination( $pagination_config );
		
		//echo '<pre>';
		//var_dump($translators["results"][1]->);exit;
		// Set data for UI
		$data['translators'] = $translators['results'];
		$data['total']       = $translators['num_rows'];
		$data['row_start']   = $offset;
		$data['result_count']= sprintf( 'Showing %d to %d of %d entries', ($offset+1), ($offset+10), $translators['num_rows']);
		$data['type']        = $type;
		$data['status']      = $status;

		$this->logtrino_ui->_set_data( $data );

		// Register breadcrumb
		$this->logtrino_ui->_register_breadcrumb( array( 'label' => $page_title ) );

		// Set up UI
		$this->logtrino_ui->_set_title( 'Overview ' . $page_title );
		$this->logtrino_ui->_set_view( 'admin/overview_translators' );

		$this->logtrino_ui->_render();
	}

	/**
	 * Administrator can see overview of all admin users
	 *
	 * @access public
	 * @return mixed
	 */
	function admins() {
		// Make sure only admin user can view that
		if( !$this->logtrino_user->is_admin() ) {
			// Not admin
			redirect( 'users/profile/', 'location' );
			return false;
		}

		// Check the page number
		$current_page = ( $this->input->get( 'page', true ) ) ? (int) $this->input->get( 'page', true ) : 1;

		// Calculate offset to query from database, show 10 records per page
		$offset       = ( $current_page * 10 ) - 10;

		// Order
		$sort = $this->input->get( 'sort', true );
		$order = strtoupper( $this->input->get( 'order', true ) );

		// Generate base url for pagination
		$query_string = $_SERVER['QUERY_STRING'];
		$query_string = preg_replace( '/(page(=?\d?)&?)/i', '', $query_string );
		$query_string = substr( $query_string, 0, -1 );
		
		$base_url = '?' . $query_string;

		// Get admin users
		$admin_users = $this->users_model->get_admin_users( $offset, 10, $sort, $order );

		// Pagination config
		$pagination_config = array(
			'base_url'            => $base_url,
			'first_url'            => $base_url,
			'uri_segment'          => FALSE,
			'page_query_string'    => TRUE,
			'query_string_segment' => 'page'
		);

		// Load pagination library
		$this->logtrino_ui->_set_up_pagination( $pagination_config );

		// Set data for UI
		$data['admin_users'] = $admin_users['results'];
		$data['total']       = $admin_users['num_rows'];
		$data['row_start']   = $offset;
		$data['result_count']= sprintf( 'Showing %d to %d of %d entries', ($offset+1), ($offset+10), $admin_users['num_rows']);

		$this->logtrino_ui->_set_data( $data );

		// Register breadcrumb
		$this->logtrino_ui->_register_breadcrumb( array( 'label' => 'Overview Administrators' ) );

		// Set up UI
		$this->logtrino_ui->_set_title( 'Overview Administrator' );
		$this->logtrino_ui->_set_view( 'admin/overview_admins' );

		$this->logtrino_ui->_render();
	}

	/**
	 * Custom 404 page not found
	 * This method redirect to default action if 404 is occurred and avoiding illegal access.
	 *
	 * @access public
	 * @return void
	 */
	function show_404( $title = '', $message_header = '' ) {
		$CI =& get_instance();
		
		// Set header
		$CI->output->set_header( '404' );
		$CI->output->set_status_header( '404' );

		// Prepare data
		if( '' == $title ) { 
			$title = 'Page Not Found'; 
		}

		if( '' == $message_header ) {
			$message_header = 'The page you requested not found.';
		}

		$data = array(
			'message_header' => $message_header
		);

		// Prepare UI
		$CI->logtrino_ui->_set_title( $title );
		$CI->logtrino_ui->_set_view( '404' );
		$CI->logtrino_ui->_set_data( $data );

		// Render UI
		$CI->logtrino_ui->_render();
	}

}


/* End */
/* Location: `application/modules/users/controllers/overview.php` */