<?php
class Temp extends CI_Controller{

	public function __construct(){
			parent::__construct();
			$this->load->model('login_model');
			$this->load->helper('url');
			$this->load->library(array('form_validation','session'));
			$this->load->model('course_model');
	}

	function forgotpw(){
		$data['title'] = "Login";
		$data['error'] = "";
		$this->load->view('templates/indexheader',$data);
		$this->load->view('pages/forgot',$data);
		$this->load->view('templates/footer');
	}
	
	function submit(){
		$config = array(
			array(
				'field'   => 'mail', 
				'label'   => 'Email', 
				'rules'   => 'required|valid_email'
            )
        );
		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == FALSE){
			$this->forgotpw();
		}
		else{
			$user = $this->input->post('mail');
			$result = $this->login_model->forgot($user);
			if($result){
				redirect('http://meteor.upitdc.edu.ph/index.php/pages');
			}
			else{
				$data['title'] = "Validation";
				$data['error'] = "Invalid username";
				$this->load->view('templates/indexheader',$data);
				$this->load->view('pages/forgot',$data);
				$this->load->view('templates/footer');
			}
			
		}
	}
}

?>