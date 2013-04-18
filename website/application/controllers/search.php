<?php 
class Search extends CI_Controller
{
	public  function __construct()
	{
		parent::__construct();
		$this->load->model('search_model');
	}
	public function index()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		if($_POST['keywords'])
		{
			$data['books'] = $this->search_model->get_book_by_keywords($_POST['keywords']);
			$this->load->view('search',$data);
		}
		
	}
		
}