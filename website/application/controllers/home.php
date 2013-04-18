<?php
class Home extends CI_Controller
{
	public  function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->library('parser');
	}
	public function index()
	{
		$this->load->helper('form');
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
		$header=array(
					'title'=>'工大书架',
					'css_file'=>'home.css'	
					);
		$footer=array('js_file'=>'home.js');
		$this->parser->parse('template/header',$header);
		$this->load->view('home',$data);
		$this->parser->parse('template/footer',$footer);
	}
}


