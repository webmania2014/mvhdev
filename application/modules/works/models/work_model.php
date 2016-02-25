<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Work_model extends CI_Model{
    function get_data_search_work($type_work, $text){
        if($type_work != 0){
            $sql = "select * from ltno_work_types where parent_id = '$type_work' and title like '%$text%'";
            $result = $this->db->query($sql);
            return $result->result();
        }
        return null;
    }
    function get_data_search_client($text){
        $sql = "select * from ltno_clients where client_name like '%$text%'";
        $result = $this->db->query($sql);
        return $result->result();
    }
    function get_data_client($text){
        $text = trim($text);
        $sql = "select * from ltno_clients where client_name = '$text'";
        $result = $this->db->query($sql);
        return $result->row();
    }
    function get_data_search_offer($project_id,$text,$client_id=''){
        if ($client_id == '') {
            $sql = "select * from ltno_offers where offer_number like '%$text%' and project_id = '$project_id'" ;
            $result = $this->db->query($sql);
            return $result->result();
        } else {
            $sql = "select * from ltno_offers where client_id='$client_id'" ;
            $result = $this->db->query($sql);
            return $result->result();
        }
    }
    function get_client_by_name($name){
        $sql = "select * from ltno_clients where client_name = '$name'";
        $result = $this->db->query($sql);
        return $result->row();
    }
    function get_work_by_id($work_id){
        $sql = "c.client_name, c.client_number, c.id as client_id,
                o.offer_number, o.id as offer_id, 
                wt.id as work_type_id, wt.title as work_type, wts.title as sub_title, wts.id as sub_work_id, 
                w.id, w.work_number, w.rental_number, w.supervisor_id, w.date_start,
                w.date_will_start, w.house_id , w.queue, w.status,w.project_id,p.project_number,w.room_id,w.parent_work_id,
                a.name, na.name as room_name";
        $this->db->select( $sql, false );
        $this->db->from( 'ltno_works' . ' AS w' );
        $this->db->join( 'ltno_clients' . ' AS c', 'w.client_id = c.id', 'left' );
        $this->db->join( 'ltno_offers' . ' AS o', 'w.offer_id = o.id', 'left' );
        $this->db->join( 'ltno_work_types' . ' AS wt', 'w.work_type_id = wt.id', 'left' );
        $this->db->join( 'ltno_work_types' . ' AS wts', 'w.sub_work_type_id = wts.id', 'left' );
        $this->db->join( 'ltno_house' . ' AS a', 'w.house_id = a.id', 'left' );
        $this->db->join( 'ltno_house' . ' AS na', 'w.room_id = na.id', 'left' );
        $this->db->join( 'ltno_projects' . ' AS p', 'w.project_id = p.id', 'left' );
        $this->db->where( 'w.id', $work_id );
        $work = $this->db->get();
        
        $sql2 = "select * from ltno_worker_of_work where work_id = '$work_id'";
        $workers = $this->db->query($sql2);

        $query = $this->db->query("SELECT offer_id FROM ltno_works WHERE id='$work_id'");
        $work_info = $query->row();
        $sql  = 'SELECT w.id AS id, wt.title AS work_type, ws.m2 AS m2, ws.price_m2 AS price_m2';
        $sql .= ' FROM ltno_works AS w';
        $sql .= ' LEFT JOIN ltno_offers AS o';
        $sql .= ' ON (w.offer_id=o.id)';
        $sql .= ' LEFT JOIN ltno_work_types AS wt';
        $sql .= ' ON (w.work_type_id=wt.id)';
        $sql .= ' LEFT JOIN ltno_work_scaffolds AS ws';
        $sql .= ' ON (ws.offer_id=o.id)';
        $sql .= ' WHERE o.id=\'' . $work_info->offer_id . '\'';
        $query = $this->db->query($sql);
        $works_in_offer = array();
        foreach ($query->result() as $work_info) {
            $works_in_offer[] = array(
                'id' => $work_info->id,
                'work_type' => $work_info->work_type,
                'm2' => $work_info->m2,
                'price_m2' => $work_info->price_m2
            );
        }

        $result = array(
            'work' => $work->result(),
            'workers' => $workers->result(),
            'works_in_offer' => $works_in_offer
        );
        return $result;
    }
    
    function create_work($client_id, $offer_id, $work_type_id, $sub_work_type_id, $work_number, $scaffold_number, $rental_number, $house_id, $room_id, $supervisor_id, $status,$date_start, $offer_parent_work_id=''){
        $data = array(
            'client_id'         => $client_id,
            'offer_id'          => $offer_id,
            'work_type_id'      => $work_type_id,
            'sub_work_type_id'  => $sub_work_type_id,
            'work_number'       => $work_number,
            'rental_number'     => $rental_number,
            'scaffold_number'   => $scaffold_number,
            'house_id'          => $house_id,
            'room_id'           => $room_id,
            'supervisor_id'     => $supervisor_id,
            'status'            => $status,
            'date_start'        => $date_start,
            'parent_work_id'    => $offer_parent_work_id
        );
        $this->db->insert( 'ltno_works' , $data );
        return $this->db->insert_id();
    }
    
    function create_contract_work($client_id, $offer_id, $work_offer_id, $work_type_id, $sub_work_type_id, $work_number, $scaffold_number, $rental_number, $house_id, $room_id, $supervisor_id, $status,$date_start){
        $data = array(
            'client_id'         => $client_id,
            'offer_id'          => $offer_id,
            'work_offer_id'     => $work_offer_id,
            'work_type_id'      => $work_type_id,
            'sub_work_type_id'  => $sub_work_type_id,
            'work_number'       => $work_number,
            'rental_number'     => $rental_number,
            'scaffold_number'   => $scaffold_number,
            'house_id'          => $house_id,
            'room_id'           => $room_id,
            'supervisor_id'     => $supervisor_id,
            'status'            => $status,
            'date_start'        => $date_start
        );
        $this->db->insert( 'ltno_works' , $data );
        return $this->db->insert_id();
    }
    
    function edit_end_work($work_id, $client_id, $offer_id, $work_type_id, $sub_work_type_id, $work_number, $rental_number, $house_id, $room_id, $supervisor_id, $status, $end_date, $cal){
        $data = array(
            'client_id'         => $client_id,
            'offer_id'          => $offer_id,
            'work_type_id'      => $work_type_id,
            'sub_work_type_id'  => $sub_work_type_id,
            'work_number'       => $work_number,
            'rental_number'     => $rental_number,
            'house_id'          => $house_id,
            'room_id'           => $room_id,
            'supervisor_id'     => $supervisor_id,
            'end_date'          => $end_date,
            'calculation_method'=> $cal,
            'status'            => $status
        );
        $this->db->where('id', $work_id);
        $this->db->update( 'ltno_works' , $data );
    }
    
    function edit_work($work_id, $client_id, $offer_id, $work_type_id, $sub_work_type_id, $work_number, $scaffold_number, $rental_number, $house_id, $room_id, $supervisor_id, $status, $parent_work_id){
        $data = array(
            'client_id'         => $client_id,
            'offer_id'          => $offer_id,
            'work_type_id'      => $work_type_id,
            'sub_work_type_id'  => $sub_work_type_id,
            'work_number'       => $work_number,
            'rental_number'     => $rental_number,
            'scaffold_number'   => $scaffold_number,
            'house_id'          => $house_id,
            'room_id'           => $room_id,
            'supervisor_id'     => $supervisor_id,
            'status'            => $status,
            'parent_work_id'    => $parent_work_id
        );
        $this->db->where('id', $work_id);
        $this->db->update( 'ltno_works' , $data );
    }
    function edit_contract_work($work_id, $client_id, $offer_id, $work_offer_id, $work_type_id, $sub_work_type_id, $work_number, $scaffold_number, $rental_number, $house_id, $room_id, $supervisor_id, $status){
        $data = array(
            'client_id'         => $client_id,
            'offer_id'          => $offer_id,
            'work_offer_id'     => $work_offer_id,
            'work_type_id'      => $work_type_id,
            'sub_work_type_id'  => $sub_work_type_id,
            'work_number'       => $work_number,
            'rental_number'     => $rental_number,
            'scaffold_number'   => $scaffold_number,
            'house_id'          => $house_id,
            'room_id'           => $room_id,
            'supervisor_id'     => $supervisor_id,
            'status'            => $status
        );
        $this->db->where('id', $work_id);
        $this->db->update( 'ltno_works' , $data );
    }
    
    function delete_all_size_of_work($work_id){
        $this->db->where('work_id', $work_id);
        $this->db->delete('ltno_size_for_work'); 
    }
    function delete_all_worker_of_work($work_id){
        $this->db->where('work_id', $work_id);
        $this->db->delete('ltno_worker_of_work'); 
    }
    function delete_all_material_of_work($work_id){
        $this->db->where('work_id', $work_id);
        $this->db->delete('ltno_material_for_work'); 
    }
    
    function add_worker_for_work($worker_id, $work_id){
        $data = array(
            'worker_id' => $worker_id,
            'work_id'   => $work_id,
        );
        $this->db->insert( 'ltno_worker_of_work' , $data );
    }
    function add_size_for_work($lenght, $width, $height, $work_id){
        $data = array(
            'work_id'   => $work_id,
            'lenght'   => $lenght,
            'width'   => $width,
            'height'   => $height,
        );
        $this->db->insert( 'ltno_size_for_work' , $data );
    }
    
    function add_material_for_work($material, $m2, $work_id){
        $data = array(
            'work_id'   => $work_id,
            'material_id'   => $lenght,
            'm2'   => $m2
        );
        $this->db->insert( 'ltno_material_for_work' , $data );
    }
    
    function get_all_workers_queue(){
        $sql = "c.client_name, c.client_number, c.id as client_id,
                o.offer_number, o.id as offer_id, 
                wt.id as work_type_id, wt.title as work_type, wts.title as sub_title, wts.id as sub_work_id, 
                w.id, w.work_number, w.rental_number, w.supervisor_id, w.date_start,
                w.date_will_start, w.house_id , w.queue, w.status, w.project_id,w.room_id,
                a.name, na.name as room_name";
        $this->db->select( $sql, false );
        $this->db->from( 'ltno_works' . ' AS w' );
        $this->db->join( 'ltno_clients' . ' AS c', 'w.client_id = c.id', 'left' );
        $this->db->join( 'ltno_offers' . ' AS o', 'w.offer_id = o.id', 'left' );
        $this->db->join( 'ltno_work_types' . ' AS wt', 'w.work_type_id = wt.id', 'left' );
        $this->db->join( 'ltno_work_types' . ' AS wts', 'w.sub_work_type_id = wts.id', 'left' );
        $this->db->join( 'ltno_house' . ' AS a', 'w.house_id = a.id', 'left' );
        $this->db->join( 'ltno_house' . ' AS na', 'w.room_id = na.id', 'left' );
        $this->db->where( 'w.status', 2 );
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_workers_on_going(){
        $sql = "c.client_name, c.client_number, c.id as client_id,
                o.offer_number, o.id as offer_id, 
                wt.id as work_type_id, wt.title as work_type, wts.title as sub_title, wts.id as sub_work_id, 
                w.id, w.work_number, w.rental_number, w.supervisor_id, w.date_start,
                w.date_will_start, w.house_id , w.queue, w.status,w.project_id,w.room_id,
                a.name, na.name as room_name";
        $this->db->select( $sql, false );
        $this->db->from( 'ltno_works' . ' AS w' );
        $this->db->join( 'ltno_clients' . ' AS c', 'w.client_id = c.id', 'left' );
        $this->db->join( 'ltno_offers' . ' AS o', 'w.offer_id = o.id', 'left' );
        $this->db->join( 'ltno_work_types' . ' AS wt', 'w.work_type_id = wt.id', 'left' );
        $this->db->join( 'ltno_work_types' . ' AS wts', 'w.sub_work_type_id = wts.id', 'left' );
        $this->db->join( 'ltno_house' . ' AS a', 'w.house_id = a.id', 'left' );
        $this->db->join( 'ltno_house' . ' AS na', 'w.room_id = na.id', 'left' );
        $this->db->where( 'w.status', 1 );
        $query = $this->db->get();
        
        return $query->result();
    }
    function get_all_workers_done(){
        $sql = "c.client_name, c.client_number, c.id as client_id,
                o.offer_number, o.id as offer_id, 
                wt.id as work_type_id, wt.title as work_type, wts.title as sub_title, wts.id as sub_work_id, 
                w.id, w.work_number, w.rental_number, w.supervisor_id, w.date_start,
                w.date_will_start, w.house_id , w.queue, w.status,w.project_id,w.room_id,
                a.name, na.name as room_name";
        $this->db->select( $sql, false );
        $this->db->from( 'ltno_works' . ' AS w' );
        $this->db->join( 'ltno_clients' . ' AS c', 'w.client_id = c.id', 'left' );
        $this->db->join( 'ltno_offers' . ' AS o', 'w.offer_id = o.id', 'left' );
        $this->db->join( 'ltno_work_types' . ' AS wt', 'w.work_type_id = wt.id', 'left' );
        $this->db->join( 'ltno_work_types' . ' AS wts', 'w.sub_work_type_id = wts.id', 'left' );
        $this->db->join( 'ltno_house' . ' AS a', 'w.house_id = a.id', 'left' );
        $this->db->join( 'ltno_house' . ' AS na', 'w.room_id = na.id', 'left' );
        $this->db->where( 'w.status', 3 );
        $query = $this->db->get();
        return $query->result();
    }
    
    function get_sub_area($area_id, $area_text){
        if($area_id != 0){
            $sql = "select * from ltno_areas where parent_id = '$area_id' and area like '%$area_text%'";
            $result = $this->db->query($sql);
            return $result->result();
        }
    }
    function update_date_will_start($work_id, $date_will_start){
        $data = array(
            'date_will_start' => $date_will_start
        );
        $this->db->where('id', $work_id);
        $this->db->update('ltno_works', $data);
    }
    function get_offer_id_by_number($offer_number){
        $sql = "select id from ltno_offers where offer_number = '$offer_number'";
        $result = $this->db->query($sql);
        return $result->row();
    }
    
    function get_project_by_client_id($client_id, $project){
        $sql = "select * from ltno_projects where client_id = '$client_id' and project_number like '%$project%' ";
        $result = $this->db->query($sql);
        return $result->result();
    }
    
    function get_works_for_contract($offer_id){
        $sql = "c.client_name, c.client_number, c.id as client_id,
                o.offer_number, o.id as offer_id, 
                wt.id as work_type_id, wt.title as work_type, wts.title as sub_title, wts.id as sub_work_id, 
                w.id, w.work_number, w.rental_number, w.supervisor_id, w.date_start,
                w.date_will_start, w.house_id , w.queue, w.status,w.project_id,w.room_id,
                a.name, na.name as room_name";
        $this->db->select( $sql, false );
        $this->db->from( 'ltno_works' . ' AS w' );
        $this->db->join( 'ltno_clients' . ' AS c', 'w.client_id = c.id', 'left' );
        $this->db->join( 'ltno_offers' . ' AS o', 'w.offer_id = o.id', 'left' );
        $this->db->join( 'ltno_work_types' . ' AS wt', 'w.work_type_id = wt.id', 'left' );
        $this->db->join( 'ltno_work_types' . ' AS wts', 'w.sub_work_type_id = wts.id', 'left' );
        $this->db->join( 'ltno_house' . ' AS a', 'w.house_id = a.id', 'left' );
        $this->db->join( 'ltno_house' . ' AS na', 'w.room_id = na.id', 'left' );
        $this->db->where( 'w.status', 1 );
        $this->db->or_where( 'w.status', 2 );
        $this->db->where( 'w.offer_id', $offer_id );
        $query = $this->db->get();
        return $query->result();
     }
     
     function get_worker_for_work($work_id){
        $sql = "select * from ltno_worker_of_work where work_id = '$work_id'";
        $result = $this->db->query($sql);
        return $result->result();
     }
     
     function get_size_for_work($work_id){
        $sql = "select * from ltno_size_for_work where work_id = '$work_id'";
        $result = $this->db->query($sql);
        return $result->result();
     }
     
     function get_material_for_work($work_id){
        $sql = "select * from ltno_material_for_work where work_id = '$work_id'";
        $result = $this->db->query($sql);
        return $result->result();
     }

     function get_works_by_offer($offer_id) {
        $sql  = 'SELECT w.id AS id, wt.title AS work_type, ws.m2 AS m2, ws.price_m2 AS price_m2';
        $sql .= ' FROM ltno_works AS w';
        $sql .= ' LEFT JOIN ltno_offers AS o';
        $sql .= ' ON (w.offer_id=o.id)';
        $sql .= ' LEFT JOIN ltno_work_types AS wt';
        $sql .= ' ON (w.work_type_id=wt.id)';
        $sql .= ' LEFT JOIN ltno_work_scaffolds AS ws';
        $sql .= ' ON (ws.offer_id=o.id)';
        $sql .= ' WHERE o.id=\'' . $offer_id . '\'';
        $query = $this->db->query($sql);
        $ret_array = array();
        foreach ($query->result() as $work_info) {
            $ret_array[] = array(
                'id' => $work_info->id,
                'work_type' => $work_info->work_type,
                'm2' => $work_info->m2,
                'price_m2' => $work_info->price_m2
            );
        }
        return $ret_array;
     }
}