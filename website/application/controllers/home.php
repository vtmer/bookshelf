<?php
class Home extends CI_Controller
{
	public  function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->load->library('parser');
		$this->load->helper('form');
	}
	public function index()
	{	
		$data['book_need'] = $this->home_model->get_book_need('网络工程','2011');
		$match = array();
		$i = 0;
		$offset = 0;
		$length = 5;
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

		$header = array('title'=>'工大书架','css_file'=>'home.css');
		$footer = array('js_file'=>'home.js');

		$this->parser->parse('template/header',$header);
		$this->load->view('home',$data);
		$this->parser->parse('template/footer',$footer);
	}
	public function book_info($id)
	{
		$header = array('title'=>'书籍信息','css_file'=>'book_info.css');
		$footer = array('js_file'=>'book_info.js');

		$this->load->model('search_model');
		$data['book_info'] = $this->search_model->get_book_by_id($id);
		$data['user'] = $this->home_model->get_system_match(array(array('ISBN'=>$data['book_info'][0]->ISBN,
																'name'=>$data['book_info'][0]->name,'id'=>$id)));
		//var_dump($data['user']);
		$this->parser->parse('template/header',$header);
		$this->load->view('book_info',$data);
		$this->parser->parse('template/footer',$footer);
	}
	public function book_owner($id)
	{
		$header = array('title'=>'书籍拥有者','css_file'=>'book_owner.css');
		$footer = array('js_file'=>'book_owner.js');



	}
}


