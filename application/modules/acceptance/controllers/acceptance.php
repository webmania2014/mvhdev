<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Acceptance extends MX_Controller{
    
    function __construct() {
		// Parent class constructor
		parent::__construct();
		// Check user already logged in
		if( !is_user_logged_in() ) {
			// Redirect back
			redirect( 'auth/login/?continue=' . urlencode( current_url() ), 'location' );
			return false;
		}
        $this->load->model('workers/worker_model');
        $this->load->model('works/work_model');
        $this->load->model('acceptance_model');
    }
    function index(){
        $workers = $this->acceptance_model->get_workers();
        $work_types = $this->acceptance_model->get_work_types();
        $data = array(
            'workers' => $workers,
            'work_types' => $work_types
        );
        $this->logtrino_ui->_set_data( $data );
        $this->logtrino_ui->_set_view( 'overviews' );
		// Display UI
		$this->logtrino_ui->_set_title( 'Overviews' );
		$this->logtrino_ui->_render();
    }
    function get_work_id(){
        $work_id = $this->input->get('id');
        $work = $this->labour_model->get_work_by_id($work_id);
        echo json_encode($work);
    }
    function get_time_sheet() {
        $worker_id = $this->input->post('workerId');
        $start_date = $this->input->post('startDate');
        $end_date = $this->input->post('endDate');

        echo json_encode($this->acceptance_model->get_time_sheet($worker_id, $start_date, $end_date));
    }
    function save_work_hour() {
        $request_json = $this->input->post('request-json');
        $work_accepted = $this->input->post('work-accepted');

        $work_hours_list = json_decode($request_json, true);
        $this->acceptance_model->save_work_hour($work_hours_list, $work_accepted);

        redirect('acceptance');
    }
}

?>