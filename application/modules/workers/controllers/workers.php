<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Worker controller
 *
 * @package     CodeIgniter 2.2.0
 *
 * @module      worker_module
 * @controller  Worker
 *
 */

class Workers extends MX_Controller {
	/**
	 * Class constructor
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {
		// Parent class constructor
		parent::__construct();
		if( !is_user_logged_in() ) {
			// Redirect back
			redirect( 'auth/login/?continue=' . urlencode( current_url() ), 'location' );
			return false;
		}
		// Load model
        $this->load->model('worker_model');
        $this->load->model('users_model');
	}

	/**
	 * Default action
	 *
	 * @access public
	 * @return mixed
	 */
	function index() {
	    //check user is admin
        //$this->logtrino_user->is_user_admin());
	    $workers = $this->worker_model->get_all_workers();
        $data = array(
            'workers' => $workers
        );
        $this->logtrino_ui->_set_data( $data );
        $this->logtrino_ui->_set_title( _i18n( 'Overviews' ) );
        $this->logtrino_ui->_set_view( 'overviews' );
        $this->logtrino_ui->_render();
	}

    /**
     * Create worker 
     * @access admin    
     * @return void
     */
     function create(){
        if(is_form_submit()){
            // prepare data insert table
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $sub_contractor = $this->input->post('sub_contractor');
            $type_of_work = $this->input->post('type_of_work');
            $tax_number = $this->input->post('tax_number');
            $finish_id = $this->input->post('finish_id');
            $green_card_number = $this->input->post('green_card_number');
            $green_date_picker = $this->input->post('green_date_picker');
            $green_date_picker = '01/'.$green_date_picker;
            $green_att_pic = $this->input->post('green_att_pic');
            $blue_card_number = $this->input->post('blue_card_number');
            $blue_date_picker = $this->input->post('blue_date_picker');
            $blue_date_picker = '01/'.$blue_date_picker;
            $blue_att_pic = $this->input->post('blue_att_pic');
            $email_address = $this->input->post('email_address');
            $password = $this->input->post('password');
            
            //load library to encrypt password
            $this->load->library( 'phpass' );
			$this->phpass->setup( 8, true );
			// Generate a secure crypted password
			$hash_password = $this->phpass->HashPassword( $password );
            
            $phone_number = $this->input->post('phone_number');
            $valtti_kortti = $this->input->post('valtti_kortti');
            $valtti_kortti_date_picker = $this->input->post('valtti_kortti_date_picker');
            $valtti_kortti_date_picker = '01/'.$valtti_kortti_date_picker;
            $valtti_kortti_att_pic = $this->input->post('valtti_kortti_att_pic');
            $accidenttti = $this->input->post('accidenttti');
            $phone_accidenttti = $this->input->post('phone_accidenttti');
            $accidenttti_att_pic = $this->input->post('accidenttti_att_pic');
            $local_address = $this->input->post('local_address');
            $home_address = $this->input->post('home_address');
            $picture_worker = $this->input->post('picture_worker');
            $hour_price1 = $this->input->post('hour_price1');
            $hour_price2 = $this->input->post('hour_price2');
            $hour_price3 = $this->input->post('hour_price3');
            $is_active = $this->input->post('is_active');
            $comment = $this->input->post('comment');
            if($is_active){
                $active = 1;
            }else{
                $active = 0;
            }
            $green_date_picker = strtotime($green_date_picker);
            $green_date_picker = date('Y-m-d', $green_date_picker);
            $blue_date_picker = strtotime($blue_date_picker);
            $blue_date_picker = date('Y-m-d', $blue_date_picker);
            $valtti_kortti_date_picker = strtotime($valtti_kortti_date_picker);
            $valtti_kortti_date_picker = date('Y-m-d', $valtti_kortti_date_picker);
            if($this->worker_model->mail_exists($email_address)){
                $this->session->set_flashdata( 'message', 
				array(
    					'warning' => array( 'email is exist !!.' )
    				)
                );
                redirect( 'workers' );
            }
            // insert into table
            $user_id = $this->worker_model->create_user_worker($email_address, $hash_password, $first_name, $last_name);
            $worker_id = $this->worker_model->create_worker($first_name, $last_name, $sub_contractor, $type_of_work, $tax_number,$finish_id, $green_card_number, $green_date_picker, $blue_card_number, $blue_date_picker, $email_address, $password, $phone_number, $valtti_kortti, $valtti_kortti_date_picker, $accidenttti,  $phone_accidenttti, $local_address, $home_address, $picture_worker, $hour_price1, $hour_price2, $hour_price3, $active, $comment, $user_id);
            
            $this->uploadFileCreateWorker($worker_id, $green_att_pic, 'green_att_pic');
    
            $this->uploadFileCreateWorker($worker_id, $blue_att_pic, 'blue_att_pic');
    
            $this->uploadFileCreateWorker($worker_id, $valtti_kortti_att_pic, 'valtti_kortti_att_pic');
        
            $this->uploadFileCreateWorker($worker_id, $accidenttti_att_pic, 'accidenttti_att_pic');
            
            $this->uploadFileCreateWorker($worker_id, $picture_worker, 'picture_worker');
            redirect('workers');
        }
        $this->logtrino_ui->_set_title( _i18n( 'Create worker' ) );
        $this->logtrino_ui->_set_view( 'create' );
        $this->logtrino_ui->_render();
    }
    
