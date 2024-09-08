<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('LoginModel');
	} 

	public function index(){ 
		$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email|max_length[26]');
		$this->form_validation->set_rules('user_password', 'Password', 'trim|required|max_length[20]');
		$this->form_validation->set_error_delimiters('','');
	
		if ($this->form_validation->run() == FALSE){
			$data['error'] = "";
			$this->load->view('login',$data);                        
		} 
		else{
			$userData = array(
			'user_email' => $this->input->post('user_email'),
			'user_password' => md5($this->input->post('user_password'))
			);
			$result = $this->LoginModel->checkLogin(USER_TABLE,$userData);
			if($result){
				$sessionData = array(
				'user_name'  => $result->user_name,
				'user_email' => $result->user_email,
				'user_role' => $result->user_role,
				'user_key' => $result->user_key,
				'webLog' => 'FALSE',
				);
				date_default_timezone_set("Asia/Kolkata");
				$userID = $result->user_id;
				$loginData = array(
    				'user_login'  => date('d/m/Y h:i:s A'),
    				'is_login' => 'True'
				);
				$resultLoginData = $this->LoginModel->editData('user_id = '.$userID, USER_TABLE, $loginData);
				if($resultLoginData){
					$this->session->set_userdata($sessionData);
					redirect('confirmOTP');
				}
			} else {
				$errordata['error'] = "incorrect email or password";
				$this->load->view('login',$errordata);
			}
		}
	}
	
	public function confirmOTP(){ 
		$confirmOTP = $this->input->post('confirm_otp');
		if($confirmOTP == 'macncloud'){
			$sessionData = array(
			'webLog' => 'TRUE',
			'auth_key' => AUTH_KEY
			);
			$this->session->set_userdata($sessionData);
			redirect('dashboard');
		}
		else{
			redirect('login');
		}
	}
}
