<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
    class Clients_model extends CI_Model{
	public $table ='clients';
	
	
	function create($client_name,$invoice_address,$client_number,$site,$phone_number,$email,$contact_person){
		$data = array(
			'client_name'       => $client_name,
			'invoice_address'    => $invoice_address,
			'client_number'     => $client_number,
			'site'              => $site,
			'phone_number'      => $phone_number,
            'contact_person'      => $contact_person,
            'email'             => $email
		);
		$this->db->insert('ltno_clients',$data);
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}
    function get_all_clients(){
        $sql = 'select * from ltno_clients ';
        $result = $this->db->query($sql);
        return $result->result();
    }
    function get_by_id($id){
        $sql = "select * from ltno_clients where id = '".$id."'";
        $client = $this->db->query($sql);
        return $client->row();
    }
    function edit($client_id,$client_name,$invoice_adress,$client_number,$site,$phone_number,$email,$contact_person){
		$data = array(
			'client_name'       => $client_name,
			'invoice_address'   => $invoice_adress,
			'client_number'     => $client_number,
			'site'              => $site,
			'phone_number'      => $phone_number,
            'contact_person'      => $contact_person,
            'email'             => $email
		);
     
        $this->db->where('id', $client_id);
		$this->db->update('ltno_clients',$data);
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}
    function delete( $client_id ) {
        
		// Prepare
		$this->db->where( 'id',$client_id );
	
		$this->db->delete(  'ltno_clients'  );

		// Check address deleted successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}
    
   
    
}