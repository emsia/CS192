<?php
class manager_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_results($data)
	{
		//$option = $data['option'];
		$search = $data['search'];

		/*	
		SELECT U.id, U.username, U.firstname, U.lastname, M.status
		FROM users U, managers M
		WHERE U.id = M.user_id;
		*/
		/*
		if($option == "id")
		{
			$select = "U.id, U.username, U.firstname, U.lastname, M.status";
			$from = "users U, managers M";
			$where = "U.id = $search AND U.id = M.user_id";
		}	
		elseif($option == "username")
		{
			$select = "U.id, U.username, U.firstname, U.lastname, M.status";
			$from = "users U, managers M";
			$where = "U.username = $search AND U.id = M.user_id";			
		}
		elseif($option == "firstname")
		{
			$select = "U.id, U.username, U.firstname, U.lastname, M.status";
			$from = "users U, managers M";
			$where = "U.firstname = $search AND U.id = M.user_id";			
		}
		elseif($option == "lastname")
		{
			$select = "U.id, U.username, U.firstname, U.lastname, M.status";
			$from = "users U, managers M";
			$where = "U.lastname = $search AND U.id = M.user_id";				
		}
		else	// ($option == "status")
		{
			$select = "U.id, U.username, U.firstname, U.lastname, M.status";
			$from = "users U, managers M";
			$where = "M.status = $search AND U.id = M.user_id";			
		}
		*/
		
		$select = "U.id, U.username, U.firstname, U.lastname, M.status";
		$from = "users U, managers M";
		if(is_numeric($search)) 
		{
			$where = "U.id = M.user_id AND U.role = 1 AND (U.id = $search OR M.status = $search) ";
		}
		else
		{
			$where = "U.id = M.user_id AND U.role = 1 AND (U.firstname LIKE '%$search%' OR U.username LIKE '$search%' OR U.lastname LIKE '$search%' )";
		}
		
		$this->db->select($select);
		$this->db->from($from);
		$this->db->where($where);
		
		$query = $this->db->get();
		return $query;
	}
	
	public function get_managers($slug = FALSE)
	{
		if ($slug === FALSE)
		{
			$query = $this->db->get_where('users', array('role' => 1));
			return $query->result_array();
		}
		
		$query = $this->db->get_where('users', array('slug' => $slug));
		return $query->row_array();
	}	
	
	
	public function set_managers()
	{
		$this->load->helper('url');
		
		$slug = url_title($this->input->post('title'), 'dash', TRUE);


//INSERT INTO `users`(`username`, `password`, `firstname`, `lastname`, `role`, `verified`) 
//VALUES ('user2@email.com', 'password', 'User', 'Two', 2, 1);
		
		$numOfdata=0;
		
		for($j=0; $j<5; $j++){
			if(!empty($_POST['email'][$j])){
			$index[$numOfdata] = $j;
			$numOfdata++;
			}
		}
	
		for ($i=0, $x=$index[$i];$i<$numOfdata;$i++) {
			
			$data[] = array(
				   'username' => $_POST['email'][$x],
				   'password' => sha1($_POST['password'][$x]),
				   'firstname' => $_POST['firstname'][$x],
				   'lastname' => $_POST['lastname'][$x],
				   'role' => 1,
				   'verified' => 1,
				   'slug' => $slug
				);					
			
		}

		$dataCount = count($data);
		
		if($dataCount){
			$this->db->insert_batch('users', $data);
		}
			
		for ($i=0, $x=$index[$i];$i<$numOfdata;$i++) {
			$query = $this->db->get_where('users', array('username' => $_POST['email'][$x]));
			$array = $query->row_array();
						
			$this->db->set('user_id', $array['id']); 
			$this->db->set('status', 1); 
			$this->db->insert('managers');	
		}		
		
		return; 
	}
		
		public function set_managerstatus()
		{
			$this->load->helper('url');
			
			$data = array(
				'status' => 1
			);
			
			$data2 = array(
				'status' => 0	
			);
			
			$this->db->where('user_id', $_POST['user_id']);
			
			if($_POST['status'] == 0) $this->db->update('managers', $data);
			else $this->db->update('managers', $data2);

			return;
		}
}

