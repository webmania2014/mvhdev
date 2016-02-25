<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * App Model
 * Business model of application to manage CRUD operations between system and other modules
 *
 * @package     CodeIgniter 2.2.0
 * @ get_languages()
 * @ get_system_languages()
 * @ get_language_by_locale()
 * @ get_countries()
 * @ get_country_ids()
 * @ get_country_codes()
 * @ get_country_by_id()
 * @ get_country_by_iso()
 * @ get_softwares()
 * @ get_expertise_fields()
 * @ get_subjects()
 * @ check_setting_key()
 * @ add_information_api()
 * @ get_absence_types()
 */

class App_model extends CI_model {

	/**
	 * Get the languages of translation
	 *
	 * @access public
	 * @return (array) Returns all available languages object
	 */
     
     function get_worker_types(){
        $sql = 'select * from ltno_type_of_worker';
        $query = $this->db->query($sql);
        return $query->result();
     }
     
     function get_clients(){
        $sql = 'select * from ltno_clients';
        $query = $this->db->query($sql);
        return $query->result();
     }
     
     function get_projects(){
        $sql = 'select * from ltno_projects';
        $query = $this->db->query($sql);
        return $query->result();
     }
     
     function get_users(){
        $sql = 'select * from ltno_users';
        $query = $this->db->query($sql);
        return $query->result();
     }
     function get_all_material(){
        $sql = 'select * from ltno_materials';
        $query = $this->db->query($sql);
        return $query->result();
     }
     function get_offers(){
        $sql = 'select * from ltno_offers';
        $query = $this->db->query($sql);
        return $query->result();
     }
     function get_type_works(){
        $sql = 'select * from ltno_work_types where parent_id = 0';
        $query = $this->db->query($sql);
        return $query->result();
     }
     function get_all_kinds(){
        $sql = 'select * from ltno_kinds';
        $query = $this->db->query($sql);
        return $query->result();
     }
     function get_all_rental_scaffold_types(){
        $sql = 'select * from ltno_scaffold_types';
        $query = $this->db->query($sql);
        return $query->result();
     }
     function get_all_work_scaffold_types(){
        $sql = 'select * from ltno_scaffold_types where is_scaffold = 0';
        $query = $this->db->query($sql);
        return $query->result();
     }
     function get_areas(){
        $sql = 'select * from ltno_areas where parent_id = 0';
        $query = $this->db->query($sql);
        return $query->result();
     }
     function get_all_workers(){
        $sql = 'select * from ltno_workers';
        $query = $this->db->query($sql);
        return $query->result();
     }
     function get_all_responsive_sv(){
        $sql = 'select * from ltno_workers where type_of_work_id = 1 or type_of_work_id = 2';
        $query = $this->db->query($sql);
        return $query->result();
     }
     function get_sub_contractors(){
        $sql = 'select * from ltno_sub_contractors';
        $query = $this->db->query($sql);
        return $query->result();
     }
     function get_all_suppervisors(){
        $sql = "select * from ltno_workers where type_of_work_id = 1";
        $suppervisors = $this->db->query($sql);
        return $suppervisors->result();
     }
     
     function get_all_foremans(){
        $sql = "select * from ltno_workers where type_of_work_id = 5";
        $suppervisors = $this->db->query($sql);
        return $suppervisors->result();
     }
     function get_all_house(){
        $sql = "select * from ltno_house where parent_id = 0";
        $houses = $this->db->query($sql);
        return $houses->result();
     }
     function get_all_room($parent_id){
        $sql = "select * from ltno_house where parent_id = '$parent_id";
        $houses = $this->db->query($sql);
        return $houses->result();
     }
     function check_user_is_supervisor($user_id){
        $sql = "select * from ltno_workers where user_id = '$user_id'";
        $worker = $this->db->query($sql);
        if($worker->type_of_work_id = 1){
            return true;
        }
        return false;
     }
     function get_works($offer_id){
        $sql = "c.client_name, c.client_number, c.id as client_id,
                o.offer_number, o.id as offer_id, 
                wt.id as work_type_id, wt.title as work_type, wts.title as sub_title, wts.id as sub_work_id, 
                w.id, w.work_number, w.rental_number, w.supervisor_id, w.date_start,
                w.date_will_start, w.sub_area_id , w.queue, w.status,
                a.area, a.id as area_id, na.area as sub_area_name";
        $this->db->select( $sql, false );
        $this->db->from( 'ltno_works' . ' AS w' );
        $this->db->join( 'ltno_clients' . ' AS c', 'w.client_id = c.id', 'left' );
        $this->db->join( 'ltno_offers' . ' AS o', 'w.offer_id = o.id', 'left' );
        $this->db->join( 'ltno_work_types' . ' AS wt', 'w.work_type_id = wt.id', 'left' );
        $this->db->join( 'ltno_work_types' . ' AS wts', 'w.sub_work_type_id = wts.id', 'left' );
        $this->db->join( 'ltno_areas' . ' AS a', 'w.area_id = a.id', 'left' );
        $this->db->join( 'ltno_areas' . ' AS na', 'w.sub_area_id = na.id', 'left' );
        $this->db->where( 'w.status', 1 );
        $this->db->where( 'w.status', 1 );
        $this->db->where( 'o.id', $offer_id );
        $query = $this->db->get();
        return $query->result();
     }
}

/* End */
/* Location: `application/models/app_model.php` */