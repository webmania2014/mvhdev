<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Sub_contractors extends MX_Controller{
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
        $this->load->model('sub_contractor_model');
        $this->load->helper('url');
	}

    function index() {
		$sub_contractors = $this->sub_contractor_model->get_alls();
        $data = array(
            'sub_contractors' =>$sub_contractors
        );
        // Set data
		$this->logtrino_ui->_set_data( $data );
		// Check user role to choose the edit view
		$this->logtrino_ui->_set_view( 'overviews' );
		// Display UI
		$this->logtrino_ui->_set_title( 'Overviews' );
		$this->logtrino_ui->_render();
	}
    
    function  get_by_id(){
        $id = $this->input->get('id');
        $sub_contractor = $this->sub_contractor_model->get_by_id($id);
        echo json_encode($sub_contractor);
    }
    
    function create(){
        if(is_form_submit()){
            $name = $this->input->post('name_sub');
            $reg_code = $this->input->post('reg_code');
            $address = $this->input->post('address');
            $contact = $this->input->post('contact');
            $phone_number = $this->input->post('phone_number');
            $email = $this->input->post('email');
            $email_report = $this->input->post('email_report');
            $logo = $this->input->post('logo_attach');
            $sub_contractor_id = $this->sub_contractor_model->create( $name,$reg_code,$address,$contact,$phone_number,$email,$email_report);
            
            $this->uploadFileCreate($sub_contractor_id, $logo, 'logo');
            
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
            $sub_contractor_id = $this->input->post('sub_contractor_id');
            if($sub_contractor_id == ''){
                $this->create();
                $this->logtrino_ui->_set_message( 'success', 
            	array( 'Create successfull !!!!' ) 
    				);
                redirect( 'sub_contractors' );
            }
            $sub_contractor_id = $this->input->post('sub_contractor_id');
            $name = $this->input->post('name_sub');
            $reg_code = $this->input->post('reg_code');
            $address = $this->input->post('address');
            $contact = $this->input->post('contact');
            $phone_number = $this->input->post('phone_number');
            $email = $this->input->post('email');
            $email_report = $this->input->post('email_report');
            $logo = $this->input->post('logo_attach');
            
            $this->sub_contractor_model->edit($sub_contractor_id,$name,$reg_code,$address,$contact,$phone_number,$email,$email_report);
            
            $this->uploadFileCreate($sub_contractor_id, $logo, 'logo_attach');
            
            $this->logtrino_ui->_set_message( 'success', 
            	array( 'Edit successfull !!!!' ) 
    				);
            redirect( 'sub_contractors' );
        }
        
        if($action == 'Delete'){
            $client_id = $this->input->post('client_id');
            $client = $this->sub_contractor_model->get_by_id($client_id);
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
        $this->sub_contractor_model->delete($client_id);
        $this->logtrino_ui->_set_message( 'success', 
			array( 'Delete successfull !!!!' ) 
		);
        redirect( 'clients' );
    }
    
    public function uploadFileCreate( $sub_contractor_id, $file_name, $field_upload ) {
        if(isset($_FILES[$field_upload]) && is_uploaded_file($_FILES[$field_upload]['tmp_name'])){
            // Load configuration for file upload
            
            $this->config->load( 'file_config' );  
            
            // Get configurations
            $upload_config = $this->config->item( 'att_picture_file' );
    
            $template_file_path = 'uploads/'.$field_upload.'/'.$sub_contractor_id.'/';
            chmod('uploads', 0755);
            // Make sure folder exists
            if( !is_dir( $template_file_path ) ) {
                mkdir( $template_file_path, 0777, true );
            }
            
            // Add configurations for upload
            $upload_config['upload_path'] = $template_file_path;
            $upload_config['file_name']   = $file_name;
            $this->load->library( 'upload' );
            $this->upload->initialize($upload_config);        
            
            if( !$this->upload->do_upload( $field_upload ) ) {
                // Set error message display in UI
                $this->logtrino_ui->_set_message( 'warning', trim($this->upload->display_errors()));
                return false;
            } else {
                // Get uploaded file name
                $upload_data = $this->upload->data();
                $url_file =  $template_file_path.'/'.$upload_data['file_name'];
                
                if($field_upload == 'logo_attach'){
                    $this->sub_contractor_model->update_url_file_att_picture($sub_contractor_id, 'logo', $url_file);
                }
                
                return true;		
            }
        }
    }
    
    function delete_attach_picture(){
        $sub_contractor_id = $this->input->get('sub_contractor_id');
        $field_attach = $this->input->get('field_attach');
        $this->sub_contractor_model->delete_attach($sub_contractor_id, $field_attach);
    }

}


?>