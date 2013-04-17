<?php

class Register extends CI_Controller
{
	
	public function index()
	{
		$this->load->view('register');	
	}

	public function check()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Username','required|max_length[40]|valid_emails');
		$this->form_validation->set_rules('pwd1','Password1','required|min_length[8]|max_length[20]|alpha_numeric');
		$this->form_validation->set_rules('pwd2','Password2','required|matches[pwd1]');
		$this->form_validation->set_rules('truename','name','required');
		$this->form_validation->set_rules('phone_num','Phone','required|numeric|exact_length[11]');
		$this->form_validation->set_rules('subphone_num','Subphone','required|min_length[4]|max_length[6]');

		if($this->form_validation->run == FALSE)
		{
			$message = "<strong>Registeration failed!Incorrect input!</strong>";
			$this->json_response(FALSE,$message);
		}
		else
		{
            $username = $this->input->post('username');
		    $password = $this->input->post('pwd1');
			$truename = $this->input->post('truename');
			//利用session保存的信息（学院、专业、年级）；
			$faculty $this->input->post('faculty');
			$major = $this->input->post('major');
			$grade = $this->input->post('grade'); 
			$phone_num = $this->input->post('phone_num');
			$subphone_num = $this->input->post('subphone_num');
			$dormitory = $this->input->post('dormitory');	
			$status = 1;//注册标识码

			if($this->user_model->add($username,$password,$truename,$faculty,$major,$grade,$phone_num,$subphone_num,$dormitory,$status))
			{
				$message = "<strong>Registeration successfully!</strong>";
				$this->json_response(TRUE,$message);
			}
		}

		private function json_response($successful,$message)
		{
			echo json_encode(array(
				'issuccessful' => $successful;
				'message' => $message;
			));
		}
	}
}

/*End of file register.php*/
