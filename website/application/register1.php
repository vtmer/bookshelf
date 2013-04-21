<?php

class Registera extends CI_Controller
{
	public function index()
	{
		$this->load->view('register');	
	}

	public function check()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Email','required|valid_email');

		if($this->form_validation->run() == FALSE)
		{
			echo "您输入的信息有误！";
		}

		else
		{
			$username = $this->input->post('username');
			echo $username;	
		}
	}
}

?>
