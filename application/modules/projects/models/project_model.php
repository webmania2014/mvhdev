<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
    class project_model extends CI_Model{
	
	function create($project_number,$client_id,$order_number,$seller_id,$responsible_sv){
		$data = array(
            'project_number'    => $project_number,
			'client_id'         => $client_id,
			'order_number'      => $order_number,
            'responsible_sv'    => $responsible_sv,
			'seller'            => $seller_id
		);
		$this->db->insert('ltno_projects',$data);
        
		return $this->db->insert_id();
	}
    
    function get_client_by_id($client_id){
        $sql = "select * from ltno_projects where id = '".$client_id."'";
        $result = $this->db->query($sql);
        return $result->row();
    }
    
    function get_all_projects(){
        $sql = 'select o.id, o.project_number, o.client_id, c.contact_person,
                o.order_number, o.seller, o.responsible_sv, 
                c.client_name, c.client_number, c.invoice_address, c.site, c.phone_number, c.email 
                from ltno_projects as o 
                join ltno_clients as c on o.client_id = c.id';
        $result = $this->db->query($sql);
        return $result->result();
    }
    function get_by_id($id){
        $sql = "select o.id, o.project_number, o.client_id, c.contact_person,
                o.order_number, o.seller, o.responsible_sv,
                c.client_name, c.client_number, c.invoice_address, c.site, c.phone_number, c.email 
                from ltno_projects as o 
                join ltno_clients as c on o.client_id = c.id where o.id = '".$id."'";
        $result = $this->db->query($sql);
        return $result->row();
    }
    function edit($project_id,$project_number,$client_id,$order_number,$seller_id,$responsible_sv){
		$data = array(
            'project_number'    => $project_number,
			'client_id'         => $client_id,
			'order_number'      => $order_number,
            'responsible_sv'    => $responsible_sv,
			'seller'            => $seller_id
		);
        $this->db->where('id', $project_id);
		$this->db->update('ltno_projects',$data);
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}
    function delete( $offer_id ) {
		// Prepare
		$this->db->where( 'id',$offer_id );
	
		$this->db->delete(  'ltno_projects'  );

		// Check address deleted successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}
    
   
    
}