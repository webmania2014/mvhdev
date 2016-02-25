<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Works extends MX_Controller{
    
    function __construct() {
		// Parent class constructor
		parent::__construct();
		// Check user already logged in
		if( !is_user_logged_in() ) {
			// Redirect back
			redirect( 'auth/login/?continue=' . urlencode( current_url() ), 'location' );
			return false;
		}
        $this->load->model('work_model');
    }
    function create(){
        if($this->input->post('work_needed') == 'on'){
            $status = 3;
        }else{
            if($this->input->post('action') == 'Save work'){
                $status = 1;
                $date_start = strtotime('NOW');
                $date_start = date('Y-m-d', $date_start);
            }else{
                $status = 2;
            }
        }
        $client_id = $this->input->post('client_id');
        $offer_id = $this->input->post('offer_id');
        $work_type_id = $this->input->post('work_type');
        $sub_work_type_id = $this->input->post('sub_work_id');
        $work_number = $this->input->post('work_number');
        $scaffold_number = $this->input->post('scaffold_number');
        $rental_number = $this->input->post('rental_number');
        $house_id = $this->input->post('house');
        $room_id = $this->input->post('room');
        $workers = $this->input->post('worker');
        $contract_parent_work_id = $this->input->post('offer_work_id');
        
        $supervisor_id = $this->input->post('suppervisor');
        $work_id = $this->work_model->create_work($client_id, $offer_id, $work_type_id, $sub_work_type_id, $work_number, $scaffold_number, $rental_number, $house_id, $room_id, $supervisor_id, $status, $date_start);
        foreach($workers as $worker){
            if($worker != '0'){
                $this->work_model->add_worker_for_work($worker, $work_id);
            }
        }
        redirect('works');
    }

    function create_contract(){
        if($this->input->post('work_needed') == 'on'){
            $status = 3;
        }else{
            if($this->input->post('action') == 'Save work'){
                $status = 1;
                $date_start = strtotime('NOW');
                $date_start = date('Y-m-d', $date_start);
            }else{
                $status = 2;
            }
        }
        $client_id = $this->input->post('client_id');
        $offer_id = $this->input->post('offer_id');
        $work_offer_id = $this->input->post('work_multiple');
        $work_type_id = $this->input->post('work_type');
        $sub_work_type_id = $this->input->post('sub_work_id');
        $work_number = $this->input->post('work_number');
        $scaffold_number = $this->input->post('scaffold_number');
        $rental_number = $this->input->post('rental_number');
        $house_id = $this->input->post('house');
        $room_id = $this->input->post('room');
        $workers = $this->input->post('worker');
        $contract_parent_work_id = $this->input->post('offer_work_id');
        
        $supervisor_id = $this->input->post('suppervisor');
        $work_id = $this->work_model->create_work($client_id, $offer_id, $work_type_id, $sub_work_type_id, $work_number, $scaffold_number, $rental_number, $house_id,$room_id, $supervisor_id, $status, $date_start, $contract_parent_work_id);
        foreach($workers as $worker){
            if($worker != '0'){
                $this->work_model->add_worker_for_work($worker, $work_id);
            }
        }
        redirect('works/contract_work');
    }
    
    function end_work(){
        $status = 3;
        $work_id = $this->input->post('work_id');
        $project_id = $this->input->post('project_id');
        $client_id = $this->input->post('client_id');
        $offer_id = $this->input->post('offer_id');
        $work_type_id = $this->input->post('work_type');
        $sub_work_type_id = $this->input->post('sub_work_id');
        $work_number = $this->input->post('work_number');
        $rental_number = $this->input->post('rental_number');
        $house_id = $this->input->post('house');
        $room_id = $this->input->post('room');
        $end_date = $this->input->post('date_will_end');
        $calculate = $this->input->post('cal');
        $end_date = strtotime($end_date);
        $end_date = date('Y-m-d', $end_date);
        
        $lenght = $this->input->post('lenght');
        $width = $this->input->post('width');
        $height = $this->input->post('height');
        $this->work_model->delete_all_size_of_work($work_id);
        for($i = 0; $i<count($lenght); $i++){
            $this->work_model->add_size_for_work($lenght[$i], $width[$i], $height[$i], $work_id);
        }
        
        $material = $this->input->post('material');
        $m2 = $this->input->post('m2');
        
        $this->work_model->delete_all_material_of_work($work_id);
        for($i = 0; $i<count($material); $i++){
            $this->work_model->add_material_for_work($material[$i], $m2[$i], $work_id);
        }
        $workers = $this->input->post('worker');
        $this->work_model->delete_all_worker_of_work($work_id);
        
        foreach($workers as $worker){
            if($worker != ''){
                $this->work_model->add_worker_for_work($worker, $work_id);
            }
        }
        $supervisor_id = $this->input->post('suppervisor');
        
        $this->work_model->edit_end_work($work_id, $client_id, $offer_id, $work_type_id, $sub_work_type_id, $work_number, $rental_number, $house_id, $room_id, $supervisor_id, $status, $end_date, $cal);
        redirect('works');
    }
    
    function edit(){
        if($this->input->post('work_needed') == 'on'){
            $status = 3;
        }else{
            if($this->input->post('action') == 'Save work'){
                $status = 1;
            }else{
                $status = 2;
            }
        }
        $work_id = $this->input->post('work_id');
        $client_id = $this->input->post('client_id');
        $offer_id = $this->input->post('offer_id');
        $work_type_id = $this->input->post('work_type');
        $sub_work_type_id = $this->input->post('sub_work_id');
        $work_number = $this->input->post('work_number');
        $scaffold_number = $this->input->post('scaffold_number');
        $rental_number = $this->input->post('rental_number');
        $house_id = $this->input->post('house');
        $room_id = $this->input->post('room');
        $workers = $this->input->post('worker');
        $this->work_model->delete_all_worker_of_work($work_id);
        foreach($workers as $worker){
            if($worker != ''){
                $this->work_model->add_worker_for_work($worker, $work_id);
            }
        }
        $supervisor_id = $this->input->post('suppervisor');
        $this->work_model->edit_work($work_id, $client_id, $offer_id, $work_type_id, $sub_work_type_id, $work_number, $scaffold_number, $rental_number, $house_id, $room_id, $supervisor_id, $status);
        if($status == 2){
            $data = array(
                'work_id'           => $work_id
            );
            $this->logtrino_ui->_set_data( $data );
            $this->logtrino_ui->_set_view( 'confirm_date_start' );
            // Display UI
    		$this->logtrino_ui->_set_title( 'Confirm date will start' );
    		$this->logtrino_ui->_render();
        }else{
            redirect('works');
        }
    }
    
    function edit_contract(){
        if($this->input->post('work_needed') == 'on'){
            $status = 3;
        }else{
            if($this->input->post('action') == 'Save work'){
                $status = 1;
            }else{
                $status = 2;
            }
        }
        $work_id = $this->input->post('work_id');
        $client_id = $this->input->post('client_id');
        $offer_id = $this->input->post('offer_id');
        $work_offer_id = $this->input->post('work_multiple');
        $work_type_id = $this->input->post('work_type');
        $sub_work_type_id = $this->input->post('sub_work_id');
        $work_number = $this->input->post('work_number');
        $scaffold_number = $this->input->post('scaffold_number');
        $rental_number = $this->input->post('rental_number');
        $house_id = $this->input->post('house');
        $room_id = $this->input->post('room');
        $workers = $this->input->post('worker');
        $this->work_model->delete_all_worker_of_work($work_id);
        foreach($workers as $worker){
            if($worker != ''){
                $this->work_model->add_worker_for_work($worker, $work_id);
            }
        }
        $supervisor_id = $this->input->post('suppervisor');
        $contract_parent_work_id = $this->input->post('offer_work_id');

        $this->work_model->edit_work($work_id, $client_id, $offer_id, $work_offer_id, $work_type_id, $sub_work_type_id, $work_number, $scaffold_number, $rental_number, $house_id, $room_id, $supervisor_id, $status, $contract_parent_work_id);
        if($status == 2){
            $data = array(
                'work_id'           => $work_id
            );
            $this->logtrino_ui->_set_data( $data );
            $this->logtrino_ui->_set_view( 'confirm_date_start' );
            // Display UI
    		$this->logtrino_ui->_set_title( 'Confirm date will start' );
    		$this->logtrino_ui->_render();
        }else{
            redirect('works/contract_work');
        }
    }
    
    function process(){
        $work_id = $this->input->post('work_id');
        if($work_id == ''){
            $this->create();
        }else{
            $this->edit();
        }
    }

    function contract_process() {
        $work_id = $this->input->post('work_id');
        if($work_id == ''){
            $this->create_contract();
        }else{
            $this->edit_contract();
        }
    }

    function contract_work(){
        $works = $this->work_model->get_all_workers_on_going();
        $work_queue = $this->work_model->get_all_workers_queue();
        $data = array(
            'works'           => $works,
            'works_queue'    => $work_queue
        );
        $this->logtrino_ui->_set_data( $data );
        $this->logtrino_ui->_set_view( 'contract_work' );
        // Display UI
        $this->logtrino_ui->_set_title( 'Contract Work' );
        $this->logtrino_ui->_render();
    }
    function index(){
        $works = $this->work_model->get_all_workers_on_going();
        $work_queue = $this->work_model->get_all_workers_queue();
        $data = array(
            'works'           => $works,
            'works_queue'    => $work_queue
        );
        $this->logtrino_ui->_set_data( $data );
        $this->logtrino_ui->_set_view( 'overviews' );
		// Display UI
		$this->logtrino_ui->_set_title( 'Overviews' );
		$this->logtrino_ui->_render();
    }
    function get_autosearch_work(){
        $type_work = $this->input->get('work_type');
        $text = $this->input->get('text');
        $databind = $this->work_model->get_data_search_work($type_work, $text);
        echo json_encode($databind);
    }
    function get_autosearch_client(){
        $text = $this->input->get('client');
        $databind = $this->work_model->get_data_search_client( $text);
        echo json_encode($databind);
    }
    function get_client(){
        $text = $this->input->get('client');
        $databind = $this->work_model->get_data_client( $text);
        echo json_encode($databind);
    }
    function get_autosearch_offer(){
        $text = $this->input->get('offer');
        $project_id = $this->input->get('project_id');
        $client_id = $this->input->get('client_id');
        $databind = $this->work_model->get_data_search_offer($project_id, $text, $client_id);
        echo json_encode($databind);
    }
    function get_autosearch_area(){
        $area_id = $this->input->get('area');
        $area_text = $this->input->get('area_text');
        $databind = $this->work_model->get_sub_area($area_id, $area_text);
        echo json_encode($databind);
    }
    function get_work_id(){
        $text = $this->input->get('id');
        $work = $this->work_model->get_work_by_id($text);
        echo json_encode($work);
    }
    
    function confirm_date_will_start(){
        $work_id = $this->input->post('work_id');
        $date_will_start = $this->input->post('date_will_start');
        $date_will_start = strtotime($date_will_start);
        $check_date = date('w', $date_will_start);
        if($check_date == 0){
            $date_will_start = date('Y-m-d', strtotime('+1 day', $date_will_start));
        }else{
            $date_will_start = date('Y-m-d', $date_will_start);
        }
        $this->work_model->update_date_will_start($work_id,$date_will_start);
        redirect('works');
    }
    
    function get_select_multiple(){
        $text = $this->input->get('offer_id');
        $works = $this->work_model->get_works_for_contract($text);
        echo json_encode($works);
    }
    function get_autosearch_project(){
        $client_id = $this->input->get('client');
        $project = $this->input->get('project');
        $projects = $this->work_model->get_project_by_client_id($client_id, $project);
        echo json_encode($projects);
    }
    function endwork($work_id = null){
        $work = $this->work_model->get_work_by_id($work_id);
        //var_dump($work);exit;
        $workers = $this->work_model->get_worker_for_work($work_id);
        $sizes = $this->work_model->get_size_for_work($work_id);
        $materials = $this->work_model->get_material_for_work($work_id);
        $data = array(
            'work' => $work,
            'workers' => $workers,
            'sizes' => $sizes,
            'materials' => $materials
        );
        $this->logtrino_ui->_set_data( $data );
        $this->logtrino_ui->_set_view( 'endwork' );
		// Display UI
		$this->logtrino_ui->_set_title( 'End Work' );
		$this->logtrino_ui->_render();
    }
    function get_works_by_offer() {
        $offer_id = $this->input->get('offer_id');
        echo json_encode($this->work_model->get_works_by_offer($offer_id));
    }
}
?>