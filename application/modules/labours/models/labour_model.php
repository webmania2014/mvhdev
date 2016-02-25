<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Labour_model extends CI_Model{
    function get_work_by_id($work_id) {
        $work_info = array();

        $work_info['id'] = $work_id;
        $query = $this->db->query('SELECT * FROM ltno_works WHERE id=\'' . $work_id . '\'');
        $work_info_from_db = $query->row();

        $query = $this->db->query('SELECT client_name, client_number FROM ltno_clients WHERE id=\'' . $work_info_from_db->client_id . '\'');
        $work_info['client_name'] = isset($query->row()->client_name) ? $query->row()->client_name : '';
        $work_info['client_number'] = isset($query->row()->client_number) ? $query->row()->client_number : '';

        $query = $this->db->query('SELECT offer_number FROM ltno_offers WHERE id=\'' . $work_info_from_db->offer_id . '\'');
        $work_info['offer_number'] = isset($query->row()->offer_number) ? $query->row()->offer_number : '';

        $query = $this->db->query('SELECT project_number FROM ltno_projects WHERE id=\'' . $work_info_from_db->project_id . '\'');
        $work_info['project_number'] = isset($query->row()->project_number) ? $query->row()->project_number : '';

        $query = $this->db->query('SELECT title FROM ltno_work_types WHERE \'' . $work_info_from_db->work_type_id . '\'');
        $work_info['work_type'] = isset($query->row()->title) ? $query->row()->title : '';

        $work_info['work_number'] = isset($work_info_from_db->work_number) ? $work_info_from_db->work_number : '';
        $work_info['rental_number'] = isset($work_info_from_db->rental_number) ? $work_info_from_db->rental_number : '';

        $query = $this->db->query('SELECT name FROM ltno_house WHERE id=\'' . $work_info_from_db->house_id . '\'');
        $house_name = isset($query->row()->name) ? $query->row()->name : '';
        $query = $this->db->query('SELECT name FROM ltno_house WHERE id=\'' . $work_info_from_db->room_id . '\'');
        $room_name = isset($query->row()->name) ? $query->row()->name : '';
        $work_info['area'] = $house_name . ' ' . $room_name;

        $workers_list = array();
        $query = $this->db->query('SELECT * FROM ltno_worker_of_work WHERE work_id = \'' . $work_info_from_db->id . '\'');
        foreach ($query->result() as $row) {
            $worker = $this->db->query('SELECT first_name, last_name FROM ltno_workers WHERE id=\'' . $row->worker_id . '\'');
            $workers_list[] = $worker->row()->first_name . ' ' . $worker->row()->last_name;
        }
        $work_info['workers'] = $workers_list;

        $query = $this->db->query('SELECT first_name, last_name FROM ltno_workers WHERE id = \'' . $work_info_from_db->supervisor_id . '\'');
        $supervisor_firstname = isset($query->row()->first_name) ? $query->row()->first_name : '';
        $supervisor_lastname = isset($query->row()->last_name) ? $query->row()->last_name : '';
        $work_info['supervisor'] =  $supervisor_firstname . ' ' . $supervisor_lastname;

        $work_info['status'] = $work_info_from_db->status;

        $user_id = $this->session->userdata('user_id');
        $worker_id = $this->get_workerid_from_userid ($user_id);
        $query = $this->db->query('SELECT * FROM ltno_works_hours WHERE worker_id=\'' . $worker_id . '\' AND work_id=\'' . $work_id . '\'');
        $work_hours = array();
        foreach ($query->result() as $row) {
            $work_hours[] = array(
                'work_history_date' => isset($row->work_date) ? $row->work_date : '',
                'work_history_start_time' => isset($row->work_start_time) ? $row->work_start_time : '',
                'work_history_end_time' => isset($row->work_end_time) ? $row->work_end_time : '',
                'work_history_norm' => isset($row->work_norm) ? $row->work_norm : '',
                'work_history_50' => isset($row->work_50) ? $row->work_50 : '',
                'work_history_100' => isset($row->work_100) ? $row->work_100 : '',
                'work_history_150' => isset($row->work_150) ? $row->work_150 : '',
                'work_history_300' => isset($row->work_300) ? $row->work_300 : ''
            );
        }
        $work_info['work_hours'] = $work_hours;

        return $work_info;
    }

    function get_workerid_from_userid ($user_id) {
        $query = $this->db->query('SELECT id FROM ltno_workers WHERE user_id=\'' . $user_id . '\'');
        $row = $query->row();
        $worker_id = $row->id;
        return $worker_id;
    }

    function get_mywork_list ($user_id) {
        $query = $this->db->query('SELECT id FROM ltno_workers WHERE user_id=\'' . $user_id . '\'');
        $row = $query->row();
        $my_work_list = array();
        $my_queue_work_list = array();
        if(!empty($row)){
            $worker_id = $row->id;

            $sql = 'SELECT * FROM ltno_worker_of_work WHERE worker_id=\'' . $worker_id . '\'';
            $query = $this->db->query($sql);
            $work_id_list = array();
            foreach ($query->result() as $row)
            {
                $work_id_list[] = $row->work_id;
            }

            $work_info_list = array();
            foreach ($work_id_list as $work_id) {
                $work_info = array();
                $query = $this->db->query('SELECT * FROM ltno_works WHERE id=\'' . $work_id . '\'');
                if(!empty($query->row())){
                    $work_info['id'] = $work_id;
                    $work_info_from_db = $query->row();
                    $query = $this->db->query('SELECT client_name FROM ltno_clients WHERE id=\'' . $work_info_from_db->client_id . '\'');

                    $work_info['client_name'] = $query->row()->client_name;
                    $query = $this->db->query('SELECT name FROM ltno_house WHERE id=\'' . $work_info_from_db->house_id . '\'');
                    $house_name = isset($query->row()->name) ? $query->row()->name : '';
                    $query = $this->db->query('SELECT name FROM ltno_house WHERE id=\'' . $work_info_from_db->room_id . '\'');
                    $room_name = isset($query->row()->name) ? $query->row()->name : '';
                    $work_info['area'] = $house_name . ' ' . $room_name;
                    $query = $this->db->query('SELECT title FROM ltno_work_types WHERE id=\'' . $work_info_from_db->work_type_id . '\'');
                    $work_info['work_type'] = $query->row()->title;
                    $work_info['start_date'] = $work_info_from_db->date_start;
                    $work_info['will_start_date'] = $work_info_from_db->date_will_start;
                    $work_info['status'] = $work_info_from_db->status;

                    $work_info_list[] = $work_info;
                }
            }

            foreach ($work_info_list as $work_info) {
                if ($work_info['status'] == 2) {
                    $my_queue_work_list[] = $work_info;
                } else if ($work_info['status'] == 1) {
                    $my_work_list[] = $work_info;
                } else if ($work_info['status'] == 0) {
                    $my_work_list[] = $work_info;
                } else if ($work_info['status'] == 3) {
                    $my_work_list[] = $work_info;
                }
            }
        }
        return array(
                'my_work_list' => $my_work_list,
                'my_queue_work_list' => $my_queue_work_list
            );
    }

    function update_work_hours($worker_id, $work_id, $work_hours_json, $work_status) {
        if ($work_hours_json != '') {
            //delete already exist hours .
            $sql  = 'DELETE FROM ltno_works_hours';
            $sql .= ' WHERE 1';
            $sql .= ' AND worker_id=\'' . $worker_id . '\'';
            $sql .= ' AND work_id=\'' . $work_id . '\'';
            $this->db->query($sql);

            //record new work hours
            $work_hours = json_decode($work_hours_json, true);
            foreach ($work_hours as $work_hour) {
                $sql  = 'INSERT INTO ltno_works_hours SET';
                $sql .= '  worker_id=\'' . $worker_id . '\'';
                $sql .= ', work_id=\'' . $work_id . '\'';
                $sql .= ', work_date=\'' . $work_hour['work_history_date'] . '\'';
                $sql .= ', work_start_time=\'' . $work_hour['work_history_start_time'] . '\'';
                $sql .= ', work_end_time=\'' . $work_hour['work_history_end_time'] . '\'';
                $sql .= ', work_norm=\'' . $work_hour['work_history_norm'] . '\'';
                $sql .= ', work_50=\'' . $work_hour['work_history_50'] . '\'';
                $sql .= ', work_100=\'' . $work_hour['work_history_100'] . '\'';
                $sql .= ', work_150=\'' . $work_hour['work_history_150'] . '\'';
                $sql .= ', work_300=\'' . $work_hour['work_history_300'] . '\'';
                $this->db->query($sql);
            }
        }

        if ($work_status != '') {
            $sql  = 'UPDATE ltno_works SET';
            $sql .= ' status=\'' . $work_status . '\'';
            $sql .= ' WHERE id=\'' . $work_id . '\'';
            $this->db->query($sql);
        }
    }

    function get_time_sheet($start_date, $end_date) {
        $user_id = $this->session->userdata('user_id');
        $worker_id = $this->get_workerid_from_userid ($user_id);

        $sql  = 'SELECT * FROM ltno_works_hours';
        $sql .= ' WHERE 1';
        $sql .= ' AND worker_id=\'' . $worker_id . '\'';
        $sql .= ' AND work_date >= \'' . $start_date . '\'';
        $sql .= ' AND work_date <= \'' . $end_date . '\'';
        $sql .= ' ORDER BY work_date ASC';
        $query = $this->db->query($sql);
        $result = array();
        foreach ($query->result() as $row) {
            $unit_array = array();
            $unit_array['work_date'] = $row->work_date;

            $work_query = $this->db->query('SELECT * FROM ltno_works WHERE id=\'' . $row->work_id . '\'');
            $work_info_from_db = $work_query->row();
            $query = $this->db->query('SELECT client_name FROM ltno_clients WHERE id=\'' . $work_info_from_db->client_id . '\'');
            $unit_array['client_name'] = $query->row()->client_name;

            $query = $this->db->query('SELECT name FROM ltno_house WHERE id=\'' . $work_info_from_db->house_id . '\'');
            $house_name = isset($query->row()->name) ? $query->row()->name : '';
            $query = $this->db->query('SELECT name FROM ltno_house WHERE id=\'' . $work_info_from_db->room_id . '\'');
            $room_name = isset($query->row()->name) ? $query->row()->name : '';
            $unit_array['area'] = $house_name . ' ' . $room_name;
            $unit_array['work_number'] = $work_info_from_db->work_number;

            $work_type_query = $this->db->query('SELECT title FROM ltno_work_types WHERE id=\'' . $work_info_from_db->work_type_id . '\'');
            $unit_array['work_type'] = $work_type_query->row()->title;

            $unit_array['work_norm'] = $row->work_norm;
            $unit_array['work_50'] = $row->work_50;
            $unit_array['work_100'] = $row->work_100;
            $unit_array['work_150'] = $row->work_150;
            $unit_array['work_300'] = $row->work_300;
            $unit_array['status'] = $work_info_from_db->status;

            $result[$row->work_date][] = $unit_array;
        }

        return $result;
    }
}