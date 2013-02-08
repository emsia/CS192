<?php
class login_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->library(array('email'));
		$config = array('hostname' => 'localhost',
						'username' => 'meteor',
						'password' => 'xpF7mBWqMtvJUpt9',
						'database' => 'meteor',
						'dbdriver' => 'mysql',
						'pconnect' => TRUE,
						'db_debug' => TRUE,
						'cache_on' => FALSE,
						'char_set' => 'utf8',
						'dbcollat' => 'utf8_general_ci',
						'autoinit' => TRUE,
						'stricton' => FALSE
					);
		$this->load->database($config);
	}
	
	function verifyLog($uname,$pword){
		$query = $this->db->get_where('users',array('username' => $uname));
		foreach($query->result() as $row){
			$hash = sha1($pword);
			if($uname === $row->username && $hash === $row->password) 
				return true;
		}
		return false;
	}
	
	function putData(){
		$hpass = sha1($this->input->post('pass'));
		$email = $this->input->post('mail');
		$id = $this->saltgen(25);
		
		$data = array(
			'username' => $email,
			'password' =>  $hpass,
			'firstname' => $this->input->post('fname'),
			'lastname' => $this->input->post('lname'),
			'role' => 2,
			'slug' => $id
		);
		
		$this->db->insert('users', $data);
		$this->sendvalid($id,$email);
	}
	
	public function sendvalid($ident,$mail){
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'meteor.upitdc@gmail.com',
			'smtp_pass' => 'einstein123',
		);
		$this->load->library('email',$config);
		$this->email->set_newline("\r\n");
	
		$this->email->to($mail);
		$this->email->from('noreply@MeTEOR.com','MeTEOR Validator');
		$this->email->subject('Confirm Validation');
		$this->email->message('Thank you for registering. Please click the proceeding link to confirm your registration: http://meteor.upitdc.edu.ph/index.php/validate/' . $ident);
		if(!$this->email->send()){
			echo $this->email->print_debugger();
		}
	}
	
	function setValidation($ident){
		$this->db->where('slug',$ident);
		$this->db->update('users',array('verified' => 1));
		$query = $this->db->get_where('users',array('slug' => $ident));
		return $query->row_array();
	}
	
	function isValid($user){
		$query = $this->db->get_where('users',array('username' => $user));
		$row = $query->row_array();
		if($row['verified'] == 1){
			return true;
		}
		return false;
	}

	function getuid($name){
		$query = $this->db->get_where('users',array('username' => $name));
		return $query->row_array();
	}
	
	function getuser($pw){
		$query = $this->db->get_where('users',array('password' => $pw));
		return $query->row_array();
	}
	
	function forgot($user){
		$query = $this->db->get_where('users',array('username' => $user));
		$row = $query->row_array();
		$rand = $this->saltgen(25);
		if(empty($row['username'])){
			return false;
		}
		else{
			$this->db->update('users',array('password' => $rand),array('username' => $user));
			$this->sendpass($rand,$user);
			return true;
		}
	}
	
	public function sendpass($ident,$mail){
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'meteor.upitdc@gmail.com',
			'smtp_pass' => 'einstein123',
		);
		$this->load->library('email',$config);
		$this->email->set_newline("\r\n");
	
		$this->email->to($mail);
		$this->email->from('noreply@MeTEOR.com','MeTEOR Validator');
		$this->email->subject('Confirm Validation');
		$this->email->message('Please click to change password: http://meteor.upitdc.edu.ph/index.php/forgot/' . $ident);
		if(!$this->email->send()){
			echo $this->email->print_debugger();
		}
	}
	
	function isReal($rand){
		$query = $this->db->get_where('users',array('password' => $rand));
		$row = $query->row_array();
		if(empty($row)){
			return false;
		}
		return true;
	}

	private function saltgen($max){
        $characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $i = 0;
        $salt = "";
        while ($i < $max) {
            $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
            $i++;
        }
        return $salt;
	}
}