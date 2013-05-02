<?php

class Management extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('manage_addbook');
	}

	public function edit_user()
	{
		$this->load->view('manage_edituser');
	}

	public function edit_pwd()
	{
		$this->load->view('manage_editpwd');
	}
}

?>
