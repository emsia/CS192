<?php
class participantcourse extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('course_model');
		$this->load->model('participantuser_model');
		$this->load->model('login_model');
		$this->load->library('session');
		$this->load->helper('url');
		
		if($this->islogged() == false){
			redirect("http://meteor.upitdc.edu.ph/index.php/pages");
		}
		if(!$this->login_model->isValid($this->session->userdata('username'))){
			redirect("http://meteor.upitdc.edu.ph/index.php/pages/invalid");
		}
	}

	public function index()
	{			 
		$uid = $this->login_model->getuid($this->session->userdata('username'));
		$data['courses'] = $this->course_model->get_courses();
		$data['title'] = 'Reserved Courses';			
		
		$data['userid'] = $uid['id'];
		
		$this->updateEndCourses($data['userid']);
		
		$this->load->helper('url');

		$this->load->view('templates/indexparticipant', $data);
		$this->load->view('participantcourse/index', $data);
		$this->load->view('templates/footerparticipant');
	}

	
	public function upcoming()
	{		 
		$uid = $this->login_model->getuid($this->session->userdata('username'));
		$data['courses'] = $this->course_model->get_courses();
		
		$data['userid'] =$uid['id'] ;

		
		$data['title'] = 'Upcoming Courses';				
		
		$this->load->helper('url');

		$this->load->view('templates/indexparticipant', $data);
		$this->load->view('participantcourse/upcoming', $data);
		$this->load->view('templates/footerparticipant');
	}

	public function reserved()
	{		 
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = 'Reserve Course';
		$data['courses'] = $this->course_model->get_courses();
		
		$uid = $this->login_model->getuid($this->session->userdata('username'));
		$data['userid'] = $uid['id'];

		$this->load->helper('url');

		$this->form_validation->set_rules('user_id', 'User_id', 'required');
		$this->form_validation->set_rules('course_id', 'Course_id', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/indexparticipant', $data);
			$this->load->view('participantcourse/upcoming', $data);
			$this->load->view('templates/footerparticipant');
			
		}
		else
		{
			$this->participantuser_model->reservedCourse();
			
			$data['courses'] = $this->course_model->get_courses();
			
			$this->load->view('templates/indexparticipant', $data);
			$this->load->view('participantcourse/upcoming', $data);
			$this->load->view('templates/footerparticipant');
		}
	}
	
	public function unreserved()
	{
		 
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = 'Reserve Course';
		$data['courses'] = $this->course_model->get_courses();
		
		$uid = $this->login_model->getuid($this->session->userdata('username'));
		$data['userid'] = $uid['id'];
		
		$this->load->helper('url');

		$this->form_validation->set_rules('user_id', 'User_id', 'required');
		$this->form_validation->set_rules('course_id', 'Course_id', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/indexparticipant', $data);
			$this->load->view('participantcourse/index', $data);
			$this->load->view('templates/footerparticipant');
			
		}
		else
		{
			$this->participantuser_model->unreservedCourse();
			
			$data['courses'] = $this->course_model->get_courses();
			
			$this->load->view('templates/indexparticipant', $data);
			$this->load->view('participantcourse/index', $data);
			$this->load->view('templates/footerparticipant');
		}
	}
	
	public function search_find()
	{
		$data['search'] = $_POST['search'];
		$data['title'] = "Search Results";
		
		$result = $this->course_model->get_results($data, 'courses');

		$data['courses'] = $result->result_array();
		
		$this->load->helper('url');
		
		$this->load->view('templates/indexparticipant', $data);
		$this->load->view('participantcourse/view', $data);
		$this->load->view('templates/footerparticipant');
	}
	
	public function completed()
	{			 
		$uid = $this->login_model->getuid($this->session->userdata('username'));
		$data['courses'] = $this->course_model->get_courses();
		$data['title'] = 'Completed Courses';			
		$data['userid'] = $uid['id'];
		
		$this->load->helper('url');

		$this->load->view('templates/indexparticipant', $data);
		$this->load->view('participantcourse/completed', $data);
		$this->load->view('templates/footerparticipant');
	}
	
	public function view()
	{			 
		$uid = $this->login_model->getuid($this->session->userdata('username'));
		$data['courses'] = $this->course_model->get_courses();
		$data['title'] = 'View Courses';			
		$data['userid'] = $uid['id'];
		
		$this->load->helper('url');

		$this->load->view('templates/indexparticipant', $data);
		$this->load->view('participantcourse/view', $data);
		$this->load->view('templates/footerparticipant');
	}
	
	public function search_reserved(){
		$data['search'] = $_POST['search'];
		$data['title'] = "Search Reserved";
		$a = array();
		$a['counter']=0;
		
		$uid = $this->login_model->getuid($this->session->userdata('username'));
		$data['userid'] = $uid['id'];
		
		$result = $this->course_model->get_results($data, 'courses');

		foreach($result->result() as $row)
		{
			$a['id'][] = $row->id;
			$a['name'][] = $row->name;
			$a['description'][] = $row->description;
			$a['start'][] = $row->start;
			$a['end'][] = $row->end;
			$a['venue'][] = $row->venue;
			$a['cost'][] = $row->cost;
			$a['reserved'][] = $row->reserved;
			$a['available'][] = $row->available;
			$a['paid'][] = $row->paid;
			$a['counter']++;
		}
		
		$this->load->helper('url');
		
		$this->load->view('templates/indexparticipant', $data);
		$this->load->view('participantcourse/search_reserved', $a);
		$this->load->view('templates/footerparticipant');
	}
	
	public function search_upcoming(){
		$data['search'] = $_POST['search'];
		$data['title'] = "Search Upcoming";
		$a = array();
		$a['counter']=0;
		
		$uid = $this->login_model->getuid($this->session->userdata('username'));
		$data['userid'] = $uid['id'];
				
		$result = $this->course_model->get_results($data, 'courses');

		foreach($result->result() as $row)
		{
			date_default_timezone_set("Asia/Manila");											
			$date = date('Y-m-d G:i:s');
			
			$query = $this->db->get_where( 'reserved', array('course_id' => $row->id, 'user_id' => $data['userid'] ) );
			$row2 = $query->result_array();
			
			$query3 = $this->db->get_where('cancelled', array('course_id' => $row->id) );
			$row3 = $query3->row_array();	
			
			if( empty( $row2['id'] ) && empty( $row3['id'] ) && ($row->end > $date) ){
				$a['id'][] = $row->id;
				$a['name'][] = $row->name;
				$a['description'][] = $row->description;
				$a['start'][] = $row->start;
				$a['end'][] = $row->end;
				$a['venue'][] = $row->venue;
				$a['cost'][] = $row->cost;
				$a['reserved'][] = $row->reserved;
				$a['available'][] = $row->available;
				$a['paid'][] = $row->paid;
				$a['counter']++;
			}
		}
		
		$this->load->helper('url');
		
		$this->load->view('templates/indexparticipant', $data);
		$this->load->view('participantcourse/search_upcoming', $a);
		$this->load->view('templates/footerparticipant');
	}
	
	public function search_completed(){
		$data['search'] = $_POST['search'];
		$data['title'] = "Search Completed";
		$a = array();
		$a['counter']=0;
		
		$uid = $this->login_model->getuid($this->session->userdata('username'));
		$data['userid'] = $uid['id'];
				
		$result = $this->course_model->get_results($data, 'courses');

		foreach($result->result() as $row)
		{
			date_default_timezone_set("Asia/Manila");											
			$date = date('Y-m-d G:i:s');
			
			$query = $this->db->get_where( 'reserved', array('course_id' => $row->id, 'user_id' => $data['userid'] ) );
			$row2 = $query->result_array();
			
			if( empty( $row2['id'] ) && ($row->end < $date) ){
				$a['id'][] = $row->id;
				$a['name'][] = $row->name;
				$a['description'][] = $row->description;
				$a['start'][] = $row->start;
				$a['end'][] = $row->end;
				$a['venue'][] = $row->venue;
				$a['cost'][] = $row->cost;
				$a['reserved'][] = $row->reserved;
				$a['available'][] = $row->available;
				$a['paid'][] = $row->paid;
				$a['counter']++;
			}
		}
		
		$this->load->helper('url');
		
		$this->load->view('templates/indexparticipant', $data);
		$this->load->view('participantcourse/search_completed', $a);
		$this->load->view('templates/footerparticipant');
	}
}