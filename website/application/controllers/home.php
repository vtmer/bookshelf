<?php
class Home extends CI_Controller
{
	public  function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
	}
	public function index()
	{
		$data['book_need'] = $this->home_model->get_book_need('网络工程','2011');
		$match=array();
		$i=0;
		foreach ($data as $value) 
		{
			foreach ($value as $row) 
			{
				$match[$i]['id'] = $row['id'];
				$match[$i]['ISBN'] = $row['ISBN'];
				$match[$i]['name'] = $row['name'];
				$i++;
			}
		}
		$data['system_match'] = $this->home_model->get_system_match($match);
		//var_dump($data['system_match']);
		//$this->load->view('home',$data);
	}
}


