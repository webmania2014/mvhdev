<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Activity controller
 * Users can view their activities via activity module
 *
 * @package      CodeIgniter 2.2.0
 * @module       activity_module
 * @controller   Activity
 *
 * @ __construct()
 * @ index()
 * @ all_activities()
 * @ _signed_in()
 * @ _signed_out()
 * @ _log_action()
 * @ show_404()
 */

class Activity extends MX_Controller {

	/**
	 * Class constructor
	 * Check authorize access for logged in user to access this private area.
	 * Load helpers, config and models file for notifications module
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

		// Load helper
		$this->load->helper( array( 'utilities', 'email' ) );

		// Load model
		$this->load->model( 'activity_model' );

		// Set up localization
		setup_localization( 'mod_activity', APPPATH . 'locale' );
	}

	/**
	 * Default action of controller
	 *
	 * @access public
	 * @return mixed
	 */
	function index() {
		$this->all_activities();
	}

	/**
	 * Display all activities of a user
	 *
	 * @access public
	 * @return mixed
	 */
	function all_activities() {
		// Get the parameters
		$params = $this->uri->uri_to_assoc( 3, array( 'page' ) );

		// Get the page number
		$page = ( $params['page'] ) ? $params['page'] : 1;

		// Calculate offset and limit for records
		$limit  = 15;
		$offset = ( $page * $limit ) - $limit;
		
		// Get all activities
		$activities = $this->activity_model->get_activities_by_user_id( $this->logtrino_user->get_id(), $offset, $limit );

		// Set data
		$data = array(
			'total_results' => $activities['num_rows'],
			'activities'    => $activities['results']
		);

		// Set up pagination
		$pagination_config = array(
			'base_url'       => site_url( 'activity/all_activities/page' ),
			'first_url'      => site_url( 'activity/all_activities' ),
			'total_rows'     => $data['total_results'],
			'per_page'       => 15,
			'uri_segment'    => $this->uri->total_segments(),
			'first_link'     => FALSE,
			'last_link'      => FALSE,
			'show_inactive'  => TRUE
		);

		$this->logtrino_ui->_set_up_pagination( $pagination_config );

		// Set up UI
		$this->logtrino_ui->_set_data( $data );
		$this->logtrino_ui->_set_title( _i18n( 'Activities Log', 'mod_activity' ) );
		$this->logtrino_ui->_set_view( 'overview' );
		$this->logtrino_ui->_render();
	}

	/**
	 * Not allow to access directly from browser. To avoid this
	 * prefix method name with underscore before method name.
	 *
	 * Log activity when user siggned in
	 *
	 * @access protected
	 * @return void
	 */
	function _signed_in( $user_id, $user_display_name ) {
		// Generate activity of signed in action
		$activity_text = '%s signed in on %s.';
		$activity_html = '<i class="fa fa-sign-in green"></i><a href="' . site_url( 'users/profile/' ) . '"><strong>%s</strong></a> signed in on %s.';
		$params        = $user_display_name . ',' . date( 'd.m.y / H:i', time() );

		// Store activity in system
		$this->activity_model->create_activity( $activity_text, $activity_html, $params, $user_id );
	}

	/**
	 * Not allow to access directly from browser. To avoid this
	 * prefix method name with underscore before method name.
	 *
	 * Log activity when user siggned out
	 *
	 * @access protected
	 * @return void
	 */
	function _signed_out() {
		// Generate activity of signed out action
		$activity_text = '%s signed out on %s.';
		$activity_html = '<i class="fa fa-sign-out grey"></i><a href="' . site_url( 'users/profile/' ) . '"><strong>%s</strong></a> signed out on %s.';
		$params        = $this->logtrino_user->get_name() . ',' . date( 'd.m.y / H:i', time() );

		// Store activity in system
		$this->activity_model->create_activity( $activity_text, $activity_html, $params, $this->logtrino_user->get_id() );

		// Update user logged out time
		$signed_out_time = array(
			'last_logged_in_time' => date( 'Y-m-d H:i:s', time() )
		);

		$this->db->where( 'id', $this->logtrino_user->get_id() );
		$this->db->update( $this->db->dbprefix( 'users' ), $signed_out_time );
	}

	/**
	 * Not allow to access directly from browser. To avoid this
	 * prefix method name with underscore before method name.
	 *
	 * Log activity when user performed some action
	 *
	 * @access protected
	 * @return void
	 */
	function _log_action( $user_id, $activity_text, $activity_html, $params ) {
		// Store activity in system
		$this->activity_model->create_activity( $activity_text, $activity_html, $params, $user_id );
	}

	/**
	 * Custom 404 page not found
	 * This method redirect to default action if 404 is occurred and avoiding illegal access.
	 *
	 * @access public
	 * @return void
	 */
	function show_404() {
		redirect( 'activity', 'location' );
		exit();
	}
}


/* End */
/* Location: `application/modules/activity/controllers/activity.php` */