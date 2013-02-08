<?php
class Validation_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_results($data)
	{
		//$option = $data['option'];
		$search = $data['search'];
		
		$this->db->like('role', 2);
		$this->db->like('id', $search);
		$this->db->like('role', 2);
		$this->db->or_like('username', $search, 'after');
		$this->db->like('role', 2);
		$this->db->or_like('firstname', $search, 'both');
		$this->db->like('role', 2);
		$this->db->or_like('lastname', $search, 'after');
		
		/*
		if($option == "id")
		{
			$this->db->where('id', $search);
			$query = $this->db->get('users');
		}
		elseif($option == "username")
		{
			$this->db->like('username', $search);
			$query = $this->db->get('users');			
		}
		elseif($option == "firstname")
		{
			$this->db->like('firstname', $search);
			$query = $this->db->get('users');			
		}
		else	// ($option == "lastname")
		{
			$this->db->like('lastname', $search);
			$query = $this->db->get('users');			
		}*/
		
		$query = $this->db->get('users');
		return $query;
	}
	
	public function get_courses($e)
	{		
		$search = $e['id'];
		$this->db->where('id', $search);
		$query = $this->db->get('courses');
		
		return $query;
	}
	
	public function get_mobile($data)
	{
		/*
		SELECT m.number
		FROM users u, mobilenumbers m
		WHERE u.id = id AND u.id = m.user_id;
		*/
		
		$search = $data['search'];
		$select = "M.number";
		$from = "users U, mobilenumbers M";
		$where = "u.id = $search AND u.id = m.user_id";
		
		$this->db->select($select);	
		$this->db->from($from);
		$this->db->where($where);
		
		$query = $this->db->get();
		
		return $query;	
	}
	
	public function get_reserved($param)
	{
		/*
		SELECT C.name
		FROM courses C, reserved R, users U
		WHERE U.id = id AND U.id = R.user_id AND C.id = R.course_id;
		*/
		
		$search = $param['id'];
		$select = "C.id, C.name, C.description, C.cost, C.start, C.end, C.reserved, C.available, C.paid";
		$from = "courses C, reserved R, users U";
		$where = "U.id = $search AND U.id = R.user_id AND C.id = R.course_id";
		
		$this->db->select($select);	
		$this->db->from($from);
		$this->db->where($where);
		
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_cashed($param)
	{
		/*
		SELECT C.name
		FROM courses C, cashpayment P, users U
		WHERE U.id = 1 AND U.id = P.user_id AND C.id = P.course_id;
		*/
		
		$search = $param['id'];
		$select = "C.id, C.name, C.description, C.cost, C.start, C.end, C.reserved, C.available, C.paid";
		$from = "courses C, cashpayment P, users U";
		$where = "U.id = $search AND U.id = P.user_id AND C.id = P.course_id";
		
		$this->db->select($select);	
		$this->db->from($from);
		$this->db->where($where);
		
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_banked($param)
	{
		/*
		SELECT C.name
		FROM courses C, bankpayment B, users U
		WHERE U.id = 1 AND U.id = B.user_id AND C.id = B.course_id;
		*/
		
		$search = $param['id'];
		$select = "C.id, C.name, C.description, C.cost, C.start, C.end, C.reserved, C.available, C.paid";
		$from = "courses C, bankpayment B, users U";
		$where = "U.id = $search AND U.id = B.user_id AND C.id = B.course_id";
		
		$this->db->select($select);	
		$this->db->from($from);
		$this->db->where($where);
		
		$query = $this->db->get();
		
		return $query;
	}
	
	public function get_refund($param)
	{
		/*
		SELECT C.course_id
		FROM cancelled C
		WHERE C.user_id = 1 AND C.refunded = -1;
		*/
		
		$search = $param['id'];
		$select = "C.course_id";
		$from = "cancelled C";
		$where = "C.user_id = $search AND C.refunded = -1";
		
		$this->db->select($select);	
		$this->db->from($from);
		$this->db->where($where);
		
		$query = $this->db->get();
		
		return $query;
	}
	
	public function make_payment($data)
	{
		$cbn = $data['cbn'];
		
		if($cbn == 1)
		{
			$this->db->set('user_id', $data['user_id']);
			$this->db->set('course_id', $data['course_id']);
			$this->db->set('ornumber', $data['ornumber']);
			$this->db->set('amount', $data['amount']);
			//$this->db->set('date', datetime("Y-m-d H:M:S"));			
			$this->db->insert('cashpayment');
		}
		else
		{
			$this->db->set('user_id', $data['user_id']);
			$this->db->set('course_id', $data['course_id']);
			$this->db->set('bankname', $data['bankname']);
			$this->db->set('bankbranch', $data['bankbranch']);
			$this->db->set('transaction_id', $data['transaction_id']);
			//$this->db->set('date', datetime("Y-m-d H:M:S"));			
			$this->db->insert('bankpayment');
		}
		
		$a = $data['reserved'];
		$b = $data['paid'];
		$c = $data['course_id'];
		$a--;
		$b++;
		
		$data = array('reserved' => $a, 'paid' => $b);
		
		$this->db->where('id', $c);
		$this->db->update('courses', $data); 
	}
	
}