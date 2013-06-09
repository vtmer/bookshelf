<?php

class Manage_editpwd extends CI_Controller
{
	public function index()
	{
		if(!$this->is_logged_in())
		{
			show_error('You don\'t have the permission to access this site!');
		}
		else
		{
			$this->load->view('management/manage_editpwd');
		}
	}
	
	public function update_pwd()
	{
		$pwd_old1 = $this->input->post('pwd_old1');
		$pwd_old2 = $this->input->post('pwd_old2');
		$pwd_new = $this->input->post('pwd_new');

		if($this->admin_model->update_pwd($pwd_old1,$pwd_old2,$pwd_new))
		{
			redirect('manage_editpwd/success');
		}
		else
		{
			redirect('manage_editpwd/error');
		}
	}

	public function error()
	{
		if(!$this->is_logged_in())
		{
			show_error('You don\'t have the permission to access this site!');
		}
		else
		{
			$this->load->view('management/manage_editpwd',array('error' => TRUE));
		}
	}

	public function success()
	{
		if(!$this->is_logged_in())
		{
			show_error('You don\'t have the permission to access this site!');
		}
		else
		{
			$this->load->view('management/manage_editpwd',array('success' => TRUE));
		}
	}
	
	private function is_logged_in()
	{
		return $this->session->userdata('admin');
	}
}

?>
