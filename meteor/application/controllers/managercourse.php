<?php
class managercourse extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('course_model');
		$this->load->library('pagination');
		$this->load->model('participant_model');
		$this->load->model('validation_model', 'vm');
		$this->load->library('calendar');
		
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
		 
		
		$this->load->helper('url');
		
		$letter = $this->uri->segment(3);
		echo $this->uri->segment(3);
		$data['letter'] = substr( $letter, 0 , 1 );
		
		$config = array();
		$config['total_rows'] = $this->course_model->record_count();
		$config['per_page'] = $this->course_model->record_count();
		$config['uri_segment'] = 3;		
		$config['num_links'] = 6;
		$config['page_query_string'] = FALSE;
		
		$config['base_url'] = base_url().'index.php/course/';
		$this->load->vars($data); 
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0 ;
		
		$data['courses'] = $this->course_model->fetch_courses( $data['letter'], $config['per_page'], $page);
		$data['users'] = $this->course_model->fetch_users( $data['letter'] );
		$data['cancelled'] = $this->course_model->get_cancelledCourses();
		$data['title'] = 'Course';
		
		$data['links'] = $this->pagination->create_links();		

		$this->load->view('templates/indexmanager', $data);
		$this->load->view('course/index', $data);
		$this->load->view('templates/footer');
		
	}
	
	public function alphabet(){
		$letter = $this->uri->segment(4);
		echo $this->uri->segment(4);
		if( isset($_POST['letter']) ){
			$var = $_POST['letter'];
			echo $var;
		}
		else echo "sadasdasd";	
	}
	
	public function view($slug)
	{		
		 
			$data['course_item'] = $this->course_model->get_courses($slug);
			$data['cancelled_item'] = $this->course_model->get_cancelledCourses($slug);
			
			if( empty($data['course_item']) )
			{
				show_404();
			}
			else if( empty($data['cancelled_item']) )
			{
				show_404();
			}
			
			$this->load->helper('url');
			
			$this->load->view('templates/indexmanager', $data);
			$this->load->view('course/view', $data);
			$this->load->view('templates/footer');
	}
	
	public function search_find(){
		$data['search'] = $_POST['search'];
		$data['title'] = "Search Results";
		$a = array();
		$a['counter']=0;

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
		
		$this->load->view('templates/indexmanager', $data);
		$this->load->view('course/search_find', $a);
		$this->load->view('templates/footer');
	}
	
	public function seeCancelled( $num ){
		 
		
		$data['title'] = 'Refund List';
		$this->load->helper('url');
		
		$data['id'] = $num;
		$a = array();
		
		$results = $this->course_model->fetch_cancelled( $num );
		$data['users'] = $results->result_array();
						
		$this->load->view('templates/indexmanager', $data);
		$this->load->view('course/participants', $data);
		$this->load->view('templates/footer');
	}
	
	public function process( $num )
	{
		 
		
		$data['title'] = 'Participants in a Course';
		$this->load->helper('url');
		
		$data['id'] = $num;
		$a = array();
		
		$results = $this->course_model->fetch_users( $num );
		$data['users'] = $results->result_array();
						
		$this->load->view('templates/indexmanager', $data);
		$this->load->view('course/participants', $data);
		$this->load->view('templates/footer');
	}
	
	public function add()
	{
		  
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$data['title'] = 'Add Course';	

			$this->form_validation->set_rules('name[0]', 'Name', 'required');
			$this->form_validation->set_rules('description[0]', 'Description', 'required');
			$this->form_validation->set_rules('start[0]', 'Start', 'required');
			$this->form_validation->set_rules('end[0]', 'End', 'required');		
			$this->form_validation->set_rules('cost[0]', 'Cost', 'required');
			$this->form_validation->set_rules('available[0]', 'Available', 'required');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('templates/indexmanager', $data);	
				$this->load->view('course/add');
				$this->load->view('templates/footer');
			}
			else
			{
				$this->course_model->set_courses();
				$this->index();
			}
		
	}	
	
	public function cancelledStatus()
	{
		 
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			
			$config = array(
				array(
					'field' => 'course_id',
					'label' => 'Course_id',
					'rules' => 'required'
				), 
				array(
					'field' => 'user_id',
					'label' => 'User_id',
					'rules' => 'required'
				),
				array(
					'field' => 'date',
					'label' => 'Date',
					'rules' => 'required'
				),
				array(
					'field' => 'refunded',
					'label' => 'Refunded',
					'rules' => 'required'
				)
			);
			
			$this->form_validation->set_rules($config);
			
			if( $this->form_validation->run() === FALSE )
			{	
				$this->load->view('templates/indexmanager', $data);	
				$this->load->view('course/index');
				$this->load->view('templates/footer');
				$this->index();
			}
			else
			{
				$this->course_model->set_cancelledStatus();
				$this->index();
			}
		
	}
	
	public function cancelled()
	{		
		  
			$data['courses'] = $this->course_model->get_courses();
			$data['cancelled'] = $this->course_model->get_cancelledCourses();
			
			$this->load->helper(array('form', 'url'));
			$data['title'] = 'Cancelled Courses';
			
			$this->load->view('templates/indexmanager', $data);	
			$this->load->view('course/cancelled');
			$this->load->view('templates/footer');
		
	}
	

	
}