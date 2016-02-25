<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Activity model
 * Business model of application to manage CRUD operations in activity module
 *
 * @package     CodeIgniter 2.2.0
 * @module      activity_module
 * @model       activity_model
 *
 * @ create_activity()
 * @ get_activity_by_id()
 * @ get_activities()
 * @ get_activities_by_user_id()
 * @ delete_activity()
 */

class Activity_model extends CI_model {
	/**
	 * Declare table name using for activity module.
	 *
	 * @access public
	 * @var    $table
	 */
	public $table = 'activities';

	/**
	 * Create an activity
	 *
	 * @access public
	 * @param  (string) $activity_text Activity text
	 * @param  (string) $activity_html Activity text with html format
	 * @param  (json) $params Parameters for activity text. Will be replace with printf() function
	 * @param  (int) $user_id User's ID which belongs to this activity
	 * @return (bool) TRUE if activity successfully created, otherwise FALSE
	 */
	function create_activity( $activity_text, $activity_html, $params, $user_id ) {
		/**
		 * Set expired date for 30 days from this date.
		 * Expired activities will be deleted automatically by CRON job
		 */
		$expires_date = date( 'Y-m-d H:i:s', strtotime( "+1 month", time() ) );

		// Prepare data
		$data = array(
			'activity_text'  => addslashes( $activity_text ),
			'activity_html'  => addslashes( $activity_html ),
			'params'         => $params,
			'user_id'        => $user_id,
			'created_date'   => date( 'Y-m-d H:i:s', time() ),
			'expire_date'    => $expires_date
		);

		// Add activity
		$this->db->insert( $this->db->dbprefix( $this->table ), $data );

		// Check data is entered correctly
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}

	/**
	 * Get an activity by it's ID
	 *
	 * @access public
	 * @param  (int) $activity_id ID of an activity
	 * @return (object) Activiy object
	 */
	function get_activity_by_id( $activity_id ) {
		// Prepare query
		$this->db->from( $this->db->dbprefix( $this->table ) );
		$this->db->where( 'id', $activity_id );
		$this->db->limit( 1 );

		$query = $this->db->get();

		return $query->row();
	}

	/**
	 * Get activities with specific limit and offset
	 *
	 * @access public
	 * @param  (int) $offset (Optional) Number of row to start read from table
	 * @param  (int) $limit (Optional) Limit of rows to read
	 * @param  (string) $order_by (Optional) Order by with specified column
	 * @param  (string) $order (Optional) Order of reading rows
	 * @return (array) Associative array with overall row numbers and results
	 */
	function get_activities( $offset = 0, $limit = 10, $order_by = 'created_date', $order = 'DESC' ) {
		// Prepare query
		$sel = "a.id, a.activity_text, a.activity_html, a.params, a.user_id, a.created_date";

		// Count total rows
		$count_sel = "COUNT(t.id) AS num_rows";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( $this->table ) . ' AS a' );
		$this->db->limit( $limit, $offset );
		$this->db->order_by( $order_by, $order );
		
		$query = $this->db->get();

		// Count total rows
		$this->db->select( $count_sel, false );
		$this->db->from( $this->db->dbprefix( $this->table ) . ' AS t' );
		
		$count_query = $this->db->get();

		$return_results = array( 
			'results'  => $query->result(), 
			'num_rows' => $count_query->row()->num_rows
		);

		return $return_results;
	}

	/**
	 * Get activities by user's ID. Get specific user activities.
	 *
	 * @access public
	 * @param  (int) $user_id User's ID to get the notifications
	 * @param  (int) $offset (Optional) Number of row to start read from table
	 * @param  (int) $limit (Optional) Limit of rows to read
	 * @param  (string) $order_by (Optional) Order by with specified column
	 * @param  (string) $order (Optional) Order of reading rows
	 * @return (array) Associative array with overall row numbers and results
	 */
	function get_activities_by_user_id( $user_id, $offset = 0, $limit = FALSE, $order_by = 'created_date', $order = 'DESC' ) {
		
		// Prepare query
		$sel = "a.id, a.activity_text, a.activity_html, a.params, a.user_id, a.created_date";

		// Count total rows
		$count_sel = "COUNT(t.id) AS num_rows";

		$this->db->select( $sel, false );
		$this->db->from( $this->db->dbprefix( $this->table ) . ' AS a' );
		$this->db->where( 'a.user_id', $user_id );

		if( $limit !== FALSE ) {
			$this->db->limit( $limit, $offset );
		}
		
		$this->db->order_by( $order_by, $order );
		
		$query = $this->db->get();

		// Count total rows
		$this->db->select( $count_sel, false );
		$this->db->from( $this->db->dbprefix( $this->table ) . ' AS t' );
		$this->db->where( 't.user_id', $user_id );
		
		$count_query = $this->db->get();

		$return_results = array( 
			'results'  => $query->result(), 
			'num_rows' => $count_query->row()->num_rows
		);

		return $return_results;
	}

	/**
	 * Delete an activity
	 *
	 * @access public
	 * @param  (int) $activity_id ID of activity to delete
	 * @return (bool) TRUE if activity successfully deleted, otherwise, FALSE
	 */
	function delete_activity( $activity_id ) {
		// Prepare query
		$data = array( 'id' => $activity_id );

		// Delete notification
		$this->db->where( $data );
		$this->db->delete( $this->db->dbprefix( $this->table ) );

		// Check data is deleted successfully
		return $this->db->affected_rows() > 0 && $this->db->_error_message() == 0;
	}
}

/* End */
/* Location: `application/modules/activity/models/activity_model.php` */