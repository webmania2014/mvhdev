<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Activity widget controller. This controller serves to display user's activities 
 * in other modules as a widget.
 * Widget controller use in activity module.
 *
 * @package      CodeIgniter 2.2.0
 * @module       activity_module
 * @controller   Activity_widget
 *
 * @ __construct()
 * @ _recent_activities()
 * @ activities()
 * @ show_404()
 */

class Activity_widget extends MX_Controller {

	/**
	 * Class constructor
	 * Check authorize access for logged in user to access this private area.
	 * Load helpers, config and models file for activity module
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
		$this->load->helper( 'utilities' );

		// Load model
		$this->load->model( 'activity_model' );

		// Set up localization
		setup_localization( 'mod_activity', APPPATH . 'locale' );

	}

	/**
	 * Not allow to access directly from browser. To avoid this
	 * prefix method name with underscore before method name.
	 * 
	 * Get recent activities of user and display
	 *
	 * @access protected
	 * @return mixed
	 */
	function _recent_activities( $user_id = '' ) {
		if( '' == $user_id ) {
			$user_id = $this->logtrino_user->get_id();
		}
		
		// Get activities
		$activities = $this->activity_model->get_activities_by_user_id( $user_id, 0, 5 );

		// View data
		$data = array(
			'activities'    => $activities['results'],
			'total_results' => $activities['num_rows']
		);

		// Pagination config
		$pagination_config = array(
			'base_url'      => site_url( 'activity/ajax/list_activities' ),
			'first_url'     => site_url( 'activity/ajax/list_activities' ),
			'total_rows'    => $activities['num_rows'],
			'per_page'      => 5,
			'full_tag_open' => '<ul class="pagination activities-ajax-pagination ajax-pagination pull-right">',
			'first_link'    => FALSE,
			'last_link'     => FALSE,
			'show_inactive' => TRUE,
			'display_pages' => FALSE
		);
		
		$this->logtrino_ui->_set_up_pagination( $pagination_config );

		// Display activities
		$this->logtrino_ui->_set_data( $data );
		$this->logtrino_ui->_render( 'activity/widget/recent_activities' );

		echo $this->logtrino_ui->_get_render_data();
	}
	
	function activities( $user_id = '' ) {
		if( '' == $user_id ) {
			$user_id = $this->logtrino_user->get_id();
		}
		
	
		$this->logtrino_ui->_render( 'activity/widget/activities' );

		echo $this->logtrino_ui->_get_render_data();
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
/* Location: `application/modules/activity/controllers/activity_widget.php` */