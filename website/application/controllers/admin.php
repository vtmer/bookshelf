<?php

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if(!$this->is_logged_in())
		{
			$this->load->view('admin_login');
		}
		else
		{
			redirect('manage_booklist','refresh');
		}
	}

	public function login()
	{
		$admin = $this->input->post('admin');
		$pwd = $this->input->post('admin_pwd');		
	
		$row = $this->admin_model->get($admin);
		$uid = $row->id;
		if($this->admin_model->check($admin,$pwd))
		{
			$data = array(
				'uid' => $uid,
				'admin' => TRUE,
			);
			$this->session->set_userdata($data);

			redirect('manage_booklist','refresh');
		}
		else
		{
			redirect('admin/error');
		}	
		

	}

	private function is_logged_in()
	{
		return $this->session->userdata('admin');		
	}

	public function error()
	{
		$this->load->view('admin_login',array('error' => TRUE));
	}

	public function logout()
	{
		if(!$this->is_logged_in())
		{
			redirect('admin');
		}
		else
		{
			$this->session->set_userdata(array('admin' => FALSE));
			$this->session->sess_destroy();
			$this->load->view('admin_login');	
		}
	}
}

?>
