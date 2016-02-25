<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Labours extends MX_Controller{
    
    function __construct() {
		// Parent class constructor
		parent::__construct();
		// Check user already logged in
		if( !is_user_logged_in() ) {
			// Redirect back
			redirect( 'auth/login/?continue=' . urlencode( current_url() ), 'location' );
			return false;
		}
        $this->load->model('works/work_model');
        $this->load->model('labour_model');
    }
    function index(){
        $works = $this->get_mywork_list();
        $data = array(
            'works' => $works['my_work_list'],
            'works_queue' => $works['my_queue_work_list']
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
    function get_mywork_list() {
        $user_id = $this->session->userdata('user_id');
        return $this->labour_model->get_mywork_list($user_id);
    }
    function save_work() {
        $user_id = $this->session->userdata('user_id');
        $worker_id = $this->labour_model->get_workerid_from_userid($user_id);
        $work_id = $this->input->post('work_id');
        $work_hours_json = $this->input->post('work_hours_json');        
        $work_status = '';
        $work_status = ($this->input->post('work_needed') == 'on') ? 3 : '';
        if ($this->input->post('mark_done') == 'on') {
            $work_status = 4;
        }

        if ($work_status != 3 && $work_status != 4) {
            $work_status = 1;
        }

        $this->labour_model->update_work_hours($worker_id, $work_id, $work_hours_json, $work_status) ;
        redirect('labours');
    }
    function timesheet() {
        $this->logtrino_ui->_set_view( 'timesheet' );
        // Display UI
        $this->logtrino_ui->_set_title( 'Timesheet' );
        $this->logtrino_ui->_render();

    }
    function get_time_sheet() {
        $start_date = $this->input->post('startDate');
        $end_date = $this->input->post('endDate');

        echo json_encode($this->labour_model->get_time_sheet($start_date, $end_date));
    }
}

?>