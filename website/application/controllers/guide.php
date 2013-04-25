<?php

class Guide extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('guide');
	}

	public function choose()
	{
		//$faculty = $this->input->post('faculty');
		$major = $this->input->post('major');
		$grade = $this->input->post('grade');

		//echo $faculty."</br>".$major."</br>".$grade;
		$data = array(
			'truename' => NULL,	
			'uid' => NULL,
			'points' => NULL,
			'major' => $major,
			'grade' => $grade,
			'is_logged_in' => FALSE,
		);
		$this->session->set_userdata($data);
		$this->load->view('home');
	}
}

?>
