<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Followup_model extends CI_Model{

  function get_data_all_client(){
    $sql = "select * from ltno_clients";
    $result = $this->db->query($sql);
    return $result->result();
  }

  function get_data_all_project(){
    $sql = "select * from ltno_projects";
    $result = $this->db->query($sql);
    return $result->result();
  }
  function get_data_all_scaffold_id(){
    $sql = "select id from ltno_scaffolds";
    $result = $this->db->query($sql);
    return $result->result();
  }
  function get_data_all_scaffold_type(){
    $sql = "select name from ltno_scaffold_types";
    $result = $this->db->query($sql);
    return $result->result();
  }
  function get_data_all_house(){
    $sql = "select DISTINCT house_id from ltno_offers";
    $result = $this->db->query($sql);
    return $result->result();
  }
  function get_data_all_room(){
    $sql = "select DISTINCT room_id from ltno_offers";
    $result = $this->db->query($sql);
    return $result->result();
  }

  function search_followup($client_id){
    // o.starting_date as starting_date,
    $sql = "o.id as id,
            
            o.house_id as  house,
            o.room_id as room,
            o.client_id as client_id,
            o.project_id as project_id,
            s.transport_cost as scaffold_transport_cost, 
            s.id as scaffold_work_id, 
            s.type_scaffold_id as type_scaffold_id,
            t.transport_cost as tent_transport_cost,
            t.id as tent_work_id,
            si.size as size,
            si.start_date as start_date,
            si.end_date as end_date
            ";
    $this->db->select( $sql, false );
    $this->db->from( 'ltno_offers' . ' AS o' );
    $this->db->join( 'ltno_work_scaffolds' . ' AS s', 'o.work_scaffold_id = s.id', 'left' );
    $this->db->join( 'ltno_work_tents' . ' AS t', 'o.work_tent_id = t.id', 'left' );
    $this->db->join( 'ltno_scaffolds' . ' AS si', 'o.id = t.offer_id', 'left' );

    // $this->db->join( 'ltno_works' . ' AS w', 'o.id = w.offer_id', 'right' );
    $this->db->where( 'o.client_id', $client_id );
    $offers = $this->db->get();

    $sql2 = "select * from ltno_offers where client_id = '$client_id'";
    $sql2 = "SELECT * FROM ltno_works WHERE offer_id IN (SELECT id FROM ltno_offers WHERE client_id= '$client_id')";
    $works = $this->db->query($sql2);

    $sql3 = "select name from ltno_scaffold_types";
    $all_scaffold_type = $this->db->query($sql3);
    // return $cost->result();
    $result = array(
        'offers' => $offers->result(),
        'works' => $works->result(),
        'all_scaffold_type' => $all_scaffold_type->result()
    );
    return $result;
  }

    




}