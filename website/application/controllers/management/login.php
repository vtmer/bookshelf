<?php
 class Login extends CI_Controller
 {
 	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		if($this->session->userdata('authority')=='admin') redirect("management/home");
		$this->load->view("management/login.html",array("flag"=>true));
	}
	public function check()
	{
		if(!$this->input->post()) show_404();
		$username = $this->input->post('username');
		$pwd = $this->input->post('pwd');
		if($result = $this->manage_model->check($username,$pwd))
		{
			ob_start();
			$arr = array(
				'username'=>$result->username,
				'authority'=>'admin',
				'uid'=>$result->id
				);
			$this->session->set_userdata($arr);
			redirect("management/home");
			ob_end_flush();
		}else
		{
			$this->load->view("management/login.html",array("flag"=>false));
		}
	}
	public function logout()
	{
		ob_start();
		$arr = array(
				'username'=>'',
				'authority'=>'',
				'uid'=>''
				);
		$this->session->unset_userdata($arr);
		redirect('management/login');
		ob_end_flush();
	}
 }