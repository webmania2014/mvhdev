<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
    class Sub_contractor_model extends CI_Model{
	public $table ='clients';
	
	
	function create($name,$reg_code,$address,$contact,$phone_number,$email,$email_report){
		$data = array(
			'name'          => $name,
            'reg_code'       => $reg_code,
			'address'        => $address,
			'responsible_person'        => $contact,
			'phone'  => $phone_number,
            'email'          => $email,
            'email_report'   => $email_report
		);
		$this->db->insert('ltno_sub_contractors',$data);
        
		return $this->db->insert_id();
	}
    function get_alls(){
        $sql = 'select * from ltno_sub_contractors';
        $result = $this->db->query($sql);
        return $result->result();
    }
    function get_by_id($id){
        $sql = "select * from ltno_sub_contractors where id = '".$id."'";
        $client = $this->db->query($sql);
        return $client->row();
    }
    function edit($sub_contractor_id,$name,$reg_code,$address,$contact,$phone_number,$email,$email_report){
		$data = array(
			'name'          => $name,
            'reg_code'       => $reg_code,
			'address'        => $address,
			'responsible_person'        => $contact,
			'phone'  => $phone_number,
            'email'          => $email,
            'email_report'   => $email_report
		);
     
        $this->db->where('id', $sub_contractor_id);
		$this->db->update('ltno_sub_contractors',$data);
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}
    function delete( $sub_contractor_id ) {
        
		// Prepare
		$this->db->where( 'id',$sub_contractor_id );
	
		$this->db->delete(  'ltno_sub_contractors'  );

		// Check address deleted successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}
    function update_url_file_att_picture($sub_contractor_id, $field_upload, $url_file_upload){
        $data = array(
            $field_upload => $url_file_upload
        );
        $this->db->where('id', $sub_contractor_id);
        $this->db->update('ltno_sub_contractors', $data); 
        
        return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
    }
    
    function delete_attach($sub_contractor_id, $field_attach){
        $data = array(
            $field_attach => ''
        );
        $this->db->where('id', $sub_contractor_id);
        $this->db->update('ltno_sub_contractors', $data); 
        
        return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
    }
   
    
}