<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Projects extends MX_Controller{
    function __construct() {

		// Parent class constructor
		parent::__construct();
		// Check user already logged in
		if( !is_user_logged_in() ) {
			// Redirect back
			redirect( 'auth/login/?continue=' . urlencode( current_url() ), 'location' );
			return false;
		}
		// Check user already logged in
        $this->load->model('project_model');
        $this->load->model('clients/clients_model');
        $this->load->helper('url');
	}

    function index() {
		$projects = $this->project_model->get_all_projects();
        $data = array(
            'projects' => $projects
        );
        // Set data
		$this->logtrino_ui->_set_data( $data );
		// Check user role to choose the edit view
		$this->logtrino_ui->_set_view( 'overviews' );
		// Display UI
		$this->logtrino_ui->_set_title( 'Overviews' );
		$this->logtrino_ui->_render();
	}
    
    function  get_project_id(){
        $id = $this->input->get('id');
        $project = $this->project_model->get_by_id($id);
        echo json_encode($project);
    }
    
    function create(){
        if(is_form_submit()){
            $client_id = $this->input->post('client_id');
            $project_number = $this->input->post('project_number');
            $order_number = $this->input->post('order_number');
            $seller_id = $this->input->post('user_id');
            $responsible_sv = $this->input->post('responsible_sv');
            $this->project_model->create($project_number,$client_id,$order_number,$seller_id,$responsible_sv);
            $this->session->set_flashdata( 'message', 
				array(
							'success' => array( 'Created success!!.' )
						)
			);
            redirect( 'projects' );
        }
    	$this->logtrino_ui->_set_view( 'clients/create' );
        $this->logtrino_ui->_render();
        
    }
    
    function get_info_client(){
        $client_id = $this->input->get('client_id');
        $client = $this->offer_model->get_client_by_id($client_id);
        echo json_encode($client);
    }
    
    function edit(){
        $action = $this->input->post('action');
        if($action == 'Save'){
            $project_id = $this->input->post('project_id');
            if($project_id == ''){
                $this->create();
                $this->session->set_flashdata( 'message', 
				array(
							'success' => array( 'Created success!!.' )
						)
			);
                redirect( 'projects' );
            }
            $client_id = $this->input->post('client_id');
            $project_number = $this->input->post('project_number');
            $order_number = $this->input->post('order_number');
            $seller_id = $this->input->post('user_id');
            $responsible_sv = $this->input->post('responsible_sv');
            $this->project_model->edit($project_id,$project_number,$client_id,$order_number,$seller_id,$responsible_sv);
            $this->session->set_flashdata( 'message', 
				array(
							'success' => array( 'Edited success!!.' )
						)
			);
            redirect( 'projects' );
        }
       
    }
   
}


?>