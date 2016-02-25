<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Clients extends MX_Controller{
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
        $this->load->model('clients_model');
        $this->load->helper('url');
	}

    function index() {
		$clients = $this->clients_model->get_all_clients();
        $data = array(
            'clients' =>$clients
        );
        // Set data
		$this->logtrino_ui->_set_data( $data );
		// Check user role to choose the edit view
		$this->logtrino_ui->_set_view( 'clients' );
		// Display UI
		$this->logtrino_ui->_set_title( 'Overviews' );
		$this->logtrino_ui->_render();
	}
    
    function  get_client_id(){
        $id = $this->input->get('id');
        $client = $this->clients_model->get_by_id($id);
        echo json_encode($client);
    }
    function create(){
        if(is_form_submit()){
            $client_name= $this->input->post('client_name');
            $invoice_address= $this->input->post('invoice_address');
            $client_number= $this->input->post('client_number');
            $site= $this->input->post('site');
            $phone_number= $this->input->post('phone_number');
            $contact_person= $this->input->post('contact_person');
            $email= $this->input->post('email');
            $this->clients_model->create( $client_name,$invoice_address,$client_number,$site,$phone_number,$email,$contact_person);
            $this->logtrino_ui->_set_message( 'success', 
				array( 'create successfull !!!!' ) 
			);
            redirect( 'clients' );
        }
    	$this->logtrino_ui->_set_view( 'clients/create' );
        $this->logtrino_ui->_render();
        
    }
    
    function edit(){
        $action = $this->input->post('action');
        
        if($action == 'Save'){
            $client_id = $this->input->post('client_id');
            if($client_id == ''){
                $this->create();
                $this->logtrino_ui->_set_message( 'success', 
            	array( 'create successfull !!!!' ) 
    				);
                redirect( 'clients' );
            }
            $client_id = $this->input->post('client_id');
            $client_name= $this->input->post('client_name');
            $invoice_address= $this->input->post('invoice_address');
            $client_number= $this->input->post('client_number');
            $site= $this->input->post('site');
            $contact_person= $this->input->post('contact_person');
            $phone_number= $this->input->post('phone_number');
            $email= $this->input->post('email');
            
            $this->clients_model->edit($client_id, $client_name,$invoice_address,$client_number,$site,$phone_number,$email,$contact_person);
            $this->logtrino_ui->_set_message( 'success', 
            	array( 'create successfull !!!!' ) 
    				);
            redirect( 'clients' );
        }
        
        if($action == 'Delete'){
            $client_id = $this->input->post('client_id');
            $client = $this->clients_model->get_by_id($client_id);
            $data = array(
                'client' =>$client
            );
            // Set data
            $this->logtrino_ui->_set_data( $data );
  		    $this->logtrino_ui->_set_view( 'clients/delete' );
            $this->logtrino_ui->_render();
        }
    }
    function delete(){
        $client_id = $this->uri->segment(3);
        $this->clients_model->delete($client_id);
        $this->logtrino_ui->_set_message( 'success', 
			array( 'Delete successfull !!!!' ) 
		);
        redirect( 'clients' );
    }

}


?>