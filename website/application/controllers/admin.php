<?php

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('admin_login');
	}

	public function login()
	{
		$admin = $this->input->post('admin');
		$admin_pwd = $this->input->post('admin_pwd');	
		$this->load->view('manage_addbook');
	}
}

?>
