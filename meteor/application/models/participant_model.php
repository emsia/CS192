<?php
class participant_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_participant( $slug = FALSE )
	{
		if( $slug === FALSE ){
			$query = $this->db->get_where( 'users', array('role' => 2) );
			return $query->result_array();
		}
		
		$query = $this->db->get_where( 'users', array('role' => 2) );
		return $query->result_array();
	}
	
	public function get_userid(  )
	{
		
		$query = $this->db->get_where( 'users', array('id' => $_POST['user_id']) ); 
		 return  $query->row_array();
	}
	
	

}
