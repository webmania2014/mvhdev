<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Reports extends MX_Controller{
    
    function __construct() {
		// Parent class constructor
		parent::__construct();
		// Check user already logged in
		if( !is_user_logged_in() ) {
			// Redirect back
			redirect( 'auth/login/?continue=' . urlencode( current_url() ), 'location' );
			return false;
		}
        $this->load->model('report_model');
    }
    
    function index(){
        // $works = $this->report_model->get_all_workers_on_going();
        $works = [];
        // $work_queue = $this->report_model->get_all_workers_queue();
        $work_queue = [];
        $all_client = $this->report_model->get_data_all_client();
        $all_project = $this->report_model->get_data_all_project();
        $all_scaffold_id = $this->report_model->get_data_all_scaffold_id();
        $all_scaffold_type = $this->report_model->get_data_all_scaffold_type();
        $all_house = $this->report_model->get_data_all_house();
        $all_room = $this->report_model->get_data_all_room();

        $data = array(
            'works'         => $works,
            'works_queue'   => $work_queue,
            'all_client'    => $all_client,
            'all_scaffold_id'    => $all_scaffold_id,
            'all_scaffold_type'    => $all_scaffold_type,
            'all_house'    => $all_house,
            'all_room'    => $all_room,
            'all_project'    => $all_project
        );
        $this->logtrino_ui->_set_data( $data );
        $this->logtrino_ui->_set_view( 'overviews' );
		// Display UI
		$this->logtrino_ui->_set_title( 'Overviews' );
		$this->logtrino_ui->_render();
    }

    function search_report(){
        $client_id = $this->input->get('client_id');
        $databind = $this->report_model->search_report($client_id);
        echo json_encode($databind);
    }

    // function get_all_client(){
    //     $databind = $this->report_model->get_data_all_client();
    //     return $databind;
    // }
    // function get_all_project(){
    //     $databind = $this->report_model->get_data_all_project();
    //     return $databind;
    // }
    
}