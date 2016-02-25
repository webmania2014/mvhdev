<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Offers extends MX_Controller{
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
        $this->load->model('offer_model');
        $this->load->model('clients/clients_model');
        $this->load->helper('url');
	}

    function index() {
		$offers = $this->offer_model->get_all_offers();
        $data = array(
            'offers' => $offers
        );
        // Set data
		$this->logtrino_ui->_set_data( $data );
		// Check user role to choose the edit view
		$this->logtrino_ui->_set_view( 'test' );
		// Display UI
		$this->logtrino_ui->_set_title( 'Overviews' );
		$this->logtrino_ui->_render();
	}
    
    function  get_offer_id(){
        $id = $this->input->get('id');
        $offer = $this->offer_model->get_by_id($id);
        echo json_encode($offer);
    }
    
    function create(){
        if(is_form_submit()){
            $offer_number = $this->input->post('offer_number');
            $starting_date = $this->input->post('date_starting');
            $house = $this->input->post('house');
            $room = $this->input->post('room');
            $client_id = $this->input->post('client_id');
            $project_id = $this->input->post('project_number');
            $cost_center = $this->input->post('cost_center');
            $order_number = $this->input->post('order_number');
            $probability = $this->input->post('probability');
            $client_number = $this->input->post('client_number');
            $contact_person_id = $this->input->post('contact_person_id');
            $contact_email = $this->input->post('contact_email');
            $seller_id = $this->input->post('seller_id');
            $responsible_sv_id = $this->input->post('responsible_sv_id');
            $foreman_id = $this->input->post('foreman_id');
            $day = $this->input->post('day_duration');
            $status = $this->input->post('startus_offer');

           
            $starting_date = strtotime($starting_date);
            $starting_date = date('Y-m-d', $starting_date);
            
            $offer_id = $this->offer_model->create($offer_number,$starting_date,$house,$room,$client_id,$project_id,$cost_center,$order_number,$probability,$client_number,$contact_person_id,$contact_email,$seller_id,$responsible_sv_id,$foreman_id,$day,$status);
            
            //for work or rental in offer
            $rental_scaffold_type = $this->input->post('rental_scaffold_type');
            $rental_scaffold_cover = $this->input->post('rental_scaffold_cover');
            $rental_scaffold_m2 = $this->input->post('rental_scaffold_m2');  
            $day_work = $this->input->post('day');    
            
            $work_scaffold_m2 = $this->input->post('work_scaffold_m2');
            $work_scaffold_cover = $this->input->post('work_scaffold_cover');
            
            //work scaffold prepare for transport
            $kust_transport = $this->input->post('kust_transport');
            $cover_transport = $this->input->post('cover_transport');
          
            $kust_kraana = $this->input->post('kust_kraana');
            $cover_kraana = $this->input->post('cover_kraana');
           
            $kust_material = $this->input->post('kust_material');
            $cover_material = $this->input->post('cover_material');
    
            //insert into ltno_rental_scaffold for demesion
            $length = $this->input->post('length');
            $width = $this->input->post('width');
            $high = $this->input->post('high');
            $note = $this->input->post('note');
            $scaffold_dimension = $this->input->post('scaffold_dimension');
            
            //insert for other work
            $note_material = $this->input->post('material_note');
            $other_cost = $this->input->post('other_cost');
            $cover_other = $this->input->post('other_cover');
            $note_other = $this->input->post('other_note');
            
            $step_offer = $this->input->post('step_offer');
            if($rental_scaffold_type){
                if(count($rental_scaffold_type) > 0){
                    $this->offer_model->delete_all_rental_scaffold($offer_id);
                    for($i = 0; $i < count($rental_scaffold_type); $i++){
                        $this->offer_model->create_rental_scaffold($offer_id,$rental_scaffold_type[$i],$rental_scaffold_cover[$i],$rental_scaffold_m2[$i], $day_work[$i], $length[$i], $width[$i], $high[$i], $scaffold_dimension[$i], $note[$i],$step_offer[$i]);
                    }
                }
            }
            
            $step_offer_work = $this->input->post('step_offer_work');
            $work_scaffold_type = $this->input->post('work_scaffold_type');
            $work_m2 = $this->input->post('work_m2');
            if($work_scaffold_type){
                if(count($work_scaffold_type) > 0){
                    $this->offer_model->delete_all_work_scaffold($offer_id);
                    for($i = 0; $i < count($work_scaffold_type); $i++){
                        $this->offer_model->create_work_scaffold($offer_id,$work_scaffold_m2[$i],$work_scaffold_cover[$i],$work_m2[$i],$kust_transport[$i],$cover_transport[$i],$kust_kraana[$i],$cover_kraana[$i],$kust_material[$i],$cover_material[$i], $note_material[$i], $other_cost[$i], $cover_other[$i], $note_other[$i],$work_scaffold_type[$i],$step_offer_work[$i]);
                    }
                }
            }
            
            //infomation for offer
            $information = $this->input->post('information');
            if($information){
                if(count($information)>0){
                    $this->offer_model->delete_info($offer_id);
                    foreach($information as $info){
                        $this->offer_model->add_info($offer_id, $info);
                    }
                }
            } 
            
            //prepare for closed costs
            $name_cost = $this->input->post('name_cost');
            $kind = $this->input->post('kind');
            $quantity = $this->input->post('quantity');
            $unit = $this->input->post('unit');
            $price_per_unit = $this->input->post('price_per_unit');
            $profit_cover = $this->input->post('profit_cover');
            $note_close_cost = $this->input->post('note_close_cost');
            
            $this->offer_model->delete_all_close_cost_offer($offer_id);
            for($i = 0; $i < count($name_cost); $i++){
                $this->offer_model->add_close_cost($offer_id, $name_cost[$i], $kind[$i],$quantity[$i],$unit[$i],$price_per_unit[$i], $profit_cover[$i], $note_close_cost[$i]);
            }
            
            //prepare for rental fees
            $type = $this->input->post('rental_scaffold_type_fee');
            $fee_unit_day = $this->input->post('fee_unit_day');
            $fee_min_day = $this->input->post('fee_min_day');
            if($type){
                if(count($type) > 0){
                    $this->offer_model->delete_rental_fee($offer_id);
                    for($i = 0; $i < count($type); $i++){
                        $this->offer_model->add_rental_fee($offer_id,$type[$i],$fee_unit_day[$i],$fee_min_day[$i]);
                    }
                }
            }
            
            //prepare for material
            $name_material = $this->input->post('name_material');
            $amount_material = $this->input->post('amount_material');
            $unit_material = $this->input->post('unit_material');
            $per_unit_material = $this->input->post('per_unit_material');
            if($name_material){
                if(count($name_material) > 0){
                    $this->offer_model->delete_all_material($offer_id);
                    for($i = 0; $i < count($name_material); $i++){
                        $this->offer_model->add_material_price($offer_id,$name_material[$i],$amount_material[$i],$unit_material[$i],$per_unit_material[$i]);
                    }
                }
            }
            
            $name_over_hour = $this->input->post('name_overhour');
            $work_base = $this->input->post('base');
            $f5_percen = $this->input->post('f5_percen');
            $h1_percen = $this->input->post('h1_percen');
            $h15_percen = $this->input->post('h15_percen');
            $h2_percen = $this->input->post('h2_percen');
            $h3_percen = $this->input->post('h3_percen');
            $estimated = $this->input->post('estimated');
            $this->offer_model->delete_overhour_rate($offer_id);
            for($i=0;$i<count($work_base);$i++){
                $this->offer_model->add_overhour_rate($offer_id, $work_base[$i], $f5_percen[$i], $h1_percen[$i], $h15_percen[$i],$h2_percen[$i], $h3_percen[$i], $estimated[$i],$name_over_hour[$i]);
            }
            
            $status_services = $this->input->post('status_service');
            $name_service = $this->input->post('name_service');
            if($name_service){
                if(count($name_service)>0){
                    $this->offer_model->delete_all_services_by_offer_id($offer_id);
                    for($i=0;$i<count($name_service); $i++){
                        $this->offer_model->add_services($offer_id, $name_service[$i], $status_services[$i]);
                    }
                }
            }
            
            $this->session->set_flashdata( 'message', 
				array(
							'success' => array( 'Create successed !!.' )
						)
                );
            redirect( 'offers' );
        }
    	$this->logtrino_ui->_set_view( 'clients/create' );
        $this->logtrino_ui->_render();
        
    }
    
    function get_info_client(){
        $client_id = $this->input->get('client_id');
        $client = $this->offer_model->get_client_by_id($client_id);
        echo json_encode($client);
    }
    function get_rental_fee(){
        $offer_id = $this->input->get('offer_id');
        $rental_fees = $this->offer_model->get_all_rental_fee($offer_id);
        echo json_encode($rental_fees);
    }
    function edit(){
        $action = $this->input->post('action');
               
        if($action == 'Save'){
            $offer_id = $this->input->post('offer_id');
            
            if($offer_id == ''){
                $this->create();
                $this->logtrino_ui->_set_message( 'success', 
            	array( 'create successed !!!!' ) 
    				);
                redirect( 'offers' );
            }
            $starting_date = $this->input->post('date_starting');
            $house = $this->input->post('house');
            $room = $this->input->post('room');
            $client_id = $this->input->post('client_id');
            $project_id = $this->input->post('project_number');
            $cost_center = $this->input->post('cost_center');
            $order_number = $this->input->post('order_number');
            $probability = $this->input->post('probability');
            $client_number = $this->input->post('client_number');
            $contact_person_id = $this->input->post('contact_person_id');
            $contact_email = $this->input->post('contact_email');
            $seller_id = $this->input->post('seller_id');
            $responsible_sv_id = $this->input->post('responsible_sv_id');
            $foreman_id = $this->input->post('foreman_id');
            $day = $this->input->post('day_duration');
            $status = $this->input->post('startus_offer');
            
            $starting_date = strtotime($starting_date);
          
            $starting_date = date('Y-m-d', $starting_date);
            
            $this->offer_model->edit($offer_id,$starting_date,$house,$room,$client_id,$project_id,$cost_center,$order_number,$probability,$client_number,$contact_person_id,$contact_email,$seller_id,$responsible_sv_id,$foreman_id,$day,$status);
            
            //for work or rental in offer
            $rental_scaffold_type = $this->input->post('rental_scaffold_type');
            $rental_scaffold_cover = $this->input->post('rental_scaffold_cover');
            $rental_scaffold_m2 = $this->input->post('rental_scaffold_m2');  
            $day_work = $this->input->post('day');    
            
            $work_scaffold_m2 = $this->input->post('work_scaffold_m2');
            $work_scaffold_cover = $this->input->post('work_scaffold_cover');
            
            //work scaffold prepare for transport
            $kust_transport = $this->input->post('kust_transport');
            $cover_transport = $this->input->post('cover_transport');
          
            $kust_kraana = $this->input->post('kust_kraana');
            $cover_kraana = $this->input->post('cover_kraana');
           
            $kust_material = $this->input->post('kust_material');
            $cover_material = $this->input->post('cover_material');
    
            //insert into ltno_rental_scaffold for demesion
            $length = $this->input->post('length');
            $width = $this->input->post('width');
            $high = $this->input->post('high');
            $note = $this->input->post('note');
            $scaffold_dimension = $this->input->post('scaffold_dimension');
            
            //insert for other work
            $note_material = $this->input->post('material_note');
            $other_cost = $this->input->post('other_cost');
            $cover_other = $this->input->post('other_cover');
            $note_other = $this->input->post('other_note');
            
            $step_offer = $this->input->post('step_offer');
            if($rental_scaffold_type){
                if(count($rental_scaffold_type) > 0){
                    $this->offer_model->delete_all_rental_scaffold($offer_id);
                    for($i = 0; $i < count($rental_scaffold_type); $i++){
                        $this->offer_model->create_rental_scaffold($offer_id,$rental_scaffold_type[$i],$rental_scaffold_cover[$i],$rental_scaffold_m2[$i], $day_work[$i], $length[$i], $width[$i], $high[$i], $scaffold_dimension[$i], $note[$i],$step_offer[$i]);
                    }
                }
            }
            
            $step_offer_work = $this->input->post('step_offer_work');
            $work_scaffold_type = $this->input->post('work_scaffold_type');
            $work_m2 = $this->input->post('work_m2');
            if($work_scaffold_type){
                if(count($work_scaffold_type) > 0){
                    $this->offer_model->delete_all_work_scaffold($offer_id);
                    for($i = 0; $i < count($work_scaffold_type); $i++){
                        $this->offer_model->create_work_scaffold($offer_id,$work_scaffold_m2[$i],$work_scaffold_cover[$i],$work_m2[$i],$kust_transport[$i],$cover_transport[$i],$kust_kraana[$i],$cover_kraana[$i],$kust_material[$i],$cover_material[$i], $note_material[$i], $other_cost[$i], $cover_other[$i], $note_other[$i],$work_scaffold_type[$i],$step_offer_work[$i]);
                    }
                }
            }
            
            //infomation for offer
            $information = $this->input->post('information');
            if($information){
                if(count($information)>0){
                    $this->offer_model->delete_info($offer_id);
                    foreach($information as $info){
                        $this->offer_model->add_info($offer_id, $info);
                    }
                }
            } 
            
            //prepare for closed costs
            $name_cost = $this->input->post('name_cost');
            $kind = $this->input->post('kind');
            $quantity = $this->input->post('quantity');
            $unit = $this->input->post('unit');
            $price_per_unit = $this->input->post('price_per_unit');
            $profit_cover = $this->input->post('profit_cover');
            $note_close_cost = $this->input->post('note_close_cost');
            
            $this->offer_model->delete_all_close_cost_offer($offer_id);
            for($i = 0; $i < count($name_cost); $i++){
                $this->offer_model->add_close_cost($offer_id, $name_cost[$i], $kind[$i],$quantity[$i],$unit[$i],$price_per_unit[$i], $profit_cover[$i], $note_close_cost[$i]);
            }
            
            //prepare for rental fees
            $type = $this->input->post('rental_scaffold_type_fee');
            $fee_unit_day = $this->input->post('fee_unit_day');
            $fee_min_day = $this->input->post('fee_min_day');
            if($type){
                if(count($type) > 0){
                    $this->offer_model->delete_rental_fee($offer_id);
                    for($i = 0; $i < count($type); $i++){
                        $this->offer_model->add_rental_fee($offer_id,$type[$i],$fee_unit_day[$i],$fee_min_day[$i]);
                    }
                }
            }
            
            //prepare for material
            $name_material = $this->input->post('name_material');
            $amount_material = $this->input->post('amount_material');
            $unit_material = $this->input->post('unit_material');
            $per_unit_material = $this->input->post('per_unit_material');
          
            if($name_material){
                if(count($name_material) > 0){
                    $this->offer_model->delete_all_material($offer_id);
                    for($i = 0; $i < count($name_material); $i++){
                        $this->offer_model->add_material_price($offer_id,$name_material[$i],$amount_material[$i],$unit_material[$i],$per_unit_material[$i]);
                    }
                }
            }
            
            $name_over_hour = $this->input->post('name_overhour');
            $work_base = $this->input->post('base');
            $f5_percen = $this->input->post('f5_percen');
            $h1_percen = $this->input->post('h1_percen');
            $h15_percen = $this->input->post('h15_percen');
            $h2_percen = $this->input->post('h2_percen');
            $h3_percen = $this->input->post('h3_percen');
            $estimated = $this->input->post('estimated');
            $this->offer_model->delete_overhour_rate($offer_id);
            for($i=0;$i<count($work_base);$i++){
                $this->offer_model->add_overhour_rate($offer_id, $work_base[$i], $f5_percen[$i], $h1_percen[$i], $h15_percen[$i],$h2_percen[$i], $h3_percen[$i], $estimated[$i],$name_over_hour[$i]);
            }
            
            $status_services = $this->input->post('status_service');
            $name_service = $this->input->post('name_service');
            if($name_service){
                if(count($name_service)>0){
                    $this->offer_model->delete_all_services_by_offer_id($offer_id);
                    for($i=0;$i<count($name_service); $i++){
                        $this->offer_model->add_services($offer_id, $name_service[$i], $status_services[$i]);
                    }
                }
            }
            
            $this->logtrino_ui->_set_message( 'success', 
            	array( 'Edit successfull !!!!' ) 
    				);
            redirect( 'offers' );
        }
       
    }
    
    function check_season($date){
        $compare = explode('-',$date);
        if($compare[0] >= 4 && $compare[0]< 10){
            return true;
        }else{
            return false;
        }
    }
    function get_material(){
        $offer_id = $this->input->get('offer_id');
        $materials = $this->offer_model->get_material_by_offer_id($offer_id);
        echo json_encode($materials);
    }
    function get_all_info(){
        $offer_id = $this->input->get('offer_id');
        $info = $this->offer_model->get_all_info_by_offer_id($offer_id);
        echo json_encode($info);
    }
    function get_price_for_rental_scaffold(){
        $date = $this->input->get('date');
        if($date != ''){
            if($this->check_season($date)){
                $season = 1;
            }else{
                $season = 0;
            }
            $type_id = $this->input->get('type');
            $result = $this->offer_model->get_price_by_type($type_id, $season);
            echo json_encode($result);
        }else{
            echo json_encode('0');
        }
    }  
    
    function get_rental_scaffold_by_offer_id(){
        $offer_id = $this->input->get('offer_id');
        $day = intval($this->input->get('day'));
        $start = intval($this->input->get('starting_date'));
        if($this->check_season($start)){
                $season = 1;
            }else{
                $season = 0;
        }
        if($day > 90){
            $flag = true;
        }else{
            $flag = false;
        }
        $rental_scaffold = $this->offer_model->get_rental_for_scaffolds($offer_id,$flag, $season);
        echo json_encode($rental_scaffold);
    }
    function get_rental_tent_by_offer_id(){
        $offer_id = $this->input->get('offer_id');
        $day = intval($this->input->get('day'));
        $start = intval($this->input->get('starting_date'));
        $type = $this->input->get('type');
        if($this->check_season($start)){
                $season = 1;
            }else{
                $season = 0;
        }
        if($day > 90){
            $flag = true;
        }else{
            $flag = false;
        }
        $rental_tents = $this->offer_model->get_rental_for_tents($offer_id,$flag, $day, $season,$type);
        echo json_encode($rental_tents);
    }
    function get_work_scaffold_by_offer_id(){
        $offer_id = $this->input->get('offer_id');
        $work_scaffolds = $this->offer_model->get_work_scaffolds($offer_id);
        echo json_encode($work_scaffolds);
    }
    function get_work_tent_by_offer_id(){
        $type = $this->input->get('type');
        $offer_id = $this->input->get('offer_id');
        $work_tents = $this->offer_model->get_work_tents($offer_id,$type);
        echo json_encode($work_tents);
    }
    function get_room_of_house(){
        $house_id = $this->input->get('house_id');
        $rooms = $this->offer_model->get_all_room($house_id);
        echo json_encode($rooms);
    }
    function get_close_cost(){
        $offer_id = $this->input->get('offer_id');
        $close_costs = $this->offer_model->get_close_cost_by_offer_id($offer_id);
        echo json_encode($close_costs);
    }
    function get_contact_email(){
        $worker_id = $this->input->get('worker_id');
        $email = $this->offer_model->get_contact_from_worker_id($worker_id);
        echo json_encode($email);
    }
    function get_over_hour(){
        $offer_id = $this->input->get('offer_id');
        $over_hours = $this->offer_model->get_over_hour_by_offer_id($offer_id);
        echo json_encode($over_hours);
    }
    function get_services(){
        $offer_id = $this->input->get('offer_id');
        $services = $this->offer_model->get_all_service($offer_id);
        echo json_encode($services);
    }
    function get_project_number_by_client_id(){
        $client_id = $this->input->get('client_id');
        $projects = $this->offer_model->get_project_number($client_id);
        echo json_encode($projects);
    }
}

?>