    /**
     * Edit worker 
     * @access admin    
     * @return void
     */
     function process(){
        if(is_form_submit()){
            $worker_id = $this->input->post('worker_id');
            
            if($worker_id == ''){
                $this->create();
                redirect('workers');
            }
            // prepare data insert table
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $sub_contractor = $this->input->post('sub_contractor');
            $type_of_work = $this->input->post('type_of_work');
            $tax_number = $this->input->post('tax_number');
            $finish_id = $this->input->post('finish_id');
            $green_card_number = $this->input->post('green_card_number');
            $green_date_picker = $this->input->post('green_date_picker');
            $green_date_picker = '01/'.$green_date_picker;
            $green_att_pic = $this->input->post('green_att_pic');
            $blue_card_number = $this->input->post('blue_card_number');
            $blue_date_picker = $this->input->post('blue_date_picker');
            $blue_date_picker = '01/'.$blue_date_picker;
            $blue_att_pic = $this->input->post('blue_att_pic');
            $email_address = $this->input->post('email_address');
            $password = $this->input->post('password');
            
            //load library to encrypt password
            $this->load->library( 'phpass' );
			$this->phpass->setup( 8, true );
			// Generate a secure crypted password
			$hash_password = $this->phpass->HashPassword( $password );
            
            $phone_number = $this->input->post('phone_number');
            $valtti_kortti = $this->input->post('valtti_kortti');
            $valtti_kortti_date_picker = $this->input->post('valtti_kortti_date_picker');
            $valtti_kortti_date_picker = '01/'.$valtti_kortti_date_picker;
            $valtti_kortti_att_pic = $this->input->post('valtti_kortti_att_pic');
            $accidenttti = $this->input->post('accidenttti');
            $phone_accidenttti = $this->input->post('phone_accidenttti');
            $accidenttti_att_pic = $this->input->post('accidenttti_att_pic');
            $local_address = $this->input->post('local_address');
            $home_address = $this->input->post('home_address');
            $picture_worker = $this->input->post('picture_worker');
            $hour_price1 = $this->input->post('hour_price1');
            $hour_price2 = $this->input->post('hour_price2');
            $hour_price3 = $this->input->post('hour_price3');
            $is_active = $this->input->post('is_active');
            $comment = $this->input->post('comment');
            if($is_active){
                $active = 1;
            }else{
                $active = 0;
            }
            $green_date_picker = strtotime($green_date_picker);
            $green_date_picker = date('Y-m-d', $green_date_picker);
            $blue_date_picker = strtotime($blue_date_picker);
            $blue_date_picker = date('Y-m-d', $blue_date_picker);
            $valtti_kortti_date_picker = strtotime($valtti_kortti_date_picker);
            $valtti_kortti_date_picker = date('Y-m-d', $valtti_kortti_date_picker);
            // insert into table

            if($email_address == $this->worker_model->mail_exists_edit($email_address) || !$this->worker_model->mail_exists($email_address)){
                $worker = $this->worker_model->get_by_id($worker_id);
                $this->worker_model->edit_user_worker($worker->user_id, $email_address, $hash_password, $first_name, $last_name);
                $this->worker_model->edit_worker($worker_id, $first_name, $last_name, $sub_contractor, $type_of_work, $tax_number,$finish_id, $green_card_number, $green_date_picker, $blue_card_number, $blue_date_picker, $email_address, $password, $phone_number, $valtti_kortti, $valtti_kortti_date_picker, $accidenttti,  $phone_accidenttti, $local_address, $home_address, $picture_worker, $hour_price1, $hour_price2, $hour_price3, $active, $comment);
                
                $this->uploadFileCreateWorker($worker_id, $green_att_pic, 'green_att_pic');
        
                $this->uploadFileCreateWorker($worker_id, $blue_att_pic, 'blue_att_pic');
        
                $this->uploadFileCreateWorker($worker_id, $valtti_kortti_att_pic, 'valtti_kortti_att_pic');
            
                $this->uploadFileCreateWorker($worker_id, $accidenttti_att_pic, 'accidenttti_att_pic');
                
                $this->uploadFileCreateWorker($worker_id, $picture_worker, 'picture_worker');
               
                redirect( 'workers' );
            }else{
                $this->session->set_flashdata( 'message', 
				array(
							'warning' => array( 'email is exist !!.' )
						)
                );
                redirect('workers');
            }
        }
    }
    
