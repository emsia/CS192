<?php
class managers extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('manager_model');
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
		 
		$data['title'] = 'Managers';
		$data['managers'] = $this->manager_model->get_managers();		
		
		$this->load->helper('url');

		$this->load->view('templates/indexadmin', $data);
		$this->load->view('managers/index', $data);
		$this->load->view('templates/footeradmin');
	}

	public function view($slug)
	{
		 
		$data['manager_item'] = $this->manager_model->get_managers($slug);		
		
		if (empty($data['manager_item']))
		{
			show_404();
		}

		$this->load->helper('url');
		
		$this->load->view('templates/indexadmin', $data);
		$this->load->view('managers/view', $data);
		$this->load->view('templates/footeradmin');
	}
	
	public function create()
	{
		 
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = 'Add Manager';
		$data['managers'] = $this->manager_model->get_managers();		
		
		$this->load->helper('url');
		
//-----------FORM VALIDATION STILL NOT PERFECT - ONLY CHECKS THE FIRST ROW------------------------------------//
		
		$this->form_validation->set_rules('firstname[0]', 'Firstname', 'required');
		$this->form_validation->set_rules('lastname[0]', 'Lastname', 'required');
		$this->form_validation->set_rules('email[0]', 'Email', 'required');
		$this->form_validation->set_rules('password[0]', 'Password', 'required');
			
		
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/indexadmin', $data);	
			$this->load->view('managers/create');
			$this->load->view('templates/footeradmin');
			
		}
		else
		{
			$this->manager_model->set_managers();
			
			$data['managers'] = $this->manager_model->get_managers();		
			
			$this->load->view('templates/indexadmin', $data);
			$this->load->view('managers/index', $data);
			$this->load->view('templates/footeradmin');

		}
	}
	
	public function search_find(){
		$data['search'] = $_POST['search'];
		$data['title'] = "Search Results";
		$a = array();
		$a['counter']=0;

		$result = $this->course_model->get_results($data, 'managers');

		foreach($result->result() as $row)
		{
			$a['id'][] = $row->id;
			$a['name'][] = $row->name;
			$a['username'][] = $row->username;
			$a['mobile_num'][] = $row->mobile_num;
			$a['status'][] = $row->status;
			
			$a['counter']++;
		}
		
		$this->load->helper('url');
		
		$this->load->view('templates/indexadmin', $data);
		$this->load->view('managers/search_find', $a);
		$this->load->view('templates/footeradmin');
	}
	
	public function status()
	{
		 
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = 'Manager Status';
		$data['managers'] = $this->manager_model->get_managers();	
		
		$this->load->helper('url');

		$this->form_validation->set_rules('user_id', 'User_id', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/indexadmin', $data);	
			$this->load->view('managers/index');
			$this->load->view('templates/footeradmin');
			
		}
		else
		{
			$this->manager_model->set_managerstatus();
			
			$data['managers'] = $this->manager_model->get_managers();	
			
			$this->load->view('templates/indexadmin', $data);	
			$this->load->view('managers/index');
			$this->load->view('templates/footeradmin');
		}
	}
	
	
	
}