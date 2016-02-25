<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Users widget controller
 * Widget controller use in users module.
 *
 * @package      CodeIgniter 2.2.0
 *
 * @module       users_module
 * @controller   Users_widget
 *
 * @ __construct()
 * @ index()
 * @ _admins_overview()
 * @ show_404()
 */

class Users_widget extends MX_Controller {

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
	}

	/**
	 * Not allow to access directly from browser. To avoid this
	 * prefix method name with underscore before method name.
	 * 
	 * Get all admin users overview
	 *
	 * @access protected
	 * @return mixed
	 */
	function _admins_overview() {
		// Get admin users
		$admin_users = $this->users_model->get_admin_users();

		// Prepare data to pass into UI
		$data = array(
			'users' => $admin_users['results'],
			'total' => $admin_users['num_rows']
		);

		// If more than 5 records found, add pagination to UI
		if( $admin_users['num_rows'] > 5 ) {
			// Configure pagination for admin overview
			$pagination_config = array(
				'full_tag_open'  => '<ul class="pagination admin-overview-pagination ajax-pagination pull-right">',
				'base_url'       => site_url( 'users/ajax/admins_overview' ),
				'first_url'      => site_url( 'users/ajax/admins_overview' ),
				'total_rows'     => $admin_users['num_rows'],
				'per_page'       => 20,
				'first_link'     => FALSE,
				'last_link'      => FALSE,
				'show_inactive'  => TRUE,
			);

			$this->logtrino_ui->_set_up_pagination( $pagination_config );

			$data['pagination'] = $this->logtrino_ui->_pagination( FALSE );
		}
		
		// Display notifications
		$this->logtrino_ui->_set_data( $data );
		$this->logtrino_ui->_render( 'users/widget/admins_overview' );

		echo $this->logtrino_ui->_get_render_data();
	}

	/**
	 * Display overview table of supplier translation
	 *
	 * @access public
	 * @return void
	 */
	function supplier_translation( $supplier_id ) {

		// Get all translation charges of supplier
		$translation_charges = $this->users_model->get_translation_charges( intval( $supplier_id ) );

		// Set up data for UI
		$data = array( 'translation_charges' => $translation_charges );
		$this->logtrino_ui->_set_data( $data );

		// Render overview table
		$this->logtrino_ui->_render( 'users/widget/translation_overview' );
	}

	/**
	 * Display overview table of supplier interpreting
	 *
	 * @access public
	 * @return void
	 */
	function supplier_interpreting( $supplier_id ) {
		// Get all interpreting charges of supplier
		$interpreting_charges = $this->users_model->get_interpreting_charges( intval( $supplier_id ) );

		// Set up data for UI
		$data = array( 'interpreting_charges' => $interpreting_charges );
		$this->logtrino_ui->_set_data( $data );

		// Render overview table
		$this->logtrino_ui->_render( 'users/widget/interpreting_overview' );
	}

	/**
	 * Display overview table of post editing
	 *
	 * @access public
	 * @return void
	 */
	function supplier_post_editing( $supplier_id ) {
		// Get all post editing charges of supplier
		$post_editing_charges = $this->users_model->get_post_editing_charges( intval( $supplier_id ) );

		// Set up data for UI
		$data = array( 'post_editing_charges' => $post_editing_charges );
		$this->logtrino_ui->_set_data( $data );

		// Render overview table
		$this->logtrino_ui->_render( 'users/widget/post_editing_overview' );
	}

	/**
	 * Display overview table of supplier proof reading
	 *
	 * @access public
	 * @return void
	 */
	function supplier_proof_reading( $supplier_id ) {
		// Get all proof reading charges of supplier
		$proof_reading_charges = $this->users_model->get_proof_reading_charges( intval( $supplier_id ) );

		// Set up data for UI
		$data = array( 'proof_reading_charges' => $proof_reading_charges );
		$this->logtrino_ui->_set_data( $data );

		// Render overview table
		$this->logtrino_ui->_render( 'users/widget/proof_reading_overview' );
	}

	/**
	 * Display overview table of supplier field of expertise
	 *
	 * @access public
	 * @return void
	 */
	function supplier_field_of_expertise( $supplier_id ) {
		// Get fields of expertise
		$fields_of_expertise = $this->users_model->get_supplier_fields_of_expertise( intval( $supplier_id ) );

		// Prepare data
		$data = array( 'fields_of_expertise' => $fields_of_expertise );

		// Set up data for UI
		$this->logtrino_ui->_set_data( $data );

		// Render overview table
		$this->logtrino_ui->_render( 'users/widget/supplier_field_of_expertise' );
	}

	/**
	 * Display overview table of supplier softwares
	 *
	 * @access public
	 * @return void
	 */
	function supplier_softwares( $supplier_id ) {

		// Render overview table
		$this->logtrino_ui->_render( 'users/widget/supplier_softwares' );
	}

	/**
	 * Display overview table of supplier qualifications
	 *
	 * @access public
	 * @return void
	 */
	function supplier_qualifications( $supplier_id ) {
		// Prepare data
		$data = array(
			'translations' => array(
				array(
					'source_language' => 'DE',
					'target_language' => 'EN',
					'word'            => '0.06',
					'line'            => '0.25',
					'hour'            => '25',
					'minimum_charge'  => '25'
				)
			)
		);

		// Set up data for UI
		$this->logtrino_ui->_set_data( $data );

		// Render overview table
		$this->logtrino_ui->_render( 'users/widget/supplier_qualifications' );
	}

	/**
	 * Display overview table of supplier absence
	 *
	 * @access public
	 * @return void
	 */
	function supplier_absence( $supplier_id ) {
		// Get all absences of supplier
		$absences = $this->users_model->get_absences( intval( $supplier_id ) );

		// Set up data for UI
		$data = array( 'absences' => $absences );
		$this->logtrino_ui->_set_data( $data );

		// Render overview table
		$this->logtrino_ui->_render( 'users/widget/supplier_absence' );
	}

	/**
	 * Custom 404 page not found
	 * This method redirect to default action if 404 is occurred and avoiding illegal access.
	 *
	 * @access public
	 * @return void
	 */
	function show_404() {
		redirect( 'users', 'location' );
		exit();
	}
}


/* End */
/* Location: `application/modules/users/controllers/users_widget.php` */