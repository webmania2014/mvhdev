<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Acceptance_model extends CI_Model{
    function get_workers() {
        $workers = array();
        $query = $this->db->query('SELECT id, first_name, last_name FROM ltno_workers');
        foreach ($query->result() as $row) {
            $workers[$row->id] = $row->first_name . ' ' . $row->last_name; 
        }
        return $workers;
    }

    function get_work_types() {
        $work_type = array();
        $query = $this->db->query('SELECT * FROM ltno_work_types');
        foreach ($query->result() as $row) {
            $work_type[$row->id] = $row->title;
        }
        return $work_type;
    }

    function get_time_sheet($worker_id, $start_date, $end_date) {
        $work_type_list = $this->get_work_types();
        $work_type_options = '';
        foreach ($work_type_list as $id => $title) {
            $work_type_options .= '
                <option value="' . $id . '">' . $title . '</option>
            ';
        }

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
            $unit_array['id'] = $row->id;
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

            $query = $this->db->query('SELECT * FROM ltno_works_hours_client WHERE work_hour_id=\'' . $row->id . '\'');
            $unit_array['work_norm_client'] = isset($query->row()->work_norm) ? $query->row()->work_norm : '';
            $unit_array['work_50_client']   = isset($query->row()->work_50) ? $query->row()->work_50 : '';
            $unit_array['work_100_client']  = isset($query->row()->work_100) ? $query->row()->work_100 : '';
            $unit_array['work_150_client']  = isset($query->row()->work_150) ? $query->row()->work_150 : '';
            $unit_array['work_300_client']  = isset($query->row()->work_300) ? $query->row()->work_300 : '';

            $unit_array['status'] = $row->accepted;

            $unit_array['work_type_options'] = $work_type_options;

            $result[$row->work_date][] = $unit_array;
        }

        return $result;
    }

    function save_work_hour($work_hours_list, $work_accepted) {
        foreach ($work_hours_list as $work_hour_info) {
            $work_hour_id       = $work_hour_info['id'];
            $work_activity      = $work_hour_info['work_activity'];
            $work_norm          = $work_hour_info['work_norm'];
            $work_50            = $work_hour_info['work_50'];
            $work_100           = $work_hour_info['work_100'];
            $work_150           = $work_hour_info['work_150'];
            $work_300           = $work_hour_info['work_300'];
            $work_norm_client   = $work_hour_info['work_norm_client'];
            $work_50_client     = $work_hour_info['work_50_client'];
            $work_100_client    = $work_hour_info['work_100_client'];
            $work_150_client    = $work_hour_info['work_150_client'];
            $work_300_client    = $work_hour_info['work_300_client'];

            $sql  = 'UPDATE ltno_works_hours SET';
            $sql .= '  work_norm=\'' . $work_norm . '\''; 
            $sql .= ', work_50=\'' . $work_50 . '\''; 
            $sql .= ', work_100=\'' . $work_100 . '\''; 
            $sql .= ', work_150=\'' . $work_150 . '\''; 
            $sql .= ', work_300=\'' . $work_300 . '\''; 
            $sql .= ', accepted=\'' . $work_accepted . '\'';
            $sql .= ' WHERE id=\'' . $work_hour_id . '\'';
            $query = $this->db->query($sql);

            $sql  = 'SELECT id FROM ltno_works_hours_client WHERE work_hour_id=\'' . $work_hour_id . '\'';
            $query = $this->db->query($sql);
            $exist = $query->num_rows();
            
            if ($exist) {
                $sql  = 'UPDATE ltno_works_hours_client SET ';
                $sql .= '  work_norm=\'' . $work_norm_client . '\''; 
                $sql .= ', work_50=\'' . $work_50_client . '\''; 
                $sql .= ', work_100=\'' . $work_100_client . '\''; 
                $sql .= ', work_150=\'' . $work_150_client . '\''; 
                $sql .= ', work_300=\'' . $work_300_client . '\''; 
                $sql .= ' WHERE work_hour_id=\'' . $work_hour_id . '\'';
                $query = $this->db->query($sql);
            } else {
                $sql  = 'INSERT INTO ltno_works_hours_client SET ';
                $sql .= '  work_hour_id=\'' . $work_hour_id . '\'';
                $sql .= ', work_norm=\'' . $work_norm_client . '\''; 
                $sql .= ', work_50=\'' . $work_50_client . '\''; 
                $sql .= ', work_100=\'' . $work_100_client . '\''; 
                $sql .= ', work_150=\'' . $work_150_client . '\''; 
                $sql .= ', work_300=\'' . $work_300_client . '\''; 
                $query = $this->db->query($sql);
            }

            $query = $this->db->query('SELECT work_id FROM ltno_works_hours WHERE id=\'' . $work_hour_id . '\'');
            $work_id = $query->row()->work_id;

            $sql  = 'UPDATE ltno_works SET';
            $sql .= '  work_type_id=\'' . $work_activity  . '\'';
            $sql .= ' WHERE id=\'' . $work_id . '\'';
            $query = $this->db->query($sql);
        }
    }
}