<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Users Model
 * Business model of users module to manage CRUD operations between application layer and business layer
 *
 * @package     CodeIgniter 2.2.0

 * @ findAll()
 */

class LTNO_Model extends CI_Model {

	public $table = "";
	public $id = "id";

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get all results from table by some criteria
	 *
	 * @access public
	 * @param  (array)
	 * @return (object)
	 */

	public function findAll($criteria = array())
    {
        foreach ($criteria as $criteria_key => $criteria_value)
            if (isset($criteria_value['column']))
                $this->db->{$criteria_key}($criteria_value['column'], $criteria_value['value']);
            else
                $this->db->{$criteria_key}($criteria_value);

        $query = $this->db->get($this->table);
        
        return $query->result();
    }

    /**
	 * Get row from table by some criteria
	 *
	 * @access public
	 * @param  (array)
	 * @return (object)
	 */

    public function find($criteria = array())
    {
        foreach ($criteria as $criteria_key => $criteria_value)
            if (isset($criteria_value['column']))
                $this->db->{$criteria_key}($criteria_value['column'], $criteria_value['value']);
            else
                $this->db->{$criteria_key}($criteria_value);

        $query = $this->db->get($this->table);
        
        return $query->row();
    }

    /**
	 * Delete rows (row) from table by some criteria
	 *
	 * @access public
	 * @param  (array)
	 * @return (object)
	 */

    public function delete($criteria = array())
    {
    	foreach ($criteria as $criteria_key => $criteria_value)
            if (isset($criteria_value['column']))
                $this->db->{$criteria_key}($criteria_value['column'], $criteria_value['value']);
            else
                $this->db->{$criteria_key}($criteria_value);

        return $this->db->delete($this->table);
        
        return $query->row();
    }

    /**
     * Insert row to table
     *
     * @access public
     * @param  (assoc array)
     * @return (int) last id
     */

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Update table row
     *
     * @access public
     * @param  (assoc array)
     * @param  (assoc array)
     * @return void
     */

    public function update($data, $where = array())
    {
        $this->db->where($where);
        $this->db->update($this->table, $data);
    }

    /**
     * Get all results from table by some criteria
     *
     * @access public
     * @param  (array)
     * @return (object)
     */

    public function countAll($criteria = array())
    {
        foreach ($criteria as $criteria_key => $criteria_value)
            if (isset($criteria_value['column']))
                $this->db->{$criteria_key}($criteria_value['column'], $criteria_value['value']);
            else
                $this->db->{$criteria_key}($criteria_value);

        $query = $this->db->get($this->table);
        
        return $query->num_rows();
    }

}