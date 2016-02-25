<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Followup extends MX_Controller{
    
    function __construct() {
		// Parent class constructor
		parent::__construct();
		// Check user already logged in
		if( !is_user_logged_in() ) {
			// Redirect back
			redirect( 'auth/login/?continue=' . urlencode( current_url() ), 'location' );
			return false;
		}
        $this->load->model('followup_model');
    }
    
    function index(){
        // $works = [];
        // $work_queue = [];
        $all_client = $this->followup_model->get_data_all_client();
        $all_project = $this->followup_model->get_data_all_project();
        $all_scaffold_id = $this->followup_model->get_data_all_scaffold_id();
        $all_scaffold_type = $this->followup_model->get_data_all_scaffold_type();
        $all_house = $this->followup_model->get_data_all_house();
        $all_room = $this->followup_model->get_data_all_room();

        $data = array(
            // 'works'         => $works,
            // 'works_queue'   => $work_queue,
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

    function search_followup(){
        $client_id = $this->input->get('client_id');
        $databind = $this->followup_model->search_followup($client_id);
        echo json_encode($databind);
    }
    
}