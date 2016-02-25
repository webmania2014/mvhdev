<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
    class Offer_model extends CI_Model{
	
	function check_offer_number($offer_number){
        $sql = "select * from ltno_offers where offer_number = '".$offer_number."'";
        $result = $this->db->query($sql);
        if(count($result->result()) > 0){
            return true;
        }
        return false;
	}
    
	function create($offer_number,$starting_date,$house,$room,$client_id,$project_id,$cost_center,$order_number,$probability,$client_number,$contact_person_id,$contact_email,$seller_id,$responsible_sv_id,$foreman_id,$day,$status){
		$data = array(
            'offer_number'      => $offer_number,
			'starting_date'     => $starting_date,
            'house_id'          => $house,
            'room_id'           => $room,
            'client_id'         => $client_id,
			'project_id'        => $project_id,
            'cost_center'       => $cost_center,
            'order_number'      => $order_number,
            'probability'       => $probability,
            'client_number'     => $client_number,
            'contact_person_id' => $contact_person_id,
            'contact_email'     => $contact_email,
            'seller_id'         => $seller_id,
            'responsible_sv_id' => $responsible_sv_id,
            'foreman_id'        => $foreman_id,
            'day'               => $day,
            'status'            => $status
		);
		$this->db->insert('ltno_offers',$data);
        
		return $this->db->insert_id();
	}
    
    function get_client_by_id($client_id){
        $sql = "select * from ltno_clients where id = '".$client_id."'";
        $result = $this->db->query($sql);
        return $result->row();
    }
    
    function get_all_offers(){
        $sql = 'select o.id, o.offer_number, o.client_id, c.contact_person,
                o.order_number, o.seller_id, o.responsible_sv_id, o.status, w.email as contact_email, 
                c.client_name, c.client_number, c.invoice_address, c.site, c.phone_number, c.email 
                from ltno_offers as o 
                left join ltno_clients as c on o.client_id = c.id
                left join ltno_workers as w on o.responsible_sv_id = w.id';
                
        $result = $this->db->query($sql);
        return $result->result();
    }
    function get_by_id($id){
        $sql = "select o.id, o.offer_number, o.contact_person_id, DATE_FORMAT(o.starting_date, '%m/%d/%Y') as starting_date, o.house_id, o.room_id, o.client_id, o.day, o.status, o.service_scaffold, o.service_weather, o.service_transport, o.service_managment, 
                o.project_id, o.cost_center,o.order_number, o.probability,o.contact_email,
                o.foreman_id, o.seller_id, o.responsible_sv_id,
                c.client_name, c.client_number, c.invoice_address, c.site, c.phone_number, c.email 
                from ltno_offers as o 
                join ltno_clients as c on o.client_id = c.id where o.id = '".$id."'";
        $result = $this->db->query($sql);
        return $result->row();
    }
    function get_all_info_by_offer_id($offer_id){
        $sql = "select * from ltno_informations where offer_id ='$offer_id'";
        $result = $this->db->query($sql);
        return $result->result();
    }
    function edit($offer_id,$starting_date,$house,$room,$client_id,$project_id,$cost_center,$order_number,$probability,$client_number,$contact_person_id,$contact_email,$seller_id,$responsible_sv_id,$foreman_id,$day,$status){
		$data = array(
			'starting_date'     => $starting_date,
            'house_id'          => $house,
            'room_id'           => $room,
            'client_id'         => $client_id,
			'project_id'        => $project_id,
            'cost_center'       => $cost_center,
            'order_number'      => $order_number,
            'probability'       => $probability,
            'client_number'     => $client_number,
            'contact_person_id' => $contact_person_id,
            'contact_email'     => $contact_email,
            'seller_id'         => $seller_id,
            'responsible_sv_id' => $responsible_sv_id,
            'foreman_id'        => $foreman_id,
            'day'               => $day,
            'status'            => $status
		);
     
        $this->db->where('id', $offer_id);
		$this->db->update('ltno_offers',$data);
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}
    function add_info($offer_id, $info){
        $data = array(
            'offer_id' => $offer_id,
            'info'     => $info
        );
        $this->db->insert('ltno_informations',$data);
        return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
    }
    function delete_info( $offer_id ) {
		// Prepare
		$this->db->where( 'offer_id',$offer_id );
	
		$this->db->delete(  'ltno_informations'  );

		// Check address deleted successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}
    function delete_rental_fee($offer_id){
        // Prepare
		$this->db->where( 'offer_id',$offer_id );
	
		$this->db->delete(  'ltno_rental_fees'  );

		// Check address deleted successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
    }
    function add_rental_fee($offer_id,$type, $fee_unit_day, $fee_min_day){
        $fee_unit_day = $this->check_null($fee_unit_day);
        $fee_min_day = $this->check_null($fee_min_day);
        $data = array(
            'offer_id'          =>  $offer_id,
            'type_rental_id'    =>  $type,
            'fee_unit_day'      =>  $fee_unit_day,
            'fee_min_day'       =>  $fee_min_day
        );
        $this->db->insert('ltno_rental_fees', $data);
        return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
    }
    function get_all_rental_fee($offer_id){
        $sql = "select * from ltno_rental_fees where offer_id = '$offer_id'";
        $result = $this->db->query($sql);
        return $result->result();
    }
    function delete( $offer_id ) {
		// Prepare
		$this->db->where( 'id',$offer_id );
	
		$this->db->delete(  'ltno_offers'  );

		// Check address deleted successfully or not
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}
    
   function get_price_by_type($type_id, $season){
        $sql = "select * from ltno_price_for_scaffold_types where scaffold_type_id = '".$type_id."' and season = '".$season."' ";
        $result = $this->db->query($sql);
        return $result->row();
   }
   function check_null($number){
        if($number != null || $number != ''){
            return $number;
        }else{
            return 0;
        }
   }
   function create_rental_scaffold($offer_id,$rental_scaffold_type,$rental_scaffold_cover,$rental_scaffold_m2,$day_work, $length, $width, $high, $dimension, $note,$step_offer){
        $rental_scaffold_cover = $this->check_null($rental_scaffold_cover);
        $rental_scaffold_m2 = $this->check_null($rental_scaffold_m2);
        $day_work = $this->check_null($day_work);
        $length = $this->check_null($length);
        $width = $this->check_null($width);
        $high = $this->check_null($high);
        $data = array(
            'type_scaffold_id' => $rental_scaffold_type,
            'offer_id'         => $offer_id,
            'cover'            => $rental_scaffold_cover,
            'm2'               => $rental_scaffold_m2,
            'day'              => $day_work,
            'length'           => $length,
            'width'            => $width,
            'high'             => $high,
            'dimension'        => $dimension,
            'note'             => $note,
            'step'             => $step_offer
        );
        $this->db->insert('ltno_rental_scaffolds',$data);
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
   }
   
   function create_rental_tent($offer_id,$rental_tent_type,$rental_tent_cover,$rental_tent_m2){
        $data = array(
            'type_scaffold_id' => $rental_tent_type,
            'offer_id'         => $offer_id,
            'cover'            => $rental_tent_cover,
            'm2'               => $rental_tent_m2,
        );
        $this->db->insert('ltno_rental_tents',$data);
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
   }
   
   function create_work_scaffold($offer_id,$work_scaffold_m2,$work_scaffold_cover,$rental_scaffold_m2,$kust_transport,$cover_transport,$kust_kraana,$cover_kraana,$kust_material,$cover_material, $note_material, $other_cost, $other_cover, $other_note,$type_scaffold, $step_offer_work){
        $work_scaffold_m2 = $this->check_null($work_scaffold_m2);
        $work_scaffold_cover = $this->check_null($work_scaffold_cover);
        $rental_scaffold_m2 = $this->check_null($rental_scaffold_m2);
        $kust_transport = $this->check_null($kust_transport);
        $cover_transport = $this->check_null($cover_transport);
        $kust_kraana = $this->check_null($kust_kraana);
        $cover_kraana = $this->check_null($cover_kraana);
        $kust_material = $this->check_null($kust_material);
        $cover_material = $this->check_null($cover_material);
        $other_cost = $this->check_null($other_cost);
        $other_cover = $this->check_null($other_cover);
        $data = array(
            'price_m2'         => $work_scaffold_m2,
            'offer_id'         => $offer_id,
            'cover'            => $work_scaffold_cover,
            'm2'               => $rental_scaffold_m2,
            'transport_cost'   => $kust_transport,
            'transport_profit' => $cover_transport,
            'kraana_cost'      => $kust_kraana,
            'kraana_profit'    => $cover_kraana,
            'material_cost'    => $kust_material,
            'material_profit'  => $cover_material,
            'note_material'    => $note_material,
            'other_cost'       => $other_cost,
            'other_profit'     => $other_cover,
            'note_other'       => $other_note,
            'type_scaffold_id' => $type_scaffold,
            'step'             => $step_offer_work
        );
        $this->db->insert('ltno_work_scaffolds',$data);
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
   }
   
   function create_work_tent($offer_id,$work_tent_m2,$work_tent_cover,$m2){
        $data = array(
            'price_m2'         => $work_tent_m2,
            'offer_id'         => $offer_id,
            'cover'            => $work_tent_cover,
            'm2'               => $m2
        );
        $this->db->insert('ltno_work_tents',$data);
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
   }
   
   function delete_all_rental_scaffold($offer_id){
        $this->db->where('offer_id', $offer_id);
        $this->db->delete('ltno_rental_scaffolds'); 
    }
    
    function delete_all_close_cost_offer($offer_id){
        $this->db->where('offer_id', $offer_id);
        $this->db->delete('ltno_close_costs'); 
    }
    
 
    function delete_all_work_scaffold($offer_id){
        $this->db->where('offer_id', $offer_id);
        $this->db->delete('ltno_work_scaffolds'); 
    }
    
   function get_rental_for_scaffolds($offer_id,$flag, $season){
   if($flag){
        $sql = "select rs.type_scaffold_id, rs.offer_id, rs.cover, rs.m2, rs.id, rs.day, rs.length, rs.width,rs.high,rs.note,rs.dimension, rs.step,
                pr.price_m2_over_3_month as price_generate, round(pr.price_m2_over_3_month*rs.day*rs.m2,2) as total1, 
                round(pr.price_m2_over_3_month/((100-rs.cover)/100),2) as price_m2,
                round(rs.m2*pr.price_m2_over_3_month/((100-rs.cover)/100)*rs.day,2) as total2,
                round(rs.m2*pr.price_m2_over_3_month/((100-rs.cover)/100),2) as per_day,
                round(rs.m2*pr.price_m2_over_3_month/((100-rs.cover)/100)*30,2) per_month,
                if(rs.width = 0, rs.length*rs.high, rs.length*rs.high*rs.width) as m2_or_m3 
                from ltno_rental_scaffolds as rs
                left join ltno_price_for_scaffold_types as pr on rs.type_scaffold_id = pr.scaffold_type_id 
                where rs.offer_id = '$offer_id' and pr.season = '$season' 
        ";
    }else{
        $sql = "select rs.type_scaffold_id, rs. offer_id, rs.cover, rs.m2, rs.id, rs.day,rs.length, rs.width,rs.high,rs.note,rs.dimension, rs.step,
                pr.price_m2_fewer_3_month as price_generate, round(pr.price_m2_fewer_3_month*rs.day*rs.m2,2) as total1, 
                round(pr.price_m2_fewer_3_month/((100-rs.cover)/100),2) as price_m2,
                round(rs.m2*pr.price_m2_fewer_3_month/((100-rs.cover)/100)*rs.day,2) as total2,
                round(rs.m2*pr.price_m2_fewer_3_month/((100-rs.cover)/100),2) as per_day,
                round(rs.m2*pr.price_m2_fewer_3_month/((100-rs.cover)/100)*30,2) per_month,
                if(rs.width = 0, rs.length*rs.high, rs.length*rs.high*rs.width) as m2_or_m3 
                from ltno_rental_scaffolds as rs
                left join ltno_price_for_scaffold_types as pr on rs.type_scaffold_id = pr.scaffold_type_id 
                where rs.offer_id = '$offer_id' and pr.season = '$season' 
        ";
    }
    $result = $this->db->query($sql);
    return $result->result();
        
   } 
   function delete_all_material($offer_id){
        $this->db->where('offer_id', $offer_id);
        $this->db->delete('ltno_material_prices');
   }
   function get_material_by_offer_id($offer_id){
        $sql = "select id, name_material, price_per_unit, amount, unit, amount*unit as total from ltno_material_prices where offer_id = '$offer_id'";
        $result = $this->db->query($sql);
        return $result->result();
   }
   function add_material_price($offer_id, $name, $amount, $unit, $price_per_unit){
        $data = array(
            'offer_id' => $offer_id,
            'name_material' => $name,
            'amount' =>$amount,
            'unit'  => $unit,
            'price_per_unit' => $price_per_unit
        );
        $this->db->insert('ltno_material_prices',$data);
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
   }
   function get_rental_for_tents($offer_id, $flag, $day, $season, $type){
    if($flag){
        $sql = "select rs.type_scaffold_id, rs.offer_id, rs.cover, rs.m2, rs.id,
                pr.price_m2_over_3_month as price_generate, round(pr.price_m2_over_3_month*$day*rs.m2,2) as total1, 
                round(pr.price_m2_over_3_month/((100-rs.cover)/100),2) as price_m2,
                round(rs.m2*pr.price_m2_over_3_month/((100-rs.cover)/100)*$day,2) as total2,
                round(rs.m2*pr.price_m2_over_3_month/((100-rs.cover)/100),2) as per_day,
                round(rs.m2*pr.price_m2_over_3_month/((100-rs.cover)/100)*30,2) per_month 
                from ltno_rental_scaffolds as rs
                left join ltno_price_for_scaffold_types as pr on rs.type_scaffold_id = pr.scaffold_type_id 
                where rs.offer_id = '$offer_id' and pr.season = '$season' 
        ";
    }else{
        $sql = "select rs.type_scaffold_id, rs. offer_id, rs.cover, rs.m2, rs.id,
                pr.price_m2_fewer_3_month as price_generate, round(pr.price_m2_fewer_3_month*$day*rs.m2,2) as total1, 
                round(pr.price_m2_fewer_3_month/((100-rs.cover)/100),2) as price_m2,
                round(rs.m2*pr.price_m2_fewer_3_month/((100-rs.cover)/100)*$day,2) as total2,
                round(rs.m2*pr.price_m2_fewer_3_month/((100-rs.cover)/100),2) as per_day,
                round(rs.m2*pr.price_m2_fewer_3_month/((100-rs.cover)/100)*30,2) per_month 
                from ltno_rental_scaffolds as rs
                left join ltno_price_for_scaffold_types as pr on rs.type_scaffold_id = pr.scaffold_type_id 
                where rs.offer_id = '$offer_id' and pr.season = '$season' 
        ";
    }
    $result = $this->db->query($sql);
    return $result->result();   
   } 
   function get_work_scaffolds($offer_id){
        $sql = "select id, offer_id, cover, price_m2,transport_cost, transport_profit,
                kraana_cost,kraana_profit, material_cost, material_profit, m2, note_material, other_cost, other_profit, note_other, type_scaffold_id, step,
                m2*price_m2 as total1, round(price_m2/((100-cover)/100),2) as price_m2_cal,
                round(m2*price_m2/((100-cover)/100),2) as total2, 
                round(kraana_cost/((100-kraana_profit)/100),2) as kraana_offer,
                round(transport_cost/((100-transport_profit)/100),2) as transport_offer,
                round(material_cost/((100-material_profit)/100),2) as material_offer,
                round(other_cost/((100-other_profit)/100),2) as other_offer 
                from ltno_work_scaffolds where offer_id = '$offer_id'
        ";
        $result = $this->db->query($sql);
        return $result->result(); 
   }
   
   function get_work_tents($offer_id){
    
        $sql = "select id, offer_id, cover, price_m2,transport_cost, transport_profit,
                kraana_cost,kraana_profit, material_cost, material_profit, m2,
                m2*price_m2 as total1, round(price_m2/((100-cover)/100),2) as price_m2_cal,
                round(m2*price_m2/((100-cover)/100),2) as total2, 
                round(kraana_cost/((100-kraana_profit)/100),2) as kraana_offer,
                round(transport_cost/((100-transport_profit)/100),2) as transport_offer,
                round(material_cost/((100-material_profit)/100),2) as material_offer 
                from ltno_work_scaffolds where offer_id = '$offer_id' 
        ";
        $result = $this->db->query($sql);
        return $result->result(); 
   }
   function get_all_room($parent_id){
        $sql = "select * from ltno_house where parent_id = '$parent_id'";
        $rooms = $this->db->query($sql);
        return $rooms->result();
   }
   
   function get_close_cost_by_offer_id($offer_id){
        $sql = "select id, offer_id, name, kind_id, quantity, unit, price_per_unit, profit_cover, quantity*price_per_unit as total_cost, selite from ltno_close_costs where offer_id = '$offer_id'";
        $rooms = $this->db->query($sql);
        return $rooms->result();
   }
   
   function add_close_cost($offer_id, $name_cost, $kind,$quantity,$unit,$price_per_unit,$profit_cover,$note_close_cost){
        $quantity = $this->check_null($quantity);
        $price_per_unit = $this->check_null($price_per_unit);
        $data = array(
            'offer_id' => $offer_id,
            'name' => $name_cost,
            'kind_id' => $kind,
            'quantity' => $quantity,
            'unit' => $unit,
            'price_per_unit' => $price_per_unit,
            'profit_cover'  => $profit_cover,
            'selite'    => $note_close_cost
        );
        $this->db->insert('ltno_close_costs',$data);
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
   }
   function get_contact_from_worker_id($worker_id){
        $sql = "select * from ltno_workers where id = '$worker_id'";
        $email = $this->db->query($sql);
        return $email->row();
   }
   function delete_overhour_rate($offer_id){
        $this->db->where('offer_id', $offer_id);
        $this->db->delete('ltno_over_hours');
   }
   function delete_all_services_by_offer_id($offer_id){
        $this->db->where('offer_id', $offer_id);
        $this->db->delete('ltno_services_offer');
   }
   function  add_services($offer_id, $name, $status){
        $data = array(
            'service'   => $name,
            'status'    => $status,
            'offer_id'  => $offer_id
        );
        $this->db->insert('ltno_services_offer',$data);
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
   }
   function add_overhour_rate($offer_id, $work_base, $f5_percen, $h1_percen, $h15_percen,$h2_percen, $h3_percen, $estimated,$name_over_hour){
        $data = array(
            'name' => $name_over_hour,
            'base' => $work_base,
            '50_percent' => $f5_percen,
            '100_percent' => $h1_percen,
            '150_percent' => $h15_percen,
            '200_percent' => $h2_percen,
            '300_percent' => $h3_percen,
            'offer_id' => $offer_id,
            'estimate' => $estimated
        );
        $this->db->insert('ltno_over_hours',$data);
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
   }
   function get_over_hour_by_offer_id($offer_id){
        $sql = "select * from ltno_over_hours where offer_id = '$offer_id'";
        $over_hour = $this->db->query($sql);
        return $over_hour->result();
   }
   function get_all_service($offer_id){
        $sql = "select * from ltno_services_offer where offer_id = '$offer_id'";
        $over_hour = $this->db->query($sql);
        return $over_hour->result();
   }
   function get_project_number($client_id){
        $sql = "select * from ltno_projects where client_id = '$client_id'";
        $over_hour = $this->db->query($sql);
        return $over_hour->result();
   }
}