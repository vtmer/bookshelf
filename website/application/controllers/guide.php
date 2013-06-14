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
		$data = getdate();
		$year =$data['year'];
		$month = $data['mon'];
		if($month < 9)
		{
			$year-=1;
		}
		switch ($grade) {
			case '大一':
				$grade = $year;
				break;
			case '大二':
				$grade = $year - 1;
				break;
			case '大三':
				$grade = $year - 2;
				break;
			case '大四':
				$grade = $year - 3;
				break;
			default:
				#code...
				break;
		}
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
		header('location:/bookshelf/website/index.php/home');
	}
}
