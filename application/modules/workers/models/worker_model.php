<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class worker_model extends CI_Model {

	public $table = 'workers';

	/**
	 * Create a new worker
	 *
	 * @access public
	 * @param  (string) $first_name First name of worker
	 * @param  (string) $last_name Last name of worker
	 */
	function create_worker( $first_name, $last_name, $sub_contractor, $type_of_work, $tax_number,$finish_id, $green_card_number, $green_date_picker, $blue_card_number, $blue_date_picker, $email_address, $password, $phone_number, $valtti_kortti, $valtti_kortti_date_picker, $accidenttti,  $phone_accidenttti, $local_address, $home_address, $picture_worker, $hour_price1, $hour_price2, $hour_price3, $active, $comment, $user_id) {
		// Prepare data for columns
		$data = array(
			'first_name'                     => $first_name,
			'last_name'                      => $last_name,
			'sub_contractor_id'              => $sub_contractor,
            'type_of_work_id'                => $type_of_work,
            'tax_number'                     => $tax_number,
            'finish_id'                      => $finish_id,
            'green_card_number'              => $green_card_number,
            'green_card_exp_date'            => $green_date_picker,
            'blue_card_number'               => $blue_card_number,
            'blue_card_exp_date'             => $blue_date_picker,
            'email'                          => $email_address,
            'password'                       => $password,
            'phone'                          => $phone_number,
            'valtti_kortti'                  => $valtti_kortti,
            'valtti_exp_date'                => $valtti_kortti_date_picker,
            'contact_in_case_of_accidenttti' => $accidenttti,
            'contact_phone'                  => $phone_accidenttti,
            'local_address'                  => $local_address,
            'home_address'                   => $home_address,
            'picture_worker'                 => $picture_worker,
            'hour_price1'                    => $hour_price1,
            'hour_price2'                    => $hour_price2,
            'hour_price3'                    => $hour_price3,
            'active'                         => $active,
            'comment'                        => $comment,
            'user_id'                        => $user_id
		);
	
		// Insert new user
		$this->db->insert( 'ltno_workers' , $data );
	
		return $this->db->insert_id();
	}
    
    function edit_worker($worker_id, $first_name, $last_name, $sub_contractor, $type_of_work, $tax_number,$finish_id, $green_card_number, $green_date_picker, $blue_card_number, $blue_date_picker, $email_address, $password, $phone_number, $valtti_kortti, $valtti_kortti_date_picker, $accidenttti,  $phone_accidenttti, $local_address, $home_address, $picture_worker, $hour_price1, $hour_price2, $hour_price3, $active, $comment) {
		// Prepare data for columns
		$data = array(
			'first_name'                     => $first_name,
			'last_name'                      => $last_name,
			'sub_contractor_id'              => $sub_contractor,
            'type_of_work_id'                => $type_of_work,
            'tax_number'                     => $tax_number,
            'finish_id'                      => $finish_id,
            'green_card_number'              => $green_card_number,
            'green_card_exp_date'            => $green_date_picker,
            'blue_card_number'               => $blue_card_number,
            'blue_card_exp_date'             => $blue_date_picker,
            'email'                          => $email_address,
            'password'                       => $password,
            'phone'                          => $phone_number,
            'valtti_kortti'                  => $valtti_kortti,
            'valtti_exp_date'                => $valtti_kortti_date_picker,
            'contact_in_case_of_accidenttti' => $accidenttti,
            'contact_phone'                  => $phone_accidenttti,
            'local_address'                  => $local_address,
            'home_address'                   => $home_address,
            'hour_price1'                    => $hour_price1,
            'hour_price2'                    => $hour_price2,
            'hour_price3'                    => $hour_price3,
            'active'                         => $active,
            'comment'                        => $comment,
		);

		// Edit worker
		$this->db->where('id', $worker_id);
        $this->db->update('ltno_workers', $data); 
        return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}
    function create_user_worker($email, $password, $first_name, $last_name){
        $data = array(
            'username'      => $email,
            'password'      => $password,
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'is_activated'  => 1,
            'is_admin'      => 0
        );
        $this->db->insert( 'ltno_users' , $data );
        return $this->db->insert_id();
    }
    
    function get_all_workers(){
        $sql = "select * from ltno_workers";
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function edit_user_worker($user_id,$email, $password, $first_name, $last_name){
        $data = array(
            'username'      => $email,
            'password'      => $password,
            'first_name'    => $first_name,
            'last_name'     => $last_name,
            'is_activated'  => 1,
            'is_admin'      => 0
        );
        $this->db->where('id', $user_id);
        $this->db->update('ltno_users', $data);
        return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
    }
    
    function update_url_file_att_picture($worker_id, $field_upload, $url_file_upload){
        $data = array(
            $field_upload => $url_file_upload
        );
        $this->db->where('id', $worker_id);
        $this->db->update('ltno_workers', $data); 
        
        return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
    }
    
    function get_by_id($id){
        $sql = "select * from ltno_workers where id = '$id'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    function get_by_email($email){
        $sql = "select * from ltno_workers where id = '$email'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    
    function delete_attach($worker_id, $field_attach){
        $data = array(
            $field_attach => ''
        );
        $this->db->where('id', $worker_id);
        $this->db->update('ltno_workers', $data); 
        
        return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
    }
    
    function mail_exists_edit($key){
        $this->db->where('username',$key);
        $query = $this->db->get('ltno_users');
        if ($query->num_rows() > 0){
            return $query->row()->username;
        }
        else{
            return false;
        }
    }
    
    function mail_exists($key){
        $this->db->where('username',$key);
        $query = $this->db->get('ltno_users');
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }
    
 }