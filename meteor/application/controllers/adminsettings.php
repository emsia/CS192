<?php
class adminsettings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('profile_model');
		$this->load->model('participantuser_model');
		$this->load->model('login_model');
		$this->load->library(array('session','form_validation'));
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
		 
		$data['title'] = 'Settings';
		$this->load->helper('url');
		
		$uid = $this->login_model->getuid($this->session->userdata('username'));
		$data['userid'] = $uid['id'];

		$data['user'] = $this->participantuser_model->profileInfo($data['userid']);
		$data['addr'] = $this->participantuser_model->profileAddr($data['userid']);
		$data['mobile'] = $this->participantuser_model->profileMobile($data['userid']);
		
		$this->load->view('templates/indexadmin', $data);
		$this->load->view('adminprofile/settings', $data);
		$this->load->view('templates/footeradmin');
	}
	
	public function changeform(){
		
		 
		$data['title'] = 'Settings';
		
		$uid = $this->login_model->getuid($this->session->userdata('username'));
		$data['userid'] = $uid['id'];

		$data['user'] = $this->participantuser_model->profileInfo($data['userid']);
		$data['addr'] = $this->participantuser_model->profileAddr($data['userid']);
		$data['mobile'] = $this->participantuser_model->profileMobile($data['userid']);
		
		$this->load->view('templates/indexadmin', $data);
		$this->load->view('adminprofile/changeuser', $data);
		$this->load->view('templates/footeradmin');
	}
	
	public function change(){
		$config = array(
			array(
				'field'   => 'street', 
                'label'   => 'Street', 
                'rules'   => ''
            ),
            array(
				'field'   => 'hood', 
				'label'   => 'Neighborhood', 
				'rules'   => ''
            ),
			array(
				'field'   => 'city', 
				'label'   => 'City', 
				'rules'   => ''
            ),
			array(
				'field'   => 'mobile', 
				'label'   => 'Mobile', 
				'rules'   => 'numeric'
            )
        );
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			$mobile = $this->input->post('mobile');
			$street = $this->input->post('street');
			$hood = $this->input->post('hood');
			$city = $this->input->post('city');
			$this->profile_model->changemobile($this->session->userdata('username'),$mobile);
			$this->profile_model->changeaddr($this->session->userdata('username'),$street,$hood,$city);
			$this->index();
		}
	}
	
	public function forgotform(){
		 
		$data['title'] = 'Settings';
		
		$uid = $this->login_model->getuid($this->session->userdata('username'));
		$data['userid'] = $uid['id'];
	
		$data['user'] = $this->participantuser_model->profileInfo($data['userid']);
		$data['addr'] = $this->participantuser_model->profileAddr($data['userid']);
		$data['mobile'] = $this->participantuser_model->profileMobile($data['userid']);
		
		$this->load->view('templates/indexadmin', $data);
		$this->load->view('adminprofile/settingspass', $data);
		$this->load->view('templates/footeradmin');
	}
	
	public function forgot(){
		$config = array(
			array(
				'field'   => 'newpass', 
                'label'   => 'New Password', 
                'rules'   => 'required|matches[pconf]'
            ),
            array(
				'field'   => 'pconf', 
				'label'   => 'Password Confirm', 
				'rules'   => 'required'
            )
        );
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			$pword = $this->input->post('newpass');
			$this->profile_model->changepass($this->session->userdata('username'),$pword);
			$this->index();
		}
	}
}

?>