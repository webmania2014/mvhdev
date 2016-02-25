<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Ajax controller
 * Activity module Ajax controller. All Ajax requests will be served by this controller and 
 * return the data with appropriate content type ( JSON or HTML )
 *
 * @package     CodeIgniter 2.2.0
 *
 * @module      activity_module
 * @controller  Ajax
 *
 * @ __construct()
 * @ list_activities()
 * @ _recent_activities_widget()
 */

class Ajax extends MX_Controller {

	/**
	 * Class constructor
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		// Parent class constructor
		parent::__construct();

		// Check user already logged in
		if( !is_user_logged_in() ) {
			/* 
			 * Set Header Status, and then, we can handel from Javascript for Ajax and 
			 * session timeout problem by detecting Header Status
			 */
			$this->output->set_status_header('401');

			// Redirect back
			redirect( 'auth/login/?continue=' . urlencode( current_url() ), 'refresh' );
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
	 * List activities from Ajax request
	 *
	 * @access public
	 * @param  (int) $page Page number which will use to calculate offset to get from database
	 * @return void
	 */
	function list_activities( $page = 1 ) {
		/**
		 * Get the params from URL
		 */
		$ajax_enabled = $this->input->get( 'ajax_enabled', true );
		$ajax_enabled = filter_var( $ajax_enabled, FILTER_VALIDATE_BOOLEAN ); // Requested by Ajax ?
		$json         = $this->input->get( 'json', true );
		$json         = filter_var( $json, FILTER_VALIDATE_BOOLEAN ); // Returns as JSON data type
		$widget       = $this->input->get( 'widget', true ); // For widget
		$view         = $this->input->get( 'view', true ); // Presentation of data

		// If pagination return as data
		$pagination   = $this->input->get( 'pagination', true );
		$pagination   = filter_var( $pagination, FILTER_VALIDATE_BOOLEAN );

		$cur_page = $page;
		$offset   = ( $page * 5 ) - 5;

		// Get notifications
		$notifications = $this->activity_model->get_activities_by_user_id( $this->logtrino_user->get_id(), $offset, 5 );

		$data = array(
			'total_results' => $notifications['num_rows'],
			'activities'    => $notifications['results'],
			'view'          => $view
		);

		if( $widget == 'recent_activities' ) {
			if( $json ) {
				$this->output->set_content_type( 'application/json' );
			}

			$this->_recent_activities_widget( $data, $json, $pagination );
		}
	}

	/**
	 * Not allow to access directly from browser. To avoid this
	 * prefix method name with underscore before method name.
	 *
	 * List recent activities in widget
	 *
	 * @access protected
	 * @param
	 * @return mixed
	 */
	function _recent_activities_widget( $data = array(), $json = false, $pagination = false ) {
		// Json or HTML
		if( $json ) {
			$data['json'] = TRUE;

			// Disable render
			$this->logtrino_ui->_disabled_render( TRUE );
		}

		// Return pagination
		if( $pagination ) {
			$data['pagination'] = TRUE;

			$pagination_config = array(
				'base_url'       => site_url( 'activity/ajax/list_activities' ),
				'first_url'      => site_url( 'activity/ajax/list_activities' ),
				'total_rows'     => $data['total_results'],
				'per_page'       => 5,
				'full_tag_open'  => '',
				'full_tag_close' => '',
				'uri_segment'    => $this->uri->total_segments(),
				'first_link'     => FALSE,
				'last_link'      => FALSE,
				'show_inactive'  => TRUE,
				'display_pages'  => FALSE
			);

			$this->logtrino_ui->_set_up_pagination( $pagination_config );
		}

		// Set data for UI
		$this->logtrino_ui->_set_data( $data );

		if( $json ) {
			$this->logtrino_ui->_render( 'widget/recent_activities' );

			$return['html']  = $this->logtrino_ui->_get_render_data();
			$return['total'] = $data['total_results'];

			if( $pagination ) {
				$return['pagination'] = $this->logtrino_ui->_pagination( FALSE );	
			}
			
			echo json_encode( $return );
		} else {
			$this->logtrino_ui->_render( 'widget/recent_activities' );
		}
	}

}

/* End */
/* Location: `application/modules/activity/controllers/ajax.php` */