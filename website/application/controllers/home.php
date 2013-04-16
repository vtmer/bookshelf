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
		$data['book_need']=$this->home_model->get_book_need();
		//var_dump($data);
		$this->load->view('home',$data);
	}
}


