<?php
class participantuser_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
		public function reservedCourse()
		{
			$this->load->helper('url');
		
			
			$this->db->set('user_id',  $_POST['user_id']); 
			$this->db->set('course_id', $_POST['course_id']); 
			$this->db->set('date', $_POST['date']); 
			$this->db->insert('reserved');	
			
			$query = $this->db->get_where('courses', array('id' => $_POST['course_id']));
			$data = $query->row_array();
			
			$data = array(
               'reserved' => $data['reserved']++
            );

			$this->db->where('id', $_POST['course_id']);
			$this->db->update('courses', $data);
			
			return;
		}
		
		public function unreservedCourse()
		{
			$this->load->helper('url');
			
			
			$this->db->delete('reserved', array('user_id'=>  $_POST['user_id'], 'course_id' => $_POST['course_id'])); 
			
			$query = $this->db->get_where('courses', array('id' => $_POST['course_id']));
			$data = $query->row_array();
			
			$data = array(
               'reserved' => $data['reserved']--
            );

			$this->db->where('id', $_POST['course_id']);
			$this->db->update('courses', $data);
			
			return;
		}
		
		public function profileInfo( $userid )
		{
			$this->load->helper('url');
			
			$query = $this->db->get_where('users', array('id' => $userid ));
			return $query->row_array();			
		}
		
		public function profileAddr( $userid )
		{
			$this->load->helper('url');
			
			$query = $this->db->get_where('addresses', array('user_id' => $userid ));
			return $query->row_array();			
		}
		
		public function profileMobile( $userid )
		{
			$this->load->helper('url');
			
			$query = $this->db->get_where('mobilenumbers', array('id' => $userid ));
			return $query->row_array();			
		}
		
		
}