    function  get_worker_by_id(){
        $id = $this->input->get('id');
        $worker = $this->worker_model->get_by_id($id);
        echo json_encode($worker);
    }

	/**
	 * Custom 404 page not found
	 * This method redirect to default action if 404 is occurred and avoiding illegal access.
	 *
	 * @access public
	 * @return void
	 */
	function show_404() {
		redirect( site_url(), 'location' );
		exit();
	}
    
    public function uploadFileCreateWorker( $worker_id, $file_name, $field_upload ) {
       
        if(isset($_FILES[$field_upload]) && is_uploaded_file($_FILES[$field_upload]['tmp_name'])){
            // Load configuration for file upload

            $this->config->load( 'worker_file_config' );  
            
            // Get configurations
            $upload_config = $this->config->item( 'att_picture_file' );
    
            $template_file_path = 'uploads/'.$field_upload.'/'.$worker_id.'/';
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
                
                if($field_upload == 'green_att_pic'){
                    $this->worker_model->update_url_file_att_picture($worker_id, 'green_card_picture', $url_file);
                }
                if($field_upload == 'blue_att_pic'){
                    $this->worker_model->update_url_file_att_picture($worker_id, 'blue_card_picture', $url_file);
                }
                if($field_upload == 'valtti_kortti_att_pic'){
                    $this->worker_model->update_url_file_att_picture($worker_id, 'valtti_picture', $url_file);
                }
                if($field_upload == 'accidenttti_att_pic'){
                    $this->worker_model->update_url_file_att_picture($worker_id, 'accidenttti_picture', $url_file);
                }
                if($field_upload == 'picture_worker'){
                    $this->worker_model->update_url_file_att_picture($worker_id, 'picture_worker', $url_file);
                }
                return true;		
            }
        }
    }
    
    function delete_attach_picture(){
        $worker_id = $this->input->get('worker_id');
        $field_attach = $this->input->get('field_attach');
        $this->worker_model->delete_attach($worker_id, $field_attach);
    }

}

/* End */
/* Location: `application/modules/workers/controllers/workers.php` */