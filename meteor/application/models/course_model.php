<?php
class course_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	
	public function record_count()
	{
		return $this->db->count_all('courses');
	}
	
	public function fetch_users( $id )
	{
		$query = $this->db->get_where('reserved', array('course_id' => $id) );
		return $query;
	}
	
	public function fetch_cancelled( $id )
	{	
		$query = $this->db->get_where('cancelled', array('course_id' => $id) );
		return $query;
	}
	
	public function fetch_courses( $letter, $limit, $start )
	{
		$where = "name LIKE '$letter%'";
		$this->db->where( $where );
		$this->db->order_by( 'name', 'ASC' );
		
		$query = $this->db->get('courses', $limit, $start );
		return $query->result_array();
	}
	
	public function fetch_courses_cancelled( $letter, $limit, $start )
	{
		$select = "C.id, C.name, C.description, C.start, C.end, C.paid, C.available, C.venue, C.cost";
		$from = "courses C, cancelled Ca";
		$where = "C.name LIKE '$letter%' AND C.id = Ca.course_id";
		$this->db->select( $select );
		$this->db->from( $from );
		$this->db->where( $where );		
		$this->db->order_by( 'C.name', 'ASC' );
		
		$query = $this->db->get();//'', $limit, $start );
		return $query->result_array();
	}
	
	public function get_courses( $slug = FALSE )
	{
		if( $slug === FALSE )
		{
			$query = $this->db->get('courses');
			return $query->result_array();
		}
		
		$query = $this->db->get_where( 'courses', array('slug' => $slug) );
		return $query->row_array();
	}
	
	public function get_managers( $slug = FALSE )
	{
		if ($slug === FALSE)
		{
			$query = $this->db->get_where('users', array('role' => 1));
			return $query->result_array();
		}
		
		$query = $this->db->get_where('users', array('slug' => $slug));
		return $query->row_array();
	}
	
	public function get_cancelledCourses( $slug = FALSE )
	{
		if ($slug === FALSE)
		{
			$query = $this->db->get('cancelled');
			return $query->row_array();
		}
		
		$query = $this->db->get_where('cancelled', array('slug' => $slug));
		return $query->row_array();
	}
	
	public function get_reservedCourses( $slug = FALSE )
	{
		if ($slug === FALSE)
		{
			$query = $this->db->get('reserved');
			return $query->row_array();
		}
		
		$query = $this->db->get_where('reserved', array('slug' => $slug));
		return $query->row_array();
	}
	
	public function set_courses()
	{
		$this->load->helper('url');
		$slug = url_title($this->input->post('title'), 'dash', TRUE);
		
		//INSERT INTO `courses`(`name`, `description`, `cost`, `start`, `end`, `available`, `reserved`, `paid`) 
		//VALUES ('CS191', 'Software Engineering ', '3000', '12-12-12', '12-03-13', 1, 1, 1);
		
		$numOfData = 0;
		
		for($i = 0; $i < 5; $i++) {
			if( !empty($_POST['name'][$i]) ){
				$index[$numOfData] = $i;
				$numOfData++;
			}
		}
		
		for( $j = 0, $k = $index[$j]; $j < $numOfData; $j++ ) {
			$data[] = array(
				'name' 			=> $_POST['name'][$k],
				'description' 	=> $_POST['description'][$k],
				'start' 		=> $_POST['start'][$k],
				'end' 			=> $_POST['end'][$k],
				'venue'			=> $_POST['venue'][$k],
				'cost' 			=> $_POST['cost'][$k],
				'available'		=> $_POST['available'][$k]
			);
		}
		
		$dataCount = count($data);
		if($dataCount) {
			$this->db->insert_batch('courses', $data);
		}
		else{
			for ($i=0, $x=$index[$i];$i<$numOfData;$i++) {
				$query = $this->db->get_where('courses', array('name' => $_POST['name'][$x]));
				$array = $query->row_array();
							
				$this->db->set('name', $array['name']);
				$this->db->set('description', $array['description']);
				$this->db->set('start', $array['start']);
				$this->db->set('end', $array['end']);
				$this->db->set('cost', $array['cost']);
				$this->db->set('venue', $array['venue']);
				$this->db->set('available', $array['available']);
				$this->db->insert('courses');	
			}
		}		
		return true; 
	}
	
	public function set_cancelledStatus()
	{
		$this->load->helper('url');
		$slug = url_title($this->input->post('title'), 'dash', TRUE);
				
		$query = $this->db->get_where('cancelled', array('course_id' => $_POST['course_id']));
		$array = $query->row_array();
		
		if( empty( $array['id']) ){
			$continue = FALSE; $continue1 = FALSE;
			if( !$this->check_paid( $_POST['course_id'] ) ) $continue = TRUE;
			if( !$this->check_reserved( $_POST['course_id'] ) ) $continue1 = TRUE;
			if( $continue && $continue1 ){
				$data = array(
					'course_id' => $this->input->post('course_id'),
					'user_id' 	=> $this->input->post('user_id'),
					'date'		=> $this->input->post('date'),
					'refunded'	=> $this->input->post('refunded')
				);				
				$this->db->insert('cancelled', $data);
			}
		}	
		return;
	}
	
	private function check_paid( $data )
	{
		$query = $this->db->get_where('bankpayment', array('course_id' => $data));
		$array1 = $query->row_array();
		
		$query1 = $this->db->get_where('cashpayment', array('course_id' => $data));
		$array2 = $query1->row_array();
		
		if( !empty( $array1['id']) || !empty( $array2['id']) ){	
			if( !empty( $array1['id']) ) $this->paid( $query, 1 );
			if( !empty( $array2['id']) ) $this->paid( $query1, 0 );
			return TRUE;
		}
		return FALSE;
	}
	
	private function paid( $data, $bool ){
		foreach( $data->result() as $row ){
			$query1 = $this->db->get_where('cancelled', array('user_id' => $row->user_id));
			$array = $query1->row_array();
			echo $row->id;
			$this->db->set('course_id', $row->course_id);
			$this->db->set('user_id', $row->user_id);
			$this->db->set('date', $this->input->post('date'));
			$this->db->set('refunded', 1); // refunded = 1 means paid
			$this->db->insert('cancelled');	
			
			if( $bool )	$this->db->delete('bankpayment', array('course_id' => $row->course_id) );
			else $this->db->delete('cashpayment', array('course_id' => $row->course_id) );
		}
	}
	
	public function get_results($data, $place)
	{
		$search = $data['search'];
		//if( $place === 'courses' ) {
			$where = "id LIKE '%$search%' OR name LIKE '%$search%' OR description LIKE '%$search%' 
			OR venue LIKE '%$search%' OR start LIKE '%$search%' OR end LIKE '%$search%' OR cost LIKE '%$search%'";
		//}
		$this->db->where($where);
		$query = $this->db->get($place);
				
		return $query;
	}
	
	private function check_reserved( $data )
	{
		$query = $this->db->get_where('reserved', array('course_id' => $data));
		$array1 = $query->row_array();
		if( !empty( $array1['id']) ){				
			foreach( $query->result() as $row ){
				$query1 = $this->db->get_where('cancelled', array('user_id' => $row->user_id));
				$array = $query1->row_array();
				
				if( empty( $array['id'] ) ){
					$this->db->set('course_id', $row->course_id);
					$this->db->set('user_id', $row->user_id);
					$this->db->set('date', $this->input->post('date'));
					$this->db->set('refunded', -1); // refunded = -1 means reserved
					$this->db->insert('cancelled');	
				}
				$this->db->delete('reserved', array('course_id' => $row->course_id) );
			}
			return TRUE;
		}
		return FALSE;
	}
	
	public function updateOldCourses($date, $userid){
	
		$query = $this->db->get_where('courses');
		$array = $query->result_array();

		foreach( $array as $row){
		
			if($row['end'] <= $date){
								
				$this->db->set('user_id', $userid); 
				$this->db->set('course_id', $row['id']); 
				$this->db->insert('completed');	
				
			}
		
		}	
	}
}